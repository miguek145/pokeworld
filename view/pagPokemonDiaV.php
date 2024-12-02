<main>
    
    <h3 class="tituloPokemonDia">POKEMON OF THE DAY</h3>

    <?php
        if(isset($_COOKIE['nombrePokemonDia'])){
            ?>
                <img class="imagenPokemonDia" src="<?php echo $_COOKIE['imagenPokemonDia'];?>" alt="imagen pokemon del día">
                <h3 ><?php echo $_COOKIE['nombrePokemonDia'];?></h3>
            <?php
        }else{
            ?>
                <h3>NONE POKEMON</h3>
            <?php
        }
    ?>
    

</main>