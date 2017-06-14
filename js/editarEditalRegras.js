var regras = []
const tB = $("#table tbody")
const icDrop = $("#icDrop")
const options = {
  "artigo" : "Artigo em periódico",
  "banca" : "Participação em Banca",
  "capLivro" : "Capítulo de Livro publicado",
  "coordProj" : "Coordenação de Projeto",
  "corpoEditorial" : "Participação em Corpo Editorial",
  "livro" : "Livro publicado",
  "marca" : "Marca registrada",
  "organizacaoEvento" : "Organização de Evento",
  "orientacao" : "Orientação",
  "patente" : "Patente registrada",
  "software" : "Software registrado",
  "titulacao" : "Titulação",
  "trabEvento" : "Trabalho realizado em Evento"
}

// Carregando Regras
$(()=>{

  // Pegando do DB
  getRegras(idEdital, data =>{
    for (regra of data) {
      regra.content = JSON.parse(regra.content)
      regras.push(regra)
    }
  })

  // Esperando pelo fim do request
  $(document).ajaxStop(()=>{
    $("#mainbody").removeClass("loading")

    /* FORMATAÇÃO DA TABELA DE REGRAS  */
    if(regras.length > 0)
      $("#tableCtn").removeClass('mHidden')

    // Titulação
    titulacaoForm()
    // ICs Genéricos
    formatIC('artigo')
    formatIC('banca')

    if(icDrop.find("option").length == 0)
      icDrop.dropdown("set text", "Não há regras a se adicionar")
  })
})




/**----------------------------
 *   |       TITULAÇÃO        |
 *   -------------------------- 
 * /

/**
 * Salva a regra de Titulação
 * 
 * @param {*} idEdital 
 */
function salvarTitulacao(idEdital){
  // Estados
  let maior = $("#titulacao-exc").checkbox("is checked")

  // Valores
  let gradInd = $("#titulacao-grad-pi").val()
  let espInd = $("#titulacao-esp-pi").val()
  let mestInd = $("#titulacao-mest-pi").val()
  let docInd = $("#titulacao-doc-pi").val()

  // Armazenando regra de forma geral
  let regra = {
      ic: "titulacao",
      maior: maior,
      grad: gradInd,
      esp: espInd,
      mest: mestInd,
      doc: docInd
    }

  let tipos = ['grad', 'esp', 'mest', 'doc']
  // Adicionando as regras ao banco de dados
  for (tipo of tipos) {
    var mTipo = tipo;
    let mRegra = {
      ic: regra.ic,
      ptInd: regra[tipo],
      ptMax: regra[tipo],
      content: `{
        "maior": ${regra.maior},
        "tipo": "${mTipo}"
      }`,
      idEdital: idEdital
    }
    // Inserindo regra no DB e no array
    insertRegra(mRegra, data => {
      mRegra.idRegra = data.id
      mRegra.content = JSON.parse(mRegra.content)
      regras.push(mRegra)
      $("#titulacao").removeClass("loading")
    }, ()=>{
      $("#titulacao").addClass("loading")
    })

  }
  titulacaoForm()

  // Adicionando a regra à variável local de regras
  $("#titulacao").addClass("mHidden")
  $("#addRegra").removeClass("mHidden")
}

/**
 * Formata as regras de titulação no documento
 */
