<?php
    require_once "../model/usuarios.php";
    require_once "../model/foro.php";

    $titulo="COMMENTS";
    require_once "../view/templates/declaracion.php";
   
    //comprobamos si se ha iniciado sesión
        if(isset($_SESSION['usuario'])){
            $imagen=Usuarios::comprobarUsuarioLogoneadoTieneFoto($_SESSION['usuario']);
        }

        require_once "../view/templates/barraNavegacion.php";
       
    
        //creamos este objeto para visualizar el nombre del hilo
        $objetoHilo=new Foro($_GET['hilo']);
        $nombreHilo=$objetoHilo->__toString();
       
        if(isset($_SESSION['usuario'])){
            
            //visaulizamos los comentarios con los botones de dar LIKE ya que se ha iniciado sesión
            $arrayComentarios=Foro::visualizarComentariosForo($_SESSION['usuario'],$_GET['hilo']);
        }else{
           
            $arrayComentarios=Foro::visualizarComentariosForo("",$_GET['hilo']);
            
        }
      
    
    require_once "../view/comentariosV.php";
    require_once "../view/templates/cierre.php";

?>