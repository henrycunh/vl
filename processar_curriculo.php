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
  if(!$curriculoId)
    $conn->query("INSERT INTO curriculo(email) VALUES('" . $_SESSION['email'] . "')");
  // Repete o query
  $curriculoId = Curriculo::getIDByEmail($conn, $_SESSION['email']);
  // Criando o objeto Curriculo a partir do XML
  $curriculo = Curriculo::getCurriculo($data, $curriculoId);
  // Inserindo no DB
  $curriculo->insertAllIntoDB($conn);

  // echo json_encode($currFromDB, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
  // Objeto de retorno ao request
  echo json_encode($curriculo, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>
