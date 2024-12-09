<?php
   
    require_once "../../model/pokemon.php";

    //a través de este método obtendremos los datos de las cookies
    $resultadoBusqueda=Pokemon::obtenerNombrePokemonAlmacenarCookie($_GET['valorBuscadorPokemon']);

    echo $resultadoBusqueda;
?>
