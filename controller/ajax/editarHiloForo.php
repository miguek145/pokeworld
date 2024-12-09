<?php
//funciona para validar datos formularios y para no sufrir ataques XSS
$validarDatos = fn($dato) => htmlspecialchars(stripslashes(trim($dato)));

require_once "../../model/foro.php";

$datosHilo=$_GET['datosHilo'];

$nombreHiloAntiguo=$datosHilo[0];
$nombreHiloNuevo=$datosHilo[1];

//validamos los datos para prevenir ataques XSS
$nombreHiloNuevoValidado=$validarDatos($nombreHiloNuevo);

//método para actualizar el contenido del hilo y lo hace el usuario administrador
$resultado=Foro::actualizarHilos($nombreHiloAntiguo,$nombreHiloNuevoValidado);

echo $resultado;

?>