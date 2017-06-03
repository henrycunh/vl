var regras = []
const tB = $("#table tbody")
const icDrop = $("#icDrop")


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
    // Artigo
    artigoForm()

    if(icDrop.find("option").length == 0)
      icDrop.dropdown("set text", "Não há regras a se adicionar")
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

// Formatação
function titulacaoForm(){
  const regrasTitulacao = regras.achar(item => { return (item.ic == 'titulacao' ? item : false) })
  if(regrasTitulacao.length > 0){
    const maiorTitulacao = (regras[0] != undefined ? regras[0].content.maior : '')
    // Removendo a opção de escolher Titulação, se houver uma regra de titulação
    icRem('titulacao')
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
      markup +=
        `<tr ic='titulacao'>
          <td>${tiposTit[regra.content.tipo]}</td>
          <td>${regra.ptInd}</td>
          <td>${regra.ptMax}</td>
          <td></td>
        </tr>`
    }
    tB.append(markup)
    tableRefresh()
  }
}

function deleteTitulacao(){
  const regrasTitulacao = regras.achar(item => { return (item.ic == 'titulacao' ? item : false) })
  for (regra of regrasTitulacao) {
    removerRegra(regra.idRegra, data=>{
    })
    regras = $(regras).not(regrasTitulacao).get();
  }
  $("tr[ic='titulacao']").remove()
  tableRefresh()
  icDrop.prepend($(new Option("Titulação", "titulacao")))
  icDrop.dropdown('refresh')

}


/*
 .d8b.  d8888b. d888888b d888888b  d888b   .d88b.
d8' `8b 88  `8D `~~88~~'   `88'   88' Y8b .8P  Y8.
88ooo88 88oobY'    88       88    88      88    88
88~~~88 88`8b      88       88    88  ooo 88    88
88   88 88 `88.    88      .88.   88. ~8~ `8b  d8'
YP   YP 88   YD    YP    Y888888P  Y888P   `Y88P'
*/
function salvarArtigo(idEdital){
  // Estados
  let anoOp = $("#artigo-ano-opt").checkbox("is checked")
  let paisOp = $("#artigo-pais-opt").checkbox("is checked")

  // Valores
  let ano = (anoOp ? $("#artigo-ano").val() : false)
  let pais = (paisOp ? $("#artigo-pais").val() : false)

  let regra = {
    ic: 'artigo',
    ptInd: $("#artigo-pi").val(),
    ptMax: $("#artigo-pm").val(),
    content: `{"ano":"${ano}","pais":"${pais}"}`,
    idEdital: idEdital
  }
  insertRegra(regra, data => {
    regra.idRegra = data.id
    regra.content = JSON.parse(regra.content)
    regras.push(regra)
    $("#artigo").removeClass("loading")
  }, ()=>{
    $("#artigo").addClass("loading")
  })

  artigoForm()

  $("#artigo").addClass("mHidden")
  $("#addRegra").removeClass("mHidden")
}

