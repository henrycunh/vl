<?php
  // Classe principal
  class Curriculo{
    // ICs
    public $titulacao;
    public $artigos;
    public $livros;
    public $trabEventos;
    public $capLivros;
    public $bancas;
    public $organizacaoEventos;
    public $patentes;
    public $softwares;
    public $marcas;
    public $corposEditoriais;
    public $coordProjs;
    public $orientacoes;
    public $curriculoId;

    // Construtor
    public function __construct(){
      $this->titulacao = '';
      $this->artigos = '';
      $this->livros = '';
      $this->trabEventos = '';
      $this->capLivros = '';
      $this->bancas = '';
      $this->organizacaoEventos = '';
      $this->patentes = '';
      $this->softwares = '';
      $this->marcas = '';
      $this->corposEditoriais = '';
      $this->coordProjs = '';
      $this->orientacoes = '';
      $this->curriculoId = '';
    }

    // Função para instanciar e buscar todas as informações a partir de XML
    public static function getCurriculo($data, $curriculoId){
      $curriculo = new self();
      $curriculo->titulacao = Titulacao::getTitulacao($data);
      $curriculo->artigos = Artigo::getArtigos($data);
      $curriculo->livros = Livro::getLivros($data);
      $curriculo->trabEventos = TrabEvento::getTrabEventos($data);
      $curriculo->capLivros = CapLivro::getCapLivros($data);
      $curriculo->bancas = Banca::getBancas($data);
      $curriculo->organizacaoEventos = OrganizacaoEvento::getOrganizacaoEvento($data);
      $curriculo->patentes = Patente::getPatentes($data);
      $curriculo->softwares = Software::getSoftwares($data);
      $curriculo->marcas = Marca::getMarcas($data);
      $curriculo->corposEditoriais = CorpoEditorial::getCorposEditoriais($data);
      $curriculo->coordProjs = CoordProjeto::getCoordProjs($data);
      $curriculo->orientacoes = Orientacao::getOrientacoes($data);
      $curriculo->nomeCompleto = $data['DADOS-GERAIS']['@attributes']['NOME-COMPLETO'];
      $curriculo->curriculoId = $curriculoId;
      return $curriculo;
    }

    // Pegar um curriculo a partir de um e-mail
    public static function getCurriculoByEmail($conn, $email){
      $id = Curriculo::getIDByEmail($conn, $email);
      if($id){
        $curriculo = Curriculo::getCurriculoByID($conn, $id);
      } else {
        return false;
      }
      return $curriculo;
    }

    // Pega o curriculoId a partir de um email
    public static function getIDByEmail($conn,$email){
      $id = $conn->query("SELECT curriculoId FROM curriculo
        WHERE email = '$email'")->fetch(PDO::FETCH_ASSOC);

      if($id)
        return $id['curriculoId'];
      else
        return false;
    }

    // Cria um objeto curriculo com todos os ICs a partir de um ID
    public static function getCurriculoByID($conn, $id){
      $curriculo = new self();
      $curriculo->curriculoId = $id;
      $curriculo->artigos = Artigo::selectFromDB($conn, $id);
      $curriculo->bancas = Banca::selectFromDB($conn, $id);
      $curriculo->capLivros = CapLivro::selectFromDB($conn, $id);
      $curriculo->coordProjs = CoordProjeto::selectFromDB($conn, $id);
      $curriculo->corposEditoriais = CorpoEditorial::selectFromDB($conn, $id);
      $curriculo->livros = Livro::selectFromDB($conn, $id);
      $curriculo->marcas = Marca::selectFromDB($conn, $id);
      $curriculo->organizacaoEventos = OrganizacaoEvento::selectFromDB($conn,$id);
      $curriculo->orientacoes = Orientacao::selectFromDB($conn, $id);
      $curriculo->patentes = Patente::selectFromDB($conn, $id);
      $curriculo->softwares = Software::selectFromDB($conn, $id);
      $curriculo->titulacao = Titulacao::selectFromDB($conn,$id);
      $curriculo->trabEventos = TrabEvento::selectFromDB($conn,$id);
      return $curriculo;
    }

    public static function getNomeCompleto($conn, $id){
      return $conn->query("SELECT nomeCompleto FROM curriculo WHERE curriculoId=$id")->fetch(PDO::FETCH_ASSOC)['nomeCompleto'];
    }

    // Envia todos os dados do objeto para o DB
    public function insertAllIntoDB($conn){
      // Deletando ICs, para então inserir
      $this->deleteICs($conn);
      // Armazenando nomeCompleto
      $stmt = $conn->prepare(
        "UPDATE curriculo SET nomeCompleto = :nomeCompleto WHERE curriculoId = :curriculoId"
      );
      $stmt->bindParam(':nomeCompleto', $this->nomeCompleto);
      $stmt->bindParam(':curriculoId', $this->curriculoId);
      $stmt->execute();
      // Array com os dados
      $dataIC = array(
        $this->artigos, $this->bancas, $this->capLivros, $this->coordProjs,
        $this->corposEditoriais, $this->livros, $this->marcas,
        $this->organizacaoEventos, $this->orientacoes, $this->patentes,
        $this->softwares, array($this->titulacao), $this->trabEventos
      );
      // Array que vai armazenar os resultados dos queries
      $queries = array();
      // Percorrendo os arrays e inserindo-nos no DB
      foreach($dataIC as $i => $ic){
        $queries[$i] = $this->insertICIntoDB($conn, $ic);
      }
    }

    // Envia IC para o DB
    public function insertICIntoDB($conn, $icArray){
      foreach ($icArray as $single) {
        if(!$single->insertIntoDB($conn,$this->curriculoId)) return false;
      }
      return true;
    }

    // Deleta todos os ICs vinculados a esse curriculo
    public function deleteICs($conn){
      $keysIC = array(
        "artigo", "banca", "capLivro", "coordProj", "corpoEditorial", "livro",
        "marca", "organizacaoEvento", "orientacao", "patente", "software", "titulacao",
        "trabEvento"
      );
      // array que armazena resultados dos queries
      $queries = array();
      // percorrendo as tabelas e removendo
      foreach ($keysIC as $ic)
        $queries[$ic] = $conn->query("DELETE FROM ic_$ic WHERE curriculoId=$this->curriculoId");
    }
  }

  // Importando ICs
  require 'ic.php';
  require 'utils.php';
  require 'titulacao.php';
  require 'artigo.php';
  require 'livro.php';
  require 'trabEvento.php';
  require 'capLivro.php';
  require 'banca.php';
  require 'organizacaoEvento.php';
  require 'patente.php';
  require 'software.php';
  require 'marca.php';
  require 'corpoEditorial.php';
  require 'coordProj.php';
  require 'orientacao.php';




 ?>
