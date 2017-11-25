<?php
  // Setting header content
  header("Content-type: application/json");
  // Starting session
  session_start();
  // Requiring User Class
  require '../incl/classes/usuario.php';
  require '../incl/classes/curriculo.php';
  require '../incl/classes/edital.php';
  require '../incl/classes/regra.php';
  require '../incl/classes/sumario.php';
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
      $pontMax = $data['pontMax'];
      $descricao = $data['descricao'];
      $SQL = "UPDATE edital SET numero='$num', nome='$nome', vigencia='$vig', descricao='$descricao', pontMax=$pontMax WHERE numero='$oldNum'";
      $query = $conn->query($SQL);
      if($query){
        echo json_encode(['success' => true, 'num' => $num]);
      } else {
        echo json_encode(['success' => false, 'erro' => $conn->errorInfo()]);
      }
    }

    if($data['op'] == 'edital/pdf/session'){
      $num = $data['num'];
      $_SESSION['pdfnum'] = $num;
      echo json_encode([
        "success" => true,
        "num" => $num
      ]);
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

    if($data['op'] == 'sumario/criar'){
      $cId = Curriculo::getIDByEmail($conn, $_SESSION["email"]);
      $numero = $data['numero'];
      $edId = $conn->query("SELECT idEdital FROM edital WHERE numero = '$numero'")->fetch(PDO::FETCH_ASSOC)["idEdital"];
      $found = Sumario::checkSumario($cId, $edId, $conn);
      if(!$found){
        $sumario = Sumario::generateSumario($cId, $edId, $conn);
        $status = $sumario->insertIntoDB($conn);
        if($status){
          echo json_encode(["success" => true]);
        } else {
          echo json_encode(["success" => false, "error" => "INSERT_ERROR"]);
        }
      } else {
        echo json_encode(["success" => false, "error"=>"SUMARIO_FOUND"]);
      }
    }

    if($data['op'] == 'edital/importar'){
      $numero_atual = $data['numero_atual'];
      $numero_ref = $data['numero_ref'];
      $stmt = $conn->prepare("INSERT INTO regra(ptInd, ptMax, content, ic, idEdital) SELECT ptInd, ptMax, content, ic, :numero_atual FROM regra WHERE idEdital = :numero_ref");
      $query = $stmt->execute([
          ":numero_atual" => $numero_atual,
          ":numero_ref"   => $numero_ref
      ]);
      if($query){
        echo json_encode(['success' => true, 'data' => $stmt]);
      } else {
        echo json_encode(['success' => false, 'error'=>$conn->errorInfo()]);
      }
    }
  }




 ?>
