$(()=>{
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
