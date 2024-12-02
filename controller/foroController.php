<?php
require_once "../model/foro.php";
require_once "../model/usuarios.php";

require_once "../view/templates/declaracion.php";

if(isset($_SESSION['usuario'])){
    $imagen=Usuarios::comprobarUsuarioLogoneadoTieneFoto($_SESSION['usuario']);
  }

require_once "../view/templates/barraNavegacion.php";




    $arrayNombresHilos=Foro::visualizarHilos();


   
    require_once "../view/foroV.php";

require_once "../view/templates/cierre.php";
?>