<!-- ARTIGO -->
<div class="ui segment mHidden" id='artigo'>
  <div class="ui header">
    <h4>Artigo publicado em periódico</h4>
  </div>
  <div class="ui divider"></div>
  <div class="ui form">
    <div class="ui grid">

      <div class="twelve wide column">
        <div class="field">
          <div class="ui checkbox" id='artigo-ano-opt'>
            <input type="checkbox" onclick='toggleCnt("artigo-ano-cnt")'>
            <label>Condicionar ano de publicação</label>
          </div>
        </div>
        <div class="ui segment basic mHidden" id='artigo-ano-cnt'>
          <div class="ui divider horizontal">
            CONDIÇÃO
          </div>
          <div class="field">
            <label>Pontuar a partir de</label>
            <input type="text" id='artigo-ano'>
          </div>
          <div class="ui divider"></div>
        </div>
        <div class="field">
          <div class="ui checkbox lim" id='artigo-lim-opt'>
            <input type="checkbox" ic='artigo'>
            <label>Não limitar a pontuação</label>
          </div>
        </div>
      </div>

      <div class="four wide column">
        <div class="field">
          <label>Pont. Individual</label>
          <div class="ui input">
            <input type="text" id='artigo-pi'>
          </div>
        </div>
        <div class="field">
          <label>Pont. Máximo</label>
          <div class="ui input max">
            <input type="text" id='artigo-pm'>
          </div>
        </div>
        <div class="field">
          <button class='ui button blue right labeled fluid icon' onclick='salvarRegra(<?= $edital->idEdital ?>, "artigo")'>
            <i class='save icon'></i>
            Salvar
          </button>
        </div>
        <div class="field">
          <button class='ui button black right labeled fluid icon' onclick='cancelRegra("artigo")'>
            <i class='remove icon'></i>
            Cancelar
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
