function salvarAlteracoes(oldNum){
  let num = $("#numEdital").val()
  let nome = $("#nomeEdital").val()
  let vigencia = $("#vigenciaEdital").val()
  let descricao = $().CKEDITORval('descricaoEdital')
  let pontMax = $("#pontMaxEdital").val()

  let data_ = {
    op: 'edital/alterar',
    num: num,
    nome: nome,
    vigencia: vigencia,
    descricao: descricao,
    pontMax: pontMax,
    oldNum: oldNum
  }

  $.ajax({
    url: 'api/edital.php',
    dataType: 'JSON',
    type: 'POST',
    data: data_,
    error: (e,x,s) => {
      console.log(s)
      console.log(e)
      console.log(x)
    },
    beforeSend: () => {
      $("#saveBtn").addClass("loading")
    },
    success: data => {
        if(data.success){
          $("#saveBtn").removeClass("loading")
          $("#saveBtn").parent().after(`<div id='saveMsg' class='ui message center aligned positive'>Salvo com sucesso.</div>`)
          setTimeout(()=>{
            $("#saveMsg").remove()
          },2000)
          // Gerando Log
          inserirLog({
            "atividade": "Alteração de Edital",
            "dados"    : data_
          });
          if(data.num != oldNum)
            window.location.replace("editar_edital.php?num=" + data.num)
        }
    }
  })
}

function abrirModal(){
  $("#enviarPDFModal").modal("show")
}

function fileVerify(elem){
    $("#label").html("")
    file = $(elem)[0].files[0];
    if(file.size > 7000000)
    $("#label").html("O arquivo deve ter no máximo 7MB.")
    $("#filebtn").html('<i class="upload icon"></i>' + file.name)
}

function enviarArquivo(elem){
  const num = $(elem).attr('num')
    if(file.size < 7000000){
      $("#label").html('Enviando...')
      filenameSession(num, data => { console.log(data) })
      $("#filePDF").upload("processar_edital.php", success=>{
          console.log(success)
          let html = $("#modalIn").html()
          let d = success
          let msg = `
            <div class='ui message positive'>Arquivo enviado com sucesso!</div>
          `
          $("#modalIn").html(msg)

        setTimeout(()=>{
          $("#enviarPDFModal").modal("hide")
          $("#modalIn").html(html)
        }, 4000)
        $("#pdflink").attr("href", num.replace("/", "__"))
        // Gerando log
        inserirLog({
          "atividade" : "Enviando arquivo de edital",
          "dados"     : {
                            "filename": num
                        }
        });

      }, progress=>{
        $("#progress").progress('set percent',(progress.loaded / progress.total) * 100)
        if((progress.loaded / progress.total) * 100 == 100)
          $("#label").html("Processando...")
      })
    }
}

function importarRegras(numero){
  const editalNum = $("#importarEdital").val()
  var data_ = {
    op: "edital/importar",
    numero_ref: editalNum,
    numero_atual: numero
  }
  console.log(data_)
  $.ajax({
    url       : "api/edital.php",
    type      : "POST",
    dataType  : "JSON",
    data      : data_,
    error     : (e,x,s) =>
    {
      console.log(s)
      console.log(e)
      console.log(x)
    },
    success: data =>
    {
      // Gerando log
      inserirLog({
        "atividade" : "Importando regras",
        "dados"     : data_
      });
      // Exibindo e recarregando a página
      $("#importMessage").text("Regras importadas com sucesso!")
      $("#importMessage").show(200)
      setTimeout(()=>{
        location.reload()
      }, 1500)
    }
  })
}

jQuery.fn.CKEDITORval = function( element_id ){
  return CKEDITOR.instances[element_id].getData();
}

$(()=>{
  $(".ui.dropdown").dropdown()

})
