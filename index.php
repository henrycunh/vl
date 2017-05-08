<?php
  session_start();
  $email = (isset($_SESSION['email']) ? $_SESSION['email'] : 0);
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="css/homeStyle.css">
    <title>Validador Lattes</title>
  </head>
  <body>
    <nav>
    <?php if(!$email): ?>
      <a href="login.php">Login</a>
      <a href="cadastrar.php">Cadastrar-se</a>
    <?php else: ?>
      <?= ($_SESSION['privilegios']['pesquisador'] ? '<a href="painel.php">Painel do Pesquisador</a>' : '') ?>
      <?= ($_SESSION['privilegios']['validador'] ? '<a href="painelvalidador.php">Painel do Validador</a>' : '') ?>
      <a href="#">Editais</a>
      <a href="#" id='desconectar'>Desconectar</a>
    <?php endif; ?>
    </nav>
  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.js" charset="utf-8"></script>
  <script src="js/homepage.js" charset="utf-8"></script>
</html>
