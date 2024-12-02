<?php
 
    require_once "../view/templates/declaracion.php";
    require_once "../model/pokemon.php";
    require_once "../model/usuarios.php";
    if(isset($_SESSION['usuario'])){
      $imagen=Usuarios::comprobarUsuarioLogoneadoTieneFoto($_SESSION['usuario']);
    }
   
    require_once "../view/templates/barraNavegacion.php";


 
    if(isset($_GET['accion'])){
        $objeto=new Pokemon;
        $arrayTodosDatosPokemon=$objeto->visualizarDatosPokemon($_GET['nombrePokemon']);

        
    }



    require_once "../view/infoPokemonV.php";
    require_once "../view/templates/cierre.php";



?>