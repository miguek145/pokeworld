<?php

require_once "../model/pokemon.php";
require_once "../model/usuarios.php";
require_once "../model/usuarioCliente.php";

$titulo="FAV POKEMONS";
require_once "../view/templates/declaracion.php";

//comprobamos que el usuario no haya iniciado sesión
if(!isset($_SESSION['usuario'])){
    header('Location:indexController.php');
    session_destroy();
    exit();
}else{

  //si el usuario ha iniciado sesión se comprobará si el usuario tiene una foto de perfil para que se pueda visualizar en la barra de mavegación
  $imagen=Usuarios::comprobarUsuarioLogoneadoTieneFoto($_SESSION['usuario']);
}

require_once "../view/templates/barraNavegacion.php";


    //visualizar tabla pokemon
    $arrayDatosPokemons=Pokemon:: visualizarTablaPokemonFavoritos($_SESSION['usuario'],$_SESSION['tipoUsuario']);
    

    require_once "../view/paginaPokemonsFavoritosV.php";
    require_once "../view/templates/cierre.php";


?>