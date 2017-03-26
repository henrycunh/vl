<?php
  session_start();
  $idUsuario = (isset($_SESSION['idUsuario']) ? $_SESSION['idUsuario'] : 0);
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="css/headerStyle.css">

  </head>
  <body>
    <nav>
    <?php if(!$idUsuario): ?>
      <a href="login.php">Login</a>
      <a href="cadastrar.php">Cadastrar-se</a>
    <?php else: ?>
      <a href="#">Meu Painel</a>
      <a href="#">Editais</a>
      <a href="#" id='desconectar'>Desconectar<div id="preloader"></div></a>
    <?php endif; ?>
    </nav>
  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.js" charset="utf-8"></script>
  <script src="js/homepage.js" charset="utf-8"></script>
</html>
