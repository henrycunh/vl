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

    public static function getRegra($idEdital,$ic,$ptInd,$ptMax,$content){
      $regra = new self();
      $regra->idEdital = $idEdital;
      $regra->ic = $ic;
      $regra->ptInd = $ptInd;
      $regra->ptMax = $ptMax;
      $regra->content = $content;
      return $regra;
    }

    public static function getRegraFromRaw($raw){
      $regra = new self();
      $regra->idEdital = $raw['idEdital'];
      $regra->ic = $raw['ic'];
      $regra->ptInd = $raw['ptInd'];
      $regra->ptMax = $raw['ptMax'];
      $regra->content = json_decode($raw['content']);
      return $regra;
    }


  }

 ?>
