
    <main>
        <?php

        //comprobamos si nos ha devuelto los datos del pokemon
        if(is_array($arrayTodosDatosPokemon)){

            //visualizamos el nombre del pokemon 
            echo '<h1>'.$arrayTodosDatosPokemon[0]['datosPrincipales'][0]['nombrePokemon'].'</h1>';

            // contenedor que contiene los datos de los pokemons
            echo '<section class="contenedorDatosPokemon">';

                //contenedor imagen del pokemon
                echo '<div class="contenedorImagenPokemon">';
                    echo '<img src="' . $arrayTodosDatosPokemon[0]['datosPrincipales'][0]['imagenPokemon'] . '" alt="fotoPokemon">';
                echo "</div>";
                
                //contenedor especificaciones
                echo '<div class="contenedorEspecifiaciones">';
                    echo "<h3>DETAILS:</h3>";
                        echo '<div class="datosPokemon">';

                            echo '<div>';
                                echo "<h6>HEIGHT</h6>";
                                echo "<h6>".$arrayTodosDatosPokemon[0]['datosPrincipales'][0]['altura']."</h6>";
                            echo '</div>';

                            echo '<div>';
                                echo "<h6>COLOUR</h6>";
                                echo "<h6>".$arrayTodosDatosPokemon[0]['datosPrincipales'][0]['color']."</h6>";
                            echo '</div>';

                            echo '<div>';
                                echo "<h6>HABILITY</h6>";

                                //un pokemon puede tener más de una habilidad por eso lo recorremos en un array
                                foreach($arrayTodosDatosPokemon[0]['habilidades'] as  $valor){
                                    echo "<h6>$valor</h6>";
                                }
                            echo '</div>';

                            echo '<div>';
                                echo "<h6>WEIGHT</h6>";
                                echo "<h6>".$arrayTodosDatosPokemon[0]['datosPrincipales'][0]['peso']."</h6>";
                            echo '</div>';

                            echo '<div>';
                                echo "<h6>HABITAT</h6>";
                                echo "<h6>".$arrayTodosDatosPokemon[0]['habitat']."</h6>";
                            echo '</div>';

                        echo '</div>';
                echo "</div>";

                //contenedor frases
                echo '<div class="contenedorFrases">';
                    echo "<h3>MORE INFO:</h3>";

                    //un pokemon tiene asignado dos frases
                    foreach($arrayTodosDatosPokemon[0]['frases'] as  $valor){
                        echo "<p>-".$valor."</p>";
                        
                    }
                echo "</div>";
                    
                //contenedor estadisticas
                echo '<div class="contenedorEstadisticas">';
                    echo "<h3>STADISTICS:</h3>";
                        echo "<div class='estadisticas'>";
                            
                                echo "<div>";
                                
                                        echo "<p>HP</p>";
                                        $grafica= $arrayTodosDatosPokemon[0]['datosPrincipales'][0]['hp'];

                                        //con el valor del hp que lo contiene la variable gráfica, genero la abrra del hp
                                        echo "<div style='width:" . $grafica . "%'></div>";
                        
                                    echo "<p>".$arrayTodosDatosPokemon[0]['datosPrincipales'][0]['hp']."</p>";
                                echo "</div>";

                                echo "<div>";
                                
                                        echo "<p>DPS</p>";
                                        $grafica= $arrayTodosDatosPokemon[0]['datosPrincipales'][0]['attack'];

                                        //con el valor del dps que lo contiene la variable gráfica, genero la abrra del dps
                                        echo "<div style='width:" . $grafica . "%'></div>";
                                
                                    echo "<p>".$arrayTodosDatosPokemon[0]['datosPrincipales'][0]['attack']."</p>";
                                echo "</div>";

                                echo "<div>";
                                    
                                        echo "<p>DEF</p>";
                                        $grafica= $arrayTodosDatosPokemon[0]['datosPrincipales'][0]['defense'];

                                        //con el valor del def que lo contiene la variable gráfica, genero la abrra del def
                                        echo "<div style='width:" . $grafica . "%'></div>";
                                
                                    echo "<p>".$arrayTodosDatosPokemon[0]['datosPrincipales'][0]['defense']."</p>";
                                echo "</div>";

                                echo "<div>";
                                
                                        echo "<p>SA</p>";
                                        $grafica= $arrayTodosDatosPokemon[0]['datosPrincipales'][0]['specialAttack'];

                                        //con el valor del ataque especial que lo contiene la variable gráfica, genero la abrra del ataque especial
                                        echo "<div style='width:" . $grafica. "%'></div>";
                                
                                    echo "<p>".$arrayTodosDatosPokemon[0]['datosPrincipales'][0]['specialAttack']."</p>";
                                echo "</div>";

                                echo "<div>";
                                    
                                        echo "<p>SD</p>";
                                        $grafica= $arrayTodosDatosPokemon[0]['datosPrincipales'][0]['specialDefense'];

                                        //con el valor del defensa especial que lo contiene la variable gráfica, genero la abrra del defensa especial
                                        echo "<div style='width:" . $grafica. "%'></div>";
                            
                                    echo "<p>".$arrayTodosDatosPokemon[0]['datosPrincipales'][0]['specialDefense']."</p>";
                                echo "</div>";

                                echo "<div>";
                
                                        echo "<p>SPD</p>";
                                        $grafica=$arrayTodosDatosPokemon[0]['datosPrincipales'][0]['speed'];

                                        //con el valor del speed que lo contiene la variable gráfica, genero la abrra del speed
                                        echo "<div style='width:" . $grafica . "%'></div>";
                                
                                    echo "<p>".$arrayTodosDatosPokemon[0]['datosPrincipales'][0]['speed']."</p>";
                                echo "</div>";       
                        echo "</div>";
                echo "</div>";

                //    contenedor pokemonShiny
                    echo '<div class="contenedorPokemonShiny">';
                    echo "<div>";
                        echo "<h3>SHINY</h3>";
                        echo "<h3>VERSION</h3>";
                    echo "</div>";

                        //viusalizamos la imagen el pokemon en su versión shiny
                        echo '<img src="' . $arrayTodosDatosPokemon[0]['datosPrincipales'][0]['imagenPokemonShiny'] . '" alt="fotoPokemonShiny">';
                    echo '</div>';
            echo '</section>';
        }else{
            echo $arrayTodosDatosPokemon;
        }
            ?>
        </div>
    </main>
    <script src="../view/js/cambiarHorientacionGraficoEstadisticas.js"></script>


