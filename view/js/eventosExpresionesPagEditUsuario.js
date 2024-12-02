    //expresion nombre usuario
    var expresionRegularNombreUsuario=/^[a-zA-Z0-9ÁÉÍÓÚáéíóú]{1,10}/;
    console.log(expresionRegularNombreUsuario.test("saladus145"));

    //expresion contraseña
    var expresionRegularContraseña=/^(?=.*[a-záéíóú])(?=.*[A-ZÁÉÍÓÚ])(?=.*\d)(?=.*[$@$!%*?&\.])[A-ZÁÉÍÓÚa-záéíóú\d$@$!%*?&\.]{8,15}/;
    // console.log(expresionRegularContraseña.test("Artorias1997."));

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



    //formulario datos personales 
    var inputsFormularioDatosPersonales = document.querySelectorAll("#formularioDatosPersonales input");
    console.log(inputsFormularioDatosPersonales);
    
    //alamacenamos todas las expresiones regulares del formulario datos personales en un array
    var arrayExpresionesRegularesFormDatosPersoanles=[expresionRegularNombre,expresionRegularApellidos,expresionRegularCorreo,expresionRegularTelefono,expresionRegularTelefono]

    //obtenemos todos los mensajes de error de este formulario
    var arrayMensajesErrorFormDatosPersoanles=document.getElementsByClassName("mensajeErrorDatosPersoanles");
    
    //obtenenmos el boton de editar datos personales
    var botonEditarDatosPersonales=document.getElementById("botonEditarDatosPersonales");


    for(let valor of inputsFormularioDatosPersonales){

        valor.addEventListener("keyup",(ev)=>{
            
            var indiceArrayExpreionesRegularesDatosPersoanles=valor.getAttribute("class");
            console.log(indiceArrayExpreionesRegularesDatosPersoanles);

            if(valor.value.length>0){

                if(arrayExpresionesRegularesFormDatosPersoanles[indiceArrayExpreionesRegularesDatosPersoanles].test(valor.value)){
                    if(!arrayMensajesErrorFormDatosPersoanles[indiceArrayExpreionesRegularesDatosPersoanles].classList.contains("esconder")){
                        arrayMensajesErrorFormDatosPersoanles[indiceArrayExpreionesRegularesDatosPersoanles].classList.add("esconder");
                        // botonEditarDatosPersonales.removeAttribute("disabled");
                    }
                }else{
                    if(arrayMensajesErrorFormDatosPersoanles[indiceArrayExpreionesRegularesDatosPersoanles].classList.contains("esconder")){
                        arrayMensajesErrorFormDatosPersoanles[indiceArrayExpreionesRegularesDatosPersoanles].classList.remove("esconder");
                        // botonEditarDatosPersonales.setAttribute("disabled","");
                    }
                }
            }else{
                if(!arrayMensajesErrorFormDatosPersoanles[indiceArrayExpreionesRegularesDatosPersoanles].classList.contains("esconder")){
                    arrayMensajesErrorFormDatosPersoanles[indiceArrayExpreionesRegularesDatosPersoanles].classList.add("esconder");
                }
            }
        })
    }



    //formualrio datos del usuario
    var inputsFormularioDatosUsuario=document.querySelectorAll("#formularioDatosUsuarios input");
    console.log(inputsFormularioDatosUsuario);

    //almacenamos todos las expresiones regulares del formulario datos usuario en un array
    var arrayExpresionesRegularesFormDatosUsuario=[expresionRegularNombreUsuario,expresionRegularContraseña];

    //obtenemos todos los mensajes de error de este formulario
    var mensajesErrorDatosFormualrioUsuario=document.getElementsByClassName("mensajeErrorDatosUsuario");
    console.log(mensajesErrorDatosFormualrioUsuario);

    //obtenemos el boton editar datos usuario
    var botonEditarDatosUsuario=document.getElementById("botonEditarDatosUsuario");

    console.log(botonEditarDatosUsuario);
    for(let valor of inputsFormularioDatosUsuario){
        

        valor.addEventListener("keyup",(ev)=>{
            var indiceArrayExpreionesRegularesDatosUsuario=valor.getAttribute("class");
                
            if(valor.value.length>0){
                 console.log("correcto");
                 if(arrayExpresionesRegularesFormDatosUsuario[indiceArrayExpreionesRegularesDatosUsuario].test(valor.value)){
                     if(!mensajesErrorDatosFormualrioUsuario[indiceArrayExpreionesRegularesDatosUsuario].classList.contains("esconder")){
                         mensajesErrorDatosFormualrioUsuario[indiceArrayExpreionesRegularesDatosUsuario].classList.add("esconder");
                        //  botonEditarDatosUsuario.removeAttribute("disabled");
                     }
                 }else{
                     console.log("incorrecto");
                     if(mensajesErrorDatosFormualrioUsuario[indiceArrayExpreionesRegularesDatosUsuario].classList.contains("esconder")){
                         mensajesErrorDatosFormualrioUsuario[indiceArrayExpreionesRegularesDatosUsuario].classList.remove("esconder");
                        //  botonEditarDatosUsuario.setAttribute("disabled","");
                     }
                 }
             }else{
                 if(!mensajesErrorDatosFormualrioUsuario[indiceArrayExpreionesRegularesDatosUsuario].classList.contains("esconder")){
                     mensajesErrorDatosFormualrioUsuario[indiceArrayExpreionesRegularesDatosUsuario].classList.add("esconder");
                 }
             }
        })
       
    }


       //control  campo confirmación contraseña
       var mensajeContraseñasNoCoinciden=document.getElementById("mensajeContraseñasNoCoinciden");

       inputsFormularioDatosUsuario[2].addEventListener("keyup",(ev)=>{
           if( inputsFormularioDatosUsuario[1].value== inputsFormularioDatosUsuario[2].value){
               if(!mensajeContraseñasNoCoinciden.classList.contains("esconder")){
                   mensajeContraseñasNoCoinciden.classList.add("esconder");
                   botonEditarDatosUsuario.removeAttribute("disabled");
               }
           }else{
               if(mensajeContraseñasNoCoinciden.classList.contains("esconder")){
                   mensajeContraseñasNoCoinciden.classList.remove("esconder");
                   botonEditarDatosUsuario.setAttribute("disabled","");
               }
           }
       })

















