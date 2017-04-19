function filenameSession(filename, before, success){
  $.ajax({
    url: 'api/curriculo.php',
    type: 'POST',
    dataType: 'JSON',
    data: {op: 'curriculo/comprovante', filename: filename},
    beforeSend: before,
    success: success,
    error: (e,x,s)=>{
      console.log(s)
      console.log(e)
      console.log(x)
    }
  })
}
