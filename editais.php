<?php
  session_start();
  require 'incl/classes/usuario.php';
  require 'incl/database.php';
  require 'incl/classes/edital.php';
  require 'incl/classes/regra.php';
  require 'incl/classes/sumario.php';
  require 'incl/classes/curriculo.php';

  $email = (isset($_SESSION['email']) ? $_SESSION['email'] : 0);
  $editais = Edital::selectEditais($conn);
  $navbar_relative = true;

?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="css/homeStyle.css">
    <link rel="stylesheet" href="css/semantic.css">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/components/icon.min.css'>
    <link rel="icon" type="image/png" href="imgs/sagalogo.png" />
    <title>Editais / Plataforma Saga</title>
  </head>
  <body>

  <!-- Barra de navegação -->
  <?php require 'incl/views/navbar.php' ?>
  <!-- Barra de navegação END -->

  <div class="ui segment" style="margin: 1em">
  <?php if(!count($editais)):?>
    <div class='ui header centered sub'>
      Não existem Editais cadastrados.
    </div>
  <?php endif; ?>
    <!-- Editais -->
    <div class="ui divided list very relaxed">
    <?php foreach ($editais as $edital) : ?>
      <div class="item">
        <a href='edital.php?numero=<?= $edital->numero ?>' class="ui header">
          <?= $edital->nome ?>
        </a>
        <div class="description">
          <?= $edital->descricao ?>
          <div class="ui sub header">
            <?= date("d/m/Y", strtotime($edital->vigencia)) ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    </div>
    <!-- Editais END -->


  </div>
  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.js" charset="utf-8"></script>
  <script src="js/homepage.js" charset="utf-8"></script>
  <script src="js/edital.js" charset="utf-8"></script>
</html>
