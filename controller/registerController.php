<?php

//funciona para validar datos formularios y para no sufrir ataques XSS
$validarDatos = fn($dato) => htmlspecialchars(stripslashes(trim($dato)));



$titulo="REGISTER PAGE";
require_once "../view/templates/declaracion.php";

    if(isset($_POST['submitRegistration'])){
        require_once "../model/usuarios.php";
        
        //comprobamos los datos introducidos con expresiones regulares
        $expresionesRegulresBienIntroducidas=true;

        //expreiones regulares
        $expresionRegularNombreUsuario="/^[a-zA-Z0-9ÁÉÍÓÚáéíóú]{1,10}/";
        $expresionRegularContraseña="/^(?=.*[a-záéíóú])(?=.*[A-ZÁÉÍÓÚ])(?=.*\d)(?=.*[$@$!%*?&\.])[A-ZÁÉÍÓÚa-záéíóú\d$@$!%*?&\.]{8,15}/";
        $expresionRegularCorreo="/^[a-zA-Z0-9]+@((gmail)|(hotmail))\.((com)|(es)){1,20}$/";
        $expresionRegularNombre="/^[A-ZÁÉÍÓÚ][a-záéíóú0-9]{1,10}$/";
        $expresionRegularApellidos="/^[A-ZÁÉÍÓÚ][a-záéíóú]+\s[A-ZÁÉÍÓÚ][a-záéíóú]{1,20}$/";
        $expresionRegularTelefono="/^[0-9]{9}$/";

        //comprobamos que las expreiones regulares se cumplan

        if(!preg_match($expresionRegularNombreUsuario,$_POST['username'])){
            $expresionesRegulresBienIntroducidas=false;
        };

        if(!preg_match($expresionRegularContraseña,$_POST['password'])){
            $expresionesRegulresBienIntroducidas=false;
        };

        if(!preg_match( $expresionRegularCorreo,$_POST['gmail'])){
            $expresionesRegulresBienIntroducidas=false;
        };

        if(!preg_match($expresionRegularNombre,$_POST['name'])){
            $expresionesRegulresBienIntroducidas=false;
        };

        if(!preg_match($expresionRegularApellidos,$_POST['surnames'])){
            $expresionesRegulresBienIntroducidas=false;
        };

        if(!preg_match($expresionRegularTelefono,$_POST['tlf'])){
            $expresionesRegulresBienIntroducidas=false;
        };


        if($expresionesRegulresBienIntroducidas==true){

            //como están bien las expresiones regulares aplicamos la función de validar datos para prevenir ataques XSS
            $username=$validarDatos($_POST['username']);
            $contraseña=$validarDatos($_POST['password']);
            $contraseñaConfirmacion=$validarDatos($_POST['confirmPassword']);
            $correo=$validarDatos($_POST['gmail']);
            $nombre=$validarDatos($_POST['name']);
            $apellidos=$validarDatos($_POST['surnames']);
            $telefono1=$validarDatos($_POST['tlf']);



            //comprobamos que las contraseñas son iguales
            if($contraseña==$_POST['confirmPassword']){

                //comprobamos si el campo de telefono 2 está vacío 
                if($_POST['tlf2']!=""){

                    $objetoUsuario=new Usuarios($username);
        
                    $objetoUsuario->contraseña=$contraseña;
                    $objetoUsuario->correo=$correo;
                    $objetoUsuario->nombre=$nombre;
                    $objetoUsuario->apellidos=$apellidos;
                    $objetoUsuario->telefono1=$telefono1;

                    //aplicamos la expresión regular a teléfono2 y los validamos
                    $comprobarExpresionTlf2=true;
                    if(preg_match($expresionRegularTelefono,$_POST['tlf2'])){
                        $telefono2=$validarDatos($_POST['tlf2']);


                        $objetoUsuario->telefono2=$telefono2;
                        $resultadoRegistro=$objetoUsuario->registro();
                    }else{
                        $resultadoRegistro="<h5>WRONG DATA</h5>";
                    }                
                }else{
                
                    $objetoUsuario=new Usuarios($_POST['username']);
        
                    $objetoUsuario->contraseña=$contraseña;
                    $objetoUsuario->correo=$correo;
                    $objetoUsuario->nombre=$nombre;
                    $objetoUsuario->apellidos=$apellidos;
                    $objetoUsuario->telefono1=$telefono1;
                    $objetoUsuario->telefono2=0;
  
                    $resultadoRegistro=$objetoUsuario->registro();
        
                }
            }else{
                $resultadoRegistro="<h5>PASSWORDS DON´T MATCH</h5>";
            }
        }else{
            $resultadoRegistro="<h5>WRONG DATA</h5>";
        }
        }

      



      

    require_once "../view/registerV.php";
?>