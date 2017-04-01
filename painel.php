<?php
  // requirements
  session_start();
  require_once 'incl/database.php';
  require 'incl/classes/usuario.php';
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Painel / Validador Lattes</title>
  </head>
  <body>
    <main class=''>
      <h1>Currículo</h1>
    </main>
    <aside>
      <h1>Painel</h1>
      <div class='info'>
        <a href="alterar_informacoes.php"><span class='glyphicon glyphicon-user icon'></span> Alterar Informações</a>
        <a href='#'><span class='glyphicon glyphicon-open-file icon'></span> Enviar Currículo</a>
        <a href="#"><span class='glyphicon glyphicon-duplicate icon'></span> Enviar Documento</a>
        <a href='#' id='desconectar'><span class='glyphicon glyphicon-log-out icon'></span> Desconectar</a>

      </div>
    </aside>
  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.js" charset="utf-8"></script>
  <script src="js/painel.js" charset="utf-8"></script>
</html>
