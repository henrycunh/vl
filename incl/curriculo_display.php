<?php
  $curriculo = Curriculo::getCurriculoByEmail($conn, $email);
  $titulacaoType = array(1 => 'Doutorado', 2 => 'Mestrado', 3 => 'Especialista', 4 => 'Graduado');
  $nome = Curriculo::getNomeCompleto($conn, $id);
 ?>
<img src="imgs/loading.svg" id='load'>
<div class="curriculoContent">
<!-- TITULAÇÃO START -->
<h1>Titulação</h1>
<div class="hswrap"><button class='hide-show' onclick="toggle(this)" ic='titulacao'>Esconder</button></div>
<div class="ic_wrapper" id='titulacao'>
  <?php $titulacao = $curriculo->titulacao; ?>
  <!-- <tipo> em <nomeCurso> (<anoInicio> - <anoConclusao>)  -->
  <b><?= $titulacaoType[$titulacao->tipo] ?></b> em <?= $titulacao->nomeCurso ?>
  (<b><?= $titulacao->anoInicio ?></b> - <b><?= $titulacao->anoConclusao?></b>)
  <!-- Instituição: <instituicao> -->
  <p>
    <b>Instituição:</b> <?= $titulacao->instituicao ?>
  </p>
  <!-- Orientador: <orientador> -->
  <p>
    <b>Orientador:</b> <?= $titulacao->orientador ?>
  </p>
  <!-- Titulo: <titulo> -->
  <!-- Orientador: <orientador> -->
  <p>
    <b>Titulo:</b> <?= $titulacao->titulo ?>
  </p>
  <!-- Área de Validação -->
  <?= areaVal($titulacao->comprovante, $titulacao->validado, 'titulacao', $id, $titulacao->idTitulacao) ?>
</div>
<!-- TITULAÇÃO END -->



<!-- ARTIGOS START -->
<h1>Produção Bibliográfica</h1>
<?php if($curriculo->artigos): ?>
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
        <?= areaVal($artigo->comprovante,$artigo->validado, 'artigo', $id, $artigo->idArtigo) ?>
      </li>
  <?php endforeach; ?>
  </ul>
</div>
<?php endif; ?>
<!-- ARTIGOS END -->

<!-- BANCAS START -->
<?php if($curriculo->bancas): ?>
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
        <?= areaVal($banca->comprovante,$banca->validado, 'banca', $id, $banca->idBanca) ?>
      </li>
  <?php endforeach; ?>
  </ul>
</div>
<?php endif; ?>
<!-- BANCAS END -->

<!-- CAPITULOS DE LIVROS START -->
<?php if($curriculo->capLivros): ?>
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
        <?= areaVal($capLivro->comprovante,$capLivro->validado, 'capLivro', $id, $capLivro->idCapLivro) ?>
      </li>
  <?php endforeach; ?>
  </ul>
</div>
<?php endif; ?>
<!-- CAPITULOS LIVRO END -->


<!-- COORDENAÇÃO DE PROJETOS START -->
<?php if($curriculo->coordProjs): ?>
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
        <?= areaVal($coordProj->comprovante,$coordProj->validado, 'coordProj', $id, $coordProj->idCoordProj) ?>
      </li>
  <?php endforeach; ?>
  </ul>
</div>
<?php endif; ?>
<!-- COORDENAÇÃO DE PROJETOS END -->

<!-- CORPOS EDITORIAIS START -->
<?php if($curriculo->corposEditoriais): ?>
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
        <?= areaVal($corpoEditorial->comprovante,$corpoEditorial->validado, 'corpoEditorial', $id, $corpoEditorial->idCorpoEditorial) ?>
      </li>
  <?php endforeach; ?>
  </ul>
</div>
<?php endif; ?>
<!-- CORPOS EDITORIAIS END -->

<!-- LIVROS START -->
<?php if($curriculo->livros): ?>
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
          <?= areaVal($livro->comprovante,$livro->validado, 'livro', $id, $livro->idLivro) ?>
        </li>
    <?php endforeach; ?>
  </ul>
</div>
<?php endif; ?>
<!-- LIVROS END -->

<!-- MARCAS START -->
<?php if($curriculo->marcas): ?>
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
          <?= areaVal($marca->comprovante,$marca->validado, 'marca', $id, $marca->idMarca) ?>
        </li>
    <?php endforeach; ?>
  </ul>
</div>
<?php endif; ?>
<!-- MARCAS END -->

