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
  if(!$email){header("Location: 502.html"); die();}
  // Gerando lista de validadores
  $validadores = $conn->query("SELECT DISTINCT usuario.* FROM usuario INNER JOIN perfil ON perfil.email = usuario.email WHERE nivel = 'validador'")->fetchAll(PDO::FETCH_ASSOC);
  ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/painelValidadorStyle.css">
    <link rel="stylesheet" href="css/semantic.css">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/components/icon.min.css'>
    <link rel="icon" type="image/png" href="imgs/sagalogo.png" />
    <title>Painel / Plataforma Saga</title>
  </head>
  <body>
    <!-- Menu Lateral -->
    <aside>

      <!-- Titulo  -->
      <div class="ui segment inverted basic">
        <h4 class='ui header inverted'>
          Controle de Validadores
          <div class="ui sub header">
            Propex - IFS
          </div>
        </h4>
      </div>

      <!-- Menu -->
      <div class="ui padded inverted segment">
        <div class="ui fluid vertical labeled large icon buttons">
            <a class='ui button' href='painel_instituicao.php'>
              <i class='list icon'></i>
              Editais
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

        <!-- Pesquisa -->
        <div class="ui segment center secondary raised aligned">
            <div class="ui icon input large fluid">
              <input type="text" id='pesquisa' oninput='searchTable(this)' placeholder="Pesquisar">
              <i class='search icon'></i>
            </div>
        </div>

      </div>
    </aside>

    <main>
      <div style='border-radius: 0' class="ui segment">
        <h1 class='ui header'>Validadores
          <div class="ui sub header">
            Visão geral dos usuários vinculados como validadores
          </div>
        </h1>
      </div>

      <div class="ui segment" style='margin: 0.6em'>

        <div class="ui segment">
          <div class="ui form">
            <div class="field">
              <div class="two fields">
                <div class="field">
                  <div class="ui input">
                    <input type="text" id='emailVal' placeholder='Email'>
                  </div>
                </div>
                <div class="field">
                  <button class="ui button primary" onclick='vincularPesquisador()'> Vincular Validador</button>
                </div>
              </div>
            </div>
          </div>
          <div class="ui message hidden" id='confirmMessage'>

          </div>
        </div>

        <table class="ui table celled padded">
          <thead>
            <tr>
              <th style='width: 30%'>Nome</th>
              <th style='width: 40%'>Email</th>
              <th style='width: 20%'>CPF</th>
              <th style='width: 10%'>Ação</th>
            </tr>
          </thead>
          <tbody id='tablebody'>
            <?php foreach ($validadores as $val): ?>
              <tr email='<?= $val['email'] ?>'>
                <td><?= $val['nomeCompleto'] ?></td>
                <td><?= $val['email'] ?></td>
                <td><?= $val['cpf'] ?></td>
                <td>
                  <center>
                    <a href='#' onclick='desvincularValidador("<?= $val['email'] ?>")'>
                      <i class="delete icon"></i>
                    </a>
                  </center>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

    </main>





  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.js" charset="utf-8"></script>
  <script src="js/api/log.js" charset="utf-8"></script>
  <script src="js/semantic.js" charset="utf-8"></script>
  <script src="js/painelInst.js" charset="utf-8"></script>
</html>
