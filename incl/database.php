<?php
  // Conectividade ao Banco de Dados
  // $user = 'kanit563_henriq';
  // $pw = 'D0ctOr$wH0';
  // $host = 'localhost';
  // $db = 'kanit563_validadorlattes';

  $user = 'root';
  $pw = '2811';
  $host = 'localhost';
  $db = 'validadorlattes';
  // Tentar conectar
  try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8;", $user, $pw);
  } catch (Exception $e) {
    die("Erro na conexão: " . $e->getMessage() );
  }


 ?>
