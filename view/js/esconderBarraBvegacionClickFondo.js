//obtenemos la barra de navegación
var barraNavegacion = document.querySelector("header");

//obtenemos el menú hamburguesa
var menuHamburguesa = document.getElementsByClassName("menuHamburguesa");

//obtenemos las barras horizontales del menú hamburguesa
var barrasMenuhamburguesa=document.querySelectorAll("span");

//a medida que se vaya clickeando el menú hamburguesa las barras horizontales de esta, harán una animación transformandose en una X
menuHamburguesa[0].addEventListener("click", (ev) => {

    //para que no se paliquen a los elementos padres
    ev.stopPropagation();
    barraNavegacion.classList.toggle("esconderBarraNavegacion");

    barrasMenuhamburguesa[0].classList.toggle("linea1");
    barrasMenuhamburguesa[1].classList.toggle("linea2");
    barrasMenuhamburguesa[2].classList.toggle("linea3");

});

/*en el caso que sea el diseño móvil y que se visulice la barra de navegación 
cuando se haga click sobre el documento pues que esta se esconda automáticamente*/

document.addEventListener("click",(ev)=>{
    if (window.innerWidth < 800) {
        barraNavegacion.classList.add("esconderBarraNavegacion");
            
        barrasMenuhamburguesa[0].classList.remove("linea1");
        barrasMenuhamburguesa[1].classList.remove("linea2");
        barrasMenuhamburguesa[2].classList.remove("linea3");

    }
  
})
