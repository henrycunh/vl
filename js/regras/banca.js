
 function salvarBanca(idEdital){
   const anoCond = $("#banca-ano-opt").checkbox("is checked")
   const ano = (anoCond ? $("#banca-ano").val() : false) // Valor da condição
   const lim = $("#banca-lim-opt").checkbox("is checked")

   // Valores
   const gradPtInd = $("#banca-grad-pi").val()
   const gradPtMax = lim ? -1 : $("#banca-grad-pm").val()
   const mestPtInd = $("#banca-mest-pi").val()
   const mestPtMax = lim ? -1 : $("#banca-mest-pm").val()
   const docPtInd = $("#banca-doc-pi").val()
   const docPtMax = lim ? -1 : $("#banca-doc-pm").val()

   // Armazenando regra de forma geral
   let regra = {
       ic   : "banca",
       ano  : ano,
       grad : { ptInd: gradPtInd, ptMax: gradPtMax },
       mest : { ptInd: mestPtInd, ptMax: mestPtMax },
       doc  : { ptInd: docPtInd, ptMax: docPtMax },
     }

   let tipos = ["grad", "mest", "doc"]
   // Adicionando as regras ao banco de dados
   for (tipo of tipos) {
     let mRegra = {
       ic       : regra.ic,
       ptInd    : regra[tipo].ptInd,
       ptMax    : regra[tipo].ptMax,
       content  : JSON.stringify({
         ano        : regra.ano,
         tipo       : tipo,
         lim        : lim
       }),
       idEdital : idEdital
     }
     console.log(mRegra)
     // Inserindo regra no DB e no array
     insertRegra(mRegra, data => {
       mRegra.idRegra = data.id
       mRegra.content = JSON.parse(mRegra.content)
       regras.push(mRegra)
       $("#banca").removeClass("loading")
     }, ()=>{
       $("#banca").addClass("loading")
     })

   }
   formatBanca()

   // Encerrando regra
   endRegra("banca")
 }


function formatBanca(){
  const regrasIC = regras.achar(item => { return (item.ic == "banca" ? item : false) })

  // Checa se existem regras
  if(regrasIC.length > 0){
    const regra = regrasIC[0]
    // Label da linha
    const anoLabel = (regra.content.ano != false ? `Participações em bancas a partir de ${regra.content.ano}` : `Trabalhos realizados em Evento de todos os anos`)

    // Tipos de titulação
    const tipos = {
      "grad" : "Graduação",
      "mest" : "Mestrado",
      "doc"  : "Doutorado"
    }
    let markup;
    markup =
      `<tr ic='banca'>
        <td colspan='3'>
          <div class='ui header center aligned'>
            Participação em banca
            <div class='ui sub header center aligned'>${anoLabel}</div>
          </div>
        </td>
        <td class='ui center aligned' rowspan='4'>
          <button onclick='deleteBanca()' class='ui button circular icon negative'>
            <i class='remove icon'></i>
          </button>
        </td>
      </tr>`
    // Iterando por titulações
    for (regra_ of regrasIC) {
      markup +=
        `<tr ic='banca'>
          <td>${tipos[regra_.content.tipo]}</td>
          <td class='ui center aligned'>${regra_.ptInd > 0 ? regra_.ptInd : "<b style='color:#BBB'>X</b>"}</td>
          <td class='ui center aligned'>${regra_.ptMax == -1 ? "<i style='color: #BBB'>S.L</i>": (regra_.ptMax > 0 ? regra_.ptMax : "<b style='color:#BBB'>X</b>") }</td>
        </tr>`
    }

    removeIC("banca")
    clearIC('banca')
    tB.append(markup)
    tableRefresh()
  }
}

function deleteBanca(){
  const regrasIC = regras.achar(item => { return (item.ic == 'banca' ? item : false) })
  for (regra of regrasIC) {
    removerRegra(regra.idRegra, data=>{
    })
    regras = $(regras).not(regrasIC).get();
  }
  clearIC('banca')
  tableRefresh()
  addOption('banca')
  icDrop.dropdown('refresh')
}

function toggleLimBanca(){
  const state = $("#banca-lim-opt").checkbox("is checked")
  $("#banca-grad-pm").prop("disabled", state)
  $("#banca-mest-pm").prop("disabled", state)
  $("#banca-doc-pm").prop("disabled", state)
}
