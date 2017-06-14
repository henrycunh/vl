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
          <option value='artigo'>Artigo em periódico</option>
          <option value='banca'>Participação em Banca</option>
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
          <div class="ui input">
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

<!-- BANCA -->
<div class="ui segment mHidden" id='banca'>
  <div class="ui header">
    <h4>Participação em Banca</h4>
  </div>
  <div class="ui divider"></div>
  <div class="ui form">
    <div class="ui grid">

      <div class="twelve wide column">
        <div class="field">
          <div class="ui checkbox" id='banca-ano-opt'>
            <input type="checkbox" onclick='toggleCnt("banca-ano-cnt")'>
            <label>Condicionar ano de publicação</label>
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
      </div>

      <div class="four wide column">
        <div class="field">
          <label>Pont. Individual</label>
          <div class="ui input">
            <input type="text" id='banca-pi'>
          </div>
        </div>
        <div class="field">
          <label>Pont. Máximo</label>
          <div class="ui input">
            <input type="text" id='banca-pm'>
          </div>
        </div>
        <div class="field">
          <button class='ui button blue right labeled fluid icon' onclick='salvarRegra(<?= $edital->idEdital ?>, "banca")'>
            <i class='save icon'></i>
            Salvar
          </button>
        </div>
        <div class="field">
          <button class='ui button black right labeled fluid icon' onclick='cancelRegra("banca")'>
            <i class='remove icon'></i>
            Cancelar
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="ui segment basic mHidden" id='tableCtn'>
  <table class='ui table celled padded' id='table'>
    <th width='70%'>Item do Currículo</th>
    <th width='10%'>Pontuação Miníma</th>
    <th width='10%'>Pontuação Máxima</th>
    <th width='10%'>Ação</th>
  </table>
</div>
