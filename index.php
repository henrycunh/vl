<?php
  session_start();
  require 'incl/classes/usuario.php';
  require 'incl/database.php';
  $email = (isset($_SESSION['email']) ? $_SESSION['email'] : 0);
  $usuario = Usuario::selectByEmail($conn,$email);
  $usuarioICs = array(
    "artigos" => array(
      "num" => $usuario->getICCount($conn, "artigo"),
      "name" => "Artigo",
      "nameP" => "Artigos"
    ),
    "bancas" => array(
      "num" => $usuario->getICCount($conn, "banca"),
      "name" => "Banca",
      "nameP" => "Bancas"
    ),
    "capLivros" => array(
      "num" => $usuario->getICCount($conn, "capLivro"),
      "name" => "Capítulo de Livro",
      "nameP" => "Capítulos de Livros"
    ),
    "coordProjs" => array(
      "num" => $usuario->getICCount($conn, "coordProj"),
      "name" => "Coordenação de Projeto",
      "nameP" => "Coordenação de Projetos"
    ),
    "corpoEditoriais" => array(
      "num" => $usuario->getICCount($conn, "corpoEditorial"),
      "name" => "Participação em Corpo Editorial",
      "nameP" => "Participações em Corpos Editoriais"
    ),
    "livros" => array(
      "num" => $usuario->getICCount($conn, "livro"),
      "name" => "Livro",
      "nameP" => "Livros"
    ),
    "marcas" => array(
      "num" => $usuario->getICCount($conn, "marca"),
      "name" => "Marca",
      "nameP" => "Marcas"
    ),
    "organizacaoEventos" => array(
      "num" => $usuario->getICCount($conn, "organizacaoEvento"),
      "name" => "Organização de Evento",
      "nameP" => "Organização de Eventos"
    ),
    "orientacoes" => array(
      "num" => $usuario->getICCount($conn, "orientacao"),
      "name" => "Orientação",
      "nameP" => "Orientações"
    ),
    "patentes" => array(
      "num" => $usuario->getICCount($conn, "patente"),
      "name" => "Patente",
      "nameP" => "Patentes"
    ),
    "softwares" => array(
      "num" => $usuario->getICCount($conn, "software"),
      "name" => "Software",
      "nameP" => "Softwares"
    ),
    "titulacoes" => array(
      "num" => $usuario->getICCount($conn, "titulacao"),
      "name" => "Titulação",
      "nameP" => "Titulações"
    ),
    "trabEventos" => array(
      "num" => $usuario->getICCount($conn, "trabEvento"),
      "name" => "Trabalho em Evento",
      "nameP" => "Trabalhos em Eventos"
    ),
  );
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="css/homeStyle.css">
    <link rel="stylesheet" href="css/semantic.css">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/components/icon.min.css'>
    <title>Validador Lattes</title>
  </head>
  <body>
    <div style='border-radius:0; margin-bottom: 0' class='ui inverted segment'>
      <div class="ui inverted huge secondary menu">
        <a class='item active'>Home</a>
        <div class="right menu">
      <?php if(!$email): ?>
        <a class='ui item' href="login.php">
          <i class='sign in icon'></i>
          Login
        </a>
        <a class='ui item' href="cadastrar.php">
          <i class='add user icon'></i>
          Cadastrar-se
        </a>
      <?php else: ?>
        <?= (isset($_SESSION['privilegios']['pesquisador']) ? '<a class="ui item" href="painel.php">Painel do Pesquisador</a>' : '') ?>
        <?= (isset($_SESSION['privilegios']['validador']) ? '<a class="ui item" href="painelvalidador.php">Painel do Validador</a>' : '') ?>
        <?= (isset($_SESSION['privilegios']['gerenciador']) ? '<a class="ui item" href="painelinst.php">Painel do Instituto</a>' : '') ?>
        <a class='ui item' href="#">Editais</a>
        <a class='ui item' href="#" id='desconectar'>Desconectar</a>
      <?php endif; ?>
      </div>
    </div>
    </div>

    <header>
      <h1 class="ui header inverted center aligned">
        Validador Currículos
      </h1>
    </header>

    <aside>
      <?php if($email):  ?>
        <div class="ui card fluid">
          <div class="content">
            <div class="header">
              Minhas informações
            </div>
            <div class="meta">
              <?= $usuario->nomeCompleto ?>
            </div>
          </div>
          <div class="content" style='line-height: 40px'>
            <?php foreach ($usuarioICs as $ic): if($ic['num'] > 0): ?>
              <div class="ui label large basic">
                  <?= $ic['num'] ?>
                  <div class="detail">
                    <?= $ic['num'] > 1 ? $ic['nameP'] : $ic['name'] ?>
                  </div>
              </div>
            <?php endif; endforeach; ?>

          </div>
        </div>
      <?php else: ?>
        <div class="ui card fluid">
          <div class="content">
            <div class="header">
              Participe já
            </div>
          </div>
          <div class="ui content center aligned">
              <button class='ui button blue fluid'>
                Criar uma conta
              </button>
              <div class="ui horizontal divider">ou</div>
              <button class='ui button positive fluid'>
                Login
              </button>
          </div>
        </div>
      <?php endif; ?>
    </aside>
    <main>
      <div class="ui segment">
        <div class="ui header">
          <h3>
            Editais Disponíveis
          </h3>
          <div class="ui grid">
            <div class="four wide column">
              <div class="ui card">
                <div class="content">
                  <div class="header">
                    Nome do Edital
                    <div class="sub header">
                      18/05/2017
                    </div>
                  </div>
                </div>
                <div class="content">
                  <div style='font-size: 0.6em' class='description'>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                  </div>
                </div>
                <div class="content">
                </div>
              </div>
            </div>
            <div class="four wide column">
              <div class="ui card">
                <div class="content">
                  <div class="header">
                    Nome do Edital
                    <div class="sub header">
                      18/05/2017
                    </div>
                  </div>
                </div>
                <div class="content">
                  <div style='font-size: 0.6em' class='description'>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                  </div>
                </div>
                <div class="content">
                </div>
              </div>
            </div>
            <div class="four wide column">
              <div class="ui card">
                <div class="content">
                  <div class="header">
                    Nome do Edital
                    <div class="sub header">
                      18/05/2017
                    </div>
                  </div>
                </div>
                <div class="content">
                  <div style='font-size: 0.6em' class='description'>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                  </div>
                </div>
                <div class="content">
                </div>
              </div>
            </div>
            <div class="four wide column">
              <div class="ui card">
                <div class="content">
                  <div class="header">
                    Nome do Edital
                    <div class="sub header">
                      18/05/2017
                    </div>
                  </div>
                </div>
                <div class="content">
                  <div style='font-size: 0.6em' class='description'>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                  </div>
                </div>
                <div class="content">
                </div>
              </div>
            </div>
          </div>


        </div>
      </div>
    </main>

  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.js" charset="utf-8"></script>
  <script src="js/homepage.js" charset="utf-8"></script>
</html>
