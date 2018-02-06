<?php
  class Sumario{

    public $idSumario;    # ID do Sumário
    public $idEdital;     # ID do Edital
    public $pontTotal;    # Pontuação total do sumário
    public $hashcode;     # Hashcode de todo o conteúdo do sumário
    public $curriculoId;  # ID do Currículo
    public $content;      # Conteúdo de pontuação do sumário
    public $dataPont;     # Data em que foi efetuada a pontuação

    /* Função construtora da classe */
    public function __construct(){
      $this->idSumario = '';
      $this->idEdital = '';
      $this->pontTotal = '';
      $this->hashcode = '';
      $this->curriculoId = '';
      $this->content = '';
      $this->dataPont = '';
    }


    public static function selectSumario($cId, $edId, $conn){
      // Comando SQL
      $SQL = "SELECT * FROM sumario WHERE curriculoId = $cId AND idEdital = $edId";
      // Executando query
      $data = $conn->query($SQL)->fetch(PDO::FETCH_ASSOC);
      // Instanciando sumário
      $sumario = new self();
      // Atribuindo as informações
      $sumario->idEdital = $data['idEdital'];
      $sumario->curriculoId = $data['curriculoId'];
      $sumario->pontTotal = $data['pontTotal'];
      $sumario->hashcode = $data['hashcode'];
      $sumario->content = json_decode($data['content'], true);
      $sumario->idSumario = $data['idSumario'];
      $sumario->dataPont = $data['dataPont'];
      // Retornando sumário
      return $sumario;
    }

    public static function selectSumarioByHash($hash, $conn){
      // Comando SQL
      $SQL = "SELECT * FROM sumario WHERE hashcode = '$hash'";
      // Executando query
      $data = $conn->query($SQL)->fetch(PDO::FETCH_ASSOC);
      // Instanciando sumário
      $sumario = new self();
      // Atribuindo as informações
      $sumario->idEdital = $data['idEdital'];
      $sumario->curriculoId = $data['curriculoId'];
      $sumario->pontTotal = $data['pontTotal'];
      $sumario->hashcode = $data['hashcode'];
      $sumario->content = json_decode($data['content'], true);
      $sumario->idSumario = $data['idSumario'];
      $sumario->dataPont = $data['dataPont'];
      // Retornando sumário
      return $sumario;
    }

    /**
     * Insere o objeto no banco de dados
     *
     * @param $conn     Conexão com o banco de dados
     */
    public function insertIntoDB($conn){
      // Comando SQL
      $SQL =
        "INSERT INTO sumario(
          idEdital, pontTotal, hashcode, curriculoId, content, dataPont
        ) VALUES (
          :idEdital, :pontTotal, :hashcode, :curriculoId, :content, :dataPont
        )";
      // Convertendo o conteúdo para JSON
      $json = json_encode($this->content);

      // Preparando o statement
      $stmt = $conn->prepare($SQL);

      // Ligando parâmetros
      $stmt->bindParam(':idEdital',$this->idEdital);
      $stmt->bindParam(':pontTotal',$this->pontTotal);
      $stmt->bindParam(':hashcode',$this->hashcode);
      $stmt->bindParam(':curriculoId',$this->curriculoId);
      $stmt->bindParam(':content',$json);
      $stmt->bindParam(':dataPont',$this->dataPont);

      // Executando
      $query = $stmt->execute();

      // Checando erros
      if($query){
        return true;
      } else {
        // Imprime o erro
        print_r($stmt->errorInfo());
        return false;
      }
    }

    public static function checkSumario($cId, $edId, $conn){
      $SQL = "SELECT * FROM sumario WHERE curriculoId = $cId AND idEdital = $edId";
      $found = $conn->query($SQL)->fetch(PDO::FETCH_ASSOC);
      return $found;
    }

    public function getEdital($conn, $idEdital){
      return $conn->query("SELECT * FROM edital WHERE idEdital = ".$idEdital)->fecth(PDO::FETCH_ASSOC);
    }

    /**
    * Retorna um sumário baseado nas regras do edital vinculado,
    * e nos itens de currículo validados do currículo vinculado,
    * através de seletivas funções que fazem o cálculo da pontuação
    * e o armazenamento dos detalhes envolvidos nas operações
    *
    * @param $cId    | ID do Currículo
    * @param $edId   | ID do edital
    * @param $conn   | Conexão com o DB
    */
    public static function generateSumario($cId, $edId, $conn){
        // VarDecl
        $pontuacao = 0;
        $sumario = new self();
        $sumario->idEdital = $edId;
        $sumario->curriculoId = $cId;
        $sumario->dataPont = date("Y-m-d");
        $content = array();
        // Pega o Edital
        $edital = Edital::selectById($conn, $edId);
        // Pega as regras do edital
        $regras = classify($edital->selectRegras($conn));
        // Pega o currículo
        $curriculo = Curriculo::getCurriculoByID($conn,$cId);
        // Lista com os ICs genéricos, que só condicionam o ano
        $genericICs = array(
          "capLivro"          => $curriculo->capLivros,
          "corpoEditorial"    => $curriculo->corposEditoriais,
          "livro"             => $curriculo->livros,
          "organizacaoEvento" => $curriculo->organizacaoEventos,
          "patente"           => $curriculo->patentes,
          "partPos"           => $curriculo->partPos
        );


        // Pontuando ICs Genéricos
        foreach ($genericICs as $ic => $itens) {
          $ptIC = pontGeneric($itens, $regras["$ic"], $ic);
          $content[$ic] = array("detail" => $ptIC, "generico" => true);
          $pontuacao += $ptIC["pt"];
        }

        // Pontuando Titulação
        $ptTitulacao = pontTitulacao($curriculo->titulacoes, $regras['titulacao']);
        $content["titulacao"] = array("detail" => $ptTitulacao, "generico" => false);
        $pontuacao += $ptTitulacao["pont"];

        $ptArtigo = pontArtigo( $curriculo->artigos, $regras['artigo'] );
        $content["artigo"] = array("detail" => $ptArtigo, "generico" => false);
        $pontuacao += $ptArtigo['pont'];

        // Pontuando Banca
        $ptBanca = pontBanca($curriculo->bancas, $regras['banca']);
        $content["banca"] = array("detail" => $ptBanca, "generico" => false);
        $pontuacao += $ptBanca["pt"];
        // Pontuando Coordenação de Projetos
        $ptCoordProj = pontCoordProj($curriculo->coordProjs, $regras['coordProj']);
        $content["coordProj"] = array("detail" => $ptCoordProj, "generico" => false);
        $pontuacao += $ptCoordProj["ptAnd"] + $ptCoordProj["ptConcl"];

        // Pontuando Orientações
        $ptOrientacao = pontOrientacao($curriculo->orientacoes, $regras['orientacao']);
        $content["orientacao"] = array("detail" => $ptOrientacao, "generico" => false);
        $pontuacao += $ptOrientacao['total'];

        // Pontuando Trabalhos em Eventos
        $ptTrabEvento = pontTrabEvento($curriculo->trabEventos, $regras['trabEvento']);
        $content["trabEvento"] = array("detail" => $ptTrabEvento, "generico" => false);
        $pontuacao += $ptOrientacao['total'];

        $sumario->pontTotal = $pontuacao;
        $sumario->content = $content;
        $sumario->hashcode = md5(json_encode($sumario));
        return $sumario;
    }




  function getFormatedContent(){
    $IC_LABELS = Edital::getICDesc();
    $newContent = array();
    // Formato
    // label, pt, ptMax, class
    $data = $this->content;

    // ICs Genéricos
    $genICs = array_filter($data, function($item){ return $item["generico"]; });
    foreach ($genICs as $ic => $val) {
      array_push($newContent, array(
        "ic" => $ic,
        "label" => $IC_LABELS[$ic],
        "pt" => $val["detail"]["pt"],
        "ptMax" => $val["detail"]["ptMax"],
        "generico" => true
      ));
    }

    // Titulacao
    $titulacao = $data['titulacao']['detail']['details'];
    $titGuide = array("1" => "grad", "2" => "esp", "3" => "mest", "4" => "doc");
    foreach ($titulacao as $i => $val) {
      array_push($newContent, array(
        "ic" => "titulacao",
        "label" => $IC_LABELS["titulacao"][$titGuide[$i]],
        "pt" => $val["pt"],
        "ptMax" => $val["ptMax"],
        "generico" => false,
        "tipo" => $titGuide[$i]
      ));
    }

    // Banca
    $banca = $data['banca']['detail'];
    foreach ($banca as $i => $val) {
      if($i != 'pt'){
        array_push($newContent, array(
          "ic" => "banca",
          "label" => $IC_LABELS["banca"][$i],
          "pt" => $val["pt"],
          "ptMax" => $val["ptMax"],
          "generico" => false,
          "tipo" => $i
        ));
      }
    }

    // Coord. Projetos
    $coordProj = $data['coordProj']['detail'];
    array_push($newContent, array(
      "ic" => "coordProj",
      "label" => $IC_LABELS["coordProj"]["and"],
      "pt" => $coordProj["ptAnd"],
      "ptMax" => $coordProj["ptMaxAnd"],
      "generico" => false,
      "tipo" => "and"
    ));
    array_push($newContent, array(
      "ic" => "coordProj",
      "label" => $IC_LABELS["coordProj"]["concl"],
      "pt" => $coordProj["ptConcl"],
      "ptMax" => $coordProj["ptMaxConcl"],
      "generico" => false,
      "tipo" => "concl"
    ));

    // Orientacao
    $orientacao = $data['orientacao']['detail'];
    foreach ($orientacao as $i => $val) {
      if($i != 'total' && isset($IC_LABELS["orientacao"][$val["tipo"]])){
        array_push($newContent, array(
          "ic" => "orientacao",
          "label" => $IC_LABELS["orientacao"][$val["tipo"]],
          "pt" => $val["pt"],
          "ptMax" => $val["max"],
          "generico" => false,
          "tipo" => $val["tipo"]
        ));
      }
    }

    // Trabalho em Evento
    $trabEvento = $data['trabEvento']['detail'];
    foreach ($trabEvento as $i => $val) {
        array_push($newContent, array(
          "ic" => "trabEvento",
          "label" => $IC_LABELS["trabEvento"][$val["tipo"]],
          "pt" => $val["total"],
          "ptMax" => $val["rule"]["ptMax"],
          "generico" => false,
          "tipo" => $val["tipo"]
        ));
    }
    return $newContent;
  }

}


