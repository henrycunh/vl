
 function salvarTrabEvento(idEdital){
   const anoCond = $("#trabEvento-ano-opt").checkbox("is checked")
   const ano = (anoCond ? $("#trabEvento-ano").val() : false) // Valor da condição
   const classificao = $("#trabEvento-class").val()
   const lim = $("#trabEvento-lim-opt").checkbox("is checked")

   // Valores
   const pt_ind_res_nac = $("#trabEvento-rn-pi").val()
   const pt_max_res_nac = lim ? -1 : $("#trabEvento-rn-pm").val()
   const pt_ind_res_inter = $("#trabEvento-ri-pi").val()
   const pt_max_res_inter = lim ? -1 : $("#trabEvento-ri-pm").val()
   const pt_ind_trab_nac = $("#trabEvento-tn-pi").val()
   const pt_max_trab_nac = lim ? -1 : $("#trabEvento-tn-pm").val()
   const pt_ind_trab_inter = $("#trabEvento-ti-pi").val()
   const pt_max_trab_inter = lim ? -1 : $("#trabEvento-ti-pm").val()

   // Armazenando regra de forma geral
   let regra = {
       ic: "trabEvento",
       ano: ano,
       res_nac: { ptInd: pt_ind_res_nac, ptMax: pt_max_res_nac },
       res_inter: { ptInd: pt_ind_res_inter, ptMax: pt_max_res_inter },
       trab_nac: { ptInd: pt_ind_trab_nac, ptMax: pt_max_trab_nac },
       trab_inter: { ptInd: pt_ind_trab_inter, ptMax: pt_max_trab_inter },
     }

   let tipos = ["res_nac", "res_inter", "trab_nac", "trab_inter"]
   // Adicionando as regras ao banco de dados
   for (tipo of tipos) {
     let mRegra = {
       ic       : regra.ic,
       ptInd    : regra[tipo].ptInd,
       ptMax    : regra[tipo].ptMax,
       content  : JSON.stringify({
         ano        : regra.ano,
         tipo       : tipo,
         class      : classificao,
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
       $("#trabEvento").removeClass("loading")
     }, ()=>{
       $("#trabEvento").addClass("loading")
     })

   }
   formatTrabEvento()

   // Encerrando regra
   endRegra("trabEvento")
 }


function formatTrabEvento(){
  const regrasIC = regras.achar(item => { return (item.ic == "trabEvento" ? item : false) })

  // Checa se existem regras
  if(regrasIC.length > 0){
    const regra = regrasIC[0]
    // Label da linha
    const anoLabel = (regra.content.ano != false ? `Trabalhos realizados em Evento a partir de ${regra.content.ano}` : `Trabalhos realizados em Evento de todos os anos`)

    // Tipos de titulação
    const tipos = {
      "res_nac":"Resumo Expandido Nacional",
      "res_inter":"Resumo Expandido Internacional",
      "trab_nac": "Trabalho Completo Nacional",
      "trab_inter": "Trabalho Completo Internacional"
    }
    let markup;
    markup =
      `<tr ic='trabEvento'>
        <td colspan='3'>
          <div class='ui header center aligned'>
            Trabalho realizado em Evento
            <div class='ui sub header center aligned'>${anoLabel}</div>
          </div>
        </td>
        <td class='ui center aligned' rowspan='5'>
          <button onclick='deleteTrabEvento()' class='ui button circular icon negative'>
            <i class='remove icon'></i>
          </button>
        </td>
      </tr>`
    // Iterando por titulações
    for (regra_ of regrasIC) {
      markup +=
        `<tr ic='trabEvento'>
          <td>${tipos[regra_.content.tipo]}</td>
          <td class='ui center aligned'>${regra_.ptInd}</td>
          <td class='ui center aligned'>${regra_.ptMax == -1 ? "<i style='color: #BBB'>S.L</i>": regra_.ptMax }</td>
        </tr>`
    }

    removeIC("trabEvento")
    clearIC('trabEvento')
    tB.append(markup)
    tableRefresh()
  }
}

function deleteTrabEvento(){
  const regrasIC = regras.achar(item => { return (item.ic == 'trabEvento' ? item : false) })
  for (regra of regrasIC) {
    removerRegra(regra.idRegra, data=>{
    })
    regras = $(regras).not(regrasIC).get();
  }
  clearIC('trabEvento')
  tableRefresh()
  addOption('trabEvento')
  icDrop.dropdown('refresh')
}

function toggleLimTrabEvento(){
  const state = $("#trabEvento-lim-opt").checkbox("is checked")
  $("#trabEvento-rn-pm").prop("disabled", state)
  $("#trabEvento-ri-pm").prop("disabled", state)
  $("#trabEvento-tn-pm").prop("disabled", state)
  $("#trabEvento-ti-pm").prop("disabled", state)
}
