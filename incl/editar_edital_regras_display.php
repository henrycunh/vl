<script type="text/javascript">
  const idEdital = <?= $edital->idEdital ?>
</script>

<!-- ADIÇÃO DE REGRA -->
<div class="ui segment basic" id='addRegra'>
  <div class="ui form">
    <div class="fields">
      <div class="twelve wide field">
        <label>Item do Curriculo</label>
        <select class="ui dropdown" id='icDrop'>
          <option value='titulacao'>Titulação</option>
          <option value='artigo'>Artigos de Períodico</option>
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

<div class="ui segment basic mHidden" id='tableCtn'>
  <table class='ui table celled padded' id='table'>
    <th width='70%'>Item do Currículo</th>
    <th width='10%'>Pontuação Máxima</th>
    <th width='10%'>Pontuação Miníma</th>
    <th width='10%'>Ação</th>
  </table>
</div>

<!-- TITULAÇÃO -->
<div class="ui segment mHidden" id='titulacao'>
  <div class="ui header">
    <h4>Titulação</h4>
  </div>
  <div class="ui divider"></div>

  <div class="ui form">
    <div class="field">
      <label>Opção de Exclusividade</label>
      <div class="ui checkbox" id='titulacao-exc'>
        <input type="checkbox">
        <label>Pontuar apenas a maior titulação.</label>
      </div>
    </div>
    <div class="ui divider"></div>

  <div class="ui segment basic" id='titulacao-opt'>
    <div class="fields">
      <div class="four wide field">
        <div class="ui sub header">
          Graduação
        </div>
        <label>Pont. Individual</label>
        <div class='ui input'>
          <input type="input" class='ui input' id='titulacao-grad-pi'>
        </div>
        <label>Pont. Máxima</label>
        <div class="ui input">
          <input type="input" class='ui input' id='titulacao-grad-pm'>
        </div>
      </div>
      <div class="four wide field">
        <div class="ui sub header">
          Especialização
        </div>
        <label>Pont. Individual</label>
        <div class='ui input'>
          <input type="input" class='ui input' id='titulacao-esp-pi'>
        </div>
        <label>Pont. Máxima</label>
        <div class="ui input">
          <input type="input" class='ui input' id='titulacao-esp-pm'>
        </div>
      </div>
      <div class="four wide field">
        <div class="ui sub header">
          Mestrado
        </div>
        <label>Pont. Individual</label>
        <div class='ui input'>
          <input type="input" class='ui input' id='titulacao-mest-pi'>
        </div>
        <label>Pont. Máxima</label>
        <div class="ui input">
          <input type="input" class='ui input' id='titulacao-mest-pm'>
        </div>
      </div>
      <div class="four wide field">
        <div class="ui sub header">
          Doutorado
        </div>
        <label>Pont. Individual</label>
        <div class='ui input'>
          <input type="input" class='ui input' id='titulacao-doc-pi'>
        </div>
        <label>Pont. Máxima</label>
        <div class="ui input">
          <input type="input" class='ui input' id='titulacao-doc-pm'>
        </div>
      </div>
      <div class="ui divider"></div>
    </div>
    <div class="field">
      <div class="ui segment basic right aligned">
        <button class='ui button blue right labeled icon' onclick='salvarTitulacao(<?= $edital->idEdital ?>)'>
          <i class='save icon'></i>
          Salvar
        </button>
      </div>
    </div>
  </div>
</div>

</div>

<!-- ARTIGOS EM PERÍODICOS -->
