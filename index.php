<?php
  session_start();
  $email = (isset($_SESSION['email']) ? $_SESSION['email'] : 0);
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="css/homeStyle.css">
    <link rel="stylesheet" href="css/semantic.css">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/components/icon.min.css'>
    <title>Validador Lattes</title>
  </head>
  <body>
    <div style='border-radius:0' class='ui inverted segment'>
      <div class="ui inverted huge secondary menu">
        <a class='item active'>Home</a>
        <div class="right menu">
      <?php if(!$email): ?>
        <a class='ui item' href="login.php">
          <i class='sign in icon'></i>
          Login
        </a>
        <a class='ui item' href="cadastrar.php">
          <i class='add user icon'></i>
          Cadastrar-se
        </a>
      <?php else: ?>
        <?= (isset($_SESSION['privilegios']['pesquisador']) ? '<a class="ui item" href="painel.php">Painel do Pesquisador</a>' : '') ?>
        <?= (isset($_SESSION['privilegios']['validador']) ? '<a class="ui item" href="painelvalidador.php">Painel do Validador</a>' : '') ?>
        <a class='ui item' href="#">Editais</a>
        <a class='ui item' href="#" id='desconectar'>Desconectar</a>
      <?php endif; ?>
      </div>
    </div>
    </div>

  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.js" charset="utf-8"></script>
  <script src="js/homepage.js" charset="utf-8"></script>
</html>