function artigoForm(){
  const regrasArtigo = regras.achar(item => { return (item.ic == 'artigo' ? item : false) })
  if(regrasArtigo.length > 0){
    let regra_ = {ano : regras[0].content.ano, pais : regras[0].content.pais}
    if(regra_.ano == 'false' && regra_.pais == 'false'){
      icRem('artigo')
    }


    const ano = regras[0] != undefined ? regras[0].content.ano : 'false'

    // Campos permissivos
    $("#artigo-ano-opt").checkbox("disable")
    $("#artigo-ano-cnt").addClass("disabled")
    if(ano != 'false'){
      $("#artigo-ano").addClass("disabled")
      $("#artigo-ano").val(ano == 'false' ? '' : ano)
    }

    const anomsg = (ano != 'false' ? "Artigos até o ano de " + ano : "Artigos de todos os anos")
    var markup =
    `<tr ic='artigo'>
      <td colspan='4'>
        <div class='ui header center aligned'>
        Artigo publicado em períodico
        <div class='ui sub header'>
          ${anomsg}
        </div>
        </div>
      </td>
    </tr>`
    // Iterando pelas regras
    for(regra of regrasArtigo){
      markup +=
      `<tr ic='artigo' idregra='${regra.idRegra}'>
        <td>${regra.content.pais == 'nacional' ? "Artigos publicados nacionalmente" : (regra.content.pais == 'internacional' ? "Artigos publicados internacionalmente" : "Todos os artigos")}</td>
        <td>${regra.ptInd}</td>
        <td>${regra.ptMax}</td>
        <td>
          <button onclick='deleteArtigo(${regra.idRegra}, "${regra.content.pais}")' class='ui button mini circular icon negative'>
            <i class='remove icon'></i>
          </button>
        </td>
      </tr>
      `
    }
    tB.find("tr[ic='artigo']").remove()
    tB.append(markup)
    tableRefresh()

    const regraNac = regras.achar(item => {
      return (item.content.pais == 'nacional' ? item : false)
    })
    const regraInter = regras.achar(item => {
      return (item.content.pais == 'internacional' ? item : false)
    })

    if(regraNac.length > 0) {
      $("#artigo-pais").find("option[value='nacional']").remove()
      $("#artigo-pais").dropdown('refresh')
      $("#artigo-pais").dropdown('set selected')
    }

    if(regraInter.length > 0) {
      $("#artigo-pais").find("option[value='internacional']").remove()
      $("#artigo-pais").dropdown('refresh')
      $("#artigo-pais").dropdown('set selected')
    }

    if((regraNac.length > 0 && regraInter.length > 0) || (regraNac.length == 0 && regraInter.length == 0))
     icRem('artigo')
    else if (regraNac.length > regraInter.length || regraNac.length < regraInter.length)
      $("#artigo-pais-cnt").removeClass("mHidden")

   }
}

function deleteArtigo(id, pais){
  const ano = (regras[0] != undefined ? regras[0].content.ano : false)
  const guide = {"nacional" : "Nacional (Brasil)", "internacional" : "Internacional"}
  const regrasArtigo = regras.achar(item => { return (item.ic == 'artigo' ? item : false) })

  removerRegra(id, data=>{
    let index = regras.indexOf(regra)
    if(index > -1)
      regras.splice(index, 1)
  })

  console.log(regrasArtigo.length - 1)
  if(regrasArtigo.length - 1 == 0 || regrasArtigo.length - 1 == -1){
    $(`tr[ic='artigo']`).remove()
    $("#artigo-ano-opt").checkbox("enable")
    $("#artigo-ano-cnt").addClass("mHidden")
    $("#artigo-ano").removeClass("disabled")
    $("#artigo-ano").val("")
    if(checkIc('artigo') == 0){
      icDrop.prepend(`<option value='artigo'>Artigo publicado em periódico</option>`)
    }
  }


  $(`tr[idregra='${id}']`).remove()

  if(regras.length-1 == 0)
    $("#tableCtn").addClass("mHidden")

  if(pais != undefined){
    $("#artigo-pais").prepend(`<option value='${pais}'>${guide[pais]}</option>`)
  }
  else {

  }

  const regraNac = regras.achar(item => {
    return (item.content.pais == 'nacional' ? item : false)
  })
  const regraInter = regras.achar(item => {
    return (item.content.pais == 'internacional' ? item : false)
  })

  if(regraNac.length > 0 || regraInter.length > 0 && regrasArtigo.length - 1 == 1)
    if(checkIc('artigo'))
      icDrop.prepend(`<option value='artigo'>Artigo publicado em periódico</option>`)
}





Array.prototype.achar = function(fn){
  let array = this
  let subarr = []
  for(item of array){
    let result = fn(item)
    if(result) subarr.push(result)
  }
  return subarr
}

function tableRefresh(){
  if(regras.length < 1)
    $("#tableCtn").addClass('mHidden')
  else
    $("#tableCtn").removeClass("mHidden")
}

function cancelRegra(ic){
  $("#"+ic).addClass('mHidden')
  $("#addRegra").removeClass('mHidden')
  $("#"+ic +" input").val("")
}

function toggleCnt(cnt){
  const state = $("#"+cnt).hasClass("mHidden")
  if(state)
    $("#"+cnt).removeClass('hidden mHidden')
  else
    $("#"+cnt).addClass('hidden mHidden')
}

function icRem(ic){
  icDrop.find(`option[value='${ic}']`).remove()
  icDrop.dropdown('set selected')
}

function checkIc(ic){
  return icDrop.find(`option[value='${ic}']`).length
}
