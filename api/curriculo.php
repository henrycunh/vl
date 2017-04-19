<?php
// Setting header content
header("Content-type: application/json");
// Starting session
session_start();
// Requiring User Class
require '../incl/classes/usuario.php';
require '../incl/classes/curriculo.php';
// Requiring DB
require_once '../incl/database.php';

if(!empty($_POST)):
  $data = $_POST;

  if($data['op'] == 'curriculo/'){
    $email = $data['email'];
    echo json_encode(Curriculo::getCurriculoByEmail($conn, $email));
  }

  if($data['op'] == 'curriculo/comprovante'){
    $filename = $data['filename'];
    $_SESSION['filename'] = $filename;
    echo json_encode(['success' => true]);
  }







endif;
 ?>
