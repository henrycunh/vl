<?php
  class CorpoEditorial extends IC{
    // Atributos
    public $nomeInstituicao;
    public $codInstituicao;
    public $dataInicio;
    public $dataFim;
    public $idCorpoEditorial;

    // Construtor vazio
    public function __construct(){
      parent::__construct();
      $this->nomeInstituicao = '';
      $this->codInstituicao = '';
      $this->dataInicio = '';
      $this->dataFim = '';
      $this->idCorpoEditorial = '';
    }

    // Função que retorna array com artigos a partir do DB
    public static function selectFromDB($conn, $curriculoId){
      $corposEditoriais = array();
      // Pegando do DB
      $corposEditoriaisRaw = $conn->query("SELECT * FROM ic_corpoEditorial WHERE curriculoId=$curriculoId")->fetchAll(PDO::FETCH_ASSOC);
      // Iterando
      foreach ($corposEditoriaisRaw as $corpoEditorial) {
        $corpoEditorial_ = new self();
        $corpoEditorial_->nomeInstituicao = $corpoEditorial['nomeInstituicao'];
        $corpoEditorial_->codInstituicao = $corpoEditorial['codInstituicao'];
        $corpoEditorial_->dataInicio = $corpoEditorial['dataInicio'];
        $corpoEditorial_->dataFim = $corpoEditorial['dataFim'];
        $corpoEditorial_->idCorpoEditorial = $corpoEditorial['idCorpoEditorial'];
        array_push($corposEditoriais, $corpoEditorial_);
      }
      return $corposEditoriais;
    }

    // Função que retorna uma lista com as participações em corpos editoriais
    public static function getCorposEditoriais($data){
      $corposEditoriais = array();

      //Checar se existem atuações profissionais
      if(isset($data['DADOS-GERAIS']['ATUACOES-PROFISSIONAIS']['ATUACAO-PROFISSIONAL'])){
          $atuacoesProfRaw = $data['DADOS-GERAIS']['ATUACOES-PROFISSIONAIS']['ATUACAO-PROFISSIONAL'];
        //Caso exista apenas um
        if(array_keys($atuacoesProfRaw)[0] === '@attributes')
          $atuacoesProfRaw = array($atuacoesProfRaw);

        //percorrer atuações
        foreach ($atuacoesProfRaw as $atuacaoProf) {
          if(isset($atuacaoProf['VINCULOS']['@attributes']['OUTRO-VINCULO-INFORMADO'])){
            //checar se é membro
            if($atuacaoProf['VINCULOS']['@attributes']['OUTRO-VINCULO-INFORMADO'] === "Membro de corpo editorial"){
              $corpoEditorial_ = new self();

              $attributes = attr($atuacaoProf);
              $vinculos = $atuacaoProf['VINCULOS']['@attributes'];

              $corpoEditorial_->nomeInstituicao = $attributes['NOME-INSTITUICAO'];
              $corpoEditorial_->codInstituicao = $attributes['CODIGO-INSTITUICAO'];
              $corpoEditorial_->dataInicio = $vinculos['MES-INICIO'] . "/" . $vinculos['ANO-INICIO'] ;
              $corpoEditorial_->dataFim = $vinculos['MES-FIM'] . "/" . $vinculos['ANO-FIM'];

              array_push($corposEditoriais, $corpoEditorial_);
            }
          }
        }
      }
      return $corposEditoriais;
    }

    // Função que insere os dados no DB
    public function insertIntoDB($conn, $curriculoId){
      // Comando SQL
      $SQL =
       "INSERT INTO ic_corpoEditorial(
         nomeInstituicao, codInstituicao, dataInicio, dataFim, curriculoId
       ) VALUES (
         :nomeInstituicao, :codInstituicao, :dataInicio,
         :dataFim, :curriculoId
       )";
       // Criando statement
       $stmt = $conn->prepare($SQL);
       // Ligando parametros
       $stmt->bindParam(':nomeInstituicao',$this->nomeInstituicao);
       $stmt->bindParam(':codInstituicao',$this->codInstituicao);
       $stmt->bindParam(':dataInicio',$this->dataInicio);
       $stmt->bindParam(':dataFim',$this->dataFim);
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
