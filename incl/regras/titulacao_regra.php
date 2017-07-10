<!-- TITULAÇÃO -->
<div class="ui segment mHidden" id='titulacao'>
  <div class="ui header">
    <h4>Regras para Titulação</h4>
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
      </div>
      <div class="four wide field">
        <div class="ui sub header">
          Especialização
        </div>
        <label>Pont. Individual</label>
        <div class='ui input'>
          <input type="input" class='ui input' id='titulacao-esp-pi'>
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
      </div>
      <div class="four wide field">
        <div class="ui sub header">
          Doutorado
        </div>
        <label>Pont. Individual</label>
        <div class='ui input'>
          <input type="input" class='ui input' id='titulacao-doc-pi'>
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
        <button class='ui button black right labeled icon' onclick='cancelRegra("titulacao")'>
          <i class='remove icon'></i>
          Cancelar
        </button>
      </div>
    </div>
  </div>
</div>
</div>