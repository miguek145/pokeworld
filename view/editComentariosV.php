<main>
<section class="contenedorComentarios">
    
        <?php
    
            if(is_array($arrayComentariosUsuario)){
    
                foreach($arrayComentariosUsuario as $valor){
    
                    echo '<section class="contenedorComentarioEditar">';
                        echo '<div>';
                            echo '<h5>NAME THEME:'.$valor['nombreHilo'].'</h5>';
                            echo '<textarea name="contenidoComentarioUsuario" >'.$valor['contenidoComentario'].'</textarea>';
                            echo '<p>LIKES:'.$valor['puntuacion'].'</p>';
                        echo '</div>';
                        echo '<div>';
                            echo '<button>EDIT</button>';
                            echo '<button>DELETE</button>';
                        echo '</div>';
                    echo '</section>';
    
    
                }
            }else{
                echo $arrayComentariosUsuario;
            }
    
    
    
    
    
        ?>
</section>

</main>
<script src="../view/js/eventosComentariosdelUsuario.js"></script>
