
<main>
      
        
        <section class="contenedorPokemons">
        <?php
            if(isset($arrayDatosPokemons)){
                if(is_array($arrayDatosPokemons)){
                  echo "<h1 class='tituloPokemonFavoritos'>POKEMONS FAVORITIES</h1>";
                    for($conta=0;count($arrayDatosPokemons)>$conta;++$conta){
                    
                        // sustituimos el color de cada tarjeta de pokemon que obtenemeos de la base de datos por un color más claro
                        $colorTarjetaPokemon=$arrayDatosPokemons[$conta]['color'];
                        switch( $colorTarjetaPokemon){
                            case "green":
                                $colorTarjetaPokemon="#9bfc05";
                                break;
                            case "red":
                                $colorTarjetaPokemon="#f56960";
                                break;
                            case "blue":
                                $colorTarjetaPokemon="#69bced";
                                break;
                            case "brown":
                                $colorTarjetaPokemon="#f1b379";
                                break;
                            case "purple":
                                $colorTarjetaPokemon="#9f81f3";
                                break;
                            case "yellow":
                                $colorTarjetaPokemon="#f5f47e";
                                break;
                            case "white":
                                $colorTarjetaPokemon="#d1d1c0";
                                break;
                        }
                    
                        //vamos generando las tarjetas de los pokemons
                        echo '<a href="infoPokemonController.php?accion&nombrePokemon=' . $arrayDatosPokemons[$conta]['nombrePokemon'] . '">';
                            echo "<div style='background: linear-gradient(to bottom, white, ".$colorTarjetaPokemon.");border:2px solid ".$colorTarjetaPokemon."'  class='fichaPokemon'>";
                                echo "<div >";
                                    echo "<h4 class='nombrePokemon' >"; 
                                        echo $arrayDatosPokemons[$conta]['nombrePokemon']; 
                                    echo "</h4>";
                                    
                                    //  Viusalizar los tipos de Pokémon
                                    foreach($arrayDatosPokemons[$conta]["array"] as $valor){
                                        echo "<h5 class='tipoPokemon'>$valor</h5>";
                                    }
                                echo "</div>";
                                
                                // Mostrar la imagen del Pokémon
                                $imgPokemon = $arrayDatosPokemons[$conta]['imagenPokemon'];
                                echo "<img class='imagenPokemon' src='$imgPokemon' alt='foto pokemon'>";
    
                                if(isset($_SESSION['usuario'])){
                                    if($_SESSION['tipoUsuario']=="cliente"){
                                        if($arrayDatosPokemons[$conta]['estadoFavorito']=="favorito"){
                                            echo '<i class="fa-solid fa-heart fichapokemonfavorito "></i>';
                                        }else{
                                            echo '<i class="fa-solid fa-heart iconoTarjetaPokemon"></i>';
                                        }
                                    
                                    }
                                }
            
                            echo "</div>";
                        echo '</a>';
                    }
                }else{
                    echo $arrayDatosPokemons;
                }
            }
        ?>
        </section>
    </main>
    <script src="../view/js/eventoPagPokemonFavorito.js"></script>


