var barraNavegacion = document.querySelector("header");
var menuHamburguesa = document.getElementsByClassName("menuHamburguesa");
var barrasMenuhamburguesa=document.querySelectorAll("span");


menuHamburguesa[0].addEventListener("click", (ev) => {
    ev.stopPropagation();
    barraNavegacion.classList.toggle("esconderBarraNavegacion");

    barrasMenuhamburguesa[0].classList.toggle("linea1");
    barrasMenuhamburguesa[1].classList.toggle("linea2");
    barrasMenuhamburguesa[2].classList.toggle("linea3");

});


document.addEventListener("click",(ev)=>{
    if (window.innerWidth < 800) {
        barraNavegacion.classList.add("esconderBarraNavegacion");
            
        barrasMenuhamburguesa[0].classList.remove("linea1");
        barrasMenuhamburguesa[1].classList.remove("linea2");
        barrasMenuhamburguesa[2].classList.remove("linea3");

    }
  
})