function pontTitulacao($ics, $regras){
  if(count($regras) > 0){
    $titulacoes = getValidated($ics);
    $maior = $regras[0]->content->maior;
    $regrasTit = array();
    $tiposTit = array("1" => "grad", "2" => "esp", "3" => "mest", "4" => "doc");

    foreach ($tiposTit as $key => $value) {
      $regra = array_filter($regras, function($rule) use($value){
        return $rule->content->tipo == $value;
      });

      $regra = array_pop($regra);

      $regrasTit[$key] = array(
        "ptInd" => $regra->ptInd,
        "ptMax" => $regra->ptMax
      );
    }
    $result = array();
    if($maior){
      $maiorTit = array("pt" => 0);

      foreach ($titulacoes as $titulacao)
        if($titulacao->tipo > $maiorTit['pt'])
          $maiorTit = array("pt" => $titulacao->tipo, "tit" => $titulacao);
      $maiorTit = $maiorTit["tit"];

      foreach ($tiposTit as $i => $v)
        $result[$i] = array(
          "tipo" => $i,
          "ptMax" => $regrasTit[$i]["ptMax"],
          "pt" => $i == $maiorTit->tipo ? $regrasTit[$i]["ptMax"] : 0
        );

      $total = $result[$maiorTit->tipo]["pt"];

    } else {
      $total = 0;
      foreach ($titulacoes as $titulacao){
        $i = $titulacao->tipo;
        if(isset($regrasTit[$i])){
          $result[$i] = array(
            "tipo" => $i,
            "ptMax" => $regrasTit[$i]["ptMax"],
            "pt" => $regrasTit[$i]["ptMax"]
          );
          $total = $result[$i]["pt"];
          unset($regrasTit[$i]);
        }
      }
    }
    return array(
      "pont" => $total,
      "details" => $result
    );
  }
}


