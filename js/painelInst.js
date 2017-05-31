function criarEdital(){
  let num = $("#numEdital").val()
  let nome = $("#nomeEdital").val()
  let vig = $("#vigEdital").val()

  let data_ = {
    op: 'edital/criar',
    num: num,
    nome: nome,
    vig: vig
  }

  // Fazendo um request POST
  $.ajax({
    url: 'api/edital.php',
    dataType: 'JSON',
    type: 'POST',
    data: data_,
    beforeSend: () => {
      $("#criarEditalBtn").addClass("loading")
    },
    error: (e,x,s) => {
      console.log(s)
      console.log(e)
      console.log(x)
    },
    success: data => {
      $("#criarEditalBtn").removeClass("loading")
      if(data.success){
        let row = `
          <tr>
            <td>${data_.num}</td>
            <td>${data_.nome}</td>
            <td>${formattedDate(new Date(data_.vig))}</td>
          </tr>
        `
        let msg = `
          <div id='editalCriarMsg' class='ui message positive'>Tabela adicionada com sucesso!</div>
        `
        $("#editaisTable").append(row)
        $("#editaisTable").parent().prepend(msg)
        setTimeout(()=>{
          $("#editalCriarMsg").remove()
        }, 3000)
      } else {
        console.log(data)
      }
    }
  })

}

function formattedDate(d = new Date) {
  let month = String(d.getMonth() + 1);
  let day = String(d.getDate());
  const year = String(d.getFullYear());

  if (month.length < 2) month = '0' + month;
  if (day.length < 2) day = '0' + day;

  return `${month}/${day}/${year}`;
}
