<?php
  class OrganizacaoEvento{
    /*Declaração de atributos*/
    //DADOS-BASICOS-DA-ORGANIZACAO-DE-EVENTO -> $attributes
    public $tipo;
    public $natureza;
    public $titulo;
    public $ano;
    public $idioma;
    public $pais;
    public $homepage;
    public $doi;
    //DETALHAMENTO-DA-ORGANIZACAO-DE-EVENTO -> @attributes
    public $instituicaoPromotora;
    public $cidade;
    //AUTORES -> @attributes
    public $autores;

    //Construtor
    public function __construct(){
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
    }

    //Pegar lista de organizações de eventos
    public static function getOrganizacaoEvento($data){
      //array que será retornado
      $organizacaoEventos = array();

      //Caso possua organização de eventos
      if(isset($data['PRODUCAO-TECNICA']['DEMAIS-TIPOS-DE-PRODUCAO-TECNICA']['ORGANIZACAO-DE-EVENTO'])):
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
    endif;
    return $organizacaoEventos;
    }
  }

 ?>
