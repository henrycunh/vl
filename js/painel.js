$(()=>{
  // Ao clicar, destruir sessão e redirecionar para o Índice
  $("#desconectar").click(e=>{
    $(this).html(`<span class='glyphicon glyphicon-log-out icon'></span> Saindo...`)

    $.ajax({
      url: "api/usuario.php",
      method: 'POST',
      dataType: 'json',
      data: {op:'usuario/desconectar'},
      success: data => {
        window.location.replace('index.php')
      }
    })

    e.preventDefault()
  })

  // Ao clicar, abrir popup para upload de currículo
  $("#enviarcurriculo").click(e=>{
    e.preventDefault()
    if(!$("#curriculoModal").length){
      let modalHtml =`
        <div id='curriculoModal' class='modalOuter'>
          <div class='modalInner'>
            <div class="modal">
            <button id='closeModal'><i class="typcn typcn-times"></i></button>
            <label id='label' for="fileCurriculo"><i class="typcn typcn-upload"></i> Escolha um arquivo...</label>
            <input type='file' id='fileCurriculo' accept="text/pdf" name='curriculo'>
            <button id='curriculoSubmit'>Enviar</button>
            <progress id='progress' value='0' min='0' max='100'></progress>
            <div class='modalMsg'></div>
            </div>
          </div>
        </div>`

      $(modalHtml).appendTo("body").fadeIn(500)
      var file = '';
      $("#fileCurriculo").on('change', e=>{
        $(".modalMsg").html("")
        file = $("#fileCurriculo")[0].files[0];
        if(file.size > 1000000)
        $(".modalMsg").html("O arquivo deve ter no máximo 5MB.")
        $("#label").html(file.name)
      })

      /* Envia o arquivo para ser efetuado o Parsing */
      $("#curriculoSubmit").click(()=>{
        if(file.size < 5000000){
          $(".modalMsg").html('Enviando...')
          $("#fileCurriculo").upload("processar_curriculo.php", success=>{
              console.log(success)
              let d = success.novo
              $(".modal").animate({"height":"400px", "background" : "rgba(241, 241, 241, 0.81)"}, 1000)
              let relatorio = `
                <h1>Foram processados e armazenados:</h1>
                <table>
                  <tr>
                  <td>${d.artigos.length}</td>
                  <td>Artigos</td>
                  </tr>
                  <tr>
                  <td>${d.bancas.length}</td>
                  <td>Bancas</td>
                  </tr>
                  <tr>
                  <td>${d.capLivros.length}</td>
                  <td>Capítulos de Livro</td>
                  </tr>
                  <tr>
                  <td>${d.coordProjs.length}</td>
                  <td>Coordenação de Projetos</td>
                  </tr>
                  <tr>
                  <td>${d.corposEditoriais.length}</td>
                  <td>Participações em Corpo Editorial</td>
                  </tr>
                  <tr>
                  <td>${d.livros.length}</td>
                  <td>Livros</td>
                  </tr>
                  <tr>
                  <td>${d.marcas.length}</td>
                  <td>Marcas</td>
                  </tr>
                  <tr>
                  <td>${d.organizacaoEventos.length}</td>
                  <td>Organização de Eventos</td>
                  </tr>
                  <tr>
                  <td>${d.orientacoes.length}</td>
                  <td>Orientações</td>
                  </tr>
                  <tr>
                  <td>${d.patentes.length}</td>
                  <td>Patentes</td>
                  </tr>
                  <tr>
                  <td>${d.softwares.length}</td>
                  <td>Softwares</td>
                  </tr>
                  <tr>
                  <td>1</td>
                  <td>Titulação</td>
                  </tr>
                  <tr>
                  <td>${d.trabEventos.length}</td>
                  <td>Trabalhos em Eventos</td>
                  </tr>
                </table>
              `
              $(".modal").html(relatorio)
            setTimeout(()=>{
              window.location.replace('painel.php')
            }, 4000)
          }, progress=>{
            $("#progress").val((progress.loaded / progress.total) * 100)
            if((progress.loaded / progress.total) * 100 == 100)
              $(".modalMsg").html("Processando...")
          })
        }
      })


    } else {
      $("#curriculoModal").fadeIn(500)
    }
    $("#closeModal").click(()=>{
      $("#curriculoModal").fadeOut(500)
    })
  })
})
