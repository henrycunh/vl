<?php
  $titulacaoType = array(1 => 'Graduação', 2 => 'Especialização', 3 => 'Mestrado', 4 => 'Doutorado');
 ?>

<div class="curriculoContent">

<!--
888888 88 888888 88   88 88        db     dP""b8    db     dP"Yb
  88   88   88   88   88 88       dPYb   dP   `"   dPYb   dP   Yb
  88   88   88   Y8   8P 88  .o  dP__Yb  Yb       dP__Yb  Yb   dP
  88   88   88   `YbodP' 88ood8 dP""""Yb  YboodP dP""""Yb  YbodP
TITULAÇÃO START -->
<div class="ui accordion ic_wrapper" >
<div class='title'><h2><i class='dropdown icon'></i>Titulação</h2></div>
  <div class="ui segment padded content att" id='titulacao'>
    <div class="ui grid">
      <div class="six wide column"></div>
      <div class="five wide column">
        <select ic='titulacao' class='ui fluid dropdown' onchange='showOnly(this)'>
          <option value='showAll'>Mostrar todos</option>
          <option value='showComp'>Mostrar comprovados</option>
          <option value='showNonComp'>Mostrar não comprovados</option>
        </select>
      </div>
      <div class="five wide column">
        <div class="ui icon fluid input">
          <input type="text" class='ui input' ic='titulacao' oninput='search(this)' placeholder='Pesquisar...'>
          <i class=' search icon'></i>
        </div>
      </div>

    </div>
    <div class="ui divider"></div>
    <div class='ui relaxed list'>
    <?php foreach ($curriculo->titulacoes as $i => $titulacao): ?>
        <div class='item'>
          <div class="ui segment secondary">
          <div class="ui description smll">
            <div class='ui label mini ribbon sh'><?= $i+1 ?>   <i class='caret right icon'></i></div>
             <span class='itemtitle'>
               <b><?= $titulacaoType[$titulacao->tipo] ?></b> em <?= $titulacao->nomeCurso ?>
               (<b><?= $titulacao->anoInicio ?></b> - <b><?= $titulacao->anoConclusao?></b>)
            </span>
          </div>
          <!-- Número -->
          <!-- <div class="sh level-<?= strlen((string)$i+1) ?>">🡫</div> -->
          <!-- <tipo> em <nomeCurso> (<anoInicio> - <anoConclusao>)  -->
          <div class="dados">
          <!-- Instituição: <instituicao> -->
            <b>Instituição:</b> <?= $titulacao->instituicao ?><br>
          <!-- Orientador: <orientador> -->
            <b>Orientador:</b> <?= $titulacao->orientador ?><br>
          <!-- Titulo: <titulo> -->
          <!-- Orientador: <orientador> -->
            <b>Titulo:</b> <?= $titulacao->titulo ?><br>
          </div>
          <!-- Área de Validação -->
          <?= areaVal($titulacao->comprovante, $titulacao->validado, 'titulacao', $id, $titulacao->idTitulacao) ?>
        </div>
        </div>
    <?php endforeach; ?>
  </div>
</div>
</div>
<!-- TITULAÇÃO END -->



<!--
   db    88""Yb 888888 88  dP""b8  dP"Yb  .dP"Y8
  dPYb   88__dP   88   88 dP   `" dP   Yb `Ybo."
 dP__Yb  88"Yb    88   88 Yb  "88 Yb   dP o.`Y8b
dP""""Yb 88  Yb   88   88  YboodP  YbodP  8bodP'
ARTIGOS START -->
<h1>Produção Bibliográfica</h1>
<div class="ui accordion ic_wrapper">
<?php if ($curriculo->artigos): ?>
  <div class='title'><h2><i class='dropdown icon'></i>Artigos</h2></div>
    <div class="ui segment padded content att" id='artigo'>
      <div class="ui grid">
        <div class="six wide column"></div>
        <div class="five wide column">
          <select ic='artigo' class='ui fluid dropdown' onchange='showOnly(this)'>
            <option value='showAll'>Mostrar todos</option>
            <option value='showComp'>Mostrar comprovados</option>
            <option value='showNonComp'>Mostrar não comprovados</option>
          </select>
        </div>
        <div class="five wide column">
          <div class="ui icon fluid input">
            <input type="text" class='ui input' ic='artigo' oninput='search(this)' placeholder='Pesquisar...'>
            <i class=' search icon'></i>
          </div>
        </div>

      </div>
      <div class="ui divider"></div>
      <div class='ui relaxed list'>
  <?php foreach ($curriculo->artigos as $i => $artigo): ?>
      <div class='item'>
        <div class="ui segment secondary">
          <div class="ui description smll">
            <!-- Número -->
            <div class='ui label mini ribbon sh'><?= $i+1 ?>   <i class='caret right icon'></i></div>
            <!-- Titulo -->
            <?= "<b>Titulo</b>: " . $artigo->titulo  ?>.<br>
            <!-- Nomes de Citação -->
            <?= autoresToString($artigo->autores, $nome) . " (<b>$artigo->ano</b>)" ?><br>
            <div class="dados">
            <!-- Períodico -->
            <?= "<b>Titulo do Periódico:</b> $artigo->tituloPeriodico" ?>.<br>
            <!-- ISSN -->
            <?= $artigo->issn ? "<b>ISSN:</b> " . $artigo->issn : "" ?><br>
            <!-- Volume e Páginas e Ano-->
            <?=
              "<b>Volume:</b> " . $artigo->volume .
              "<br><b>Páginas:</b> " . $artigo->paginaInicial . ($artigo->paginaFinal ? "-" . $artigo->paginaFinal : "")
            ?>
          </div>
        </div>
        <!-- Área de Validação -->
        <?= areaVal($artigo->comprovante, $artigo->validado, 'artigo', $id, $artigo->idArtigo) ?>
      </div>
    </div>
  <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>
<!-- ARTIGOS END -->


<!--
 dP""b8    db    88""Yb         88     88 Yb    dP 88""Yb  dP"Yb  .dP"Y8
dP   `"   dPYb   88__dP         88     88  Yb  dP  88__dP dP   Yb `Ybo."
Yb       dP__Yb  88"""  .o.     88  .o 88   YbdP   88"Yb  Yb   dP o.`Y8b
 YboodP dP""""Yb 88     `"'     88ood8 88    YP    88  Yb  YbodP  8bodP'
