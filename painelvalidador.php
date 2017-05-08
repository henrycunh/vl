<?php
  // requirements
  session_start();
  require_once 'incl/database.php';
  require 'incl/classes/usuario.php';
  require 'incl/classes/curriculo.php';
  // Definindo $email
  $email = (isset($_SESSION['email']) ? $_SESSION['email'] : 0);
  // Checando privilégios
  $validador = $_SESSION['privilegios']['validador'];
  if(!$validador) die("Acesso não autorizado.");
  // Definindo usuário
  $usuario = Usuario::selectByEmail($conn, $email);
  $nome = $usuario->getNome();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.0.8/typicons.css">
    <title>Painel / Validador Lattes</title>
  </head>
  <body>
    <aside>
      <h1>Painel do Validador</h1>
      <h2><?= $nome ?></h2>
      <div class='info'>
          <input type="text" id='pesquisa' oninput='searchTable(this)' placeholder="Pesquisar">
          <a href='#' id='desconectar'><span class='typcn typcn-times icon'></span> Desconectar</a>
          <a href='index.php'><span class='typcn typcn-chevron-left icon'></span> Voltar</a>
      </div>
    </aside>
    <main>
      <h1>Pesquisadores</h1>
      <div id="pesquisadores">
      <table>
        <tr>
          <th>Nome</th>
          <th>Email</th>
          <th>CPF</th>
          <th></th>
        </tr>
      <?php
        $pesquisadores = $conn->query("SELECT * FROM usuario")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($pesquisadores as $row): ?>
        <tr>
          <td><?= $row['nomeCompleto'] ?></td>
          <td><?= $row['email'] ?></td>
          <td><?= $row['cpf'] ?></td>
          <td><a href='validarPesquisador.php?cpf=<?= $row['cpf'] ?>'><span class='typcn typcn-eye visualizar'></a></td>
        </tr>
      <?php
        endforeach;
       ?>
      </table>
      </div>

    </main>
  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.js" charset="utf-8"></script>
  <script src="js/painelValidador.js" charset="utf-8"></script>
</html>
