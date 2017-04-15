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
  $("#enviarcurriculo").click(()=>{
    if(!$("#curriculoModal").length){
      let modalHtml =`
        <div id='curriculoModal' class='modalOuter'>
          <div class='modalInner'>
            <div class="modal">
            <button id='closeModal'><i class="typcn typcn-times"></i></button>
            <label id='label' for="fileCurriculo"><i class="typcn typcn-upload"></i> Escolha um arquivo...</label>
            <input type='file' id='fileCurriculo' name='curriculo'>
            <button id='curriculoSubmit'>Enviar</button>
            <progress id='progress' value='0' min='0' max='100'></progress>
            <div class='modalMsg'></div>
            </div>
          </div>
        </div>`

      $(modalHtml).appendTo("body").fadeIn(500)

      $("#fileCurriculo").on('change', e=>{
        let file = $("#fileCurriculo")[0].files[0];
        $("#label").html(file.name)
      })

      /* Envia o arquivo para ser efetuado o Parsing */
      $("#curriculoSubmit").click(()=>{
        $("#fileCurriculo").upload("processar_curriculo.php", success=>{
          console.log(success)
        },$("#progress"))
      })

    } else {
      $("#curriculoModal").fadeIn(500)
    }
    $("#closeModal").click(()=>{
      $("#curriculoModal").fadeOut(500)
    })
  })
})
