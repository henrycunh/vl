<div class="ui segment mHidden" id='trabEvento'>
  <div class="ui header">
    <h4>Trabalho em Evento</h4>
  </div>
  <div class="ui divider"></div>

  <div class="ui form">
    <div class="field">
      <div class="ui checkbox" id='trabEvento-ano-opt'>
        <input type="checkbox" onclick='toggleCnt("trabEvento-ano-cnt")'>
        <label>Condicionar ano do Trabalho</label>
      </div>
    </div>
    <div class="ui segment basic mHidden" id='trabEvento-ano-cnt'>
      <div class="ui divider horizontal">
        CONDIÇÃO
      </div>
      <div class="field">
        <label>Pontuar a partir de</label>
        <input type="text" id='trabEvento-ano'>
      </div>
      <div class="ui divider"></div>
    </div>
    <div class="field">
        <label>Classificar tipo do evento por</label>
        <select class="ui dropdown" id='trabEvento-class'>
          <option value="class">Classificação Inata</option>
          <option value="pais">País em que fora realizado</option>
        </select>
    </div>

    <div class="field">
      <div class="ui checkbox" id='trabEvento-lim-opt' onchange='toggleLimTrabEvento()'>
        <input type="checkbox">
        <label>Não limitar a pontuação</label>
      </div>
    </div>


    <div class="ui divider"></div>

  <div class="ui segment basic" id='trabEvento-opt'>
    <div class="ui grid">

      <div class="four wide column">
        <div class="ui sub header">
          Resumo Expandido Nacional
        </div>
        <div class="field">
          <label>Pont. Individual</label>
          <div class='ui input'>
            <input type="input" class='ui input' id='trabEvento-rn-pi'>
          </div>
        </div>
        <div class="field">
          <label>Pont. Máxima</label>
          <div class='ui input'>
            <input type="input" class='ui input' id='trabEvento-rn-pm'>
          </div>
        </div>
      </div>

      <div class="four wide column">
        <div class="ui sub header">
          Resumo Expandido Internacional
        </div>
        <div class="field">
          <label>Pont. Individual</label>
          <div class='ui input'>
            <input type="input" class='ui input' id='trabEvento-ri-pi'>
          </div>
        </div>
        <div class="field">
          <label>Pont. Máxima</label>
          <div class='ui input'>
            <input type="input" class='ui input' id='trabEvento-ri-pm'>
          </div>
        </div>
      </div>

      <div class="four wide column">
        <div class="ui sub header">
          Trabalho Completo Nacional
        </div>
        <div class="field">
          <label>Pont. Individual</label>
          <div class='ui input'>
            <input type="input" class='ui input' id='trabEvento-tn-pi'>
          </div>
        </div>
        <div class="field">
          <label>Pont. Máxima</label>
          <div class='ui input'>
            <input type="input" class='ui input' id='trabEvento-tn-pm'>
          </div>
        </div>
      </div>

      <div class="four wide column">
        <div class="ui sub header">
          Trabalho Completo Internacional
        </div>
        <div class="field">
          <label>Pont. Individual</label>
          <div class='ui input'>
            <input type="input" class='ui input' id='trabEvento-ti-pi'>
          </div>
        </div>
        <div class="field">
          <label>Pont. Máxima</label>
          <div class='ui input max'>
            <input type="input" class='ui input' id='trabEvento-ti-pm'>
          </div>
        </div>
      </div>

      <div class="ui divider"></div>
    </div>

    <div class="field">
      <div class="ui segment basic right aligned">
        <button class='ui button blue right labeled icon' onclick='salvarTrabEvento(<?= $edital->idEdital ?>)'>
          <i class='save icon'></i>
          Salvar
        </button>
        <button class='ui button black right labeled icon' onclick='cancelRegra("trabEvento")'>
          <i class='remove icon'></i>
          Cancelar
        </button>
      </div>
    </div>
  </div>
</div>
</div>
