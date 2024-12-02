<main>
    <?php
        //visualizamos nombre del hilo
        echo $nombreHilo;
        if(isset($_SESSION['usuario'])){

    ?>

    <div class="contenedorComentarioNuevo">
        <textarea name="addComentario" id=""></textarea>
        <button id="botonAddComentario" >ADD</button>
        <p id="mensajeError" class="esconder">The comment can´t be empty</p>            
    </div>
    <?php
        }

    ?>
    <section class="contenedorComentarios" id="<?php echo $_GET['hilo']; ?>">
       
        <?php
            if(is_array($arrayComentarios)){
             
                foreach($arrayComentarios as $valor){
                    echo '<section class="contenedorComentario">';
                        echo '<div class="contenedorDatosUsuarioComentario">';
                        if(empty($valor['imagenUsuario'])){
                            echo '<i class="fa-solid fa-user"></i>';
                        }else{
                            echo '<img src="data:' . $valor['tipoMimeImagen'] . ';base64,' . base64_encode($valor['imagenUsuario']) . '" width="80"/>';
                        }
       
                            echo '<h6>Name:'.$valor['usuario'].'</h6>';
                        echo '</div>';
                        echo '<div class="contenedorContenidoComentario">';
                            echo '<p>'. $valor['contenidoComentario'].'</p>';
                            echo "<div>";
                            
                            if(isset($_SESSION['usuario'])){
                                if($valor['estadoComentario']!="puntuado"){
                                    echo '<i class="fa-solid fa-thumbs-up"></i>';
                                }else{
                                    echo '<i class="fa-solid fa-thumbs-up comentarioPuntuado"></i>';
                                }   
                                echo '<h5>'.$valor['puntuacion'].'</h5>';
                                if($_SESSION['tipoUsuario']=="administrador"){
                                    echo"<button class='botonDeleteComentario'>DELETE</button>";
                                }
                            }
                            
                            echo "</div>";
                        echo '</div>';
                    echo '</section>';
                }
            }else{
                echo"<h3>".$arrayComentarios ."</h3>";
            }
       
        ?>
   </section>
   
</main>
<script src="../view/js/eventosComentarios.js"></script>
