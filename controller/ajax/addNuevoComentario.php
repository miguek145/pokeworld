<?php
//funciona para validar datos formularios y para no sufrir ataques XSS
$validarDatos = fn($dato) => htmlspecialchars(stripslashes(trim($dato)));


//validamos el contenido del comentario para evitar ataques XSS
$contenidoComentarioValidado=$validarDatos($_GET['datos'][0]);


session_start();

require_once "../../model/foro.php";

//obtenemos los comentarios a través de este método
$resultado=Foro::addComentario($_SESSION['usuario'],$_GET['datos'][1],$contenidoComentarioValidado);
echo $resultado;
    
    

    //visualizamos el contenido del último comentario
    // if(is_array($resultado)){
    //     $numeroTotalComentarios=count($resultado);

    //     $contadorObtenerUltimoComentario=--$numeroTotalComentarios;

    //     $contadorComentarios=0;
    //     foreach($resultado as $valor){
    //         if($contadorComentarios==$contadorObtenerUltimoComentario){
          
    //                 echo '<div class="contenedorDatosUsuarioComentario">';
    //                     if(empty($valor['imagenUsuario'])){
    //                         echo '<i class="fa-solid fa-user"></i>';
    //                     }else{
    //                         echo '<img src="data:' . $valor['tipoMimeImagen'] . ';base64,' . base64_encode($valor['imagenUsuario']) . '" width="80"/>';
    //                     }
    //                     echo '<h6>Name:'.$valor['usuario'].'</h6>';
    //                 echo '</div>';
    //                 echo '<div class="contenedorContenidoComentario">';
    //                     echo '<p>'. $valor['contenidoComentario'].'</p>';
    //                     echo "<div>";
    //                         echo '<i class="fa-solid fa-thumbs-up"></i>';
    //                         echo '<h5>'.$valor['puntuacion'].'</h5>';
    //                         if($_SESSION['tipoUsuario']=="administrador"){
    //                             echo"<button class='botonDeleteComentario'>DELETE</button>";
    //                         }
    //                     echo "</div>";
    //                 echo '</div>';
              
    //         }
    //         ++$contadorComentarios;     
    //     }
    // }else{
    //     echo $resultado;
    // }
    
?>