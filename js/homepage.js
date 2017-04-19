$(()=>{
  // Atribuindo evento ao botão
  $("#desconectar").on('click', e => {
    $("#desconectar").html("Saindo...")
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
