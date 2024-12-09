

//obtenemos todos los textarea
var textareas=document.querySelectorAll("textarea");


//obtenemos el contenedor de los comentarios 
var contenedorComentarios=document.getElementsByClassName("contenedorComentarios");


//función para aplicar el id  a cada textarea cadavez que se pulsae un botín EDIT o DELETE
function addIDtextAreas(){
//obtenemos todos los textarea
var textareas=document.querySelectorAll("textarea");
    let contaId=0;
    for(let valor of textareas){
        valor.setAttribute("id",contaId);
        ++contaId;
    }

    return textareas
}



//evento cuando se pulse un botón EDIT
function agregarEventosEditar(){
    //obtenemos todos los botones EDIT
var botonesEdit=document.querySelectorAll("section>div:nth-child(2)>button:first-child");
console.log(botonesEdit);


    for(let valor of botonesEdit){
       //le vamos aplicando el evento a todos los botones edit
        valor.addEventListener("click",(ev)=>{
            let divContenedorBotones=valor.parentNode;
            let divContenedorContenidoComentario=divContenedorBotones.previousSibling;
            let idComentario=divContenedorContenidoComentario.children[1].getAttribute("id");
            let valorComentario=divContenedorContenidoComentario.children[1].value;
            //obtenemos el contenido del comentario y el id de esto para editarlo
            let arrayAjax=[idComentario,valorComentario];

            $.ajax({
                url:'../../../controller/ajax/actualizarContenidoComentario.php',
                type:'GET',
                data:{datos:arrayAjax},
                success: function(response){
                    console.log(response);
                }
            })

        });
    }
}



function agregarEventosEliminar() {
        //obtenemos todos los botones DELETE
        var botonesDelete=document.querySelectorAll("section>div:nth-child(2)>button:nth-child(2)");
        console.log(botonesDelete);
    
    for(let valor of botonesDelete){
        valor.addEventListener("click", (ev) => {
        
            let divContenedorBotones = valor.parentNode;
            let divContenedorComentario = divContenedorBotones.previousSibling;
         
            let idComentario = divContenedorComentario.children[1].getAttribute("id");
            let valorComentario = divContenedorComentario.children[1].value;
            let contenidoTituloHilo=divContenedorComentario.children[0].textContent;
            let nombreHilo=contenidoTituloHilo.substring(11);
            console.log(nombreHilo);
            let arrayAjax = [idComentario, valorComentario,nombreHilo];

            // Hacemos la llamada AJAX
            $.ajax({
                url: '../../../controller/ajax/eliminarComentario.php',
                type: 'GET',
                data: { datos: arrayAjax },
                success: (response) => {
                    // Actualizamos el contenedor de comentarios con la respuesta del servidor
                    contenedorComentarios[0].innerHTML = response;


               
                    //función para aplicar el id  a cada textarea cadavez que se pulsae un botín EDIT o DELETE
                    addIDtextAreas();

                    // Vuelve a agregar eventos a los botones DELETE y EDIT porque el DOM ha cambiado
                    agregarEventosEliminar();
                    agregarEventosEditar();
              
                },
                error: (err) => {
                    console.error("Error en la llamada AJAX:", err);
                }
            });
        });
    };
}

addIDtextAreas();
agregarEventosEliminar();
agregarEventosEditar();