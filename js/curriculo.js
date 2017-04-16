function toggle(elem){
  $(elem).html($(elem).html() == 'Esconder' ? 'Mostrar' : 'Esconder')
  let el = $(elem).attr('ic')
  $("#"+el).fadeToggle(300)
}



$(document).ready(()=>{
  $("#load").hide()
  $(".curriculoContent").fadeIn(500);
})

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
