
        //expresion nombre usuario
        var expresionRegularNombreUsuario=/^[a-zA-Z0-9ÁÉÍÓÚáéíóú]{1,10}/;
        console.log(expresionRegularNombreUsuario.test("saladus145"));

        //expresion contraseña
        var expresionRegularContraseña=/^(?=.*[a-záéíóú])(?=.*[A-ZÁÉÍÓÚ])(?=.*\d)(?=.*[$@$!%*?&\.])[A-ZÁÉÍÓÚa-záéíóú\d$@$!%*?&\.]{8,15}/;

        //expresion correo
        var expresionRegularCorreo=/^[a-zA-Z0-9]+@((gmail)|(hotmail))\.((com)|(es)){1,20}$/;
        console.log(expresionRegularCorreo.test("miguelsaladus@gmail.com"));
        
        //expresion nombre 
        var expresionRegularNombre=/^[A-ZÁÉÍÓÚ][a-záéíóú0-9]{1,10}$/;
        console.log(expresionRegularNombre.test("Miguel"));

        //expresion apellidos
        var expresionRegularApellidos=/^[A-ZÁÉÍÓÚ][a-záéíóú]+\s[A-ZÁÉÍÓÚ][a-záéíóú]{1,20}$/;
        console.log(expresionRegularApellidos.test("Gutierrez Noguera"));

        //expresion telefono
        var expresionRegularTelefono=/^[0-9]{9}$/;
        console.log(expresionRegularTelefono.test("658412385"));

        var arrayExpresionesRegulares=[expresionRegularNombreUsuario,expresionRegularContraseña,"",expresionRegularCorreo,expresionRegularNombre,expresionRegularApellidos,expresionRegularTelefono,expresionRegularTelefono];
       console.log(arrayExpresionesRegulares.length);

        //obtenemos ls inputs
        var inputs=document.querySelectorAll("p>input");
        console.log(inputs);
        //obtenemos el boton registrar
        var botonRegistrar=document.getElementById("botonRegistrar");

        //obtenemos todo los mensajes de error
        var mensajesError=document.querySelectorAll(".smsError");
        console.log(mensajesError);
        
      let contaInputs=0;
        for(let valor of inputs){

            //el dos hace referencia al input de confirmación del usuario
            if(contaInputs!=2 ){
                valor.addEventListener("keyup",(ev)=>{
                    var indiceArrayExpresiones=valor.getAttribute("class");
                        
                    if(valor.value.length>0){
                            if(arrayExpresionesRegulares[indiceArrayExpresiones].test(valor.value)){
                                console.log("esta bien");
                                if(!mensajesError[indiceArrayExpresiones].classList.contains("esconder")){
                                    mensajesError[indiceArrayExpresiones].classList.add("esconder");
                                    botonRegistrar.removeAttribute("disabled");
                                }
                            
                            }else{
                                console.log("esta mal");
                                if(mensajesError[indiceArrayExpresiones].classList.contains("esconder")){
                                    mensajesError[indiceArrayExpresiones].classList.remove("esconder");
                                    botonRegistrar.setAttribute("disabled","");
                                }
                            }
                    }else{
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

        botonAddSegundoTlf.addEventListener("click",(ev)=>{

            var tituloCampoTlf2=document.getElementById("tituloCampoTelf2");
            var contenedorInputTlf2=document.getElementById("contenidoCampoTlf2");
            tituloCampoTlf2.classList.remove("esconder");
            contenedorInputTlf2.classList.remove("esconder");
            botonAddSegundoTlf.classList.add("esconder");
        })
  




        