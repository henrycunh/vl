<!-- TITULAÇÃO -->
<div class="ui segment mHidden" id='orientacao'>
  <div class="ui header">
    <h4>Orientação</h4>
  </div>
  <div class="ui divider"></div>

  <div class="ui form">
    <div class="field">
      <div class="ui checkbox" id='orientacao-ano-opt'>
        <input type="checkbox" onclick='toggleCnt("orientacao-ano-cnt")'>
        <label>Condicionar ano da orientação</label>
      </div>
    </div>

    <div class="ui segment basic mHidden" id='orientacao-ano-cnt'>
      <div class="ui divider horizontal">
        CONDIÇÃO
      </div>
      <div class="field">
        <label>Pontuar a partir de</label>
        <input type="text" id='orientacao-ano'>
      </div>
      <div class="ui divider"></div>
    </div>
    <div class="ui divider"></div>

  <div class="ui segment basic" id='orientacao-opt'>
    <div class="fields">
      <div class="two wide field">
        <div class="ui sub header">
          Iniciação Científica
        </div>
        <label>Pont. Individual</label>
        <div class='ui input'>
          <input type="input" class='ui input' id='orientacao-ic-pi'>
        </div>
      </div>
      <div class="two wide field">
        <div class="ui sub header">
          Graduação
        </div>
        <label>Pont. Individual</label>
        <div class='ui input'>
          <input type="input" class='ui input' id='orientacao-grad-pi'>
        </div>
      </div>
      <div class="two wide field">
        <div class="ui sub header">
          Especialização
        </div>
        <label>Pont. Individual</label>
        <div class='ui input'>
          <input type="input" class='ui input' id='orientacao-esp-pi'>
        </div>
      </div>
      <div class="two wide field">
        <div class="ui sub header">
          Mestrado
        </div>
        <label>Pont. Individual</label>
        <div class='ui input'>
          <input type="input" class='ui input' id='orientacao-mest-pi'>
        </div>
      </div>
      <div class="two wide field">
        <div class="ui sub header">
          Doutorado
        </div>
        <label>Pont. Individual</label>
        <div class='ui input'>
          <input type="input" class='ui input' id='orientacao-doc-pi'>
        </div>
      </div>
      <div class="ui divider"></div>
    </div>
    <div class="field">
      <div class="ui segment basic right aligned">
        <button class='ui button blue right labeled icon' onclick='salvarOrientacao(<?= $edital->idEdital ?>)'>
          <i class='save icon'></i>
          Salvar
        </button>
        <button class='ui button black right labeled icon' onclick='cancelRegra("orientacao")'>
          <i class='remove icon'></i>
          Cancelar
        </button>
      </div>
    </div>
  </div>
</div>
</div>
