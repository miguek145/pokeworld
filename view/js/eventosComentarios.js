//obtenemos el boton add comentario
var botonAddComentario=document.getElementById("botonAddComentario");

//obtenemos el textarea del contenido del nuevo comentario
var contenidoComentarioNuevo=document.querySelector("textarea");

//obtenemos el contenedor que contiene los comentarios
var contenedorComentarios=document.getElementsByClassName("contenedorComentarios");

//obtenemos el nombre del hilo
var nombreHilo=contenedorComentarios[0].getAttribute("id");
console.log(nombreHilo);

//obtenemos el mensaje de error cuando el ussuario quiera introducir un comentario vacío
var mensajeError=document.getElementById("mensajeError");
console.log(mensajeError);


//creamos una función para añadir ids a los iconos LIKE
function addIdsBotones(){

    //obtenemos todos los iconos LIKE de los comentarios 
    var iconosLike=document.querySelectorAll(".contenedorContenidoComentario i");
    console.log(iconosLike);

    let contadorId=0;
    for(let valor of iconosLike){
        valor.setAttribute("id",contadorId);
        ++contadorId;
    }

    return iconosLike;
}



function addComentarioNuevo(){

    //evento para añadir nuevo comentario además de actuliazar la lista de comentarios
    botonAddComentario.addEventListener("click",(ev)=>{

        let contenidoInputComentario=contenidoComentarioNuevo.value;

        let arrayDatos=[contenidoInputComentario,nombreHilo]
            $.ajax({
                url:'../../../controller/ajax/addNuevoComentario.php',
                type:'GET',
                data:{datos:arrayDatos},
                success: function(response){
                        if(response==0){
                            if(mensajeError.hasAttribute("class")){
                                mensajeError.removeAttribute("class");
                            }
                    
                        }else{
                            if(!mensajeError.hasAttribute("class")){
                                mensajeError.setAttribute("class","esconder");
                                
                            }
                            contenidoComentarioNuevo.value="";
                    }
                    }
                })
            })
}




//evento de darle LIKE a un comentario
function darLikeComentario(){

      //obtenemos todos los iconos LIKE de los comentarios 
      var iconosLike=document.querySelectorAll(".contenedorContenidoComentario i");
      console.log(iconosLike);

    for(let valor of iconosLike){

        valor.addEventListener("click",(ev)=>{
            addIdsBotones();
         
            let idIcono=valor.getAttribute("id");
        
            let contenidoNumerosLike=valor.nextElementSibling;
           
            let arrayData=[idIcono,nombreHilo];

            $.ajax({
                url:'../../../controller/ajax/actualizarLikeComentario.php',
                type:'GET',
                data:{datos:arrayData},
                success: function(response){
                    if(Array.isArray(response)){
                        console.log(response);
                        let contadorLike=contenidoNumerosLike.textContent;
                        ++contadorLike;
                        contenidoNumerosLike.textContent=response[0];

                        //comprobamos si el usuario le ha dado LIKE al comentario o no , si le ha dado LIKE el c olor de fondo del botón se pondrá en blanco
                        if (response[1] === "puntuado") {
                            if (!valor.classList.contains("comentarioPuntuado")) {
                                valor.classList.add("comentarioPuntuado");
                                console.log(valor);
                            }
                        } else {
                            if (valor.classList.contains("comentarioPuntuado")) {
                                valor.classList.remove("comentarioPuntuado");
                                console.log(valor);
                            }
                        }
                        
                    }else{
                        console.error("Error AJAX no ha devuelto un dato tipo array");
                    }
                }
            })
        })
    }
}



// le aplicamos un evento a cada botón delete que permitira a cualquier usuario administrador eliminar un comentario del foro
function eliminarComentario(){
    let botonesDelete=document.getElementsByClassName("botonDeleteComentario");

    for(let valor of botonesDelete){

        valor.addEventListener("click",ev=>{
        
           let contenidoComentario=valor.parentElement.previousElementSibling.textContent;

           let arrayDatos=[nombreHilo,contenidoComentario];
            
            $.ajax({
                url:'../../../controller/ajax/eliminarComentarioPorAdministrador.php',
                type:'GET',
                data:{datos:arrayDatos},
                success: function(response){
                    console.log(response);
                    
                    //obtenemeos el contenedor del comentario para eliminarlo
                   let cotenedorCometnarioEliminar=valor.parentElement.parentElement.parentElement;
                   cotenedorCometnarioEliminar.remove();
                   addIdsBotones();
                }
            })
        })

    }
}

addComentarioNuevo();
addIdsBotones();
darLikeComentario();
eliminarComentario();