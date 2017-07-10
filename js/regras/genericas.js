/**
 * Salva as regras no DB
 *
 * @param {*} idEdital ID do Edital
 */
function salvarRegra(idEdital, ic){
  const estado = $(`#${ic}-ano-opt`).checkbox("is checked") // Estado da condição
  const ano = (estado ? $(`#${ic}-ano`).val() : false) // Valor da condição
  const lim = $(`#${ic}-lim-opt`).checkbox("is checked")

  // Objeto de regra
  let regra = {
    ic: ic,
    ptInd: $(`#${ic}-pi`).val(),
    ptMax: !lim ? $(`#${ic}-pm`).val() : -1,
    content: JSON.stringify({
      ano: ano,
      lim: lim
    }),
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
  const desc = options

  // Acha regras existentes do IC
  const regrasIC = regras.achar(item => { return (item.ic == ic ? item : false) })
  // Checa se existem regras
  if(regrasIC.length > 0){
    const regra = regrasIC[0]
    // Label da linha
    const anoLabel = (regra.content.ano != false ? `${desc[ic]} a partir de ${regra.content.ano}` : `${desc[ic]} de todos os anos`)

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
      <td>${regra.ptMax == -1 ? "<i style='color: #BBB'>S.L</i>": regra.ptMax }</td>
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
    let index = 0; for (regra of regras) { if(regra.idRegra == id) break; index++; }
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

  console.log(regras.length - 1 == 0)
  // Se não existe regra alguma, esconde a tabela
  if(regras.length - 1 == 0)
    $("#tableCtn").addClass("mHidden")
}
