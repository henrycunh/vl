<?php
  class Orientacao extends IC{
    public $natureza;
    // 1 - IC; 2 - Graduação; 3 - Especialização; 4 - Mestrado; 5 - Doutorado; 6 - Pós-Doutorado;
    public $tipo;
    public $titulo;
    public $ano;
    public $idioma;
    public $pais;
    public $homepage;
    public $doi;
    public $nomeOrientado;
    public $nomeInstituicao;
    public $nomeCurso;

    public function __construct(){
      parent::__construct();
      $this->natureza = '';
      $this->tipo = '';
      $this->titulo = '';
      $this->ano = '';
      $this->idioma = '';
      $this->pais = '';
      $this->homepage = '';
      $this->doi = '';
      $this->nomeOrientado = '';
      $this->nomeInstituicao = '';
      $this->nomeCurso = '';
    }

    public static function getOrientacoes($data){
      $orientacoes = array();
      if(isset($data['OUTRA-PRODUCAO']['ORIENTACOES-CONCLUIDAS'])):
        $orientacoesRaw = $data['OUTRA-PRODUCAO']['ORIENTACOES-CONCLUIDAS'];
        //Caso possua apenas um tipo de orientação
        if(array_keys($orientacoesRaw)[0] === '@attributes')
          $orientacoesRaw = array($orientacoesRaw);

        // Checando por orientações de mestrado
        if(isset($orientacoesRaw['ORIENTACOES-CONCLUIDAS-PARA-MESTRADO'])){
          $orientMest = $orientacoesRaw['ORIENTACOES-CONCLUIDAS-PARA-MESTRADO'];

          if(array_keys($orientMest)[0] === '@attributes')
            $orientMest = array($orientMest);
        }
        // Checando por orientações de pos-doc
        if(isset($orientacoesRaw['ORIENTACOES-CONCLUIDAS-PARA-POS-DOUTORADO'])){
          $orientPosDoc = $orientacoesRaw['ORIENTACOES-CONCLUIDAS-PARA-POS-DOUTORADO'];

          if(array_keys($orientPosDoc)[0] === '@attributes')
            $orientPosDoc = array($orientPosDoc);
        }
        // Checando por orientações de ic, esp, ou grad
        if(isset($orientacoesRaw['OUTRAS-ORIENTACOES-CONCLUIDAS'])){
          $outrasOrient = $orientacoesRaw['OUTRAS-ORIENTACOES-CONCLUIDAS'];

          if(array_keys($outrasOrient)[0] === '@attributes')
            $outrasOrient = array($outrasOrient);
        }

        foreach ($orientPosDoc as $orientPosDoc1) {
          $orientPosDoc1_ = new Orientacao();

          $orientPosDoc1_->natureza = attr($orientPosDoc1['DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-POS-DOUTORADO'])['NATUREZA'];
          $orientPosDoc1_->tipo = attr($orientPosDoc1['DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-POS-DOUTORADO'])['TIPO'];
          $orientPosDoc1_->titulo = attr($orientPosDoc1['DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-POS-DOUTORADO'])['TITULO'];
          $orientPosDoc1_->ano = attr($orientPosDoc1['DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-POS-DOUTORADO'])['ANO'];
          $orientPosDoc1_->idioma = attr($orientPosDoc1['DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-POS-DOUTORADO'])['IDIOMA'];
          $orientPosDoc1_->pais = attr($orientPosDoc1['DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-POS-DOUTORADO'])['PAIS'];
          $orientPosDoc1_->homepage = attr($orientPosDoc1['DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-POS-DOUTORADO'])['HOME-PAGE'];
          $orientPosDoc1_->doi = attr($orientPosDoc1['DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-POS-DOUTORADO'])['DOI'];

          $orientPosDoc1_->nomeOrientado = attr($orientPosDoc1['DETALHAMENTO-DE-ORIENTACOES-CONCLUIDAS-PARA-POS-DOUTORADO'])['NOME-DO-ORIENTADO'];
          $orientPosDoc1_->nomeInstituicao = attr($orientPosDoc1['DETALHAMENTO-DE-ORIENTACOES-CONCLUIDAS-PARA-POS-DOUTORADO'])['NOME-DA-INSTITUICAO'];
          $orientPosDoc1_->nomeCurso = attr($orientPosDoc1['DETALHAMENTO-DE-ORIENTACOES-CONCLUIDAS-PARA-POS-DOUTORADO'])['NOME-DO-CURSO'];

          array_push($orientacoes, $orientPosDoc1_);
        }

        foreach ($orientMest as $orientMest1) {
          $orientMest1_ = new Orientacao();

          $orientMest1_->natureza = attr($orientMest1['DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-MESTRADO'])['NATUREZA'];
          $orientMest1_->tipo = attr($orientMest1['DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-MESTRADO'])['TIPO'];
          $orientMest1_->titulo = attr($orientMest1['DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-MESTRADO'])['TITULO'];
          $orientMest1_->ano = attr($orientMest1['DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-MESTRADO'])['ANO'];
          $orientMest1_->idioma = attr($orientMest1['DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-MESTRADO'])['IDIOMA'];
          $orientMest1_->pais = attr($orientMest1['DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-MESTRADO'])['PAIS'];
          $orientMest1_->homepage = attr($orientMest1['DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-MESTRADO'])['HOME-PAGE'];
          $orientMest1_->doi = attr($orientMest1['DADOS-BASICOS-DE-ORIENTACOES-CONCLUIDAS-PARA-MESTRADO'])['DOI'];

          $orientMest1_->nomeOrientado = attr($orientMest1['DETALHAMENTO-DE-ORIENTACOES-CONCLUIDAS-PARA-MESTRADO'])['NOME-DO-ORIENTADO'];
          $orientMest1_->nomeInstituicao = attr($orientMest1['DETALHAMENTO-DE-ORIENTACOES-CONCLUIDAS-PARA-MESTRADO'])['NOME-DA-INSTITUICAO'];
          $orientMest1_->nomeCurso = attr($orientMest1['DETALHAMENTO-DE-ORIENTACOES-CONCLUIDAS-PARA-MESTRADO'])['NOME-DO-CURSO'];

          array_push($orientacoes, $orientMest1_);
        }

        foreach ($outrasOrient as $outrasOrient1) {
          $outrasOrient1_ = new Orientacao();

          $outrasOrient1_->natureza = attr($outrasOrient1['DADOS-BASICOS-DE-OUTRAS-ORIENTACOES-CONCLUIDAS'])['NATUREZA'];
          $outrasOrient1_->tipo = attr($outrasOrient1['DADOS-BASICOS-DE-OUTRAS-ORIENTACOES-CONCLUIDAS'])['TIPO'];
          $outrasOrient1_->titulo = attr($outrasOrient1['DADOS-BASICOS-DE-OUTRAS-ORIENTACOES-CONCLUIDAS'])['TITULO'];
          $outrasOrient1_->ano = attr($outrasOrient1['DADOS-BASICOS-DE-OUTRAS-ORIENTACOES-CONCLUIDAS'])['ANO'];
          $outrasOrient1_->idioma = attr($outrasOrient1['DADOS-BASICOS-DE-OUTRAS-ORIENTACOES-CONCLUIDAS'])['IDIOMA'];
          $outrasOrient1_->pais = attr($outrasOrient1['DADOS-BASICOS-DE-OUTRAS-ORIENTACOES-CONCLUIDAS'])['PAIS'];
          $outrasOrient1_->homepage = attr($outrasOrient1['DADOS-BASICOS-DE-OUTRAS-ORIENTACOES-CONCLUIDAS'])['HOME-PAGE'];
          $outrasOrient1_->doi = attr($outrasOrient1['DADOS-BASICOS-DE-OUTRAS-ORIENTACOES-CONCLUIDAS'])['DOI'];

          $outrasOrient1_->nomeOrientado = attr($outrasOrient1['DETALHAMENTO-DE-OUTRAS-ORIENTACOES-CONCLUIDAS'])['NOME-DO-ORIENTADO'];
          $outrasOrient1_->nomeInstituicao = attr($outrasOrient1['DETALHAMENTO-DE-OUTRAS-ORIENTACOES-CONCLUIDAS'])['NOME-DA-INSTITUICAO'];
          $outrasOrient1_->nomeCurso = attr($outrasOrient1['DETALHAMENTO-DE-OUTRAS-ORIENTACOES-CONCLUIDAS'])['NOME-DO-CURSO'];

          array_push($orientacoes, $outrasOrient1_);
        }

      endif;
      return $orientacoes;
    }
  }
 ?>
