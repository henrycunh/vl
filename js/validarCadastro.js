// Checar campo de CPF
function checkCPF(){
  // pegando div de Erro
  let erro = $("#cpf").next();
  // validando
  if(validarCPF()){
    erro.slideUp(500)
  } else {
    erro.html("CPF Inválido")
    erro.slideDown(500)
  }
}

// Comparar senhas
function checkPW(){
  let pw = $("input[name='pw']")
  let confirmpw = $("input[name='confirm-pw']")
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

// Função de validação de CPF
function validarCPF(){
  // pegando o cpf
  let cpf = $("#cpf").val().replace(".", "").replace("-","").replace(".","")

  let sum = 0, rest = 0
	if (cpf == "00000000000") return false;

	for (i=1; i<=9; i++) sum = sum + parseInt(cpf.substring(i-1, i)) * (11 - i);
	rest = (sum * 10) % 11;

  if ((rest == 10) || (rest == 11))  rest = 0;
  if (rest != parseInt(cpf.substring(9, 10)) ) return false;

	sum = 0;
  for (i = 1; i <= 10; i++) sum = sum + parseInt(cpf.substring(i-1, i)) * (12 - i);
  rest = (sum * 10) % 11;

  if ((rest == 10) || (rest == 11))  rest = 0;
  if (rest != parseInt(cpf.substring(10, 11))) return false;
  return true;
}

// jQuery DOM
$(()=>{
  // Validação Geral
  $("input[type='submit']").on('click', e =>{
    if($("#cpf").val() != "" && !validarCPF() && !checkPW()) {
      e.preventDefault()
    }
  })
  // Máscaras de Form
  $("#cpf").mask('000.000.000-00')
  $("#cep").mask('00000-000')
  $("#telefone").mask('(00) 00000-0000')
})
