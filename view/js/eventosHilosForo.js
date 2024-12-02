
//obtenemos todos los inputs
var inputs=document.querySelectorAll("section .hiloAdministrador input");
console.log(inputs);


//obtenemos el mensaje error de inputs  vacios
var mensajeErrrorAddHiloNuevo=document.querySelector("h3");
console.log(mensajeErrrorAddHiloNuevo);

//obtenemos todos losvalores de los inputs antes de su modificación
var arrayValoresInputs=[];
for(let valor of inputs){
    arrayValoresInputs.push(valor.value);
}

console.log(arrayValoresInputs);


//obtenemos todos los botones edit
var botonesEdit=document.getElementsByClassName("botonesEditHilo");
console.log(botonesEdit);


//editar nombre hilo
for(let valor of botonesEdit){

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
                if(response==1){

                    //cambiamos el valor de get del botón ENTER por el nuevo ombre del hilo
                    valor.parentNode.nextSibling.nextSibling.children[0].setAttribute("href",`comentarioController.php?accion=enter&hilo=${valorInputNuevo}`);

                    // window.location.href = "foro.php";
                    if(!mensajeErrrorAddHiloNuevo.hasAttribute("class")){
                        mensajeErrrorAddHiloNuevo.setAttribute("class","esconder");
                        inputs[indiceInput].value=valorInputNuevo;
                    }   
                }else{
                    if( mensajeErrrorAddHiloNuevo.hasAttribute("class")){
                        mensajeErrrorAddHiloNuevo.removeAttribute("class","esconder");
                        inputs[indiceInput].value=arrayValoresInputs[indiceInput];

                    }
                }
                console.log(response);
            }
        })
        
    });
}   



//obtenemos todos los botones delete
var botonesDelete=document.getElementsByClassName("botonesDeleteHilo");
console.log(botonesDelete);


//eliminar nombre hilo
for(let valor of botonesDelete){
    valor.addEventListener("click",(ev)=>{
        let indiceInput=valor.classList[1];
        let valorInput=inputs[indiceInput].value;
        $.ajax({
            url:'../../../controller/ajax/eliminarHiloForo.php',
            type:'GET',
            data:{nombreHilo:valorInput},
            success: function(response){
                console.log(response);
                if(response==1){
                    inputs[indiceInput].parentNode.remove();
                }
            }
        })
    });
}




//obtenemos el boton add hilo
var botonAddHilo=document.querySelector("#contenedorCrearHilos button");
console.log(botonAddHilo);

//obtenemos el input para añadir el nuevo hilo
var inputAddNuevoHilo=document.querySelector("#contenedorCrearHilos input");

//crear nuevo hilo
botonAddHilo.addEventListener("click",(ev)=>{
    var valorNuevoHilo=inputAddNuevoHilo.value;
    console.log(valorNuevoHilo);
console.log("aa");
    $.ajax({
        url:'../../../controller/ajax/addNuevoHilo.php',
        type:'GET',
        data:{nombreHilo:valorNuevoHilo},
        success: function(response){
            if(response==1){
                window.location.href = "foroController.php";
                if(!mensajeErrrorAddHiloNuevo.hasAttribute("class")){
                    mensajeErrrorAddHiloNuevo.setAttribute("class","responder");
                }   
            }else{
                if( mensajeErrrorAddHiloNuevo.hasAttribute("class")){
                    mensajeErrrorAddHiloNuevo.removeAttribute("class","responder");
                }
            }
        }
    })

})