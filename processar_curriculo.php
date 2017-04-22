<?php
  // Iniciando sessão
  session_start();
  // Importando as classes de Curriculo os ICs
  require 'incl/classes/curriculo.php';
  // Conexão com o DB
  require 'incl/database.php';
  // Define o tipo de conteudo
  header("Content-type: application/json; charset=UTF-8;");

  //Carrega o arquivo
  $file = file_get_contents($_FILES['curriculo']['tmp_name']);
  // Substitui quebras de linha
  $file = str_replace(array("\n", "\r", "\t"), '', $file);
  // Remove espaços múltiplos
  $file = preg_replace('/\s+/', ' ', $file);
  // Dá parse no XML
  $xml = simplexml_load_string($file);
  // Transforma para JSON
  $json = json_encode($xml, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
  // Transforma para Array
  $data = json_decode($json, TRUE);

  // Pegando curriculoId a partir do e-mail na sessão
  $curriculoId = Curriculo::getIDByEmail($conn, $_SESSION['email']);
  // Caso não exista um, vincula um curriculo para esse usuário
  if(!$curriculoId){
    $query = $conn->query("INSERT INTO curriculo(email) VALUES('" . $_SESSION['email'] . "')");
    if(!$query){
      print_r($conn->errorInfo());
    }
  }
  // Repete o query
  $curriculoId = Curriculo::getIDByEmail($conn, $_SESSION['email']);
  // Criando o objeto Curriculo a partir do XML
  $curriculo = Curriculo::getCurriculo($data, $curriculoId);
  $clAtual = Curriculo::getCurriculoByID($conn, $curriculoId);
  $diff = Curriculo::compararCurriculos($clAtual, $curriculo);
  // Inserindo no DB
  $diff->insertAllIntoDB($conn);
  // Pegando o curriculo de novo, para exibição
  $clAtual = Curriculo::getCurriculoByID($conn, $curriculoId);
  // Objeto de retorno ao request
  echo json_encode($clAtual, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>
