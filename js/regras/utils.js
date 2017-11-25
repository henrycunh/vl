
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
  refreshMaxLabel()
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

function setUnlimited(elem){
  const ic = $(elem).attr("ic")
  console.log(ic)
}

/**
 * Atualiza a contagem da pontuação máxima total
 */
function refreshMaxLabel(){
  var pontuacao = 0
  var noLim = 0
  if(regras.length > 0){

    // Todas as regras de titulação
    const regrasTitulacao = regras.achar(item => item.ic == 'titulacao' ? item : false )
    // Todas as regras de coordenação de projeto
    const regraCoordProj = regras.achar(item => item.ic == 'coordProj' ? item : false)
    // Quantidade de regras sem limite
    noLim = regras.achar( item => item.content.lim ? item : false).length

    if(regrasTitulacao.length > 0){
      // Condição para contabilizar apenas a maior titulação
      const titulacaoMaior = regrasTitulacao[0].content.maior

      if(titulacaoMaior) // Adicionando a pontuação da maior titulação
        pontuacao += parseFloat(regrasTitulacao[regrasTitulacao.length - 1].ptMax)
      else // Adicionando a pontuação de todas as titulações
        pontuacao += regrasTitulacao.map( item => item.ptMax ).reduce((a, b) => parseFloat(a) + parseFloat(b), 0)
    }

    // Contabilizando ambos os casos de coordenação de projeto
    if(regraCoordProj.length > 0){
      let regraCP = regraCoordProj[0]
      pontuacao += parseFloat(regraCP.ptMax) + parseFloat(regraCP.content.pontMaxAnd)
    }

    // Todos os itens que não são titulação e que não possuem pontuação ilimitada
    itens = regras.achar(
      item => {
        let itemLim = (item.content.lim != undefined ? !item.content.lim : true)
        if(item.ic != "titulacao" && item.ic != "coordProj" && itemLim && item.ptMax > 0){
        //  console.log(item)
          return item
        }
        else
          return false
      }
    )
    // Pontuação dos itens
    let pontItens = itens.map(item => item.ptMax)
    let soma = pontItens.reduce((a, b) => {
    //  console.log(parseFloat(a) + parseFloat(b))
      return parseFloat(a) + parseFloat(b)
    }, 0)

    pontuacao = parseFloat(pontuacao) + parseFloat(soma)
  }
  $(".max").addClass("icon")
  $(".max").append(`<i class="circular info link icon maxpop"></i>`)
  $(".maxpop").popup({
    html    :
    `
    <div class="ui label large basic">
    Pontuação máxima total
    <div class="detail">${pontuacao}</div>
    </div>
    <div class="ui label large basic">
    Itens sem limite
    <div class="detail">${noLim}</div>
    </div>
    `,
    variation: "flowing"
  })
  ptMaxTotal = pontuacao
  ptLimTotal = noLim
  $("#ptMaxTotal").text(pontuacao )
}
