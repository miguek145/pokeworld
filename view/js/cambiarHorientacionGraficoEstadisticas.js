
// Obtener la anchura de la ventana del navegador
var anchoVentana = window.innerWidth;
var barrasEstadisticas=document.querySelectorAll(".estadisticas>div>div");

var arrayAlturaBarrasEstadisticasVertical=[];
var arrayAnchuraBarraEstadisticasHorizontal=[];


for(valor of barrasEstadisticas){
    var atributoStyle=valor.getAttribute("style");

    var valorWidth=atributoStyle.substring(6,9);
           
    if(valorWidth!=100){
        valorWidth=atributoStyle.substring(6,8);
    }


    console.log(valorWidth);

    arrayAlturaBarrasEstadisticasVertical.push(valorWidth);
    arrayAnchuraBarraEstadisticasHorizontal.push(valorWidth);
}



if(anchoVentana<800){
    var contadorArrayAltura=0;
    for( let valor of barrasEstadisticas){
                                              
    var atributoStyle=valor.getAttribute("style");
                           
    valor.style.width="100%";
    valor.style.height=arrayAlturaBarrasEstadisticasVertical[contadorArrayAltura]+"%";
  
    console.log(atributoStyle);
    ++contadorArrayAltura;

    }
}
//evento que se ejecuta cada vez se modifica la pestaña del navegador

window.addEventListener("resize",ev=>{
   // Obtener la anchura de la ventana del navegador
    var anchoVentana2 = window.innerWidth;
        if(anchoVentana2<800){
                var contadorArrayAltura=0;
                for( let valor of barrasEstadisticas){
                                              
                    var atributoStyle=valor.getAttribute("style");
                           
                        valor.style.width="100%";
                        valor.style.height=arrayAlturaBarrasEstadisticasVertical[contadorArrayAltura]+"%";
                      
                        console.log(atributoStyle);
                        ++contadorArrayAltura;
                }
            
        }else{
           
            var contadorArrayAnchura=0;
            for( let valor of barrasEstadisticas){
                
                valor.style.width=arrayAnchuraBarraEstadisticasHorizontal[contadorArrayAnchura]+"%";
                valor.style.height="60%";
                ++contadorArrayAnchura;
            }
        }
})



