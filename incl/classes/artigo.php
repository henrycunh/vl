<?php
  class Artigo extends IC{
    // Atributos da classe
    public $titulo;
    public $ano;
    public $tituloPeriodico;
    public $issn;
    public $paginaInicial;
    public $paginaFinal;
    public $pais;
    public $idioma;
    public $volume;
    public $autores;
    public $idArtigo;

    // Construtor vazio da classe
    public function __construct(){
      parent::__construct();
      $this->titulo = '';
      $this->ano = '';
      $this->tituloPeriodico = '';
      $this->issn = '';
      $this->paginaFinal = '';
      $this->paginaInicial = '';
      $this->idioma = '';
      $this->volume = '';
      $this->pais = '';
      $this->idArtigo = '';
      $this->autores = array();
    }

    // Função que retorna array com artigos a partir do DB
    public static function selectFromDB($conn, $curriculoId){
      $artigos = array();
      // Pegando do DB
      $artigosRaw = $conn->query("SELECT * FROM ic_artigo WHERE curriculoId=$curriculoId ORDER BY ano DESC")->fetchAll(PDO::FETCH_ASSOC);
      // Iterando
      foreach ($artigosRaw as $artigo) {
        $artigo_ = new self();
        $artigo_->setVal($artigo);
        $artigo_->titulo = $artigo['titulo'];
        $artigo_->ano = $artigo['ano'];
        $artigo_->tituloPeriodico = $artigo['tituloPeriodico'];
        $artigo_->issn = $artigo['issn'];
        $artigo_->paginaInicial = $artigo['paginaInicial'];
        $artigo_->paginaFinal = $artigo['paginaFinal'];
        $artigo_->volume = $artigo['volume'];
        $artigo_->pais = $artigo['pais'];
        $artigo_->idioma = $artigo['idioma'];
        $artigo_->autores = json_decode($artigo['autores'], true);
        $artigo_->idArtigo = $artigo['idArtigo'];
        array_push($artigos, $artigo_);
      }
      return $artigos;
    }

    // Função que retorna um array com os artigos de um pesquisador a partir de seu XML
    public static function getArtigos($data){
      // array vazio a fim de ser retornado no final
      $artigos = array();
      // checa se a pessoa possui algum artigo
      if(isset($data['PRODUCAO-BIBLIOGRAFICA']['ARTIGOS-PUBLICADOS']['ARTIGO-PUBLICADO'])):
        // Caminho até os artigos
        $artigosRaw = $data['PRODUCAO-BIBLIOGRAFICA']['ARTIGOS-PUBLICADOS']['ARTIGO-PUBLICADO'];
        // Caso a pessoa possua apenas um único artigo
        if(array_keys($artigosRaw)[0] === '@attributes') $artigosRaw = array($artigosRaw);
        foreach ($artigosRaw as $artigo) {
          $artigo_ = new self();
          $autores = $artigo['AUTORES'];
          $dadosB = attr($artigo['DADOS-BASICOS-DO-ARTIGO']);
          $details = attr($artigo['DETALHAMENTO-DO-ARTIGO']);

          $artigo_->titulo = $dadosB['TITULO-DO-ARTIGO'];
          $artigo_->ano = $dadosB['ANO-DO-ARTIGO'];
          $artigo_->idioma = $dadosB['IDIOMA'];
          $artigo_->pais = $dadosB['PAIS-DE-PUBLICACAO'];

          $artigo_->tituloPeriodico = $details['TITULO-DO-PERIODICO-OU-REVISTA'];
          $artigo_->issn = $details['ISSN'];
          $artigo_->volume = $details['VOLUME'];
          $artigo_->paginaFinal = $details['PAGINA-FINAL'];
          $artigo_->paginaInicial = $details['PAGINA-INICIAL'];
          $artigo_->autores = getAutores($autores);

          array_push($artigos, $artigo_);
        }
      endif;
      return $artigos;
    }

    // Função que insere os dados do artigo atual no DB
    public function insertIntoDB($conn, $curriculoId){
      $autores = json_encode($this->autores, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
      // Comando SQL
      $SQL =
        "INSERT INTO ic_artigo(
          titulo, ano, tituloPeriodico, issn, paginaInicial, paginaFinal,
          pais, idioma, volume, autores, curriculoId
        ) VALUES (
          :titulo, :ano, :tituloPeriodico,
          :issn, :paginaInicial, :paginaFinal,
          :pais, :idioma, :volume, :autores,
          :curriculoId
        )";
      // Criando statement
      $stmt = $conn->prepare($SQL);
      // Ligando parametros
      $stmt->bindParam(':titulo',$this->titulo);
      $stmt->bindParam(':ano',$this->ano);
      $stmt->bindParam(':tituloPeriodico',$this->tituloPeriodico);
      $stmt->bindParam(':issn',$this->issn);
      $stmt->bindParam(':paginaInicial',$this->paginaInicial);
      $stmt->bindParam(':paginaFinal',$this->paginaFinal);
      $stmt->bindParam(':pais',$this->pais);
      $stmt->bindParam(':idioma',$this->idioma);
      $stmt->bindParam(':volume',$this->volume);
      $stmt->bindParam(':autores',$autores);
      $stmt->bindParam(':curriculoId',$curriculoId);
      // Executando
      $query = $stmt->execute();
      // Checando erros
      if($query)
        return true;
      else{
        print_r($stmt->errorInfo());
        return false;
      }
    }

  }


?>
