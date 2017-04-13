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
}

 ?>
