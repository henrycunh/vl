<?php
session_start();
require 'incl/classes/curriculo.php';
require 'incl/classes/usuario.php';
require 'incl/database.php';


  //Carrega o arquivo
  $file = file_get_contents('uploads/leila.xml');
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
 ?>
