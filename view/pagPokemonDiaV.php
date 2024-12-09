<main>
    
    <h3 class="tituloPokemonDia">POKEMON OF THE DAY</h3>

    <?php

        //se comprueba si está declarada y no es nula la cookie de pokemon del día pues e mostrará la cookie del nombre del pokemon del día y su foto
        if(isset($_COOKIE['nombrePokemonDia'])){
            ?>
                 <h3 ><?php echo $_COOKIE['nombrePokemonDia'];?></h3>
                <img class="imagenPokemonDia" src="<?php echo $_COOKIE['imagenPokemonDia'];?>" alt="imagen pokemon del día">
           
            <?php
        }else{
            ?>
                <!-- en el caso de que no existan las cookies del pokemon del día, pues aparecerá esta mensaje -->
                <h3>NONE POKEMON</h3>
            <?php
        }
    ?>
    

</main>