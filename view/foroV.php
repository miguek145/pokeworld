

<h2 class="tituloContenedorForo">THEMES</h2>

    <section class="contenedorHilosForo">



    <?php
    
        if(isset($arrayNombresHilos)){
            if(is_array($arrayNombresHilos)){
                if(isset($_SESSION['tipoUsuario'])){
                    if($_SESSION['tipoUsuario']=="administrador"){
                        $contadorIndiceInput=0;
                        foreach($arrayNombresHilos  as $valor){
                            echo '<div class="hiloAdministrador">';
                                // Campo de texto para el nombre del hilo
                                echo "<input maxlength='20' type='text' value='" . $valor['nombreHilo'] . "' required>";
                                    echo "<div>";
                                        echo "<button  class='botonesEditHilo $contadorIndiceInput'>EDIT</button>"; 
                                    echo "</div>";
                                    echo "<div>";
                                        echo "<button class='botonesDeleteHilo $contadorIndiceInput'>DELETE</button>";  
                                    echo "</div>";
                                    echo "<div>";
                                        echo "<a href='comentarioController.php?accion=enter&hilo=" . $valor['nombreHilo'] . "'>ENTER</a>";
                                    echo "</div>";
                                    
                               
                            
                                // Mostrar el número de comentarios
                                if(empty($valor['numeroComentarios'])){
                                    $valor['numeroComentarios']=0;
                                }
                                echo "<p>COMMENTS: " . $valor['numeroComentarios'] . "</p>";  
                            echo "</div>";
                            ++$contadorIndiceInput;
                        }
                        echo "<div id='contenedorCrearHilos'>";
                            echo "<label> NEW THEME:</label>";
                            echo "<input maxlength='20' type='text' required>";
                            echo " <button>ADD</button>";  
                        echo "</div>";                
                        echo "<h3 class='esconder'>ERROR:UNPUTS CAN´T BE EMPTY</h3>";         
                    }else{
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
