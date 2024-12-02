//obtenemos el botón para visualizar el filtro de  búsqueda de Pokemons
var botonMostrarFiltroBusqueda = document.querySelector(".botonFiltroBusqueda");

//obtenemos el contenedor filtro búsqueda
var contenedorFiltroBusqueda = document.querySelector(".filtroBusqueda");


//obtenemos el icono del botón filters para girarlo
var iconoBotonMostrarFiltrosBusqueda=botonMostrarFiltroBusqueda.children[0];

console.log(iconoBotonMostrarFiltrosBusqueda.nodeName);



function comprobarPokemonfavorito(){
    // Obtenemos todos los iconos favoritos de las tarjetas de Pokémon
    var botonesFavoritos = document.querySelectorAll(".fichaPokemon i");
    console.log(botonesFavoritos[0].parentElement.parentElement);

    // A todos los botones de addFavoritos les aplicamos un evento para agregar o quitar favoritos 
    for (let valor of botonesFavoritos) {
        valor.addEventListener("click",(ev)=>{

            // Evitar la funcionalidad por defecto del enlace
            ev.preventDefault();

            // Acceder al enlace asociado a la pág de datos del pokemon seleccionado
            let enlace = valor.parentNode.parentNode;

            // Obtener el nombre del Pokémon desde los elementos hijos
            let nombrePokemon = valor.parentElement.children[0].children[0].textContent;


            $.ajax({
                url:'../../../controller/ajax/gestorFavoritosPokemon.php',
                type:'GET',
                data:{nombrePokemonn:nombrePokemon},
                success: function(response){
                    if(response=="favorito"){
                        valor.classList.remove("iconoTarjetaPokemon");
                        valor.classList.add("fichapokemonfavorito");
                        
                    }else{
                        valor.classList.add("iconoTarjetaPokemon");
                        valor.classList.remove("fichapokemonfavorito");
                    }
            
                }
            })
        });
    }
}






//evento cuando se haga click sobre el botón FILTER
botonMostrarFiltroBusqueda.addEventListener("click", (ev) => {

    //giramos el icono de la flecha del icono filter 180 grados
    iconoBotonMostrarFiltrosBusqueda.classList.toggle("iconoBotonFilters");

    //mostramos el filstro de búsqueda 
    contenedorFiltroBusqueda.classList.toggle("visualizarFiltroBusqueda");
});



//obtenemos el botón view more 
var botonVerMas=document.querySelector(".botonVerMasPokemons");

//obtenemos el contenedor donde se encuentran todas las tarjetas de pokemons
var contenedorTarjetasPokemon=document.querySelector(".contenedorPokemons");


//evento para que se cargue el resto de tarjetas de pokemons al pulsar el botón ver más
botonVerMas.addEventListener("click",(ev)=>{
    
    $.ajax({
        url:'../../../controller/ajax/obtenerTablaPokemon.php',
        type:'GET',
        success: function(response){
            contenedorTarjetasPokemon.innerHTML=response;
            comprobarPokemonfavorito();
        }
    })

    botonVerMas.style.display="none";
});



//para filtro busqueda pokemon

var botonBuscarFiltro=document.querySelector(".botonFiltroBusquedaSearch");
var selectoresFiltroBusqueda=document.getElementsByClassName("datosFiltroBusqueda");

botonBuscarFiltro.addEventListener("click",(ev)=>{


    let arraySelect=[selectoresFiltroBusqueda[0].value,selectoresFiltroBusqueda[1].value];
    $.ajax({
        url:'../../../controller/ajax/obtenerResultadoFiltroBusqueda.php',
        type:'GET',
        data:{datos:arraySelect},
        success: function(response){
            contenedorTarjetasPokemon.innerHTML=response;
            comprobarPokemonfavorito();
        }
    })
})



//para el buscador  de tarjetas por NOMBRE pokemon
var inputBuscarTarjetasPokemon=document.querySelector(".buscadorPrincipal");

inputBuscarTarjetasPokemon.addEventListener("keyup",(ev)=>{

    if(inputBuscarTarjetasPokemon.value.trim().length>0){
        
        $.ajax({
            url:'../../../controller/ajax/obtenerResultadoBusqueda1.php',
            type:'GET',
            data:{datos:inputBuscarTarjetasPokemon.value},
            success: function(response){
                contenedorTarjetasPokemon.innerHTML=response;
                comprobarPokemonfavorito();
            }
        })
    }

})


comprobarPokemonfavorito();