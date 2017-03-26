<?php
  // Setting header content
  header("Content-type: application/json");
  // Starting session
  session_start();
  // Requiring User Class
  require '../incl/classes/usuario.php';
  // Requiring DB
  require_once '../incl/database.php';

  if(!empty($_POST)){
    $data = $_POST;

    // Get User By Email
    if($data['op'] == 'usuario/email') {
      $json = json_encode(Usuario::getUsuarioByEmail($conn, $data['email']));
      echo $json;
    }

    // Autenticate User
    if($data['op'] == 'usuario/autenticar'){
      $candSenha = $data['senha'];
      $usuario = Usuario::getUsuarioByEmail($conn, $data['email']);
      if($usuario){
        $hash = $usuario['senha'];
        if(password_verify($candSenha, $hash)){
          $_SESSION['email'] = $data['email'];
          echo json_encode(["success" => true, "emailFound" => true]);
        } else {
          echo json_encode(["success" => false, "emailFound" => true]);
        }
      } else {
        echo json_encode(["success" => false , "emailFound" => false]);
      }
    }

    // Sign off
    if($data['op'] == 'usuario/desconectar'){
      echo json_encode(["success" => true]);
      session_destroy();
    }


  }




 ?>