CAPITULOS DE LIVROS START -->
<?php if ($curriculo->capLivros): ?>
  <div class='title'><h2><i class='dropdown icon'></i>Capítulos de Livros</h2></div>
    <div class="ui segment padded content att" id='capLivro'>
      <div class="ui grid">
        <div class="six wide column"></div>
        <div class="five wide column">
          <select ic='capLivro' class='ui fluid dropdown' onchange='showOnly(this)'>
            <option value='showAll'>Mostrar todos</option>
            <option value='showComp'>Mostrar comprovados</option>
            <option value='showNonComp'>Mostrar não comprovados</option>
          </select>
        </div>
        <div class="five wide column">
          <div class="ui icon fluid input">
            <input type="text" class='ui input' ic='capLivro' oninput='search(this)' placeholder='Pesquisar...'>
            <i class=' search icon'></i>
          </div>
        </div>

      </div>
      <div class="ui divider"></div>
      <div class='ui relaxed list'>
  <?php foreach ($curriculo->capLivros as $i => $capLivro): ?>
      <div class='item'>
        <div class="ui segment secondary">
          <div class="ui description smll">
        <!-- Número -->
        <div class='ui label mini ribbon sh'><?= $i+1 ?>   <i class='caret right icon'></i></div>
        <!-- Nomes de Citação -->
        <?= autoresToString($capLivro->autores, $nome) . " (<b>$capLivro->ano</b>)" ?><br>
        <!-- Link, se possuir -->
        <?= ($capLivro->homepage ? "<a href='http://$capLivro->homepage'>" : "")?>
          <!-- Titulo Capitulo -->
          <?= $capLivro->tituloCap ?>.<br>
          <?= ($capLivro->homepage ? "</a>" : "")?>
        <div class="dados">
        <!-- Organizadores -->
        <?= "<b>Organizadores:</b> $capLivro->organizadores" ?>.<br>
        <!-- Titulo Livro -->
        <?= "<b>Titulo do Livro:</b> $capLivro->tituloLivro" ?>.<br>
        <!-- ISBN -->
        <?= "<b>ISBN:</b> $capLivro->isbn" ?><br>
      </div>
    </div>
        <!-- Área de Validação -->
        <?= areaVal($capLivro->comprovante, $capLivro->validado, 'capLivro', $id, $capLivro->idCapLivro) ?>
      </div>
      </div>
  <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>
<!-- CAPITULOS LIVRO END -->



<!--
 dP""b8  dP"Yb  88""Yb 88""Yb  dP"Yb      888888 8888b.  88 888888
dP   `" dP   Yb 88__dP 88__dP dP   Yb     88__    8I  Yb 88   88
Yb      Yb   dP 88"Yb  88"""  Yb   dP     88""    8I  dY 88   88   .o.
 YboodP  YbodP  88  Yb 88      YbodP      888888 8888Y"  88   88   `"'
