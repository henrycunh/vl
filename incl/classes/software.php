<?php
  class Software{
    /*Declaração de atributos*/
    //DADOS-BASICOS-DO-SOFTWARE
    public $natureza;
    public $titulo;
    public $ano;
    public $homepage;
    public $doi;
    //DETALHAMENTO-DO-SOFTWARE
    public $finalidade;
    public $plataforma;
    public $ambiente;
    //AUTORES
    public $autores;


    //Construtor
    public function __construct(){
      $this->natureza = '';
      $this->titulo = '';
      $this->ano = '';
      $this->homepage = '';
      $this->doi = '';
      $this->finalidade = '';
      $this->plataforma = '';
      $this->ambiente = '';
      $this->autores = array();
    }

    //Lista de registros de Software
    public static function getSoftwares($data){
      //Array que será retornado
      $softwares = array();

      //Caso possua registros de softwares
      if(isset($data['PRODUCAO-TECNICA']['SOFTWARE'])):
        $softwaresRaw = $data['PRODUCAO-TECNICA']['SOFTWARE'];

      //Caso possua apenas um registro
      if(array_keys($softwaresRaw)[0] === '@attributes')
        $softwaresRaw = array($softwaresRaw);

      //Percorrer lista
      foreach ($softwaresRaw as $software) {
        //Classe temporária para atribuição
        $software_ = new self();
        //Definição de caminhos
        $dadosB = attr($software['DADOS-BASICOS-DO-SOFTWARE']);
        $details = attr($software['DETALHAMENTO-DO-SOFTWARE']);
        $autores = $software['AUTORES'];

        //dadosB
        $software_->natureza = $dadosB['NATUREZA'];
        $software_->titulo = $dadosB['TITULO-DO-SOFTWARE'];
        $software_->ano = $dadosB['ANO'];
        $software_->homepage = $dadosB['HOME-PAGE-DO-TRABALHO'];
        $software_->doi = $dadosB['DOI'];
        //details
        $software_->finalidade = $details['FINALIDADE'];
        $software_->plataforma = $details['PLATAFORMA'];
        $software_->ambiente = $details['AMBIENTE'];
        //autores
        $software_->autores = getAutores($autores);
    

        //Atribuição da classe temporária no Array
        array_push($softwares, $software_);
      }
    endif;
    return $softwares;
    }
  }

 ?>
