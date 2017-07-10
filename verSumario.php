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
  $QRCODE_LINK = "http://validadorlattes.com/verSumario.php?hashcode=$sumario->hashcode";
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

  <!-- Barra de navegação -->
  <div style='border-radius:0; margin-bottom: 0' class='ui inverted segment'>
    <div class="ui inverted huge secondary menu">
      <a class='item active'><img src='imgs/logo.svg' height='32'></a>
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
        <?= (isset($_SESSION['privilegios']['gerenciador']) ? '<a class="ui item" href="painelinst.php">Painel do Instituto</a>' : '') ?>
        <a class='ui item' href="#">Editais</a>
        <a class='ui item' href="#" id='desconectar'>Desconectar</a>
      <?php endif; ?>
      </div>
    </div>
  </div>
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
            <td style='text-align: center'> <?=$ic["pt"]?> </td>
            <td style='text-align: center'> <?=$ic["ptMax"]?> </td>
          </tr>
        <?php endforeach; ?>
      </table>
      <div class="ui segment basic center aligned">
        <div class="ui grid">


          <div class="eight wide column">
            <div class="ui segment center aligned basic">
              <img src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=<?= $QRCODE_LINK?>&choe=UTF-8" alt="">
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
