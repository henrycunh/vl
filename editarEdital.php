<?php
  // requirements
  session_start();
  require_once 'incl/database.php';
  require 'incl/classes/usuario.php';
  require 'incl/classes/edital.php';
  require 'incl/classes/regra.php';

  // Definindo $email
  $email = (isset($_SESSION['email']) ? $_SESSION['email'] : 0);
  // Checando privilégios
  $inst_val = $_SESSION['privilegios']['gerenciador'];
  if(!$inst_val || !isset($_GET)) die("Acesso não autorizado.");
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
    <link rel="stylesheet" href="css/semantic.css">
    <link rel="stylesheet" href="css/editarEdital.css">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/components/icon.min.css'>
    <script src="https://cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
    <title>Editar Edital / Validador Lattes</title>
  </head>
  <body>
    <?php
      $edital = Edital::selectByNumero($conn, $_GET['num']);
      require 'incl/editar_edital_display.php'; ?>
  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.js" charset="utf-8"></script>
  <script src="js/painelInst.js" charset="utf-8"></script>
  <script src="js/semantic.js" charset="utf-8"></script>
  <script src="js/api/edital.js" charset="utf-8"></script>
  <script src="js/fileupload.js" charset="utf-8"></script>
  <script src="js/editarEdital.js" charset="utf-8"></script>
  <script src="js/editarEditalRegras.js" charset="utf-8"></script>
  <script type="text/javascript">
    CKEDITOR.replace('descricao')
  </script>
</html>
