<?php
  class OrganizacaoEvento extends IC {
    // Atributo
    public $tipo;
    public $natureza;
    public $titulo;
    public $ano;
    public $idioma;
    public $pais;
    public $homepage;
    public $doi;
    public $instituicaoPromotora;
    public $cidade;
    public $autores;
    public $idOrganizacaoEvento;

    // Construtor Vazio
    public function __construct(){
      parent::__construct();
      $this->tipo = '';
      $this->natureza = '';
      $this->titulo = '';
      $this->ano = '';
      $this->homepage = '';
      $this->doi = '';
      $this->idioma = '';
      $this->pais = '';
      $this->instituicaoPromotora = '';
      $this->cidade = '';
      $this->autores = array();
      $this->idOrganizacaoEvento = '';
    }

    // Função que retorna array com artigos a partir do DB
    public static function selectFromDB($conn, $curriculoId){
      $organizacaoEventos = array();
      // Pegando do DB
      $organizacaoEventosRaw = $conn->query("SELECT * FROM ic_organizacaoEvento WHERE curriculoId=$curriculoId ORDER BY ano DESC")->fetchAll(PDO::FETCH_ASSOC);
      // Iterando
      foreach ($organizacaoEventosRaw as $organizacaoEvento) {
        $organizacaoEvento_ = new self();
        $organizacaoEvento_->tipo = $organizacaoEvento['tipo'];
        $organizacaoEvento_->natureza = $organizacaoEvento['natureza'];
        $organizacaoEvento_->titulo = $organizacaoEvento['titulo'];
        $organizacaoEvento_->ano = $organizacaoEvento['ano'];
        $organizacaoEvento_->idioma = $organizacaoEvento['idioma'];
        $organizacaoEvento_->pais = $organizacaoEvento['pais'];
        $organizacaoEvento_->homepage = $organizacaoEvento['homepage'];
        $organizacaoEvento_->doi = $organizacaoEvento['doi'];
        $organizacaoEvento_->instituicaoPromotora = $organizacaoEvento['instituicaoPromotora'];
        $organizacaoEvento_->cidade = $organizacaoEvento['cidade'];
        $organizacaoEvento_->autores = json_decode($organizacaoEvento['autores'], true);
        $organizacaoEvento_->idOrganizacaoEvento = $organizacaoEvento['idOrganizacaoEvento'];
        $organizacaoEvento_->setVal($organizacaoEvento);
        array_push($organizacaoEventos, $organizacaoEvento_);
      }
      return $organizacaoEventos;
    }

    // Retorna um array com as organizaçções de evento a partir de um XML
    public static function getOrganizacaoEvento($data){
      //array que será retornado
      $organizacaoEventos = array();

      //Caso possua organização de eventos
      if(isset($data['PRODUCAO-TECNICA']['DEMAIS-TIPOS-DE-PRODUCAO-TECNICA']['ORGANIZACAO-DE-EVENTO'])){
        $organizacaoEventosRaw = $data['PRODUCAO-TECNICA']['DEMAIS-TIPOS-DE-PRODUCAO-TECNICA']['ORGANIZACAO-DE-EVENTO'];

        //Percorrer lista de organizações para atribuição ao array
        foreach ($organizacaoEventosRaw as $organizacaoEvento) {
          //Classe temporária para atribuir valores
          $organizacaoEvento_ = new self();
          //Definição de caminhos
          $dadosB = attr($organizacaoEvento['DADOS-BASICOS-DA-ORGANIZACAO-DE-EVENTO']);
          $details = attr($organizacaoEvento['DETALHAMENTO-DA-ORGANIZACAO-DE-EVENTO']);
          $autores = $organizacaoEvento['AUTORES'];

          //Dados básicos
          $organizacaoEvento_->tipo = $dadosB['TIPO'];
          $organizacaoEvento_->natureza = $dadosB['NATUREZA'];
          $organizacaoEvento_->titulo = $dadosB['TITULO'];
          $organizacaoEvento_->ano = $dadosB['ANO'];
          $organizacaoEvento_->homepage = $dadosB['HOME-PAGE-DO-TRABALHO'];
          $organizacaoEvento_->doi = $dadosB['DOI'];
          $organizacaoEvento_->idioma = $dadosB['IDIOMA'];
          $organizacaoEvento_->pais = $dadosB['PAIS'];
          //Detalhamento
          $organizacaoEvento_->instituicaoPromotora = $details['INSTITUICAO-PROMOTORA'];
          $organizacaoEvento_->cidade = $details['CIDADE'];
          //Autores
          $organizacaoEvento_->autores = getAutores($autores);

          //Atribuição da classe no array
          array_push($organizacaoEventos, $organizacaoEvento_);
        }
      }
      return $organizacaoEventos;
    }

    // Insere dados no DB
    public function insertIntoDB($conn, $curriculoId){
      // Enconding os autores para string JSON
      $autores = json_encode($this->autores, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
      // Comando SQL
      $SQL =
        "INSERT INTO ic_organizacaoEvento(
          tipo, natureza, titulo, ano, idioma, pais,
          homepage, doi, instituicaoPromotora, cidade,
          autores, curriculoId
        ) VALUES (
          :tipo, :natureza, :titulo,
          :ano, :idioma, :pais,
          :homepage, :doi, :instituicaoPromotora,
          :cidade, :autores, :curriculoId
        )";
      // Preparando statement
      $stmt = $conn->prepare($SQL);
      // Ligando parametros
      $stmt->bindParam(':tipo', $this->tipo);
      $stmt->bindParam(':natureza', $this->natureza);
      $stmt->bindParam(':titulo', $this->titulo);
      $stmt->bindParam(':ano', $this->ano);
      $stmt->bindParam(':idioma', $this->idioma);
      $stmt->bindParam(':pais', $this->pais);
      $stmt->bindParam(':homepage', $this->homepage);
      $stmt->bindParam(':doi', $this->doi);
      $stmt->bindParam(':instituicaoPromotora', $this->instituicaoPromotora);
      $stmt->bindParam(':cidade', $this->cidade);
      $stmt->bindParam(':autores', $autores);
      $stmt->bindParam(':curriculoId', $curriculoId);
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
