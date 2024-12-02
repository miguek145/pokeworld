

    <main class=" contenedorLogin">
        <section class="moverAbajoContenedorFomularioLogin contenedorFormularioRegistroLogin ">

           
                <h3>LOGIN</h3>
                <form action="" method="post">
                    <label for="username">USERNAME:</label>
                    <p>
                        <input type="text" name="username" id="username" required autocomplete="off">
                    </p>
                    <label for="password">PASSWORD:</label>
                    <p>
                        <input type="password" name="password" id="password" required autocomplete="off">
                    </p>
                   
                    <input type="submit" name="submitLogin" value="Login">
                    <p>Do you have an account?<a href="registerController.php">Registration</a></p>
                </form>
                
               <?php
                    if(isset($resultadoLogin)){
                        echo $resultadoLogin;
                    }
               ?>
        </section>
        <section>
            <h2>PokeWorld</h2>
            <img src="../view/assets/img/logo.webp" alt="imagenLogo">
        </section>
    </main>
</body>
</html>