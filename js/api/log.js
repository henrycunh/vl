function inserirLog(atividade){
  $.ajax({
    url     : "api/log.php",
    data    : {
                op: "log/adicionar",
                atividade: atividade
              },
    dataType: "JSON",
    type    : "POST",
    success : data => {
                if(!data.success){
                  console.error(data.error);
                }
              },
    error   : (e,x,s) => {
                console.log(s);
                console.log(e);
                console.log(x);
              }
  });
}
