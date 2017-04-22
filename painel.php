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
    <link rel="stylesheet" href="css/painelStyle.css">
    <link rel="stylesheet" href="css/curriculoStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.0.8/typicons.css">
    <title>Painel / Validador Lattes</title>
  </head>
  <body>
    <aside>
      <h1>Painel do Pesquisador</h1>
      <h2><?= $nome ?></h2>
      <div class='info'>
        <a href="alterar_informacoes.php"><span class="typcn typcn-zoom icon"></span>Procurar Editais</a>
        <a href="alterar_informacoes.php"><span class="typcn typcn-th-list icon"></span>Meus Editais</a>
        <a href="alterar_informacoes.php"><span class="typcn typcn-user icon"></span> Alterar Informações</a>
        <a href='#' id='enviarcurriculo'><span class='typcn typcn-cloud-storage icon'></span> Enviar Currículo</a>
        <a href="#" id='deletarcurriculo'><span class='typcn typcn-delete icon'></span> Deletar Currículo</a>
        <a href='#' id='desconectar'><span class='typcn typcn-times icon'></span> Desconectar</a>

      </div>
    </aside>
    <main>
      <h1>Currículo</h1>
      <div class="curriculo">
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
  <script src="js/fileupload.js" charset="utf-8"></script>
  <script src="js/painel.js" charset="utf-8"></script>
  <script src="js/curriculo.js" charset="utf-8"></script>
  <script src="js/jquery.pseudo.js" charset="utf-8"></script>
  <script src="js/api/curriculo.js" charset="utf-8"></script>
</html>
