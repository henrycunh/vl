function searchTable(elem){
  let el = $(elem)
  let array = $("#pesquisadores table tr")
  let text = el.val()
  let matches = []
  matches.push(array[0])
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

$(()=>{
  // Ao clicar, destruir sessão e redirecionar para o Índice
  $("#desconectar").click(e=>{
    $(this).html(`<span class='glyphicon glyphicon-log-out icon'></span> Saindo...`)

    $.ajax({
      url: "api/usuario.php",
      method: 'POST',
      dataType: 'json',
      data: {op:'usuario/desconectar'},
      success: data => {
        window.location.replace('index.php')
      }
    })

    e.preventDefault()
  })

})
