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

    <div class="field">
      <div class="ui checkbox" id='orientacao-lim-opt' onchange='toggleLimOrientacao()'>
        <input type="checkbox">
        <label>Não limitar a pontuação</label>
      </div>
    </div>

  <div class="ui segment basic" id='orientacao-opt'>
    <div class="ui grid">

      <div class="three wide column">
        <div class="ui sub header">
          Iniciação Científica
        </div>
        <div class="field">
          <label>Pont. Individual</label>
          <div class='ui input'>
            <input type="input" class='ui input' id='orientacao-inic-pi'>
          </div>
        </div>
        <div class="field">
          <label>Pont. Máxima</label>
          <div class='ui input'>
            <input type="input" class='ui input' id='orientacao-inic-pm'>
          </div>
        </div>
      </div>

      <div class="two wide column">
        <div class="ui sub header">
          Graduação
        </div>
        <div class="field">
          <label>Pont. Individual</label>
          <div class='ui input'>
            <input type="input" class='ui input' id='orientacao-grad-pi'>
          </div>
        </div>
        <div class="field">
          <label>Pont. Máxima</label>
          <div class='ui input'>
            <input type="input" class='ui input' id='orientacao-grad-pm'>
          </div>
        </div>
      </div>

      <div class="two wide column">
        <div class="ui sub header">
          Especialização
        </div>
        <div class="field">
          <label>Pont. Individual</label>
          <div class='ui input'>
            <input type="input" class='ui input' id='orientacao-esp-pi'>
          </div>
        </div>
        <div class="field">
          <label>Pont. Máxima</label>
          <div class='ui input'>
            <input type="input" class='ui input' id='orientacao-esp-pm'>
          </div>
        </div>
      </div>

      <div class="two wide column">
        <div class="ui sub header">
          Mestrado
        </div>
        <div class="field">
          <label>Pont. Individual</label>
          <div class='ui input'>
            <input type="input" class='ui input' id='orientacao-mest-pi'>
          </div>
        </div>
        <div class="field">
          <label>Pont. Máxima</label>
          <div class='ui input'>
            <input type="input" class='ui input' id='orientacao-mest-pm'>
          </div>
        </div>
      </div>

      <div class="two wide column">
        <div class="ui sub header">
          Doutorado
        </div>
        <div class="field">
          <label>Pont. Individual</label>
          <div class='ui input'>
            <input type="input" class='ui input' id='orientacao-doc-pi'>
          </div>
        </div>
        <div class="field">
          <label>Pont. Máxima</label>
          <div class='ui input'>
            <input type="input" class='ui input' id='orientacao-doc-pm'>
          </div>
        </div>
      </div>

      <div class="two wide column">
        <div class="ui sub header">
          Pós-Doutorado
        </div>
        <div class="field">
          <label>Pont. Individual</label>
          <div class='ui input'>
            <input type="input" class='ui input' id='orientacao-posdoc-pi'>
          </div>
        </div>
        <div class="field">
          <label>Pont. Máxima</label>
          <div class='ui input max'>
            <input type="input" class='ui input' id='orientacao-posdoc-pm'>
          </div>
        </div>
      </div>

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
