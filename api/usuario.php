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

    // Update User
    if($data['op'] == 'usuario/atualizar'){
      $user = $data['user'];
      $email = $data['email'];
      $usuario = Usuario::create(
        $user['nomeCompleto'],
        $user['email'],
        $user['dataNascimento'],
        $user['genero'],
        $user['cpf'],
        $user['rg'],
        $user['endereco'],
        $user['cep'],
        $user['telefone'],
        "",
        ""
      );
      $usuario->update($conn, $email);
      $_SESSION['email'] = $user['email'];
      $json = json_encode(['success' => 'true']);
      echo $json;
    }

    // Mudar Senha
    if($data['op'] == 'usuario/mudarsenha'){
      $email = $data['email'];
      $pw = $data['pw'];
      $usuario = new Usuario();
      $usuario->setEmail($email);
      $usuario->setSenha($pw);
      $usuario->changePassword($conn);
      $json = json_encode(['success' => 'true']);
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
