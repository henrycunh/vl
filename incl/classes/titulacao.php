<?php
class Titulacao extends IC{
  // Atributos
  public $titulo;
  public $nomeCurso;
  public $instituicao;
  public $orientador;
  public $anoInicio;
  public $anoConclusao;
  public $tipo; // 1 - esp, 2 - mest, 3 - doutorado, 4 - graduacao

  // Construtor vazio
  public function __construct(){
    parent::__construct();
    $this->titulo = "";
    $this->nomeCurso = "";
    $this->instituicao = "";
    $this->orientador = "";
    $this->anoInicio = "";
    $this->anoConclusao = "";
  }

  // Pega a maior titulação a partir do XML
  public static function getTitulacao($data){
    $titulacao = new self();

    $titulos = $data['DADOS-GERAIS']['FORMACAO-ACADEMICA-TITULACAO'];
    $titulo;

    // Pegando a maior titulação

    if(isset($titulos['DOUTORADO'])){
       $titulacao->tipo = 1;
       $titulo = $titulos['DOUTORADO'];
     }
    else if(isset($titulos['MESTRADO'])) {
      $titulacao->tipo = 2;
      $titulo = $titulos['MESTRADO'];
    }
    else if(isset($titulos['ESPECIALIZACAO'])){
      $titulacao->tipo = 3;
      $titulo = $titulos['ESPECIALIZACAO'];
    } else if(isset($titulos['GRADUACAO'])){
      $titulacao->tipo = 4;
      $titulo = $titulos['GRADUACAO'];
    }

    // Processando cada titulação
    if($titulacao->tipo == 1){
      // Doutorado
      // Pegar o doutorado mais recente, se houver mais de um
      if(count($titulo) > 1 && array_keys($titulo)[1] != "PALAVRAS-CHAVE")
      $titulo = pegarMaisRecente($titulo, 'ANO-DE-CONCLUSAO');
      $titulo = attr($titulo);
      $titulacao->titulo = $titulo['TITULO-DA-DISSERTACAO-TESE'];
      $titulacao->nomeCurso = $titulo['NOME-CURSO'];
      $titulacao->instituicao = $titulo['NOME-INSTITUICAO'];
      $titulacao->orientador = $titulo['NOME-COMPLETO-DO-ORIENTADOR'];
      $titulacao->anoInicio = $titulo['ANO-DE-INICIO'];
      $titulacao->anoConclusao = $titulo['ANO-DE-CONCLUSAO'];
    } else if ($titulacao->tipo == 2){
      // Mestrado
      // Pegar o mestrado mais recente, se houver mais de um
      if(count($titulo) > 1 && array_keys($titulo)[1] != "PALAVRAS-CHAVE")
      $titulo = pegarMaisRecente($titulo, 'ANO-DE-CONCLUSAO');
      $titulo = attr($titulo);
      $titulacao->titulo = $titulo['TITULO-DA-DISSERTACAO-TESE'];
      $titulacao->nomeCurso = $titulo['NOME-CURSO'];
      $titulacao->instituicao = $titulo['NOME-INSTITUICAO'];
      $titulacao->orientador = $titulo['NOME-COMPLETO-DO-ORIENTADOR'];
      $titulacao->anoInicio = $titulo['ANO-DE-INICIO'];
      $titulacao->anoConclusao = $titulo['ANO-DE-CONCLUSAO'];
    } else if ($titulacao->tipo == 3){
      // Especialização
      // Pegar a especialização mais recente, se houver mais de um
      if(count($titulo) > 1 && array_keys($titulo)[1] != "PALAVRAS-CHAVE")
      $titulo = pegarMaisRecente($titulo, 'ANO-DE-CONCLUSAO');
      $titulo = attr($titulo);
      $titulacao->titulo = $titulo['TITULO-DA-MONOGRAFIA'];
      $titulacao->nomeCurso = $titulo['NOME-CURSO'];
      $titulacao->instituicao = $titulo['NOME-INSTITUICAO'];
      $titulacao->orientador = $titulo['NOME-DO-ORIENTADOR'];
      $titulacao->anoInicio = $titulo['ANO-DE-INICIO'];
      $titulacao->anoConclusao = $titulo['ANO-DE-CONCLUSAO'];
    } else if ($titulacao->tipo == 4){
      // Graduação
      // Pegar a graduação mais recente, se houver mais de um
      if(count($titulo) > 1 && array_keys($titulo)[1] != "PALAVRAS-CHAVE")
      $titulo = pegarMaisRecente($titulo, 'ANO-DE-CONCLUSAO');
      $titulo = attr($titulo);
      $titulacao->titulo = $titulo['TITULO-DO-TRABALHO-DE-CONCLUSAO-DE-CURSO'];
      $titulacao->nomeCurso = $titulo['NOME-CURSO'];
      $titulacao->instituicao = $titulo['NOME-INSTITUICAO'];
      $titulacao->orientador = $titulo['NOME-DO-ORIENTADOR'];
      $titulacao->anoInicio = $titulo['ANO-DE-INICIO'];
      $titulacao->anoConclusao = $titulo['ANO-DE-CONCLUSAO'];
    }
    return $titulacao;
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
