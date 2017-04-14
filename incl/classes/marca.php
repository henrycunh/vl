<?php
  class Marca extends IC{
    // Atributos
    public $titulo;
    public $ano;
    public $natureza;
    public $tipo;
    public $codigo;
    public $tituloPatente;
    public $dataConcessao;
    public $instDeposito;
    public $autores;

    // Construtor Vazio
    public function __construct(){
      parent::__construct();
      $this->titulo = '';
      $this->ano = '';
      $this->natureza = '';
      $this->tipo = '';
      $this->codigo = '';
      $this->tituloPatente = '';
      $this->instDeposito = '';
      $this->dataConcessao = '';
      $this->autores = array();
    }

    // Retorna as marcas a partir do XML
    public static function getMarcas($data){
      //Array temporário para atribuição
      $marcas = array();

      //checa se existe registros de marca
      if(isset($data['PRODUCAO-TECNICA']['MARCA'])){
        $marcasRaw = $data['PRODUCAO-TECNICA']['MARCA'];

        //Caso exista apenas um registro de marca
        if(array_keys($marcasRaw)[0] === '@attributes')
          $marcasRaw = array($marcasRaw);

        //Percorrer lista
        foreach ($marcasRaw as $marca) {
          //Classe temporária para atribuição
          $marca_ = new self();
          //Definição de caminhos
          $dadosB = attr($marca['DADOS-BASICOS-DA-MARCA']);
          $details = attr($marca['DETALHAMENTO-DA-MARCA']);
          $register = attr($marca['DETALHAMENTO-DA-MARCA']['REGISTRO-OU-PATENTE']);
          $autores = $marca['AUTORES'];
          //Atribuições
          $marca_->titulo = $dadosB['TITULO'];
          $marca_->ano = $dadosB['ANO-DESENVOLVIMENTO'];
          $marca_->natureza = $details['NATUREZA'];
          $marca_->tipo = $register['TIPO-PATENTE'];
          $marca_->codigo = $register['CODIGO-DO-REGISTRO-OU-PATENTE'];
          $marca_->tituloPatente = $register['TITULO-PATENTE'];
          $marca_->dataConcessao = $register['DATA-DE-CONCESSAO'];
          $marca_->instDeposito = $register['INSTITUICAO-DEPOSITO-REGISTRO'];
          $marca_->autores = getAutores($autores);

          array_push($marcas, $marca_);
        }
      }
      return $marcas;
    }

    // Insere os dados no DB
    public function insertIntoDB($conn, $curriculoId){
      // Enconding dos autores em uma string JSON
      $autores = json_encode($this->autores, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
      // Comando SQL
      $SQL =
        "INSERT INTO ic_marca(
          titulo, ano, natureza, tipo, codigo, tituloPatente,
          dataConcessao, instDeposito, autores, curriculoId
        ) VALUES (
          :titulo, :ano, :natureza,
          :tipo, :codigo, :tituloPatente,
          :dataConcessao, :instDeposito, :autores,
          :curriculoId
        )";
      // Preparando statement
      $stmt = $conn->prepare($SQL);
      // Ligando parametros
      $stmt->bindParam(':titulo',$this->titulo);
      $stmt->bindParam(':ano',$this->ano);
      $stmt->bindParam(':natureza',$this->natureza);
      $stmt->bindParam(':tipo',$this->tipo);
      $stmt->bindParam(':codigo',$this->codigo);
      $stmt->bindParam(':tituloPatente',$this->tituloPatente);
      $stmt->bindParam(':dataConcessao',$this->dataConcessao);
      $stmt->bindParam(':instDeposito',$this->instDeposito);
      $stmt->bindParam(':autores',$autores);
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
