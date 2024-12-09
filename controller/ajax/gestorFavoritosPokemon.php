<?php
require_once "../../model/usuarios.php";
require_once "../../model/usuarioCliente.php";
session_start();
$_GET['nombrePokemonn'];

$objeto=new UsuarioCliente($_SESSION['usuario']);

//añadimos el pokemon a favoritos por el usuario de tipo cliente 
$resultado=$objeto->addPokemonFavoritos($_GET['nombrePokemonn']);
echo $resultado;







?>