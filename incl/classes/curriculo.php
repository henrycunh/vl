<?php
  class Curriculo{

    // Pegar um curriculo a partir de um email
    public static function getCurriculoByEmail($conn, $email){
      $result = $conn->query("SELECT curriculoId FROM curriculo
        WHERE email = '$email'")->fetch(PDO::FETCH_ASSOC);
      return $result;
    }

  }


 ?>
