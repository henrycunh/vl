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
    $usuario = new Usuario(
      $dados['nomecompleto'],
      $dados['email'],
      date("Y-m-d", strtotime($dados['datanasc'])),
      $dados['genero'],
      $dados['cpf'],
      $dados['rg'],
      $dados['endereco'],
      $dados['cep'],
      $dados['telefone'],
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
    Usuário cadastrado com sucesso.
    <?php header("Refresh: 1.5; url=index.php"); else: ?>
    <form action="cadastrar.php" method='post'>
      <label for="nomecompleto">Nome Completo</label>
      <input type="text" name="nomecompleto" required>

      <label for="email">E-mail</label>
      <input type="email" name="email" required>

      <label for="datanasc">Data de Nascimento</label>
      <input type="date" name="datanasc" required >

      <label for="genero">Gênero</label>
      <select name='genero'>
        <option value="M">Masculino</option>
        <option value="F">Feminino</option>
      </select>

      <label for="cpf">CPF</label>
      <input type="text" name="cpf" id='cpf' oninput="checkCPF()" required>
      <div class="erro"></div>

      <label for="rg">RG</label>
      <input type="text" id='rg' name="rg" >

      <label for="endereco">Endereço</label>
      <input type="text" name="endereco" required>

      <label for="cep">CEP</label>
      <input type="text" id='cep' name="cep" required>

      <label for="telefone">Telefone</label>
      <input type="text" id='telefone' name="telefone" required>

      <div class="pw-group">
        <label for="pw">Senha</label>
        <input type="password" name="pw" oninput='checkPW()' required>
      </div><!--

  --><div class="pw-group">
        <label for="confirm-pw">Confirmar Senha</label>
        <input type="password" name="confirm-pw" oninput='checkPW()' required>
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
  <script src="js/validarCadastro.js" charset="utf-8"></script>
</html>
