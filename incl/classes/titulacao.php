<?php
class Titulacao extends IC{
  // Atributos
  public $titulo;
  public $nomeCurso;
  public $instituicao;
  public $orientador;
  public $anoInicio;
  public $anoConclusao;
  public $tipo; // 1 - grad, 2 - esp, 3 - mest, 4 - dot, 5 - pos.doc
  public $idTitulacao;

  // Construtor vazio
  public function __construct(){
    parent::__construct();
    $this->titulo = "";
    $this->nomeCurso = "";
    $this->instituicao = "";
    $this->orientador = "";
    $this->anoInicio = "";
    $this->anoConclusao = "";
    $this->idTitulacao = "";
  }

  // Função que retorna array com artigos a partir do DB
  public static function selectFromDB($conn, $curriculoId){
    $titulacoes = array();
    // Pegando do DB
    $titulacaoRaw = $conn->query("SELECT * FROM ic_titulacao WHERE curriculoId=$curriculoId ORDER BY anoInicio DESC")->fetchAll(PDO::FETCH_ASSOC);

    // Iterando
    foreach ($titulacaoRaw as $titulacao) {
      $titulacao_ = new self();
      $titulacao_->setVal($titulacao);
      $titulacao_->titulo = $titulacao['titulo'];
      $titulacao_->nomeCurso = $titulacao['nomeCurso'];
      $titulacao_->instituicao = $titulacao['instituicao'];
      $titulacao_->orientador = $titulacao['orientador'];
      $titulacao_->anoInicio = $titulacao['anoInicio'];
      $titulacao_->anoConclusao = $titulacao['anoConclusao'];
      $titulacao_->tipo = $titulacao['tipo'];
      $titulacao_->idTitulacao = $titulacao['idTitulacao'];
      array_push($titulacoes, $titulacao_);
    }

    return $titulacoes;
  }

  // Pega a maior titulação a partir do XML
  public static function getTitulacoes($data){
    $titulacoes = array();
    $titulos = $data['DADOS-GERAIS']['FORMACAO-ACADEMICA-TITULACAO'];

    if(isset($titulos['GRADUACAO'])){
        $titulacaoRaw = $titulos['GRADUACAO'];
        if(array_keys($titulacaoRaw)[0] === '@attributes') $titulacaoRaw = array($titulacaoRaw);
        foreach ($titulacaoRaw as $titulacao) {
          $titulacao_ = new self();
          $titulacao = attr($titulacao);
          $titulacao_->titulo = $titulacao['TITULO-DO-TRABALHO-DE-CONCLUSAO-DE-CURSO'];
          $titulacao_->nomeCurso = $titulacao['NOME-CURSO'];
          $titulacao_->instituicao = $titulacao['NOME-INSTITUICAO'];
          $titulacao_->orientador = $titulacao['NOME-DO-ORIENTADOR'];
          $titulacao_->anoInicio = $titulacao['ANO-DE-INICIO'];
          $titulacao_->anoConclusao = $titulacao['ANO-DE-CONCLUSAO'];
          $titulacao_->tipo = 1;
          array_push($titulacoes, $titulacao_);
        }
    }
    if(isset($titulos['ESPECIALIZACAO'])){
        $titulacaoRaw = $titulos['ESPECIALIZACAO'];
        if(array_keys($titulacaoRaw)[0] === '@attributes') $titulacaoRaw = array($titulacaoRaw);
        foreach ($titulacaoRaw as $titulacao) {
          $titulacao_ = new self();
          $titulacao = attr($titulacao);
          $titulacao_->titulo = $titulacao['TITULO-DA-MONOGRAFIA'];
          $titulacao_->nomeCurso = $titulacao['NOME-CURSO'];
          $titulacao_->instituicao = $titulacao['NOME-INSTITUICAO'];
          $titulacao_->orientador = $titulacao['NOME-DO-ORIENTADOR'];
          $titulacao_->anoInicio = $titulacao['ANO-DE-INICIO'];
          $titulacao_->anoConclusao = $titulacao['ANO-DE-CONCLUSAO'];
          $titulacao_->tipo = 2;
          array_push($titulacoes, $titulacao_);
        }
    }
    if(isset($titulos['MESTRADO'])){
        $titulacaoRaw = $titulos['MESTRADO'];
        if(array_keys($titulacaoRaw)[0] === '@attributes') $titulacaoRaw = array($titulacaoRaw);
        foreach ($titulacaoRaw as $titulacao) {
          $titulacao_ = new self();
          $titulacao = attr($titulacao);
          $titulacao_->titulo = $titulacao['TITULO-DA-DISSERTACAO-TESE'];
          $titulacao_->nomeCurso = $titulacao['NOME-CURSO'];
          $titulacao_->instituicao = $titulacao['NOME-INSTITUICAO'];
          $titulacao_->orientador = $titulacao['NOME-COMPLETO-DO-ORIENTADOR'];
          $titulacao_->anoInicio = $titulacao['ANO-DE-INICIO'];
          $titulacao_->anoConclusao = $titulacao['ANO-DE-CONCLUSAO'];
          $titulacao_->tipo = 3;
          array_push($titulacoes, $titulacao_);
        }
    }
    if(isset($titulos['DOUTORADO'])){
        $titulacaoRaw = $titulos['DOUTORADO'];
        if(array_keys($titulacaoRaw)[0] === '@attributes') $titulacaoRaw = array($titulacaoRaw);
        foreach ($titulacaoRaw as $titulacao) {
          $titulacao_ = new self();
          $titulacao = attr($titulacao);
          $titulacao_->titulo = $titulacao['TITULO-DA-DISSERTACAO-TESE'];
          $titulacao_->nomeCurso = $titulacao['NOME-CURSO'];
          $titulacao_->instituicao = $titulacao['NOME-INSTITUICAO'];
          $titulacao_->orientador = $titulacao['NOME-COMPLETO-DO-ORIENTADOR'];
          $titulacao_->anoInicio = $titulacao['ANO-DE-INICIO'];
          $titulacao_->anoConclusao = $titulacao['ANO-DE-CONCLUSAO'];
          $titulacao_->tipo = 4;
          array_push($titulacoes, $titulacao_);
        }
    }
    return $titulacoes;
  }

  // Insere os dados no DB
  public function insertIntoDB($conn, $curriculoId){
    // Comando SQL
    $SQL =
      "INSERT INTO ic_titulacao (
        titulo, nomeCurso, instituicao, orientador, anoInicio, anoConclusao,
        tipo, curriculoId
      ) VALUES (
        :titulo, :nomeCurso, :instituicao, :orientador,
        :anoInicio, :anoConclusao, :tipo, :curriculoId
      )";
    // Criando statement
    $stmt = $conn->prepare($SQL);
    // Ligando parametros
    $stmt->bindParam(':titulo',$this->titulo);
    $stmt->bindParam(':nomeCurso',$this->nomeCurso);
    $stmt->bindParam(':instituicao',$this->instituicao);
    $stmt->bindParam(':orientador',$this->orientador);
    $stmt->bindParam(':anoInicio',$this->anoInicio);
    $stmt->bindParam(':anoConclusao',$this->anoConclusao);
    $stmt->bindParam(':tipo',$this->tipo);
    $stmt->bindParam(':curriculoId',$curriculoId);
    // Executando
    $query = $stmt->execute();
    // Checando por erros
    if($query){
      return true;
    } else {
      print_r($stmt->errorInfo());
      return false;
    }
  }
}
?>
