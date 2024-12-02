
    <main>
        <div class="containerCarousel">
            <?php
                require_once "../view/templates/carrusel.php";
            ?>
        </div>
        <div class="contenedorBuscadorPrincipal">

            <ul class="contenedorBuscadorPrincipal2">
                <li>
                    <input type="text" class="buscadorPrincipal">
                    <ul  id="listaBusqueda">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li> 
                    </ul>
                </li>
            </ul>
            <div class="botonLupa"><i class="fa-solid fa-magnifying-glass"></i></div>
            <button class="botonFiltroBusqueda">FILTERS <i class="fa-solid fa-arrow-left"></i></button>
            <?php
               require_once "../view/templates/filtroBusqueda.php";
            ?>
        </div>
        
        <section class="contenedorPokemons">
        <?php
            if(isset($arrayDatosPokemons)){
                for($conta=0;$conta<12;++$conta){

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
            }
        ?>
        </section>
        <button class="botonVerMasPokemons">VIEW MORE..</button>
    </main>
    <script src="../view/js/eventosBusquedaPokemons.js"></script>
    <script src="../view/js/cookiesBuscadorInteractivo.js"></script>
    <script src="../view/js/creamosVentanaAceptarCookies.js"></script>


