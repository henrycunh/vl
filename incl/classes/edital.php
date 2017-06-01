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

    public function __construct(){
      $this->nome = '';
      $this->numero = '';
      $this->link = '';
      $this->idEdital = '';
      $this->descricao = '';
      $this->vigencia = '';
      $this->dataCriacao = '';
      $this->regras = '';
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
      return $edital;
    }

    public static function selectByNumero($conn, $numero){
      $editalRaw = $conn->query("SELECT * FROM edital WHERE numero = '$numero'")->fetch(PDO::FETCH_ASSOC);
      return rawToObj($editalRaw);
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
    return $edital;
  }

 ?>