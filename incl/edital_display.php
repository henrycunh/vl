<div class="ui segment secondary">
  <div class="ui form">
    <div class="fields">
      <div class="three wide field">
        <label>Número do Edital</label>
        <input type="text" id='numEdital'>
      </div>
      <div class="six wide field">
        <label>Nome do Edital</label>
        <input type="text" id='nomeEdital'>
      </div>
      <div class="four wide field">
        <label>Data de Vigência</label>
        <div class="ui input">
          <input type="date" id='vigEdital'>
        </div>
      </div>
      <div class="three wide field">
        <label style="color: transparent">-</label>
        <button onclick='criarEdital()' id='criarEditalBtn' class='ui button labeled icon positive'>
          <i class='add icon'></i>
          Criar Edital
        </button>
      </div>
    </div>
  </div>
</div>

<div class="ui segment">
  <table class='ui table celled padded' id='editaisTable'>
    <tr>
      <th style='width: 20%'>Número do Edital</th>
      <th style='width: 30%'>Nome do Edital</th>
      <th style='width: 10%'>Data de Vigência</th>
      <th style='width: 30%'>Descrição</th>
      <th style='width: 10%'>Ação</th>
    </tr>
    <?php
      $editais = $conn->query("SELECT * FROM edital")->fetchAll(PDO::FETCH_ASSOC);
      foreach ($editais as $edital):
    ?>
      <tr>
        <td style='max-width: 60px'>
          <a href="editar_edital.php?id=<?= $edital['idEdital'] ?>">
            <i class='edit icon'></i>
            <?= $edital['numero'] ?></td>
          </a>
        <td><?= $edital['nome'] ?></td>
        <td><?= date("d/m/Y", strtotime($edital['vigencia'])) ?></td>
        <td class='limit-lines'><?= ($edital['descricao'] ? $edital['descricao'] : "-") ?></td>
        <td><a href="#" onclick="excluirEdital(<?= $edital['idEdital'] ?>)" class="ui button negative">Excluir</a></td>
      </tr>
    <?php
      endforeach;
     ?>
  </table>
</div>
