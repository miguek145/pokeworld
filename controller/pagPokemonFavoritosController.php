<?php

require_once "../model/pokemon.php";
require_once "../model/usuarios.php";

require_once "../view/templates/declaracion.php";

if(!isset($_SESSION['usuario'])){
    header('Location:indexController.php');
    session_destroy();
    exit();
}


if(isset($_SESSION['usuario'])){
  $imagen=Usuarios::comprobarUsuarioLogoneadoTieneFoto($_SESSION['usuario']);
}

require_once "../view/templates/barraNavegacion.php";


    //visualizar tabla pokemon
    $arrayDatosPokemons=Pokemon:: visualizarTablaPokemonFavoritos($_SESSION['usuario'],$_SESSION['tipoUsuario']);
    

    require_once "../view/paginaPokemonsFavoritosV.php";
    require_once "../view/templates/cierre.php";


?>