<?php
//funciona para validar datos formularios y para no sufrir ataques XSS
$validarDatos = fn($dato) => htmlspecialchars(stripslashes(trim($dato)));

require_once "../../model/foro.php";

//validamos el nuevo hilo para evitar ataques XSS
$nombreHiloValidado=$validarDatos($_GET['nombreHilo']);

//método para añadir el nuevo hilo
$resultado=Foro::addHilo($nombreHiloValidado);

echo $resultado;
?>