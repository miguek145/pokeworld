<?php

require_once "../model/pokemon.php";
require_once "../model/usuarios.php";

$titulo="MAIN PAGE";
require_once "../view/templates/declaracion.php";

    //comprobamos que están los datos de la API almacenados en la base de datos
    Pokemon::addApi();

//comprobamos que la sesión esté iniciada
if(isset($_SESSION['usuario'])){
    $imagen=Usuarios::comprobarUsuarioLogoneadoTieneFoto($_SESSION['usuario']);

    /*obtenemos todos los datos de los pokemons para visualizar la tabla de tarjetas de los pokemons y compruebo si se ha inciado  sesión con el usuario tipo cliente
    para así poder visualizar los iconos para añadir los pokemons a la sección de favoritos*/
    $arrayDatosPokemons=Pokemon::visualizarTablaPokemons($_SESSION['usuario'],$_SESSION['tipoUsuario']);
}else{
   //obtenemos todos los datos de los pokemons para viusalizar la tabla tarjetas de los pokemons pero sin el icono de añadir a favoritos ya que no se ha iniciado sesión
   $arrayDatosPokemons=Pokemon::visualizarTablaPokemons("","");
}

require_once "../view/templates/barraNavegacion.php";

//obtenemos los datos para los selects del filtro de búsqueda para los pokemonms    
$arrayHabitats=Pokemon::visualizarSelectHabitat();
$arrayTipos=Pokemon::visualizarSelectTipo();

require_once "../view/indexV.php";
require_once "../view/templates/cierre.php";
?>
