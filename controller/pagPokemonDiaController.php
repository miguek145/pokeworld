<?php

require_once "../view/templates/declaracion.php";
require_once "../view/templates/barraNavegacion.php";
require_once "../model/pokemon.php";

if(isset($_COOKIE['cookiesAceptadas'])){
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

        //duración 24 horas
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