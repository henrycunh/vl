<?php
  $curriculo = Curriculo::getCurriculoByEmail($conn, $email);
  $titulacaoType = array(1 => 'Doutorado', 2 => 'Mestrado', 3 => 'Especialista', 4 => 'Graduado');
 ?>
<h1>Titulação</h1>
<div class="ic_wrapper">
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
</div>