CORPOS EDITORIAIS START -->
<?php if ($curriculo->corposEditoriais): ?>
  <div class='title'><h2><i class='dropdown icon'></i>Participações em Corpos Editoriais</h2></div>
    <div class="ui segment padded content att" id='corpoEditorial'>
      <div class="ui grid">
        <div class="six wide column"></div>
        <div class="five wide column">
          <select ic='corpoEditorial' class='ui fluid dropdown' onchange='showOnly(this)'>
            <option value='showAll'>Mostrar todos</option>
            <option value='showComp'>Mostrar comprovados</option>
            <option value='showNonComp'>Mostrar não comprovados</option>
          </select>
        </div>
        <div class="five wide column">
          <div class="ui icon fluid input">
            <input type="text" class='ui input' ic='corpoEditorial' oninput='search(this)' placeholder='Pesquisar...'>
            <i class=' search icon'></i>
          </div>
        </div>

      </div>
      <div class="ui divider"></div>
      <div class='ui relaxed list'>
  <?php
  foreach ($curriculo->corposEditoriais as $i => $corpoEditorial): ?>
      <div class='item'>
        <div class="ui segment secondary">
          <div class="ui description smll">
        <!-- Número -->
        <div class='ui label mini ribbon sh'><?= $i+1 ?>   <i class='caret right icon'></i></div>
        <!-- Titulo -->
        <?= $corpoEditorial->nomeInstituicao ?>.
        <?=  "(<b>$corpoEditorial->dataInicio - " . ($corpoEditorial->dataFim ? $corpoEditorial->dataFim : "Atual") ."</b>)" ?>
        <!-- Área de Validação -->
        <?= areaVal($corpoEditorial->comprovante, $corpoEditorial->validado, 'corpoEditorial', $id, $corpoEditorial->idCorpoEditorial) ?>

      </div>
      </div>
      </div>
  <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>
<!-- CORPOS EDITORIAIS END -->

<!--
88     88 Yb    dP 88""Yb  dP"Yb  .dP"Y8
88     88  Yb  dP  88__dP dP   Yb `Ybo."
88  .o 88   YbdP   88"Yb  Yb   dP o.`Y8b
88ood8 88    YP    88  Yb  YbodP  8bodP'
LIVROS START -->
<?php if ($curriculo->livros): ?>
<div class='title'><h2><i class='dropdown icon'></i>Livros</h2></div>
  <div class="ui segment padded content att" id='livro'>
    <div class="ui grid">
      <div class="six wide column"></div>
      <div class="five wide column">
        <select ic='livro' class='ui fluid dropdown' onchange='showOnly(this)'>
          <option value='showAll'>Mostrar todos</option>
          <option value='showComp'>Mostrar comprovados</option>
          <option value='showNonComp'>Mostrar não comprovados</option>
        </select>
      </div>
      <div class="five wide column">
        <div class="ui icon fluid input">
          <input type="text" class='ui input' ic='livro' oninput='search(this)' placeholder='Pesquisar...'>
          <i class='search icon'></i>
        </div>
      </div>

    </div>
    <div class="ui divider"></div>
    <div class='ui relaxed list'>
    <?php foreach ($curriculo->livros as $i => $livro): ?>
        <div class='item'>
          <div class="ui segment secondary">
            <div class="ui description smll">
          <!-- Número -->
          <div class='ui label mini ribbon sh'><?= $i+1 ?>   <i class='caret right icon'></i></div>
          <!-- Nomes de Citação -->
          <?= autoresToString($livro->autores, $nome) . " (<b>$livro->ano</b>)" ?><br>
          <!-- Link, se possuir -->
          <?= "<b>Titulo:</b>" . ($livro->homepage ? "<a href='http://$livro->homepage'>" : "")?>
            <!-- Titulo -->
            <?= "$livro->titulo" ?>.<br>
            <?= ($livro->homepage ? "</a>" : "")?>
          <div class="dados">
          <!-- Idioma -->
          <?= "<b>Idioma:</b> $livro->idioma" ?>.<br>
          <!-- Pais -->
          <?= "<b>País</b>: $livro->pais" ?>.<br>
          <!-- Páginas -->
          <?= "<b>Páginas</b>: $livro->numPags" ?><br>
          <!-- ISBN -->
          <?= "<b>ISBN</b>: $livro->isbn"?><br>

          </div>
          </div>
          <!-- Área de Validação -->
          <?= areaVal($livro->comprovante, $livro->validado, 'livro', $id, $livro->idLivro) ?>
        </div>
        </div>
    <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>
<!-- LIVROS END -->


