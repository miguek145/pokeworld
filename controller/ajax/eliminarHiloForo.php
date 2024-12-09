<?php
    require_once "../../model/foro.php";

    $nombreHilo=$_GET['nombreHilo'];


    //método para eliminar el hilo y lo hace el ususario administrador
    $comprobacionHiloEliminado=Foro::eliminarHilo($nombreHilo);

    echo $comprobacionHiloEliminado;

?>