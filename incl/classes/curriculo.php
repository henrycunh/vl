<?php
  // Classe principal
  class Curriculo{
    // ICs
    public $titulacoes;
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
      $this->titulacoes = '';
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
      $curriculo->titulacoes = Titulacao::getTitulacoes($data);
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

    public function deleteCurriculo($conn){
      $conn->query("DELETE FROM curriculo WHERE curriculoId=$this->curriculoId");
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
      $curriculo->titulacoes = Titulacao::selectFromDB($conn,$id);
      $curriculo->trabEventos = TrabEvento::selectFromDB($conn,$id);
      return $curriculo;
    }

    public static function getNomeCompleto($conn, $id){
      return $conn->query("SELECT nomeCompleto FROM curriculo WHERE curriculoId=$id")->fetch(PDO::FETCH_ASSOC)['nomeCompleto'];
    }

    // Função super extensa que retorna um curriculo com a diferença entre dois outros
    public static function compararCurriculos($cA, $cN){
      $curriculo = new self();
      // Criando cópias profundas dos objetos de referência
      $clAtual = unserialize(serialize($cA));
      $clNovo = unserialize(serialize($cN));
      // Criando um array contendo todas as propriedades do obj. curriculo
      $prop = get_object_vars(new Curriculo);
      // Removendo todos os ICs que não possuem comprovante
      foreach ($prop as $ic => $v) {
        if($ic != 'curriculoId' )
        $clAtual->{$ic} = array_filter($clAtual->{$ic}, function ($x){
          return $x->comprovante != NULL;
        });
      }
      // Removendo os dados de ID dos ICs
      $clAtual->limparDadosRelativos();
      // Tirando a diferença entre o curriculo submetido e o atual
      foreach ($prop as $ic => $v) {
        if($ic != 'curriculoId')
        $curriculo->{$ic} = array_udiff($clNovo->{$ic}, $clAtual->{$ic},
          function ($obj_a, $obj_b) {
            return strcmp(json_encode($obj_a), json_encode($obj_b));
          }
        );
      }
      $curriculo->curriculoId = $clAtual->curriculoId;
      return $curriculo;
    }

    // Envia todos os dados do objeto para o DB
    public function insertAllIntoDB($conn){
      // Deletando ICs, para então inserir
      $this->deleteCurrICs($conn);
      // Tirar a diferenças dos curriculos já existentes

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
        $this->softwares, $this->titulacoes, $this->trabEventos
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

    public function deleteCurrICs($conn){
      $keysIC = array(
        "artigo", "banca", "capLivro", "coordProj", "corpoEditorial", "livro",
        "marca", "organizacaoEvento", "orientacao", "patente", "software", "titulacao",
        "trabEvento"
      );
      // array que armazena resultados dos queries
      $queries = array();
      // percorrendo as tabelas e removendo
      foreach ($keysIC as $ic)
        $queries[$ic] = $conn->query("DELETE FROM ic_$ic WHERE curriculoId=$this->curriculoId AND comprovante IS NULL");
    }

    public function limparDadosRelativos(){
      // artigos
      foreach ($this->artigos as $i=>$v){
        $this->artigos[$i]->idArtigo = '';
        $this->artigos[$i]->cleanVal();
      }
      // bancas
      foreach ($this->bancas as $i=>$v){
        $this->bancas[$i]->idBanca = '';
        $this->bancas[$i]->cleanVal();
      }
      // capLivros
      foreach ($this->capLivros as $i=>$v){
        $this->capLivros[$i]->idCapLivro = '';
        $this->capLivros[$i]->cleanVal();
      }
      // coordProjs
      foreach ($this->coordProjs as $i=>$v){
        $this->coordProjs[$i]->idCoordProj = '';
        $this->coordProjs[$i]->cleanVal();
      }
      // corposEditoriais
      foreach ($this->corposEditoriais as $i=>$v){
        $this->corposEditoriais[$i]->idCorpoEditorial = '';
        $this->corposEditoriais[$i]->cleanVal();
      }
      // livros
      foreach ($this->livros as $i=>$v){
        $this->livros[$i]->idLivros = '';
        $this->livros[$i]->cleanVal();
      }
      // marcas
      foreach ($this->marcas as $i=>$v){
        $this->marcas[$i]->idMarca = '';
        $this->marcas[$i]->cleanVal();
       }
      // organizacaoEventos
      foreach ($this->organizacaoEventos as $i=>$v){
        $this->organizacaoEventos[$i]->idOrganizacaoEvento = '';
        $this->organizacaoEventos[$i]->cleanVal();
      }
      // orientacoes
      foreach ($this->orientacoes as $i=>$v){
        $this->orientacoes[$i]->idOrientacao = '';
        $this->orientacoes[$i]->cleanVal();
      }
      // patentes
      foreach ($this->patentes as $i=>$v){
        $this->patentes[$i]->idPatente = '';
        $this->patentes[$i]->cleanVal();
      }
      // softwares
      foreach ($this->softwares as $i=>$v){
        $this->softwares[$i]->idSoftware = '';
        $this->softwares[$i]->cleanVal();
      }
      // titulacao
      foreach ($this->titulacoes as $i=>$v){
        $this->titulacoes[$i]->idTitulacao = '';
        $this->titulacoes[$i]->cleanVal();
      }
      // trabEventos
      foreach ($this->trabEventos as $i=>$v){
        $this->trabEventos[$i]->idTrabEventos = '';
        $this->trabEventos[$i]->cleanVal();
      }
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
