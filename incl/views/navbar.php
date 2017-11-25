<head>
  <link rel="stylesheet" href="css/navbar.css">
</head>

<?php
  $menu_itens = array();
  if(isset($_SESSION['privilegios'])){
    $privilegios = $_SESSION['privilegios'];
    $menu_map = [
      "pesquisador" => "<a href='painel.php'>Painel do Pesquisador</a>",
      "validador" => "<a href='painel_validador.php'>Painel do Validador</a>",
      "gerenciador" => "<a href='painel_instituicao.php'>Painel do Instituto</a>"
    ];
    foreach ($privilegios as $k => $v){
      if($v)
        array_push($menu_itens, $menu_map[$k]);
    }

    array_push($menu_itens, "<a href='editais.php'>Editais</a>");
    array_push($menu_itens, "<a href='#' id='desconectar'>Desconectar</a>");
  }
 ?>
 <nav <?= isset($navbar_relative) ? "class='relative'" : "" ?>>
   <?php if(!$email): ?>
     <a href="login.php">
       <i class="sign in icon"></i> Login
     </a>
     <a href="cadastrar.php">
       <i class="add user icon"></i> Cadastrar-se
     </a>
  <?php
    else:
        foreach ($menu_itens as $item) {
          echo $item;
        }
    endif;
  ?>
  <a href="index.php" style='float: left; position: absolute; top: 0.7em; left: 1em'>SAGA</a>
  <div style='clear: both'></div>
</nav>
