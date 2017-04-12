<?php
  class CapLivro extends IC{
    /* Declaração de atributos */
    //DADOS-BASICOS-DO-CAPITULO
    public $tipo;
    public $tituloCap;
    public $ano;
    public $homepage;
    public $doi;
    //DETALHAMENTO-DO-CAPITULO
    public $tituloLivro;
    public $pagInicial;
    public $pagFinal;
    public $isbn;
    public $organizadores;
    //AUTORES
    public $autores;

    //Construtor
    public function __construct(){
      parent::__construct();
      $this->tipo = '';
      $this->tituloCap = '';
      $this->ano = '';
      $this->homepage = '';
      $this->doi = '';
      $this->tituloLivro = '';
      $this->pagInicial = '';
      $this->pagFinal = '';
      $this->isbn = '';
      $this->organizadores = array();
      $this->autores = array();
    }

    //Pegar lista de capítulos no curríCurriculo
    public static function getCapLivros($data){
      $capLivros = array();

      if(isset($data['PRODUCAO-BIBLIOGRAFICA']['LIVROS-E-CAPITULOS']['CAPITULOS-DE-LIVROS-PUBLICADOS'])):
        $capLivrosRaw = $data['PRODUCAO-BIBLIOGRAFICA']['LIVROS-E-CAPITULOS']['CAPITULOS-DE-LIVROS-PUBLICADOS']['CAPITULO-DE-LIVRO-PUBLICADO'];
        if(array_keys($capLivrosRaw)[0] === "@attributes"){
          $capLivrosRaw = array($capLivrosRaw);
        }

        //Percorrer livro pelos seus atributos
        foreach ($capLivrosRaw as $capLivro) {
          //Declaração de um capLivro
          $capLivro_ = new self();
          //Definindo caminhos
          $autores = $capLivro['AUTORES'];
          $dadosB = attr($capLivro['DADOS-BASICOS-DO-CAPITULO']);
          $details = attr($capLivro['DETALHAMENTO-DO-CAPITULO']);
          /*Atribuição de valores*/
          //DadosB
          $capLivro_->tipo = $dadosB['TIPO'];
          $capLivro_->tituloCap = $dadosB['TITULO-DO-CAPITULO-DO-LIVRO'];
          $capLivro_->ano = $dadosB['ANO'];
          $capLivro_->homepage = $dadosB['HOME-PAGE-DO-TRABALHO'];
          $capLivro_->doi = $dadosB['DOI'];
          //Details
          $capLivro_->tituloLivro = $details['TITULO-DO-LIVRO'];
          $capLivro_->pagInicial = $details['PAGINA-INICIAL'];
          $capLivro_->pagFinal = $details['PAGINA-FINAL'];
          $capLivro_->isbn = $details['ISBN'];
          $capLivro_->organizadores = $details['ORGANIZADORES'];
          //Autores
          $capLivro_->autores = getAutores($autores);

          //Adicionar mais um capLivro ao array total
          array_push($capLivros, $capLivro_);
        }
      endif;
      //retornar a lista de todos os capítulos
      return $capLivros;
    }
  }
 ?>
