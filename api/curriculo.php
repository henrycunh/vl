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

  if($data['op'] == 'curriculo/deletar'){
    $curriculo = Curriculo::getCurriculoByEmail($conn, $_SESSION['email']);
    $curriculo->deleteICs($conn);
    $curriculo->deleteCurriculo($conn);
    // Apagar comprovantes
    echo "id = $curriculo->curriculoId";
    deleteFiles($curriculo->curriculoId);
  }







endif;

function deleteFiles($currId){
  $id = str_pad($currId, 5, "0", STR_PAD_LEFT);
  $files = array_diff(scandir('../uploads/comprovantes/'), array('.', '..'));
  $matches = preg_grep("/$id.{0,}/", $files);
  $matches = preg_filter('/^/', '../uploads/comprovantes/', $matches);
  var_dump($matches);
  array_map('unlink', $matches);
}

 ?>
