$(()=>{
  // Atribuindo evento ao botão
  $("#desconectar").on('click', e => {
    $.ajax({
      url: "api/usuario.php",
      type: 'post',
      dataType: 'json',
      data: {op:'usuario/desconectar'},
      beforeSend: () => {
        $("#preloader").fadeIn(100)
      },
      success: data => {
        window.location.replace('index.php')

      }
    })
    e.preventDefault()
  })

})
