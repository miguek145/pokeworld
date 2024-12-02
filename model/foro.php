<?php

    require_once "conexionDB.php";

    interface CRUDForo { 
            static public function visualizarHilos(); 
            static public function actualizarHilos(string $nombreHiloAntiguo ,string $nombreHiloNuevo); 
            static public function eliminarHilo(string $nombreHilo);
            static public function addHilo(string $nombreHiloNuevo);
        }

    class Foro implements CRUDForo{

        private string $nombreHilo;

        public function __construct($nombreHilo){
            $this->nombreHilo=$nombreHilo;
        }

        public function __toString(){
            return "<h3> Theme: $this->nombreHilo </h3>";
        }
        

        static public function visualizarHilos(){

            try{

                $conexionDB = ConexionDB::conectar();

                $consulatHilosForo=$conexionDB->query("SELECT nombreHilo,numeroComentarios FROM hilosforo");

                $arrayNombresHilos=array();

                while($fila=$consulatHilosForo->fetch(PDO::FETCH_OBJ)){
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

                if(strlen($nombreHiloNuevo)>0 && strlen($nombreHiloAntiguo)<=20){
                    $conexionDB = ConexionDB::conectar();

                    $consulatHilosForo=$conexionDB->query("SELECT nombreHilo FROM hilosforo");

                    $conexionDB->query("UPDATE hilosforo SET nombreHilo = '$nombreHiloNuevo' WHERE nombreHilo = '$nombreHiloAntiguo'");

                    return 1;
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

                if(strlen($nombreHilo>0 && strlen($nombreHilo)<=20)){
                    $conexionDB->query("INSERT INTO hilosforo (nombrehilo, numeroComentarios) VALUES ('$nombreHilo', 0)");

                    return 1;
                  
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

                //obtenemos el id del hilo
                $consultaIdHilo=$conexionDB->query("SELECT idHilo FROM hilosForo WHERE nombreHilo='$nombreHilo'");

                $arrayIdHilo=$consultaIdHilo->fetch(PDO::FETCH_ASSOC);

                $idHilo= $arrayIdHilo['idHilo'];

                
                //obtenemos los datos de los comentarios y de los usuarios que lo han creado
                $consultaDatosComentario=$conexionDB->query("SELECT co.idComentario,co.contenidoComentario,co.puntuacion,us.imagenUsuario,us.tipoMimeImagen,us.usuario FROM comentario co 
                                    INNER JOIN usuario us 
                                    ON co.FK_usuario=us.idUsuario
                                    INNER JOIN hilosforo hi 
                                    ON co.FK_hilo=hi.idHilo
                                    WHERE hi.nombreHilo='$nombreHilo'");

                if($nombreUsuario!=""){
                      //obtenemos el id del usuario
                      $consultaIdUsuario=$conexionDB->query("SELECT idUsuario FROM usuario WHERE usuario='$nombreUsuario'");

                      $arrayIdUsuario=$consultaIdUsuario->fetch(PDO::FETCH_ASSOC);
  
                      $idUsuario=$arrayIdUsuario['idUsuario'];
  
  
                      if($consultaDatosComentario->rowCount()>0){
  
                          $arrayComentarios=array();
  
                          while($fila=$consultaDatosComentario->fetch(PDO::FETCH_OBJ)){
                              
                              $idComentario=$fila->idComentario;
  
                              //consulta para obtener el estado del comentario para saber si está puntuado o no
                              $consultaComprobacionComentario=$conexionDB->query("SELECT * FROM usuariopuntuacioncomentario WHERE FK_usuario=$idUsuario AND FK_comentario=$idComentario");
  
                              if($consultaComprobacionComentario->rowCount()>0){
  
                                  $estadoComentario="puntuado";
                              }else{
                                  $estadoComentario="nopuntuado";
                              }
      
                              
  
                              array_push($arrayComentarios,array("contenidoComentario"=> $fila->contenidoComentario,"puntuacion"=>$fila->puntuacion,"imagenUsuario"=>$fila->imagenUsuario,"tipoMimeImagen"=>$fila->tipoMimeImagen,"usuario"=>$fila->usuario,"estadoComentario"=>$estadoComentario));
  
                          }
  
                          return  $arrayComentarios;
                      }else{
                          return "<h2>0 COMMENTS</h2>";
                      }
                }else{
                     
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

                        $idUsuario=$arrayIdUsuario['idUsuario'];

                        //Consulta para obtener el id del hilo
                        $consultaIdHilo=$conexionDB->query("SELECT idHilo FROM hilosforo WHERE nombreHilo='$nombreHilo'");

                        $arrayIdHilo=$consultaIdHilo->fetch(PDO::FETCH_ASSOC);

                        $idHilo=$arrayIdHilo['idHilo'];

                        //Consulta para añadir el nuevo comentario
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
                    if($numeroComentario==$contadorIconoLike){
                        $idComentario=$fila->idComentario;

                        //consulta obtener el id del usuario para comprobar si le ha dado like al comentario o no
                        $consultaIdUsuario=$conexionDB->query("SELECT idUsuario FROM usuario WHERE usuario='$nombreUsuario'");

                        $arrayIdUsuario=$consultaIdUsuario->fetch(PDO::FETCH_ASSOC);
                        $idUsuario=$arrayIdUsuario['idUsuario'];

                        //consulta para obtener los datos de la tabla de comprobacion de si le ha dado like al comentario el usuario
                        $consultaTablaLikesComprobacion=$conexionDB->query("SELECT * FROM usuariopuntuacioncomentario WHERE FK_usuario=$idUsuario AND FK_comentario=$idComentario");
                        $puntuacion=$fila->puntuacion;
                        
                       if($consultaTablaLikesComprobacion->rowCount()>0){
                            --$puntuacion;
                            $conexionDB->query("UPDATE comentario SET puntuacion=$puntuacion  WHERE idComentario=$idComentario");
                    
                            //modificamos el estado del comentario
                            $conexionDB->query("DELETE FROM usuariopuntuacioncomentario WHERE FK_usuario=$idUsuario AND FK_comentario=$idComentario");

                            $estadoComentarioNuevo="noPuntuado";
                       }else{
                        ++$puntuacion;
                            $conexionDB->query("UPDATE comentario SET puntuacion=$puntuacion  WHERE idComentario=$idComentario");

                            //modificamos el estado del comentario
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

                if( $consultaComentariosUsuario->rowCount()>0){
                    $arrayComentarios=array();                

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

                if(strlen($contenidoNuevoComentario)>0){
                    $conexionDB=ConexionDB::conectar();

                    $consultaComentarios=$conexionDB->query("SELECT * FROM comentario co
                    INNER JOIN usuario us
                    ON us.idUsuario=FK_usuario
                    WHERE us.usuario='$usuario'");

                    if($consultaComentarios->rowCount()>0){
                        $contadorComentarios=0;
                        while($fila=$consultaComentarios->fetch(PDO::FETCH_OBJ)){
                            if($contadorComentarios==$idComentario){
                                $idComentario=$fila->idComentario;
                                $conexionDB->query("UPDATE comentario SET contenidoComentario='$contenidoNuevoComentario' WHERE idComentario=$idComentario");
                            }else{
                                ++$contadorComentarios;
                            }
                        }
                    }else{
                        return "empty";
                    }
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

                    if($consultaComentarios->rowCount()>0){
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
                        }
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
                $idHilo=$arrayIdHilo['idHilo'];
               

                $consultaComentarios=$conexionDB->query("SELECT * FROM hilosforo hi 
                                                        INNER JOIN comentario co 
                                                        ON hi.idHilo=co.FK_hilo
                                                        WHERE hi.idHilo='$idHilo' AND co.contenidoComentario='$contenidoComentario'");

                $numeroTotalComentariosEliminar=$consultaComentarios->rowCount();
             

            
                //consulta para modificar el número de comentarios del hilo seleccionado
                $consultaComentariosHilo=$conexionDB->query("SELECT * FROM comentario WHERE FK_hilo=$idHilo");

                $numeroComentariosHilo= $consultaComentariosHilo->rowCount();

                $numeroComentariosHiloActualizado=$numeroComentariosHilo-$numeroTotalComentariosEliminar;

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