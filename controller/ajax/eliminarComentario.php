<?php

session_start();

require_once "../../model/foro.php";


$idComentario=$_GET['datos'][0];
$contenidoNuevoComentario=$_GET['datos'][1];
$nombreHilo=$_GET['datos'][2];

//eliminamos el comentario seleccionado
foro::eliminarComentario($idComentario,$_SESSION['usuario'],$nombreHilo);

    //visualizamos la lista de comentarios actualizada
    $arrayComentariosUsuario=foro::visualizarComentariosPropios($_SESSION['usuario']);

    if(is_array($arrayComentariosUsuario)){
            
        foreach($arrayComentariosUsuario as $valor){
        
            echo '<section class="contenedorComentarioEditar">';
                echo '<div>';
                    echo '<h5>NAME THEME:'.$valor['nombreHilo'].'</h5>';
                    echo '<textarea name="contenidoComentarioUsuario" >'.$valor['contenidoComentario'].'</textarea>';
                    echo '<p>LIKES:'.$valor['puntuacion'].'</p>';
                echo '</div>';
                echo '<div>';
                    echo '<button>EDIT</button>';
                    echo '<button>DELETE</button>';
                echo '</div>';
            echo '</section>';
        
            
        }
    }else{
        echo $arrayComentariosUsuario;
    }




?>