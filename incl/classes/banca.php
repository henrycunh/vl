<?php
  class Banca extends IC{
    // Atributos
    public $tipo;
    public $natureza;
    public $tipoBanca;
    public $titulo;
    public $ano;
    public $homepage;
    public $doi;
    public $nomeCandidato;
    public $nomeInstituicao;
    public $nomeCurso;
    public $idBanca;
    public $participantes;

    // Construtor vazio
    public function __construct(){
      parent::__construct();
      $this->tipo = '';
      $this->natureza = '';
      $this->tipoBanca = '';
      $this->titulo = '';
      $this->ano = '';
      $this->homepage = '';
      $this->doi = '';
      $this->nomeCandidato = '';
      $this->nomeInstituicao = '';
      $this->nomeCurso = '';
      $this->participantes = array();
      $this->idBanca = '';
    }

    // Função que retorna array com artigos a partir do DB
    public static function selectFromDB($conn, $curriculoId){
      $bancas = array();
      // Pegando do DB
      $bancasRaw = $conn->query("SELECT * FROM ic_banca WHERE curriculoId=$curriculoId ORDER BY ano DESC")->fetchAll(PDO::FETCH_ASSOC);
      // Iterando
      foreach ($bancasRaw as $banca) {
        $banca_ = new self();
        $banca_->setVal($banca);
        $banca_->tipo = $banca['tipo'];
        $banca_->natureza = $banca['natureza'];
        $banca_->tipoBanca = $banca['tipoBanca'];
        $banca_->titulo = $banca['titulo'];
        $banca_->ano = $banca['ano'];
        $banca_->homepage = $banca['homepage'];
        $banca_->doi = $banca['doi'];
        $banca_->nomeCandidato = $banca['nomeCandidato'];
        $banca_->nomeInstituicao = $banca['nomeInstituicao'];
        $banca_->nomeCurso = $banca['nomeCurso'];
        $banca_->participantes = json_decode($banca['participantes'], true);
        $banca_->idBanca = $banca['idBanca'];
        array_push($bancas, $banca_);
      }
      return $bancas;
    }

    // Função que retorna todas as bancas em um array a partir de um XML
    public static function getBancas($data){
      $bancas = array();
      // Checando se existem bancas de graduação
      $isBancaGrad = isset($data['DADOS-COMPLEMENTARES']['PARTICIPACAO-EM-BANCA-TRABALHOS-CONCLUSAO']['PARTICIPACAO-EM-BANCA-DE-GRADUACAO']);
      $isBancaEsp = isset($data['DADOS-COMPLEMENTARES']['PARTICIPACAO-EM-BANCA-TRABALHOS-CONCLUSAO']['PARTICIPACAO-EM-BANCA-DE-APERFEICOAMENTO-ESPECIALIZACAO']);
      $isBancaMes = isset($data['DADOS-COMPLEMENTARES']['PARTICIPACAO-EM-BANCA-TRABALHOS-CONCLUSAO']['PARTICIPACAO-EM-BANCA-DE-MESTRADO']);
      $isBancaDot = isset($data['DADOS-COMPLEMENTARES']['PARTICIPACAO-EM-BANCA-TRABALHOS-CONCLUSAO']['PARTICIPACAO-EM-BANCA-DE-DOUTORADO']);
      if($isBancaGrad){
        $bancasRaw = $data['DADOS-COMPLEMENTARES']['PARTICIPACAO-EM-BANCA-TRABALHOS-CONCLUSAO']['PARTICIPACAO-EM-BANCA-DE-GRADUACAO'];
        if(array_keys($bancasRaw)[0] === '@attributes') $bancasRaw = array($bancasRaw);
        foreach ($bancasRaw as $banca)
          array_push($bancas, getBanca($banca, 'GRADUACAO'));
      }
      // Checando se existem bancas de especialização
      if($isBancaEsp){
        $bancasRaw = $data['DADOS-COMPLEMENTARES']['PARTICIPACAO-EM-BANCA-TRABALHOS-CONCLUSAO']['PARTICIPACAO-EM-BANCA-DE-APERFEICOAMENTO-ESPECIALIZACAO'];
        if(array_keys($bancasRaw)[0] === '@attributes') $bancasRaw = array($bancasRaw);
        foreach ($bancasRaw as $banca)
          array_push($bancas, getBanca($banca, 'APERFEICOAMENTO-ESPECIALIZACAO'));
      }
      // Checando se existem bancas de mestrado
      if($isBancaMes){
        $bancasRaw = $data['DADOS-COMPLEMENTARES']['PARTICIPACAO-EM-BANCA-TRABALHOS-CONCLUSAO']['PARTICIPACAO-EM-BANCA-DE-MESTRADO'];
        if(array_keys($bancasRaw)[0] === '@attributes') $bancasRaw = array($bancasRaw);
        foreach ($bancasRaw as $banca)
          array_push($bancas, getBanca($banca, 'MESTRADO'));
      }
      // Checando se existem bancas de doutorado
      if($isBancaDot){
        $bancasRaw = $data['DADOS-COMPLEMENTARES']['PARTICIPACAO-EM-BANCA-TRABALHOS-CONCLUSAO']['PARTICIPACAO-EM-BANCA-DE-DOUTORADO'];
        if(array_keys($bancasRaw)[0] === '@attributes') $bancasRaw = array($bancasRaw);
        foreach ($bancasRaw as $banca)
          array_push($bancas, getBanca($banca, 'DOUTORADO'));
      }

      return $bancas;
    }

    public function insertIntoDB($conn, $curriculoId){
      $participantes = json_encode($this->participantes, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
      // Comando SQL
      $SQL =
        "INSERT INTO ic_banca(
          tipo, natureza, tipoBanca, titulo, ano, homepage, doi, nomeCandidato,
          nomeInstituicao, nomeCurso, participantes, curriculoId
        ) VALUES (
          :tipo, :natureza, :tipoBanca, :titulo,
          :ano, :homepage, :doi, :nomeCandidato,
          :nomeInstituicao, :nomeCurso,
          :participantes, :curriculoId
        )";
      // Criando statement
      $stmt = $conn->prepare($SQL);
      // Ligando parametros
      $stmt->bindParam(':tipo',$this->tipo);
      $stmt->bindParam(':natureza',$this->natureza);
      $stmt->bindParam(':tipoBanca',$this->tipoBanca);
      $stmt->bindParam(':titulo',$this->titulo);
      $stmt->bindParam(':ano',$this->ano);
      $stmt->bindParam(':homepage',$this->homepage);
      $stmt->bindParam(':doi',$this->doi);
      $stmt->bindParam(':nomeCandidato',$this->nomeCandidato);
      $stmt->bindParam(':nomeInstituicao',$this->nomeInstituicao);
      $stmt->bindParam(':nomeCurso',$this->nomeCurso);
      $stmt->bindParam(':participantes',$participantes);
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

  // Função para extrair dados de uma banca a partir de um array de bancas
  function getBanca($bancaRaw, $value){
      $banca = new Banca();
      $dadosB = attr($bancaRaw['DADOS-BASICOS-DA-PARTICIPACAO-EM-BANCA-DE-' . $value]);
      $details = attr($bancaRaw['DETALHAMENTO-DA-PARTICIPACAO-EM-BANCA-DE-' . $value]);
      $participantes = $bancaRaw['PARTICIPANTE-BANCA'];
      // DADOS BÁSICOS
      $tipos = array(
        'GRADUACAO' => 1,
        'APERFEICOAMENTO-ESPECIALIZACAO' => 2,
        'MESTRADO' => 3,
        'DOUTORADO' => 4
      );
      $banca->tipo = $tipos[$value];
      $banca->natureza = $dadosB['NATUREZA'];
      $banca->titulo = $dadosB['TITULO'];
      $banca->ano = $dadosB['ANO'];
      $banca->homepage = $dadosB['HOME-PAGE'];
      $banca->doi = $dadosB['DOI'];
      // DETALHAMENTO
      $banca->nomeCandidato = $details['NOME-DO-CANDIDATO'];
      $banca->nomeInstituicao = $details['NOME-INSTITUICAO'];
      $banca->nomeCurso = $details['NOME-CURSO'];
      // PARTICIPANTES
      $banca->participantes = getParticipantes($participantes);
      return $banca;
  }

  // Função para organizar o armazenamento dos participantes
  function getParticipantes($parts){
    $participantes = array();
    if(count($parts) <= 1)
      $parts = array($parts);
    foreach ($parts as $participante) {
      $participante = attr($participante);
      array_push($participantes, array(
        'nomeCompleto' => $participante['NOME-COMPLETO-DO-PARTICIPANTE-DA-BANCA'],
        'nomeCitacao' => $participante['NOME-PARA-CITACAO-DO-PARTICIPANTE-DA-BANCA'],
        'numIdCNPQ' => $participante['NRO-ID-CNPQ']
      ));
    }
    return $participantes;
  }


 ?>
