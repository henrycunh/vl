function filenameSession(num, callback){
  $.ajax({
    url: 'api/edital.php',
    dataType: 'JSON',
    type: 'POST',
    data: {op: 'edital/pdf/session', num: num},
    error: (e,x,s)=>{
      console.log(s)
      console.log(e)
      console.log(x)
    },
    success: callback()
  })
}

function insertRegra(regra, callback, bs){
  $.ajax({
    url: 'api/edital.php',
    dataType: 'JSON',
    type: 'POST',
    data: {
      op: 'edital/regras/criar',
      ic: regra.ic,
      ptInd: regra.ptInd,
      ptMax: regra.ptMax,
      content: regra.content,
      idEdital: regra.idEdital
    },
    error: (e,x,s)=>{
      console.log(s)
      console.log(e)
      console.log(x)
    },
    beforeSend: bs(),
    success: data => {
      callback(data)
    }
  })
}

function getRegras(idEdital, callback){
  $.ajax({
    url: 'api/edital.php',
    dataType: 'JSON',
    type: 'POST',
    data: {op: 'edital/regras', idEdital: idEdital},
    error: (e,x,s)=>{
      console.log(s)
      console.log(e)
      console.log(x)
    },
    success: data => {
      callback(data)
    }
  })
}

function removerRegra(idRegra, callback){
  $.ajax({
    url: 'api/edital.php',
    dataType: 'JSON',
    type: 'POST',
    data: {op: 'edital/regras/deletar', idRegra: idRegra},
    error: (e,x,s)=>{
      console.log(s)
      console.log(e)
      console.log(x)
    },
    success: data => {
      callback(data)
    }
  })
}
