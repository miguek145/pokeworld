<aside class="filtroBusqueda">
    <h4>Habitats</h4>
    <?php
        if(is_array($arrayHabitats)){
            echo '<select class="datosFiltroBusqueda" name="select">';
            foreach($arrayHabitats as $valor){
                echo '<option value='.$valor.'>'.$valor.'</option>';
            }
            echo '</select>';
        }else{
            echo $arrayHabitats;
        }
    ?>
    <hr>
    <h4>Types</h4>
    <?php
           if(is_array($arrayTipos)){
            echo '<select class="datosFiltroBusqueda" name="select">';
            foreach($arrayTipos as $valor){
                echo '<option value='.$valor.'>'.$valor.'</option>';
            }
            echo '</select>';
        }else{
            echo $arrayTipos;
        }

    ?>
    <br>
    <button class="botonFiltroBusquedaSearch">SEARCH</button>
</aside>