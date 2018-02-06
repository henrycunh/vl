<?php
  // requirements
  session_start();
  require_once 'incl/database.php';
  require 'incl/classes/usuario.php';
  require 'incl/classes/curriculo.php';
  require 'incl/classes/sumario.php';
  require 'incl/classes/edital.php';
  // Definindo $email
  $email = (isset($_SESSION['email']) ? $_SESSION['email'] : 0);
  // Definindo usuário
  $usuario = Usuario::selectByEmail($conn, $email);
  $curriculo = $usuario->hasCurriculo($conn);
  $sumarios = $conn->query("SELECT * FROM sumario WHERE curriculoId = " . $curriculo->curriculoId)->fetchAll(PDO::FETCH_ASSOC);
  if(!$email) {header("Location: 502.html"); die();} ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/painelStyle.css">
    <link rel="stylesheet" href="css/curriculoStyle.css">
    <link rel="stylesheet" href="css/semantic.css">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/components/icon.min.css'>
    <link rel="icon" type="image/png" href="imgs/sagalogo.png" />
    <title>Meus Sumários / Plataforma Saga</title>
  </head>
  <body>
      <!-- Barra de navegação -->
      <?php require 'incl/views/navbar.php' ?>
      <!-- Barra de navegação END -->
      <br>
      <br>
      <br>
      <div class="ui segment" style="margin: 1em">
      <?php if(!count($sumarios)):?>
        <div class='ui header centered sub'>
          Você não possui nenhum sumário gerado.
        </div>
      <?php endif; ?>
        <!-- Editais -->
        <div class="ui divided list very relaxed">
        <?php foreach ($sumarios as $sumario) : $edital = Edital::selectById($conn, $sumario['idEdital']); ?>
          <div class="item">
            <a href='ver_sumario.php?hashcode=<?= $sumario['hashcode'] ?>' class="ui  header">
              <?= $edital->nome ?>
            </a>
            <p class='ui sub header description'>
              Pontuação Total:
              <?= $sumario['pontTotal'] ?>
            </p>
          </div>
        <?php endforeach; ?>
        </div>
        <!-- Editais END -->
      </div>
  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.js" charset="utf-8"></script>
  <script src="js/semantic.js" charset="utf-8"></script>
  <script src="js/fileupload.js" charset="utf-8"></script>
  <script src="js/api/log.js" charset="utf-8"></script>
  <script src="js/painel.js" charset="utf-8"></script>
  <script src="js/curriculo.js" charset="utf-8"></script>
  <script src="js/jquery.pseudo.js" charset="utf-8"></script>
  <script src="js/api/curriculo.js" charset="utf-8"></script>
</html>
