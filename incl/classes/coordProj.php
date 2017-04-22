<?php
    $nome = '';
  class CoordProjeto extends IC{
    // Atributos
    public $nomeInstituicao;
    public $anoInicio;
    public $anoFim;
    public $nomeProj;
    public $situacao;
    public $natureza;
    public $descricao;
    public $responsavel;
    public $equipe;
    public $idCoordProj;

    // Construtor vazio
    public function __construct(){
      parent::__construct();
      $this->nomeInstituicao = '';
      $this->anoInicio = '';
      $this->anoFim = '';
      $this->nomeProj = '';
      $this->situacao = '';
      $this->natureza = '';
      $this->descricao = '';
      $this->responsavel = '';
      $this->equipe = array();
      $this->idCoordProj = '';
    }

    // Função para retornar todas as coordenação de projetos
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

    // Função que retorna array com artigos a partir do DB
    public static function selectFromDB($conn, $curriculoId){
      $coordProjs = array();
      // Pegando do DB
      $coordProjsRaw = $conn->query("SELECT * FROM ic_coordProj WHERE curriculoId=$curriculoId ORDER BY anoInicio DESC")->fetchAll(PDO::FETCH_ASSOC);
      // Iterando
      foreach ($coordProjsRaw as $coordProj) {
        $coordProj_ = new self();
        $coordProj_->setVal($coordProj);
        $coordProj_->nomeInstituicao = $coordProj['nomeInstituicao'];
        $coordProj_->anoInicio = $coordProj['anoInicio'];
        $coordProj_->anoFim = $coordProj['anoFim'];
        $coordProj_->nomeProj = $coordProj['nomeProj'];
        $coordProj_->situacao = $coordProj['situacao'];
        $coordProj_->natureza = $coordProj['natureza'];
        $coordProj_->descricao = $coordProj['descricao'];
        $coordProj_->responsavel = $coordProj['responsavel'];
        $coordProj_->equipe = json_decode($coordProj['equipe'], true);
        $coordProj_->idCoordProj = $coordProj['idCoordProj'];
        array_push($coordProjs, $coordProj_);
      }
      return $coordProjs;
    }

    // Função para inserir os dados no DB
    public function insertIntoDB($conn, $curriculoId){
      // Typecasting Boolean para Int
      $resp = (int) $this->responsavel;
      // Fazendo encoding do array para uma string JSON
      $equipe = json_encode($this->equipe, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
      // Comando SQL
      $SQL =
        "INSERT INTO ic_coordProj(
          nomeInstituicao, anoInicio, anoFim, nomeProj, situacao, natureza,
          descricao, responsavel, equipe, curriculoId
        ) VALUES (
          :nomeInstituicao, :anoInicio, :anoFim,
          :nomeProj, :situacao, :natureza, :descricao,
          :responsavel, :equipe, :curriculoId
        )";
      // Criando statement
      $stmt = $conn->prepare($SQL);
      // Ligando parametros
      $stmt->bindParam(':nomeInstituicao',$this->nomeInstituicao);
      $stmt->bindParam(':anoInicio',$this->anoInicio);
      $stmt->bindParam(':anoFim',$this->anoFim);
      $stmt->bindParam(':nomeProj',$this->nomeProj);
      $stmt->bindParam(':situacao',$this->situacao);
      $stmt->bindParam(':natureza',$this->natureza);
      $stmt->bindParam(':descricao',$this->descricao);
      $stmt->bindParam(':responsavel',$resp);
      $stmt->bindParam(':equipe',$equipe);
      $stmt->bindParam(':curriculoId',$curriculoId);
      // Executando
      $query = $stmt->execute();
      // Checando erros
      if($query){
        return true;
      } else {
        print_r($stmt->errorInfo());
        return false;
      }
    }

  }

  // Pega projetos de pesquisa
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

  // Organiza o armazenamento da equipe
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


 ?>
