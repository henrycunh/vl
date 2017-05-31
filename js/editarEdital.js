function salvarAlteracoes(oldNum){
  let num = $("#numEdital").val()
  let nome = $("#nomeEdital").val()
  let vigencia = $("#vigenciaEdital").val()
  let descricao = $().CKEDITORval('descricaoEdital')

  let data_ = {
    op: 'edital/alterar',
    num: num,
    nome: nome,
    vigencia: vigencia,
    descricao: descricao,
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
          setTimeout(()=>{$("#saveMsg").remove()},2000)
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


      }, progress=>{
        $("#progress").progress('set percent',(progress.loaded / progress.total) * 100)
        if((progress.loaded / progress.total) * 100 == 100)
          $("#label").html("Processando...")
      })
    }
}

jQuery.fn.CKEDITORval = function( element_id ){
  return CKEDITOR.instances[element_id].getData();
}

$(()=>{
  $(".ui.dropdown").dropdown()

})
