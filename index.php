<?php
  session_start();
  require 'incl/classes/usuario.php';
  require 'incl/database.php';
  require 'incl/classes/edital.php';
  $email = (isset($_SESSION['email']) ? $_SESSION['email'] : 0);
  $usuario = Usuario::selectByEmail($conn,$email);
  $editais = Edital::selectEditais($conn);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Plataforma Saga</title>
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/components/icon.min.css'>
    <link rel="stylesheet" href="css/semantic.css">
    <link rel="stylesheet" href="css/homeStyle.css">
    <link rel="icon" type="image/png" href="imgs/sagalogo.png" />
  </head>
  <body>

    <header>
      <?php require "incl/views/navbar.php" ?>
      <div class="text">
        <h1>SAGA</h1>
      </div>
    </header>

    <section class="info">
      <h1>Do que se trata a plataforma?</h1>
      <div class="symbol">
        <img src="imgs/logo.png" alt="">
      </div>
      <div class="descricao">
        <p>
          O processo de buscar e enviar comprovantes e preencher pontuações a cada edital lançado, é custoso em tempo
          tanto para os pesquisadores, quanto para a Instituição que processa as aplicações. Se torna então necessária
          uma solução que resolva tais problemáticas da forma mais prática e acessível possível.
        </p>
        <p>
          A Plataforma Saga traz para as Instituições e pesquisadores funcionalidades necessárias para transformar
          o processo de pontuação e validação de comprovantes em um processo ágil e sem complicações.
        </p>
        <p>
          Ao pesquisador, cabel única e exclusivamente a necessidade de enviar seu currículo em .xml, obtido diretamente
          pela Plataforma Lattes, víncular os comprovantes em .pdf aos itens de currículo correspondentes, e por fim,
          gerar um sumário a partir do Edital desejado. Em caso de dúvidas, confira a nossa página de <a href='faq.php'>F.A.Q</a>.
        </p>
      </div>
    </section>

    <section class='editais'>
      <h1>Editais Recentes</h1>
      <div class="editais wrapper">
        <div class="ui grid">
          <div class="four column row">

            <?php for($i = 0; $i < (count($editais) > 4 ? 4 : count($editais)); $i++): $edital_ = $editais[$i]; ?>
              <div class="column">
                <div class="edital item">
                  <div class="edital header">
                    <a href='edital.php?numero=<?= $edital_->numero ?>'>
                      <?= $edital_->nome ?>
                    </a>
                  </div>
                  <div class="edital desc">
                    <?= $edital_->descricao ?>
                  </div>
                  <div class="edital data">
                    Vigência: <?= date("d/m/Y", strtotime($edital_->vigencia)) ?>
                  </div>
                </div>
              </div>
            <?php endfor; ?>

          </div>
        </div>
        <a href='editais.php' class="ui button inverted" style="font-family: 'Roboto', sans-serif; float: right; margin: 0.5em">
          Todos os Editais
        </a>
      </div>
    </section>

    <!-- Footer -->
    <footer>
      Copyright (c) 2017 <a href='kanitech.com.br'>Kanitech Solutions</a> All Rights Reserved.
    </footer>
    <!-- Footer END -->
  </body>

  <script src="https://code.jquery.com/jquery-3.2.1.js" charset="utf-8"></script>
  <script src="js/api/log.js" charset="utf-8"></script>
  <script src="js/homepage.js" charset="utf-8"></script>
</html>
