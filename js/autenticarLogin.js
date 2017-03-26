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
  let userdata = {op:'usuario/autenticar', email: email.val(), senha: pw.val()}

  // Autenticate
  $.ajax({
    method: 'POST',
    url: 'api/usuario.php',
    data: userdata,
    dataType: 'json',
    beforeSend: () => {$("#preloader").fadeIn(100)},
    error: (e,x,s) => {
      console.log(s)
      console.log(e)
      console.log(x)
    },
    success: data => {
      if(data.emailFound) {
        // Email encontrado
        if(data.success){
          // Senha confere
          window.location.replace('index.php')
        } else {
          // Senha não confere
          pwerro.html("Senha incorreta")
          pwerro.slideDown(500)
        }
      } else {
        // Email não encontrado
        emailerro.html("E-mail não encontrado")
        emailerro.slideDown(500)
      }

      $("#preloader").fadeOut(100)
    }
})


}
