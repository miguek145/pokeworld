<?php
//funciona para validar datos formularios y para no sufrir ataques XSS
$validarDatos = fn($dato) => htmlspecialchars(stripslashes(trim($dato)));

session_start();

require_once "../../model/foro.php";


$idComentario=$_GET['datos'][0];
$contenidoNuevoComentario=$_GET['datos'][1];

//validamos el contenido del comentario para evitar ataques XSS
$contenidoNuevoComentarioValidado=$validarDatos($_GET['datos'][1]);

//llamamos al método para editar el comentario
foro::editarComentario($idComentario,$_SESSION['usuario'],$contenidoNuevoComentarioValidado);

?>