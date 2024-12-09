<?php

    if (isset($_GET['accion'])) {

        /*compruebo si el usuario ya logoneado ha pulsado el boton logout
        para cerrar sesión*/
        if($_GET['accion']=='Logout'){
            if(isset($_SESSION['usuario'])){
                session_unset();
                session_destroy();
                header('Location:indexController.php');
                die();
            }
        }
    }

?>

    <div class="menuHamburguesa">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <header class="headerBarraNavegacion">
        <div>
            <img src="../view/assets/img/logo.webp" alt="logo">
            <a href="pagPokemonDiaController.php"><h2>PokeWorld</h2></a>
          
        </div>
        <nav>
            <ul>
                <li>
                    <a href="indexController.php">MAIN</a>
                </li>
                <li>
                    <a href="foroController.php">FORUM</a>
                </li> 

                <?php
                        if(isset($_SESSION['usuario'])){
                ?>

                <li>
                    <a href="editComentariosController.php">UR COMMENTS</a>
                </li>
                <?php
                    if($_SESSION['tipoUsuario']=="cliente"){

                ?>
                <li>
                    <a href="pagPokemonFavoritosController.php">FAVORITIES</a>
                </li>
                <?php
                    }
                ?>
                
                <li>
                    <?php

                    //comprobamos que el usuario al iniciar sesión tenga una imagen, si la tiene pues se carga y si no pues se cargará el icono de usuario
                    if(empty($imagen)){?>
                            <i class="fa-solid fa-user iconoUsuario"></i>

                            <?php
                        }else{
                            echo $imagen ;
                        }
                    
                    ?>
                    <ul class="submenu">
                        <li>
                            <a href="editPerfilController.php">EDIT</a>
                        </li>
                        <li>
                            <a href="?accion=Logout"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                        </li>
                    </ul>
                </li>
                <?php
                        }else{
                            //si el ususario no ha iniciado sesión aparecerán estas dos opciones
                            ?>
                        <li>
                            <a href="loginController.php">LOGIN</a>
                        </li>

                        <li>
                            <a href="registerController.php">REGISTER</a>
                        </li>
                            <?php
                        }
                ?>
            </ul>
        </nav>
    </header>