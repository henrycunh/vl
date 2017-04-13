<?php
  class CorpoEditorial extends IC{
    // Atributos
    public $nomeInstituicao;
    public $codInstituicao;
    public $dataInicio;
    public $dataFim;

    // Construtor vazio
    public function __construct(){
      parent::__construct();
      $this->nomeInstituicao = '';
      $this->codInstituicao = '';
      $this->dataInicio = '';
      $this->dataFim = '';
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
         '$this->nomeInstituicao', '$this->codInstituicao', '$this->dataInicio',
         '$this->dataFim', $curriculoId
       )";
       // Executando Comando
       $query = $conn->query($SQL);
       // Checando erros
       if($query){
         return true;
       } else {
         print_r($conn->errorInfo());
         return false;
       }
    }
  }
 ?>
