<?php
    require_once "../model/foro.php";
    require_once "../model/usuarios.php";
    require_once "../view/templates/declaracion.php";

 // Comprobar si la sesión está iniciada
if (!isset($_SESSION['usuario'])) {
    session_destroy();
    header('Location:indexController.php');
    exit();
}

// Inicializar la clave 'time' si no existe
if (!isset($_SESSION['time'])) {
    $_SESSION['time'] = time(); // Establecer el tiempo actual como inicial
}

// Verificar tiempo de inactividad
if ((time() - $_SESSION['time']) > 1200) {
    session_unset();
    session_destroy();
    header('Location:indexController.php');
    exit();
}

    
    $imagen=Usuarios::comprobarUsuarioLogoneadoTieneFoto($_SESSION['usuario']);

    require_once "../view/templates/barraNavegacion.php";

  
    $arrayComentariosUsuario=foro::visualizarComentariosPropios($_SESSION['usuario']);

 
    

    require_once "../view/editComentariosV.php";
    require_once "../view/templates/cierre.php";

?>