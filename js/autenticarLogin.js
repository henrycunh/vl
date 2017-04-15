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
  emailerro.slideUp(500)
  pwerro.slideUp(500)

  // post data
  let userdata = {op:'usuario/autenticar', email: email.val(), senha: pw.val()}

  // Autenticate
  $.ajax({
    method: 'POST',
    url: 'api/usuario.php',
    data: userdata,
    dataType: 'json',
    beforeSend: () => {$("#entrar").html("Validando...")},
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
          $("#entrar").html("Entrar")
          pwerro.slideDown(500)
        }
      } else {
        // Email não encontrado
        emailerro.html("E-mail não encontrado")
        $("#entrar").html("Entrar")
        emailerro.slideDown(500)
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

  $("#email").focus(()=>{ $("#emaillabel").show(500) })
  $("#email").focusout(()=>{ $("#emaillabel").hide(500) })
  $("#pw").focus(()=>{ $("#pwlabel").show(500) })
  $("#pw").focusout(()=>{ $("#pwlabel").hide(500) })
})
