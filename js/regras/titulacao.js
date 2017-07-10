
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
      content: JSON.stringify({
        maior: regra.maior,
        tipo: mTipo
      }),
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

  // Encerrando regra
  endRegra("titulacao")
}

/**
 * Formata as regras de titulação no documento
 */
function titulacaoForm(){
  const regrasTitulacao = regras.achar(item => { return (item.ic == 'titulacao' ? item : false) })
  if(regrasTitulacao.length > 0){
    const maiorTitulacao = (regrasTitulacao[0] != undefined ? regrasTitulacao[0].content.maior : '')
    // Removendo a opção de escolher Titulação, se houver uma regra de titulação
    removeIC('titulacao')
    // Tipos de titulação
    const tiposTit = {
      "grad"  : "Graduação",
      "esp"   : "Especialização",
      "mest"  : "Mestrado",
      "doc"   : "Doutorado"
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
          <td colspan='2' class='ui center aligned' >${regra.ptInd == 0 ? "<b style='color:#BBB'>X</b>" : regra.ptInd}</td>
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