function pontArtigo($ics, $regras){ 
  // Checa se existem regras
  if(!count($regras)) return;
  // Seleciona apenas os ICs validados
  $ics = getValidated($ics);
  // Como esse tipo de IC só pode ter uma regra, a seleciona
  $regra = $regras[0];
  // Checa se existem ICs validados
  if(count($ics) > 0){
    // Define um dicionário de extratos e seus valores númericos
    $extrato_dict = [
      "a1"  => 0,
      "a2"  => 1,
      "b1"  => 2,
      "b2"  => 3,
      "b3"  => 4,
      "b4"  => 5,
      "b5"  => 6,
      "c"   => 7,
    ];
    // Seleciona a condição de ano da regra
    $ano = $regra->content->ano;
    // Seleciona condição de extrato da regra
    $extrato = $regra->content->extrato;
    // Seleciona os ICs que cumprirem com o requisito de ano
    $itens = array_filter($ics, function($item) use($ano){
      return $item->ano >= $ano;
    });
    // Seleciona ICs que cumprirem com o requisito de Extrato
    $itens = array_filter($itens, function($item) use($extrato, $extrato_dict){
      return $extrato_dict[$item->extrato] <= $extrato_dict[$extrato];
    });
    $itens = count($itens);
    $lim = $regra->content->lim;
    $max = $lim ? false : $regra->ptMax / $regra->ptInd;
    $pt =  $regra->ptInd;
    $total = $lim || $itens <= $max ? $itens * $pt : $max * $pt;
    return array("pont" => $total, "itens" => $itens, "ptInd" => $regra->ptInd, "ptMax" => $regra->ptMax);
  } else {
    return array("pt" => 0, "itens" => 0, "ptInd" => $regra->ptInd, "ptMax" => $regra->ptMax);
  }
}


