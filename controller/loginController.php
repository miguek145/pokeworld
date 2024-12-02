<?php

//funciona para validar datos formularios y para no sufrir ataques XSS
$validarDatos = fn($dato) => htmlspecialchars(stripslashes(trim($dato)));

require_once "../view/templates/declaracion.php";

    if(isset($_POST['submitLogin'])){

        require_once "../model/usuarios.php";
        //validamos datos formulario
        $usuarioSeguro=$validarDatos($_POST['username']);
        $contraseñaSegura=$validarDatos($_POST['password']);


        $objetoLogin=new Usuarios($usuarioSeguro);
        $objetoLogin->contraseña=$contraseñaSegura;
        $resultadoLogin=$objetoLogin->login();
        
       
    }

    require_once "../view/loginV.php";
    
?>