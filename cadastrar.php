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
      date("Y-m-d"),
      "",
      "",
      ""
    );
    // Chamando o método de inserção
    $usuario->insert($conn);
    // Gerando Log
    $url = 'api/log.php';
    $data = array(
      "atividade" => "Cadstro",
      "dados" => $usuario
    );
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
  endif;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/cadastrarStyle.css">
    <link rel="stylesheet" href="css/semantic.css">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/components/icon.min.css'>
    <link rel="icon" type="image/png" href="imgs/sagalogo.png" />
    <title>Cadastro / Plataforma Saga</title>
  </head>
  <body>


    <div class="ui segment secondary stacked wrapper">
      <h1 class='ui header center aligned'>Cadastro</h1>
      <div class="ui divider"></div>
      <?php if($post): ?>
        <div class="ui message success">
          <div class="header">
            Usuário cadastrado com sucesso.
          </div>
          <p>Redirecionando...</p>
        </div>
      <script type="text/javascript">
      setTimeout(()=>{
        window.location.replace("index.php")
      }, 1500)
      </script>
      <?php else: ?>
      <form action="cadastrar.php" method='post' class='ui form large'>
        <div class="field">
          <label for="nomecompleto">Nome Completo</label>
          <input type="text" id='nome' name="nomecompleto">
          <div class="ui label pointing hidden basic red" id='nome-erro'></div>
        </div>

        <div class="fields">
          <div class="ten wide field">
            <label for="email">E-mail</label>
            <input type="email" id='email' name="email">
            <div class="ui label pointing hidden basic red" id='email-erro'></div>
          </div>
          <div class="six wide field">
            <label for="cpf">CPF</label>
            <input oninput="checkCPF()" type="text" id='cpf' name="cpf">
            <div class="ui label pointing hidden basic red" id='cpf-erro'></div>
          </div>
        </div>

        <div class="fields">
          <div class="eight wide field">
              <label for="pw">Senha</label>
              <input type="password" name="pw" oninput='checkPW()'>
          </div>
          <div class="eight wide field">
            <label for="confirm-pw">Confirmar Senha</label>
            <input type="password" name="confirm-pw" oninput='checkPW()'>
            <div class="ui label pointing hidden basic red" id='pw-erro'></div>
          </div>
        </div>



        <input type="submit" class='ui button fluid teal' value="Enviar">
      </form>
  </div>
  <div style='max-width:600px; display: block; margin: 0 auto'class="ui segment basic center aligned">
    <a href="index.php" class='ui fluid button '>Voltar</a>
  <?php endif; ?>
  </div>
  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.js" charset="utf-8"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.min.js" charset="utf-8"></script>
  <script src="js/api/usuario.js" charset="utf-8"></script>
  <script src="js/api/log.js" charset="utf-8"></script>
  <script src="js/validarCPF.js" charset="utf-8"></script>
  <script src="js/validarCadastro.js" charset="utf-8"></script>
</html>
