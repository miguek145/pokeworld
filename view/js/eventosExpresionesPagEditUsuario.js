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




    //formulario datos personales 
    var inputsFormularioDatosPersonales = document.querySelectorAll("#formularioDatosPersonales input");
    console.log(inputsFormularioDatosPersonales);
    
    //alamacenamos todas las expresiones regulares del formulario datos personales en un array
    var arrayExpresionesRegularesFormDatosPersoanles=[expresionRegularNombre,expresionRegularApellidos,expresionRegularCorreo,expresionRegularTelefono,expresionRegularTelefono]

    //obtenemos todos los mensajes de error de este formulario que indican que alguna expresion regular no coincide con el valor del campo
    var arrayMensajesErrorFormDatosPersoanles=document.getElementsByClassName("mensajeErrorDatosPersoanles");
    
    //obtenenmos el boton de editar datos personales
    var botonEditarDatosPersonales=document.getElementById("botonEditarDatosPersonales");


    for(let valor of inputsFormularioDatosPersonales){

        //le vamos aplicando el evento a cada input del formulario
        valor.addEventListener("keyup",(ev)=>{
            
            var indiceArrayExpreionesRegularesDatosPersoanles=valor.getAttribute("class");
           
            //comprobamos si el contenido del input no está vacío
            if(valor.value.length>0){

                //comprobamos si el contenido de cada input coincide con su expresión regular y si está bien se habilita  el botón  save
                if(arrayExpresionesRegularesFormDatosPersoanles[indiceArrayExpreionesRegularesDatosPersoanles].test(valor.value)){
                    if(!arrayMensajesErrorFormDatosPersoanles[indiceArrayExpreionesRegularesDatosPersoanles].classList.contains("esconder")){
                        arrayMensajesErrorFormDatosPersoanles[indiceArrayExpreionesRegularesDatosPersoanles].classList.add("esconder");
                        botonEditarDatosPersonales.removeAttribute("disabled");
                    }
                }else{

                    //muestra el mensaje de error ya que el contenido del input no coincide con la expresión regular  y se desahbilita el botón save
                    if(arrayMensajesErrorFormDatosPersoanles[indiceArrayExpreionesRegularesDatosPersoanles].classList.contains("esconder")){
                        arrayMensajesErrorFormDatosPersoanles[indiceArrayExpreionesRegularesDatosPersoanles].classList.remove("esconder");
                        botonEditarDatosPersonales.setAttribute("disabled","");
                    }
                }
            }else{

                //si el contenido del input está vacío que te muestre el mensaje de error y se desahbilita el botón save
                if(!arrayMensajesErrorFormDatosPersoanles[indiceArrayExpreionesRegularesDatosPersoanles].classList.contains("esconder")){
                    arrayMensajesErrorFormDatosPersoanles[indiceArrayExpreionesRegularesDatosPersoanles].classList.add("esconder");
                    botonEditarDatosPersonales.setAttribute("disabled","");
                }
            }
        })
    }



    //formulario datos del usuario
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
        
        //le vamos aplicando el evento a cada input del formulario
        valor.addEventListener("keyup",(ev)=>{
            var indiceArrayExpreionesRegularesDatosUsuario=valor.getAttribute("class");
                
            if(valor.value.length>0){
                
                //comprobamos si el contenido de cada input coincide con su expresión regular y si está bien se habilita  el botón  save
                 if(arrayExpresionesRegularesFormDatosUsuario[indiceArrayExpreionesRegularesDatosUsuario].test(valor.value)){
                     if(!mensajesErrorDatosFormualrioUsuario[indiceArrayExpreionesRegularesDatosUsuario].classList.contains("esconder")){
                         mensajesErrorDatosFormualrioUsuario[indiceArrayExpreionesRegularesDatosUsuario].classList.add("esconder");
                         botonEditarDatosUsuario.removeAttribute("disabled");
                     }
                 }else{
                
                     //muestra el mensaje de error ya que el contenido del input no coincide con la expresión regular  y se desahbilita el botón save
                     if(mensajesErrorDatosFormualrioUsuario[indiceArrayExpreionesRegularesDatosUsuario].classList.contains("esconder")){
                         mensajesErrorDatosFormualrioUsuario[indiceArrayExpreionesRegularesDatosUsuario].classList.remove("esconder");
                         botonEditarDatosUsuario.setAttribute("disabled","");
                     }
                 }
             }else{

                  //si el contenido del input está vacío que te muestre el mensaje de error y se desahbilita el botón save
                 if(!mensajesErrorDatosFormualrioUsuario[indiceArrayExpreionesRegularesDatosUsuario].classList.contains("esconder")){
                     mensajesErrorDatosFormualrioUsuario[indiceArrayExpreionesRegularesDatosUsuario].classList.add("esconder");
                     botonEditarDatosUsuario.setAttribute("disabled","");
                 }
             }
        })
       
    }


       //control  campo confirmación contraseña
       var mensajeContraseñasNoCoinciden=document.getElementById("mensajeContraseñasNoCoinciden");

       inputsFormularioDatosUsuario[2].addEventListener("keyup",(ev)=>{

        //conprobamos si el input de confirmacíon de contraseña es igual que el de la contraseña
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

















