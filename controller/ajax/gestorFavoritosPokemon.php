<?php
require_once "../../model/usuarios.php";
session_start();
$_GET['nombrePokemonn'];

$objeto=new UsuarioCliente($_SESSION['usuario']);
$resultado=$objeto->addPokemonFavoritos($_GET['nombrePokemonn']);
echo $resultado;







?>