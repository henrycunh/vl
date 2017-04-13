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
      $this->curriculoId = '';
    }

    // Função para instanciar e buscar todas as informações
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
      $curriculo->curriculoId = $curriculoId;
      return $curriculo;
    }

    //

    // Pegar um curriculo a partir de um e-mail
    public static function getCurriculoByEmail($conn, $email){
      $result = $conn->query("SELECT curriculoId FROM curriculo
        WHERE email = '$email'")->fetch(PDO::FETCH_ASSOC);
      return $result;
    }

    // Envia todos os dados do objeto para o DB
    public function insertAllIntoDB($conn){
      // Deletando ICs, para então inserir
      $this->deleteICs($conn);

      /* INSERÇÃO DE ICS */

      // Inserindo artigos
      $artigosQuery = $this->insertArtigosIntoDB($conn);
      // Inserindo bancas
      $bancasQuery = $this->insertBancasIntoDB($conn);
      // Inserindo capitulos de livros
      $capLivrosQuery = $this->insertCapLivrosIntoDB($conn);
      // Inserindo coordenação de projetos
      $coordProjsQuery = $this->insertCoordProjsIntoDB($conn);
      // Inserindo corpos editoriais
      $corpoEditorialQuery = $this->insertCorposEditoriaisIntoDB($conn);
      // Inserindo livros
      $livroQuery = $this->insertLivrosIntoDB($conn);
      // Inserindo marcas
      $marcaQuery = $this->insertMarcasIntoDB($conn);
      // Inserindo organização de eventos
      $organizacaoEventoQuery = $this->insertOrganizacaoEventosIntoDB($conn);
    }

    // Envia todos os artigos para o DB
    public function insertArtigosIntoDB($conn){
      foreach ($this->artigos as $artigo) {
        if(!$artigo->insertIntoDB($conn,$this->curriculoId)) return false;
      }
      return true;
    }

    // Envia todas as bancas para o DB
    public function insertBancasIntoDB($conn){
      foreach ($this->bancas as $banca) {
        if(!$banca->insertIntoDB($conn,$this->curriculoId)) return false;
      }
      return true;
    }

    // Envia todas os capitulos de livros para o DB
    public function insertCapLivrosIntoDB($conn){
      foreach ($this->capLivros as $capLivro) {
        if(!$capLivro->insertIntoDB($conn,$this->curriculoId)) return false;
      }
      return true;
    }

    // Envia todas os capitulos de livros para o DB
    public function insertCoordProjsIntoDB($conn){
      foreach ($this->coordProjs as $coordProj) {
        if(!$coordProj->insertIntoDB($conn,$this->curriculoId)) return false;
      }
      return true;
    }

    // Envia todas os capitulos de livros para o DB
    public function insertCorposEditoriaisIntoDB($conn){
      foreach ($this->corposEditoriais as $corpoEditorial) {
        if(!$corpoEditorial->insertIntoDB($conn,$this->curriculoId)) return false;
      }
      return true;
    }

    // Envia todas os capitulos de livros para o DB
    public function insertLivrosIntoDB($conn){
      foreach ($this->livros as $livro) {
        if(!$livro->insertIntoDB($conn,$this->curriculoId)) return false;
      }
      return true;
    }

    // Envia todas os capitulos de livros para o DB
    public function insertMarcasIntoDB($conn){
      foreach ($this->marcas as $marca) {
        if(!$marca->insertIntoDB($conn,$this->curriculoId)) return false;
      }
      return true;
    }

    // Envia todas os capitulos de livros para o DB
    public function insertOrganizacaoEventosIntoDB($conn){
      foreach ($this->organizacaoEventos as $organizacaoEvento) {
        if(!$organizacaoEvento->insertIntoDB($conn,$this->curriculoId)) return false;
      }
      return true;
    }

    // Deleta todos os ICs vinculados a esse curriculo
    public function deleteICs($conn){
      // Deletando artigos
      $artigosQuery = $conn->query("DELETE FROM ic_artigo WHERE curriculoId=$this->curriculoId");
      // Deletando bancas
      $bancasQuery = $conn->query("DELETE FROM ic_banca WHERE curriculoId=$this->curriculoId");
      // Deletando capitulos de livros
      $capLivroQuery = $conn->query("DELETE FROM ic_capLivro WHERE curriculoId=$this->curriculoId");
      // Deletando coordenação de projetos
      $coordProjQuery = $conn->query("DELETE FROM ic_coordProj WHERE curriculoId=$this->curriculoId");
      // Deletando participações em corpos editoriais
      $corpoEditorialQuery = $conn->query("DELETE FROM ic_corpoEditorial WHERE curriculoId=$this->curriculoId");
      // Deletando livros
      $livroQuery = $conn->query("DELETE FROM ic_livro WHERE curriculoId=$this->curriculoId");
      // Deletando marcas
      $marcaQuery = $conn->query("DELETE FROM ic_marca WHERE curriculoId=$this->curriculoId");
      // Deletando organização de eventos
      $organizacaoEventoQuery = $conn->query("DELETE FROM ic_organizacaoEvento WHERE curriculoId=$this->curriculoId");
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
