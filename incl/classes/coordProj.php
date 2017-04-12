<?php
    $nome = '';
  class CoordProjeto{
    /*Declaração de atributos*/
    //ATUACAO-PROFISSIONAL -> @attributes
    public $nomeInstituicao;
    //ATUACAO-PROFISSIONAL -> ATIVIDADES-DE-PARTICIPACAO-EM-PROJETO -> PARTICIPACAO-EM-PROJETO[0] -> @attributes
    public $anoInicio;
    public $anoFim;
    public $nomeProj;
    public $situacao; //Concluído ou não
    public $natureza;
    public $descricao;
    public $responsavel;
    //PARTICIPACAO-EM-PROJETO -> PROJETO-DE-PESQUISA -> EQUIPE-DO-PROJETO -> @attributes
    public $equipe;

    public function __construct(){
      $this->nomeInstituicao = '';
      $this->anoInicio = '';
      $this->anoFim = '';
      $this->nomeProj = '';
      $this->situacao = '';
      $this->natureza = '';
      $this->descricao = '';
      $this->responsavel = '';
      $this->equipe = array();
    }

    public static function getCoordProjs($data){
      $coordProjs = array();
      $nome = attr($data['DADOS-GERAIS'])['NOME-COMPLETO'];
      if(isset($data['DADOS-GERAIS']['ATUACOES-PROFISSIONAIS']['ATUACAO-PROFISSIONAL'])){
        $atuacaoProfs = $data['DADOS-GERAIS']['ATUACOES-PROFISSIONAIS']['ATUACAO-PROFISSIONAL'];

        if(array_keys($atuacaoProfs)[0] === "@attributes")
          $atuacaoProfs = array($atuacaoProfs);

        foreach ($atuacaoProfs as $atuacaoProf) {
          $coordProjs = array_merge($coordProjs, getProjetos($atuacaoProf, $nome));
        }
      }
      return $coordProjs;
    }

  }
  //Pegar projetos de pesquisa
  function getProjetos($atuacao, $nome){
    $projetos = array();
    $nomeInst = attr($atuacao)['NOME-INSTITUICAO'];
    //Verificação de existência
    if(isset($atuacao['ATIVIDADES-DE-PARTICIPACAO-EM-PROJETO']['PARTICIPACAO-EM-PROJETO'])){
      // Recebendo as participacoes
      $participacoes = $atuacao['ATIVIDADES-DE-PARTICIPACAO-EM-PROJETO']['PARTICIPACAO-EM-PROJETO'];
      // Vendo se existe apenas uma
      if(array_keys($participacoes)[0] === '@attributes')
        $participacoes = array($participacoes);
      // Iterando sobre elas
      foreach ($participacoes as $participacao) {
        if(isset($participacao['PROJETO-DE-PESQUISA'])):
          $projsPesquisa = $participacao['PROJETO-DE-PESQUISA'];
          //Verificação de quantidade
          if(array_keys($projsPesquisa)[0] === "@attributes")
          $projsPesquisa = array($projsPesquisa);
          //Percorrer projetos de pesquisa
          foreach ($projsPesquisa as $projPesquisa) {
              $coordProj_ = new CoordProjeto();
              $coordProj_->responsavel = isOrientador($projPesquisa['EQUIPE-DO-PROJETO']['INTEGRANTES-DO-PROJETO'], $nome);
              $coordProj_->nomeInstituicao = $nomeInst;
              $coordProj_->anoInicio = attr($projPesquisa)['ANO-INICIO'];
              $coordProj_->anoFim = attr($projPesquisa)['ANO-FIM'];
              $coordProj_->nomeProj = attr($projPesquisa)['NOME-DO-PROJETO'];
              $coordProj_->situacao = attr($projPesquisa)['SITUACAO'];
              $coordProj_->natureza = attr($projPesquisa)['NATUREZA'];
              $coordProj_->descricao = attr($projPesquisa)['DESCRICAO-DO-PROJETO'];
              $coordProj_->equipe = getEquipe($projPesquisa['EQUIPE-DO-PROJETO']['INTEGRANTES-DO-PROJETO']);

              array_push($projetos, $coordProj_);
          }
        endif;
      }
    }
    // var_dump($projetos);
      return $projetos;
  }

  function getEquipe($array){
    $autores = array();

    if(array_keys($array)[0] === '@attributes')
        $array = array($array);

    foreach ($array as $autor) {
      $autor = attr($autor);
      array_push($autores, array(
        'nomeCompleto' => $autor['NOME-COMPLETO'],
        'nomeCitacao' => $autor['NOME-PARA-CITACAO'],
        'numIdCNPQ' => $autor['NRO-ID-CNPQ']
      ));
    }

    return $autores;
  }

  //Verificação se é orientador
  function isOrientador($equipe, $nome){
    if(array_keys($equipe)[0] === "@attributes")
      $equipe = array($equipe);
    foreach ($equipe as $integrante) {
      if(attr($integrante)['NOME-COMPLETO'] == $nome && attr($integrante)['FLAG-RESPONSAVEL'] == "SIM"){
        return true;
      }
    }
    return false;
  }

  /*
  public $nomeCompleto;
  public $nomeCitacao;
  public $flagResp;*/
 ?>
