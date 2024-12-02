if(!document.cookie.includes("cookiesAceptadas") ){

    var body=document.querySelector("body");
    var sectionCookie=document.createElement("section");
    var contenedor=document.createElement("div");
    var titulo=document.createElement("h3");
    var contenido=document.createElement("p");
    var botonAceptar=document.createElement("button");
    var botonRechazar=document.createElement("button");


    titulo.textContent="COOKIES";
    contenido.textContent="We use cookies to improve your browsing experience, analyze the use of our website and deliver personalized content. You can accept all cookies or set your preferences.";
    botonAceptar.textContent="Accept";
    botonRechazar.textContent="Reject";

    body.appendChild(sectionCookie);
    sectionCookie.appendChild(contenedor);
    contenedor.appendChild(titulo);
    contenedor.appendChild(contenido);
    contenedor.appendChild(botonAceptar);
    contenedor.appendChild(botonRechazar);


    // body.style.overflowY="hidden";
    sectionCookie.classList.add("fondoPestañaCookie");
    contenedor.classList.add("contenedorContenidoPestaña");



    botonAceptar.addEventListener("click",(ev)=>{
        console.log("dad");
        document.cookie=`cookiesAceptadas=aceptadasCookie;max-age=36000;path=/`;
        window.location.href="indexController.php";
        console.log(document.cookie);
        sectionCookie.remove();
    })

    botonRechazar.addEventListener("click",(ev)=>{
        document.cookie=`cookiesAceptadas=noAceptadasCookie;max-age=36000;path=/`;
        window.location.href="indexController.php";
        console.log(document.cookie);
        sectionCookie.remove();
        
        
    })
}

