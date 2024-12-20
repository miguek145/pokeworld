//comprobamos si al principio de la app se aceptó el uso de cookies
if(document.cookie.includes("aceptadasCookie")){
   
   
   //obtenemos el input de buscador nombres pokemon
    var buscadorPrincipal=document.querySelector(".buscadorPrincipal");

    //la lista de las cookies de los ombres pokemons
    var listaBusqueda=document.getElementById("listaBusqueda");

    //contenedor que contiene las tarjetas pokemons
    var contenedorTarjetasPokemon=document.querySelector(".contenedorPokemons");


      //evento que cuando se haga click sobre la pág desaparezca el listado de las cookies de nombres pokemon del buscador
      document.addEventListener("click",(ev)=>{
        if(!listaBusqueda.classList.contains("esconder")){
            listaBusqueda.classList.add("esconder");
        }
    })

    // evento que se ejecute cuando se escriba en el buscador de nombres pokemon
    buscadorPrincipal.addEventListener("keyup",(ev)=>{
        if(listaBusqueda.classList.contains("esconder")){
            listaBusqueda.classList.remove("esconder");
        }

        //obtenemos los datos del input buscador pokemon
        var datoBuscador=buscadorPrincipal.value;
     
            /* comprobamos si existe la cookie del buscador para al almacenar y visualizar los nombres pokemons
            y si no existe tal cookie pues se declara*/
            if(!document.cookie.includes("ResultadosBusqueda")){
                document.cookie=`ResultadosBusqueda=declaracion;max-age=3600`;
            }
         
            var arrayCookie=document.cookie.split(";");

            for(let valor of arrayCookie){
                var arrayNombreValor=valor.split("=");
              
                if(arrayNombreValor[0]=="ResultadosBusqueda"){
                    var arrayNombresPokemonBusqueda=arrayNombreValor[1].split(",");
                }
            }
        
            //recorremos todos los nombres de los pokemons de la cookie
            for(let conta=0;conta<arrayNombresPokemonBusqueda.length;++conta){

                if(arrayNombresPokemonBusqueda[conta]!="declaracion"){

                    //vamos aplicando los nombres de los pokemons en la lista 
                    listaBusqueda.children[conta].textContent=arrayNombresPokemonBusqueda[conta];
                }

            
                /*evento que cuando se haga click sobre uno de los nombres de los pokemons 
                de la lista de opciones del buscador  que seactualicé el contenedor de las tarjetas pokemons*/
                listaBusqueda.children[conta].addEventListener("click",(ev)=>{
                
                    listaBusqueda.classList.add("esconder");
                    buscadorPrincipal.value=listaBusqueda.children[conta].textContent;

                    $.ajax({
                        url:'../../../controller/ajax/obtenerResultadoBusqueda1.php',
                        type:'GET',
                        data:{datos:listaBusqueda.children[conta].textContent},
                        success: function(response){
                            contenedorTarjetasPokemon.innerHTML=response;

                            /* esta función sirve en el caso que el usuario haya iniciado sesíon como cliente
                             pues le aparecerá los iconos de añadir a favoritos en las tarjetas de los pokemons*/
                            comprobarPokemonfavorito();
                        },
                        error: function(textStatus,errorThrown) {
                            console.log(`Tipo error:${textStatus}`)
                            console.error(`Detalles Error:${errorThrown}`);
                        }
                    })
                })
            }
        

        $.ajax({
            url:'../../../controller/ajax/obtenerDatoCookiesBuscador.php',
            type:'GET',
            data:{valorBuscadorPokemon:datoBuscador},
            success: function(response){
            
                //comprobamos si ha devuelto una respuesta óptima
                if(response!=0){

                        // comprobamos de que el array de los nombres de los pokemons exista                         
                        //comprobamos que el nombre del pokemon nuevo  no esté en el array de pokemons cookie para añadirlo
                        if(!arrayNombresPokemonBusqueda.includes(buscadorPrincipal.value)){

                            //comprobamos de que haya 5 pokemons en el array de cookie
                                if(arrayNombresPokemonBusqueda.length==5){
                                    console.log(arrayNombresPokemonBusqueda);

                                    //el pokemon nuevo se añadido al array de pokemon cookie y el último se elimina
                                    arrayNombresPokemonBusqueda.pop();
                                    arrayNombresPokemonBusqueda.unshift(buscadorPrincipal.value);
                                    console.log(arrayNombresPokemonBusqueda);

                                    //modificamos la cookie con el nuevo nombre de pokemon añadido
                                    document.cookie=`ResultadosBusqueda=${ arrayNombresPokemonBusqueda.join(",")};max-age=3600`;
                                    console.log(document.cookie);
                                }else{

                                    //añadimos el nuevo nombre pokemon al array pokemon cookie
                                    arrayNombresPokemonBusqueda.push(buscadorPrincipal.value);

                                    //modificamos la cookie con el nuevo nombre de pokemon añadido
                                    document.cookie=`ResultadosBusqueda=${ arrayNombresPokemonBusqueda.join(",")};max-age=3600`;
                                    console.log(document.cookie);
                                }
                            }
                        // }
                }
            },
            error: function(textStatus,errorThrown) {
                console.log(`Tipo error:${textStatus}`)
                console.error(`Detalles Error:${errorThrown}`);
            }
        })
    })
}else{
    //si al principio ddel programa no se aceptaron el usao de cookies,pues te eliminará esta cookie en el caso que exista
    document.cookie=`ResultadosBusqueda="";max-age=-1`;
}



function comprobarPokemonfavorito(){

    // Obtenemos todos los iconos favoritos de las tarjetas de Pokémon de la página index
    var botonesFavoritos = document.querySelectorAll(".fichaPokemon i");
    

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

