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
        <?= areaVal($artigo->validado) ?>
      </li>
  <?php endforeach; ?>
  </ul>
</div>
<!-- ARTIGOS END -->

<!-- BANCAS START -->
<h2>Bancas</h2>
<div class="hswrap"><button class='hide-show' onclick="toggle(this)"  ic='banca'>Esconder</button></div>
<div class="ic_wrapper" id='banca'>
  <div class='hswrap'><input type="text" class='search' ic='banca' oninput='search(this)' placeholder='Pesquisar...'></div>
  <ul class='itens'>
  <?php
  $tipos = array(
    1 => 'Graduação',
    2 => 'Especialização',
    3 => 'Mestrado',
    4 => 'Doutorado'
  );
  foreach ($curriculo->bancas as $i => $banca): ?>
      <li>
        <!-- Número -->
        <div class='number level-<?= strlen((string)$i+1) ?>'><?= $i+1 ?></div>
        <!-- Nomes de Citação -->
        <?= autoresToString($banca->participantes, $nome) ?><br>
        <!-- Orientado -->
        <?= "Participação em banca de " . $banca->nomeCandidato ?>.<br>
        <!-- Link, se possuir -->
        <?= ($banca->homepage ? "<a href='$banca->homepage'>" : "")?>
        <!-- Titulo -->
        <?= $banca->titulo ?>.<br>
        <?= ($banca->homepage ? "</a>" : "")?>
        <!-- ISSN -->
        <?= $banca->ano?><br>
        <!-- Tipo, curso e universidade -->
        <?=
          $tipos[$banca->tipo] . " em " . $banca->nomeCurso . " - " . $banca->nomeInstituicao
        ?>
        <!-- Área de Validação -->
        <?= areaVal($banca->validado) ?>
      </li>
  <?php endforeach; ?>
  </ul>
</div>
<!-- BANCAS END -->

<!-- CAPITULOS DE LIVROS START -->
<h2>Capítulos de Livros</h2>
<div class="hswrap"><button class='hide-show' onclick="toggle(this)"  ic='capLivro'>Esconder</button></div>
<div class="ic_wrapper" id='capLivro'>
  <div class='hswrap'><input type="text" class='search' ic='capLivro' oninput='search(this)' placeholder='Pesquisar...'></div>
  <ul class='itens'>
  <?php foreach ($curriculo->capLivros as $i => $capLivro): ?>
      <li>
        <!-- Número -->
        <div class='number level-<?= strlen((string)$i+1) ?>'><?= $i+1 ?></div>
        <!-- Nomes de Citação -->
        <?= autoresToString($capLivro->autores, $nome) ?><br>
        <!-- Link, se possuir -->
        <?= ($capLivro->homepage ? "<a href='http://$capLivro->homepage'>" : "")?>
        <!-- Titulo Capitulo -->
        <?= $capLivro->tituloCap ?>.<br>
        <?= ($capLivro->homepage ? "</a>" : "")?>
        <!-- Organizadores -->
        <?= $capLivro->organizadores ?>.<br>
        <!-- Titulo Livro -->
        <?= $capLivro->tituloLivro ?>.<br>
        <!-- Ano -->
        <?= $capLivro->ano?><br>
        <!-- ISBN -->
        <?= "ISBN: " . $capLivro->isbn?><br>
        <!-- Área de Validação -->
        <?= areaVal($capLivro->validado) ?>
      </li>
  <?php endforeach; ?>
  </ul>
</div>
<!-- CAPITULOS LIVRO END -->