<!--
888888 88""Yb    db    88""Yb         888888 Yb    dP 888888 88b 88 888888  dP"Yb
  88   88__dP   dPYb   88__dP         88__    Yb  dP  88__   88Yb88   88   dP   Yb
  88   88"Yb   dP__Yb  88""Yb .o.     88""     YbdP   88""   88 Y88   88   Yb   dP
  88   88  Yb dP""""Yb 88oodP `"'     888888    YP    888888 88  Y8   88    YbodP
 TRABALHO EM EVENTO START -->
<?php if ($curriculo->trabEventos): ?>
<div class='title'><h2><i class='dropdown icon'></i>Trabalhos em Eventos</h2></div>
  <div class="ui segment padded content att" id='trabEvento'>
    <div class="ui grid">
      <div class="six wide column"></div>
      <div class="five wide column">
        <select ic='trabEvento' class='ui fluid dropdown' onchange='showOnly(this)'>
          <option value='showAll'>Mostrar todos</option>
          <option value='showComp'>Mostrar comprovados</option>
          <option value='showNonComp'>Mostrar não comprovados</option>
        </select>
      </div>
      <div class="five wide column">
        <div class="ui icon fluid input">
          <input type="text" class='ui input' ic='trabEvento' oninput='search(this)' placeholder='Pesquisar...'>
          <i class='search icon'></i>
        </div>
      </div>

    </div>
    <div class="ui divider"></div>
    <div class='ui relaxed list'>
    <?php
    foreach ($curriculo->trabEventos as $i => $trabEvento): ?>
        <div class='item'>
          <div class="ui segment secondary">
            <div class="ui description smll">
          <!-- Número -->
          <div class='ui label mini ribbon sh'><?= $i+1 ?>   <i class='caret right icon'></i></div>
          <!-- Nomes de Citação -->
          <?= autoresToString($trabEvento->autores, $nome) . " (<b>$trabEvento->ano</b>)"?>.<br>
          <!-- Link, se possuir -->
          <?="<b>Titulo:</b> " . ($trabEvento->homepage ? "<a href='http://$trabEvento->homepage'>" : "")?>
            <!-- Titulo Capitulo -->
            <?= $trabEvento->titulo ?>.<br>
            <?= ($trabEvento->homepage ? "</a>" : "")?>
          <div class="dados">
          <!-- Nome Evento -->
          <?= "<b>Nome do Evento</b>: $trabEvento->nomeEvento" ?><br>
          <!-- Ano Realizacao -->
          <?= "<b>Ano de Realização</b>: $trabEvento->anoRealizacao" ?><br>
          <!-- Cidade -->
          <?= "<b>Cidade</b>: $trabEvento->cidadeEvento" ?><br>
          <!-- Pais -->
          <?= "<b>País</b>: $trabEvento->pais" ?><br>
          <!-- Titulo Anais -->
          <?= "<b>Título nos Anais</b>: $trabEvento->titulosAnais" ?><br>
          <!-- Páginas -->
          <?= "<b>Páginas</b>: " . $trabEvento->pagInicial . "-" . $trabEvento->pagFinal ?>
          </div>
        </div>
          <!-- Área de Validação -->
          <?= areaVal($trabEvento->comprovante, $trabEvento->validado, "trabEvento", $id, $trabEvento->idTrabEvento) ?>
        </div>
        </div>
    <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>
<!-- TRAB EVENTO END -->
</div>

<h1>Produção não Bibliográfica</h1>

<!--
88""Yb    db    88b 88  dP""b8    db    .dP"Y8
88__dP   dPYb   88Yb88 dP   `"   dPYb   `Ybo."
88""Yb  dP__Yb  88 Y88 Yb       dP__Yb  o.`Y8b
88oodP dP""""Yb 88  Y8  YboodP dP""""Yb 8bodP'
BANCAS START -->
<div class="ui accordion ic_wrapper">
<?php if ($curriculo->bancas): ?>
<div class='title'><h2><i class='dropdown icon'></i>Bancas</h2></div>
  <div class="ui segment padded content att" id='banca'>
    <div class="ui grid">
      <div class="six wide column"></div>
      <div class="five wide column">
        <select ic='banca' class='ui fluid dropdown' onchange='showOnly(this)'>
          <option value='showAll'>Mostrar todos</option>
          <option value='showComp'>Mostrar comprovados</option>
          <option value='showNonComp'>Mostrar não comprovados</option>
        </select>
      </div>
      <div class="five wide column">
        <div class="ui icon fluid input">
          <input type="text" class='ui input' ic='banca' oninput='search(this)' placeholder='Pesquisar...'>
          <i class='search icon'></i>
        </div>
      </div>

    </div>
    <div class="ui divider"></div>
    <div class='ui relaxed list'>
  <?php
  $tipos = array(
    1 => 'Graduação',
    2 => 'Especialização',
    3 => 'Mestrado',
    4 => 'Doutorado'
  );
  foreach ($curriculo->bancas as $i => $banca): ?>
      <div class='item'>
        <div class="ui segment secondary">
          <div class="ui description smll">
        <!-- Número -->
        <div class='ui label mini ribbon sh'><?= $i+1 ?>   <i class='caret right icon'></i></div>
        <!-- Nomes de Citação -->
        <?= autoresToString($banca->participantes, $nome) ?><br>
        <?= "Participação em banca de <b>$banca->nomeCandidato</b> (<b>$banca->ano</b>)" ?>.<br>
        <div class="dados">
        <!-- Orientado -->
        <!-- Link, se possuir -->
        <?= "<b>Título</b>: " . ($banca->homepage ? "<a href='$banca->homepage'>" : "")?>
        <!-- Titulo -->
        <?= $banca->titulo ?>.<br>
        <?= ($banca->homepage ? "</a>" : "")?>
        <!-- Nível-->
        <?= "<b>Nível</b>: " . $tipos[$banca->tipo]?><br>
        <?= "<b>Curso</b>: $banca->nomeCurso" ?><br>
        <?= "<b>Instituição</b>: $banca->nomeInstituicao" ?>
      </div>
        <!-- Área de Validação -->
        <?= areaVal($banca->comprovante, $banca->validado, 'banca', $id, $banca->idBanca) ?>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>
<!-- BANCAS END -->

<!--
 dP""b8  dP"Yb   dP"Yb  88""Yb 8888b.          88""Yb 88""Yb  dP"Yb   88888
dP   `" dP   Yb dP   Yb 88__dP  8I  Yb         88__dP 88__dP dP   Yb     88
Yb      Yb   dP Yb   dP 88"Yb   8I  dY .o.     88"""  88"Yb  Yb   dP o.  88 .o.
 YboodP  YbodP   YbodP  88  Yb 8888Y"  `"'     88     88  Yb  YbodP  "bodP' `"'
COORDENAÇÃO DE PROJETOS START -->
<?php if ($curriculo->coordProjs): ?>
  <div class='title'><h2><i class='dropdown icon'></i>Coordenação de Projetos</h2></div>
    <div class="ui segment padded content att" id='coordProj'>
      <div class="ui grid">
        <div class="six wide column"></div>
        <div class="five wide column">
          <select ic='coordProj' class='ui fluid dropdown' onchange='showOnly(this)'>
            <option value='showAll'>Mostrar todos</option>
            <option value='showComp'>Mostrar comprovados</option>
            <option value='showNonComp'>Mostrar não comprovados</option>
          </select>
        </div>
        <div class="five wide column">
          <div class="ui icon fluid input">
            <input type="text" class='ui input' ic='coordProj' oninput='search(this)' placeholder='Pesquisar...'>
            <i class='search icon'></i>
          </div>
        </div>

      </div>
      <div class="ui divider"></div>
      <div class='ui relaxed list'>
  <?php
  $situacao = array("DESATIVADO" => 'Desativado', "EM_ANDAMENTO" => 'Em andamento', "CONCLUIDO" => "Concluído");
  $natureza = array("DESENVOLVIMENTO" => 'Desenvolvimento', "PESQUISA" => 'Pesquisa', "EXTENSAO" => "Extensão");
  foreach ($curriculo->coordProjs as $i => $coordProj): ?>
      <div class='item'>
        <div class="ui segment secondary">
          <div class="ui description smll">
        <!-- Número -->
        <div class='ui label mini ribbon sh'><?= $i+1 ?>   <i class='caret right icon'></i></div>
        <!-- Titulo -->
        <?= "<b>Nome do Projeto</b>: $coordProj->nomeProj" ?>
        <?=  "(<b>$coordProj->anoInicio - ".($coordProj->anoFim ? $coordProj->anoFim : "Atual")."</b>)" ?>
        <div class="dados">
        <!-- Duração -->
        <br><br>
        <!-- Descricao -->
        <?= "<b>Descricao:</b> " . $coordProj->descricao ?>.
        <!-- Situação -->
        <?= "<b>Situação:</b> " . $situacao[$coordProj->situacao] ?>.
        <!-- Natureza -->
        <?= "<b>Natureza:</b> " . $natureza[$coordProj->natureza] ?>.<br><br>
        <!-- Nomes de Citação -->
        <?= "<b>Integrantes:</b> " . equipeToString($coordProj->equipe, $nome, $coordProj->responsavel) ?><br>
      </div>
    </div>
        <!-- Área de Validação -->
        <?= areaVal($coordProj->comprovante, $coordProj->validado, 'coordProj', $id, $coordProj->idCoordProj) ?>
      </div>
      </div>
  <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>
<!-- COORDENAÇÃO DE PROJETOS END -->


<!--
8b    d8    db    88""Yb  dP""b8    db    .dP"Y8
88b  d88   dPYb   88__dP dP   `"   dPYb   `Ybo."
88YbdP88  dP__Yb  88"Yb  Yb       dP__Yb  o.`Y8b
88 YY 88 dP""""Yb 88  Yb  YboodP dP""""Yb 8bodP'
 MARCAS START -->
