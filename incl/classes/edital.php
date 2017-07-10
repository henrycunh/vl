<?php
  $regras = array();
  $regrasFmtd = array();
  $IC_LABELS = Edital::getICDesc();;

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

    public static function getICDesc(){
      $data = file_get_contents(dirname(dirname(__DIR__))."/config/descricao_ics.json");
      $data = json_decode($data, true);
      return $data;
    }

  public function getRegrasFormated($conn){
    global $regras;
    global $regrasFmtd;
    global $IC_LABELS;
    $regras = $this->selectRegras($conn);
    // Titulação
    $titGuide = array("grad", "esp", "mest", "doc");
    foreach ($titGuide as $v) {
      parseRegra(function($item) use($v){
        return $item->ic == 'titulacao' && $item->content->tipo == $v;
      }, $IC_LABELS["titulacao"][$v]);
    }

    // Genéricos
    $genericICs = array(
      "artigo" => "",
      "capLivro" => "",
      "corpoEditorial" => "",
      "livro" => "",
      "marca" => "",
      "organizacaoEvento" => "",
      "patente" => "",
      "software" => "",
    );
    foreach ($genericICs as $k => $v)
      parseRegra(function($item) use($k){
        return $item->ic == $k;
      }, $IC_LABELS[$k]);

    // Banca
    $bancaGuide = array("grad", "mest", "doc");
    foreach ($bancaGuide as $k)
      parseRegra(function($item) use($k){
        return $item->ic == "banca" && $item->content->tipo == $k;
      }, $IC_LABELS["banca"][$k]);

    // Orientação
    $orientGuide = array("inic", "grad", "esp", "mest", "doc", "posdoc");
    foreach ($orientGuide as $k)
      parseRegra(function($item) use($k, $IC_LABELS){
        return $item->ic == "orientacao" && $item->content->tipo == $k && isset($IC_LABELS["orientacao"][$k]);
      }, isset($IC_LABELS["orientacao"][$k]) ? $IC_LABELS["orientacao"][$k] : "");

    // trabEvento
    $trabGuide = array("res_nac", "res_inter", "trab_nac", "trab_inter");
    foreach ($trabGuide as $k)
      parseRegra(function($item) use($k, $IC_LABELS){
        return $item->ic == "trabEvento" && $item->content->tipo == $k && isset($IC_LABELS["trabEvento"][$k]);
      }, isset($IC_LABELS["trabEvento"][$k]) ? $IC_LABELS["trabEvento"][$k] : "");

    return $regrasFmtd;
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


  function parseRegra($fn, $label){
    global $regras;
    global $regrasFmtd;
    global $IC_LABELS;

    $found = achar($regras, function($item) use ($fn) { return $fn($item); });

    if(count($found)){
      $found = $found[0];
      if($found->ic != "coordProj"){
        array_push($regrasFmtd, array(
          "label" => $label,
          "ptInd" => $found->ptInd,
          "ptMax" => $found->ptMax,
          "ic" => $found->ic
        ));
      } else {
        array_push($regrasFmtd, array(
          "label" => $IC_LABELS["coordProj"]["concl"],
          "ptInd" => $found->ptInd,
          "ptMax" => $found->ptMax,
          "ic" => $found->ic
        ));
        array_push($regrasFmtd, array(
          "label" => $IC_LABELS["coordProj"]["and"],
          "ptInd" => $found->content->pontIndAnd,
          "ptMax" => $found->content->pontMaxAnd,
          "ic" => $found->ic
        ));
      }
    }
    return 0;
  }

 ?>