<!-- COORDENAÇÃO DE PROJETOS START -->
<h2>Coordenação de Projetos</h2>
<div class="hswrap"><button class='hide-show' onclick="toggle(this)"  ic='coordProj'>Esconder</button></div>
<div class="ic_wrapper" id='coordProj'>
  <div class='hswrap'><input type="text" class='search' ic='coordProj' oninput='search(this)' placeholder='Pesquisar...'></div>
  <ul class='itens'>
  <?php
  $situacao = array("DESATIVADO" => 'Desativado', "EM_ANDAMENTO" => 'Em andamento', "CONCLUIDO" => "Concluído");
  $natureza = array("DESENVOLVIMENTO" => 'Desenvolvimento', "PESQUISA" => 'Pesquisa', "EXTENSAO" => "Extensão");
  foreach ($curriculo->coordProjs as $i => $coordProj): ?>
      <li>
        <!-- Número -->
        <div class='number level-<?= strlen((string)$i+1) ?>'><?= $i+1 ?></div>
        <!-- Titulo -->
        <?= $coordProj->nomeProj ?>.
        <!-- Duração -->
        <?=  "(<b>$coordProj->anoInicio - ".($coordProj->anoFim ? $coordProj->anoFim : "Atual")."</b>)" ?>
        <br><br>
        <!-- Descricao -->
        <?= "<b>Descricao:</b> " . $coordProj->descricao ?>.
        <!-- Situação -->
        <?= "<b>Situação:</b> " . $situacao[$coordProj->situacao] ?>.
        <!-- Natureza -->
        <?= "<b>Natureza:</b> " . $natureza[$coordProj->natureza] ?>.<br><br>
        <!-- Nomes de Citação -->
        <?= "<b>Integrantes:</b> " . equipeToString($coordProj->equipe, $nome, $coordProj->responsavel) ?><br>
        <!-- Área de Validação -->
        <?= areaVal($coordProj->validado) ?>
      </li>
  <?php endforeach; ?>
  </ul>
</div>
<!-- COORDENAÇÃO DE PROJETOS END -->

<!-- CORPOS EDITORIAIS START -->
<h2>Participação em Corpos Editoriais</h2>
<div class="hswrap"><button class='hide-show' onclick="toggle(this)"  ic='corpoEditorial'>Esconder</button></div>
<div class="ic_wrapper" id='corpoEditorial'>
  <div class='hswrap'><input type="text" class='search' ic='corpoEditorial' oninput='search(this)' placeholder='Pesquisar...'></div>
  <ul class='itens'>
  <?php
  foreach ($curriculo->corposEditoriais as $i => $corpoEditorial): ?>
      <li>
        <!-- Número -->
        <div class='number level-<?= strlen((string)$i+1) ?>'><?= $i+1 ?></div>
        <!-- Titulo -->
        <?= $corpoEditorial->nomeInstituicao ?>.
        <!-- Duração -->
        <?=  "(<b>$corpoEditorial->dataInicio - " . ($corpoEditorial->dataFim ? $corpoEditorial->dataFim : "Atual") ."</b>)" ?>
        <br>
        <!-- Descricao -->
        <!-- Situação -->
        <!-- Natureza -->
        <!-- Nomes de Citação -->
        <!-- Área de Validação -->
        <?= areaVal($corpoEditorial->validado) ?>
      </li>
  <?php endforeach; ?>
  </ul>
</div>
<!-- CORPOS EDITORIAIS END -->

<!-- LIVROS START -->
<h2>Livros</h2>
<div class="hswrap"><button class='hide-show' onclick="toggle(this)"  ic='livro'>Esconder</button></div>
<div class="ic_wrapper" id='livro'>
  <div class='hswrap'><input type="text" class='search' ic='livro' oninput='search(this)' placeholder='Pesquisar...'></div>
  <ul class='itens'>
    <?php foreach ($curriculo->livros as $i => $livro): ?>
        <li>
          <!-- Número -->
          <div class='number level-<?= strlen((string)$i+1) ?>'><?= $i+1 ?></div>
          <!-- Nomes de Citação -->
          <?= autoresToString($livro->autores, $nome) ?><br>
          <!-- Link, se possuir -->
          <?= ($livro->homepage ? "<a href='http://$livro->homepage'>" : "")?>
          <!-- Titulo Capitulo -->
          <?= $livro->titulo ?>.<br>
          <?= ($livro->homepage ? "</a>" : "")?>
          <!-- Organizadores -->
          <?= $livro->idioma ?>.<br>
          <!-- Titulo Livro -->
          <?= $livro->pais ?>.<br>
          <!-- Ano -->
          <?= $livro->ano?><br>
          <!-- Páginas -->
          <?= "p. " . $livro->numPags?><br>
          <!-- ISBN -->
          <?= "ISBN: " . $livro->isbn?><br>
          <!-- Área de Validação -->
          <?= areaVal($livro->validado) ?>
        </li>
    <?php endforeach; ?>
  </ul>
