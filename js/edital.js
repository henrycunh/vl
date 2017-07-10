
function aplicarEdital(numero){

  var data = {
    op: "sumario/criar",
    numero: numero
  }

  $.ajax({
    url: "api/edital.php",
    dataType: "json",
    type: "POST",
    data: data,
    success: data => {
      console.log(data)
      location.reload(true)
    },
    error: (e,x,s) => {
      console.log(s)
      console.log(e)
      console.log(x)
    }
  })
}
