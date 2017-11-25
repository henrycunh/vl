
function aplicarEdital(numero){

  var data_ = {
    op: "sumario/criar",
    numero: numero
  }

  $.ajax({
    url: "api/edital.php",
    dataType: "json",
    type: "POST",
    data: data_,
    success: data => {
      console.log(data)
      location.reload(true)
      // Gerando log
      inserirLog({
        "atividade" : "Criação de Sumário",
        "dados"     : data_
      });
    },
    error: (e,x,s) => {
      console.log(s)
      console.log(e)
      console.log(x)
    }
  })
}
