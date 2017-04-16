<?php
  // sessão
  session_start();
  $email = (isset($_SESSION['email']) ? $_SESSION['email'] : 0);
  if($email) header("url=index.php");
  // Requerindo DB
  require_once 'incl/database.php';
  // Importando Classe Usuário
  require 'incl/classes/usuario.php';
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/loginStyle.css">
    <title>Login / Validador Lattes</title>
  </head>
  <body>
    <h1>Validador <b>Lattes</b></h1>
    <div class="wrapper">
      <label for="email" id='emaillabel'>E-mail</label>
      <input type="email" id='email' name='email' placeholder="E-mail">
      <div class="erro" id='emailerro'></div>

      <label for="pw" id='pwlabel'>Senha</label>
      <input type="password" id='pw' name='pw' placeholder="Senha">
      <div class="erro" id='senhaerro'></div>

      <div class="btns">
        <a class='btn' id='entrar' onclick='autenticar()'>Entrar</a>
      </div>
      <span class='signuplabel'>Não possui uma conta? <a href="cadastrar.php">Criar Conta</a></span>
    </div>
    <a href="index.php" class='back'>Voltar</a>
  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.js" charset="utf-8"></script>
  <script src="js/autenticarLogin.js" charset="utf-8"></script>
</html>
