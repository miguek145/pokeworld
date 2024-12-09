

<h2 class="tituloContenedorForo">THEMES</h2>

    <section class="contenedorHilosForo">



    <?php
    
        if(isset($arrayNombresHilos)){

            //comprobamos si existen hilos en el foro para visualizarlos
            if(is_array($arrayNombresHilos)){

                //comprobamos si se ha iniciado sesión
                if(isset($_SESSION['tipoUsuario'])){

                    //comprobamos que el tipo de usuario que haya iniciado sesión sea administrador
                    if($_SESSION['tipoUsuario']=="administrador"){
                        $contadorIndiceInput=0;
                        foreach($arrayNombresHilos  as $valor){
                            echo '<div class="hiloAdministrador">';

                                // Campo de texto para el nombre del hilo, en el cual el usuario administrador puede editarlo y hay un número máximo de carácteres
                                echo "<input maxlength='20' type='text' value='" . $valor['nombreHilo'] . "' required>";

                                    //como el usuario es tipo administrador le aparecerán lso botones editar y eliminar hilo.
                                    echo "<div>";
                                        echo "<button  class='botonesEditHilo $contadorIndiceInput'>EDIT</button>"; 
                                    echo "</div>";
                                    echo "<div>";
                                        echo "<button class='botonesDeleteHilo $contadorIndiceInput'>DELETE</button>";  
                                    echo "</div>";
                                    echo "<div>";
                                        echo "<a href='comentarioController.php?accion=enter&hilo=" . $valor['nombreHilo'] . "'>ENTER</a>";
                                    echo "</div>";
                                    
                               
                            
                                /* Mostrar el número de comentarios, en el caso que el valor del array esté vació 
                                pues de forma predeterminada el número de comentarios del hilo será 0 */
                                if(empty($valor['numeroComentarios'])){
                                    $valor['numeroComentarios']=0;
                                }
                                echo "<p>COMMENTS: " . $valor['numeroComentarios'] . "</p>";  
                            echo "</div>";
                            ++$contadorIndiceInput;
                        }

                        //input para que el usuario administrador pueda añadir nuevos hilos al foro
                        echo "<div id='contenedorCrearHilos'>";
                            echo "<label> NEW THEME:</label>";
                            echo "<input maxlength='20' type='text' required>";
                            echo " <button>ADD</button>";  
                        echo "</div>";                
                        echo "<h3 class='esconder'>INVALID DATA</h3>";         
                    }else{
                        //en el caso que el se haya iniciado sesión y el usuario no sea administrador pues solo tendrá el botón de acceder al hilo
                        foreach($arrayNombresHilos  as $valor){
                            echo '<div class="hiloCliente">';
                                echo "<p>NAME:". $valor['nombreHilo'] . "</p>"; 

                                echo "<div>";
                                    echo "<a href='comentarioController.php?accion=enter&hilo=" . $valor['nombreHilo'] . "'>ENTER</a>";
                                echo "</div>";

                                // Mostrar el número de comentarios
                                if(empty($valor['numeroComentarios'])){
                                    $valor['numeroComentarios']=0;
                                };
                                echo "<p>COMMENTS: " . $valor['numeroComentarios'] . "</p>";  
                            echo "</div>";
                        }                       
                    }

            }else{
                
                // en el caso de que el usuario no haya iniciado sesión pues solamente tendrá el botón de accder al hilo
                foreach($arrayNombresHilos  as $valor){
                    echo '<div class="hiloCliente">';
                        echo "<p>NAME:". $valor['nombreHilo'] . "</p>"; 

                        echo "<div>";
                            echo "<a href='comentarioController.php?accion=enter&hilo=" . $valor['nombreHilo'] . "'>ENTER</a>";
                        echo "</div>";

                        // Mostrar el número de comentarios
                        if(empty($valor['numeroComentarios'])){
                            $valor['numeroComentarios']=0;
                        };
                        echo "<p>COMMENTS: " . $valor['numeroComentarios'] . "</p>";  
                    echo "</div>";
                }               
            }
            
        }else{     
            echo "<h2>0 Themes </h2>";
        }
    }

    ?>
       
       
    </section>

    <script src="../view/js/eventosHilosForo.js"></script>
