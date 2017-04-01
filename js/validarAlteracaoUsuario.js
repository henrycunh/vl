fillInputs()


// Comparar senhas
function checkPW(){
  let pw = $("#pw")
  let confirmpw = $("#confirm-pw")
  let erro = $("#pw-erro")

  if(pw.val().length < 6){
    // checando tamanho
    erro.html("A senha deve ter no mínimo 6 caracteres.")
    erro.slideDown(500)
    return false
  } else if(pw.val() != confirmpw.val()) {
    // checando coerencia
    erro.html("As senhas não conferem.")
    erro.slideDown(500)
    return false
  } else {
    erro.slideUp(500)
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
    telefone: $("#telefone").val()
  }
  updateUsuario(mEmail, user, data => {
    console.log('here')
    $("#submit").html("Salvar")
  }, ()=>{
    $("#submit").html("Salvando...")
  })
  mEmail = user.email
  if($("#pw").val() != '' && checkPW()){
    changePassword(mEmail, $("#pw").val());
  }
}

// jQuery DOM
$(()=>{
  // Preenche os inputs com os dados do banco

  $(document).on('click',"#showpw", ()=>{
    $(".alterarSenha").slideToggle(500)
  })


  // Validação Geral
  $(document).on('click',"#submit",()=>{
    // Checa campos
    if($("#nome").val().length < 6){
      $("#nome-erro").html("O nome deve ter ao menos 6 caracteres")
      $("#nome-erro").slideDown(500)
      return
    } else if ($("#email").val().length < 6 || $("#email").val().indexOf("@") == -1){
      $("#nome-erro").slideUp(500)
      $("#email-erro").html("Digite um e-mail válido")
      $("#email-erro").slideDown(500)
      return
    }
    $("#email-erro").slideUp(500)

    // Checando se o e-mail já forá cadastrado
    getUsuarioByEmail($("#email").val(), user => {
        if($("#email").val() != mEmail && user){
          $("#email-erro").html("Já existe um usuário com esse e-mail.")
          $("#email-erro").slideDown(500)
        } else {
          atualizarUsuario()
        }
        $("#submit").html("Salvar")
      }, ()=>{
        $("#submit").html("Carregando...")
      })
  })



  // Máscaras de Form
   $("#cpf").mask('000.000.000-00')
   $("#cep").mask('00000-000')
   $("#telefone").mask('(00) 00000-0000')
})
