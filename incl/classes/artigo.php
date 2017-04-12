<?php

  class Artigo extends IC{
    public $titulo;
    public $ano;
    public $tituloPeriodico;
    public $issn;
    public $paginaInicial;
    public $paginaFinal;
    public $pais;
    public $idioma;
    public $autores;

    public function __construct(){
      parent::__construct();
      $this->titulo = '';
      $this->ano = '';
      $this->tituloPeriodico = '';
      $this->issn = '';
      $this->paginaFinal = '';
      $this->paginaInicial = '';
      $this->idioma = '';
      $this->pais = '';
      $this->autores = array();
    }

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
          $artigo_->paginaFinal = $details['PAGINA-FINAL'];
          $artigo_->paginaInicial = $details['PAGINA-INICIAL'];
          $artigo_->autores = getAutores($autores);

          array_push($artigos, $artigo_);
        }
      endif;
      return $artigos;
    }


  }


?>
