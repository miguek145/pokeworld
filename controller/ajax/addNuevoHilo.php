<?php
//funciona para validar datos formularios y para no sufrir ataques XSS
$validarDatos = fn($dato) => htmlspecialchars(stripslashes(trim($dato)));

require_once "../../model/foro.php";

$nombreHiloValidado=$validarDatos($_GET['nombreHilo']);

    $resultado=Foro::addHilo($nombreHiloValidado);

echo $resultado;
?>