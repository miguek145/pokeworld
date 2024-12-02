<?php

require_once "../../model/foro.php";


$nombreHilo=$_GET['datos'][0];
$contenidoComentario=$_GET['datos'][1];


$resultado=foro::eliminarComentarioAdministrador($nombreHilo,$contenidoComentario);

echo $resultado;

?>