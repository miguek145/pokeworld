

    <main class=" contenedorRegistro">

    <a class="botonBack"  href="indexController.php">BACK</a>

        <section class="contenedorFormularioRegistroLogin">

           
                <h3>REGISTRATION</h3>
                <form action="" method="post">
                    <label for="username">USERNAME:</label>
                    <p>
                        <input type="text" name="username" id="username" class="0" required autocomplete="off">
                        <p class="esconder smsError">Wrong username</p>
                    </p>
                    <label for="password">PASSWORD:</label>
                    <p>
                        <input type="password" name="password" id="password" class="1" required>
                        <p class="esconder smsError " >min 8 letters first Mayus atleast 1 number and 1 special letter</p>
                    </p>
                    <label for="confirmPassword">CONFIRM PASSWORD:</label>
                    <p>
                        <input type="password" name="confirmPassword" id="confirmPassword" class="2"  required>
                        <p class="esconder smsError" id="mensajeContraseñasNoCoinciden">passwords don´t match</p>
                    </p>
                    <label for="email">EMAIL:</label>
                    <p>
                        <input type="text" name="gmail" id="email" class="3" required autocomplete="off">
                        <p class="esconder smsError">gmail/hotmail and .es/.com</p>
                    </p>
                    <label for="name">NAME:</label>
                    <p>
                        <input type="text" name="name" id="name" class="4" required  autocomplete="off">
                        <p class="esconder smsError">first letter mayus</p>
                    </p>
                    <label for="surnames">SURNAMES:</label>
                    <p>
                        <input type="text" name="surnames" id="surnames" class="5" required autocomplete="off"> 
                        <p class="esconder smsError">first letters mayus and 1 space</p>
                    </p>
                    <label for="tlf">TLF:</label>
                    <p>
                        <input type="numeric" name="tlf" id="tlf" class="6" required  autocomplete="off">
                        <p class="esconder smsError">9 numbers</p>
                    </p>
                    <div id="addTlf2">+</div>
                    <label class="esconder" id="tituloCampoTelf2" for="tlf2">TLF2:</label>
                    <p class="esconder" id="contenidoCampoTlf2">
                        <input  type="numeric" name="tlf2" id="tlf2" class="7" autocomplete="off">
                        <p class="esconder smsError">9 numbers</p>
                    </p>
                    <input type="submit" name="submitRegistration" value="Register" id="botonRegistrar" >
                </form>
                <p>Do you have an account?<a href="loginController.php">Login</a></p>
                <?php

                    //viuslaizamos aquí el resultado de la consulta
                    if(isset($resultadoRegistro)){
                        echo $resultadoRegistro;
                    }
                ?>
        </section>
        <section>
            <!-- mostramos el nombre de la aplicación y su logo -->
            <h2>PokeWorld</h2>
            <img src="../view/assets/img/logo.webp" alt="imagenLogo">
        </section>
    </main>
    <script src="../view/js/eventosExpresionesRegularesRegistro.js"></script>
</body>
</html>