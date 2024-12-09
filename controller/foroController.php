<?php
  require_once "../model/foro.php";
  require_once "../model/usuarios.php";

  $titulo="FORUM PAGE";
  require_once "../view/templates/declaracion.php";

  //comprobamos si el usuario ha iniciado sesión y si tiene una foto propia pues que se visualice en la abrra de navegación
  if(isset($_SESSION['usuario'])){
      $imagen=Usuarios::comprobarUsuarioLogoneadoTieneFoto($_SESSION['usuario']);
    }

  require_once "../view/templates/barraNavegacion.php";

  //visualizamos los hilos del foro
  $arrayNombresHilos=Foro::visualizarHilos();
    
  require_once "../view/foroV.php";
  require_once "../view/templates/cierre.php";
?>