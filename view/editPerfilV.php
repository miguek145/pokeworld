
    <main>
        <section class="contenedorEditarUsuario">
            <h5>PERSONAL INFO</h5>
                <form action="editPerfilController.php" id="formularioDatosPersonales" method="post" >
                    <p>
                        <label for="">NAME:</label>
                        <input type="text" name="nombre" class="0" value=<?php echo $arrayDatosUsuario['nombre'] ?> id="" required autocomplete="off">
                        <h6 class="esconder mensajeErrorDatosPersoanles">wrong data</h6>
                    </p>
                    <p>
                        <label for="">SURNAME:</label>
                        <input type="text" name="apellidos" class="1" value="<?php echo $arrayDatosUsuario['apellido1'] . ' ' . $arrayDatosUsuario['apellido2'] ?>" required id="" autocomplete="off">
                        <h6 class="esconder mensajeErrorDatosPersoanles">1 space first letters mayus</h6>
                    </p>
                    <p>
                        <label for="">EMAIL:</label>
                        <input type="text" name="email" class="2" value=<?php echo $arrayDatosUsuario['correo'] ?>  id="" required autocomplete="off">
                        <h6 class="esconder mensajeErrorDatosPersoanles">gmail/hotmail and .es/.com</h6>
                    </p>
                    <p>
                        <label for="">TLF:</label>
                        <input type="numeric" name="tlf" class="3" value=<?php echo $arrayDatosUsuario['telefono'] ?> id="" required autocomplete="off">
                        <h6 class="esconder mensajeErrorDatosPersoanles">9 numbers</h6>
                    </p>
                    <p>
                        <label for="">TLF2:</label>
                         
                        <?php 
                        if (empty($arrayDatosUsuario['telefono2'])) {
                            ?>
                             <input type="numeric" placeholder="optional" class="4"  name="tlf2" id="" autocomplete="off">
                            <?php
                        } else {
                            echo '<input type="text" value="' . $arrayDatosUsuario['telefono2'] . '" name="tlf2" id="" >';
                        
                        }
                        ?>  
                            <h6 class="esconder mensajeErrorDatosPersoanles">9 numbers</h6>
                    </p>
                        <input type="submit" value="SAVE" id="botonEditarDatosPersonales" name="editarPerfilInfoPersonal">
                  
                   
                </form>
                <?php      
                    if(isset($resultadoDatosPersonalesEditados)){
                        echo $resultadoDatosPersonalesEditados;
                    }
                ?>
                <hr>
                <h5>USER INFO:</h5>
                <form action="editPerfilController.php" method="post" id="formularioDatosUsuarios" enctype="multipart/form-data">
                    <p>
                        <label for="">USERNAME:</label>
                        <input type="text" name="usuario" class="0" value=<?php echo $arrayDatosUsuario['usuario'] ?>   id="" required autocomplete="off">
                        <h6 class="esconder mensajeErrorDatosUsuario">wrong data</h6>
                    </p>
                    <p>
                        <label for="">PASSWORD:</label>
                        <input type="password" name="password" class="1"  placeholder="optional" id="contraseña" >
                        <h6 class="esconder mensajeErrorDatosUsuario">first letter mayus and at least 1 number and 1 spcial character</h6>
                    </p>
                    <p>
                        <label for="">CONFIRM PASSWORD:</label>
                        <input type="password" name="confirmPassword" placeholder="optional"  id="confirmContraseña">
                        <h6 class="esconder" id="mensajeContraseñasNoCoinciden">passwords don´t match</h6>
                    </p>
                    <p>
                        <label for="imagen">UPLOAD IMAGE (OPTIONAL):</label>
                        <input type="file" name="imagen" id="imagen"  accept="image/jpeg, image/png, img/jpg" >
                    </p>

                    <input type="submit" value="SAVE" id="botonEditarDatosUsuario" name="editarPerfilInfoUsuario">
                </form>
                <?php

                //visualizamos los resultados después de editar el perfil
                    if(isset($resultadoDatosUsuarioEditados)){
                        if(is_array($resultadoDatosUsuarioEditados)){
                            foreach($resultadoDatosUsuarioEditados as  $valor){
                                echo $valor;
                            }
                        }else{
                            echo $resultadoDatosUsuarioEditados;
                        }
                    }
                ?>
        </section>
    </main>
    <script src="../view/js/eventosExpresionesPagEditUsuario.js"></script>
</body>
</html>