// Checar campo de CPF
function checkCPF(){
  // pegando div de Erro
  let erro = $("#cpf-erro");
  // validando
  if(validarCPF()){
    getUsuarioByCpf($("#cpf").val(), user => {
      if(user){
        erro.html("Já existe um usuário com esse CPF.")
        erro.removeClass('hidden')
        return false;
      } else {
        erro.addClass('hidden')
        return true;
      }
    }, ()=>{
      erro.html("Verificando CPF...")
      erro.removeClass('hidden')
    })
    return true;
  } else {
    erro.html("CPF Inválido")
    erro.removeClass('hidden')
    return false;
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