function pontGeneric($ics, $regras, $name){
    // Checa se existem regras 
    if(!count($regras)) return;
    // Pega apenas os ICs validados
    $ics = getValidated($ics);
    // Adota a primeira regra como geral (ou seja, em todo caso existiria apenas uma regra)
    $regra = $regras[0];
    // Checa se existem ICs validados
    if(count($ics) > 0){
      // Pega a condição de ano da regra
      $ano = $regra->content->ano;
      // Verifica os ICs, averiguando se cumprem a condição de ano
      $itens = array_filter($ics, function($item) use($ano, $name){
        if($name == 'corpoEditorial') // Caso o tipo do IC seja CorpoEditorial
          return substr($item->dataFim, 3) >= $ano || empty($item->dataFim) || $item->dataFim == '/';
        else if($name == 'partPos') // Caso o tipo do IC seja PartPos
          return $item->ingresso >= $ano;
        return $item->ano >= $ano;
      });
      // Conta a quantidade de ICs que cumpriram com o requerimento
      $itens = count($itens);
      // Verifica a regra de limite
      $lim = $regra->content->lim;
      // Caso a regra de limite esteja em uso, não define um máximo de, caso contrário, define um máximo
      $max = $lim ? false : $regra->ptMax / $regra->ptInd;
      // Define a pontuação por item
      $pt =  $regra->ptInd;
      // Calcula a pontuação total
      $total = $lim || $itens <= $max ? $itens * $pt : $max * $pt;
      // Retorna a pontuação total, os itens, e o contexto da regra
      return array("pt" => $total, "itens" => $itens, "ptInd" => $regra->ptInd, "ptMax" => $regra->ptMax);
    } else {
      // Caso em que não existem ICs válidos
      return array("pt" => 0, "itens" => 0, "ptInd" => $regra->ptInd, "ptMax" => $regra->ptMax);
    }
}


function pontMarca($ics_marcas, $ics_software, $regras){
  // Checa se existem regras 
  if(!count($regras)) return;
  // Pega apenas os ICs validados
  $ics = array_merge(getValidated($ics_marcas), getValidated($ics_software));
  // Adota a primeira regra como geral (ou seja, em todo caso existiria apenas uma regra)
  $regra = $regras[0];
  // Checa se existem ICs validados
  if(count($ics) > 0){
    // Pega a condição de ano da regra
    $ano = $regra->content->ano;
    // Verifica os ICs, averiguando se cumprem a condição de ano
    $itens = array_filter($ics, function($item) use($ano, $name){
      return $item->ano >= $ano;
    });
    // Conta a quantidade de ICs que cumpriram com o requerimento
    $itens = count($itens);
    // Verifica a regra de limite
    $lim = $regra->content->lim;
    // Caso a regra de limite esteja em uso, não define um máximo de, caso contrário, define um máximo
    $max = $lim ? false : $regra->ptMax / $regra->ptInd;
    // Define a pontuação por item
    $pt =  $regra->ptInd;
    // Calcula a pontuação total
    $total = $lim || $itens <= $max ? $itens * $pt : $max * $pt;
    // Retorna a pontuação total, os itens, e o contexto da regra
    return array("pt" => $total, "itens" => $itens, "ptInd" => $regra->ptInd, "ptMax" => $regra->ptMax);
  } else {
    // Caso em que não existem ICs válidos
    return array("pt" => 0, "itens" => 0, "ptInd" => $regra->ptInd, "ptMax" => $regra->ptMax);
  }
}









