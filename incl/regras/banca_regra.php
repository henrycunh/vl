<div class="ui segment mHidden" id='banca'>
  <div class="ui header">
    <h4>Participação em Banca</h4>
  </div>
  <div class="ui divider"></div>

  <div class="ui form">
    <div class="field">
      <div class="ui checkbox" id='banca-ano-opt'>
        <input type="checkbox" onclick='toggleCnt("banca-ano-cnt")'>
        <label>Condicionar ano da participação</label>
      </div>
    </div>
    <div class="ui segment basic mHidden" id='banca-ano-cnt'>
      <div class="ui divider horizontal">
        CONDIÇÃO
      </div>
      <div class="field">
        <label>Pontuar a partir de</label>
        <input type="text" id='banca-ano'>
      </div>
      <div class="ui divider"></div>
    </div>

    <div class="field">
      <div class="ui checkbox" id='banca-lim-opt' onchange='toggleLimBanca()'>
        <input type="checkbox">
        <label>Não limitar a pontuação</label>
      </div>
    </div>


    <div class="ui divider"></div>

  <div class="ui segment basic" id='banca-opt'>
    <div class="ui grid">

      <div class="four wide column">
        <div class="ui sub header">
          Graduação
        </div>
        <div class="field">
          <label>Pont. Individual</label>
          <div class='ui input'>
            <input type="input" class='ui input' id='banca-grad-pi'>
          </div>
        </div>
        <div class="field">
          <label>Pont. Máxima</label>
          <div class='ui input'>
            <input type="input" class='ui input' id='banca-grad-pm'>
          </div>
        </div>
      </div>

      <div class="four wide column">
        <div class="ui sub header">
          Mestrado
        </div>
        <div class="field">
          <label>Pont. Individual</label>
          <div class='ui input'>
            <input type="input" class='ui input' id='banca-mest-pi'>
          </div>
        </div>
        <div class="field">
          <label>Pont. Máxima</label>
          <div class='ui input'>
            <input type="input" class='ui input' id='banca-mest-pm'>
          </div>
        </div>
      </div>

      <div class="four wide column">
        <div class="ui sub header">
          Doutorado
        </div>
        <div class="field">
          <label>Pont. Individual</label>
          <div class='ui input'>
            <input type="input" class='ui input' id='banca-doc-pi'>
          </div>
        </div>
        <div class="field">
          <label>Pont. Máxima</label>
          <div class='ui input max'>
            <input type="input" class='ui input' id='banca-doc-pm'>
          </div>
        </div>
      </div>

      <div class="ui divider"></div>
    </div>

    <div class="field">
      <div class="ui segment basic right aligned">
        <button class='ui button blue right labeled icon' onclick='salvarBanca(<?= $edital->idEdital ?>)'>
          <i class='save icon'></i>
          Salvar
        </button>
        <button class='ui button black right labeled icon' onclick='cancelRegra("banca")'>
          <i class='remove icon'></i>
          Cancelar
        </button>
      </div>
    </div>
  </div>
</div>
</div>
