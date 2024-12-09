

// //obtenemos la barra de navegacion
var barraNavegacion=document.querySelector("header");


window.addEventListener("resize",(ev)=>{
  if(window.innerWidth>800){
    if(barraNavegacion.classList.contains("esconderBarraNavegacion")){
        barraNavegacion.classList.remove("esconderBarraNavegacion");
    }
  }
})