function pontBanca($ics, $regras){
    if(!count($regras)) return;
    $tipos = array("1" => "grad", "3" => "mest", "4" => "doc");
    $ics = getValidated($ics);
    $itens = array("grad" => array(), "mest" => array(), "doc" => array());
    $ano = $regras[0]->content->ano;
    $lim = $regras[0]->content->lim;
    $regras = array("grad" => $regras[0], "mest" => $regras[1], "doc" => $regras[2]);

    foreach ($ics as $ic){
      array_push($itens[$tipos[$ic->tipo]], $ic);
    }

    $total = 0;

    $itensGrad = count($itens["grad"]);
    $maxGrad = $regras["grad"]->ptMax / $regras["grad"]->ptInd;
    $totalGrad = $lim || $itensGrad <= $maxGrad ? $itensGrad * $regras["grad"]->ptInd : $maxGrad * $regras["grad"]->ptInd;

    $itensMest = count($itens["mest"]);
    $maxMest = $regras["mest"]->ptMax / $regras["mest"]->ptInd;
    $totalMest = $lim || $itensMest <= $maxMest ? $itensMest * $regras["mest"]->ptInd : $maxMest * $regras["mest"]->ptInd;

    $itensDoc = count($itens["doc"]);
    $maxDoc = $regras["doc"]->ptMax / $regras["doc"]->ptInd;
    $totalDoc = $lim || $itensDoc <= $maxDoc ? $itensDoc * $regras["doc"]->ptInd : $maxDoc * $regras["doc"]->ptInd;

    $total += $totalGrad + $totalMest + $totalDoc;

    $result = array(
      "pt" => $total,
      "grad" => array(
        "pt" => $totalGrad,
        "ptMax" => $regras["grad"]->ptMax,
        "itens" => $itensGrad
      ),
      "mest" => array(
        "pt" => $totalMest,
        "ptMax" => $regras["mest"]->ptMax,
        "itens" => $itensMest
      ),
      "doc" => array(
        "pt" => $totalDoc,
        "ptMax" => $regras["doc"]->ptMax,
        "itens" => $itensDoc
      )
    );
    return $result;
}








function pontCoordProj($ics, $regras){
    // Checa se existem regras
    if(!count($regras)) return;
    // Pega o ICs validados
    $coords = getValidated($ics);
    $regra = $regras[0];
    $state = $regra->content->estado;
    $ano = $regra->content->ano;
    $lim = $regra->ptMax == -1 && $regra->content->pontMaxAnd == -1;

    if($state){
      // Separando por tipos
      $concl = achar($coords, function($item) use($ano){
        return $item->situacao == 'CONCLUIDO' && ($ano ? $item->anoInicio >= $ano || $item->anoInicio == '' : true);
      });
      $and = achar($coords, function($item) use($ano){
        return $item->situacao  == 'EM_ANDAMENTO' && ($ano ? $item->anoInicio >= $ano || $item->anoInicio == '' : true);
      });
      // Pontuando
      $maxConcl = $regra->ptMax / $regra->ptInd;
      $maxAnd = $regra->content->pontMaxAnd / $regra->content->pontIndAnd;
      $iConcl = count($concl);
      $iAnd = count($and);
      $pontConcl = $lim || $iConcl <= $maxConcl ? $iConcl * $regra->ptInd : $maxConcl * $regra->ptInd;
      $pontAnd = $lim || $iAnd <= $maxAnd ? $iAnd * $regra->content->pontIndAnd : $maxAnd * $regra->content->pontIndAnd;
  
      $result = array(
        "ptAnd" => $pontAnd,
        "ptConcl" => $pontConcl,
        "itensAnd" => $iAnd,
        "itensConcl" => $iConcl,
        "ptMaxAnd" => $regra->content->pontMaxAnd,
        "ptMaxConcl" => $regra->ptMax
      );
      return $result;
    }
     // Conta a quantidade de ICs que cumpriram com o requerimento
     $itens = count($coords);
     // Caso a regra de limite esteja em uso, não define um máximo de, caso contrário, define um máximo
     $max = $lim ? false : $regra->ptMax / $regra->ptInd;
     // Define a pontuação por item
     $pt =  $regra->ptInd;
     // Calcula a pontuação total
     $total = $lim || $itens <= $max ? $itens * $pt : $max * $pt;
     // Retorna a pontuação total, os itens, e o contexto da regra
     return array("ptConcl" => 0, "ptAnd" => $total, "itens" => $itens, "ptInd" => $regra->ptInd, "ptMax" => $regra->ptMax);
    

}








