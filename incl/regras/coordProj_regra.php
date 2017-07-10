<!-- COORDENAÇÃO DE PROJETO -->
<div class="ui segment mHidden" id='coordProj'>
  <div class="ui header">
    <h4>Coordenação de Projeto</h4>
  </div>
  <div class="ui divider"></div>
  <div class="ui form">
    <div class="ui grid">

      <div class="eight wide column">
        <!-- CONDIÇÃO DE ANO START -->
        <div class="field">
          <div class="ui checkbox" id='coordProj-ano-opt'>
            <input type="checkbox" onclick='toggleCnt("coordProj-ano-cnt")'>
            <label>Condicionar ano de publicação</label>
          </div>
        </div>
            <!-- CONTAINER CONDIÇÃO DE ANO START -->
            <div class="ui segment basic mHidden" id='coordProj-ano-cnt'>
            <div class="ui divider horizontal">
                CONDIÇÃO
            </div>
            <div class="field">
                <label>Pontuar a partir de</label>
                <input type="text" id='coordProj-ano'>
            </div>
            <div class="ui divider"></div>
            </div>
            <!-- CONTAINER CONDIÇÃO DE ANO END -->
        <!-- CONDIÇÃO DE ANO END -->


        <!-- CONDIÇÃO DE ESTADO START -->
        <div class="field">
          <div class="ui checkbox" id='coordProj-estado-opt' onchange='toggleEstadoCoordProj()'>
            <input type="checkbox" onclick='toggleCnt("coordProj-estado-cnt")'>
            <label>Condicionar estado de conclusão</label>
          </div>
        </div>
        <!-- CONDIÇÃO DE ESTADO END -->
        <div class="field">
          <div class="ui checkbox" id='coordProj-lim-opt' onchange='toggleLimCoordProj()'>
            <input type="checkbox">
            <label>Não limitar a pontuação</label>
          </div>
        </div>

      </div>

      <div class="four wide column">
        <div class="ui segment basic" id='coordProj-and' style='display: none'>
          <div class="field">
            <div class="ui header center aligned coordProjLabel" >
              <h5>Projetos em Andamento</h5>
            </div>
          </div>
          <div class="field">
            <label>Pont. Individual</label>
            <div class="ui input">
              <input type="text" id='coordProj-pi-and'>
            </div>
          </div>
          <div class="field">
            <label>Pont. Máximo</label>
            <div class="ui input">
              <input type="text" id='coordProj-pm-and'>
            </div>
          </div>
        </div>
      </div>

      <div class="four wide column">
        <div class="ui segment basic" id='coordProj-and'>
          <div class="field">
            <div class="ui header center aligned coordProjLabel">
              <h5>Projetos Concluidos</h5>
            </div>
          </div>
          <div class="field">
            <label>Pont. Individual</label>
            <div class="ui input">
              <input type="text" id='coordProj-pi-concl'>
            </div>
          </div>
          <div class="field">
            <label>Pont. Máximo</label>
            <div class="ui input">
              <input type="text" id='coordProj-pm-concl'>
            </div>
          </div>
        </div>
        <div class="field">
          <button class='ui button blue right labeled fluid icon' onclick='salvarCoordProj(<?= $edital->idEdital ?>)'>
            <i class='save icon'></i>
            Salvar
          </button>
        </div>
        <div class="field">
          <button class='ui button black right labeled fluid icon' onclick='cancelRegra("coordProj")'>
            <i class='remove icon'></i>
            Cancelar
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
