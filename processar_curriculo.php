<?php
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

  // Criando o objeto Curriculo a partir do XML
  $curriculo = Curriculo::getCurriculo($data);
  // Inserindo no DB
  $curriculo->insertIntoDB($conn);
  /* Armazenamento dos dados no Banco de Dados */



  // Objeto de retorno ao request
  echo json_encode($curriculo, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);


?>
