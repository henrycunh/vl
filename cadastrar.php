<?php
  // Requerindo DB
  require_once 'incl/database.php';
  // Requerindo Classe Usuário
  require 'incl/classes/usuario.php';
  // Recebendo POST request
  $post = !empty($_POST);
  if($post):
    // Passando informações recebidas para array mais acessível
    $dados = $_POST;
    // Criando um Objeto de Usuário
    $usuario = Usuario::create(
      $dados['nomecompleto'],
      $dados['email'],
      date("Y-m-d"),
      " ",
      $dados['cpf'],
      " ",
      " ",
      " ",
      " ",
      $dados['pw'],
      date("Y-m-d")
    );
    // Chamando o método de inserção
    $usuario->insert($conn);
  endif;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/cadastrarStyle.css">
    <title>Cadastro / Validador Lattes</title>
  </head>
  <body>
    <div class='wrapper'>
    <h1>Cadastro</h1>
    <hr>
    <?php if($post): ?>
    Usuário cadastrado com sucesso.<br>
    Redirecionando...
    <script type="text/javascript">
    setTimeout(()=>{
      window.location.replace("index.php")
    }, 1500)
    </script>
    <?php else: ?>
    <form action="cadastrar.php" method='post'>
      <label for="nomecompleto">Nome Completo</label>
      <input type="text" id='nome' name="nomecompleto">
      <div class="erro" id='nome-erro'></div>


      <label for="email">E-mail</label>
      <input type="email" id='email' name="email">
      <div class="erro" id='email-erro'></div>

      <label for="cpf">CPF</label>
      <input oninput="checkCPF()" type="text" id='cpf' name="cpf">
      <div class="erro" id='cpf-erro'></div>

      <div class="pw-group">
        <label for="pw">Senha</label>
        <input type="password" name="pw" oninput='checkPW()'>
      </div><!--

  --><div class="pw-group">
        <label for="confirm-pw">Confirmar Senha</label>
        <input type="password" name="confirm-pw" oninput='checkPW()'>
      </div>
      <div class="erro" id='pw-erro'></div>


      <input type="submit" class='btn' value="Enviar">
      <a href="index.php">Voltar</a>
    </form>
  <?php endif; ?>
  </div>
  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.js" charset="utf-8"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.min.js" charset="utf-8"></script>
  <script src="js/api/usuario.js" charset="utf-8"></script>
  <script src="js/validarCPF.js" charset="utf-8"></script>
  <script src="js/validarCadastro.js" charset="utf-8"></script>
</html>
