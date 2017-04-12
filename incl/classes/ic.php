<?php
// Classe com alguns atributos padrões para todos os ICs
class IC{
  public $idVadidador;
  public $dataValidacao;
  public $validado;
  public $comprovante;

  public function __construct(){
    $this->idVadidador = '';
    $this->dataValidacao = '';
    $this->validado = '';
    $this->comprovante = '';
  }
}

 ?>
