<?php
  class Livro extends IC{
    /*Declaração de atributos*/
    public $tipo;
    public $titulo;
    public $ano;
    public $homepage;
    public $doi;
    public $idioma;
    public $pais;
    public $meio;
    public $isbn;
    public $numPags;
    public $autores;
    public $idLivro;

    // Construtor vazio
    public function __construct(){
      parent::__construct();
      $this->tipo = '';
      $this->titulo = '';
      $this->ano = '';
      $this->homepage = '';
      $this->doi = '';
      $this->isbn = '';
      $this->numPags = '';
      $this->idioma = '';
      $this->pais = '';
      $this->meio = '';
      $this->autores = array();
      $this->idLivro = '';
    }

    // Função que retorna array com artigos a partir do DB
    public static function selectFromDB($conn, $curriculoId){
      $livros = array();
      // Pegando do DB
      $livrosRaw = $conn->query("SELECT * FROM ic_livro WHERE curriculoId=$curriculoId")->fetchAll(PDO::FETCH_ASSOC);
      // Iterando
      foreach ($livrosRaw as $livro) {
        $livro_ = new self();
        $livro_->tipo = $livro['tipo'];
        $livro_->titulo = $livro['titulo'];
        $livro_->ano = $livro['ano'];
        $livro_->homepage = $livro['homepage'];
        $livro_->doi = $livro['doi'];
        $livro_->idioma = $livro['idioma'];
        $livro_->pais = $livro['pais'];
        $livro_->meio = $livro['meio'];
        $livro_->isbn = $livro['isbn'];
        $livro_->numPags = $livro['numPags'];
        $livro_->autores = json_decode($livro['autores'], true);
        $livro_->idLivro = $livro['idLivro'];
        array_push($livros, $livro_);
      }
      return $livros;
    }

    // Pegar array de livros
    public static function getLivros($data){
      //Declaração array de livros
      $livros = array();
      // Caso a pessoa não tenha livros
      if(isset($data['PRODUCAO-BIBLIOGRAFICA']['LIVROS-E-CAPITULOS']['LIVROS-PUBLICADOS-OU-ORGANIZADOS'])):
        // Caminho até os livros
        $livrosRaw = $data['PRODUCAO-BIBLIOGRAFICA']['LIVROS-E-CAPITULOS']['LIVROS-PUBLICADOS-OU-ORGANIZADOS']['LIVRO-PUBLICADO-OU-ORGANIZADO'];
        // Caso a pessoa apenas um livro, o que uma vez seria um vetor livros, se torna
        // um único vetor com as informações do livro, que começa em @attributes
        // echo array_keys($livrosRaw)[0];
        if(array_keys($livrosRaw)[0] === "@attributes"){ $livrosRaw = array($livrosRaw); };
        //Percorrer cada livro para pegar seus atributos
        foreach ($livrosRaw as $livro) {
          $livro_ = new self();
          $autores = $livro['AUTORES'];
          $dadosB = attr($livro['DADOS-BASICOS-DO-LIVRO']);
          $details = attr($livro['DETALHAMENTO-DO-LIVRO']);

          $livro_->tipo = $dadosB['TIPO'];
          $livro_->titulo = $dadosB['TITULO-DO-LIVRO'];
          $livro_->ano = $dadosB['ANO'];
          $livro_->homepage = $dadosB['HOME-PAGE-DO-TRABALHO'];
          $livro_->doi = $dadosB['DOI'];
          $livro_->pais = $dadosB['PAIS-DE-PUBLICACAO'];
          $livro_->idioma = $dadosB['IDIOMA'];
          $livro_->meio = $dadosB['MEIO-DE-DIVULGACAO'];

          $livro_->isbn = $details['ISBN'];
          $livro_->numPags = $details['NUMERO-DE-PAGINAS'];
          $livro_->autores = getAutores($autores);

          array_push($livros, $livro_);
        }
      endif;

      return $livros;
    }

    // Insere os dados no DB
    public function insertIntoDB($conn, $curriculoId){
      $autores = json_encode($this->autores, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
      // Comando SQL
      $SQL =
        "INSERT INTO ic_livro (
          tipo, titulo, ano, homepage, doi, idioma, pais, meio, isbn, numPags,
          autores, curriculoId
        ) VALUES (
          :tipo, :titulo, :ano, :homepage,
          :doi, :idioma, :pais, :meio,
          :isbn, :numPags, :autores, :curriculoId
        )";
      // Criando statement
      $stmt = $conn->prepare($SQL);
      // Ligando parametros
      $stmt->bindParam(':tipo',$this->tipo);
      $stmt->bindParam(':titulo',$this->titulo);
      $stmt->bindParam(':ano',$this->ano);
      $stmt->bindParam(':homepage',$this->homepage);
      $stmt->bindParam(':doi',$this->doi);
      $stmt->bindParam(':idioma',$this->idioma);
      $stmt->bindParam(':pais',$this->pais);
      $stmt->bindParam(':meio',$this->meio);
      $stmt->bindParam(':isbn',$this->isbn);
      $stmt->bindParam(':numPags',$this->numPags);
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
