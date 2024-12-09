//comprobamos si ya se aceptaron el uso de cookies o no en la app
if(!document.cookie.includes("cookiesAceptadas") ){

    var body=document.querySelector("body");

    //creamos los elementos para generar la ventana de uso de cookies
    var sectionCookie=document.createElement("section");
    var contenedor=document.createElement("div");
    var titulo=document.createElement("h3");
    var contenido=document.createElement("p");
    var botonAceptar=document.createElement("button");
    var botonRechazar=document.createElement("button");


    //les vamos añadiendo el contenido a los elementos creados
    titulo.textContent="COOKIES";
    contenido.textContent="We use cookies to improve your browsing experience, analyze the use of our website and deliver personalized content. You can accept all cookies or set your preferences.";
    botonAceptar.textContent="Accept";
    botonRechazar.textContent="Reject";

    //los vamos posicionando dde manera óptima
    body.appendChild(sectionCookie);
    sectionCookie.appendChild(contenedor);
    contenedor.appendChild(titulo);
    contenedor.appendChild(contenido);
    contenedor.appendChild(botonAceptar);
    contenedor.appendChild(botonRechazar);

    //les añadimos las clases a lso elementos
    sectionCookie.classList.add("fondoPestañaCookie");
    contenedor.classList.add("contenedorContenidoPestaña");


    //si aceptas el uso de cookies pues te generará una cookie que acredita que vas a querer usar cookies en la app
    botonAceptar.addEventListener("click",(ev)=>{
        document.cookie=`cookiesAceptadas=aceptadasCookie;max-age=36000;path=/`;
        window.location.href="indexController.php";
        
        //para que desaparezca la pestaña de aceptar uso de cookies
        sectionCookie.remove();
    })

    //si no aceptas el uso de cookies pues te generará una cookie que acredita que no vas a querer usar cookies en la app
    botonRechazar.addEventListener("click",(ev)=>{
        document.cookie=`cookiesAceptadas=noAceptadasCookie;max-age=36000;path=/`;
        window.location.href="indexController.php";
       
        //para que desaparezca la pestaña de aceptar uso de cookies
        sectionCookie.remove();
    })
}

