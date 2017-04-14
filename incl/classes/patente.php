<?php
  class Patente{
    /*Declaração de atributos*/
    public $titulo;
    public $ano;
    public $homepage;
    public $categoria;
    public $tipo;
    public $codigo;
    public $tituloPatente;
    public $instituicaoDeposito;
    public $nomeTitular;
    public $dataConcessao;
    public $autores;

    // Construtor Vazio
    public function __construct(){
        $this->titulo = '';
        $this->ano = '';
        $this->homepage = '';
        $this->categoria = '';
        $this->tipo = '';
        $this->codigo = '';
        $this->tituloPatente = '';
        $this->instituicaoDeposito = '';
        $this->nomeTitular = '';
        $this->dataConcessao = '';
        $this->autores = array();
      }

    // Retorna as patentes a partir de um XML
    public static function getPatentes($data){
      //array que será retornado
      $patentes = array();

      //Caso possua patentes
      if(isset($data['PRODUCAO-TECNICA']['PATENTE'])){
        $patentesRaw = $data['PRODUCAO-TECNICA']['PATENTE'];

        //Caso possua apenas um registro
        if(array_keys($patentesRaw)[0] === '@attributes')
          $patentesRaw = array($patentesRaw);

        //Percorrer lista de patentes
        foreach ($patentesRaw as $patente) {
          //Classe temporária para atribuir valores
          $patente_ = new self();
          // var_dump($patente);
          //Definição de caminhos
          $dadosB = attr($patente['DADOS-BASICOS-DA-PATENTE']);
          $details = attr($patente['DETALHAMENTO-DA-PATENTE']);
          $registro = attr($patente['DETALHAMENTO-DA-PATENTE']['REGISTRO-OU-PATENTE']);
          $autores = $patente['AUTORES'];

          //dadosB
          $patente_->titulo = $dadosB['TITULO'];
          $patente_->ano = $dadosB['ANO-DESENVOLVIMENTO'];
          $patente_->homepage = $dadosB['HOME-PAGE'];
          //DETALHAMENTO-DA-PATENTE
            //attributes
            $patente_->categoria = $details['CATEGORIA'];
            //REGISTRO-OU-PATENTE
            $patente_->tipo = $registro['TIPO-PATENTE'];
            $patente_->codigo = $registro['CODIGO-DO-REGISTRO-OU-PATENTE'];
            $patente_->tituloPatente = $registro['TITULO-PATENTE'];
            $patente_->instituicaoDeposito = $registro['INSTITUICAO-DEPOSITO-REGISTRO'];
            $patente_->nomeTitular = $registro['NOME-DO-TITULAR'];
            $patente_->dataConcessao = $registro['DATA-DE-CONCESSAO'];
          //AUTORES
          $patente_->autores = getAutores($autores);

          //Atribuição da classe no Array
          array_push($patentes, $patente_);
        }
      }
      return $patentes;
    }

    // Insere os dados no DB
    public function insertIntoDB($conn, $curriculoId){
      // Encoding dos autores em string JSON
      $autores = json_encode($this->autores, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
      // Comando SQL
      $SQL =
        "INSERT INTO ic_patente(
          titulo, ano, homepage, categoria, tipo, codigo, tituloPatente,
          instituicaoDeposito, nomeTitular, dataConcessao, autores, curriculoId
        ) VALUES (
          '$this->titulo', '$this->ano', '$this->homepage', '$this->categoria',
          '$this->tipo', '$this->codigo', '$this->tituloPatente',
          '$this->instituicaoDeposito', '$this->nomeTitular', '$this->dataConcessao',
          '$autores', $curriculoId
        )";
      // Executando Comando
      $query = $conn->query($SQL);
      // Checando por erros
      if($query){
        return true;
      } else {
        print_r($conn->errorInfo());
        return false;
      }
    }

  }
 ?>
