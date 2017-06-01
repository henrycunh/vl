fillInputs()


// Comparar senhas
function checkPW(){
  let pw = $("#pw")
  let confirmpw = $("#confirm-pw")
  let erro = $("#pw-erro")

  if(pw.val().length < 6){
    // checando tamanho
    erro.html("A senha deve ter no mínimo 6 caracteres.")
    erro.removeClass("hidden")
    return false
  } else if(pw.val() != confirmpw.val()) {
    // checando coerencia
    erro.html("As senhas não conferem.")
    erro.removeClass("hidden")
    return false
  } else {
    erro.addClass('hidden')
    return true
  }

}

// Preenche campos
function fillInputs(){
  let html;
  console.log(mEmail)
  getUsuarioByEmail(mEmail, user => {
    $(".wrapper").html(html)
    $("#nome").val(user.nomeCompleto)
    $("#email").val(user.email)
    $("#endereco").val(user.endereco)
    $("#dataNasc").val(user.dataNascimento)
    $("#genero").val(user.genero)
    $("#cpf").val(user.cpf)
    $("#rg").val(user.rg)
    $("#cep").val(user.cep)
    $("#telefone").val(user.telefone)
    $("#campus").val(user.campus)
    $("#coordenadoria").val(user.coordenadoria)
    $("#siape").val(user.siape)

  }, ()=>{
    html = $(".wrapper").html()
    $(".wrapper").html("Carregando...")
  })
}

// Atualiza o Usuário
function atualizarUsuario(){
  let user = {
    nomeCompleto: $("#nome").val(),
    email: $("#email").val(),
    dataNascimento: new Date($("#dataNasc").val()).toISOString().substring(0,10),
    genero: $("#genero").val(),
    cpf: $("#cpf").val(),
    rg: $("#rg").val(),
    endereco: $("#endereco").val(),
    cep: $("#cep").val(),
    telefone: $("#telefone").val(),
    campus: $("#campus").val(),
    coordenadoria: $("#coordenadoria").val(),
    siape: $("#siape").val()
  }

  updateUsuario(mEmail, user, data => {
    $("#msg").html("Usuário atualizado.").delay(2000).fadeOut(300)
  }, ()=>{
    $("#msg").html("Atualizando...")
  })
  mEmail = user.email
  if($("#pw").val() != '' && checkPW()){
    changePassword(mEmail, $("#pw").val(), ()=>{});
  }
}

// jQuery DOM
$(()=>{
  $('#genero').dropdown()
  // Preenche os inputs com os dados do banco

  $(document).on('click',"#showpw", ()=>{
    $(".alterarSenha").slideToggle(500)
  })


  // Validação Geral
  $(document).on('click',"#submit",()=>{
    // Checa campos
    if($("#nome").val().length < 6){
      $("#nome-erro").html("O nome deve ter ao menos 6 caracteres")
      $("#nome-erro").removeClass("hidden")
      return
    } else if ($("#email").val().length < 6 || $("#email").val().indexOf("@") == -1){
      $("#nome-erro").addClass('hidden')
      $("#email-erro").html("Digite um e-mail válido")
      $("#email-erro").removeClass("hidden")
      return
    }
    $("#email-erro").addClass('hidden')

    // Checando se o e-mail já forá cadastrado
    getUsuarioByEmail($("#email").val(), user => {
        if($("#email").val() != mEmail && user){
          $("#email-erro").html("Já existe um usuário com esse e-mail.")
          $("#email-erro").removeClass("hidden")
        } else {
          atualizarUsuario()
        }
      }, ()=>{
        $("#msg").html("Verificando Email...")
        $("#msg").fadeIn(300)
      })
  })



  // Máscaras de Form
   $("#cpf").mask('000.000.000-00')
   $("#cep").mask('00000-000')
})
