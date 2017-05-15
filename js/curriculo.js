// Esconder ou Mostrar ICs
function toggle(elem){
  $(elem).html($(elem).html() == 'Esconder' ? 'Mostrar' : 'Esconder')
  let el = $(elem).attr('ic')
  $("#"+el).fadeToggle(300)
}

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

function showComp(elem){
  let el = $(elem)
  let comp = el.attr('comp')
  if(!$('.compModal').length){
    let pop = `
      <div class="compModal">
        <div class='bar'>
        <span>Comprovante</span> <button onclick='fecharCompModal()'><i class='remove icon'></i></button>
        <button id='min' fn='hide' onclick='minCompModal()'><i class='minus icon'></i></button>
        <button id='max' fn='max' onclick='maxCompModal()'><i class='expand icon'></i></button>
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
    $('#max').html("<i class='compress icon'></i>")
    $('#max').attr('fn', 'min')
    $('#min').html("<i class='minus icon'></i>")
    $("#min").attr('fn', 'hide')
  } else {
    $('.compModal .embCnt').css({'padding-bottom' : '0'})
    $('.compModal').css({'left':"auto", 'top':"auto", 'right':'1em', 'bottom':'1em', 'border-radius':'6px'})
    $('#max').html("<i class='expand icon'></i>")
    $('#max').attr('fn', 'max')
  }
}

function minCompModal(){
  if($('#min').attr('fn') == 'hide'){
    $('.compModal').css({'left':"auto", 'top':"auto", 'right':'0', 'bottom':'0', 'border-radius':'0'})
    $('.compModal .embCnt').hide()
    $('#min').html("<i class='plus icon'></i>")
    $("#min").attr('fn', 'show')
    $('#max').attr('fn', 'max')
    $('#max').html("<i class='expand icon'></i>")
  } else {
    $('.compModal .embCnt').css({'padding-bottom' : '0'})
    $('.compModal .embCnt').show()
    $('.compModal').css({'right':'1em', 'bottom':'1em', 'border-radius':'6px'})
    $('#min').html("<i class='minus icon'></i>")
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
  $('.ui.accordion').accordion()
  $('.ui.dropdown').dropdown()
  // Carregamento
  $("#load").hide()
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

function exibirEnvioCurriculo(elem){
  // Pegando os dados relativos ao objeto em que foi clicado
  let el = $(elem)
  let data_ = el.attr('filename').split('-')
  let filename = el.attr('filename')
  $('#enviarComprovante').modal('show')
  $('#submitComp').attr('filename', filename)

  // let data = {
  //   curriculoId: data_[0],
  //   ic : 'ic_' + data_[1],
  //   icId : data_[2]
  // }
  // Criando Modal

}

function atualizarNome(input){
  let label = $('#compfilebtn')
  let filename = $(input)[0].files[0].name
  label.text(filename)
}

function fecharModal(button){
  let modalId = $(button).attr('modalid')
  $("#" + modalId).remove()
}

// Envia o curriculo, envia o filename para o servidor, e faz as alterações
// necessárias no DOM
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
            <a class="ui button blue" href="${ "uploads/comprovantes/" + filename + ".pdf" }" target="_blank">Mostrar Comprovante</a>
            <a class="ui button teal" href="#" class='enviarCurriculo' onclick='exibirEnvioCurriculo(this)' filename='${ filename }'>Alterar Comprovante</a>
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
