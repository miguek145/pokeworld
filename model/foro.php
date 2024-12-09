<?php

    require_once "conexionDB.php";

    interface CRUDForo { 
            static public function visualizarHilos(); 
            static public function actualizarHilos(string $nombreHiloAntiguo ,string $nombreHiloNuevo); 
            static public function eliminarHilo(string $nombreHilo);
            static public function addHilo(string $nombreHiloNuevo);
            static public function visualizarComentariosForo(string $nombreUsuario ,string $nombreHilo);
            static public function addComentario( string $nombreUsuario, string $nombreHilo, string $contenidoComentario);
            static public function actualizarLikeComentario(string $nombreUsuario,int $numeroComentario,string $nombreHilo);
            static public function visualizarComentariosPropios(string $nombreUsuario);
        }

    class Foro implements CRUDForo{

        private string $nombreHilo;

        public function __construct($nombreHilo){
            $this->nombreHilo=$nombreHilo;
        }

        // método mágico para visualizar el nombre del hilo en la página de los comentarios
        public function __toString(){
            return "<h3> Theme: $this->nombreHilo </h3>";
        }
        

        static public function visualizarHilos(){

            try{

                $conexionDB = ConexionDB::conectar();

                //consulta apra obtener todos los hilos
                $consulatHilosForo=$conexionDB->query("SELECT nombreHilo,numeroComentarios FROM hilosforo");

                $arrayNombresHilos=array();

                while($fila=$consulatHilosForo->fetch(PDO::FETCH_OBJ)){

                    //devolvemos todos los nombres de los hilos
                    array_push($arrayNombresHilos,array("nombreHilo"=>$fila->nombreHilo,"numeroComentarios"=>$fila->numeroComentarios));
                }
                return $arrayNombresHilos;
            }catch(Exception $e){
                echo "ERROR:".$e->getMessage();
            }finally{
                $conexionDB=null;
            }
        }

        static public function actualizarHilos(string $nombreHiloAntiguo ,string $nombreHiloNuevo){
            try{
                $conexionDB = ConexionDB::conectar();
     
                //comprobamos de que el nuevo nombre del hilo tenga entre 0 a 20 carácteres y si no lo cumple pues devolverá 0 que sifgnifica que no se ha hecho bien
                if(strlen($nombreHiloNuevo) > 0 && strlen($nombreHiloNuevo) <= 20){

                    //comprobamos que el nuevo nombre del hilo ya existe en la base de datos
                    $consultaHilo=$conexionDB->query("SELECT * FROM hilosforo WHERE nombreHilo='$nombreHiloNuevo'");

                    //si el nombre del hilo no existe en la abse de datos pues se actualizará el nombre del hilon y dedvolverá 1 acreditando de que se ha hecho bien la actualización del hilo
                    if($consultaHilo->rowCount()==0){
                        $conexionDB->query("UPDATE hilosforo SET nombreHilo = '$nombreHiloNuevo' WHERE nombreHilo = '$nombreHiloAntiguo'");

                        return 1;
                    }else{
                        return 0;
                    }
                
                }else{
                    return 0;
                }

            }catch(Exception $e){
                echo "ERROR:".$e->getMessage();
            }finally{
                $conexionDB=null;
            }
        }

        static public function eliminarHilo( string $nombreHilo){

            try{
                $conexionDB = ConexionDB::conectar();

                //eliminamos el hilo seleccionado
                $conexionDB->query("DELETE FROM hilosforo WHERE nombreHilo='$nombreHilo'");

                return 1;

            }catch(Exception $e){
                echo "ERROR:".$e->getMessage();
            }finally{
                $conexionDB=null;
            }
        }

        static public function addHilo( string $nombreHilo){

            try{

                $conexionDB = ConexionDB::conectar();

                //comprobamos el nombre del nuevo hilo tenga entre 0 a 20 carácteres y si no devolverá 0 y no se añadirá a la base de datos
                if(strlen($nombreHilo) > 0 && strlen($nombreHilo) <= 20){

                    //comprobamos si existe el hilo
                    $consultaHilo=$conexionDB->query("SELECT * FROM hilosforo WHERE nombreHilo='$nombreHilo'");

                    //comprobamos de que el nombre del hilo nuevo no exista ya en la abse ded datos
                    if($consultaHilo->rowCount()==0){

                        //añadimos el hilo nuevo en la abse de datos con el némro de comentarios 0
                        $conexionDB->query("INSERT INTO hilosforo (nombrehilo, numeroComentarios) VALUES ('$nombreHilo', 0)");
                        return 1;

                    }else{
                        return 0;
                    }
                }else{
                    return 0;
                }
            }catch(Exception $e){
                echo "ERROR:".$e->getMessage();
            }finally{
                $conexionDB=null;
            }
        }

        static public function visualizarComentariosForo(string $nombreUsuario ,string $nombreHilo){
            try{
              
                $conexionDB = ConexionDB::conectar();

                //obtenemos el id del hilo para obtener los comentarios de este hilo
                $consultaIdHilo=$conexionDB->query("SELECT idHilo FROM hilosForo WHERE nombreHilo='$nombreHilo'");

                $arrayIdHilo=$consultaIdHilo->fetch(PDO::FETCH_ASSOC);

                //obtenemos el id del hilo
                $idHilo= $arrayIdHilo['idHilo'];

                
                //obtenemos los datos de cada comentario y de cada usuario que lo ha creado
                $consultaDatosComentario=$conexionDB->query("SELECT co.idComentario,co.contenidoComentario,co.puntuacion,us.imagenUsuario,us.tipoMimeImagen,us.usuario FROM comentario co 
                                    INNER JOIN usuario us 
                                    ON co.FK_usuario=us.idUsuario
                                    INNER JOIN hilosforo hi 
                                    ON co.FK_hilo=hi.idHilo
                                    WHERE hi.nombreHilo='$nombreHilo'");

                //comprobamos de que el usuario haya iniciado sesión
                if($nombreUsuario!=""){

                      //obtenemos el id del usuario
                      $consultaIdUsuario=$conexionDB->query("SELECT idUsuario FROM usuario WHERE usuario='$nombreUsuario'");

                      $arrayIdUsuario=$consultaIdUsuario->fetch(PDO::FETCH_ASSOC);
  
                      //id usuario
                      $idUsuario=$arrayIdUsuario['idUsuario'];
  
  
                      if($consultaDatosComentario->rowCount()>0){
  
                          $arrayComentarios=array();
  
                          while($fila=$consultaDatosComentario->fetch(PDO::FETCH_OBJ)){
                              
                              $idComentario=$fila->idComentario;
  
                              //consulta para obtener el estado del comentario para saber si está puntuado o no por el usuario que ha iniciado sesión
                              $consultaComprobacionComentario=$conexionDB->query("SELECT * FROM usuariopuntuacioncomentario WHERE FK_usuario=$idUsuario AND FK_comentario=$idComentario");
  
                              /*comprobamos que exista una fila con el id del usuario y del comentario en la tabla usuariopuntuacioncomentario, 
                              en el caso que exista eso significa que el usuario ya había puntuado el comentario previamente*/
                              if($consultaComprobacionComentario->rowCount()>0){
  
                                  $estadoComentario="puntuado";
                              }else{
                                  $estadoComentario="nopuntuado";
                              }
                              
                              //le vamos añadiendo los comentarios al array para retornarlo con sus estado de si se le h dado LIKE o no previamente
                              array_push($arrayComentarios,array("contenidoComentario"=> $fila->contenidoComentario,"puntuacion"=>$fila->puntuacion,"imagenUsuario"=>$fila->imagenUsuario,"tipoMimeImagen"=>$fila->tipoMimeImagen,"usuario"=>$fila->usuario,"estadoComentario"=>$estadoComentario));
  
                          }
  
                          return  $arrayComentarios;
                      }else{
                          return "<h2>0 COMMENTS</h2>";
                      }
                }else{
                    //aquí comprobamos que el usuario no ha inciado sesíon entonces le paraecerá los comentarios pero sin el icono de LIKE 

                    if($consultaDatosComentario->rowCount()>0){
  
                        $arrayComentarios=array();

                        while($fila=$consultaDatosComentario->fetch(PDO::FETCH_OBJ)){
                        
                            array_push($arrayComentarios,array("contenidoComentario"=> $fila->contenidoComentario,"puntuacion"=>$fila->puntuacion,"imagenUsuario"=>$fila->imagenUsuario,"tipoMimeImagen"=>$fila->tipoMimeImagen,"usuario"=>$fila->usuario));

                        }

                        return  $arrayComentarios;
                    }else{
                        return "<h2>0 COMMENTS</h2>";
                    }
                }
                  

            }catch(Exception $e){
                echo "ERROR:".$e->getMessage();
            }finally{
                $conexionDB=null;
            }
        }


        static public function addComentario( string $nombreUsuario, string $nombreHilo, string $contenidoComentario){
            try{

                    if(strlen($contenidoComentario)>0){

                        $conexionDB = ConexionDB::conectar();

                        //Consulta apra obtener el id de usuario
                        $consultaIdUsuario=$conexionDB->query("SELECT idUsuario FROM usuario WHERE usuario='$nombreUsuario'");

                        $arrayIdUsuario=$consultaIdUsuario->fetch(PDO::FETCH_ASSOC);

                        //obtenemos el id del usuario
                        $idUsuario=$arrayIdUsuario['idUsuario'];

                        //Consulta para obtener el id del hilo
                        $consultaIdHilo=$conexionDB->query("SELECT idHilo FROM hilosforo WHERE nombreHilo='$nombreHilo'");

                        $arrayIdHilo=$consultaIdHilo->fetch(PDO::FETCH_ASSOC);

                        //obtenemos el id del hilo
                        $idHilo=$arrayIdHilo['idHilo'];

                        //Consulta para añadir el nuevo comentario, como es un comentario nuevo pues su puntuación será de 0
                        $conexionDB->query("INSERT INTO  comentario (contenidoComentario,puntuacion,FK_usuario,FK_hilo) VALUES('$contenidoComentario',0,$idUsuario,$idHilo)");


                        //consulta para modificar el número de comentarios del hilo seleccionado
                        $consultaComentariosHilo=$conexionDB->query("SELECT * FROM comentario WHERE FK_hilo=$idHilo");

                        $numeroComentariosHilo= $consultaComentariosHilo->rowCount();

                        $conexionDB->query("UPDATE hilosforo SET numeroComentarios= $numeroComentariosHilo WHERE idHilo=$idHilo");
                        

                        //llamamos a la clase visualizarComentarios para los comentarios nuevos
                        $arrayComentarios=Foro::visualizarComentariosForo($nombreUsuario,$nombreHilo);

                        return $arrayComentarios;
                    }else{
                        return 0;
                    }


            }catch(Exception $e){
                echo "ERROR:".$e->getMessage();
            }finally{
                $conexionDB=null;
            }
        }


        static public function actualizarLikeComentario(string $nombreUsuario,int $numeroComentario,string $nombreHilo){
            try{

                $conexionDB = ConexionDB::conectar();


                $consultaDatosComentario=$conexionDB->query("SELECT * FROM comentario co 
                                    INNER JOIN usuario us 
                                    ON co.FK_usuario=us.idUsuario
                                    INNER JOIN hilosforo hi 
                                    ON co.FK_hilo=hi.idHilo
                                    WHERE hi.nombreHilo='$nombreHilo'");

                $contadorIconoLike=0;
                while($fila=$consultaDatosComentario->fetch(PDO::FETCH_OBJ)){

                    //comprobamos si es el comantario el cual queremos actualizar su LIKE
                    if($numeroComentario==$contadorIconoLike){
                        $idComentario=$fila->idComentario;

                        //consulta obtener el id del usuario para comprobar si le ha dado like al comentario o se lo ha quitado
                        $consultaIdUsuario=$conexionDB->query("SELECT idUsuario FROM usuario WHERE usuario='$nombreUsuario'");

                        $arrayIdUsuario=$consultaIdUsuario->fetch(PDO::FETCH_ASSOC);
                        $idUsuario=$arrayIdUsuario['idUsuario'];

                        //consulta para obtener los datos de la tabla de comprobacion de si le ha dado like al comentario el usuario
                        $consultaTablaLikesComprobacion=$conexionDB->query("SELECT * FROM usuariopuntuacioncomentario WHERE FK_usuario=$idUsuario AND FK_comentario=$idComentario");
                        $puntuacion=$fila->puntuacion;
                        
                        /*comprobamos que exista una fila con el id del usuario y del comentario en la tabla usuariopuntuacioncomentario, 
                        en el caso que exista eso significa que el usuario ya había puntuado LIKE el comentario previamente*/
                       if($consultaTablaLikesComprobacion->rowCount()>0){

                            //le testamos uno a la puntuacíon del comentario porque ya le había dado LIKE antes
                            --$puntuacion;

                            //modificamos la puntuación del comentario
                            $conexionDB->query("UPDATE comentario SET puntuacion=$puntuacion  WHERE idComentario=$idComentario");
                    
                            //eliminamos su fila correspondiente en la tabla usuariopuntuacioncomentario, porque le ha quitdao el LIKE del comentario
                            $conexionDB->query("DELETE FROM usuariopuntuacioncomentario WHERE FK_usuario=$idUsuario AND FK_comentario=$idComentario");

                            $estadoComentarioNuevo="noPuntuado";
                       }else{

                            //como no le había dado LIKE previamente el usuario  pues le sumammos 1
                            ++$puntuacion;

                            //modificamos la puntuacion del comentario 
                            $conexionDB->query("UPDATE comentario SET puntuacion=$puntuacion  WHERE idComentario=$idComentario");

                            //añadimos la fila a la tabla usuariopuntuacioncomentario porque el usuario  le ha dado LIKE al comentario
                            $conexionDB->query("INSERT INTO usuariopuntuacioncomentario (FK_usuario,FK_comentario) VALUES($idUsuario,$idComentario)");

                            $estadoComentarioNuevo="puntuado";
                       }
                    }
                    ++$contadorIconoLike;
                }
                

                $arrayDatos=array($puntuacion,$estadoComentarioNuevo);

                return $arrayDatos;
   
            }catch(Exception $e){
                echo "ERROR:".$e->getMessage();
            }finally{
                $conexionDB=null;
            }
        }


        static public function visualizarComentariosPropios(string $nombreUsuario){
            try{
                $conexionDB=ConexionDB::conectar();

                //Consulta obtener comentarios del usuario que se ha logoneado
                $consultaComentariosUsuario=$conexionDB->query("SELECT co.contenidoComentario,co.puntuacion,hi.nombreHilo FROM comentario co 
                                    INNER JOIN usuario us 
                                    ON co.FK_usuario=us.idUsuario
                                    INNER JOIN hilosforo hi 
                                    ON co.FK_hilo=hi.idHilo
                                    WHERE us.usuario='$nombreUsuario'");

                //comprobamos si elñ usuario tiene registrados comentarios propiios ne la base de datos
                if( $consultaComentariosUsuario->rowCount()>0){
                    $arrayComentarios=array();                

                    //vamos añadiendo los comentarios en el array pra visualizarlos luego en la pág
                    while($fila=$consultaComentariosUsuario->fetch(PDO::FETCH_OBJ)){
                        array_push($arrayComentarios,array("contenidoComentario"=>$fila->contenidoComentario,"puntuacion"=>$fila->puntuacion,"nombreHilo"=>$fila->nombreHilo));
                    }   

                    return $arrayComentarios;
                }else{
                    return "0 COMMENTS";
                }
            
            }catch(Exception $e){
                echo "ERROR:".$e->getMessage();
            }finally{
                $conexionDB=null;
            }
        }


        static public function editarComentario(int $idComentario,string $usuario,string $contenidoNuevoComentario){
            try{

                //comprobamos que el nombre nuevo del comentario no esté vacío
                if(strlen($contenidoNuevoComentario)>0){
                    $conexionDB=ConexionDB::conectar();

                    $consultaComentarios=$conexionDB->query("SELECT * FROM comentario co
                    INNER JOIN usuario us
                    ON us.idUsuario=FK_usuario
                    WHERE us.usuario='$usuario'");

                    // if($consultaComentarios->rowCount()>0){
                        $contadorComentarios=0;
                        while($fila=$consultaComentarios->fetch(PDO::FETCH_OBJ)){

                            //comprobamos que sea el mismo comentario
                            if($contadorComentarios==$idComentario){
                                $idComentario=$fila->idComentario;

                                //editamos el comentario
                                $conexionDB->query("UPDATE comentario SET contenidoComentario='$contenidoNuevoComentario' WHERE idComentario=$idComentario");
                            }else{
                                ++$contadorComentarios;
                            }
                        }
                    // }else{
                    //     return "empty";
                    // }
            }else{
                return "empty";
            }

            }catch(Exception $e){
                echo "ERROR:".$e->getMessage();
            }finally{
                $conexionDB=null;
            }
        }



        static public function eliminarComentario(int $idComentario,string $usuario,string $nombreHilo){
            try{
                    $conexionDB=ConexionDB::conectar();

                    $consultaComentarios=$conexionDB->query("SELECT * FROM comentario co
                                                            INNER JOIN usuario us
                                                            ON us.idUsuario=FK_usuario
                                                            WHERE us.usuario='$usuario'");

                    // if($consultaComentarios->rowCount()>0){
                        $contadorComentarios=0;
                        while($fila=$consultaComentarios->fetch(PDO::FETCH_OBJ)){
                            if($contadorComentarios==$idComentario){
                                $idComentario=$fila->idComentario;

                                //eliminamos el comentario seleccionado
                                $conexionDB->query("DELETE  FROM comentario  WHERE idComentario=$idComentario");

                                // //conuslta apra obteener el id del hilo
                                $consultaIdHilo=$conexionDB->query("SELECT idHilo FROM hilosForo WHERE nombreHilo='$nombreHilo'");

                                $arrayIdHilo=$consultaIdHilo->fetch(PDO::FETCH_ASSOC);

                                $idHilo= $arrayIdHilo['idHilo'];

                                //consulta para modificar el número de comentarios del hilo seleccionado
                                $consultaComentariosHilo=$conexionDB->query("SELECT * FROM comentario WHERE FK_hilo=$idHilo");

                                $numeroComentariosHilo= $consultaComentariosHilo->rowCount();

                                $conexionDB->query("UPDATE hilosforo SET numeroComentarios= $numeroComentariosHilo WHERE idHilo=$idHilo");

                                break;
                            }else{
                                ++$contadorComentarios;
                            }
                        // }
                    }

            }catch(Exception $e){
                echo "ERROR:".$e->getMessage();
            }finally{
                $conexionDB=null;
            }
        }

        static public function eliminarComentarioAdministrador(string $nombreHilo,string $contenidoComentario){

            try{
                $conexionDB=ConexionDB::conectar();

              
                //consulta para obtener el id del hilo
                $consultaObtenerIdHilo=$conexionDB->query("SELECT idHilo FROM hilosforo WHERE nombreHilo='$nombreHilo'");

                $arrayIdHilo=$consultaObtenerIdHilo->fetch(PDO::FETCH_ASSOC);

                //obtenemos el id del hilo
                $idHilo=$arrayIdHilo['idHilo'];
               

                $consultaComentarios=$conexionDB->query("SELECT * FROM hilosforo hi 
                                                        INNER JOIN comentario co 
                                                        ON hi.idHilo=co.FK_hilo
                                                        WHERE hi.idHilo='$idHilo' AND co.contenidoComentario='$contenidoComentario'");

                //creamos esta variable para luego actualizar el número de ocmentarios en la tabla de los hilos
                $numeroTotalComentariosEliminar=$consultaComentarios->rowCount();
             

            
                //consulta para modificar el número de comentarios del hilo seleccionado
                $consultaComentariosHilo=$conexionDB->query("SELECT * FROM comentario WHERE FK_hilo=$idHilo");

                $numeroComentariosHilo= $consultaComentariosHilo->rowCount();

                
                $numeroComentariosHiloActualizado=$numeroComentariosHilo-$numeroTotalComentariosEliminar;

                //actulaizamos el campo de numeroCoamentarios del hilo correpondiente
                $conexionDB->query("UPDATE hilosforo SET numeroComentarios= $numeroComentariosHiloActualizado WHERE idHilo=$idHilo");


                //eliminamos los comentarios

                $conexionDB->query("DELETE FROM comentario WHERE FK_hilo='$idHilo' AND contenidoComentario='$contenidoComentario'");

                        
                     

        }catch(Exception $e){
            echo "ERROR:".$e->getMessage();
        }finally{
            $conexionDB=null;
        }
    }
}

?>