<?php if ($curriculo->marcas): ?>
  <div class='title'><h2><i class='dropdown icon'></i>Marcas</h2></div>
    <div class="ui segment padded content att" id='marca'>
      <div class="ui grid">
        <div class="six wide column"></div>
        <div class="five wide column">
          <select ic='marca' class='ui fluid dropdown' onchange='showOnly(this)'>
            <option value='showAll'>Mostrar todos</option>
            <option value='showComp'>Mostrar comprovados</option>
            <option value='showNonComp'>Mostrar não comprovados</option>
          </select>
        </div>
        <div class="five wide column">
          <div class="ui icon fluid input">
            <input type="text" class='ui input' ic='marca' oninput='search(this)' placeholder='Pesquisar...'>
            <i class='search icon'></i>
          </div>
        </div>

      </div>
      <div class="ui divider"></div>
      <div class='ui relaxed list'>
    <?php
    $tipos = array("MARCA_REGISTRADA_DE_SERVICO_MSV" => "Marca Registrada de Serviço");
    foreach ($curriculo->marcas as $i => $marca): ?>
        <div class='item'>
          <div class="ui segment secondary">
            <div class="ui description smll">
          <!-- Número -->
          <div class='ui label mini ribbon sh'><?= $i+1 ?>   <i class='caret right icon'></i></div>
          <!-- Nomes de Citação -->
          <?= autoresToString($marca->autores, $nome) ?>.
          <!-- Titulo -->
          <?= "<b>Título</b>: $marca->titulo (<b>$marca->ano</b>)" ?>,
          <div class="dados">
          <!-- Ano -->
          <?= $marca->ano ?>.
          <!-- Titulo Livro -->
          <?= "<b>Patente:</b> " . $tipos[$marca->tipo] ?>.<br>
          <!-- Codigo -->
          <?= "<b>Número do Registro:</b> " . $marca->codigo?><br>
          <!-- Titulo -->
          <?= "<b>Titulo da Patente:</b> \"" . $marca->tituloPatente . "\""?>,
          <!-- instDeposito -->
          <?= "<b>Instituição de Registro:</b> " . $marca->instDeposito?>.<br>

        </div>
      </div>
          <!-- Área de Validação -->
          <?= areaVal($marca->comprovante, $marca->validado, 'marca', $id, $marca->idMarca) ?>
        </div>
        </div>
    <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>
