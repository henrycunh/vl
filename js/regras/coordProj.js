function toggleEstadoCoordProj(){
  const estado = $("#coordProj-estado-opt").checkbox("is checked")
  if(estado){
    $(".coordProjLabel").show()
    $("#coordProj-and").show()
  }
  else{
    $(".coordProjLabel").hide()
    $("#coordProj-and").hide()
  }
}
/**
 * Salva as regras de coordenação de projeto no DB
 *
 * @param {*} idEdital ID do Edital
 */
function salvarCoordProj(idEdital){
  const pontIndAnd = $("#coordProj-pi-and").val()
  const pontMaxAnd = $("#coordProj-pm-and").val()
  const pontIndConcl = $("#coordProj-pi-concl").val()
  const pontMaxConcl = $("#coordProj-pm-concl").val()
  const lim = $("#coordProj-lim-opt").checkbox("is checked")

  const condAno = $("#coordProj-ano-opt").checkbox("is checked")
  const ano = condAno ? $("#coordProj-ano").val() : false
  const estado = $("#coordProj-estado-opt").checkbox("is checked")

  console.log(estado)
  let regra = {
    ic: "coordProj",
    ptInd: pontIndConcl,
    ptMax: lim ? -1 : pontMaxConcl,
    content: JSON.stringify({
      "ano" : ano,
      "estado" : estado,
      "pontIndAnd" : estado ? pontIndAnd : false,
      "pontMaxAnd" : estado ? (lim ? -1 : pontMaxAnd) : false,
     }),
    idEdital: idEdital
  }
  console.log(regra)
  // Insere a regra no DB
  insertRegra(regra, data => {
    regra.idRegra = data.id
    regra.content = JSON.parse(regra.content)
    regras.push(regra)
    $("#coordProj").removeClass("loading")
  }, ()=>{
    $("#coordProj").addClass("loading")
  })

  // Formata o documento
  formatCoordProj()

  // Esconde o container
  endRegra("coordProj")
}

/**
 * Formata as regras de coordenação de projeto no documento
 */
function formatCoordProj(){
  // Acha regras existentes do IC
  const regrasIC = regras.achar(item => { return (item.ic == "coordProj" ? item : false) })

  // Checa se existem regras
  if(regrasIC.length > 0){
    const regra = regrasIC[0]
    // Label da linha
    const anoLabel = (regra.content.ano != false ? `Participação em Projetos a partir de ${regra.content.ano}` : `Participação em Projetos de todos os anos`)

    // Markup da linha
    var markup =
      `
      <tr ic='coordProj'>
        <td colspan='3'>
          <div class='ui header center aligned'>
            Participação em Projetos
          <div class='ui sub header'>
            ${anoLabel}
          </div>
          </div>
        </td>
        <td class='ui center aligned' rowspan='${ regra.content.estado ? 3 : 2 }'>
          <button onclick='deleteIC(${regra.idRegra}, "coordProj")' class='ui button circular icon negative'>
            <i class='remove icon'></i>
          </button>
        </td>
      </tr>
      `
      if(regra.content.estado)
        markup +=
          `
          <tr ic='coordProj'>
            <td>Participação em Projetos em Andamento</td>
            <td>${regra.content.pontIndAnd}</td>
            <td>${regra.content.pontMaxAnd == -1 ? "<i style='color: #BBB'>S.L</i>": regra.content.pontMaxAnd }</td>
          </tr>
          `
      markup +=
        `
        <tr ic='coordProj'>
          <td>Participação em Projetos${regra.content.estado?" Concluidos":""}</td>
          <td>${regra.ptInd}</td>
          <td>${regra.ptMax == -1 ? "<i style='color: #BBB'>S.L</i>": regra.ptMax}</td>
        </tr>
        `

    // Limpa a tabela
    clearIC("coordProj")
    tB.append(markup)
    // Adiciona o Markup à tabela
    removeIC("coordProj")
    // Remove a regra da lista
    // Atualiza a tabela
    tableRefresh()
  }

}

function toggleLimCoordProj(){
  const state = $("#coordProj-lim-opt").checkbox("is checked")
  $("#coordProj-pm-and").prop("disabled", state)
  $("#coordProj-pm-concl").prop("disabled", state)
}
