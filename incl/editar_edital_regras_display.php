<?php $options = json_decode('{
  "artigo" : "Artigo em periódico",
  "banca" : "Participação em Banca",
  "capLivro" : "Capítulo de Livro publicado",
  "coordProj" : "Coordenação de Projeto",
  "corpoEditorial" : "Participação em Corpo Editorial",
  "livro" : "Livro publicado",
  "marca" : "Marca registrada",
  "organizacaoEvento" : "Organização de Evento",
  "orientacao" : "Orientação",
  "patente" : "Patente registrada",
  "software" : "Software registrado",
  "titulacao" : "Titulação",
  "trabEvento" : "Trabalho realizado em Evento"
}', true);
  $editais = Edital::selectEditais($conn);
 ?>

<script type="text/javascript">
  const idEdital = <?= $edital->idEdital ?>
</script>

<!-- ADIÇÃO DE REGRA -->
<div class="ui segment secondary">
  <div class="ui sub header">
    Importar Regras
  </div>
  <div class="ui form">
    <div class="fields">
      <div class="twelve wide field">
        <select id="importarEdital" class="ui dropdown">
          <?php foreach ($editais as $edital_): if($edital_->nome == $edital->nome) continue; ?>
            <option value="<?= $edital_->idEdital?> "><?= $edital_->nome ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="four wide field">
        <button class='ui button teal fluid right labeled icon' onclick='importarRegras(<?= $edital->idEdital?>)'>
          <i class='download icon'></i>
          Importar
        </button>
      </div>
    </div>
  </div>
  <div class="ui message positive hidden" id='importMessage'>
    
  </div>
</div>
<div class="ui segment basic" id='addRegra'>
  <div class="ui form">
    <div class="fields">
      <div class="twelve wide field">
        <label>Item do Curriculo</label>
        <select class="ui dropdown" id='icDrop'>
          <?php foreach ($options as $ic => $desc) echo "<option value='$ic'>$desc</option>" ?>
        </select>
      </div>
      <div class="four wide field">
        <label style="color: transparent">-</label>
        <button class='ui button positive fluid right labeled icon' onclick='adicionarRegra()'>
          <i class='add icon'></i>
          Adicionar Regra
        </button>
      </div>
    </div>
  </div>
</div>

<?php
  require 'regras/titulacao_regra.php';
  require 'regras/artigo_regra.php';
  require 'regras/banca_regra.php';
  require 'regras/livro_regra.php';
  require 'regras/capLivro_regra.php';
  require 'regras/corpoEditorial_regra.php';
  require 'regras/patente_regra.php';
  require 'regras/marca_regra.php';
  require 'regras/software_regra.php';
  require 'regras/organizacaoEvento_regra.php';
  require 'regras/coordProj_regra.php';
  require 'regras/orientacao_regra.php';
  require 'regras/trabEvento_regra.php';
?>


<div class="ui segment basic mHidden" id='tableCtn'>
  <table class='ui table celled padded' id='table'>
    <th width='70%'>Item do Currículo</th>
    <th width='10%'>Pontuação Miníma</th>
    <th width='10%'>Pontuação Máxima</th>
    <th width='10%'>Ação</th>
  </table>
  <div class="ui segment right aligned" style="padding-right: 12em" id='tablefoot'>

  </div>
</div>
