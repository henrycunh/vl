<?php
  session_start();
  require 'incl/classes/usuario.php';
  require 'incl/database.php';
  require 'incl/classes/edital.php';
  require 'incl/classes/regra.php';
  require 'incl/classes/sumario.php';
  require 'incl/classes/curriculo.php';
  if(!empty($_GET['hashcode'])){
      $hashcode = $_GET['hashcode'];
  } else {
      header("Location: 502.html");
      die();
  }
  $email = (isset($_SESSION['email']) ? $_SESSION['email'] : 0);
  $sumario = Sumario::selectSumarioByHash($hashcode, $conn);
  $curriculo = Curriculo::getCurriculoByID($conn, $sumario->curriculoId);
  $usuario = Usuario::selectByEmail($conn, $email);
  $navbar_relative = true;
  $edital = Edital::selectById($conn, $sumario->idEdital);
  $QRCODE_LINK = "http://validadorlattes.com/verSumario.php?hashcode=$sumario->hashcode";
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="css/homeStyle.css">
    <link rel="stylesheet" href="css/semantic.css">
    <link rel="icon" type="image/png" href="imgs/sagalogo.png" />
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/components/icon.min.css'>
    <title>Sumário / Plataforma Saga</title>
  </head>
  <body>

  <!-- Barra de navegação -->
  <?php require 'incl/views/navbar.php' ?>
  <!-- Barra de navegação END -->

  <!-- GRID START -->
  <div class="ui segment secondary" style='margin: 1em 5em'>
    <div class="ui header center aligned">
      Sumário
    </div>
    <div class="ui segment">
      <div class="ui grid">
        <div class="eight wide column">
          <b>Nome do Pesquisador:</b> <?= $usuario->nomeCompleto ?><br>
        </div>
        <div class="eight wide column">
          <b>Data de criação do Sumário:</b> <?= date("d/m/Y", strtotime($sumario->dataPont)) ?><br>
          <b>Número do Edital:</b> <?= $edital->numero ?>
        </div>
      </div>
      <div class="ui divider"></div>
      <div class="ui segment tertiary right aligned">
        <form action="exportPDF.php" method="post" target='_blank'>
          <input type="hidden" name="doc" value="sumario">
          <input type="hidden" name="curriculoId" value="<?= $sumario->curriculoId ?>">
          <input type="hidden" name="idEdital" value="<?= $sumario->idEdital ?>">
          <input type="submit" class='ui button blue' value='Exportar PDF'>
        </form>
      </div>
      <table class='ui table celled striped padded'>
        <tr>
          <th style='width: 90%'>Tipo de Produção</th>
          <th style='width: 5%'>Pontos Obtidos</th>
          <th style='width: 5%'>Pontuação Máxima</th>
        </tr>
        <?php foreach ($sumario->getFormatedContent() as $ic): ?>
          <tr>
            <td> <?=$ic["label"]?> </td>
            <td style='text-align: center'> <?= empty($ic["pt"]) ? "0" : $ic["pt"] ?> </td>
            <td style='text-align: center'> <?= empty($ic["ptMax"]) ? "0" : ($ic["ptMax"] == "-1" ? "<b style='color:#777'>S.L</b>" : $ic["ptMax"]) ?> </td>
          </tr>
        <?php endforeach; ?>
      </table>
      <div class="ui segment basic center aligned">
        <div class="ui grid">


          <div class="eight wide column">
            <div class="ui segment center aligned basic">
              <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=<?= $QRCODE_LINK?>&choe=UTF-8" alt="">
            </div>
          </div>

          <div class="eight wide column">
            <div class="ui header">
              Pontuação Total
              <div class="ui sub header" style='font-size: 1.5em'>
                <?= $sumario->pontTotal ?>
              </div>
            </div>
            <div class="ui divider"></div>
            <b>Assinatura Digital:</b> <?= $sumario->hashcode ?>
          </div>

        </div>
    </div>
    </div>
  </div>
  <!-- GRID END -->
  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.js" charset="utf-8"></script>
  <script src="js/homepage.js" charset="utf-8"></script>
  <script src="js/edital.js" charset="utf-8"></script>
</html>
