<?php
    require_once "../model/usuarios.php";
    require_once "../model/foro.php";
    require_once "../view/templates/declaracion.php";
   
        if(isset($_SESSION['usuario'])){
            $imagen=Usuarios::comprobarUsuarioLogoneadoTieneFoto($_SESSION['usuario']);
        }

        require_once "../view/templates/barraNavegacion.php";
       
    
        //creamos este objeto para visualizar el nombre del hilo
        $objetoHilo=new Foro($_GET['hilo']);
        $nombreHilo=$objetoHilo->__toString();
       
        if(isset($_SESSION['usuario'])){
          
            $arrayComentarios=Foro::visualizarComentariosForo($_SESSION['usuario'],$_GET['hilo']);
        }else{
           
            $arrayComentarios=Foro::visualizarComentariosForo("",$_GET['hilo']);

        }
      
    
    require_once "../view/comentariosV.php";
    require_once "../view/templates/cierre.php";

?>