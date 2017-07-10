<style media="screen">
  @import url('https://fonts.googleapis.com/css?family=Slabo+27px');
  *{
    font-family: 'Slabo 27px', serif;
    font-size: 12px;
  }
  th, td{
    padding: 0.5em 1em;
    border: 1px solid #666;
    text-align: center;
  }
  table{
    border-collapse: collapse;
    display: table;
    border: 2px solid #000;
  }
</style>
<table>
  <tr>
    <th>Tipo de Produção</th>
    <th>Pontuação Individual</th>
    <th>Pontuação Máxima</th>
  </tr>
  <?php foreach ($rules as $regra): ?>
    <tr>
      <td style='text-align: left'><?= $regra['label'] ?></td>
      <td><?= $regra['ptInd'] ?></td>
      <td><?= $regra['ptMax'] ?></td>
    </tr>
  <?php endforeach; ?>
</table>
