
    <main class=" contenedorLogin">

        <!-- este botón al pulsarlo te devuelve a la página de inicio -->
        <a class="botonBack" href="indexController.php">BACK</a>

        <section class="moverAbajoContenedorFomularioLogin contenedorFormularioRegistroLogin ">

                <h3>LOGIN</h3>
                <form action="" method="post">
                    <label for="username">USERNAME:</label>
                    <p>
                        <input type="text" name="username" id="username" required autocomplete="off" autofocus>
                    </p>
                    <label for="password">PASSWORD:</label>
                    <p>
                        <input type="password" name="password" id="password" required autocomplete="off">
                    </p>
                   
                    <input type="submit" name="submitLogin" value="Login">

                    <!-- enlace que te translada a la página de registro -->
                    <p>Do you have an account?<a href="registerController.php">Registration</a></p>
                </form>
                
               <?php
                //aqui te mostrará el resultado final después de pulsar el botón login
                    if(isset($resultadoLogin)){
                        echo $resultadoLogin;
                    }
               ?>
        </section>
        <section>

        <!-- mostramos el nombre de la aplicación y su logo -->
            <h2>PokeWorld</h2>
            <img src="../view/assets/img/logo.webp" alt="imagenLogo">
        </section>
    </main>
</body>
</html>