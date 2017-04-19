// Retorna usuário dentro do callback através do email
function getUsuarioByEmail(email, callback, before){
  $.ajax({
    url:'api/usuario.php',
    method: 'post',
    dataType: 'json',
    data: {op: 'usuario/email', email: email},
    beforeSend: before,
    error: (e,x,s) => {
      console.log(s)
      console.log(e)
      console.log(x)
    },
    success: data => {
      callback(data)
    }
  })
}

// Retorna usuário dentro do callback através do cpf
function getUsuarioByCpf(cpf, callback, before){
  $.ajax({
    url:'api/usuario.php',
    method: 'post',
    dataType: 'json',
    data: {op: 'usuario/cpf', cpf: cpf},
    beforeSend: before,
    error: (e,x,s) => {
      console.log(s)
      console.log(e)
      console.log(x)
    },
    success: data => {
      callback(data)
    }
  })
}

// Atualiza o usuário
function updateUsuario(email, user, callback, before){
  $.ajax({
    url:'api/usuario.php',
    method: 'post',
    dataType: 'json',
    data: {op: 'usuario/atualizar', user: user, email:email},
    beforeSend: before,
    error: (e,x,s) => {
      console.log(s)
      console.log(e)
      console.log(x)
    },
    success: data => {
      callback(data)
    }
  })
}

// Mudar senha
function changePassword(email, pw, callback, before){
  $.ajax({
    url:'api/usuario.php',
    method: 'post',
    dataType: 'json',
    data: {op: 'usuario/mudarsenha', email: email, pw: pw},
    beforeSend: before,
    error: (e,x,s) => {
      console.log(s)
      console.log(e)
      console.log(x)
    },
    success: data => {
      callback(data)
    }
  })
}
