<?php
  /**
    * Controla a exibição e formatação de dados condicionados em PDF
    *
    */

  // Requerindo o API e as classes necessárias
  require 'vendor/autoload.php';
  use Dompdf\Dompdf;
  // Conexão com o DB
  require 'incl/classes/edital.php';
  require 'incl/classes/curriculo.php';
  require 'incl/classes/usuario.php';
  require 'incl/classes/regra.php';
  require 'incl/classes/sumario.php';
  require 'incl/database.php';


  // Parsing das informações recebidas
  if(!empty($_POST)){ # Se foram enviadas informações
    // Inicializando os dados
    $data = $_POST;
    // Inicializando extensão de PDF
    $dPDF = new Dompdf();
    if($data["doc"] == "sumario")
      sumarioToPDF($data["curriculoId"], $data["idEdital"]);

    if($data["doc"] == "regras")
      regrasToPDF($data["idEdital"]);





  } else { # Se não foram enviadas informações
    header("Location: 502.html");
    die();
  }



  function regrasToPDF($edId){
    // Importando extensão de PDF e Conexão com o DB
    global $dPDF;
    global $conn;
    // Instanciando edital
    $edital = Edital::selectById($conn, $edId);
    // Coletando regras
    $rules  = $edital->getRegrasFormated($conn);
    // Iniciando captura no Buffer
    ob_start();
    include "incl/layouts/regras.php";
    // Salvando HTML
    $html = ob_get_contents();
    // Encerrando Buffer
    ob_end_clean();
    // var_export($html);
    // Carregando o HTML no PDF
    $dPDF->set_option('isHtml5ParserEnabled', true);
    $dPDF->loadHtml($html);
    // Definindo papel e orientação
    $dPDF->setPaper('A4', 'portrait');
    // Renderizando o HTML como PDF
    $dPDF->render();
    $dPDF->stream();
  }

  function sumarioToPDF($cId, $edId){
    // Importando extensão de PDF e Conexão com o DB
    global $dPDF;
    global $conn;
    // Link do QRCode
    // Instanciando edital
    $sumario = Sumario::selectSumario($cId, $edId, $conn);
    $QRCODE_LINK = "http://www.kanitech.com.br/verSumario.php?hashcode=$sumario->hashcode";
    // Instanciando curriculo
    $curriculo = Curriculo::getCurriculoByID($conn, $sumario->curriculoId);
    // Instanciando usuario
    $email = $conn->query("SELECT email FROM curriculo WHERE curriculoId=$cId")->fetch(PDO::FETCH_ASSOC)["email"];
    $usuario = Usuario::selectByEmail($conn, $email);
    // Coletando regras
    $data = $sumario->getFormatedContent($conn);
    $QRCODE_ADDRESS = "https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=$QRCODE_LINK&choe=UTF-8";
    $QRCODE_DST = "imgs/qrcode/$sumario->hashcode.png";
    copy($QRCODE_ADDRESS, $QRCODE_DST);
    // Iniciando captura no Buffer
    ob_start();
    include "incl/layouts/sumario.php";
    // Salvando HTML
    $html = ob_get_contents();
    // Encerrando Buffer
    ob_end_clean();
    // echo $html;
    // Carregando o HTML no PDF
    $dPDF->set_option('isHtml5ParserEnabled', true);
    $dPDF->loadHtml($html);
    // Definindo papel e orientação
    $dPDF->setPaper('A4', 'portrait');
    // Renderizando o HTML como PDF
    $dPDF->render();
    $dPDF->stream();
    unlink($QRCODE_DST);
  }



 ?>
