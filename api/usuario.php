<?php
  // Starting session
  session_start();
  // Requiring User Class
  require '../incl/classes/usuario.php';
  // Requiring DB
  require_once '../incl/database.php';
  // Setting header content
  header("Content-type: application/json");

  if(!empty($_POST)){
    $data = $_POST;

    // Get User By Id
    if($data['op'] == 'usuario/id') {
      $json = json_encode(Usuario::getUsuarioById($conn, $data['id']));
      echo $json;
    }

    // Get User By Email
    if($data['op'] == 'usuario/email') {
      $json = json_encode(Usuario::getUsuarioByEmail($conn, $data['email']));
      echo $json;
    }

    // Autenticate User
    if($data['op'] == 'usuario/autenticar'){
      $candSenha = $data['senha'];
      $hash = Usuario::getUsuarioById($conn, $data['id'])['senha'];
      if(password_verify($candSenha, $hash)){
        $_SESSION['idUsuario'] = $data['id'];
        echo json_encode(["success" => true]);
      } else {
        echo json_encode(["success" => false]);
      }
    }

    // Sign off
    if($data['op'] == 'usuario/desconectar'){
      echo json_encode(["success" => true]);
      session_destroy();
    }


  }




 ?>
