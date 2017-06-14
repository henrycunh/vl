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
    <link rel="stylesheet" href="css/semantic.css">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/components/icon.min.css'>
    <link rel="stylesheet" href="css/loginStyle.css">
    <title>Login / Validador Lattes</title>
  </head>
  <body>
<div class="ui middle aligned center aligned grid">
  <div class="column">
    <h2 class="ui image header">
      <div class="content">
        Acesse sua conta
      </div>
    </h2>
    <div class="ui large form">
      <div  class="ui stacked secondary segment">
        <div class="field">
          <div class="ui left icon attached input">
            <i class="user icon"></i>
            <input type="email" name="email" id='email' placeholder="E-mail">
          </div>
          <div class="ui pointing red basic label hidden" id='emailerro'></div>
        </div>
        <div class="field">
          <div class="ui left icon attached input">
            <i class="lock icon"></i>
            <input type="password" name="pw" id='pw' placeholder="Senha">
          </div>
          <div class="ui pointing red basic label hidden" id='senhaerro'></div>
        </div>
        <div id='wrap' class="ui fluid large teal submit button" onclick="autenticar()">Login</div>
      </div>
    </div>

    <div class="ui basic message">
      Não possui uma conta? <a href="cadastrar.php">Cadastre-se</a>
    </div>
    <div class="ui segment basic center aligned small"><a href="index.php">Voltar</a>
    </div>
  </div>
</div>

  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.js" charset="utf-8"></script>
  <script src="js/autenticarLogin.js" charset="utf-8"></script>
</html>
