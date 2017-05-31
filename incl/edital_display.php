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
      <th>#</th>
      <th>Nome do Edital</th>
      <th>Data de Vigência</th>
      <th>Descrição</th>
    </tr>
    <?php
      $editais = $conn->query("SELECT * FROM edital")->fetchAll(PDO::FETCH_ASSOC);
      foreach ($editais as $edital):
    ?>
      <tr>
        <td style='max-width: 60px'>
          <a class='ui button mini labeled positive compact icon' href="editarEdital.php?num=<?= $edital['numero'] ?>">
            <i class='edit icon'></i>
            <?= $edital['numero'] ?></td>
          </a>
        <td><?= $edital['nome'] ?></td>
        <td><?= $edital['vigencia'] ?></td>
        <td><?= ($edital['descricao'] ? $edital['descricao'] : "-") ?></td>
      </tr>
    <?php
      endforeach;
     ?>
  </table>
</div>
