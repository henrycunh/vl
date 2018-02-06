<?php
  // Iniciando sessão
  session_start();
  // Conectando com DB
  require 'incl/database.php';
  // Pegando nome do arquivo
  $idEdital = $_SESSION['idEdital'];
  // Declarando arquivo
  $file = $_FILES['editalpdf'];
  // Caminho do arquivo
  $filepath = "uploads/editais/$idEdital-edital.pdf";
  // Salvando arquivo
  move_uploaded_file($file['tmp_name'], $filepath);
  // Inserindo as informações no banco de dados
  $stmt = $conn->prepare("UPDATE edital SET link=:link WHERE idEdital = $idEdital");
  $query = $stmt->execute([
    ":link" => $filepath
  ]);

  if(!$query){
    echo json_encode([
      "success" => false,
      "erro"    => $stmt->errorInfo(),
      "idEdital"     => $idEdital
    ]);
  }
  else{
    echo json_encode([
      "success" => true,
      "idEdital"     => $idEdital
    ]);
  }
 ?>
