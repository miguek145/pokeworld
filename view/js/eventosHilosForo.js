//obtenemos todos los inputs
var inputs=document.querySelectorAll("section .hiloAdministrador input");

//obtenemos el mensaje error de inputs  vacios
var mensajeErrrorAddHiloNuevo=document.querySelector("h3");

//obtenemos el boton add hilo
var botonAddHilo=document.querySelector("#contenedorCrearHilos button");

//obtenemos el input para añadir el nuevo hilo
var inputAddNuevoHilo=document.querySelector("#contenedorCrearHilos input");

//obtenemos todos los botones delete
var botonesDelete=document.getElementsByClassName("botonesDeleteHilo");

//obtenemos todos los valores de los inputs antes de su modificación
var arrayValoresInputs=[];
for(let valor of inputs){
    arrayValoresInputs.push(valor.value);
}

//obtenemos todos los botones edit
var botonesEdit=document.getElementsByClassName("botonesEditHilo");


function editarHilo(){
    //editar nombre hilo
    for(let valor of botonesEdit){

        //le aplicamos el evento a cada botón editar
        valor.addEventListener("click",(ev)=>{
            let indiceInput=valor.classList[1];
            let valorInputNuevo=inputs[indiceInput].value;
            
            //array con el valor antiguo y el nuevo del input
            let arrayValoresAjax=[arrayValoresInputs[indiceInput],valorInputNuevo];
            
            $.ajax({
                url:'../../../controller/ajax/editarHiloForo.php',
                type:'GET',
                data:{datosHilo:arrayValoresAjax},
                success: function(response){

                    //si devuleve 1 todo ha ido bien
                    if(response==1){

                        //cambiamos el valor de get del botón ENTER por el nuevo nombre del hilo
                        valor.parentNode.nextSibling.nextSibling.children[0].setAttribute("href",`comentarioController.php?accion=enter&hilo=${valorInputNuevo}`);

                        if(!mensajeErrrorAddHiloNuevo.hasAttribute("class")){
                            mensajeErrrorAddHiloNuevo.setAttribute("class","esconder");
                            inputs[indiceInput].value=valorInputNuevo;
                        }   
                    }else{

                        //si no ha devuelto un 1 pues se ve´ra el mensaje de error
                        if( mensajeErrrorAddHiloNuevo.hasAttribute("class")){
                            mensajeErrrorAddHiloNuevo.removeAttribute("class","esconder");
                            inputs[indiceInput].value=arrayValoresInputs[indiceInput];

                        }
                    }
                },
                error: function(textStatus,errorThrown) {
                    console.log(`Tipo error:${textStatus}`)
                    console.error(`Detalles Error:${errorThrown}`);
                
                }
            })
            
        });
    }   
}



function eliminarHilo(){
    
    //eliminar nombre hilo
    for(let valor of botonesDelete){

        //le vamos aplicando un evento a cada botón delete
        valor.addEventListener("click",(ev)=>{
            let indiceInput=valor.classList[1];
            let valorInput=inputs[indiceInput].value;
            $.ajax({
                url:'../../../controller/ajax/eliminarHiloForo.php',
                type:'GET',
                data:{nombreHilo:valorInput},
                success: function(response){
                
                    //si devuelve un 1 es que ha ido todo bien y se ha eliminado el hilo seleccionado
                    if(response==1){

                        //además se elimna el hilo de manera dinámica sin tener que recargar la página para ver los cambios
                        inputs[indiceInput].parentNode.remove();
                    }
                },
                error: function(textStatus,errorThrown) {
                    console.log(`Tipo error:${textStatus}`)
                    console.error(`Detalles Error:${errorThrown}`);
                
                }
            })
        });
    }
}




function addHilo(){
    
    //añadimos el evento de crear un hilo nuevo al botón add hilo
    botonAddHilo.addEventListener("click",(ev)=>{

        //obtenemos el valor del nuevo hilo
        var valorNuevoHilo=inputAddNuevoHilo.value;

        $.ajax({
            url:'../../../controller/ajax/addNuevoHilo.php',
            type:'GET',
            data:{nombreHilo:valorNuevoHilo},
            success: function(response){

                //si devuelve un 1 es que ha ido todo bien
                if(response==1){
                    window.location.href = "foroController.php";
                    if(!mensajeErrrorAddHiloNuevo.hasAttribute("class")){
                        mensajeErrrorAddHiloNuevo.setAttribute("class","esponder");
                    }   
                }else{

                    //si no ha ido bien pues te mostrará el mensaje de error
                    if( mensajeErrrorAddHiloNuevo.hasAttribute("class")){
                        mensajeErrrorAddHiloNuevo.removeAttribute("class","esponder");
                    }
                }
            },
            error: function(textStatus,errorThrown) {
                console.log(`Tipo error:${textStatus}`)
                console.error(`Detalles Error:${errorThrown}`);
                
            }
        })

    })
}


editarHilo();
eliminarHilo();
addHilo();