function titulacaoForm(){
  const regrasTitulacao = regras.achar(item => { return (item.ic == 'titulacao' ? item : false) })
  if(regrasTitulacao.length > 0){
    const maiorTitulacao = (regrasTitulacao[0] != undefined ? regras[0].content.maior : '')
    // Removendo a opção de escolher Titulação, se houver uma regra de titulação
    removeIC('titulacao')
    // Tipos de titulação
    const tiposTit = {
      "grad":"Graduação",
      "esp": "Especialização",
      "mest": "Mestrado",
      "doc":"Doutorado"
    }
    let markup;
    markup =
      `<tr ic='titulacao'>
        <td colspan='3'>
          <div class='ui header center aligned'>
            Titulação
            <div class='ui sub header center aligned'>${maiorTitulacao ? "Pontuando apenas a maior titulação" : "Pontuando todas as titulações"}</div>
          </div>
        </td>
        <td class='ui center aligned' rowspan='5'>
          <button onclick='deleteTitulacao()' class='ui button circular icon negative'>
            <i class='remove icon'></i>
          </button>
        </td>
      </tr>`
    // Iterando por titulações
    for (regra of regrasTitulacao) {
      markup += 
        `<tr ic='titulacao'>
          <td>${tiposTit[regra.content.tipo]}</td>
          <td colspan='2' class='ui center aligned' >${regra.ptInd}</td>
        </tr>`
    }
    clearIC('titulacao')
    tB.append(markup)
    tableRefresh()
  }
}

/**
 * Deleta as regras de titulação
 */
function deleteTitulacao(){
  const regrasTitulacao = regras.achar(item => { return (item.ic == 'titulacao' ? item : false) })
  for (regra of regrasTitulacao) {
    removerRegra(regra.idRegra, data=>{
    })
    regras = $(regras).not(regrasTitulacao).get();
  }
  clearIC('titulacao')
  tableRefresh()
  addOption('titulacao')
  icDrop.dropdown('refresh')
}




/**-----------------------------------------------
 *   |       FUNÇÕES PARA REGRAS GENÉRICAS       |
 *   ---------------------------------------------
 **/
/**
 * Salva as regras no DB
 * 
 * @param {*} idEdital 
 */
function salvarRegra(idEdital, ic){
  const estado = $(`#${ic}-ano-opt`).checkbox("is checked") // Estado da condição
  const ano = (estado ? $(`#${ic}-ano`).val() : false) // Valor da condição

  // Objeto de regra
  let regra = {
    ic: ic,
    ptInd: $(`#${ic}-pi`).val(),
    ptMax: $(`#${ic}-pm`).val(),
    content: `{"ano":"${ano}"}`,
    idEdital: idEdital
  }

  // Insere a regra no DB
  insertRegra(regra, data => {
    regra.idRegra = data.id
    regra.content = JSON.parse(regra.content)
    regras.push(regra)
    $(`#${ic}`).removeClass("loading")
  }, ()=>{
    $(`#${ic}`).addClass("loading")
  })

  // Formata o documento
  formatIC(ic)
  
  // Esconde o container
  endRegra(ic)
}

/**
 * Formata os dados do IC na tabela
 * 
 * @param {*} ic Nome do IC
 */
function formatIC(ic){
  // Objeto contendo as descrições para todos os ICs
  const desc = {
    "artigo" : "Artigos em periódicos",
    "banca" : "Participações em Bancas",
    "livro" : "Livros publicados",
    "capLivro" : "Capítulos de Livros publicados",
    "patente" : "Patentes registradas",
    "marca" : "Marcas registradas",
    "software" : "Softwares registrados",
    "corpoEditorial" : "Participações em Corpos Editoriais"
  }

  // Acha regras existentes do IC
  const regrasIC = regras.achar(item => { return (item.ic == ic ? item : false) })
  // Checa se existem regras
  if(regrasIC.length > 0){
    const regra = regrasIC[0]
    // Label da linha
    const anoLabel = (regra.content.ano != 'false' ? `${desc[ic]} até o ano de ${regra.content.ano}` : `${desc[ic]} de todos os anos`)
    
    // Markup da linha
    var markup =
    `<tr ic='${ic}'>
      <td>
        <div class='ui header center aligned'>
        ${desc[ic]}
        <div class='ui sub header'>
          ${anoLabel}
        </div>
        </div>
      </td>
      <td>${regra.ptInd}</td>
      <td>${regra.ptMax}</td>
      <td class='ui center aligned'>
        <button onclick='deleteIC(${regra.idRegra}, "${ic}")' class='ui button circular icon negative'>
          <i class='remove icon'></i>
        </button>
      </td>
    </tr>`
    // Limpa a tabela
    clearIC(ic)
    // Adiciona o Markup à tabela
    tB.append(markup)
    // Remove a regra da lista
    removeIC(ic)
    // Atualiza a tabela
    tableRefresh()
  }
}

