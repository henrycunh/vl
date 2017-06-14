<?php
  // Setting header content
  header("Content-type: application/json");
  // Starting session
  session_start();
  // Requiring User Class
  require '../incl/classes/usuario.php';
  // Requiring DB
  require_once '../incl/database.php';

  if(!empty($_POST)){
    $data = $_POST;

    if($data['op'] == 'edital/criar'){
      $num = $data['num'];
      $nome = $data['nome'];
      $vig = $data['vig'];
      $dataCriacao = date("Y-m-d");
      $SQL = "INSERT INTO edital(numero, nome, vigencia, dataCriacao) VALUES('$num', '$nome', '$vig', '$dataCriacao')";
      $query = $conn->query($SQL);
      if($query){
        echo json_encode(['success' => true]);
      } else {
        echo json_encode(['success' => false, 'erro' => $conn->errorInfo()]);
      }
    }

    if($data['op'] == 'edital/alterar'){
      $num = $data['num'];
      $nome = $data['nome'];
      $vig = $data['vigencia'];
      $oldNum = $data['oldNum'];
      $descricao = $data['descricao'];
      $SQL = "UPDATE edital SET numero='$num', nome='$nome', vigencia='$vig', descricao='$descricao' WHERE numero='$oldNum'";
      $query = $conn->query($SQL);
      if($query){
        echo json_encode(['success' => true]);
      } else {
        echo json_encode(['success' => false, 'erro' => $conn->errorInfo()]);
      }
    }

    if($data['op'] == 'edital/pdf/session'){
      $num = $data['num'];
      $_SESSION['pdfnum'] = $num;
      echo json_encode(['success' => true]);
    }

    if($data['op'] == 'edital/regras'){
      $id = $data['idEdital'];
      $regras = $conn->query("SELECT * FROM regra WHERE idEdital = $id")->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($regras);
    }

    if($data['op'] == 'edital/regras/criar'){
      $id = $data['idEdital'];
      $ptInd = $data['ptInd'];
      $ptMax = $data['ptMax'];
      $content = $data['content'];
      $ic = $data['ic'];
      $SQL = "INSERT INTO regra(idEdital, ptInd, ptMax, content, ic) VALUES ($id, $ptInd, $ptMax, '$content', '$ic')";
      $query = $conn->query($SQL);
      
      if($query){
        echo json_encode(['success' => true, 'id' => $conn->lastInsertId()]);
      } else {
        echo json_encode(['success' => false, 'error'=>$conn->errorInfo()]);
      }
    }

    if($data['op'] == 'edital/regras/deletar'){
      $idRegra = $data['idRegra'];
      $query = $conn->query("DELETE FROM regra WHERE idRegra = $idRegra");
      if($query){
        echo json_encode(['success' => true]);
      } else {
        echo json_encode(['success' => false, 'error'=>$conn->errorInfo()]);
      }
    }
  }




 ?>
