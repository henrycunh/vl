<?php
  class TrabEvento extends IC{
    // 1 - Resumo Nacional, 2 - Resumo Internacional,
    // 3 - Completo Nacional, 4 - Completo Internacional
    public $tipoClass;
    // 1 - Resumo Nacional, 2 - Resumo Internacional,
    // 3 - Completo Nacional, 4 - Completo Internacional
    public $tipoPais;
    public $natureza;
    public $titulo;
    public $ano;
    public $isbn;
    public $homepage;
    public $doi;
    public $pais;
    public $idioma;
    public $classEvento;
    public $nomeEvento;
    public $cidadeEvento;
    public $anoRealizacao;
    public $nomeEditora;
    public $titulosAnais;
    public $pagInicial;
    public $pagFinal;
    public $autores;

    // Construtor Vazio
    public function __construct(){
      parent::__construct();
      $this->tipoClass = '';
      $this->tipoPais = '';
      $this->natureza = '';
      $this->titulo = '';
      $this->ano = '';
      $this->isbn = '';
      $this->homepage = '';
      $this->doi = '';
      $this->classEvento = '';
      $this->nomeEvento = '';
      $this->cidadeEvento = '';
      $this->anoRealizacao = '';
      $this->nomeEditora = '';
      $this->titulosAnais = '';
      $this->pais = '';
      $this->idioma = '';
      $this->pagInicial = '';
      $this->pagFinal = '';
      $this->autores = array();
    }

    // Retorna um array com os trabalhos em eventos a partir do XML
    public static function getTrabEventos($data){
      // PRODUCAO-BIBLIOGRAFICA.TRABALHOS-EM-EVENTOS.TRABALHO-EM-EVENTOS
      $trabEventos = array();
      // Caso o pesquisador não possua um trabalho em Evento
      if(isset($data['PRODUCAO-BIBLIOGRAFICA']['TRABALHOS-EM-EVENTOS']['TRABALHO-EM-EVENTOS'])){
        $trabEventosRaw = $data['PRODUCAO-BIBLIOGRAFICA']['TRABALHOS-EM-EVENTOS']['TRABALHO-EM-EVENTOS'];

        foreach ($trabEventosRaw as $trabE) {
            $trab_ = new self();
            $dadosB = attr($trabE['DADOS-BASICOS-DO-TRABALHO']);
            $details = attr($trabE['DETALHAMENTO-DO-TRABALHO']);
            $autores = $trabE['AUTORES'];

            // Dados básicos do trabalho
            $trab_->natureza =  $dadosB['NATUREZA'];
            $trab_->titulo = $dadosB['TITULO-DO-TRABALHO'];
            $trab_->ano = $dadosB['ANO-DO-TRABALHO'];
            $trab_->homepage = $dadosB['HOME-PAGE-DO-TRABALHO'];
            $trab_->doi = $dadosB['DOI'];
            $trab_->idioma = $dadosB['IDIOMA'];
            $trab_->pais = $dadosB['PAIS-DO-EVENTO'];

            // Detalhes do Trabalho
            $trab_->classEvento = $details['CLASSIFICACAO-DO-EVENTO'];
            $trab_->nomeEvento = $details['NOME-DO-EVENTO'];
            $trab_->cidadeEvento = $details['CIDADE-DO-EVENTO'];
            $trab_->anoRealizacao = $details['ANO-DE-REALIZACAO'];
            $trab_->titulosAnais = $details['TITULO-DOS-ANAIS-OU-PROCEEDINGS'];
            $trab_->pagInicial = $details['PAGINA-INICIAL'];
            $trab_->pagFinal = $details['PAGINA-FINAL'];
            $trab_->isbn = $details['ISBN'];

            // Definindo tipoClass
            if($trab_->natureza == 'COMPLETO')
              $trab_->tipoClass = 2;
            else
              $trab_->tipoClass = 1;

            if($trab_->classEvento == 'INTERNACIONAL' && $trab_->tipoClass == 2) $trab_->tipoClass = 4;
            else if($trab_->classEvento != 'INTERNACIONAL' && $trab_->tipoClass == 2) $trab_->tipoClass = 3;
            else if($trab_->classEvento == 'INTERNACIONAL' && $trab_->tipoClass == 1) $trab_->tipoClass = 2;
            else if($trab_->classEvento != 'INTERNACIONAL' && $trab_->tipoClass == 1) $trab_->tipoClass = 1;
            // resumo nacional = 1, resumo internacional = 2, completo nacional = 3, completo internacional = 4

            // Definindo tipoPais
            if($trab_->natureza == 'COMPLETO')
              $trab_->tipoPais = 2;
            else
              $trab_->tipoPais = 1;

            if($trab_->pais != 'Brasil' && $trab_->tipoPais == 2) $trab_->tipoPais = 4;
            else if($trab_->pais == 'Brasil' && $trab_->tipoPais == 2) $trab_->tipoPais = 3;
            else if($trab_->pais != 'Brasil' && $trab_->tipoPais == 1) $trab_->tipoPais = 2;
            else if($trab_->pais == 'Brasil' && $trab_->tipoPais == 1) $trab_->tipoPais = 1;
            // resumo nacional = 1, resumo no exterior = 2, completo nacional = 3, completo no exterior = 4

            $trab_->autores = getAutores($autores);
            array_push($trabEventos, $trab_);
          }
        }
        return $trabEventos;
      }

    // Insere os dados no DB
    public function insertIntoDB($conn, $curriculoId){
      // Encoding dos autores
      $autores = json_encode($this->autores, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
      // Comando SQL
      $SQL =
        "INSERT INTO ic_trabEvento(
          tipoClass, tipoPais, natureza, titulo, ano, isbn, homepage, doi, pais, idioma,
          classEvento, nomeEvento, cidadeEvento, anoRealizacao, nomeEditora,
          titulosAnais, pagInicial, pagFinal, autores, curriculoId
        ) VALUES (
          :tipoClass, :tipoPais, :natureza, :titulo, :ano, :isbn, :homepage,
          :doi, :pais, :idioma, :classEvento, :nomeEvento, :cidadeEvento,
          :anoRealizacao, :nomeEditora, :titulosAnais, :pagInicial, :pagFinal,
          :autores, :curriculoId
        )";
      // Preparando statement
      $stmt = $conn->prepare($SQL);
      // Ligando parâmetros
      $stmt->bindParam(':tipoClass',$this->tipoClass);
      $stmt->bindParam(':tipoPais',$this->tipoPais);
      $stmt->bindParam(':natureza',$this->natureza);
      $stmt->bindParam(':titulo',$this->titulo);
      $stmt->bindParam(':ano',$this->ano);
      $stmt->bindParam(':isbn',$this->isbn);
      $stmt->bindParam(':homepage',$this->homepage);
      $stmt->bindParam(':doi',$this->doi);
      $stmt->bindParam(':pais',$this->pais);
      $stmt->bindParam(':idioma',$this->idioma);
      $stmt->bindParam(':classEvento',$this->classEvento);
      $stmt->bindParam(':nomeEvento',$this->nomeEvento);
      $stmt->bindParam(':cidadeEvento',$this->cidadeEvento);
      $stmt->bindParam(':anoRealizacao',$this->anoRealizacao);
      $stmt->bindParam(':nomeEditora',$this->nomeEditora);
      $stmt->bindParam(':titulosAnais',$this->titulosAnais);
      $stmt->bindParam(':pagInicial',$this->pagInicial);
      $stmt->bindParam(':pagFinal',$this->pagFinal);
      $stmt->bindParam(':autores',$autores);
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
