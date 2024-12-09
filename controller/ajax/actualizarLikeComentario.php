<?php
require_once "../../model/foro.php";
session_start();

//llamamos al método para actualizar el like del comentario
$resultado=Foro::actualizarLikeComentario($_SESSION['usuario'],$_GET['datos'][0],$_GET['datos'][1]);


 // aseguramos que el contenido que se va aenviar al archivo de javascript sea un json
header('Content-Type: application/json');
echo json_encode($resultado);
?>