<!-- ORGANIZAÇÃO DE EVENTOS START -->
<?php if($curriculo->organizacaoEventos): ?>
<h2>Organização de Eventos</h2>
<div class="hswrap"><button class='hide-show' onclick="toggle(this)"  ic='organizacaoEvento'>Esconder</button></div>
<div class="ic_wrapper" id='organizacaoEvento'>
  <div class='hswrap'><input type="text" class='search' ic='organizacaoEvento' oninput='search(this)' placeholder='Pesquisar...'></div>
  <ul class='itens'>
    <?php
    foreach ($curriculo->organizacaoEventos as $i => $organizacaoEvento):
    $tipo = ucfirst(strtolower($organizacaoEvento->tipo))?>
        <li>
          <!-- Número -->
          <div class='number level-<?= strlen((string)$i+1) ?>'><?= $i+1 ?></div>
          <!-- Nomes de Citação -->
          <?= autoresToString($organizacaoEvento->autores, $nome) ?>.<br>
          <!-- Titulo -->
          <?= $organizacaoEvento->titulo ?>.
          <!-- Ano -->
          <?= $organizacaoEvento->ano ?>.
          <!-- Titulo Livro -->
          <?= "($tipo)"?>.<br>
          <!-- Instituicao -->
          <?= $organizacaoEvento->instituicaoPromotora ?> -
          <!-- Cidade -->
          <?= $organizacaoEvento->cidade ?>.
          <!-- Área de Validação -->
          <?= areaVal($organizacaoEvento->comprovante,$organizacaoEvento->validado, 'organizacaoEvento', $id, $organizacaoEvento->idOrganizacaoEvento) ?>
        </li>
    <?php endforeach; ?>
  </ul>
</div>
<?php endif; ?>
<!-- ORGANIZAÇÃO DE EVENTOS END -->

<!-- ORIENTAÇÕES START -->
<?php if($curriculo->orientacoes): ?>
<h2>Orientações</h2>
<div class="hswrap"><button class='hide-show' onclick="toggle(this)"  ic='orientacao'>Esconder</button></div>
<div class="ic_wrapper" id='orientacao'>
  <div class='hswrap'><input type="text" class='search' ic='orientacao' oninput='search(this)' placeholder='Pesquisar...'></div>
  <ul class='itens'>
    <?php
    $tipos = array(
      "Supervisão de pós-doutorado" => "Supervisão de pós-doutorado",
      "Dissertação de mestrado" => "Dissertação de mestrado",
      "MONOGRAFIA_DE_CONCLUSAO_DE_CURSO_APERFEICOAMENTO_E_ESPECIALIZACAO" => "Monografia de conclusão de Especialização",
      "INICIACAO_CIENTIFICA" => "Iniciação Científica",
      "TRABALHO_DE_CONCLUSAO_DE_CURSO_GRADUACAO" => "Trabalho de Conclusão de Curso de Graduação",
      "ORIENTACAO-DE-OUTRA-NATUREZA" => "Outro"
    );

    foreach ($curriculo->orientacoes as $i => $orientacao):?>
        <li>
          <!-- Número -->
          <div class='number level-<?= strlen((string)$i+1) ?>'><?= $i+1 ?></div>
          <!-- Nomes de Citação -->
          <?= $orientacao->nomeOrientado ?>.<br>
          <!-- Titulo -->
          <?= $orientacao->titulo ?>.
          <!-- Ano -->
          <?= $orientacao->ano ?>.<br>
          <!-- Natureza -->
          <?= $tipos[$orientacao->natureza] ?>.
          <!-- Instituição -->
          <?= $orientacao->nomeInstituicao ?>.
          <!-- Titulo Livro -->
          <?= $orientacao->nomeCurso?>.<br>
          <!-- Pais -->
          <?= $orientacao->pais ?>.
          <!-- Área de Validação -->
          <?= areaVal($orientacao->comprovante,$orientacao->validado, 'orientacao', $id, $orientacao->idOrientacao) ?>
        </li>
    <?php endforeach; ?>
  </ul>
</div>
<?php endif; ?>
<!-- ORIENTAÇÕES END -->

<!-- PATENTES START -->
<?php if($curriculo->patentes): ?>
<h2>Patentes</h2>
<div class="hswrap"><button class='hide-show' onclick="toggle(this)"  ic='patente'>Esconder</button></div>
<div class="ic_wrapper" id='patente'>
  <div class='hswrap'><input type="text" class='search' ic='patente' oninput='search(this)' placeholder='Pesquisar...'></div>
  <ul class='itens'>
    <?php
    $tipos = array("PRIVILEGIO_DE_INOVACAO_PI" => "Privilégio de Inovação");
    foreach ($curriculo->patentes as $i => $patente): ?>
        <li>
          <!-- Número -->
          <div class='number level-<?= strlen((string)$i+1) ?>'><?= $i+1 ?></div>
          <!-- Nomes de Citação -->
          <?= autoresToString($patente->autores, $nome) ?>.<br>
          <!-- Titulo -->
          <?= $patente->titulo ?>,
          <!-- Ano -->
          <?= $patente->ano ?>.<br>
          <!-- Patente -->
          <?= "Patente: " . $tipos[$patente->tipo] ?>.<br>
          <!-- Codigo -->
          <?= "Número do Registro: " . $patente->codigo?><br>
          <!-- Titulo -->
          <?= "Titulo: \"" . $patente->tituloPatente . "\""?>,
          <!-- instDeposito -->
          <?= "Instituição de Registro: " . $patente->instituicaoDeposito?>.<br>
          <!-- Área de Validação -->
          <?= areaVal($patente->comprovante,$patente->validado, 'patente', $id, $patente->idPatente) ?>
        </li>
    <?php endforeach; ?>
  </ul>
