function autenticar(){
  // inputs
  let email = $("#email")
  let emailerro = $("#emailerro")
  let pw = $("#pw")
  let pwerro = $("#senhaerro")

  // Check for empty inputs
  if(email.val() == ""){
    pwerro.slideUp(500)
    emailerro.html("Campo vazio")
    emailerro.slideDown(500)
    return false
  } else if (pw.val() == "") {
    emailerro.slideUp(500)
    pwerro.html("Campo vazio")
    pwerro.slideDown(500)
    return false
  }
  // closing errors
  pwerro.slideUp(500)

  // post data
  let userdata = {op:'usuario/email', email: email.val()}

  // Autenticate
  $.ajax({
    method: 'POST',
    url: 'api/usuario.php',
    data: userdata,
    dataType: 'json',
    beforeSend: () => {$("#preloader").fadeIn(100)},
    success: data => {
      if(!data) {
        // User doesn't exist
        emailerro.html("Não existe um usuário com esse e-mail")
        emailerro.slideDown(500)
      } else {
        emailerro.slideUp(500)
        // Authentication Data
        let auth = {op: 'usuario/autenticar', id: data.idUsuario, senha: pw.val()}
        $.post('api/usuario.php', auth, _data => {
          if(_data.success){
            // senha correta
            window.location.replace("index.php");
          } else {
            // senha incorreta
            pwerro.html("Senha Incorreta")
            pwerro.slideDown(500)
          }
        })
      }
      $("#preloader").fadeOut(100)
    }
})


}
