<?php
  class Regra{
    public $idEdital;
    public $ic;
    public $ptInd;
    public $ptMax;
    public $content;

    public function __construct(){
      $this->idEdital = '';
      $this->ic = '';
      $this->ptInd = '';
      $this->ptMax = '';
      $this->content = '';
    }

    public function getRegra($idEdital,$ic,$ptInd,$ptMax,$content){
      $regra = new self();
      $regra->idEdital = $idEdital;
      $regra->ic = $ic;
      $regra->ptInd = $ptInd;
      $regra->ptMax = $ptMax;
      $regra->content = $content;
      return $regra;
    }


  }

 ?>
