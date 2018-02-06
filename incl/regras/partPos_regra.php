<!-- PARTICIPAÇÃO EM PÓS GRADUAÇÃO -->
<div class="ui segment mHidden" id='partPos'>
  <div class="ui header">
    <h4>Participação em Projetos de Pós Graduação</h4>
  </div>
  <div class="ui divider"></div>
  <div class="ui form">
    <div class="ui grid">

      <div class="twelve wide column">
        <div class="field">
          <div class="ui checkbox" id='partPos-ano-opt'>
            <input type="checkbox" onclick='toggleCnt("partPos-ano-cnt")'>
            <label>Condicionar ano de ingresso</label>
          </div>
        </div>

        <div class="ui segment basic mHidden" id='partPos-ano-cnt'>
          <div class="ui divider horizontal">
            CONDIÇÃO
          </div>
          <div class="field">
            <label>Pontuar a partir de</label>
            <input type="text" id='partPos-ano'>
          </div>
          <div class="ui divider"></div>
        </div>

        <div class="field">
          <div class="ui checkbox lim" id='partPos-lim-opt'>
            <input type="checkbox" ic='partPos'>
            <label>Não limitar a pontuação</label>
          </div>
        </div>
      </div>

      <div class="four wide column">
        <div class="field">
          <label>Pont. Individual</label>
          <div class="ui input">
            <input type="text" id='partPos-pi'>
          </div>
        </div>
        <div class="field">
          <label>Pont. Máximo</label>
          <div class="ui input max">
            <input type="text" id='partPos-pm'>
          </div>
        </div>
        <div class="field">
          <button class='ui button blue right labeled fluid icon' onclick='salvarRegra(<?= $edital->idEdital ?>, "partPos")'>
            <i class='save icon'></i>
            Salvar
          </button>
        </div>
        <div class="field">
          <button class='ui button black right labeled fluid icon' onclick='cancelRegra("partPos")'>
            <i class='remove icon'></i>
            Cancelar
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
