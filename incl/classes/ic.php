<?php
// Classe com alguns atributos padrões para todos os ICs
class IC{
  public $idValidador;
  public $dataValidacao;
  public $validado;
  public $comprovante;

  public function __construct(){
    $this->idValidador = '';
    $this->dataValidacao = '';
    $this->validado = '';
    $this->comprovante = '';
  }

  public function cleanVal(){
    $this->idValidador = '';
    $this->dataValidacao = '';
    $this->validado = '';
    $this->comprovante = '';
  }

  public function setVal($values){
    $this->idValidador = $values['idValidador'];
    $this->dataValidacao = $values['dataValidacao'];
    $this->validado = $values['validado'];
    $this->comprovante = $values['comprovante'];
  }
}

 ?>
