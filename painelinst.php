<?php
  // requirements
  session_start();
  require_once 'incl/database.php';
  require 'incl/classes/usuario.php';
  require 'incl/classes/curriculo.php';
  // Definindo $email
  $email = (isset($_SESSION['email']) ? $_SESSION['email'] : 0);
  // Checando privilégios
  $inst_val = $_SESSION['privilegios']['gerenciador'];
  if(!$inst_val) die("Acesso não autorizado.");
  // Definindo usuário
  $usuario = Usuario::selectByEmail($conn, $email);
  if(!$email):
 ?>
 <script type="text/javascript">
   window.location.replace("index.php");
 </script>
 <?php endif; ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/painelValidadorStyle.css">
    <link rel="stylesheet" href="css/semantic.css">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/components/icon.min.css'>
    <title>Painel / Validador Lattes</title>
  </head>
  <body>
    <aside>
      <div class="ui segment inverted basic">
        <h4 class='ui header inverted'>
          Painel do Validador
          <div class="ui sub header">
            Propex - IFS
          </div>
        </h4>
      </div>
      <div class="ui padded inverted segment">
      <div class="ui fluid vertical labeled large icon buttons">
          <a class='ui button' href='index.php'>
            <i class='add user icon'></i>
            Vincular Validador
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
        <h1 class='ui header'>Editais
          <div class="ui sub header">
            Controle e revisão dos Editais
          </div>
        </h1>

      </div>
      <div class='ui segment' style='margin: 0.6em'>
        <?php require 'incl/edital_display.php'; ?>
      </div>

    </main>
  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.js" charset="utf-8"></script>
  <script src="js/painelInst.js" charset="utf-8"></script>
</html>
