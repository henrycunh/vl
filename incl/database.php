<?php
  // // Conectividade ao Banco de Dados
  // $user = 'kanit563_vl';
  // $pw = '096lSwiSLAnw';
  // $host = 'localhost';
  // $db = 'kanit563_vl';
  //
  $user = 'root';
  $pw = '';
  $host = 'localhost';
  $db = 'validadorlattes';

  // Tentar conectar
  try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8;", $user, $pw);
    $conn->query("SET NAMES utf8");
  } catch (Exception $e) {
    die("Erro na conexão: " . $e->getMessage() );
  }


 ?>
