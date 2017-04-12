<?php
  class CorpoEditorial extends IC{
    //DADOS-GERAIS > ATUACOES-PROFISSIONAIS > ATUACAO-PROFISSIONAL > VINCULOS > OUTRO-VINCULO-INFORMADO: "Membro de corpo editorial"
    //@attributes
    public $nomeInstituicao; //NOME-INSTITUICAO
    public $codInstituicao; //CODIGO-INSTITUICAO
    //VINCULOS -> @attributes
    public $dataInicio;
    public $dataFim;

    //Construtor
    public function __construct(){
      parent::__construct();
      $this->nomeInstituicao = '';
      $this->codInstituicao = '';
      $this->dataInicio = '';
      $this->dataFim = '';
    }

    //Lista de editoriais em que se foi membro do corpo editorial
    public static function getCorposEditoriais($data){
      $corposEditoriais = array();

      //Checar se existem atuações profissionais
      if(isset($data['DADOS-GERAIS']['ATUACOES-PROFISSIONAIS']['ATUACAO-PROFISSIONAL'])):
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
    endif;
      return $corposEditoriais;
    }

  }
 ?>
