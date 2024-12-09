<?php

$titulo="POKEMON OF THE DAY";
require_once "../view/templates/declaracion.php";
require_once "../view/templates/barraNavegacion.php";
require_once "../model/pokemon.php";

//comprobamos si se habían aceptado el uso de  cookies
if(isset($_COOKIE['cookiesAceptadas'])){

    //si se aceptaron se comprobaran si existen las cookies del pokemon del día y si no se crearán
    if($_COOKIE['cookiesAceptadas']=="aceptadasCookie"){

        $comprobamosExistenciaCookies=true;

        if(!isset($_COOKIE['nombrePokemonDia'])){
    
            $comprobamosExistenciaCookies=false;
        }
    
        if(!isset($_COOKIE['imagenPokemonDia'])){
    
            $comprobamosExistenciaCookies=false;
        }
    


        if($comprobamosExistenciaCookies==false){

        $arrayDatosPokemonDia=Pokemon::obtenerDatosPokemondia();

        //duración cookies 24 horas
        $expiracion = time() + (24 * 60 * 60); 
        setcookie("nombrePokemonDia",$arrayDatosPokemonDia[0],$expiracion,"/");
        setcookie("imagenPokemonDia",$arrayDatosPokemonDia[1],$expiracion,"/");
        header('Location:pagPokemonDiaController.php');

        }

    }else{
        $comprobamosExistenciaCookies=false;

        if(isset($_COOKIE['nombrePokemonDia'])){
    
            $comprobamosExistenciaCookies=true;
        }
    
        if(isset($_COOKIE['imagenPokemonDia'])){
    
            $comprobamosExistenciaCookies=true;
        }
    
        //si las cookies de pokemon del día existen pues se eliminaraán y se actualizará la página diciendo que no hay pokemon del día
        if($comprobamosExistenciaCookies==true){
            setcookie("nombrePokemonDia","",time()-10000000,"/");
            setcookie("imagenPokemonDia","",time()-10000000,"/");
            header('Location:pagPokemonDiaController.php');
        }
    }
}

require_once "../view/pagPokemonDiaV.php";
require_once "../view/templates/cierre.php";
?>