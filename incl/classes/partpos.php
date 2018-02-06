<?php
    class PartPos extends IC {
        public $ingresso;
        public $atuacao;
        public $programa;
        public $idPartPos;

        public function __construct(){
            parent::__construct();
            $this->ingresso     = '';
            $this->atuacao      = '';
            $this->programa     = '';
            $this->idPartPos    = '';
        }

        public static function selectFromDB($currId){
            // Instanciando conexão e váriavel de resultados
            global $conn;
            $partPos = array();
            // Pegando informações do DB
            $partPosRaw = $conn->query("SELECT * FROM ic_partpos WHERE curriculoId = $currId ORDER BY ingresso DESC")->fetchAll(PDO::FETCH_ASSOC);
            // Iterando
            foreach ($partPosRaw as $_partPos){
                $__partPos = new self();
                $__partPos->ingresso    = $_partPos['ingresso'];
                $__partPos->atuacao     = $_partPos['atuacao'];
                $__partPos->programa    = $_partPos['programa'];
                $__partPos->idPartPos   = $_partPos['idPartPos'];
                $__partPos->setVal($_partPos);
                array_push( $partPos, $__partPos );
            }
            return $partPos;
        }

        public function insertIntoDB($currId){
            global $conn;
            $stmt = $conn->prepare("INSERT INTO ic_partpos(ingresso, atuacao, programa) VALUES(:ingresso, :atuacao, :programa)");
            $query = $stmt->execute([
                ":ingresso" => $this->ingresso,
                ":atuacao"  => $this->atuacao,
                ":programa" => $this->programa
            ]);
            if(!$query) print_r($stmt->errorInfo());
            return $query;
        }

    }