/**
 * Deleta o IC do DB e da tabela
 * 
 * @param {*} id ID da Regra 
 * @param {*} ic Nome do IC
 */
function deleteIC(id, ic){
  // Regras do IC existentes
  const regrasIC = regras.achar(item => { return (item.ic == ic ? item : false) })

  // Remove do DB e do Array
  removerRegra(id, data=>{
    let index = regras.indexOf(regra)
    if(index > -1)
      regras.splice(index, 1)
  })

  // Checa se existem outras regras
  if(regrasIC.length - 1 == 0 || regrasIC.length - 1 == -1){
    clearIC(ic)
    if(checkIC(ic) == 0){
      addOption(ic)
    }
  }

  // Se não existe regra alguma, esconde a tabela
  if(regras.length-1 == 0)
    $("#tableCtn").addClass("mHidden")
}






/**----------------------------------------
 *   |        FUNÇÕES DE UTILIDADE        |
 *   -------------------------------------- 
 * /

/**
 * Retorna um array baseado no resultado de uma função
 * 
 * @param {function} fn
 * @return {array} Array com os valores definidos pela função
 */
Array.prototype.achar = function(fn){
  let array = this
  let subarr = []
  for(item of array){
    let result = fn(item)
    if(result) subarr.push(result)
  }
  return subarr
}

/**
 * Exibe o container da regra a ser adicionada e esconde
 * o container de adição de regras
 */
function adicionarRegra(){
  let ic = $("#icDrop").val()
  $("#" + ic).removeClass('mHidden')
  $("#addRegra").addClass("mHidden")
}

/**
 * Adiciona o IC ao dropdown de opções
 * 
 * @param {*} ic Nome do IC 
 */
function addOption(ic){
  icDrop.prepend($(new Option(options[ic], ic)))  
}

/**
 * Atualiza a tabela
 */
function tableRefresh(){
  if(regras.length < 1)
    $("#tableCtn").addClass('mHidden')
  else
    $("#tableCtn").removeClass("mHidden")
}

/**
 * Esconde o container da regra atual e exibe o de
 * adicionar regras
 * 
 * @param {*} ic Nome do IC 
 */
function endRegra(ic){
  $("#"+ic).addClass("mHidden")
  $("#addRegra").removeClass("mHidden")
}

/**
 * Cancela a adição de uma regra
 * 
 * @param {*} ic Nome do IC
 */
function cancelRegra(ic){
  $("#"+ic).addClass('mHidden')
  $("#addRegra").removeClass('mHidden')
  $("#"+ic +" input").val("")
}

/**
 * Dá toggle na visibilidade de um container a partir de seu ID
 * 
 * @param {*} cnt Container 
 */
function toggleCnt(cnt){
  const state = $("#"+cnt).hasClass("mHidden")
  if(state)
    $("#"+cnt).removeClass('hidden mHidden')
  else
    $("#"+cnt).addClass('hidden mHidden')
}

/**
 * Remove um IC das opções de regragem
 * 
 * @param {*} ic Nome do IC 
 */
function removeIC(ic){
  icDrop.find(`option[value='${ic}']`).remove()
  icDrop.dropdown('set selected')
}

/**
 * Remove todas as ocorrências de um IC na tabela de regras
 * 
 * @param {*} ic Nome do IC 
 */
function clearIC(ic){
  tB.find(`tr[ic='${ic}']`).remove()
}

/**
 * Checa se o IC existe nas opções de regragem
 * 
 * @param {*} ic Nome do IC 
 * @return {boolean} Resultado da checagem
 */
function checkIC(ic){
  return icDrop.find(`option[value='${ic}']`).length
}
