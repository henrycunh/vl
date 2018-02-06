/**
 * Salva as regras no DB
 *
 * @param {*} idEdital ID do Edital
 */
function salvarArtigo(idEdital){
    const estado = $(`#artigo-ano-opt`).checkbox("is checked") // Estado da condição
    const ano = (estado ? $(`#artigo-ano`).val() : false) // Valor da condição
    const extrato = $("#extrato-range").attr('value');
    const lim = $(`#artigo-lim-opt`).checkbox("is checked")
  
    // Objeto de regra
    let regra = {
      ic: 'artigo',
      ptInd: $(`#artigo-pi`).val(),
      ptMax: !lim ? $(`#artigo-pm`).val() : -1,
      content: JSON.stringify({
        ano: ano,
        lim: lim,
        extrato: extrato
      }),
      idEdital: idEdital
    }
  
    // Insere a regra no DB
    insertRegra(regra, data => {
      regra.idRegra = data.id
      regra.content = JSON.parse(regra.content)
      regras.push(regra)
      $(`#artigo`).removeClass("loading")
    }, ()=>{
      $(`#artigo`).addClass("loading")
    })
  
    // Formata o documento
    formatIC('artigo')
  
    // Esconde o container
    endRegra('artigo')
  }
  
  /**
   * Formata os dados do IC na tabela
   *
   * @param {*} ic Nome do IC
   */
  function formatArtigo(){
    // Objeto contendo as descrições para todos os ICs
    const desc = options
  
    // Acha regras existentes do IC
    const regrasIC = regras.achar(item => { return (item.ic == 'artigo' ? item : false) })
    // Checa se existem regras
    if(regrasIC.length > 0){
      const regra = regrasIC[0]
      // Label da linha
      var anoLabel = (regra.content.ano != false ? `${desc['artigo']} a partir de ${regra.content.ano}` : `${desc['artigo']} de todos os anos`)
      // Markup da linha
      var markup =
      `<tr ic='artigo'>
        <td>
          <div class='ui header center aligned'>
          ${desc['artigo']}
          <div class='ui sub header'>
            ${anoLabel}<br>
            ${regra.content.extrato ? "Extrato a partir de " + regra.content.extrato + "." : ""}
          </div>
          </div>
        </td>
        <td>${regra.ptInd}</td>
        <td>${regra.ptMax == -1 ? "<i style='color: #BBB'>S.L</i>": regra.ptMax }</td>
        <td class='ui center aligned'>
          <button onclick='deleteIC(${regra.idRegra}, "artigo")' class='ui button circular icon negative'>
            <i class='remove icon'></i>
          </button>
        </td>
      </tr>`
      // Limpa a tabela
      clearIC('artigo')
      // Adiciona o Markup à tabela
      tB.append(markup)
      // Remove a regra da lista
      removeIC('artigo')
      // Atualiza a tabela
      tableRefresh()
    }
  }
  
  function adjustRange(e){
    var extrato_list = [
      "a1", "a2", "b1", "b2", "b3", "b4", "b5", "c"
    ];
    
    var button  = $(e.target);
    var extrato = button.attr('extrato');
    var index   = extrato_list.indexOf(extrato); 
    $("button").removeClass('primary');
    while( index >= 0 ) $(`button[extrato="${ extrato_list[ index-- ] }"]`).addClass("primary");
    $("#extrato-range").attr("value", extrato);
  }
  