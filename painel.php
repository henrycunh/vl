<?php
  // requirements
  session_start();
  require_once 'incl/database.php';
  require 'incl/classes/usuario.php';
  require 'incl/classes/curriculo.php';
  // Definindo $email
  $email = (isset($_SESSION['email']) ? $_SESSION['email'] : 0);
  // Definindo usuário
  // $usuario = Usuario::getUsuarioByEmail($conn, $email);
  if(!$email):
 ?>
 <script type="text/javascript">
   window.location.replace("index.php");
 </script>
 <?php endif; ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/painelStyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Painel / Validador Lattes</title>
  </head>
  <body>
    <main>
      <h1>Currículo</h1>
      <div class="curriculo">
      <?php if(Curriculo::getCurriculoByEmail($conn, $email)): ?>

      <?php else: ?>
        Este usuário ainda não enviou um currículo. <br>Use a barre lateral para enviar o seu Currículo Lattes.
      <?php endif; ?>
      </div>

    </main>
    <aside>
      <h1>Painel</h1>
      <div class='info'>
        <a href="alterar_informacoes.php"><span class="fa fa-user-circle icon"></span> Alterar Informações</a>
        <a href='#' id='enviarcurriculo'><span class='fa fa-file icon'></span> Enviar Currículo</a>
        <a href="#"><span class='fa fa-folder icon'></span> Enviar Documento</a>
        <a href='#' id='desconectar'><span class='fa fa-sign-out icon'></span> Desconectar</a>

      </div>
    </aside>
  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.js" charset="utf-8"></script>
  <script src="js/fileupload.js" charset="utf-8"></script>
  <script src="js/painel.js" charset="utf-8"></script>
</html>
