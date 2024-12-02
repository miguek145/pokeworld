<?php
    require_once "../../model/foro.php";

    $nombreHilo=$_GET['nombreHilo'];



    $comprobacionHiloEliminado=Foro::eliminarHilo($nombreHilo);

    echo $comprobacionHiloEliminado;

?>