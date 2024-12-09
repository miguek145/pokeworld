
// Obtener la anchura de la ventana del navegador
var anchoVentana = window.innerWidth;

//obtenemos todas las barras de las estadisticas
var barrasEstadisticas=document.querySelectorAll(".estadisticas>div>div");

//arrays para modificar las medidas de las barras de estadísticas de pendiendo de la anchura de la venta
var arrayAlturaBarrasEstadisticasVertical=[];
var arrayAnchuraBarraEstadisticasHorizontal=[];

//cuando se carque la pág por primera vez obtenedremos las medidas de anchura de cada barra de estadisticas
for(valor of barrasEstadisticas){
    var atributoStyle=valor.getAttribute("style");

    //obtenemos la medida de anchura de las barras de estadísticas
    var valorWidth=atributoStyle.substring(6,9);
           
    if(valorWidth!=100){
        valorWidth=atributoStyle.substring(6,8);
    }

    //añadimos la medida en el array
    arrayAlturaBarrasEstadisticasVertical.push(valorWidth);
    arrayAnchuraBarraEstadisticasHorizontal.push(valorWidth);
}


/* comprobamos que el ancho de la ventana sea menor 800 entonces le aplicamoslos valores
 de anchura que cogimos y se lo aplicamos a la altura de las barras de estadisticas ya que sería el diseño móvil*/
if(anchoVentana<800){
    var contadorArrayAltura=0;
    for( let valor of barrasEstadisticas){
         
    var atributoStyle=valor.getAttribute("style");
                           
    valor.style.width="100%";
    
    //el valor de la anchura que tenia al principio cada barra de estadisticas se le aplicará a la altura
    valor.style.height=arrayAlturaBarrasEstadisticasVertical[contadorArrayAltura]+"%";
  
    ++contadorArrayAltura;

    }
}


//evento que se ejecuta cada vez se modifica la pestaña del navegador
window.addEventListener("resize",ev=>{

   // Obtener la anchura de la ventana del navegador
    var anchoVentana2 = window.innerWidth;

        //comprobamos si la anchura es menor de 800px(diseño móvil)
        if(anchoVentana2<800){
                var contadorArrayAltura=0;
                for( let valor of barrasEstadisticas){
                                              
                    var atributoStyle=valor.getAttribute("style");
                           
                        valor.style.width="100%";

                        //la anchura que tenía cada barra de estadisticas en el diseño desktop , pasará a la altura de estas barras de estadísticas apra el diseño móvil
                        valor.style.height=arrayAlturaBarrasEstadisticasVertical[contadorArrayAltura]+"%";
                      
                        ++contadorArrayAltura;
                }
            
        }else{
            //diseño desktop por que la anchura de la pestaña es mayor de 800px

            var contadorArrayAnchura=0;
            for( let valor of barrasEstadisticas){
                
                 //la anltura que tenía cada barra de estadisticas en el diseño móvil , pasará a la anchura de estas barras de estadísticas para el diseño desktop
                valor.style.width=arrayAnchuraBarraEstadisticasHorizontal[contadorArrayAnchura]+"%";
                valor.style.height="60%";
                ++contadorArrayAnchura;
            }
        }
})



