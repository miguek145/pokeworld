<?php

require_once "../model/pokemon.php";
require_once "../model/usuarios.php";

require_once "../view/templates/declaracion.php";

    //comprobamos que están los datos de la API almacenados en la base de datos
    Pokemon::addApi();


if(isset($_SESSION['usuario'])){
    $imagen=Usuarios::comprobarUsuarioLogoneadoTieneFoto($_SESSION['usuario']);

    //visualizar tabla pokemon
    $arrayDatosPokemons=Pokemon::visualizarTablaPokemons($_SESSION['usuario'],$_SESSION['tipoUsuario']);
}else{
   //visualizar tabla pokemon
   $arrayDatosPokemons=Pokemon::visualizarTablaPokemons("","");
}

require_once "../view/templates/barraNavegacion.php";



    
    $arrayHabitats=Pokemon::visualizarSelectHabitat();
    $arrayTipos=Pokemon::visualizarSelectTipo();
    require_once "../view/indexV.php";
    
    require_once "../view/templates/cierre.php";
?>
