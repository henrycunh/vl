<?php
  class Marca{
    /*Declaração de atributos*/
    //DADOS-BASICOS-DA-MARCA
    public $titulo;
    public $ano;
    //DETALHAMENTO-DA-MARCA
      //attributes
      public $natureza;
      //REGISTRO-OU-PATENTE > attributes
      public $tipo;
      public $codigo;
      public $tituloPatente;
      public $dataConcessao;
      public $instDeposito; //INSTITUICAO-DEPOSITO-REGISTRO
    //AUTORES
    public $autores;

    //Construtor
    public function __construct(){
      $this->titulo = '';
      $this->ano = '';
      $this->natureza = '';
      $this->tipo = '';
      $this->codigo = '';
      $this->tituloPatente = '';
      $this->instDeposito = '';
      $this->dataConcessao = '';
      $this->autores = array();
    }

    //Pegar lista de marcas
    public static function getMarcas($data){
      //Array temporário para atribuição
      $marcas = array();

      //checa se existe registros de marca
      if(isset($data['PRODUCAO-TECNICA']['MARCA'])):
        $marcasRaw = $data['PRODUCAO-TECNICA']['MARCA'];

      //Caso exista apenas um registro de marca
      if(array_keys($marcasRaw)[0] === '@attributes')
        $marcasRaw = array($marcasRaw);

      //Percorrer lista
      foreach ($marcasRaw as $marca) {
        //Classe temporária para atribuição
        $marca_ = new self();
        //Definição de caminhos
        $dadosB = attr($marca['DADOS-BASICOS-DA-MARCA']);
        $details = attr($marca['DETALHAMENTO-DA-MARCA']);
        $register = attr($marca['DETALHAMENTO-DA-MARCA']['REGISTRO-OU-PATENTE']);
        $autores = $marca['AUTORES'];
        //Atribuições
        $marca_->titulo = $dadosB['TITULO'];
        $marca_->ano = $dadosB['ANO-DESENVOLVIMENTO'];
        $marca_->natureza = $details['NATUREZA'];
        $marca_->tipo = $register['TIPO-PATENTE'];
        $marca_->codigo = $register['CODIGO-DO-REGISTRO-OU-PATENTE'];
        $marca_->tituloPatente = $register['TITULO-PATENTE'];
        $marca_->dataConcessao = $register['DATA-DE-CONCESSAO'];
        $marca_->instDeposito = $register['INSTITUICAO-DEPOSITO-REGISTRO'];
        $marca_->autores = getAutores($autores);

        array_push($marcas, $marca_);
      }
    endif;
    return $marcas;
    }
  }
 ?>
