<style media="screen">
@import url('https://fonts.googleapis.com/css?family=Slabo+27px');
*{
  font-family: 'Slabo 27px', serif;
  font-size: 14px;
}
th, td{
  padding: 0.5em 1em;
  border: 1px solid #666;
  text-align: center;
}
hr{
  border-width: 1px;
  border-color: #999;
  border-style: solid;
}
table{
  border-collapse: collapse;
  display: table;
  border: 2px solid #000;
}
.cnt{
  vertical-align: top;
  width: 37%;
  padding: 1em;
  display: inline-block;
}
</style>

<div class="cnt">
  <b>Nome Completo:</b> <?= $usuario->nomeCompleto ?>
  <hr>
  <b>Número do Edital:</b> <?= $edital->numero ?>
</div>
<div class="cnt">
  <b>Data de Pontuação:</b> <?= date("d/m/Y", strtotime($sumario->dataPont)) ?>
  <hr>
  <b>Data de Emissão:</b> <?= date("d/m/Y")?>
</div>
<table>
  <tr>
    <th>Tipo de Produção</th>
    <th>Pontos Obtidos</th>
    <th>Pontuação Máxima</th>
  </tr>
  <?php foreach ($data as $ic): ?>
    <tr>
      <td style='text-align: left'> <?=$ic["label"]?> </td>
      <td> <?=empty($ic["pt"]) ? "0" : $ic["pt"]?> </td>
      <td> <?=empty($ic["ptMax"]) ? "0" : ($ic["ptMax"] == "-1" ? "<b style='color:#777'>S.L</b>" : $ic["ptMax"])?> </td>
    </tr>
  <?php endforeach; ?>
</table>
<div class="cnt" style='text-align: center'>
  <img src="<?= $QRCODE_DST ?>" alt="">
</div>
<div class="cnt">
  <b>Pontuação Total:</b> <?= $sumario->pontTotal ?>
  <hr>
  <b>Assinatura Digital:</b> <?= $sumario->hashcode ?>
</div>
