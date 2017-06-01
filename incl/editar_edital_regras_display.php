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
          <option value='artigo'>Artigo publicado em periódico</option>
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

<div class="ui segment basic mHidden" id='tableCtn'>
  <table class='ui table celled padded' id='table'>
    <th width='70%'>Item do Currículo</th>
    <th width='10%'>Pontuação Máxima</th>
    <th width='10%'>Pontuação Miníma</th>
    <th width='10%'>Ação</th>
  </table>
</div>

<!--
d888888b d888888b d888888b db    db db       .d8b.   .o88b.  .d8b.   .d88b.
`~~88~~'   `88'   `~~88~~' 88    88 88      d8' `8b d8P  Y8 d8' `8b .8P  Y8.
   88       88       88    88    88 88      88ooo88 8P      88ooo88 88    88
   88       88       88    88    88 88      88~~~88 8b      88~~~88 88    88
   88      .88.      88    88b  d88 88booo. 88   88 Y8b  d8 88   88 `8b  d8'
   YP    Y888888P    YP    ~Y8888P' Y88888P YP   YP  `Y88P' YP   YP  `Y88P'
 -->
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
        <label>Pont. Máxima</label>
        <div class="ui input">
          <input type="input" class='ui input' id='titulacao-grad-pm'>
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
        <label>Pont. Máxima</label>
        <div class="ui input">
          <input type="input" class='ui input' id='titulacao-esp-pm'>
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
        <label>Pont. Máxima</label>
        <div class="ui input">
          <input type="input" class='ui input' id='titulacao-mest-pm'>
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
        <label>Pont. Máxima</label>
        <div class="ui input">
          <input type="input" class='ui input' id='titulacao-doc-pm'>
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
      </div>
    </div>
  </div>
</div>
</div>


<!--
 .d8b.  d8888b. d888888b d888888b  d888b   .d88b.  .d8888.
d8' `8b 88  `8D `~~88~~'   `88'   88' Y8b .8P  Y8. 88'  YP
88ooo88 88oobY'    88       88    88      88    88 `8bo.
88~~~88 88`8b      88       88    88  ooo 88    88   `Y8b.
88   88 88 `88.    88      .88.   88. ~8~ `8b  d8' db   8D
YP   YP 88   YD    YP    Y888888P  Y888P   `Y88P'  `8888Y'
-->
<div class="ui segment mHidden" id='artigo'>
  <div class="ui header">
    <h4>Artigo publicado em periódico</h4>
  </div>
  <div class="ui divider"></div>
  <div class="ui form">
    <div class="ui grid">

      <div class="twelve wide column">
        <div class="field">
          <div class="ui slider checkbox">
            <input type="checkbox" id='artigo-ano-opt' onclick='toggleCnt("artigo-ano-cnt")'>
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
        </div>
        <div class="field">
          <div class="ui slider checkbox">
            <input type="checkbox" id='artigo-pais-opt' onclick='toggleCnt("artigo-pais-cnt")'>
            <label>Condicionar país de publicação</label>
          </div>
        </div>
        <div class="ui segment basic mHidden" id='artigo-pais-cnt'>
          <div class="ui divider horizontal">
            CONDIÇÃO
          </div>
          <div class="field">
            <label>Pontuar artigos publicados</label>
            <select class="ui dropdown" id='artigo-pais'>
              <option value="nacional">Nacional (Brasil)</option>
              <option value="internacional">Internacional</option>
            </select>
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
          <div class="ui input">
            <input type="text" id='artigo-pm'>
          </div>
        </div>
        <div class="field">
          <button class='ui button blue right labeled fluid icon' onclick='salvarArtigo(<?= $edital->idEdital ?>)'>
            <i class='save icon'></i>
            Salvar
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
