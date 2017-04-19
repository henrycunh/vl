// Esconder ou Mostrar ICs
function toggle(elem){
  $(elem).html($(elem).html() == 'Esconder' ? 'Mostrar' : 'Esconder')
  let el = $(elem).attr('ic')
  $("#"+el).fadeToggle(300)
}



$(document).ready(()=>{
  // Carregamento
  $("#load").hide()
  $(".curriculoContent").fadeIn(500);
})

function exibirEnvioCurriculo(elem){
  // Pegando os dados relativos ao objeto em que foi clicado
  let el = $(elem)
  let data_ = el.attr('filename').split('-')
  let data = {
    ic : 'ic_' + data_[0],
    curriculoId: data_[1],
    icId : data_[2]
  }
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
