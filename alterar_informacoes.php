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
    <link rel="stylesheet" href="css/semantic.css">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/components/icon.min.css'>
    <link rel="stylesheet" href="css/alterarInfoStyle.css">
    <title>Cadastro / Validador Lattes</title>
  </head>
  <body>
    <div class='wrapper'>
    <div class="ui segment secondary">
      <div class="ui form">
      <h3 class='ui header aligned center'>Minhas Informações</h3>
      <div class="ui divider"></div>

      <div class="field">
        <label for="nomecompleto">Nome Completo</label>
        <div class="ui corner labeled input">
          <input type="text" id='nome' name="nomecompleto">
          <div class="ui right corner label">
            <i class="asterisk icon"></i>
          </div>
        </div>
        <div class="ui label pointing red basic hidden" id='nome-erro'></div>
      </div>


      <div class="field">
        <label for="email">Email</label>
        <div class="ui corner labeled input disabled">
          <input type="text" id='email' name="email">
          <div class="ui right corner label">
            <i class="asterisk icon"></i>
          </div>
        </div>
        <div class="ui label pointing red basic hidden" id='email-erro'></div>
      </div>

      <div class="fields">
        <div class="five wide field">
          <label for="dataNasc">Data de Nascimento</label>
          <input type="date" id='dataNasc' name="dataNasc">
        </div>

        <div class="six wide field">
          <label for="genero">Gênero</label>
          <select id='genero' name="genero">
            <option value="M">Masculino</option>
            <option value="F">Feminino</option>
          </select>
        </div>

        <div class="five wide field">
          <label for="cpf">CPF</label>
          <input oninput="checkCPF()" type="text" id='cpf' name="cpf">
          <div class="ui label pointing red basic hidden" id='cpf-erro'></div>
        </div>
      </div>

      <div class="fields">
        <div class="ten wide field">
          <label for="endereco">Endereço</label>
          <input type="text" id='endereco' name="endereco">
        </div>

        <div class="six wide field">
          <label for="rg">RG</label>
          <input type="number" id='rg' name="rg">
        </div>
      </div>

      <div class="fields">
        <div class="eight wide field">
          <label for="cep">CEP</label>
          <input type="text" id='cep' name="cep">
        </div>

        <div class="eight wide field">
          <label for="telefone">Telefone</label>
          <input type="text" id='telefone' name="telefone">
        </div>
      </div>

      <button class='ui button mini labeled icon' id='showpw'>
        <i class='chevron down icon'></i>
        Alterar Senha
      </button>
      <div class="ui segment alterarSenha">
        <div class="ui message info">
          <i class="info icon"></i>Se não deseja alterar a senha, deixe os campos vazios
        </div>
        <div class="fields">
          <div class="eight wide field">
            <label for="pw">Senha</label>
            <input type="password" name="pw" id='pw' oninput='checkPW()'>
          </div>

          <div class="eight wide field">
            <label for="confirm-pw">Confirmar Senha</label>
            <input type="password" name="confirm-pw" id='confirm-pw' oninput='checkPW()'>
            <div class="ui label pointing red basic hidden" id='pw-erro'></div>
          </div>
        </div>
      </div>

      <div class="ui divider hidden"></div>

      <button class='ui button large blue fluid' id='submit'>Salvar</button>
      <div class='ui success message' id='msg'>Mensagem</div>
    </div>
    <div class="ui segment basic">
      <a  href="painel.php" id='voltar'>Voltar</a>
    </div>
  </div>
</div>
  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.js" charset="utf-8"></script>
  <script src="js/semantic.js" charset="utf-8"></script>
  <script src="js/api/usuario.js" charset="utf-8"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.min.js" charset="utf-8"></script>
  <script src="js/validarCPF.js" charset="utf-8"></script>
  <script src="js/validarAlteracaoUsuario.js" charset="utf-8"></script>
</html>
