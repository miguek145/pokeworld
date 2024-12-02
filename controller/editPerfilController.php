<?php
//funcion para validar datos formularios y para no sufrir ataques XSS
$validarDatos = fn($dato) => htmlspecialchars(stripslashes(trim($dato)));



require_once "../view/templates/declaracion.php";
require_once "../model/usuarios.php";




// Comprobar si la sesión está iniciada
if (!isset($_SESSION['usuario'])) {
    session_destroy();
    header('Location:indexController.php');
    exit();
}

// Inicializar la clave 'time' si no existe
if (!isset($_SESSION['time'])) {
    $_SESSION['time'] = time(); // Establecer el tiempo actual como inicial
}

// Verificar tiempo de inactividad
if ((time() - $_SESSION['time']) > 1200) {
    session_unset();
    session_destroy();
    header('Location:indexController.php');
    exit();
}




//expreiones regulares
$expresionRegularNombreUsuario="/^[a-zA-Z0-9ÁÉÍÓÚáéíóú]{1,10}/";
$expresionRegularContraseña="/^(?=.*[a-záéíóú])(?=.*[A-ZÁÉÍÓÚ])(?=.*\d)(?=.*[$@$!%*?&\.])[A-ZÁÉÍÓÚa-záéíóú\d$@$!%*?&\.]{8,15}/";
$expresionRegularCorreo="/^[a-zA-Z0-9]+@((gmail)|(hotmail))\.((com)|(es)){1,20}$/";
$expresionRegularNombre="/^[A-ZÁÉÍÓÚ][a-záéíóú0-9]{1,10}$/";
$expresionRegularApellidos="/^[A-ZÁÉÍÓÚ][a-záéíóú]+\s[A-ZÁÉÍÓÚ][a-záéíóú]{1,20}$/";
$expresionRegularTelefono="/^[0-9]{9}$/";

//variable para comprobar si los datos introducidos coinciden con las expresiones regulares
$expresionesRegulresBienIntroducidas=true;




if(isset($_POST['editarPerfilInfoPersonal'])){

    
    //vamos comproibando que los datos coinciden con las expresiones regulares
    if(!preg_match( $expresionRegularCorreo,$_POST['email'])){
        $expresionesRegulresBienIntroducidas=false;
    };

    if(!preg_match($expresionRegularNombre,$_POST['nombre'])){
        $expresionesRegulresBienIntroducidas=false;
    };

    if(!preg_match($expresionRegularApellidos,$_POST['apellidos'])){
        $expresionesRegulresBienIntroducidas=false;
    };

    if(!preg_match($expresionRegularTelefono,$_POST['tlf'])){
        $expresionesRegulresBienIntroducidas=false;
    };


    if(!empty($_POST['tlf2'])){
        if(!preg_match($expresionRegularTelefono,$_POST['tlf2'])){
            $expresionesRegulresBienIntroducidas=false;
        };
    }

    if($expresionesRegulresBienIntroducidas==true){
        $correo=$validarDatos($_POST['email']);
        $nombre=$validarDatos($_POST['nombre']);
        $apellidos=$validarDatos($_POST['apellidos']);
        $telefono1=$validarDatos($_POST['tlf']);
        $telefono2=$validarDatos($_POST['tlf2']);
    
        $objetoUsuario=new Usuarios($_SESSION['usuario']);
        
        $objetoUsuario->correo=$correo;
        $objetoUsuario->nombre=$nombre;
        $objetoUsuario->apellidos=$apellidos;
        $objetoUsuario->telefono1=$telefono1;

    
        if(empty($_POST['tlf2'])){
            $objetoUsuario->telefono2=0;
            $resultadoDatosPersonalesEditados=$objetoUsuario->editarDatosPersonalesUsuario($_SESSION['usuario']);
        }else{
            $objetoUsuario->telefono2=$telefono2;
            $resultadoDatosPersonalesEditados=$objetoUsuario->editarDatosPersonalesUsuario($_SESSION['usuario']);
        }
    }else{
        $resultadoDatosPersonalesEditados="<h5 style='text-align: center;'>Wrong data</h5>";
    }

}


if(isset($_POST['editarPerfilInfoUsuario'])){

            //vamos comproibando que los datos coinciden con las expresiones regulares
            if(!preg_match($expresionRegularNombreUsuario,$_POST['usuario'])){
                $expresionesRegulresBienIntroducidas=false;
            };

            if($_POST['password']!=""){
                echo $_POST['password'];
                if(!preg_match($expresionRegularContraseña,$_POST['password'])){
                    $expresionesRegulresBienIntroducidas=false;
                };

                if(!preg_match($expresionRegularContraseña,$_POST['confirmPassword'])){
                    $expresionesRegulresBienIntroducidas=false;
                }
            }



            $nuevoNombreUsuario=$validarDatos($_POST['usuario']);
            $contraseña=$validarDatos($_POST['password']);
            $confirmacionContraseña=$validarDatos($_POST['confirmPassword']);
        
            if($expresionesRegulresBienIntroducidas==true){
         
                $objetoUsuario=new Usuarios($_SESSION['usuario']);
                
                $objetoUsuario->nuevoNombreUsuario=$nuevoNombreUsuario;
                $objetoUsuario->contraseña=$contraseña;
                $objetoUsuario->contraseñaConfirmacion=$confirmacionContraseña;

          
                $resultadoDatosUsuarioEditados=$objetoUsuario->editarPerfilUsuario($_SESSION['usuario'],$_FILES['imagen']);
            }else{
                $resultadoDatosUsuarioEditados="<h5 style='text-align: center;'>WRONG DATA</h5>";
            }

}


$imagen=Usuarios::comprobarUsuarioLogoneadoTieneFoto($_SESSION['usuario']);
require_once "../view/templates/barraNavegacion.php";


//para visualizar los datos del usuario que haya iniciado sesión en los inputs
$arrayDatosUsuario=Usuarios::visualizarDatosUsuarios($_SESSION['usuario']);

require_once "../view/editPerfilV.php";
require_once "../view/templates/cierre.php";

?>