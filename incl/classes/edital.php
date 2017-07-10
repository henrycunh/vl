<?php

  class Edital{
    public $nome;
    public $numero;
    public $link;
    public $descricao;
    public $idEdital;
    public $vigencia;
    public $dataCriacao;
    public $regras;
    public $visibilidade;
    public $pontMax;

    public function __construct(){
      $this->nome = '';
      $this->numero = '';
      $this->link = '';
      $this->idEdital = '';
      $this->descricao = '';
      $this->vigencia = '';
      $this->dataCriacao = '';
      $this->regras = '';
      $this->visibilidade = '';
      $this->pontMax = '';
    }

    public static function getEdit($nome,$numero,$link,$idEdital,$vigencia,$dataCriacao,$descricao,$regras){
      $edital = new self();
      $edital->nome = $nome;
      $edital->numero = $numero;
      $edital->link = $link;
      $edital->idEdital = $idEdital;
      $edital->vigencia = $vigencia;
      $edital->dataCriacao = $dataCriacao;
      $edital->descricao = $descricao;
      $edital->regras = $regras;
      $edital->visibilidade = 0;
      $edital->pontMax = 100;
      return $edital;
    }

    public static function selectEditais($conn){
      $editaisArr = array();
      $editais = $conn->query("SELECT * FROM edital")->fetchAll(PDO::FETCH_ASSOC);
      foreach($editais as $edital){
        array_push($editaisArr, rawToObj($edital));
      }
      return $editaisArr;
    }

    public static function selectByNumero($conn, $numero){
      $editalRaw = $conn->query("SELECT * FROM edital WHERE numero = '$numero'")->fetch(PDO::FETCH_ASSOC);
      return rawToObj($editalRaw);
    }

    public static function selectById($conn, $id){
      $editalRaw = $conn->query("SELECT * FROM edital WHERE idEdital = $id")->fetch(PDO::FETCH_ASSOC);
      return rawToObj($editalRaw);
    }


    public function selectRegras($conn){
      $id = $this->idEdital;
      $regras = $conn->query("SELECT * FROM regra WHERE idEdital = $id")->fetchAll(PDO::FETCH_ASSOC);
      $regrasArr = array();
      foreach ($regras as $regra)
        array_push($regrasArr, Regra::getRegraFromRaw($regra));
      return $regrasArr;
    }
  }

  function rawToObj($raw){
    $edital = new Edital();
    $edital->nome = $raw['nome'];
    $edital->numero = $raw['numero'];
    $edital->link = $raw['link'];
    $edital->idEdital = $raw['idEdital'];
    $edital->vigencia = $raw['vigencia'];
    $edital->dataCriacao = $raw['dataCriacao'];
    $edital->descricao = $raw['descricao'];
    $edital->visibilidade = $raw['visibilidade'];
    $edital->pontMax = $raw['pontMax'];
    return $edital;
  }

 ?>
