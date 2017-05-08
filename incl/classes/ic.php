<?php
// Classe com alguns atributos padrões para todos os ICs
class IC{
  public $emailValidador;
  public $dataValidacao;
  public $validado;
  public $comprovante;

  public function __construct(){
    $this->emailValidador = '';
    $this->dataValidacao = '';
    $this->validado = '';
    $this->comprovante = '';
  }

  public function cleanVal(){
    $this->emailValidador = '';
    $this->dataValidacao = '';
    $this->validado = '';
    $this->comprovante = '';
  }

  public function setVal($values){
    $this->emailValidador = $values['emailValidador'];
    $this->dataValidacao = $values['dataValidacao'];
    $this->validado = $values['validado'];
    $this->comprovante = $values['comprovante'];
  }
}

 ?>
