<?php
   
    require_once "../../model/pokemon.php";
    $resultadoBusqueda=Pokemon::obtenerNombrePokemonAlmacenarCookie($_GET['valorBuscadorPokemon']);

    echo $resultadoBusqueda;
?>
