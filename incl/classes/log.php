<?php

  class Log {
      public $atividade;
      public $dados;
      public $tempo;
      public $dados_sessao;

      public function __construct(){
        $this->atividade = "";
        $this->dados = array();
        $this->tempo = new DateTime();
        $this->dados_sessao = array();
      }


      /**
       * Retorna um array com todos os Logs do servidor
       */
      public static function getAll(){
          global $conn;
          $result_logs = array();
          $logs = $conn->query("SELECT * FROM log")->fetchAll(PDO::FETCH_ASSOC);

          foreach($logs as $log_){
            $log = new Log();
            $data = json_decode($log_['atividade'], true);
            $log->atividade = $data['atividade'];
            if(isset($data['dados']))
              $log->dados = $data['dados'];
              if(isset($data['data']))
                $log->dados = $data['data'];
            $log->tempo = new DateTime($log_['tempo']);
            $log->dados_sessao = json_decode($log_['dados_sessao'], true);
            array_push($result_logs, $log);
          }

          return $result_logs;
      }


      public function dadosFormatted(){
        if($this->dados){
          $str = '';
          foreach ($this->dados as $k => $v)
            $str .= "<pre>". str_pad($k, 15) . ": $v<br></pre>";
          return $str;
        }
      }

      public function dadosSessaoFormatted(){
        var_dump($this->dados_sessao);
      }

  }




 ?>
