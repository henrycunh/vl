/**
 * Salva a regra de Orientação
 *
 * @param {*} idEdital
 */
function salvarOrientacao(idEdital){
  const anoCond = $("#orientacao-ano-opt").checkbox("is checked")
  const ano = (anoCond ? $("#orientacao-ano").val() : false) // Valor da condição
  const lim = $("#orientacao-lim-opt").checkbox("is checked")
  // Valores
  var tipos = ["inic", "grad", "esp", "mest", "doc", "posdoc"]

  var pontuacoes = []
  for (tipo of tipos) {
    pontuacoes[tipo] = {
      ptInd: $("#orientacao-" + tipo + "-pi").val(),
      ptMax: lim ? -1 : $("#orientacao-" + tipo + "-pm").val()
    }
  }

  // Armazenando regra de forma geral
  let regra = {
      ic: "orientacao",
      ano: ano,
      inic: pontuacoes['inic'],
      grad: pontuacoes['grad'],
      esp: pontuacoes['esp'],
      mest: pontuacoes['mest'],
      doc: pontuacoes['doc'],
      posdoc: pontuacoes['posdoc'],
    }
    console.log(pontuacoes)
    console.log(regra)

  // Adicionando as regras ao banco de dados
  for (tipo of tipos) {
    var mTipo = tipo;
    let mRegra = {
      ic: regra.ic,
      ptInd: regra[tipo].ptInd,
      ptMax: regra[tipo].ptMax,
      content: JSON.stringify({
        ano: regra.ano,
        tipo: mTipo
      }),
      idEdital: idEdital
    }
    console.log(mRegra)
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
  formatOrientacao()

  // Encerrando regra
  endRegra("orientacao")
}

function formatOrientacao(){
  const regrasIC = regras.achar(item => { return (item.ic == "orientacao" ? item : false) })

  // Checa se existem regras
  if(regrasIC.length > 0){
    const regra = regrasIC[0]
    // Label da linha
    const anoLabel = (regra.content.ano != false ? `Orientações a partir de ${regra.content.ano}` : `Orientações de todos os anos`)

    // Tipos de titulação
    const tiposTit = {
      "inic":"Iniciação Científica",
      "grad":"Graduação",
      "esp": "Especialização",
      "mest": "Mestrado",
      "doc":"Doutorado",
      "posdoc":"Pós-Doutorado"
    }
    let markup;
    markup =
      `<tr ic='orientacao'>
        <td colspan='3'>
          <div class='ui header center aligned'>
            Orientação
            <div class='ui sub header center aligned'>${anoLabel}</div>
          </div>
        </td>
        <td class='ui center aligned' rowspan='7'>
          <button onclick='deleteOrientacao()' class='ui button circular icon negative'>
            <i class='remove icon'></i>
          </button>
        </td>
      </tr>`
    // Iterando por titulações
    for (regra_ of regrasIC) {
      markup +=
        `<tr ic='orientacao'>
          <td>${tiposTit[regra_.content.tipo]}</td>
          <td class='ui center aligned'>${regra_.ptInd > 0 ? regra_.ptInd : "<b style='color:#BBB'>X</b>"}</td>
          <td class='ui center aligned'>${regra_.ptMax == -1 ? "<i style='color: #BBB'>S.L</i>": (regra_.ptMax > 0 ? regra_.ptMax : "<b style='color:#BBB'>X</b>") }</td>
        </tr>`
    }
    clearIC('orientacao')
    tB.append(markup)
    removeIC("orientacao")
    tableRefresh()
  }
}

function deleteOrientacao(){
  const regrasIC = regras.achar(item => { return (item.ic == 'orientacao' ? item : false) })
  for (regra of regrasIC) {
    removerRegra(regra.idRegra, data=>{
    })
    regras = $(regras).not(regrasIC).get();
  }
  clearIC('orientacao')
  tableRefresh()
  addOption('orientacao')
  icDrop.dropdown('refresh')
}

function toggleLimOrientacao(){
  const state = $("#orientacao-lim-opt").checkbox("is checked")
  $("#orientacao-inic-pm").prop("disabled", state)
  $("#orientacao-grad-pm").prop("disabled", state)
  $("#orientacao-esp-pm").prop("disabled", state)
  $("#orientacao-mest-pm").prop("disabled", state)
  $("#orientacao-doc-pm").prop("disabled", state)
  $("#orientacao-posdoc-pm").prop("disabled", state)
}
