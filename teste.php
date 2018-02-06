<?php
  require 'incl/classes/usuario.php';
  require 'incl/database.php';
  require 'incl/classes/edital.php';
  require 'incl/classes/regra.php';
  require 'incl/classes/sumario.php';
  require 'incl/classes/curriculo.php';

  $curriculo = Curriculo::getCurriculoByEmail( $conn, 'henriquecunhawd@gmail.com' );
  $edital    = Edital::selectById( $conn, 9 ); 
  $regras    = $edital->selectRegras( $conn );
  $sumario   = Sumario::generateSumario( $curriculo->curriculoId, 9, $conn );     
  var_dump($sumario->content['coordProj']);