function updateValidity(data, callback, beforeSend){
  data.op = 'curriculo/ic/validar'
  $.ajax({
    url: 'api/curriculo.php',
    dataType: 'json',
    type: 'POST',
    data: data,
    beforeSend: beforeSend,
    success: data => {callback(data)},
    error: (e,x,s) => {
      console.log(s)
      console.log(e)
      console.log(x)
    }
  })
}
