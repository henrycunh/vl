<?php
  class Patente{
    /*Declaração de atributos*/
    //DADOS-BASICOS-DA-PATENTE -> attributes
    public $titulo;
    public $ano;
    public $homepage;
    //DETALHAMENTO-DA-PATENTE
      //attributes
      public $categoria;
      //REGISTRO-OU-PATENTE -> attributes
      public $tipo;
      public $codigo;
      public $tituloPatente;
      public $instituicaoDeposito;
      public $nomeTitular;
      public $dataConcessao;
    //AUTORES
    public $autores;

    //Construtor
      public function __construct(){
        $this->titulo = '';
        $this->ano = '';
        $this->homepage = '';
        $this->categoria = '';
        $this->tipo = '';
        $this->codigo = '';
        $this->tituloPatente = '';
        $this->instituicaoDeposito = '';
        $this->nomeTitular = '';
        $this->dataConcessao = '';
        $this->autores = array();
      }

      //Pegar lista de patentes
      public static function getPatentes($data){
        //array que será retornado
        $patentes = array();

        //Caso possua patentes
        if(isset($data['PRODUCAO-TECNICA']['PATENTE'])):
          $patentesRaw = $data['PRODUCAO-TECNICA']['PATENTE'];

        //Caso possua apenas um registro
        if(array_keys($patentesRaw)[0] === '@attributes')
          $patentesRaw = array($patentesRaw);

        //Percorrer lista de patentes
        foreach ($patentesRaw as $patente) {
          //Classe temporária para atribuir valores
          $patente_ = new self();
          // var_dump($patente);
          //Definição de caminhos
          $dadosB = attr($patente['DADOS-BASICOS-DA-PATENTE']);
          $details = attr($patente['DETALHAMENTO-DA-PATENTE']);
          $registro = attr($patente['DETALHAMENTO-DA-PATENTE']['REGISTRO-OU-PATENTE']);
          $autores = $patente['AUTORES'];

          //dadosB
          $patente_->titulo = $dadosB['TITULO'];
          $patente_->ano = $dadosB['ANO-DESENVOLVIMENTO'];
          $patente_->homepage = $dadosB['HOME-PAGE'];
          //DETALHAMENTO-DA-PATENTE
            //attributes
            $patente_->categoria = $details['CATEGORIA'];
            //REGISTRO-OU-PATENTE
            $patente_->tipo = $registro['TIPO-PATENTE'];
            $patente_->codigo = $registro['CODIGO-DO-REGISTRO-OU-PATENTE'];
            $patente_->tituloPatente = $registro['TITULO-PATENTE'];
            $patente_->instituicaoDeposito = $registro['INSTITUICAO-DEPOSITO-REGISTRO'];
            $patente_->nomeTitular = $registro['NOME-DO-TITULAR'];
            $patente_->dataConcessao = $registro['DATA-DE-CONCESSAO'];
          //AUTORES
          $patente_->autores = getAutores($autores);

          //Atribuição da classe no Array
          array_push($patentes, $patente_);
        }
      endif;
      return $patentes;
      }
  }
 ?>