<!-- MARCAS END -->

<!--
 dP"Yb  88""Yb  dP""b8         888888 Yb    dP 888888 88b 88 888888  dP"Yb  .dP"Y8
dP   Yb 88__dP dP   `"         88__    Yb  dP  88__   88Yb88   88   dP   Yb `Ybo."
Yb   dP 88"Yb  Yb  "88 .o.     88""     YbdP   88""   88 Y88   88   Yb   dP o.`Y8b
 YbodP  88  Yb  YboodP `"'     888888    YP    888888 88  Y8   88    YbodP  8bodP'
ORGANIZAÇÃO DE EVENTOS START -->
<?php if ($curriculo->organizacaoEventos): ?>
  <div class='title'><h2><i class='dropdown icon'></i>Organização de Eventos</h2></div>
    <div class="ui segment padded content att" id='organizacaoEvento'>
      <div class="ui grid">
        <div class="six wide column"></div>
        <div class="five wide column">
          <select ic='organizacaoEvento' class='ui fluid dropdown' onchange='showOnly(this)'>
            <option value='showAll'>Mostrar todos</option>
            <option value='showComp'>Mostrar comprovados</option>
            <option value='showNonComp'>Mostrar não comprovados</option>
          </select>
        </div>
        <div class="five wide column">
          <div class="ui icon fluid input">
            <input type="text" class='ui input' ic='organizacaoEvento' oninput='search(this)' placeholder='Pesquisar...'>
            <i class='search icon'></i>
          </div>
        </div>

      </div>
      <div class="ui divider"></div>
      <div class='ui relaxed list'>
    <?php
    foreach ($curriculo->organizacaoEventos as $i => $organizacaoEvento):
    $tipo = ucfirst(strtolower($organizacaoEvento->tipo))?>
        <div class='item'>
          <div class="ui segment secondary">
            <div class="ui description smll">
          <!-- Número -->
          <div class='ui label mini ribbon sh'><?= $i+1 ?>   <i class='caret right icon'></i></div>
          <!-- Nomes de Citação -->
          <?= autoresToString($organizacaoEvento->autores, $nome) . " (<b>$organizacaoEvento->ano</b>)"?><br>
          <?= "<b>Título</b>: $organizacaoEvento->titulo" ?><br>
          <div class="dados">
          <!-- Titulo -->
          <!-- Ano -->
          <!-- Titulo Livro -->
          <?= "<b>Tipo</b>: $tipo"?><br>
          <!-- Instituicao -->
          <?= "<b>Instituição</b>: $organizacaoEvento->instituicaoPromotora" ?><br>
          <!-- Cidade -->
          <?= "<b>Cidade</b>: $organizacaoEvento->cidade" ?>

        </div>
      </div>
          <!-- Área de Validação -->
          <?= areaVal($organizacaoEvento->comprovante, $organizacaoEvento->validado, 'organizacaoEvento', $id, $organizacaoEvento->idOrganizacaoEvento) ?>
        </div>
        </div>
    <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>
