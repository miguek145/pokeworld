<?php

    $titulo="POKEMON INFO";
    require_once "../view/templates/declaracion.php";
    require_once "../model/pokemon.php";
    require_once "../model/usuarios.php";

    //comprobamos que el usuario haya iniciado sesión
    if(isset($_SESSION['usuario'])){

      //comprobamos si el usuario tiene una imagen suya para visualizarla en la abrra de navegación
      $imagen=Usuarios::comprobarUsuarioLogoneadoTieneFoto($_SESSION['usuario']);
    }   
    require_once "../view/templates/barraNavegacion.php";
 
    if(isset($_GET['accion'])){

      //comprobamos los stats del pokemon para ver si están actualizados y si no los actualizamos
      Pokemon:: comprobarStatsPokemonApi($_GET['nombrePokemon']);

      //visualizamos la información del pokemon seleccionado
      $objeto=new Pokemon;
      $arrayTodosDatosPokemon=$objeto->visualizarDatosPokemon($_GET['nombrePokemon']);

    }

    require_once "../view/infoPokemonV.php";
    require_once "../view/templates/cierre.php";
?>