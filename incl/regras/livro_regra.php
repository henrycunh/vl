<!-- LIVRO -->
<div class="ui segment mHidden" id='livro'>
  <div class="ui header">
    <h4>Livro publicado</h4>
  </div>
  <div class="ui divider"></div>
  <div class="ui form">
    <div class="ui grid">

      <div class="twelve wide column">
        <div class="field">
          <div class="ui checkbox" id='livro-ano-opt'>
            <input type="checkbox" onclick='toggleCnt("livro-ano-cnt")'>
            <label>Condicionar ano de publicação</label>
          </div>
        </div>
        <div class="ui segment basic mHidden" id='livro-ano-cnt'>
          <div class="ui divider horizontal">
            CONDIÇÃO
          </div>
          <div class="field">
            <label>Pontuar a partir de</label>
            <input type="text" id='livro-ano'>
          </div>
          <div class="ui divider"></div>
        </div>
        <div class="field">
          <div class="ui checkbox lim" id='livro-lim-opt'>
            <input type="checkbox" ic='livro'>
            <label>Não limitar a pontuação</label>
          </div>
        </div>
      </div>

      <div class="four wide column">
        <div class="field">
          <label>Pont. Individual</label>
          <div class="ui input">
            <input type="text" id='livro-pi'>
          </div>
        </div>
        <div class="field">
          <label>Pont. Máximo</label>
          <div class="ui input max">
            <input type="text" id='livro-pm'>
          </div>
        </div>
        <div class="field">
          <button class='ui button blue right labeled fluid icon' onclick='salvarRegra(<?= $edital->idEdital ?>, "livro")'>
            <i class='save icon'></i>
            Salvar
          </button>
        </div>
        <div class="field">
          <button class='ui button black right labeled fluid icon' onclick='cancelRegra("livro")'>
            <i class='remove icon'></i>
            Cancelar
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
