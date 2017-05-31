<?php
session_start();
require 'incl/classes/curriculo.php';
require 'incl/classes/usuario.php';
require 'incl/database.php';

$usuario = Usuario::selectByEmail($conn,$_SESSION['email']);
var_dump($usuario->getPrivilegios($conn));
 ?>
