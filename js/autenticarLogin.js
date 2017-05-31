function autenticar(){
  // inputs
  let email = $("#email")
  let emailerro = $("#emailerro")
  let pw = $("#pw")
  let pwerro = $("#senhaerro")

  // Check for empty inputs
  if(email.val() == ""){
    pwerro.addClass('hidden')
    emailerro.html("Campo vazio")
    emailerro.removeClass('hidden')
    return false
  } else if (pw.val() == "") {
    emailerro.addClass('hidden')
    pwerro.html("Campo vazio")
    pwerro.removeClass('hidden')
    return false
  }
  // closing errors
  emailerro.addClass('hidden')
  pwerro.addClass('hidden')

  // post data
  let userdata = {op:'usuario/autenticar', email: email.val(), senha: pw.val()}

  // Autenticate
  $.ajax({
    method: 'POST',
    url: 'api/usuario.php',
    data: userdata,
    dataType: 'json',
    beforeSend: () => {$("#wrap").addClass('loading')},
    error: (e,x,s) => {
      console.log(s)
      console.log(e)
      console.log(x)
    },
    success: data => {
      console.log(data)
      if(data.emailFound) {
        // Email encontrado
        if(data.success){
          // Senha confere
          window.location.replace('index.php')
        } else {
          // Senha não confere
          pwerro.html("Senha incorreta")
          $("#wrap").removeClass('loading')
          pwerro.removeClass('hidden')
        }
      } else {
        // Email não encontrado
        emailerro.html("E-mail não encontrado")
        $("#wrap").removeClass('loading')
        emailerro.removeClass('hidden')
      }

    }
})
}

function hitEnter(e){
  let code = (e.keyCode ? e.keyCode : e.which);
  if (code == 13){
    e.preventDefault()
    autenticar()
  }
}

$(()=>{
  $("#email").bind("keypress", {}, hitEnter);
  $("#pw").bind("keypress", {}, hitEnter);
  //
  // $("#email").focus(()=>{ $("#emaillabel").show() })
  // $("#email").focusout(()=>{ $("#emaillabel").hide() })
  // $("#pw").focus(()=>{ $("#pwlabel").show() })
  // $("#pw").focusout(()=>{ $("#pwlabel").hide() })
})
