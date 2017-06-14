<?php
  session_start();
  require 'incl/classes/usuario.php';
  require 'incl/database.php';
  require 'incl/classes/edital.php';
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
  $editais = Edital::selectEditais($conn);
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
      
    </header>
    <!-- DEMONSTRAÇÃO DOS EDITAIS -->
    <section id='editais'>
      <div class="ui segment" style='padding: 2em'>
        <div class="ui header">
          Últimos Editais
        </div>
        <div class="ui grid">
          <div class="four column row">
            <?php foreach ($editais as $edital): ?>
              <div class="column">
                <div class="ui segment">
                  <div class="ui header">
                    <a href="">
                      <?= $edital->nome ?>
                    </a>
                  </div>
                  <div class="ui divider"></div>
                  <div class='descricao limit-lines'>
                    <?= $edital->descricao ?>
                  </div>
                  <div class="ui divider"></div>
                  <div class="ui label ribbon">
                      <?= date('d/m/Y', strtotime($edital->vigencia)) ?>
                  </div>
                  <a href="" class="ui button">
                    Baixar Edital
                  </a>
                  <?php if(isset($_SESSION['privilegios']['pesquisador'])): ?>
                    
                  <?php endif; ?>
                </div>
              </div>   
            <?php endforeach; ?> 
          </div>
        </div>
      </div>
    </section>

  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.js" charset="utf-8"></script>
  <script src="js/homepage.js" charset="utf-8"></script>
</html>
