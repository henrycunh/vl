<?php
  // Conectividade ao Banco de Dados
  $user = 'root';
  $pw = '';
  $host = 'localhost';
  $db = 'validadorlattes';

  // Tentar conectar
  try {
    $conn = new PDO("mysql:host=$host;dbname=$db;", $user, $pw);
  } catch (Exception $e) {
    die("Erro na conexão: " . $e->getMessage() );
  }


 ?>
