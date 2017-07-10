
/**
 * Função que gerencia a exibição de apenas um tipo de IC
 * { Comprovados, Não Comprovados, Todos }
 *
 * @param {*} elem Elemento em que a ação foi empregada
 */
function showOnly(elem){
  let el = $(elem)
  let array = $("#" + el.attr('ic')+" .list .item")
  let val = el.val()
  let matches = []

  for(let i = 0; i < array.length; i++){
    $(array[i]).show()
    // Inner Text
    let innTxt = array[i].innerText.toUpperCase()
    // Se o elemento atual possui comprovantes
    let isComp = $(array[i]).find('.comp').length > 0
    // Adiciona aos matches condicionalmente
    if(val == 'showAll')
      matches.push(array[i])
    else if (val == 'showNonComp' && !isComp)
      matches.push(array[i])
    else if(val == 'showComp' && isComp)
      matches.push(array[i])
  }

  var diff = $(array).not(matches);
  for(let i = 0; i < diff.length; i++)
    $(diff[i]).hide()


}

/**
 * Mostra o comprovante em um modal
 *
 * @param {*} elem Elemento empregado na ação
 */
function showComp(elem){
  let el = $(elem)
  let comp = el.attr('comp')
  $("#pdfView").attr("src", comp)
  $("#verComp").modal("show")
}

/**
 * Muda o estado de validação de um IC
 *
 * @param {*} elem Elemento empregado na ação
 * @param {*} state O estado de validação do IC a ser definido
 * @param {*} emailVal Email do validador
 */
function mudarValidado(elem, state, emailVal){
  let ic = $(elem).parent().attr('ic')
  ic = ic.split('-')
  let today = new Date()
  let date = `${today.getFullYear()}-${today.getMonth()+1 < 10 ? "0" + (today.getMonth()+1) : today.getMonth()+1}-${today.getDay() < 10 ? "0" + today.getDay() : today.getDay()}`
  ic = {
    curriculoId: ic[0],
    ic: ic[1],
    icId: ic[2],
    state: state,
    date: date,
    emailVal: emailVal
  }
  updateValidity(ic, data => {
    if(data.success){
      let btn = $($(elem).parent().parent().children()[0])
      let states = {"-1": 'primary', "0": 'negative', "1":'positive'}
      btn.removeClass('positive negative')
      btn.addClass(states[state])
      btn.text(state ? "Aceito" : "Não Aceito")
    }
  })
}

/**
 * Ações a serem executadas no carregamento da página
 * * Inicializar os dropdowns e os accordions
 * * Empregar a ação de click aos labels que dispõe mais informações sobre um IC
 */
$(document).ready(()=>{
  $('.ui.accordion').accordion()
  $('.ui.dropdown').dropdown()
  // Carregamento
  $(".curriculoContent").fadeIn(500);

  $(".sh").click(e=>{
    var elem = $(e.target)
    var dados = elem.parent().parent().find('.dados')
    dados.toggle(300)
    let prev = elem.html()
    if(prev.includes('right'))
      prev = prev.replace('<i class="caret right icon"></i>', `<i class="caret down icon"></i>`)
    else
      prev = prev.replace('<i class="caret down icon"></i>', `<i class="caret right icon"></i>`)
    elem.html(prev)
  })
})

/**
 * Exibe o Modal de envio de comprovante
 *
 * @param {*} elem Elemento empregado na ação
 */
function exibirEnvioComprovante(elem){
  // Resetando os dados internos do modal
  $("#compfilebtn").html("<i class='upload icon'></i> Escolha um Arquivo")
  $("#complabel").text("")
  $("#compprogress").progress("reset")
  // Pegando os dados relativos ao objeto em que foi clicado
  let el = $(elem)
  let data_ = el.attr('filename').split('-')
  let filename = el.attr('filename')
  $('#enviarComprovante').modal('show')
  $('#submitComp').attr('filename', filename)
}

/**
 * Atualiza o texto do label
 *
 * @param {*} input Elemento de Input
 */
function atualizarNome(input){
  let label = $('#compfilebtn')
  let filename = $(input)[0].files[0].name
  label.html("<i class='upload icon'></i>" + filename)
}
/**
 * Envia o comprovante caso possua menos de 3MB, e atualiza o documento com uma resposta
 * visual para as novas ações disponíveis
 *
 * @param {*} elem Elemento empregado na ação
 */
function enviarComprovante(elem){
  let filename = $(elem).attr('filename')
  let input = $('#fileComp')
  let file = input[0].files[0]
  let msg = $('#complabel')
  msg.text("Enviando...")
  // Checando tamanho do arquivo
  if(file.size < 3000000){
    // Guarda na sessão o nome do arquivo atual
    filenameSession(filename)
    // Envia o arquivo para ser processado
    input.upload('processar_comprovante.php', data=>{
      if(data.success){
        msg.text("Enviado com sucesso.")
        setTimeout(()=>{
          $("#enviarComprovante").modal('hide')
          // Atualizar o DOM
          $(`span[ic='${filename}']`).html(`
            <a class="ui button blue" style='border-top-left-radius: 0; border-bottom-left-radius: 0;' href="${ "uploads/comprovantes/" + filename + ".pdf" }" target="_blank">Mostrar Comprovante</a>
            <a class="ui button teal" style='border-top-left-radius: 0; border-bottom-left-radius: 0;' href="#" class='enviarCurriculo' onclick='exibirEnvioComprovante(this)' filename='${ filename }'>Alterar Comprovante</a>
            `)
        }, 1000)
      } else {
        msg.text(data.erro)
      }
    }, progress=>{
      $("#compprogress").progress('set percent',(progress.loaded / progress.total) * 100)
      if((progress.loaded / progress.total) * 100 == 100)
        $("#complabel").html("Salvando...")
    })
  } else {
    msg.text("O arquivo ultrapassa 3MB.")
  }
}

function search(elem){
  let el = $(elem)
  let array = $("#" + el.attr('ic')+" .list .item")
  let text = el.val()
  let matches = []
  for(let i = 0; i < array.length; i++){
    $(array[i]).show()
    if(array[i].innerHTML.toUpperCase().includes(text.toUpperCase()))
      matches.push(array[i])
  }
  var diff = $(array).not(matches);
  for(let i = 0; i < diff.length; i++){
    $(diff[i]).hide()
  }
}

String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}
