<!-- ORGANIZAÇÃO DE EVENTOS -->
<div class="ui segment mHidden" id='organizacaoEvento'>
  <div class="ui header">
    <h4>Organização de Evento</h4>
  </div>
  <div class="ui divider"></div>
  <div class="ui form">
    <div class="ui grid">

      <div class="twelve wide column">
        <div class="field">
          <div class="ui checkbox" id='organizacaoEvento-ano-opt'>
            <input type="checkbox" onclick='toggleCnt("organizacaoEvento-ano-cnt")'>
            <label>Condicionar ano de publicação</label>
          </div>
        </div>
        <div class="ui segment basic mHidden" id='organizacaoEvento-ano-cnt'>
          <div class="ui divider horizontal">
            CONDIÇÃO
          </div>
          <div class="field">
            <label>Pontuar a partir de</label>
            <input type="text" id='organizacaoEvento-ano'>
          </div>
          <div class="ui divider"></div>
        </div>
        <div class="field">
          <div class="ui checkbox lim" id='organizacaoEvento-lim-opt'>
            <input type="checkbox" ic='organizacaoEvento'>
            <label>Não limitar a pontuação</label>
          </div>
        </div>
      </div>

      <div class="four wide column">
        <div class="field">
          <label>Pont. Individual</label>
          <div class="ui input">
            <input type="text" id='organizacaoEvento-pi'>
          </div>
        </div>
        <div class="field">
          <label>Pont. Máximo</label>
          <div class="ui input max">
            <input type="text" id='organizacaoEvento-pm'>
          </div>
        </div>
        <div class="field">
          <button class='ui button blue right labeled fluid icon' onclick='salvarRegra(<?= $edital->idEdital ?>, "organizacaoEvento")'>
            <i class='save icon'></i>
            Salvar
          </button>
        </div>
        <div class="field">
          <button class='ui button black right labeled fluid icon' onclick='cancelRegra("organizacaoEvento")'>
            <i class='remove icon'></i>
            Cancelar
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
