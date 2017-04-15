<?php

  $curriculo = Curriculo::getCurriculoByEmail($conn, $email);
  $nome = Curriculo::getNomeCompleto($conn, $id);
  $titulacaoType = array(1 => 'Doutorado', 2 => 'Mestrado', 3 => 'Especialista', 4 => 'Graduado');
 ?>
<!-- TITULAÇÃO START -->
<h1>Titulação</h1>
<div class="hswrap"><button class='hide-show' onclick="toggle(this)" ic='titulacao'>Esconder</button></div>
<div class="ic_wrapper" id='titulacao'>
  <!-- <tipo> em <nomeCurso> (<anoInicio> - <anoConclusao>)  -->
  <b><?= $titulacaoType[$curriculo->titulacao->tipo] ?></b> em <?= $curriculo->titulacao->nomeCurso ?>
  (<b><?= $curriculo->titulacao->anoInicio ?></b> - <b><?= $curriculo->titulacao->anoConclusao?></b>)
  <!-- Instituição: <instituicao> -->
  <p>
    <b>Instituição:</b> <?= $curriculo->titulacao->instituicao ?>
  </p>
  <!-- Orientador: <orientador> -->
  <p>
    <b>Orientador:</b> <?= $curriculo->titulacao->orientador ?>
  </p>
  <!-- Titulo: <titulo> -->
  <!-- Orientador: <orientador> -->
  <p>
    <b>Titulo:</b> <?= $curriculo->titulacao->titulo ?>
  </p>
  <div class='val-area'>
    <?php if(!$curriculo->titulacao->validado): ?>
    <!-- NÃO VALIDADO // ENVIAR COMPROVANTE  -->
    <div class="col nao-validado">Não Validado</div>
    <div class="col nao-validado"><a href="#">Enviar Comprovante</a></div>
    <?php else: ?>
    <!-- VALIDADO // DATA VALIDACAO // VALIDADO POR (NOME VALIDADOR) // VER COMPROVANTE //  ALTERAR COMPROVANTE  -->

    <?php endif; ?>
  </div>
</div>
<!-- TITULAÇÃO END -->



<!-- ARTIGOS START -->
<h1>Produção Bibliográfica</h1>
<h2>Artigos</h2>
<div class="hswrap"><button class='hide-show' onclick="toggle(this)"  ic='artigo'>Esconder</button></div>
<div class="ic_wrapper" id='artigo'>
  <div class='hswrap'><input type="text" class='search' ic='artigo' oninput='search(this)' placeholder='Pesquisar...'></div>
  <ul class='itens'>
  <?php foreach ($curriculo->artigos as $i => $artigo): ?>
      <li>
        <!-- Número -->
        <div class='number level-<?= strlen((string)$i+1) ?>'><?= $i+1 ?></div>
        <!-- Nomes de Citação -->
        <?= autoresToString($artigo->autores, $nome) ?><br>
        <!-- Titulo -->
        <?= $artigo->titulo ?>.<br>
        <!-- Períodico -->
        <?= $artigo->tituloPeriodico ?>.<br>
        <!-- ISSN -->
        <?= $artigo->issn ? "ISSN: " . $artigo->issn . ". ": "" ?><br>
        <!-- Volume e Páginas e Ano-->
        <?=
          "v. " . $artigo->volume .
          ", p. " . $artigo->paginaInicial . ($artigo->paginaFinal ? "-" . $artigo->paginaFinal : "") .
          ", " . $artigo->ano
        ?>
        <!-- Área de Validação -->
        <div class="val-area">
          <?php if(!$artigo->validado): ?>
          <!-- NÃO VALIDADO // ENVIAR COMPROVANTE  -->
          <div class="col nao-validado">Não Validado</div>
          <div class="col nao-validado"><a href="#">Enviar Comprovante</a></div>
          <?php else: ?>
          <!-- VALIDADO // DATA VALIDACAO // VALIDADO POR (NOME VALIDADOR) // VER COMPROVANTE //  ALTERAR COMPROVANTE  -->

          <?php endif; ?>
        </div>
      </li>
  <?php endforeach; ?>
  </ul>
</div>
<!-- ARTIGOS END -->




<?php
  // Funções de Utilidade
  function autoresToString($autores, $nome){
    $string = '';
    foreach ($autores as $autor) {
      $flag = $nome == $autor['nomeCompleto'];
      $autor = explode(";",$autor['nomeCitacao']);
      $autor = $flag ? "<b>" . $autor[0] . "</b>" : $autor[0];
      $string .= $autor . '; ';
    }
    return rtrim($string, "; ");
  }
 ?>