</div>
<!-- LIVROS END -->

<!-- MARCAS START -->
<h2>Marcas</h2>
<div class="hswrap"><button class='hide-show' onclick="toggle(this)"  ic='marca'>Esconder</button></div>
<div class="ic_wrapper" id='marca'>
  <div class='hswrap'><input type="text" class='search' ic='marca' oninput='search(this)' placeholder='Pesquisar...'></div>
  <ul class='itens'>
    <?php
    $tipos = array("MARCA_REGISTRADA_DE_SERVICO_MSV" => "Marca Registrada de Serviço");
    foreach ($curriculo->marcas as $i => $marca): ?>
        <li>
          <!-- Número -->
          <div class='number level-<?= strlen((string)$i+1) ?>'><?= $i+1 ?></div>
          <!-- Nomes de Citação -->
          <?= autoresToString($marca->autores, $nome) ?>.
          <!-- Titulo -->
          <?= $marca->titulo ?>,
          <!-- Ano -->
          <?= $marca->ano ?>.
          <!-- Titulo Livro -->
          <?= "Patente: " . $tipos[$marca->tipo] ?>.<br>
          <!-- Codigo -->
          <?= "Número do Registro: " . $marca->codigo?><br>
          <!-- Titulo -->
          <?= "Titulo: \"" . $marca->tituloPatente . "\""?>,
          <!-- instDeposito -->
          <?= "Instituição de Registro: " . $marca->instDeposito?>.<br>
          <!-- Área de Validação -->
          <?= areaVal($marca->validado) ?>
        </li>
    <?php endforeach; ?>
  </ul>
</div>
<!-- MARCAS END -->

<?php
  // Funções de Utilidade
  function areaVal($flag){ ?>
    <div class="val-area">
    <?php if(!$flag): ?>
    <!-- NÃO VALIDADO // ENVIAR COMPROVANTE  -->
    <div class="col nao-validado">Não Validado</div>
    <div class="col nao-validado"><a href="#">Enviar Comprovante</a></div>
    <?php else: ?>
    <!-- VALIDADO // DATA VALIDACAO // VALIDADO POR (NOME VALIDADOR) // VER COMPROVANTE //  ALTERAR COMPROVANTE  -->

    <?php endif; echo '</div>';
  }

  function equipeToString($equipe, $nome, $resp){
    $string = '';
    foreach($equipe as $autor){
      $flag = $nome == $autor['nomeCompleto'];
      $string .= $autor['nomeCompleto'] . ($flag ? ($resp ? " (Coordenador)" : " (Integrante)") : "") . " / ";
    }
    return rtrim($string, " / ");
  }

  function autoresToString($autores, $nome){
    $string = '';
    foreach ($autores as $autor) {
      $nro = false;
      $flag = $nome == $autor['nomeCompleto'];
      $nro = ($autor['numIdCNPQ'] ? "<a href='http://lattes.cnpq.br/" . $autor['numIdCNPQ'] . "'>" : false);
      $autor = explode(";",$autor['nomeCitacao']);
      $autor = $flag ? "<b>" . $autor[0] . "</b>" : $autor[0];
      $autor = ($nro ? $nro : "") . $autor . ($nro ? "</a>" : "");
      $string .= $autor . '; ';
    }
    return rtrim($string, "; ");
  }
 ?>
