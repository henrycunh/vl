<?php
  // requirements
  session_start();
  require_once 'incl/database.php';
  require 'incl/classes/usuario.php';
  require 'incl/classes/curriculo.php';
  // Definindo $email
  $email = (isset($_SESSION['email']) ? $_SESSION['email'] : 0);
  // Definindo usuário
  $usuario = Usuario::selectByEmail($conn, $email);
  $nome = $usuario->getNome();
  $id = Curriculo::getIDByEmail($conn, $email);
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
    <title>Painel / Plataforma Saga</title>
  </head>
  <body>
    <aside>
      <div class="ui segment inverted basic">
        <h4 class='ui header inverted'>
          Painel do Pesquisador
          <div class="ui sub header">
            <?= $nome ?>
          </div>
        </h4>
      </div>
      <div class="ui segment inverted padded">
        <div class='ui fluid vertical labeled large icon buttons'>
          <a class='ui button' href="em_construcao.html"><i class='list icon'></i>Meus Sumários</a>
          <a class='ui button' href="alterar_informacoes.php"><i class='edit icon'></i>Alterar Informações</a>
          <a class='ui button' href='#' onclick='abrirModalCurr()'><i class='upload icon'></i>Enviar Currículo</a>
          <a class='ui button' href="#" id='deletarcurriculo'><i class='delete icon'></i>Deletar Currículo</a>
          <a class='ui button' href='#' id='desconectar'><i class='sign out icon'></i>Desconectar</a>
          <a class='ui button' href='index.php'><i class='chevron left icon'></i>Voltar</a>
        </div>
      </div>

      <!-- ENVIAR CURRICULO MODAL -->
      <div class="ui modal" id='enviarCurrModal'>
        <div class="header">
          Submissão de Currículo
        </div>
        <div class="ui segment basic padded center aligned" id='modalIn'>
          <label class='ui teal labeled icon fluid link button' for="fileCurriculo" id='filebtn'><i class="upload icon"></i> Escolha um Arquivo</label>
          <br>
          <input type='file' id='fileCurriculo' accept="text/xml" onchange='fileVerify(this)' name='curriculo'>
          <button class='ui blue button fluid' onclick="enviarArquivo()" id='curriculoSubmit'>Enviar</button>
          <br>
          <div class="ui indicating progress" id='progress'>
            <div class="bar"></div>
            <div class="label" id='label'></div>
          </div>
        </div>
      </div>
      <!-- END ENVIAR CURRICULO MODAL -->

    </aside>
    <main>
      <div style='border-radius:0' class="ui segment">
        <h1 class='ui header'>Currículo
          <div class="ui sub header">
            Suas Informações
          </div>
        </h1>

      </div>
      <div class="ui segment curriculo">
      <?php
        if($id)
            require 'incl/curriculo_display.php';
        else
          echo 'Este usuário ainda não enviou um currículo. <br>Use a barre lateral para enviar o seu Currículo Lattes.';
      ?>
      </div>

    </main>
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
