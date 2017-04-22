<?php
  class Software extends IC{
    // Atributo
    public $natureza;
    public $titulo;
    public $ano;
    public $homepage;
    public $doi;
    public $finalidade;
    public $plataforma;
    public $ambiente;
    public $autores;
    public $idSoftware;

    // Construtor vazio
    public function __construct(){
      parent::__construct();
      $this->natureza = '';
      $this->titulo = '';
      $this->ano = '';
      $this->homepage = '';
      $this->doi = '';
      $this->finalidade = '';
      $this->plataforma = '';
      $this->ambiente = '';
      $this->autores = array();
      $this->idSoftware = '';
    }

    // Função que retorna array com artigos a partir do DB
    public static function selectFromDB($conn, $curriculoId){
      $softwares = array();
      // Pegando do DB
      $softwaresRaw = $conn->query("SELECT * FROM ic_software WHERE curriculoId=$curriculoId ORDER BY ano DESC")->fetchAll(PDO::FETCH_ASSOC);
      // Iterando
      foreach ($softwaresRaw as $software) {
        $software_ = new self();
        $software_->natureza = $software['natureza'];
        $software_->titulo = $software['titulo'];
        $software_->setVal($software);
        $software_->ano = $software['ano'];
        $software_->homepage = $software['homepage'];
        $software_->doi = $software['doi'];
        $software_->finalidade = $software['finalidade'];
        $software_->plataforma = $software['plataforma'];
        $software_->ambiente = $software['ambiente'];
        $software_->autores = json_decode($software['autores'], true);
        $software_->idSoftware = $software['idSoftware'];
        array_push($softwares, $software_);
      }
      return $softwares;
    }

    // Retorna array de softwares a partir de XML
    public static function getSoftwares($data){
      //Array que será retornado
      $softwares = array();

      //Caso possua registros de softwares
      if(isset($data['PRODUCAO-TECNICA']['SOFTWARE'])){
        $softwaresRaw = $data['PRODUCAO-TECNICA']['SOFTWARE'];

        //Caso possua apenas um registro
        if(array_keys($softwaresRaw)[0] === '@attributes')
          $softwaresRaw = array($softwaresRaw);

        //Percorrer lista
        foreach ($softwaresRaw as $software) {
          //Classe temporária para atribuição
          $software_ = new self();
          //Definição de caminhos
          $dadosB = attr($software['DADOS-BASICOS-DO-SOFTWARE']);
          $details = attr($software['DETALHAMENTO-DO-SOFTWARE']);
          $autores = $software['AUTORES'];

          //dadosB
          $software_->natureza = $dadosB['NATUREZA'];
          $software_->titulo = $dadosB['TITULO-DO-SOFTWARE'];
          $software_->ano = $dadosB['ANO'];
          $software_->homepage = $dadosB['HOME-PAGE-DO-TRABALHO'];
          $software_->doi = $dadosB['DOI'];
          //details
          $software_->finalidade = $details['FINALIDADE'];
          $software_->plataforma = $details['PLATAFORMA'];
          $software_->ambiente = $details['AMBIENTE'];
          //autores
          $software_->autores = getAutores($autores);


          //Atribuição da classe temporária no Array
          array_push($softwares, $software_);
        }
      }
      return $softwares;
    }

    // Insere os dados no DB
    public function insertIntoDB($conn, $curriculoId){
      // Encoding de autores para string JSON
      $autores = json_encode($this->autores, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
      // Comando SQL
      $SQL =
        "INSERT INTO ic_software(
          natureza, titulo, ano, homepage, doi, finalidade, plataforma,
          ambiente, autores, curriculoId
        ) VALUES (
          :natureza, :titulo, :ano, :homepage,
          :doi, :finalidade, :plataforma, :ambiente,
          :autores, :curriculoId
        )";
      // Executando Comando
      $stmt = $conn->prepare($SQL);
      // Ligando parametros
      $stmt->bindParam(':natureza',$this->natureza);
      $stmt->bindParam(':titulo',$this->titulo);
      $stmt->bindParam(':ano',$this->ano);
      $stmt->bindParam(':homepage',$this->homepage);
      $stmt->bindParam(':doi',$this->doi);
      $stmt->bindParam(':finalidade',$this->finalidade);
      $stmt->bindParam(':plataforma',$this->plataforma);
      $stmt->bindParam(':ambiente',$this->ambiente);
      $stmt->bindParam(':autores',$autores);
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

 ?>
