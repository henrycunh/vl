<?php
  class Orientacao extends IC{
    // Atributos
    // 1 - IC; 2 - Graduação; 3 - Especialização; 4 - Mestrado; 5 - Doutorado; 6 - Pós-Doutorado;
    public $natureza;
    public $tipo;
    public $titulo;
    public $ano;
    public $idioma;
    public $pais;
    public $homepage;
    public $doi;
    public $nomeOrientado;
    public $nomeInstituicao;
    public $nomeCurso;
    public $idOrientacao;

    // Construtor Vazio
    public function __construct(){
      parent::__construct();
      $this->natureza = '';
      $this->tipo = '';
      $this->titulo = '';
      $this->ano = '';
      $this->idioma = '';
      $this->pais = '';
      $this->homepage = '';
      $this->doi = '';
      $this->nomeOrientado = '';
      $this->nomeInstituicao = '';
      $this->nomeCurso = '';
      $this->idOrientacao = '';
    }

    // Função que retorna array com artigos a partir do DB
    public static function selectFromDB($conn, $curriculoId){
      $orientacoes = array();
      // Pegando do DB
      $orientacoesRaw = $conn->query("SELECT * FROM ic_orientacao WHERE curriculoId=$curriculoId ORDER BY ano DESC")->fetchAll(PDO::FETCH_ASSOC);
      // Iterando
      foreach ($orientacoesRaw as $orientacao) {
        $orientacao_ = new self();
        $orientacao_->natureza = $orientacao['natureza'];
        $orientacao_->tipo = $orientacao['tipo'];
        $orientacao_->titulo = $orientacao['titulo'];
        $orientacao_->ano = $orientacao['ano'];
        $orientacao_->idioma = $orientacao['idioma'];
        $orientacao_->setVal($orientacao);
        $orientacao_->pais = $orientacao['pais'];
        $orientacao_->homepage = $orientacao['homepage'];
        $orientacao_->doi = $orientacao['doi'];
        $orientacao_->nomeOrientado = $orientacao['nomeOrientado'];
        $orientacao_->nomeInstituicao = $orientacao['nomeInstituicao'];
        $orientacao_->nomeCurso = $orientacao['nomeCurso'];
        $orientacao_->idOrientacao = $orientacao['idOrientacao'];
        array_push($orientacoes, $orientacao_);
      }
      return $orientacoes;
    }

    // Retorna um array com as orientações a partir do XML
    public static function getOrientacoes($data){
      $orientacoes = array();

      if(isset($data['OUTRA-PRODUCAO']['ORIENTACOES-CONCLUIDAS'])){
        $orientacoesRaw = $data['OUTRA-PRODUCAO']['ORIENTACOES-CONCLUIDAS'];
        //Caso possua apenas um tipo de orientação
        if(array_keys($orientacoesRaw)[0] === '@attributes')
          $orientacoesRaw = array($orientacoesRaw);

        // Checando por orientações de mestrado
        if(isset($orientacoesRaw['ORIENTACOES-CONCLUIDAS-PARA-MESTRADO'])){
          $orientMest = $orientacoesRaw['ORIENTACOES-CONCLUIDAS-PARA-MESTRADO'];

          if(array_keys($orientMest)[0] === '@attributes')
            $orientMest = array($orientMest);
        }

        // Checando por orientações de pos-doc
        if(isset($orientacoesRaw['ORIENTACOES-CONCLUIDAS-PARA-POS-DOUTORADO'])){
          $orientPosDoc = $orientacoesRaw['ORIENTACOES-CONCLUIDAS-PARA-POS-DOUTORADO'];

          if(array_keys($orientPosDoc)[0] === '@attributes')
            $orientPosDoc = array($orientPosDoc);
        }

        // Checando por orientações de ic, esp, ou grad
        if(isset($orientacoesRaw['OUTRAS-ORIENTACOES-CONCLUIDAS'])){
          $outrasOrient = $orientacoesRaw['OUTRAS-ORIENTACOES-CONCLUIDAS'];

          if(array_keys($outrasOrient)[0] === '@attributes')
            $outrasOrient = array($outrasOrient);
        }

        if(isset($orientPosDoc))
        foreach ($orientPosDoc as $orientPosDoc1) {
          $orientPosDoc1_ = new Orientacao();

          $orientPosDoc1_->natureza = attr($orientPosDoc1['DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-POS-DOUTORADO'])['NATUREZA'];
          $orientPosDoc1_->tipo = 6;
          $orientPosDoc1_->titulo = attr($orientPosDoc1['DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-POS-DOUTORADO'])['TITULO'];
          $orientPosDoc1_->ano = attr($orientPosDoc1['DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-POS-DOUTORADO'])['ANO'];
          $orientPosDoc1_->idioma = attr($orientPosDoc1['DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-POS-DOUTORADO'])['IDIOMA'];
          $orientPosDoc1_->pais = attr($orientPosDoc1['DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-POS-DOUTORADO'])['PAIS'];
          $orientPosDoc1_->homepage = attr($orientPosDoc1['DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-POS-DOUTORADO'])['HOME-PAGE'];
          $orientPosDoc1_->doi = attr($orientPosDoc1['DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-POS-DOUTORADO'])['DOI'];

          $orientPosDoc1_->nomeOrientado = attr($orientPosDoc1['DETALHAMENTO-DE-ORIENTACOES-CONCLUIDAS-PARA-POS-DOUTORADO'])['NOME-DO-ORIENTADO'];
          $orientPosDoc1_->nomeInstituicao = attr($orientPosDoc1['DETALHAMENTO-DE-ORIENTACOES-CONCLUIDAS-PARA-POS-DOUTORADO'])['NOME-DA-INSTITUICAO'];
          $orientPosDoc1_->nomeCurso = attr($orientPosDoc1['DETALHAMENTO-DE-ORIENTACOES-CONCLUIDAS-PARA-POS-DOUTORADO'])['NOME-DO-CURSO'];

          array_push($orientacoes, $orientPosDoc1_);
        }

        if(isset($orientMest)){
          foreach ($orientMest as $orientMest1) {
          $orientMest1_ = new Orientacao();

          $orientMest1_->natureza = attr($orientMest1['DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-MESTRADO'])['NATUREZA'];
          $orientMest1_->tipo = 4;
          $orientMest1_->titulo = attr($orientMest1['DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-MESTRADO'])['TITULO'];
          $orientMest1_->ano = attr($orientMest1['DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-MESTRADO'])['ANO'];
          $orientMest1_->idioma = attr($orientMest1['DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-MESTRADO'])['IDIOMA'];
          $orientMest1_->pais = attr($orientMest1['DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-MESTRADO'])['PAIS'];
          $orientMest1_->homepage = attr($orientMest1['DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-MESTRADO'])['HOME-PAGE'];
          $orientMest1_->doi = attr($orientMest1['DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-MESTRADO'])['DOI'];

          $orientMest1_->nomeOrientado = attr($orientMest1['DETALHAMENTO-DE-ORIENTACOES-CONCLUIDAS-PARA-MESTRADO'])['NOME-DO-ORIENTADO'];
          $orientMest1_->nomeInstituicao = attr($orientMest1['DETALHAMENTO-DE-ORIENTACOES-CONCLUIDAS-PARA-MESTRADO'])['NOME-DA-INSTITUICAO'];
          $orientMest1_->nomeCurso = attr($orientMest1['DETALHAMENTO-DE-ORIENTACOES-CONCLUIDAS-PARA-MESTRADO'])['NOME-DO-CURSO'];


          array_push($orientacoes, $orientMest1_);
        }
        }

        if(isset($outrasOrient)){
          $tipos = array(
            "INICIACAO_CIENTIFICA" => 1,
            "TRABALHO_DE_CONCLUSAO_DE_CURSO_GRADUACAO" => 2,
            "MONOGRAFIA_DE_CONCLUSAO_DE_CURSO_APERFEICOAMENTO_E_ESPECIALIZACAO" => 3,
            "ORIENTACAO-DE-OUTRA-NATUREZA" => -1
          );
          foreach ($outrasOrient as $outrasOrient1) {
          $outrasOrient1_ = new Orientacao();
          $outrasOrient1_->natureza = attr($outrasOrient1['DADOS-BASICOS-DE-OUTRAS-ORIENTACOES-CONCLUIDAS'])['NATUREZA'];
          try {
            $outrasOrient1_->tipo = $tipos[$outrasOrient1_->natureza];
          } catch (Exception $e) {

          }
          $outrasOrient1_->titulo = attr($outrasOrient1['DADOS-BASICOS-DE-OUTRAS-ORIENTACOES-CONCLUIDAS'])['TITULO'];
          $outrasOrient1_->ano = attr($outrasOrient1['DADOS-BASICOS-DE-OUTRAS-ORIENTACOES-CONCLUIDAS'])['ANO'];
          $outrasOrient1_->idioma = attr($outrasOrient1['DADOS-BASICOS-DE-OUTRAS-ORIENTACOES-CONCLUIDAS'])['IDIOMA'];
          $outrasOrient1_->pais = attr($outrasOrient1['DADOS-BASICOS-DE-OUTRAS-ORIENTACOES-CONCLUIDAS'])['PAIS'];
          $outrasOrient1_->homepage = attr($outrasOrient1['DADOS-BASICOS-DE-OUTRAS-ORIENTACOES-CONCLUIDAS'])['HOME-PAGE'];
          $outrasOrient1_->doi = attr($outrasOrient1['DADOS-BASICOS-DE-OUTRAS-ORIENTACOES-CONCLUIDAS'])['DOI'];

          $outrasOrient1_->nomeOrientado = attr($outrasOrient1['DETALHAMENTO-DE-OUTRAS-ORIENTACOES-CONCLUIDAS'])['NOME-DO-ORIENTADO'];
          $outrasOrient1_->nomeInstituicao = attr($outrasOrient1['DETALHAMENTO-DE-OUTRAS-ORIENTACOES-CONCLUIDAS'])['NOME-DA-INSTITUICAO'];
          $outrasOrient1_->nomeCurso = attr($outrasOrient1['DETALHAMENTO-DE-OUTRAS-ORIENTACOES-CONCLUIDAS'])['NOME-DO-CURSO'];

          array_push($orientacoes, $outrasOrient1_);
        }
        }
      }
      return $orientacoes;
    }

    // Insere os dados no DB
    public function insertIntoDB($conn, $curriculoId){
      // Comando SQL
      $SQL =
        "INSERT INTO ic_orientacao(
            natureza, tipo, titulo, ano, idioma, pais, homepage, doi,
            nomeOrientado, nomeInstituicao, nomeCurso, curriculoId
        ) VALUES (
          :natureza, :tipo, :titulo, :ano,
          :idioma, :pais, :homepage, :doi,
          :nomeOrientado, :nomeInstituicao, :nomeCurso,
          :curriculoId
        )";
      // Preparando statement
      $stmt = $conn->prepare($SQL);
      // Ligando parametros
      $stmt->bindParam(':natureza',$this->natureza);
      $stmt->bindParam(':tipo',$this->tipo);
      $stmt->bindParam(':titulo',$this->titulo);
      $stmt->bindParam(':ano',$this->ano);
      $stmt->bindParam(':idioma',$this->idioma);
      $stmt->bindParam(':pais',$this->pais);
      $stmt->bindParam(':homepage',$this->homepage);
      $stmt->bindParam(':doi',$this->doi);
      $stmt->bindParam(':nomeOrientado',$this->nomeOrientado);
      $stmt->bindParam(':nomeInstituicao',$this->nomeInstituicao);
      $stmt->bindParam(':nomeCurso',$this->nomeCurso);
      $stmt->bindParam(':curriculoId',$curriculoId);
      // Executando
      $query = $stmt->execute();
      // Checando erros
      if($query){
        return true;
      } else {
        print_r($stmt->errorInfo());
        return false;
      }
    }
  }
 ?>