</div>
<?php endif; ?>
<!-- PATENTES END -->

<!-- SOFTWARE START -->
<?php if($curriculo->softwares): ?>
<h2>Softwares</h2>
<div class="hswrap"><button class='hide-show' onclick="toggle(this)"  ic='software'>Esconder</button></div>
<div class="ic_wrapper" id='software'>
  <div class='hswrap'><input type="text" class='search' ic='software' oninput='search(this)' placeholder='Pesquisar...'></div>
  <ul class='itens'>
    <?php
    $tipos = array("PRIVILEGIO_DE_INOVACAO_PI" => "Privilégio de Inovação");
    foreach ($curriculo->softwares as $i => $software): ?>
        <li>
          <!-- Número -->
          <div class='number level-<?= strlen((string)$i+1) ?>'><?= $i+1 ?></div>
          <!-- Nomes de Citação -->
          <?= autoresToString($software->autores, $nome) ?>.<br>
          <!-- Link, se possuir -->
          <?= ($software->homepage ? "<a href='http://$software->homepage'>" : "")?>
          <!-- Titulo Capitulo -->
          <?= $software->titulo ?>.<br>
          <?= ($software->homepage ? "</a>" : "")?>
          <!-- Ano -->
          <?= $software->ano ?>.<br>
          <!-- Área de Validação -->
          <?= areaVal($software->comprovante,$software->validado, 'software', $id, $software->idSoftware) ?>
        </li>
    <?php endforeach; ?>
  </ul>
</div>
<?php endif; ?>
<!-- SOFTWARE END -->

<!-- SOFTWARE START -->
<?php if($curriculo->trabEventos): ?>
<h2>Trabalho Realizado em Evento</h2>
<div class="hswrap"><button class='hide-show' onclick="toggle(this)"  ic='trabEvento'>Esconder</button></div>
<div class="ic_wrapper" id='trabEvento'>
  <div class='hswrap'><input type="text" class='search' ic='trabEvento' oninput='search(this)' placeholder='Pesquisar...'></div>
  <ul class='itens'>
    <?php
    foreach ($curriculo->trabEventos as $i => $trabEvento): ?>
        <li>
          <!-- Número -->
          <div class='number level-<?= strlen((string)$i+1) ?>'><?= $i+1 ?></div>
          <!-- Nomes de Citação -->
          <?= autoresToString($trabEvento->autores, $nome) ?>.<br>
          <!-- Link, se possuir -->
          <?= ($trabEvento->homepage ? "<a href='http://$trabEvento->homepage'>" : "")?>
          <!-- Titulo Capitulo -->
          <?= $trabEvento->titulo ?>.<br>
          <?= ($trabEvento->homepage ? "</a>" : "")?>
          <!-- Nome Evento -->
          <?= $trabEvento->nomeEvento ?>,
          <!-- Ano Realizacao -->
          <?= $trabEvento->anoRealizacao ?>,
          <!-- Cidade -->
          <?= $trabEvento->cidadeEvento ?>,
          <!-- Pais -->
          <?= $trabEvento->pais ?>.<br>
          <!-- Titulo Anais -->
          <?= $trabEvento->titulosAnais ?>,
          <!-- Ano -->
          <?= $trabEvento->ano ?>.
          <!-- Páginas -->
          <?= "p. " . $trabEvento->pagInicial . "-" . $trabEvento->pagFinal ?>.
          <!-- Área de Validação -->
          <?= areaVal($trabEvento->comprovante,$trabEvento->validado, "trabEvento", $id, $trabEvento->idTrabEvento) ?>
        </li>
    <?php endforeach; ?>
  </ul>
</div>
<?php endif; ?>
<!-- TRAB EVENTO END -->
</div>
<?php
  // Funções de Utilidade
  function areaVal($comprovante, $flag, $ic, $curriculoId, $icId){ ?>
    <div class="val-area">
    <?php if(!$flag): ?>
    <!-- NÃO VALIDADO // ENVIAR COMPROVANTE  -->
    <div class="col nao-validado">Não Validado</div>
    <div class="col nao-validado"><a href="#" class='enviarCurriculo' onclick='exibirEnvioCurriculo(this)' filename='<?= "$ic-$curriculoId-$icId" ?>'>Enviar Comprovante</a></div>
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
