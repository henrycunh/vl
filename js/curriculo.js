// Esconder ou Mostrar ICs
function toggle(elem){
  $(elem).html($(elem).html() == 'Esconder' ? 'Mostrar' : 'Esconder')
  let el = $(elem).attr('ic')
  $("#"+el).fadeToggle(300)
}

function showOnly(elem){
  let el = $(elem)
  let array = $("#" + el.attr('ic')+" ul li")
  let val = el.val()
  let matches = []

  for(let i = 0; i < array.length; i++){
    $(array[i]).show()
    // Inner Text
    let innTxt = array[i].innerText.toUpperCase()
    // Se o elemento atual possui comprovantes
    let isComp = $(array[i]).find('.col.comprovante').length > 0
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

function showComp(elem){
  let el = $(elem)
  let comp = el.attr('comp')
  if(!$('.compModal').length){
    let pop = `
      <div class="compModal">
        <div class='bar'>
        <span>Comprovante</span> <button onclick='fecharCompModal()'><i class='typcn typcn-times'></i></button>
        <button id='min' fn='hide' onclick='minCompModal()'><i class='typcn typcn-minus'></i></button>
        <button id='max' fn='max' onclick='maxCompModal()'><i class='typcn typcn-arrow-maximise'></i></button>
        </div>
        <div class='embCnt'>
        <embed class='emb' src="${comp}" width="500" height="500" type='application/pdf'>
        </div>
      </div>`
    $('body').append(pop)
    $(".compModal").fadeIn(1000)
  } else {
    $('.comModal .embCnt').html(`<embed class='emb' src="${comp}" width="500" height="500" type='application/pdf'>`)
  }
}

function fecharCompModal(){
  $('.compModal').fadeOut(500)
  setTimeout(()=>{$('.compModal').remove()}, 500)
}

function maxCompModal(){
  if($('#max').attr('fn') == 'max'){
    $('.compModal .embCnt').show()
    $('.compModal .embCnt').css({'padding-bottom' : '2em'})
    $('.compModal').css({'left':'0em', 'top':'0em', 'right':'0', 'bottom':'0', 'border-radius':'0'})
    $('#max').html("<i class='typcn typcn-arrow-minimise'></i>")
    $('#max').attr('fn', 'min')
    $('#min').html("<i class='typcn typcn-minus'></i>")
    $("#min").attr('fn', 'hide')
  } else {
    $('.compModal .embCnt').css({'padding-bottom' : '0'})
    $('.compModal').css({'left':"auto", 'top':"auto", 'right':'1em', 'bottom':'1em', 'border-radius':'6px'})
    $('#max').html("<i class='typcn typcn-arrow-maximise'></i>")
    $('#max').attr('fn', 'max')
  }
}

function minCompModal(){
  if($('#min').attr('fn') == 'hide'){
    $('.compModal').css({'left':"auto", 'top':"auto", 'right':'0', 'bottom':'0', 'border-radius':'0'})
    $('.compModal .embCnt').hide()
    $('#min').html("<i class='typcn typcn-plus'></i>")
    $("#min").attr('fn', 'show')
    $('#max').attr('fn', 'max')
    $('#max').html("<i class='typcn typcn-arrow-maximise'></i>")
  } else {
    $('.compModal .embCnt').css({'padding-bottom' : '0'})
    $('.compModal .embCnt').show()
    $('.compModal').css({'right':'1em', 'bottom':'1em', 'border-radius':'6px'})
    $('#min').html("<i class='typcn typcn-minus'></i>")
    $("#min").attr('fn', 'hide')
  }
}




function mudarValidado(elem, state, emailVal){
  let ic = $(elem).parent().parent().attr('ic')
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
      let col = $($(elem).parent().parent().parent().children()[0])
      col.removeClass()
      let states = {"-1": 'nao-validado', "0": 'invalido', "1":'valido'}
      col.addClass(`col ${states[state]}`)
      col.text(state ? "Válido" : "Inválido")
    }
  })
}

$(document).ready(()=>{
  // Carregamento
  $("#load").hide()
  $(".curriculoContent").fadeIn(500);

  $(".sh").click(e=>{
    var elem = $(e.target)
    var dados = elem.parent().find('.dados')
    dados.toggle(300)
    elem.html(elem.html() == '🡫' ? '🡩' : '🡫')
  })
})

function exibirEnvioCurriculo(elem){
  // Pegando os dados relativos ao objeto em que foi clicado
  let el = $(elem)
  let data_ = el.attr('filename').split('-')
  // let data = {
  //   curriculoId: data_[0],
  //   ic : 'ic_' + data_[1],
  //   icId : data_[2]
  // }
  // Criando Modal
  let modal = `
    <div id='modal-${el.attr('filename')}' class='currModal'>
      <div class='currModalMsg'>
        <button class='close' modalid='modal-${el.attr('filename')}' onclick='fecharModal(this)'>X</button>
        <label for='file-${el.attr('filename')}'><i class="typcn typcn-upload"></i> Escolha um arquivo...</label>
        <input type='file' name='comprovante' accept='application/pdf' id='file-${el.attr('filename')}' onchange='atualizarNome(this)'>
        <button class='send' onclick='enviarCurriculo("${el.attr('filename')}")'>Enviar</button>
        <progress id='progress-${el.attr('filename')}' min='0' max='100' value='0'>
        <div class='modalMsg'></div>
      </div>
    </div>
  `
  $('body').append(modal);
}

function atualizarNome(input){
  let label = $(`label[for="${$(input).attr('id')}"]`)
  let filename = $(input)[0].files[0].name
  label.text(filename)
}

function fecharModal(button){
  let modalId = $(button).attr('modalid')
  $("#" + modalId).remove()
}

// Envia o curriculo, envia o filename para o servidor, e faz as alterações
// necessárias no DOM
function enviarCurriculo(fn){
  let input = $('#file-'+fn)
  let file = input[0].files[0]
  let msg = $('.modalMsg')
  msg.text("Enviando...")
  // Checando tamanho do arquivo
  if(file.size < 3000000){
    // Guarda na sessão o nome do arquivo atual
    filenameSession(fn)
    // Envia o arquivo para ser processado
    input.upload('processar_comprovante.php', data=>{
      if(data.success){
        msg.text("Enviado com sucesso.")
        setTimeout(()=>{
          $(".currModal").remove()
          // Atualizar o DOM
          $(`div[ic='${fn}']`).html(`
            <div class="col comprovante">
              <a href="${ "uploads/comprovantes/" + fn + ".pdf" }" target="_blank">Mostrar Comprovante</a>
            </div>
            <div class="col comprovante">
              <a href="#" class='enviarCurriculo' onclick='exibirEnvioCurriculo(this)' filename='${ fn }'>Alterar Comprovante</a>
            </div>
            `)
        }, 1000)
      }
    }, $("#progress-"+fn))

  } else {
    msg.text("O arquivo ultrapassa 3MB.")
  }
}

function search(elem){
  let el = $(elem)
  let array = $("#" + el.attr('ic')+" ul li")
  let text = el.val()
  let matches = []
  for(let i = 0; i < array.length; i++){
    $(array[i]).show()
    if(array[i].innerText.toUpperCase().includes(text.toUpperCase()))
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