<!-- ORGANIZAÇÃO DE EVENTOS END -->


<!--
88""Yb    db    888888 888888 88b 88 888888 888888 .dP"Y8
88__dP   dPYb     88   88__   88Yb88   88   88__   `Ybo."
88"""   dP__Yb    88   88""   88 Y88   88   88""   o.`Y8b
88     dP""""Yb   88   888888 88  Y8   88   888888 8bodP'
PATENTES START -->
<?php if ($curriculo->patentes): ?>
  <div class='title'><h2><i class='dropdown icon'></i>Patentes</h2></div>
    <div class="ui segment padded content att" id='patente'>
      <div class="ui grid">
        <div class="six wide column"></div>
        <div class="five wide column">
          <select ic='patente' class='ui fluid dropdown' onchange='showOnly(this)'>
            <option value='showAll'>Mostrar todos</option>
            <option value='showComp'>Mostrar comprovados</option>
            <option value='showNonComp'>Mostrar não comprovados</option>
          </select>
        </div>
        <div class="five wide column">
          <div class="ui icon fluid input">
            <input type="text" class='ui input' ic='patente' oninput='search(this)' placeholder='Pesquisar...'>
            <i class='search icon'></i>
          </div>
        </div>

      </div>
      <div class="ui divider"></div>
      <div class='ui relaxed list'>
    <?php
    $tipos = array("PRIVILEGIO_DE_INOVACAO_PI" => "Privilégio de Inovação");
    foreach ($curriculo->patentes as $i => $patente): ?>
        <div class='item'>
          <div class="ui segment secondary">
            <div class="ui description smll">
          <!-- Número -->
          <div class='ui label mini ribbon sh'><?= $i+1 ?>   <i class='caret right icon'></i></div>
          <!-- Nomes de Citação -->
          <?= autoresToString($patente->autores, $nome) . "(<b>$patente->ano</b>)" ?>.<br>
          <?= $patente->titulo ?><br>
          <div class="dados">
          <!-- Patente -->
          <?= "<b>Patente:</b> " . $tipos[$patente->tipo] ?>.<br>
          <!-- Codigo -->
          <?= "<b>Número do Registro:</b> " . $patente->codigo?><br>
          <!-- Titulo -->
          <?= "<b>Titulo:</b> \"" . $patente->tituloPatente . "\""?><br>
          <!-- instDeposito -->
          <?= "<b>Instituição de Registro:</b> " . $patente->instituicaoDeposito?>.<br>

        </div>
      </div>
          <!-- Área de Validação -->
          <?= areaVal($patente->comprovante, $patente->validado, 'patente', $id, $patente->idPatente) ?>
        </div>
        </div>
    <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>
<!-- PATENTES END -->


<!--
 dP"Yb  88""Yb 88 888888 88b 88 888888    db     dP""b8  dP"Yb  888888 .dP"Y8
dP   Yb 88__dP 88 88__   88Yb88   88     dPYb   dP   `" dP   Yb 88__   `Ybo."
Yb   dP 88"Yb  88 88""   88 Y88   88    dP__Yb  Yb      Yb   dP 88""   o.`Y8b
 YbodP  88  Yb 88 888888 88  Y8   88   dP""""Yb  YboodP  YbodP  888888 8bodP'
ORIENTAÇÕES START -->
<?php if ($curriculo->orientacoes): ?>
  <div class='title'><h2><i class='dropdown icon'></i>Orientações</h2></div>
    <div class="ui segment padded content att" id='orientacao'>
      <div class="ui grid">
        <div class="six wide column"></div>
        <div class="five wide column">
          <select ic='orientacao' class='ui fluid dropdown' onchange='showOnly(this)'>
            <option value='showAll'>Mostrar todos</option>
            <option value='showComp'>Mostrar comprovados</option>
            <option value='showNonComp'>Mostrar não comprovados</option>
          </select>
        </div>
        <div class="five wide column">
          <div class="ui icon fluid input">
            <input type="text" class='ui input' ic='orientacao' oninput='search(this)' placeholder='Pesquisar...'>
            <i class='search icon'></i>
          </div>
        </div>

      </div>
      <div class="ui divider"></div>
      <div class='ui relaxed list'>
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
      <div class='item'>
        <div class="ui segment secondary">
          <div class="ui description smll">
        <!-- Número -->
        <div class='ui label mini ribbon sh'><?= $i+1 ?>   <i class='caret right icon'></i></div>
        <!-- Nomes de Citação -->
        <?= "<b>Orientado</b>: $orientacao->nomeOrientado (<b>$orientacao->ano</b>)" ?><br>
        <!-- Titulo -->
        <?= "<b>Título</b>: $orientacao->titulo" ?><br>
        <div class="dados">
          <!-- Natureza -->
          <?= "<b>Natureza</b>: " . $tipos[$orientacao->natureza] ?><br>
          <!-- Instituição -->
          <?= "<b>Instituição</b>: $orientacao->nomeInstituicao" ?><br>
          <!-- Nome Curso -->
          <?= "<b>Nome do Curso</b>: $orientacao->nomeCurso" ?><br>
          <!-- Pais -->
          <?= "<b>País</b>: $orientacao->pais" ?>
        </div>
      </div>
        <!-- Área de Validação -->
        <?= areaVal($orientacao->comprovante, $orientacao->validado, 'orientacao', $id, $orientacao->idOrientacao) ?>
      </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>
