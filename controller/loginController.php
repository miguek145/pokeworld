<?php

    require_once "../model/usuarios.php";

    //función para validar datos formularios y para evitar ataques XSS
    $validarDatos = fn($dato) => htmlspecialchars(stripslashes(trim($dato)));

    $titulo="LOGIN PAGE";
    require_once "../view/templates/declaracion.php";

        if(isset($_POST['submitLogin'])){

            //validamos datos formulario para evitar ataques XSS
            $usuarioSeguro=$validarDatos($_POST['username']);
            $contraseñaSegura=$validarDatos($_POST['password']);


            $objetoLogin=new Usuarios($usuarioSeguro);
            $objetoLogin->contraseña=$contraseñaSegura;

            //obtenemos el mensaje de resultado del login
            $resultadoLogin=$objetoLogin->login();
    
        }

    require_once "../view/loginV.php";
    
?>