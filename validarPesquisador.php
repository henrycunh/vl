<?php
  // Iniciando sessão
  session_start();
  // Conectando banco de dados
  require 'incl/database.php';
  // Importando objetos
  require 'incl/classes/curriculo.php';
  require 'incl/classes/usuario.php';
  // Selecionando o usuário e pegando seu currículo
  $usuario = Usuario::selectByCPF($conn,$_GET['cpf']);
  $validador = $_SESSION['privilegios']['validador'];
  if(!$validador){header("Location: 502.html"); die();}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/validarPesquisadorStyle.css">
    <link rel="stylesheet" href="css/curriculoStyle.css">
    <link rel="stylesheet" href="css/semantic.css">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/components/icon.min.css'>
    <title>Validação / <?= $usuario->nomeCompleto ?></title>
  </head>
  <body>
  <div style='border-radius:0; margin-bottom: 0' class='ui inverted segment'>
    <div class="ui inverted huge secondary menu">
      <div class="item">
        <div class="ui header inverted">
          Validador Lattes / Validar Usuário
        </div>
      </div>
    </div>
  </div>

    <main class='ui segment curriculo'>
    <a href="painelvalidador.php" class='ui button blue fluid'>Voltar para o Painel</a>
    <div class="ui divider"></div>
    <?php
      // Preparando dados para carregar o currículo
      $email = $usuario->email;
      $curriculo = Curriculo::getCurriculoByEmail($conn, $email);
      
      // Verificando se o pesquisador possuí um currículo
      if(!$curriculo):
    ?>
      <div class="erro">
        O pesquisador não enviou um currículo.
      </div>
    <?php
      else:
        $id = $curriculo->curriculoId;
        $nome = Curriculo::getNomeCompleto($conn, $id);
        require 'incl/curriculo_display_validar.php';
      endif;
    ?>
    </main>
  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.js" charset="utf-8"></script>
  <script src="js/fileupload.js" charset="utf-8"></script>
  <script src="js/painel.js" charset="utf-8"></script>
  <script src="js/curriculo.js" charset="utf-8"></script>
  <script src="js/semantic.js" charset="utf-8"></script>
  <script src="js/jquery.pseudo.js" charset="utf-8"></script>
  <script src="js/api/curriculo.js" charset="utf-8"></script>
  <script src="js/api/validacao.js" charset="utf-8"></script>
</html>
