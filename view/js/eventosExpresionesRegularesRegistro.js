
        //expresion nombre usuario
        var expresionRegularNombreUsuario=/^[a-zA-Z0-9ÁÉÍÓÚáéíóú]{1,10}/;

        //expresion contraseña
        var expresionRegularContraseña=/^(?=.*[a-záéíóú])(?=.*[A-ZÁÉÍÓÚ])(?=.*\d)(?=.*[$@$!%*?&\.])[A-ZÁÉÍÓÚa-záéíóú\d$@$!%*?&\.]{8,15}/;

        //expresion correo
        var expresionRegularCorreo=/^[a-zA-Z0-9]+@((gmail)|(hotmail))\.((com)|(es)){1,20}$/;
        
        //expresion nombre 
        var expresionRegularNombre=/^[A-ZÁÉÍÓÚ][a-záéíóú0-9]{1,10}$/;

        //expresion apellidos
        var expresionRegularApellidos=/^[A-ZÁÉÍÓÚ][a-záéíóú]+\s[A-ZÁÉÍÓÚ][a-záéíóú]{1,20}$/;

        //expresion telefono
        var expresionRegularTelefono=/^[0-9]{9}$/;

        //añadimos todas las expresiones regulares en un array
        var arrayExpresionesRegulares=[expresionRegularNombreUsuario,expresionRegularContraseña,"",expresionRegularCorreo,expresionRegularNombre,expresionRegularApellidos,expresionRegularTelefono,expresionRegularTelefono];

        //obtenemos ls inputs
        var inputs=document.querySelectorAll("p>input");

        //obtenemos el boton registrar
        var botonRegistrar=document.getElementById("botonRegistrar");

        //obtenemos todo los mensajes de error
        var mensajesError=document.querySelectorAll(".smsError");
    
        
      let contaInputs=0;
        for(let valor of inputs){

            //el dos hace referencia al input de confirmación del usuario poruq a ese no hace falta aplicarle la expresión regular
            if(contaInputs!=2 ){
                valor.addEventListener("keyup",(ev)=>{
                    var indiceArrayExpresiones=valor.getAttribute("class");
                     
                    //comprobamos que los valores de los inputs no estén vacíos
                    if(valor.value.length>0){

                            /*vamos comprobando si el valor de cada input coincide con su expresión regular y si es
                             así se habilitará el botón registrar y si se vé el mensaje de error pues se esconde*/
                            if(arrayExpresionesRegulares[indiceArrayExpresiones].test(valor.value)){
                               
                                if(!mensajesError[indiceArrayExpresiones].classList.contains("esconder")){
                                    mensajesError[indiceArrayExpresiones].classList.add("esconder");
                                    botonRegistrar.removeAttribute("disabled");
                                }
                            
                            }else{
                                //el input no coincide con su expresión regular, el botóm registrar se deshabilita y el mensaje de error se visualiza
                                if(mensajesError[indiceArrayExpresiones].classList.contains("esconder")){
                                    mensajesError[indiceArrayExpresiones].classList.remove("esconder");
                                    botonRegistrar.setAttribute("disabled","");
                                }
                            }
                    }else{

                        //el input está vacío, el botóm registrar se deshabilita y el mensaje de error se visualiza
                        if(!mensajesError[indiceArrayExpresiones].classList.contains("esconder")){
                            mensajesError[indiceArrayExpresiones].classList.add("esconder");
                            botonRegistrar.removeAttribute("disabled");
                        }
                    }
                })
            }
            ++contaInputs;
        }

        //control  campo confirmación contraseña
        var mensajeContraseñasNoCoinciden=document.getElementById("mensajeContraseñasNoCoinciden");

        //comprobamos que el input contraseña y el input confirmación contraseña tengan el mismo valor y si no el botón de registro se deshabilitará
        inputs[2].addEventListener("keyup",(ev)=>{
            if( inputs[1].value== inputs[2].value){
                if(!mensajeContraseñasNoCoinciden.classList.contains("esconder")){
                    mensajeContraseñasNoCoinciden.classList.add("esconder");
                    botonRegistrar.removeAttribute("disabled");
                }
            }else{
                if(mensajeContraseñasNoCoinciden.classList.contains("esconder")){
                    mensajeContraseñasNoCoinciden.classList.remove("esconder");
                    botonRegistrar.setAttribute("disabled","");
                }
            }
        })



        //boton add segundo telefono
        var botonAddSegundoTlf=document.getElementById("addTlf2");

        //este evento hace que cuando se haga click sobre el botón aparezca automáticamente el input para introducir el segundo teléfono
        botonAddSegundoTlf.addEventListener("click",(ev)=>{

            var tituloCampoTlf2=document.getElementById("tituloCampoTelf2");
            var contenedorInputTlf2=document.getElementById("contenidoCampoTlf2");
            tituloCampoTlf2.classList.remove("esconder");
            contenedorInputTlf2.classList.remove("esconder");
            botonAddSegundoTlf.classList.add("esconder");
        })
  




        