<?php
    require_once "conexionDB.php";

    interface interfaceUsuario { 
        public function registro();
        public function login();
        static function visualizarDatosUsuarios(string $usuario);
        function editarDatosPersonalesUsuario(string $nombreSesionUsuario);
        function editarPerfilUsuario(string $nombreSesionUsuario,$imagen);
        static function comprobarUsuarioLogoneadoTieneFoto(string $nombreSesionUsuario);

     }




    class Usuarios implements interfaceUsuario{

        //es protected porque luego será heredado por la clase hija usuarioCliente, que se encuentra en el archivo usuarioCliente.php
        protected string $usuario;

        //constructor para el nombre de usuario y tamvién lo usará la clase hija usuarioCliente
        public function __construct($usuario){
            $this->usuario=$usuario;
        }

     
        //método mágico para añadir las características del usuario
        public function __set($atributo, $valor) {
            $this->$atributo= $valor; 
        }



        public function registro( ){

            try{
                $conexionDB=ConexionDB::conectar();

                $consultaNombreUsuarioRepetido=$conexionDB->query("SELECT usuario FROM usuario WHERE usuario='$this->usuario'");
                $consultaComprobarDuplicacionCorreo=$conexionDB->query("SELECT correo FROM usuario WHERE correo='$this->correo'");

                if($consultaNombreUsuarioRepetido->rowCount()==0){
                    if( $consultaComprobarDuplicacionCorreo->rowCount()==0){

                            //obtenemos los apellidos
                            $arrayApellidos=explode(" ",$this->apellidos);
                            $apellido1=$arrayApellidos[0];
                            $apellido2=$arrayApellidos[1];
                        
                            //codificamos la contraseña
                            $contraseñaCodificada=password_hash($this->contraseña,PASSWORD_DEFAULT);

                            //comprobamos su existe el número de tlf2
                            if ($this->telefono2 == 0) {
                             // Preparamos la consulta SQL
                                $consultaInsertarNuevoUsuario= $conexionDB->prepare("INSERT INTO usuario (usuario,passwordd,tipoUsuario,correo, nombre, apellido1,apellido2,telefono) VALUES (:usuario,:passswordd,'cliente',:correo,:nombre, :apellido1,:apellido2,:telefono1)");

                                // Vinculamos las variables a los parámetros de la consulta SQL
                                $consultaInsertarNuevoUsuario->bindParam(':usuario',$this->usuario, PDO::PARAM_STR);
                                $consultaInsertarNuevoUsuario->bindParam(':passswordd',$contraseñaCodificada, PDO::PARAM_STR);
                                $consultaInsertarNuevoUsuario->bindParam(':correo', $this->correo, PDO::PARAM_STR);
                                $consultaInsertarNuevoUsuario->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
                                $consultaInsertarNuevoUsuario->bindParam(':apellido1', $apellido1, PDO::PARAM_STR);
                                $consultaInsertarNuevoUsuario->bindParam(':apellido2', $apellido2, PDO::PARAM_STR);
                                $consultaInsertarNuevoUsuario->bindParam(':telefono1',$this->telefono1, PDO::PARAM_INT);
                        
                            } else {
                                // Preparamos la consulta SQL
                                $consultaInsertarNuevoUsuario= $conexionDB->prepare("INSERT INTO usuario (usuario,passwordd,tipoUsuario,correo, nombre, apellido1,apellido2,telefono,telefono2) VALUES (:usuario,:passswordd,'cliente',:correo,:nombre, :apellido1,:apellido2,:telefono1,:telefono2)");

                                // Vinculamos las variables a los parámetros de la consulta SQL
                                $consultaInsertarNuevoUsuario->bindParam(':usuario',$this->usuario, PDO::PARAM_STR);
                                $consultaInsertarNuevoUsuario->bindParam(':passswordd',$contraseñaCodificada, PDO::PARAM_STR);
                                $consultaInsertarNuevoUsuario->bindParam(':correo', $this->correo, PDO::PARAM_STR);
                                $consultaInsertarNuevoUsuario->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
                                $consultaInsertarNuevoUsuario->bindParam(':apellido1', $apellido1, PDO::PARAM_STR);
                                $consultaInsertarNuevoUsuario->bindParam(':apellido2', $apellido2, PDO::PARAM_STR);
                                $consultaInsertarNuevoUsuario->bindParam(':telefono1',$this->telefono1, PDO::PARAM_INT);
                                $consultaInsertarNuevoUsuario->bindParam(':telefono2',$this->telefono2, PDO::PARAM_INT);
                            }
        
                            // Ejecutamos la consulta de inserción
                            $consultaInsertarNuevoUsuario->execute();
                            return "<h5 style='text-align: center;'>THE USER HAS BEEN REGISTERED</h5>";
                    }else{
                        return "<h5 style='text-align: center;'>THE GMAIL HAS BEEN REGISTERED ALREADY</h5>";
                    }    
                }else{
                    return "<h5 style='text-align: center;'>THE USER HAS BEEN REGISTERED ALREADY</h5>";
                }
        }catch(Exception $e){
            echo "ERROR:".$e->getMessage();
        }finally{
            $conexionDB=null;
        }

        }


        public function login(){


            try{
                $conexionDB = ConexionDB::conectar();

                //comprobamos que existe el usuario
                $consultaComprobarExistenciaUsuario=$conexionDB->query("SELECT usuario FROM usuario WHERE usuario='$this->usuario'");


                if($consultaComprobarExistenciaUsuario->rowCount()==0){
                    return "<h5 style='text-align: center;'>ERROR: username No found</h5>";

                }else{
                
                    //comprobamos que las contraseñas coincidan
                    $consultaComprobarContraseña=$conexionDB->query("SELECT passwordd FROM usuario WHERE usuario='$this->usuario'");

                    $arrayConsultaContraseña=$consultaComprobarContraseña->fetch(PDO::FETCH_ASSOC);


                    if(password_verify($this->contraseña,$arrayConsultaContraseña['passwordd'])){

                        //obtenemos el tipo de usuario
                        $consultaTipoUsuario=$conexionDB->query("SELECT tipoUsuario FROM usuario WHERE usuario='$this->usuario'");

                        $arrayTipoUsuario=$consultaTipoUsuario->fetch(PDO::FETCH_ASSOC);

                        
                        $_SESSION['usuario']=$this->usuario;
                        $_SESSION['tipoUsuario']=$arrayTipoUsuario['tipoUsuario'];

                        header('Location:indexController.php');
                    }else{
                        return "<h5 style='text-align: center;'>ERROR:passwords do not match</h5>";
                    }
                }
            }catch(Exception $e){
                echo "Error:".$e->getMessage();
            }finally{
                $conexionDB=null;
            }

        }


        // viusalizar datos en la pág de editar perfil usuario 
        static function visualizarDatosUsuarios(string $usuario){

            try{

                $conexionDB = ConexionDB::conectar();

                //Consulta para obetener los datos del usuario con el que se haya iniciado sesión.
                $consultaDatosUsuario=$conexionDB->query("SELECT * FROM usuario WHERE usuario='$usuario'");

            
                $arrayDatosUsuario=$consultaDatosUsuario->fetch(PDO::FETCH_ASSOC);

                return $arrayDatosUsuario;
            
            }catch(Exception $e){
                echo "Error:".$e->getMessage();
            }finally{
                $conexionDB=null;
            }

        }


       function editarDatosPersonalesUsuario(string $nombreSesionUsuario){

            try{

                $conexionDB = ConexionDB::conectar();

                $arrayApellidos=explode(" ",$this->apellidos);

                if($this->telefono2==0){

                    // Preparamos la consulta SQL
                    $consultaInsertarNuevoUsuario= $conexionDB->prepare("UPDATE usuario SET correo=:correo,nombre=:nombre,apellido1=:apellido1,apellido2=:apellido2,telefono=:telefono1,telefono2=null WHERE usuario='$nombreSesionUsuario'");

                    // Vinculamos las variables a los parámetros de la consulta SQL
                    $consultaInsertarNuevoUsuario->bindParam(':correo', $this->correo, PDO::PARAM_STR);
                    $consultaInsertarNuevoUsuario->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
                    $consultaInsertarNuevoUsuario->bindParam(':apellido1', $arrayApellidos[0], PDO::PARAM_STR);
                    $consultaInsertarNuevoUsuario->bindParam(':apellido2', $arrayApellidos[1], PDO::PARAM_STR);
                    $consultaInsertarNuevoUsuario->bindParam(':telefono1',$this->telefono1, PDO::PARAM_INT);

                 

                }else{
                    
                    // Preparamos la consulta SQL
                    $consultaInsertarNuevoUsuario= $conexionDB->prepare("UPDATE usuario SET correo=:correo,nombre=:nombre,apellido1=:apellido1,apellido2=:apellido2,telefono=:telefono1,telefono2=:telefono2 WHERE usuario='$nombreSesionUsuario'");

                    // Vinculamos las variables a los parámetros de la consulta SQL
                    $consultaInsertarNuevoUsuario->bindParam(':correo', $this->correo, PDO::PARAM_STR);
                    $consultaInsertarNuevoUsuario->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
                    $consultaInsertarNuevoUsuario->bindParam(':apellido1',$arrayApellidos[0], PDO::PARAM_STR);
                    $consultaInsertarNuevoUsuario->bindParam(':apellido2', $arrayApellidos[1], PDO::PARAM_STR);
                    $consultaInsertarNuevoUsuario->bindParam(':telefono1',$this->telefono1, PDO::PARAM_INT);
                    $consultaInsertarNuevoUsuario->bindParam(':telefono2',$this->telefono2, PDO::PARAM_INT);
                 
                }
                $consultaInsertarNuevoUsuario->execute();

                return "<h5 style='text-align: center;'>Updated personal data</h5>";

            }catch(Exception $e){
                echo "Error:".$e->getMessage();
            }finally{
                $conexionDB=null;
            }

        }

        function editarPerfilUsuario(string $nombreSesionUsuario,$imagen){   
            try{

                $conexionDB = ConexionDB::conectar();

                //generamos un array para añadir el resultado
                $arrayResultadoSalida=array();

                //valor booleano para comprobar que las contraeñas coincidan para así almacenar la imagen luego
                $comprobacionCoincidenciasContraseña=true;

                //comprobamos que la contraseña no está vacía
                if(!empty($this->contraseña)){

                    //comprobamos que las contraseñas coinciden
                    if($this->contraseña==$this->contraseñaConfirmacion){
                    
                        //encriptamos la contraseña
                        $contraseñaEncriptada=password_hash($this->contraseña,PASSWORD_DEFAULT);

                        //modificamos usuario y contraseña
                        $consultaEditarUsuario=$conexionDB->prepare("UPDATE usuario SET usuario=:usuario,passwordd=:passwordd WHERE usuario='$nombreSesionUsuario'");
                        $consultaEditarUsuario->bindParam(':usuario', $this->nuevoNombreUsuario, PDO::PARAM_STR);
                        $consultaEditarUsuario->bindParam(':passwordd', $contraseñaEncriptada, PDO::PARAM_STR);
                        $consultaEditarUsuario->execute();
                        array_push($arrayResultadoSalida,"<h5 style='text-align: center;'>UserName and Password update</h5>");
                    }else{
                        array_push($arrayResultadoSalida,"<h5 style='text-align: center;'>ERROR:passwords dont match</h5>");
                        $comprobacionCoincidenciasContraseña=false;
                    }
                }else{
                
                    //modificamos usuario
                    $consultaEditarUsuario=$conexionDB->prepare("UPDATE usuario SET usuario=:usuarioo WHERE usuario='$nombreSesionUsuario'");

                    $consultaEditarUsuario->bindParam(':usuarioo', $this->nuevoNombreUsuario, PDO::PARAM_STR);
                    array_push($arrayResultadoSalida,"<h5 style='text-align: center;'>Username update</h5>");
                    $consultaEditarUsuario->execute();
                }
         

                if($comprobacionCoincidenciasContraseña==true){
                    //comprobamos que existe la imagen    
                    if(!empty($imagen['name'])){
                        
                       
                        $_FILES=$imagen;
                        $tamañoMaxImagen=1048576;//2 MB

                        // comprobar formato archivo
                        $formatoArchivo= array("image/jpeg","image/jpg","image/png");
                        if(in_array($_FILES['type'],$formatoArchivo)){
                            
                            //obtenemos el tamaño e la imagen
                            $tamañoImagen=$_FILES['size'];

                            //comprobar tamaño imagen
                            if($tamañoImagen>$tamañoMaxImagen){
                                array_push($arrayResultadoSalida,"<h5 style='text-align: center;'>ERROR: the image is too big</h5>");
                            }else{
                                $check = getimagesize($_FILES["tmp_name"]);
                                if($check !== false){
                                    $image = $_FILES['tmp_name'];
                                    $tipoMimeImg=$_FILES['type'];
                                    $imgContent = file_get_contents($image);
                            

                                    //añadimos el nuevo producto en la tabla de la base de datos
                                    $consultaEditarImagenUsuario=$conexionDB->prepare("UPDATE usuario SET imagenUsuario=:imgContent,tipoMimeImagen=:tipoMimeImagen  WHERE usuario='$this->nuevoNombreUsuario'");
                                    $consultaEditarImagenUsuario->bindParam(':imgContent', $imgContent, PDO::PARAM_LOB);
                                    $consultaEditarImagenUsuario->bindParam(':tipoMimeImagen', $tipoMimeImg, PDO::PARAM_STR);

                                    $consultaEditarImagenUsuario->execute();

                                    array_push($arrayResultadoSalida,"<h5 style='text-align: center;'>Image updated</h5>");
    
                                    }else{
                                        array_push($arrayResultadoSalida,"<h5 style='text-align: center;'>Please select an image file to upload.</h5>");
                                    }
                            }
                        }else{
                            array_push($arrayResultadoSalida,"<h5 style='text-align: center;'>ERROR:wrong format file</h5>");
                        }
                    }

                    //modificamos el nombre de la sesión por el nombre de usuario nuevo
                    $_SESSION['usuario']=$this->nuevoNombreUsuario;
                    
                    
                }
 
                return $arrayResultadoSalida;
        }catch(Exception $e){
            echo "Error:".$e->getMessage();
        }finally{
            $conexionDB=null;
        }

        }


        static function comprobarUsuarioLogoneadoTieneFoto(string $nombreSesionUsuario){

           
            try {

                $conexionDB = ConexionDB::conectar();

                // Consulta simple para obtener la imagen y el tipo MIME
                $consultaImagen = $conexionDB->query("SELECT imagenUsuario, tipoMimeImagen FROM usuario WHERE usuario='$nombreSesionUsuario'");
            
                // Verificamos si se encontraron resultados
                if ($consultaImagen->rowCount() == 0) {
                    echo "No hay imagen";
                } else {
                    $arrayImagen = $consultaImagen->fetch(PDO::FETCH_ASSOC);
                    
                    if (empty($arrayImagen['imagenUsuario'])) {
                        return "";
                    } else {
                        // Retornamos la imagen
                        return '<img  class="imagenUsuario" src="data:' . $arrayImagen['tipoMimeImagen'] . ';base64,' . base64_encode($arrayImagen['imagenUsuario']) . '" width="80"/>';
                    }
                }
            } catch (Exception $e) {
                
                echo "Error: " . $e->getMessage();
            }finally{
                $conexionDB=null;
            }
        }
    }




?>