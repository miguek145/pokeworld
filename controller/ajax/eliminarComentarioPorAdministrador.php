<?php

require_once "../../model/foro.php";


$nombreHilo=$_GET['datos'][0];
$contenidoComentario=$_GET['datos'][1];

//método que elimina el comentario por el admin, además si en el mismo hilo  hay más comentarios iguales, estos también serán eliminados
$resultado=foro::eliminarComentarioAdministrador($nombreHilo,$contenidoComentario);

echo $resultado;

?>