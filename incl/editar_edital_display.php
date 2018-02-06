<div style='margin: 2em' class="ui segment secondary loading" id='mainbody'>
  <a href='painel_instituicao.php' class='ui button fluid blue'>
    Voltar para o painel
  </a>
  <div class="ui segment">
    <div class="ui header">
      Informações do Edital
    </div>
    <div class="ui divider"></div>
    <div class="ui form">
      <div class="fields">
        <div class="four wide field">
          <label>Número do Edital</label>
          <input type="text" id='numEdital' value='<?= $edital->numero ?>'>
        </div>
        <div class="six wide field">
          <label>Nome do Edital</label>
          <input type="text" id='nomeEdital' value='<?= $edital->nome ?>'>
        </div>
        <div class="three wide field">
          <label>Data de Vigência</label>
          <input type="date" id='vigenciaEdital' value='<?= $edital->vigencia ?>'>
        </div>
        <div class="two wide field">
          <label>Pontuação Máxima</label>
          <input type="number" id="pontMaxEdital" value='<?= $edital->pontMax ?>'>
        </div>
        <div class="three wide disabled field">
          <label>Data de Criação</label>
          <input type="date" value='<?= $edital->dataCriacao ?>'>
        </div>
      </div>
      <div class="ui segment secondary right aligned">
        <form action="exportPDF.php" method="post" target='_blank'>
          <input type="hidden" name="doc" value="regras">
          <input type="hidden" name="idEdital" value="<?= $edital->idEdital ?>">
          <input type="submit" class='ui button blue' value='Exportar PDF'>
        </form>
      </div>
      <div class="field">
        <label>Descrição</label>
        <textarea name="descricao" id='descricaoEdital' rows="4"><?= $edital->descricao ?></textarea>
      </div>
      <div class="ui segment right aligned basic">
        <div class="ui large left labeled button">
          <?php if($edital->link): ?>
            <a target="_blank" href='<?= $edital->link ?>' id='pdflink' class="ui label blue basic right pointing link">
              Ver Edital
            </a>
          <?php else: ?>
            <div class="ui label basic">
              -
            </div>
          <?php endif; ?>
          <button onclick='abrirModal()' class="ui large blue right labeled icon button" tabindex="0">
            <i class='upload icon'></i>
            Enviar PDF
          </button>
        </div>

        <button onclick='salvarAlteracoes("<?= $edital->numero ?>")' id='saveBtn' class="ui positive button large right labeled icon">
          <i class='save icon'></i>
          Salvar
        </button>
      </div>
    </div>
    <div class="ui divider"></div>
    <div class="ui header">
      Regras do Edital
    </div>
    <?php require 'editar_edital_regras_display.php'; ?>
  </div>
</div>

<div class="ui modal" id='enviarPDFModal'>
  <div class="header">
    Submissão de PDF
  </div>
  <div style='padding: 2em 30% !important' class="ui segment basic padded center aligned" id='modalIn'>
    <label class='ui teal labeled icon fluid link button' for="filePDF" id='filebtn'><i class="upload icon"></i> Escolha um Arquivo</label>
    <br>
    <input type='file' id='filePDF' style='display:none' accept="application/pdf" onchange='fileVerify(this)' name='editalpdf'>
    <button class='ui blue button fluid' onclick="enviarArquivo(this)" idEdital='<?= $edital->idEdital ?>' id='curriculoSubmit'>Enviar</button>
    <br>
    <div class="ui indicating progress" id='progress'>
      <div class="bar"></div>
      <div class="label" id='label'></div>
    </div>
  </div>
</div>
