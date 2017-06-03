<?php
  session_start();
  require 'incl/classes/curriculo.php';
  require 'incl/classes/usuario.php';
  require 'incl/classes/regra.php';
  require 'incl/classes/edital.php';
  require 'incl/database.php';


  pontuar(3, 1, $conn);





  function pontuar($cId, $edId, $conn){
    $pontuacao = 0;

    // Pegando as regras
    $edital = Edital::selectById($conn, $edId);
    $regras = classify($edital->selectRegras($conn));
    // Pegando curriculo
    $curriculo = Curriculo::getCurriculoByID($conn,$cId);
    /**********************************************
     *  PONTUAÇÃO DE ITENS DE CURRICULO VALIDADOS *
     **********************************************/
    // ARTIGO
    foreach ($regras['artigo'] as $regra) {
      // Rule Data
      $ptInd = $regra->ptInd;
      $ptMax = $regra->ptMax;
      $maxNum = $ptMax / $ptInd;
      $ano = $regra->content->ano;
      $pais = $regra->content->pais;
      // Rules
      $rule = array(
        ($ano == 'false' ? '' : "ano = '$ano'"),
        ($pais == 'false' ? '' : ($pais == 'nacional' ? "idioma = 'Português'" : "idioma = 'Inglês'"))
      );
      $sqlrule = (count($rule) > 0 ? " WHERE " : '');
      foreach($rule as $r) if($r != '') $sqlrule .= " $r AND";
      $sqlrule = rtrim($sqlrule, " AND");
      $SQL = "SELECT (COUNT(idArtigo) * $ptInd) as pont FROM (SELECT idArtigo FROM ic_artigo$sqlrule LIMIT $maxNum) as Q;";

      $pontuacao += $conn->query($SQL)->fetch(PDO::FETCH_ASSOC)['pont'];
    }
    echo $pontuacao;
  }


  function classify($regras){
    $result = array();
    $ics = array('titulacao', 'artigo');
    foreach ($ics as $ic){
      $ic_ = $ic;
      $result[$ic] = array_filter($regras, function($value) use($ic){ return $value->ic == $ic; });
    }
    return $result;
  }

  function getValidated($ics){
    return array_filter($ics, function($ic){
      return $ic->validado == 1;
    });
  }


  function debug($data){
    echo "<pre>" . var_export($data, true) . "</pre>";
  }


?>
