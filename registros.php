<?php
  // requirements
  session_start();
  require_once 'incl/database.php';
  require 'incl/classes/usuario.php';
  require 'incl/classes/curriculo.php';
  require 'incl/classes/log.php';
  // Definindo $email
  $email = (isset($_SESSION['email']) ? $_SESSION['email'] : 0);
  // Checando privilégios
  $inst_val = $_SESSION['privilegios']['gerenciador'];
  if(!$inst_val) die("Acesso não autorizado.");
  if(!$email){
    header("Location: 502.html"); die();
  }
  // Definindo usuário
  $usuario = Usuario::selectByEmail($conn, $email);
  // Paginação
  $logs = Log::getAll();
  $page = isset($_GET['page']) ? $_GET['page'] : 1;
  $page_limit = 10;
  ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/painelValidadorStyle.css">
    <link rel="stylesheet" href="css/semantic.css">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/components/icon.min.css'>
    <link rel="icon" type="image/png" href="imgs/sagalogo.png" />
    <title>Painel / Plataforma Saga</title>
  </head>
  <body>
    <aside>
      <div class="ui segment inverted basic">
        <h4 class='ui header inverted'>
          Painel da Instituição
          <div class="ui sub header">
            Propex - IFS
          </div>
        </h4>
      </div>
      <div class="ui padded inverted segment">
      <div class="ui fluid vertical labeled large icon buttons">
          <a class='ui button' href='controle_validadores.php'>
            <i class='user icon'></i>
            Validadores
          </a>
          <a class='ui button' href='#' id='desconectar'>
            <i class='sign out right icon'></i>
            Desconectar
          </a>
          <a class='ui button' href='index.php'>
            <i class='chevron left right icon'></i>
            Voltar
          </a>

        </div>
        <div class="ui segment center secondary raised aligned">
          <div class="ui icon input large fluid">
            <input type="text" id='pesquisa' oninput='searchTable(this)' placeholder="Pesquisar">
            <i class='search icon'></i>
          </div>
        </div>
      </div>
    </div>
    </aside>

    <main>
      <div style='border-radius: 0' class="ui segment">
        <h1 class='ui header'>Registros
          <div class="ui sub header">
            Controle e revisão dos Registros do Sistema
          </div>
        </h1>

      </div>
      <div class='ui segment' style='margin: 0.6em'>
        <table class="ui table celled">
          <thead>
            <tr>
              <th style="width:20%">Atividade</th>
              <th style="width:30%">Conteúdo</th>
              <th>Tempo</th>
              <th style="width:30%">Dados da Sessão</th>
            </tr>
          </thead>
          <tbody>
            <?php for($i = ($page-1) * $page_limit; $i < $page * 10 && $i < count($logs); $i++): $log = $logs[$i]; ?>
              <tr>
                <td><?= $log->atividade ?></td>
                <td class='<?= $log->dados ? '' : 'warning' ?>'>
                  <?php if($log->dados): ?>
                  <a href="#" onclick='$("#data-<?= $i ?>").toggle(500)' class="ui button icon line">
                    <i class="info icon"></i>
                  </a>
                  <div class="ui segment basic inverted content hidden" id="data-<?= $i ?>">
                    <?= $log->dadosFormatted() ?>
                  </div>
                  <?php endif; ?>
                </td>
                <td><?= $log->tempo->format('h:m:s \d\e d/m/Y') ?></td>
                <td>
                  <a href="#" onclick='$("#sessiondata-<?= $i ?>").toggle(500)' class="ui button icon line">
                    <i class="info icon"></i>
                  </a>
                  <div class="ui segment basic inverted content hidden" id="sessiondata-<?= $i ?>">
                    <?= $log->dadosSessaoFormatted() ?>
                  </div>
                </td>
              </tr>
            <?php endfor; ?>
          </tbody>
        </table>

        <div class="ui pagination menu">
          <?php for($i = 1; $i <= (count($logs) / $page_limit) + 1; $i++): ?>
            <a href="registros.php?page=<?= $i ?>" class="<?= $i == $page ? "active" : '' ?> item">
              <?= $i ?>
            </a>
          <?php endfor; ?>
        </div>

      </div>
    </main>



  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.js" charset="utf-8"></script>
  <script src="js/api/log.js" charset="utf-8"></script>
  <script src="js/semantic.js" charset="utf-8"></script>
  <script src="js/painelInst.js" charset="utf-8"></script>
</html>
