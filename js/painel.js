function fileVerify(elem){
    $("#label").html("")
    file = $(elem)[0].files[0];
    if(file.size > 5000000)
    $("#label").html("O arquivo deve ter no máximo 5MB.")
    $("#filebtn").html('<i class="upload icon"></i>' + file.name)
}

function abrirModalCurr(){
  $("#enviarCurrModal").modal({
    observeChanges: true
  })
  $("#enviarCurrModal").modal('show')
}

function enviarArquivo(){
    if(file.size < 5000000){
      $("#label").html('Enviando...')
      $("#fileCurriculo").upload("processar_curriculo.php", success => {
          console.log(success)
          let d = success
          let relatorio = `
            <h3 class='ui header'>Foram processados e armazenados:</h3>
            <table class='ui table'>
              <tr>
              <td><b>${d.artigos.length}</b></td>
              <td>Artigos</td>
              </tr>
              <tr>
              <td><b>${d.bancas.length}</b></td>
              <td>Bancas</td>
              </tr>
              <tr>
              <td><b>${d.capLivros.length}</b></td>
              <td>Capítulos de Livro</td>
              </tr>
              <tr>
              <td><b>${d.coordProjs.length}</b></td>
              <td>Coordenação de Projetos</td>
              </tr>
              <tr>
              <td><b>${d.corposEditoriais.length}</b></td>
              <td>Participações em Corpo Editorial</td>
              </tr>
              <tr>
              <td><b>${d.livros.length}</b></td>
              <td>Livros</td>
              </tr>
              <tr>
              <td><b>${d.marcas.length}</b></td>
              <td>Marcas</td>
              </tr>
              <tr>
              <td><b>${d.organizacaoEventos.length}</b></td>
              <td>Organização de Eventos</td>
              </tr>
              <tr>
              <td><b>${d.orientacoes.length}</b></td>
              <td>Orientações</td>
              </tr>
              <tr>
              <td><b>${d.patentes.length}</b></td>
              <td>Patentes</td>
              </tr>
              <tr>
              <td><b>${d.softwares.length}</b></td>
              <td>Softwares</td>
              </tr>
              <tr>
              <td><b>${d.titulacoes.length}</b></td>
              <td>Titulações</td>
              </tr>
              <tr>
              <td><b>${d.trabEventos.length}</b></td>
              <td>Trabalhos em Eventos</td>
              </tr>
            </table>
          `
          $("#modalIn").html(relatorio)
          // Gerando logs
          inserirLog({
            "atividade" : "Enviando currículo",
            "dados"     : {}
          });
        setTimeout(()=>{
          window.location.replace('painel.php')
        }, 4000)

      }, progress=>{
        $("#progress").progress('set percent',(progress.loaded / progress.total) * 100)
        if((progress.loaded / progress.total) * 100 == 100)
          $("#label").html("Processando...")
      })
    }
}


$(()=>{
  // Ao clicar, destruir sessão e redirecionar para o Índice
  $("#desconectar").click(e=>{
    $(this).html(`<span class='glyphicon glyphicon-log-out icon'></span> Saindo...`)

    $("#progress").progress()

    $.ajax({
      url: "api/usuario.php",
      method: 'POST',
      dataType: 'json',
      data: {op:'usuario/desconectar'},
      success: data => {
        // Gerando log
        inserirLog({
          "atividade" : "Desconexão",
          "dados"     : {}
        });
        window.location.replace('index.php')
      }
    })

    e.preventDefault()
  })



  // Ao clicar, abrir popup para upload de currículo
  $("#enviarcurriculo").click(()=>{
      /* Envia o arquivo para ser efetuado o Parsing */

    })

    $("#closeModal").click(()=>{
      $("#curriculoModal").fadeOut(500)
    })

  $("#deletarcurriculo").click(e=>{
    e.preventDefault()
    $.ajax({
      type: "POST",
      dataType: "text",
      url: 'api/curriculo.php',
      data: {op:'curriculo/deletar'},
      success: data => {
        // Gerando log
        inserirLog({
          "atividade" : "Deleção de currículo",
          "dados"     : {}
        });
        console.log(data)
        window.location.replace('painel.php')
      },
      error: (e,x,s) => {
        console.log(s)
        console.log(e)
        console.log(x)

      }
    })

  })
})
