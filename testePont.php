<?php
  session_start();
  require 'incl/classes/curriculo.php';
  require 'incl/classes/usuario.php';
  require 'incl/classes/regra.php';
  require 'incl/classes/edital.php';
  require 'incl/classes/sumario.php';
  require 'incl/database.php';

  $sumario = Sumario::generateSumario(9, 1, $conn);
  $data = $sumario->getFormatedContent();
  // echo "<pre>".json_encode($sumario->content, JSON_PRETTY_PRINT)."</pre>";

?>
<style media="screen">
  th, td{
    padding: 0.5em 1em;
  }
</style>
<table border='1' style='width: 80%; margin: 0 auto; display: block'>
  <tr>
    <th style='width: 90%'>Tipo de Produção</th>
    <th style='width: 5%'>Pontos Obtidos</th>
    <th style='width: 5%'>Pontuação Máxima</th>
  </tr>
  <?php foreach ($data as $ic): ?>
    <tr>
      <td> <?=$ic["label"]?> </td>
      <td style='text-align: center'> <?=$ic["pt"]?> </td>
      <td style='text-align: center'> <?=$ic["ptMax"]?> </td>
    </tr>
  <?php endforeach; ?>
</table>
