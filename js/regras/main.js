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
var ptMaxTotal = 0
var ptLimTotal = 0
/**
 * Inicialização da página, onde é feito o resgate das regras
 * e a exibição delas na tabela, de forma asíncrona, através
 * de requests AJAX
 */
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
    // Banca
    formatBanca()
    // Coordenação de Projetos
    formatCoordProj()
    // Orientação
    formatOrientacao()
    // Trabalho em Evento
    formatTrabEvento()
    // ICs Genéricos
    formatIC('artigo')
    formatIC('capLivro')
    formatIC('corpoEditorial')
    formatIC('livro')
    formatIC('marca')
    formatIC('organizacaoEvento')
    formatIC('patente')
    formatIC('software')

    if(icDrop.find("option").length == 0)
      icDrop.dropdown("set text", "Não há regras a se adicionar")

    $(".lim").on("change", (e)=>{
      let ic = $(e.target).attr("ic")
      if(ic != undefined){
        let state = $("#"+ic+"-lim-opt").checkbox("is checked")
        console.log(state)
        $("#"+ic+"-pm").prop("disabled", state)
      } else {
        console.log($(e.target).attr("ic"))
      }
    })

    // Aplicando Tooltips às pontuações máximas
    $(".max").popup()
    $("#tablefoot").html(`<i class="mini info link icon maxpop"></i><b>TOTAL:</b> <i id='ptMaxTotal'>${ptMaxTotal}</i> `)
    refreshMaxLabel()
  })
})