<!-- ORIENTAÇÕES END -->


<!--
.dP"Y8  dP"Yb  888888 888888 Yb        dP    db    88""Yb 888888
`Ybo." dP   Yb 88__     88    Yb  db  dP    dPYb   88__dP 88__
o.`Y8b Yb   dP 88""     88     YbdPYbdP    dP__Yb  88"Yb  88""
8bodP'  YbodP  88       88      YP  YP    dP""""Yb 88  Yb 888888
SOFTWARE START -->
<?php if ($curriculo->softwares): ?>
  <div class='title'><h2><i class='dropdown icon'></i>Software</h2></div>
    <div class="ui segment padded content att" id='software'>
      <div class="ui grid">
        <div class="six wide column"></div>
        <div class="five wide column">
          <select ic='software' class='ui fluid dropdown' onchange='showOnly(this)'>
            <option value='showAll'>Mostrar todos</option>
            <option value='showComp'>Mostrar comprovados</option>
            <option value='showNonComp'>Mostrar não comprovados</option>
          </select>
        </div>
        <div class="five wide column">
          <div class="ui icon fluid input">
            <input type="text" class='ui input' ic='software' oninput='search(this)' placeholder='Pesquisar...'>
            <i class='search icon'></i>
          </div>
        </div>

      </div>
      <div class="ui divider"></div>
      <div class='ui relaxed list'>
    <?php
    $tipos = array("PRIVILEGIO_DE_INOVACAO_PI" => "Privilégio de Inovação");
    foreach ($curriculo->softwares as $i => $software): ?>
        <div class='item'>
          <div class="ui segment secondary">
            <div class="ui description smll">
          <!-- Número -->
          <div class='ui label mini ribbon sh'><?= $i+1 ?>   <i class='caret right icon'></i></div>
          <!-- Nomes de Citação -->
          <?= autoresToString($software->autores, $nome) . "(<b>$software->ano</b>)"?>.<br>
          <!-- Link, se possuir -->
          <?= "<b>Título</b>: " . ($software->homepage ? "<a href='http://$software->homepage'>" : "")?>
            <!-- Titulo Capitulo -->
            <?= $software->titulo ?>.<br>
            <?= ($software->homepage ? "</a>" : "")?>
          <div class="dados">
          </div>
          <!-- Área de Validação -->
          <?= areaVal($software->comprovante, $software->validado, 'software', $id, $software->idSoftware) ?>

        </div>
      </div>
        </div>
    <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>
<!-- SOFTWARE END -->
</div>
</div>
<?php
  // Funções de Utilidade
  function areaVal($comprovante, $flag, $ic, $curriculoId, $icId){
    $filename = str_pad($curriculoId, 5, "0", STR_PAD_LEFT) . "-$ic-$icId";
     ?>
     <div class="ui buttons small fluid val-area">
    <?php if($flag == -1): ?>
      <!-- NÃO VALIDADO -->
      <div class="ui button">Não Validado</div>
    <?php elseif ($flag == 0): ?>
      <div class="ui button negative">Não Aceito</div>
    <?php else: ?>
      <div class="ui button positive">Aceito</div>
      <!-- VALIDADO -->
    <?php endif; ?>
    <div class='comp-area' ic='<?= $filename ?>'>
    <?php if($comprovante): ?>
      <!-- MOSTRAR COMPROVANTE  -->
      <a
        class="ui button blue comp"
        style='border-top-left-radius: 0; border-bottom-left-radius: 0;'
        comp="<?= "uploads/comprovantes/" . $comprovante ?>"
        onclick='showComp(this)'
      >
        Mostrar Comprovante
      </a>
      <button class='ui button positive labeled icon' onclick='mudarValidado(this, 1, "<?= $_SESSION['email'] ?>")'>
        <i class='thumbs up icon'></i>
        Aceitar
      </button>
      <button class='ui button negative right labeled icon' onclick='mudarValidado(this, 0, "<?= $_SESSION['email'] ?>")'>
        <i class='thumbs down icon'></i>
        Não Aceitar
      </button>
      </div>
    <?php else: ?>
      <div class="ui button">Não Comprovado</div>
    <?php endif; ?>
    </div>
    <?php echo '</div>';
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
