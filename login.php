<?php
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
    <h1>Login</h1>
    <div class="wrapper">
      <label for="email">E-mail</label>
      <input type="email" id='email' name='email'>
      <div class="erro" id='emailerro'></div>

      <label for="pw">Senha</label>
      <input type="password" id='pw' name='pw'>
      <div class="erro" id='senhaerro'></div>

      <div class="btns">
        <a class='btn' onclick='autenticar()'>Entrar</a>
        <a href="cadastrar.php" class='btn'>Cadastrar</a>
      </div>

      <div id="preloader"></div>
    </div>
  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.js" charset="utf-8"></script>
  <script src="js/autenticarLogin.js" charset="utf-8"></script>
</html>
