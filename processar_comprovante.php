<?php
  // Iniciando sessão
  session_start();
  // Conectando com DB
  require 'incl/database.php';
  // Pegando nome do arquivo
  $filename = $_SESSION['filename'];
  // Extraindo as informações dele
  $comprovante = explode('-', $filename);
  $comprovante = array("curriculoId" => $comprovante[0], "ic" => $comprovante[1], "idIc" => $comprovante[2]);
  // Declarando arquivo
  $file = $_FILES['comprovante'];
  // Caminho do arquivo
  $filepath = "uploads/comprovantes/" . $filename . ".pdf";
  // Salvando arquivo
  move_uploaded_file($file['tmp_name'], $filepath);
  // Inserindo as informações no banco de dados
  $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $ic = "`ic_" . $comprovante['ic'] . "`";
  $idIc =  $comprovante['idIc'];
  $icCapital = "`id" . ucfirst($comprovante['ic'] . "`");
  $filename = $filename.".pdf";
  $stmt = $conn->prepare("UPDATE $ic SET comprovante=:comprovante WHERE $icCapital = $idIc");
  $stmt->bindParam(':comprovante', $filename);
  $query = $stmt->execute();
  if(!$query){
    echo json_encode(["success" => false, "erro" => $stmt->errorInfo(), "filename"=>$filename]);
  }
  else
    echo json_encode(["success" => true, "filename"=>$filename]);
 ?>
