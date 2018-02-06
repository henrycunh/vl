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
        // Gerando log
        inserirLog({
          "atividade" : "Criação de Edital",
          "dados"     : data_
        });
        let row = `
          <tr>
            <td><a href="editar_edital.php?num=${data_.num}">
              <i class='edit icon'></i>
              ${data_.num}</td>
            </a></td>
            <td>${data_.nome}</td>
            <td>${formattedDate(new Date(data_.vig))}</td>
            <td>-</td>
            <td><a href="#" onclick="excluirEdital(${data_.idEdital})" class="ui button negative">Excluir</a></td>
          </tr>
        `
        let msg = `
          <div id='editalCriarMsg' class='ui message positive'>Tabela adicionada com sucesso!</div>
        `
        $("#editaisTable").append(row)
        $("#editaisTable").parent().prepend(msg)
        setTimeout(()=>{
          $("#editalCriarMsg").remove()
          location.reload();
        }, 1000)
      } else {
        console.log(data)
      }
    }
  })

}

function excluirEdital(idEdital){
  // Confire se é realmente desejado excluir o Edital
  const action = window.confirm("Você realmente deseja excluir esse Edital?");
  if(action){
    // Dados a serem enviados com o request
    const data_ = {
        op        : 'edital/excluir',
        idEdital  : idEdital
    };

    // AJAX Request
    $.ajax({
      url       : 'api/edital.php',
      type      : 'POST',
      dataType  : 'JSON',
      data      : data_,
      error     : ajaxError,
      success   : data => {
        console.log(data);
        location.reload();
      }
    });
  }
}

function vincularPesquisador(){
  var email = $("#emailVal").val()
  var data_ = {
    op    : "usuario/perfil",
    email : email,
    nivel : "validador"
  }

  $.ajax({
    url: "api/usuario",
    dataType: "JSON",
    type: "POST",
    data: data_,
    success: data => {
      function message(msg){
        $("#confirmMessage").text(msg)
        $("#confirmMessage").show(200)
        return setTimeout(() => {
          $("#confirmMessage").fadeOut(500)
          location.reload()
        }, 1000)
      }
      if(data.success){
        // Gerando log
        inserirLog({
          "atividade" : "Vinculação de validador",
          "dados"     : data_
        });
        message("Pesquisador vinculado com sucesso.")
      } else {
        message(`Erro:\n ${data.error}`)
      }

      $("#vincularValidador").modal("hide")
    },
    error: (e,x,s) => {
      console.log(s)
      console.log(e)
      console.log(x)
    }
  })
}

function desvincularValidador(email){
  var data_ = {
    op    : "usuario/desvincular",
    email : email
  }

  const bool = window.confirm("Tem certeza que deseja desvincular esse validador?")

  if(bool){
    $.ajax({
      url       : "api/usuario",
      dataType  : "JSON",
      type      : "POST",
      data      : data_,
      success   : data => {
        $(`tr[email='${email}']`).remove()
      },
      error     : (e,x,s) => {
        console.log(s)
        console.log(e)
        console.log(x)
      }
    })
  }


}

function showValModal(){
  $("#vincularValidador").modal("show")
}

function formattedDate(d = new Date) {
  let month = String(d.getMonth() + 1);
  let day = String(d.getDate());
  const year = String(d.getFullYear());

  if (month.length < 2) month = '0' + month;
  if (day.length < 2) day = '0' + day;

  return `${month}/${day}/${year}`;
}

function ajaxError(s, e, x){
  console.log(s);
  console.log(e);
  console.log(x);
}
