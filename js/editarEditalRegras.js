var regras = []
const tB = $("#table tbody")
const icDrop = $("#icDrop")

// Formatação Titulação
function titulacaoForm(){
  const regrasTitulacao = regras.achar(item => { return (item.ic == 'titulacao' ? item : false) })
  if(regrasTitulacao.length > 0){
    const maiorTitulacao = (regras[0] != undefined ? JSON.parse(regras[0].content).maior : '')
    // Removendo a opção de escolher Titulação, se houver uma regra de titulação
    icDrop.find("option[value='titulacao']").remove()
    icDrop.dropdown('set selected', $(icDrop.find("option")[0]).val())
    // Tipos de titulação
    const tiposTit = {
      "grad":"Graduação",
      "esp": "Especialização",
      "mest": "Mestrado",
      "doc":"Doutorado"
    }
    let markup =
      `<tr ic='titulacao'>
        <td colspan='3'>
          <div class='ui header center aligned'>
            Titulação
            <div class='ui sub header center aligned'>${maiorTitulacao ? "Pontuando apenas a maior titulação" : "Pontuando todas as titulações"}</div>
          </div>
        </td>
        <td class='ui center aligned'>
          <button onclick='deleteTitulacao()' class='ui button circular icon negative'>
            <i class='remove icon'></i>
          </button>
        </td>
      </tr>`
    // Iterando por titulações
    for (regra of regrasTitulacao) {
      regra.content = JSON.parse(regra.content)
      markup +=
        `<tr ic='titulacao'>
          <td>${tiposTit[regra.content.tipo]}</td>
          <td>${regra.ptInd}</td>
          <td>${regra.ptMax}</td>
          <td></td>
        </tr>`
    }
    tB.append(markup)
  }
}

function deleteTitulacao(){
  const regrasTitulacao = regras.achar(item => { return (item.ic == 'titulacao' ? item : false) })
  for (regra of regrasTitulacao) {
    removerRegra(regra.idRegra, data=>{
      console.log(data)
    })
    regras = $(regras).not(regrasTitulacao).get();
  }
  $("tr[ic='titulacao']").remove()
  if(regras.length < 1) $("#tableCtn").addClass('mHidden')
  icDrop.prepend($(new Option("Titulação", "titulacao")))
  icDrop.dropdown('refresh')

}

// Carregando Regras
$(()=>{
  // Pegando do DB
  getRegras(idEdital, data =>{
    for (regra of data) {
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

  })
})

function adicionarRegra(){
  let ic = $("#icDrop").val()
  $("#" + ic).removeClass('mHidden')
  $("#addRegra").addClass("mHidden")
}




/*
d888888b d888888b d888888b db    db db       .d8b.   .o88b.  .d8b.   .d88b.
`~~88~~'   `88'   `~~88~~' 88    88 88      d8' `8b d8P  Y8 d8' `8b .8P  Y8.
   88       88       88    88    88 88      88ooo88 8P      88ooo88 88    88
   88       88       88    88    88 88      88~~~88 8b      88~~~88 88    88
   88      .88.      88    88b  d88 88booo. 88   88 Y8b  d8 88   88 `8b  d8'
   YP    Y888888P    YP    ~Y8888P' Y88888P YP   YP  `Y88P' YP   YP  `Y88P'
*/
function salvarTitulacao(idEdital){
  // Estados
  let maior = $("#titulacao-exc").checkbox("is checked")
  let grad = $("#titulacao-grad").checkbox("is checked")
  let esp = $("#titulacao-esp").checkbox("is checked")
  let mest = $("#titulacao-mest").checkbox("is checked")
  let doc = $("#titulacao-doc").checkbox("is checked")

  // Valores
  let gradInd = $("#titulacao-grad-pi").val()
  let gradMax = $("#titulacao-grad-pm").val()
  let espInd = $("#titulacao-esp-pi").val()
  let espMax = $("#titulacao-esp-pm").val()
  let mestInd = $("#titulacao-mest-pi").val()
  let mestMax = $("#titulacao-mest-pm").val()
  let docInd = $("#titulacao-doc-pi").val()
  let docMax = $("#titulacao-doc-pm").val()

  // Armazenando regra de forma geral
  let regra = {
      ic: "titulacao",
      maior: maior,
      grad: {ptInd: gradInd, ptMax: gradMax},
      esp: {ptInd: espInd, ptMax: espMax},
      mest: {ptInd: mestInd, ptMax: mestMax},
      doc: {ptInd: docInd, ptMax: docMax}
    }

  let tipos = ['grad', 'esp', 'mest', 'doc']
  $("#titulacao").addClass("loading")
  // Adicionando as regras ao banco de dados
  for (tipo of tipos) {
    var mTipo = tipo;
    let mRegra = {
      ic: regra.ic,
      ptInd: regra[tipo].ptInd,
      ptMax: regra[tipo].ptMax,
      content: `{
        "maior": ${regra.maior},
        "tipo": "${mTipo}"
      }`,
      idEdital: idEdital
    }
    // Inserindo regra no DB e no array
    insertRegra(mRegra, data => {
      mRegra.idRegra = data.id
      regras.push(mRegra)
    }, ()=>{})

  }
  $("#titulacao").removeClass("loading")
  titulacaoForm()

  // Adicionando a regra à variável local de regras
  $("#titulacao").addClass("mHidden")
  $("#addRegra").removeClass("mHidden")
}

/*
 .d8b.  d8888b. d888888b d888888b  d888b   .d88b.
d8' `8b 88  `8D `~~88~~'   `88'   88' Y8b .8P  Y8.
88ooo88 88oobY'    88       88    88      88    88
88~~~88 88`8b      88       88    88  ooo 88    88
88   88 88 `88.    88      .88.   88. ~8~ `8b  d8'
YP   YP 88   YD    YP    Y888888P  Y888P   `Y88P'
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

function toggleCnt(cnt){
  const state = $("#"+cnt).hasClass("mHidden")

  if(state)
    $("#"+cnt).removeClass('hidden mHidden')
  else
    $("#"+cnt).addClass('hidden mHidden')

}
