

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
            
                },
                error: function(textStatus,errorThrown) {
                    console.log(`Tipo error:${textStatus}`)
                    console.error(`Detalles Error:${errorThrown}`);
                }
            })
        });
    }
}


comprobarPokemonfavorito();