function pontOrientacao($ics, $regras){
  if(!count($regras)) return;
  $orientacoes = getValidated($ics);
  $ano = $regras[0]->content->ano;
  $result = array();

  // Definindo as regras
  $regra = array();
  $ruleGuide = array(
    "1" => array("i" => 0, "t" => "inic"),
    "2" => array("i" => 5, "t" => "grad"),
    "3" => array("i" => 3, "t" => "esp"),
    "4" => array("i" => 4, "t" => "mest"),
    "5" => array("i" => 1, "t" => "doc"),
    "6" => array("i" => 2, "t" => "posdoc"),
  );
  foreach ($ruleGuide as $k => $rule) {
    $regra[$k] = array(
      "ptInd" => $regras[$rule["i"]]->ptInd,
      "ptMax" => $regras[$rule["i"]]->ptMax,
      "tipo" => $rule["t"]
    );
  }

  // Definindo as orientacoes
  $orientClass = array();
  for($i = 1; $i <= 6; $i++){
    $orientClass[$i] = achar($orientacoes, function($item) use($ano, $i){
      return $item->tipo == $i && ($ano ? $item->ano >= $ano || $item->ano == '' : true);
    });
  }

  // Definindo pontuação
  $total = 0;
  foreach ($orientClass as $i => $orientacao) {
    $mRegra =  $regra[$i];
    $lim = $mRegra["ptMax"] == -1;
    $itens = count($orientacao);
    $max = $mRegra["ptMax"] == 0 ? 0 : $mRegra["ptMax"] / $mRegra["ptInd"];
    $mPont = $lim || $itens <= $max ? $itens * $mRegra["ptInd"] : $max * $mRegra["ptInd"];
    $result[$i] = array(
      "tipo" => $mRegra["tipo"],
      "itens" => $itens,
      "pt" => $mPont,
      "max" => $mRegra["ptMax"]
    );
    $total += $mPont;
  }
  $result["total"] = $total;
  return $result;
}





function pontTrabEvento($ics, $regras){
  // Checa se existem regras
  if(!count($regras)) return;
  // Pega ICs validados
  $trabEventos = getValidated($ics);
  // Pega as condições das regras
  $ano = $regras[0]->content->ano;
  $lim = $regras[0]->content->lim;
  $class = $regras[0]->content->class == "class" ? "tipoClass" : "tipoPais";
  // Define array de resultados
  $result = array();
  // Definindo as regras
  $regra = array();
  foreach ($regras as $i => $mRegra)
    $regra[$i + 1] = array(
      "ptInd" => $mRegra->ptInd,
      "ptMax" => $mRegra->ptMax,
      "tipo" => $mRegra->content->tipo,
    );

  // Definindo os itens que cumprem com as condições
  $trabs = array();
  for ($i=1; $i <= 2; $i++)
    $trabs[$i] = achar($trabEventos, function($item) use($i, $class){
        return $item->{$class} == $i;
    });


  // Pontuando itens
  $total = 0;
  
  for ($i=1; $i <= 2; $i++) {
    $mRegra = $regra[$i];
    $mTrab = $trabs[$i];
    $max = $mRegra["ptMax"] / $mRegra["ptInd"];
    $itens = count($mTrab);
    $mPont = $lim || $itens <= $max ? $itens * $mRegra["ptInd"] : $max * $mRegra["ptInd"];
    $result[$i] = array(
      "tipo" => $mRegra["tipo"],
      "itens" => $itens,
      "total" => $mPont,
      "max" => $max,
      "rule" => $mRegra
    );
    $total += $mPont;
  }
  return $result;
}



function classify($regras){
  $result = array();
  $ic_types = array(
    'artigo', 'banca', 'capLivro', 'coordProj', 'corpoEditorial', 'livro',
    'marca', 'organizacaoEvento', 'orientacao', 'patente', 'software',
    'titulacao', 'trabEvento', 'partPos'
  );
  foreach ($ic_types as $type){
    // Pega as regras de cada tipo de IC
    $result[$type] = array_filter($regras, function($value) use($type){ return $value->ic == $type; });
    // Itera por elas
    foreach ($result as $k => $v) {
      $array = array();
      // Desmembra as regras
      foreach ($v as $k_ => $v_) {
        array_push($array, $v_);
      }
      $result[$k] = $array;
    }
  }
  return $result;
}

function getValidated($ics){
  return array_filter($ics, function($ic){
    // echo "<pre>".var_dump($ic, false)."</pre>";
    return $ic->validado == '1';
  });
}

function achar($array, $function){
  $mArray = array();
  foreach ($array as $item)
    if($function($item))
      array_push($mArray, $item);
  return $mArray;
}

function debug($data){
  echo "<pre>" . var_dump($data) . "</pre>";
}
?>