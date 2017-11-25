<?php
  session_start();
  require 'incl/classes/usuario.php';
  require 'incl/database.php';
  require 'incl/classes/edital.php';
  require 'incl/classes/regra.php';
  require 'incl/classes/sumario.php';
  require 'incl/classes/curriculo.php';
  if(!empty($_GET['numero'])){
      $numero = $_GET['numero'];
  } else {
      header("Location: 502.html");
      die();
  }
  $email = (isset($_SESSION['email']) ? $_SESSION['email'] : 0);
  $edital = Edital::selectByNumero($conn, $numero);
  $applied = false;
  $navbar_relative = true;
  $edId = $conn->query("SELECT idEdital FROM edital WHERE numero = '$numero'")->fetch(PDO::FETCH_ASSOC)["idEdital"];
  if($email){
    $cId = Curriculo::getIDByEmail($conn, $_SESSION["email"]);
    if($cId){
      $applied = Sumario::checkSumario($cId, $edId, $conn);
      $sumario = $applied ? Sumario::selectSumario($cId, $edId, $conn) : new Sumario();
    }
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="css/homeStyle.css">
    <link rel="stylesheet" href="css/semantic.css">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/components/icon.min.css'>
    <link rel="icon" type="image/png" href="imgs/sagalogo.png" />
    <title>Edital / Plataforma Saga</title>
  </head>
  <body>

  <!-- Barra de navegação -->
  <?php require 'incl/views/navbar.php' ?>
  <!-- Barra de navegação END -->

  <!-- GRID START -->
  <div class="ui grid">
    <!-- CONTEÚDO DO EDITAL -->
    <div class="eight wide column">
      <div class="ui segment" style='margin: 2em 1em'>
        <div class="ui header">
          <?= $edital->nome ?>
          <div class="ui sub header">
            <?= $edital->numero ?> | Vigência: <?= date("d/m/Y",strtotime($edital->vigencia)) ?>
          </div>
        </div>
        <div class="ui segment basic">
          <?= $edital->descricao ?>
        </div>
        <!-- APLICAÇÃO -->
        <?php if(isset($_SESSION['privilegios']['pesquisador']) && !$applied): ?>
          <div class="ui segment center aligned basic">
            <div onclick="aplicarEdital('<?= $numero ?>')" class="ui button large green right labeled icon">
              <i class='checkmark icon'></i>
              Gerar Sumário
            </div>
          </div>
        <?php elseif($applied): ?>
          <div class="ui segment center aligned basic">
            <a href='ver_sumario.php?hashcode=<?= $sumario->hashcode ?>' class="ui button large blue right labeled icon">
              <i class='eye icon'></i>
              Ver sumário
            </a>
          </div>
        <?php endif; ?>
        <!-- APLICAÇÃO END -->
      </div>
    </div>
    <!-- CONTEÚDO DO EDITAL END -->

    <!-- REGRAS DO EDITAL -->
    <div class="eight wide column">
      <?php $regras = $edital->getRegrasFormated($conn);?>
      <div class="ui segment" style="margin: 2em 1em; padding: 1em 1em">
        <div class="ui header center aligned">
          <h1>Regras de Pontuação</h1>
        </div>
        <table class='ui table celled stripped padded'>
          <tr>
            <th>Tipo de Produção</th>
            <th>Pontuação Individual</th>
            <th>Pontuação Máxima</th>
          </tr>
          <?php foreach ($regras as $regra): ?>
            <tr>
              <td><?= $regra["label"] ?></td>
              <td style='text-align: center'><?= $regra["ptInd"] == 0 ? "<b style='color:#BBB'>X</b>" : $regra["ptInd"] ?></td>
              <td style='text-align: center'><?= $regra["ptMax"] == 0 ? "<b style='color:#BBB'>X</b>" : $regra["ptMax"] ?></td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
    </div>
    <!-- REGRAS DO EDITAL END -->
  </div>
<!-- GRID END -->
  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.js" charset="utf-8"></script>
  <script src="js/api/log.js" charset="utf-8"></script>
  <script src="js/homepage.js" charset="utf-8"></script>
  <script src="js/edital.js" charset="utf-8"></script>
</html>
