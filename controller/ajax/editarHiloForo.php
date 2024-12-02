<?php
//funciona para validar datos formularios y para no sufrir ataques XSS
$validarDatos = fn($dato) => htmlspecialchars(stripslashes(trim($dato)));

require_once "../../model/foro.php";

$datosHilo=$_GET['datosHilo'];

$nombreHiloAntiguo=$datosHilo[0];
$nombreHiloNuevo=$datosHilo[1];

$nombreHiloNuevoValidado=$validarDatos($nombreHiloNuevo);


$resultado=Foro::actualizarHilos($nombreHiloAntiguo,$nombreHiloNuevoValidado);

echo $resultado;

?>