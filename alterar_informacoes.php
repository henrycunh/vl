<?php
  session_start();
  // Requerindo DB
  require_once 'incl/database.php';
  // Requerindo Classe Usuário
  require 'incl/classes/usuario.php';
  $email = (isset($_SESSION['email']) ? $_SESSION['email'] : 0);
?>
<script type="text/javascript">
  var mEmail = <?= "'$email'" ?>;
</script>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/alterarInfoStyle.css">
    <title>Cadastro / Validador Lattes</title>
  </head>
  <body>
    <div class='wrapper'>
    <h1>Minhas Informações</h1>
    <hr>
      <label for="nomecompleto">Nome Completo *</label>
      <input type="text" id='nome' name="nomecompleto">
      <div class="erro" id='nome-erro'></div>


      <label for="email">E-mail *</label>
      <input type="email" id='email' name="email">
      <div class="erro" id='email-erro'></div>

      <label for="dataNasc">Data de Nascimento</label>
      <input type="date" id='dataNasc' name="dataNasc">

      <label for="genero">Data de Nascimento</label>
      <select id='genero' name="genero">
        <option value="M">Masculino</option>
        <option value="F">Feminino</option>
      </select>

      <label for="cpf">CPF</label>
      <input oninput="checkCPF()" type="text" id='cpf' name="cpf">
      <div class="erro" id='cpf-erro'></div>

      <label for="rg">RG</label>
      <input type="number" id='rg' name="rg">

      <label for="endereco">Endereço</label>
      <input type="text" id='endereco' name="endereco">

      <label for="cep">CEP</label>
      <input type="text" id='cep' name="cep">

      <label for="telefone">Telefone</label>
      <input type="text" id='telefone' name="telefone">

      <h2 id='showpw'>Alterar Senha <span class='fa fa-chevron-down'></span></h2>
      <div class="alterarSenha">
        <h3>Se não deseja alterar a senha, deixe os campos vazios</h3>
        <div class="pw-group">
          <label for="pw">Senha</label>
          <input type="password" name="pw" id='pw' oninput='checkPW()'>
        </div><!--

    --><div class="pw-group">
          <label for="confirm-pw">Confirmar Senha</label>
          <input type="password" name="confirm-pw" id='confirm-pw' oninput='checkPW()'>
        </div>
        <div class="erro" id='pw-erro'></div>
      </div>

      <button class='btn' id='submit'>Salvar</button>
      <span id='msg'>Mensagem</span>
      <a href="painel.php" id='voltar'>Voltar</a>
  </div>
  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.js" charset="utf-8"></script>
  <script src="js/api/usuario.js" charset="utf-8"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.min.js" charset="utf-8"></script>
  <script src="js/validarCPF.js" charset="utf-8"></script>
  <script src="js/validarAlteracaoUsuario.js" charset="utf-8"></script>
  <script type="text/javascript">

  </script>
</html>
