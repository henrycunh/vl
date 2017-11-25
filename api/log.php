<?php
// Define o tipo de conteúdo no header
header("Content-type: application/json");
// Continua a sessão
session_start();
// Importando classes necesśarias

// Conexão com o DB
require_once '../incl/database.php';

// Verificando se foi enviado um request
if(!empty($_POST)):
  // Repassando as informações para uma váriavel simples
  $data = $_POST;

  if($data['op'] == 'log/adicionar'){
    $tempo = getCurrentTime();
    $atividade = json_encode($data['atividade'], JSON_UNESCAPED_UNICODE);
    $dados_sessao = json_encode($_SESSION);

    $stmt = $conn->prepare("INSERT INTO log(atividade, tempo, dados_sessao) VALUES(
      :atividade, :tempo, :dados_sessao
    )");
    $status = $stmt->execute([
      ":atividade"    => $atividade,
      ":tempo"        => $tempo,
      ":dados_sessao" => $dados_sessao
    ]);
    if($status){
      echo json_encode([
        "success" => true
      ]);
    } else {
      echo json_encode([
        "success" => false,
        "error" => $stmt->errorInfo()
      ]);
    }
  }

endif;

function getCurrentTime() {
    $tz_object = new DateTimeZone('Brazil/East');
    //date_default_timezone_set('Brazil/East');

    $datetime = new DateTime();
    $datetime->setTimezone($tz_object);
    return $datetime->format('Y\-m\-d\ H:i:s');
}

 ?>
