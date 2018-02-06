<?php
// Define o tipo de conteúdo no header
header("Content-type: application/json");
// Continua a sessão
session_start();
// Importando classes necesśarias
require '../incl/classes/usuario.php';
require '../incl/classes/curriculo.php';
// Conexão com o DB
require_once '../incl/database.php';

// Verificando se foi enviado um request
if(!empty($_POST)):
  // Repassando as informações para uma váriavel simples
  $data = $_POST;

  /**
  * curriculo/ Retorna um currículo a partir do email
  *
  * @param string email Email do usuário
  * @return JSON Informações do usuário
  */
  if($data['op'] == 'curriculo/'){
    $email = $data['email'];
    echo json_encode(Curriculo::getCurriculoByEmail($conn, $email));
  }

  /**
   * curriculo/comprovante Define o nome do arquivo na sessão
   *
   * @param string filename Nome do arquivo
   * @return JSON Se a operação deu certo
   */
  if($data['op'] == 'curriculo/comprovante'){
    $filename = $data['filename'];
    $_SESSION['filename'] = $filename;
    echo json_encode(['success' => true]);
  }


  /**
   * curriculo/deletar*/
  if($data['op'] == 'curriculo/deletar'){
    $curriculo = Curriculo::getCurriculoByEmail($conn, $_SESSION['email']);
    $curriculo->deleteICs($conn);
    $curriculo->deleteCurriculo($conn);
    // Apagar comprovantes
    echo "id = $curriculo->curriculoId";
    deleteFiles($curriculo->curriculoId);
  }

  if($data['op'] == 'curriculo/ic/validar'){
    $ic = $data['ic'];
    $curriculoId = $data['curriculoId'];
    $icId = $data['icId'];
    $state = $data['state'];
    $date = $data['date'];
    $emailVal = $data['emailVal'];
    $SQL = "UPDATE ic_$ic SET validado = $state, dataValidacao='$date', emailValidador='$emailVal' WHERE id".ucfirst($ic)." = $icId";
    $query = $conn->query($SQL);
    if($query){
      echo json_encode(["success"=>true]);
    } else {
      echo json_encode(["success"=>false, "error"=>$conn->errorInfo()]);
    }
  }

  if($data['op'] == 'curriculo/ic/extrato'){
      $idArtigo = $data['idArtigo'];
      $extrato = $data['extrato'];
      $stmt = $conn->prepare("UPDATE ic_artigo SET extrato = :extrato WHERE idArtigo = :idArtigo");
      $query = $stmt->execute([
        ":extrato"  => $extrato,
        ":idArtigo" => $idArtigo
      ]);
      if($query){
        echo json_encode(["success"=>true]);
      } else {
        echo json_encode(["success"=>false, "error"=>$conn->errorInfo()]);
      }
  }

  if($data['op'] == 'curriculo/ic/partpos'){
    $atuacao = $data['atuacao'];
    $ingresso = $data['ingresso'];
    $programa = $data['programa'];
    $currId = $data['currId'];
    $stmt = $conn->prepare("INSERT INTO ic_partpos(curriculoId,atuacao,ingresso,programa) VALUES(:curriculoId,:atuacao, :ingresso, :programa)");
    $query = $stmt->execute([
      ":curriculoId"   => $currId,
      ":atuacao"  => $atuacao,
      ":ingresso" => $ingresso,
      ":programa" => $programa
    ]);
    if($query){
      echo json_encode(["success"=>true]);
    } else {
      echo json_encode(["success"=>false, "error"=>$stmt->errorInfo()]);
    }
  }

  if($data['op'] == 'curriculo/ic/partpos/deletar'){
    $id = $data['id'];
    $stmt = $conn->prepare("DELETE FROM ic_partPos WHERE idPartPos = :id");
    $query = $stmt->execute([ ":id" => $id ]);
    if($query){
      echo json_encode(["success"=>true]);
    } else {
      echo json_encode(["success"=>false, "error"=>$stmt->errorInfo()]);
    }
  }






endif;

function deleteFiles($currId){
  $id = str_pad($currId, 5, "0", STR_PAD_LEFT);
  $files = array_diff(scandir('../uploads/comprovantes/'), array('.', '..'));
  $matches = preg_grep("/$id.{0,}/", $files);
  $matches = preg_filter('/^/', '../uploads/comprovantes/', $matches);
  var_dump($matches);
  array_map('unlink', $matches);
}

 ?>
