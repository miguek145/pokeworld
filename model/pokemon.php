
<?php
    require_once "conexionDB.php";

    interface interfacePokemon { 
       static public function addApi(); 
       static public function visualizarTablaPokemons(string $nombreUsuario,string $tipoUsuario);
       static public function comprobarStatsPokemonApi(string $nombrePokemon);
       static public function visualizarTablaPokemonBuscadorNombre(string $nombrePokemon,string $nombreUsuario,string $tipoUsuario);
       static public function visualizarTablaPokemonDatosFiltro(string $habitat,string $tipo,string $nombreUsuario,string $tipoUsuario);
       static public function visualizarSelectHabitat();
       static public function visualizarSelectTipo();
       static public function visualizarDatosPokemon(string $nombrePokemon);
       static public function obtenerNombrePokemonAlmacenarCookie(string $datoBuscadorPokemon);
       static public function visualizarTablaPokemonFavoritos(string $nombreUsuario,string $tipoUsuario);

    }

    class Pokemon implements interfacePokemon{

        //en este método almacenaremos todos los datos de la api en la base de datos
        static public function addApi(){

                try{

                $conexionDB = ConexionDB::conectar();
                
                //consulta para obtener la tabla pokemon
                $consultaTablaPokemon=$conexionDB->query("SELECT * FROM pokemon");

                //comprobamos si la tabla está vacío o no si lo estápues te añadira todos los datos
                if($consultaTablaPokemon->rowCount()==0){

                    echo "<h1>datos añadidos en la base de datos</h1>";

                    //todas las habilidades         
                    for($contaHabilidades=1;$contaHabilidades<178;++$contaHabilidades){

                        $stringHabilidades=file_get_contents("https://pokeapi.co/api/v2/ability/$contaHabilidades/");
                        $jsonHabilidades=json_decode($stringHabilidades,true);
                        
                        $habilidadTabla=$jsonHabilidades['name'];

                        //vamos almacenando las habilidades en la abse de datos
                        $conexionDB->query("INSERT INTO habilidad (nombreHabilidad) VALUES ('$habilidadTabla')");
                        
                    }

                    //todos los tipos pokemons
                    $stringTipos=file_get_contents("https://pokeapi.co/api/v2/type/");
                    $jsonTipos=json_decode($stringTipos,true);
            
                
                    for($contaTipos=0;$contaTipos<count($jsonTipos['results']);++$contaTipos){
                        
                        $tipoTabla=$jsonTipos['results'][$contaTipos]['name'];
                    
                        //datos añadidos en tabla tipo pokemons
                        $conexionDB->query("INSERT INTO tipo (nombreTipo) VALUES ('$tipoTabla')");
            
                        
                    }

                    //todos los habitats
                    $stringHabitats=file_get_contents("https://pokeapi.co/api/v2/pokemon-habitat/");
                    $jsonHabitats=json_decode($stringHabitats,true);

                    for($contaHabitats=0;$contaHabitats<count($jsonHabitats['results']);++$contaHabitats){
                        
            
                        $habitatTabla=$jsonHabitats['results'][$contaHabitats]['name'];
                    
                        //añadimos los habitats
                        $conexionDB->query("INSERT INTO habitat (nombreHabitat) VALUES ('$habitatTabla')");

                    
                    }

                    //recorremos los 60 primeros pokemons
                    for($conta=1;$conta<60;++$conta){
                        $string=file_get_contents("https://pokeapi.co/api/v2/pokemon/$conta/");
                        $json=json_decode($string,true);

                        $nombrePokemon=$json['name'];
                        $altura=$json['height'];
                        $peso=$json['weight'];
                        $imgNormal=$json['sprites']['other']['official-artwork']['front_default'];
                        $imgShiny=$json['sprites']['other']['official-artwork']['front_shiny'];

                        $string2=file_get_contents("https://pokeapi.co/api/v2/pokemon-species/$conta/");
                        $json2=json_decode($string2,true);


                        //habitat
                        $habitat=$json2['habitat']['name'];

                        //Consulta para obtener el id del habitat
                        $objetoIdHabitat=$conexionDB->query("SELECT idHabitat FROM habitat WHERE nombreHabitat='$habitat'");

                        $arrayHabitat=$objetoIdHabitat->fetch(PDO::FETCH_ASSOC);

                        $idHabitat=$arrayHabitat['idHabitat'];

                        //color pokemon
                        $colorPokemon=$json2['color']['name'];


                        // stats  pokemon
                        //si un stat es mayor de 100 pues he puesto que sea hasta 100 para luego viuslizarlo bien en las barras de estadísticas
        
                        //hp
                        $hp= $json['stats'][0]['base_stat'];
                        if($json['stats'][0]['base_stat']>100){
                            $hp=100;
                        }

                        //attack
                        $attack= $json['stats'][1]['base_stat'];
                        if($json['stats'][1]['base_stat']>100){
                            $attack=100;
                        }

                        //defense
                        $defense= $json['stats'][2]['base_stat'];
                        if($json['stats'][2]['base_stat']>100){
                            $defense=100;
                        }

                        //special-attack
                        $specialAttack= $json['stats'][3]['base_stat'];
                        if($json['stats'][3]['base_stat']>100){
                            $specialAttack=100;
                        }

                        //special-defense
                        $specialDefense=$json['stats'][4]['base_stat'];
                        if($json['stats'][4]['base_stat']>100){
                            $specialDefense=100;
                        }

                        //speed
                        $speed=$json['stats'][5]['base_stat'];
                        if($json['stats'][5]['base_stat']>100){
                            $speed=100;
                        }

                        //add datos tabla pokemon
                        $conexionDB->query("INSERT INTO pokemon (nombrePokemon,altura,peso,imagenPokemon,imagenPokemonShiny,color,hp,attack,defense,specialAttack,specialDefense,speed,FK_habitat) VALUES ('$nombrePokemon',$altura,$peso,'$imgNormal','$imgShiny','$colorPokemon',$hp,$attack,$defense,$specialAttack,$specialDefense,$speed,$idHabitat)");
                    
                        //obtenemos el ID del pokemon
                        $objetoIdPokemon=$conexionDB->query("SELECT IDPokemon from pokemon WHERE nombrePokemon='$nombrePokemon'");
                        $array=$objetoIdPokemon->fetch(PDO::FETCH_ASSOC);
                        $idPokemon=$array['IDPokemon'];

                        //habilidades 
                        for($conta3=0;$conta3<count($json['abilities']);++$conta3){
                            
                            $habilidad=$json['abilities'][$conta3]['ability']['name'];

                            //obtenemos id habilidad
                            $objetoIdHabilidad=$conexionDB->query("SELECT idHabilidad FROM habilidad WHERE nombreHabilidad='$habilidad'");

                            $arrayHabilidad=$objetoIdHabilidad->fetch(PDO::FETCH_ASSOC);

                            $idHabilidad=$arrayHabilidad['idHabilidad'];
                        
                            //añadimos en tabla pokemonhabilidad las habilidades y la clave foranea de cada pokemon con su correspondiente habilidad
                            $conexionDB->query("INSERT INTO pokemonhabilidad (FK_pokemon,FK_habilidad) VALUES ($idPokemon,$idHabilidad)");

                        }
                        
                        //tipos del pokemon 
                        for($conta3=0;$conta3<count($json['types']);++$conta3){

                            $tipo=$json['types'][$conta3]['type']['name'];

                            $objetoIdTipo=$conexionDB->query("SELECT idTipo FROM tipo WHERE nombreTipo='$tipo'");

                            $arrayTipo=$objetoIdTipo->fetch(PDO::FETCH_ASSOC);

                            $idTipo=$arrayTipo['idTipo'];

                            //added en tabla tipopokemon
                            $conexionDB->query("INSERT INTO tipopokemon (FK_pokemon,FK_tipo) VALUES ($idPokemon,$idTipo)");

                        }

                        //frases de pokemons
                        $contadoFrases=0;
                        $contaa=0;
                        
                        //obtenemos las frases de pokemons
                        while($contadoFrases<2){
                        
                            if($json2['flavor_text_entries'][$contaa]['language']['name']=="en"){

                                if($contadoFrases==1){
                                    if($frase1!=$json2['flavor_text_entries'][$contaa]['flavor_text']){
                                        ++$contadoFrases;     
                                        $frase2=$json2['flavor_text_entries'][$contaa]['flavor_text'];
                                    }
                                }else{
                                    ++$contadoFrases;
                                    $frase1=$json2['flavor_text_entries'][$contaa]['flavor_text'];
                                }
                            }
                            ++$contaa;
                        }


                        /*Aqui lo que hago es que en la api todas las frases de  los pokemons contienen un carácter extraño con forma de interrogación 
                        y me daba error cuando intentaba almacenar las frases en la base de datos, entonces he creado un sistema 
                        para que desaparezcan esos carácteres extraños y así poder almacenar las frases en la base de datos sin ningun problema */


                        // Crear un array con todas las letras del abecedario en minúsculas
                        $abecedarioMinusculas = range('a', 'z');

                        // Crear un array con todas las letras del abecedario en mayúsculas
                        $abecedarioMayusculas = range('A', 'Z');

                        // Combinar ambos arrays en uno solo
                        $abecedario = array_merge($abecedarioMinusculas, $abecedarioMayusculas);

                        array_push($abecedario," ",",",".",":",";");


                        //corregimos frase1
                        $arrayFrase=str_split($frase1);
                
                    
                        foreach($arrayFrase as $indice=> $valor){
                            $noEstaLetra=true;
                            foreach($abecedario as $valor2){
                                if($valor==$valor2){
                                    $noEstaLetra=false;
                                }
                            }
                            if($noEstaLetra==true){
                                $arrayFrase[$indice]="";
                            
                            }
                        }
                        
                        $fraseCorregida1=implode($arrayFrase);
                        
                        //corregimos frase2
                        $arrayFrase=str_split($frase2);
                
                    
                        foreach($arrayFrase as $indice=> $valor){
                            $noEstaLetra=true;
                            foreach($abecedario as $valor2){
                                if($valor==$valor2){
                                    $noEstaLetra=false;
                                }
                            }
                            if($noEstaLetra==true){
                                $arrayFrase[$indice]="";
                            
                            }
                        }
                        
                        $fraseCorregida2=implode($arrayFrase);
                        
                        //almacenamos las dos frases de cada pokemon en la tabla frasespokemon
                        $conexionDB->query("INSERT INTO frasespokemon (contenidoFrase,FK_pokemon) VALUES ('$fraseCorregida1',$idPokemon)");
                        $conexionDB->query("INSERT INTO frasespokemon (contenidoFrase,FK_pokemon) VALUES ('$fraseCorregida2',$idPokemon)");
                    
                    }
                }
            }catch(Exception $e){
                echo "Error:".$e->getMessage();
            }finally{
                $conexionDB=null;
            }

        }


        static public function comprobarStatsPokemonApi(string $nombrePokemon){
            try{
                $conexionDB = ConexionDB::conectar();

                //realizamos una consulta a la tabla pokemon
                $consultaTablaPokemon=$conexionDB->query("SELECT * FROM pokemon");


                $contaIdPokemons=1;

                //vamos comprobando si han cambiado los stats de los pokemons y si han cambiado se actulizarán en la abse de datos
                while($fila=$consultaTablaPokemon->fetch(PDO::FETCH_OBJ)){

                    if($fila->nombrePokemon==$nombrePokemon){
                        $string=file_get_contents("https://pokeapi.co/api/v2/pokemon/$contaIdPokemons/");
                        $json=json_decode($string,true);
                  
                        $hp= $json['stats'][0]['base_stat'];
                        $attack= $json['stats'][1]['base_stat'];
                        $defense= $json['stats'][2]['base_stat'];
                        $specialAttack= $json['stats'][3]['base_stat'];
                        $specialDefense= $json['stats'][4]['base_stat'];
                        $speed= $json['stats'][5]['base_stat'];


                        if($hp>100){
                            $hp=100;
                        }
                                               
                        if($attack>100){
                            $attack=100;
                        }
                                               
                        if($defense>100){
                            $defense=100;
                        }
                                               
                        if($specialAttack>100){
                            $specialAttack=100;
                        }
                                               
                        if($specialDefense>100){
                            $specialDefense=100;
                        }
                                               
                        if($speed>100){
                            $speed=100;
                        }
                                               

                        if($hp!=$fila->hp){
                            echo $hp;
                            $conexionDB->query("UPDATE pokemon SET hp=$hp WHERE nombrePokemon='$nombrePokemon'");
                        }

                        if($attack!=$fila->attack){
                            $conexionDB->query("UPDATE pokemon SET attack=$attack WHERE nombrePokemon='$nombrePokemon'");
                        }

                        if($defense!=$fila->defense){
                            $conexionDB->query("UPDATE pokemon SET defense=$defense WHERE nombrePokemon='$nombrePokemon'");
                        }

                        if($specialAttack!=$fila->specialAttack){
                            $conexionDB->query("UPDATE pokemon SET specialAttack=$specialAttack WHERE nombrePokemon='$nombrePokemon'");
                        }

                        if($specialDefense!=$fila->specialDefense){
                            $conexionDB->query("UPDATE pokemon SET specialDefense=$specialDefense WHERE nombrePokemon='$nombrePokemon'");
                        }

                        if($speed!=$fila->speed){
                            $conexionDB->query("UPDATE pokemon SET speed=$speed WHERE nombrePokemon='$nombrePokemon'");
                        }

                    }
                    ++$contaIdPokemons;
                }

            }catch(Eception $e){
                echo "Error:".$e->getMessage();
            }finally{
                $conexionDB=null;
            }
        }


        static public function visualizarTablaPokemons(string $nombreUsuario,string $tipoUsuario){

            try{

                $conexionDB = ConexionDB::conectar();

                //Consulta para obtener los datos del Pokémon 
                $datosTablaPokemons=$conexionDB->query("SELECT nombrePokemon,imagenPokemon,color FROM pokemon;");

                $arrayDatosPokemons=array();
                $contadorArray=0;


                while($fila=$datosTablaPokemons->fetch(PDO::FETCH_OBJ)){
                    
                    $datosTipoPokemon=$conexionDB->query("SELECT t.nombreTipo
                                                        FROM pokemon p 
                                                        INNER JOIN tipopokemon tp
                                                        ON p.IDPokemon=tp.FK_pokemon
                                                        INNER JOIN tipo t 
                                                        ON tp.FK_tipo=t.idTipo
                                                        WHERE p.nombrePokemon='$fila->nombrePokemon';");

                    $nombrePokemonn=$fila->nombrePokemon;
                    $fotoPokemon=$fila->imagenPokemon;
                    $colorPokemon=$fila->color;

                    //comprobamos si el nombre del usuario está vació o no para ver si ha iniciado sesion para cargar los pokemons favoritos
                    if($nombreUsuario==""||$tipoUsuario=="administrador"){
                    
                        array_push($arrayDatosPokemons,array("nombrePokemon"=>$nombrePokemonn,"imagenPokemon"=>$fotoPokemon,"color"=>$colorPokemon,"array"=>array()));
                    }else{

                        //consulta id Usuario
                        $consultaIdUsuario=$conexionDB->query("SELECT idUsuario FROM usuario WHERE usuario='$nombreUsuario'");
                        
                        //obtenemos el id del usuario
                        $arrayIdUsuario=$consultaIdUsuario->fetch(PDO::FETCH_ASSOC);
                        $idUsuario=$arrayIdUsuario['idUsuario'];


                        //consulta id Pokemon
                        $consultaIdPokemon=$conexionDB->query("SELECT idPokemon FROM pokemon WHERE nombrePokemon='$nombrePokemonn'");

                        //obtenemos el id pokemon
                        $arrayIdPokemon=$consultaIdPokemon->fetch(PDO::FETCH_ASSOC);
                        $idPokemon=$arrayIdPokemon['idPokemon'];


                        //consulta para comprobar si se ha añadido a favoritos el pokemon
                        $consultaComprobarFavorito=$conexionDB->query("SELECT * FROM pokemonusuario WHERE FK_usuario=$idUsuario AND FK_pokemon=$idPokemon");

                        //comprobamos si el usuario ha añadido a favoritos el pokemon
                        if($consultaComprobarFavorito->rowCount()>0){
                            array_push($arrayDatosPokemons,array("nombrePokemon"=>$nombrePokemonn,"imagenPokemon"=>$fotoPokemon,"color"=>$colorPokemon,"estadoFavorito"=>"favorito","array"=>array()));
                        }else{
                            array_push($arrayDatosPokemons,array("nombrePokemon"=>$nombrePokemonn,"imagenPokemon"=>$fotoPokemon,"color"=>$colorPokemon,"estadoFavorito"=>"noFavorito","array"=>array()));
                        }
                    }
                    
                    while($fila2=$datosTipoPokemon->fetch(PDO::FETCH_OBJ)){
                        array_push($arrayDatosPokemons[$contadorArray]["array"],$fila2->nombreTipo);
                    }
                    ++$contadorArray;
                }
                
                return $arrayDatosPokemons;
            }catch(Exception $e){
                echo "Error:".$e->getMessage();
            }finally{
                $conexionDB=null;
            }

        }


        static public function visualizarTablaPokemonBuscadorNombre(string $nombrePokemon,string $nombreUsuario,string $tipoUsuario){
     

            try {    

                $conexionDB = ConexionDB::conectar();
                     
                // Consulta para obtener los Pokémon cuyo nombre coincida con el término proporcionado
                $consultaPokemons = $conexionDB->query("SELECT nombrePokemon, imagenPokemon, color 
                                                        FROM pokemon 
                                                        WHERE nombrePokemon LIKE '%$nombrePokemon%'");
            
                $arrayDatosPokemons = array();
                $contadorArray = 0;
            
                // Verificamos si hay resultados en la consulta
                while ($fila = $consultaPokemons->fetch(PDO::FETCH_OBJ)) {
            
                    // Consulta secundaria para obtener los tipos de cada Pokémon
                    $consultaTipoPokemon = $conexionDB->query("SELECT t.nombreTipo
                                                               FROM pokemon p
                                                               INNER JOIN tipopokemon tp ON p.IDPokemon = tp.FK_pokemon
                                                               INNER JOIN tipo t ON tp.FK_tipo = t.idTipo
                                                               WHERE p.nombrePokemon = '$fila->nombrePokemon'");
            
                    // Almacenamos los datos del Pokémon
                    $nombrePokemonn = $fila->nombrePokemon;
                    $fotoPokemon = $fila->imagenPokemon;
                    $colorPokemon = $fila->color;

                    //comprobamos si el nombre del usuario está vació o no para ver si ha iniciado sesion para cargar los pokemons favoritos
                    if($nombreUsuario==""||$tipoUsuario=="administrador"){
                    
                         // Insertamos los datos básicos del Pokémon en el array
                        $arrayDatosPokemons[] = array("nombrePokemon" => $nombrePokemonn,"imagenPokemon" => $fotoPokemon,"color" => $colorPokemon,"array" => array());
                    }else{

                        //consulta id Usuario
                        $consultaIdUsuario=$conexionDB->query("SELECT idUsuario FROM usuario WHERE usuario='$nombreUsuario'");
                        
                        //obtenemos el id del usuario
                        $arrayIdUsuario=$consultaIdUsuario->fetch(PDO::FETCH_ASSOC);
                        $idUsuario=$arrayIdUsuario['idUsuario'];


                        //consulta id Pokemon
                        $consultaIdPokemon=$conexionDB->query("SELECT idPokemon FROM pokemon WHERE nombrePokemon='$nombrePokemonn'");

                        //obtenemos el id pokemon
                        $arrayIdPokemon=$consultaIdPokemon->fetch(PDO::FETCH_ASSOC);
                        $idPokemon=$arrayIdPokemon['idPokemon'];


                        //consulta para comprobar si se ha añadido a favoritos el pokemon
                        $consultaComprobarFavorito=$conexionDB->query("SELECT * FROM pokemonusuario WHERE FK_usuario=$idUsuario AND FK_pokemon=$idPokemon");

                        //comprobamos si el usuario ha añadido a favoritos el pokemon
                        if($consultaComprobarFavorito->rowCount()>0){
                            // Insertamos los datos básicos del Pokémon en el array
                            $arrayDatosPokemons[] = array("nombrePokemon" => $nombrePokemonn,"imagenPokemon" => $fotoPokemon,"color" => $colorPokemon,"estadoFavorito"=>"favorito","array" => array());
                        }else{
                            // Insertamos los datos básicos del Pokémon en el array
                            $arrayDatosPokemons[] = array("nombrePokemon" => $nombrePokemonn,"imagenPokemon" => $fotoPokemon,"color" => $colorPokemon,"estadoFavorito"=>"noFavorito","array" => array());
                        }
                    }
            
                    // Agregamos los tipos de Pokémon al array correspondiente
                    while ($fila2 = $consultaTipoPokemon->fetch(PDO::FETCH_OBJ)) {
                        $arrayDatosPokemons[$contadorArray]["array"][] = $fila2->nombreTipo;
                    }
            
                    // Incrementamos el contador
                    $contadorArray++;
                }
            
                return $arrayDatosPokemons;
            
            } catch (Exception $e) {
                // Si ocurre un error, mostramos el mensaje
                echo "Error: " . $e->getMessage();
            }finally{
                $conexionDB=null;
            }
            
        }

        
        static public function visualizarTablaPokemonDatosFiltro(string $habitat,string $tipo,string $nombreUsuario,string $tipoUsuario){
                    
            try {

                $conexionDB = ConexionDB::conectar();

                // Realizamos la primera consulta para obtener los datos de los Pokémon
                $datosTablaPokemons = $conexionDB->query("SELECT p.nombrePokemon, p.imagenPokemon, p.color
                                                        FROM pokemon p 
                                                        INNER JOIN tipopokemon tp ON p.IDPokemon = tp.FK_pokemon
                                                        INNER JOIN tipo tip ON tip.idTipo = tp.FK_tipo
                                                        INNER JOIN habitat hab ON p.FK_habitat = hab.idHabitat
                                                        WHERE hab.nombreHabitat = '$habitat' AND tip.nombreTipo = '$tipo'");

                $arrayDatosPokemons = array();
                $contadorArray = 0;

                // Si obtenemos resultados, procesamos cada fila
                while ($fila = $datosTablaPokemons->fetch(PDO::FETCH_OBJ)) {

                    // Realizamos la segunda consulta para obtener los tipos de Pokémon de cada Pokémon
                    $datosTipoPokemon = $conexionDB->query("SELECT tip.nombreTipo 
                                                            FROM pokemon p 
                                                            INNER JOIN tipopokemon tp ON p.IDPokemon = tp.FK_pokemon
                                                            INNER JOIN tipo tip ON tip.idTipo = tp.FK_tipo
                                                            INNER JOIN habitat hab ON p.FK_habitat = hab.idHabitat
                                                            WHERE p.nombrePokemon = '$fila->nombrePokemon'");

                    // Almacenamos los datos básicos del Pokémon
                    $nombrePokemonn = $fila->nombrePokemon;
                    $fotoPokemon = $fila->imagenPokemon;
                    $colorPokemon = $fila->color;



                    //comprobamos si el nombre del usuario está vació o no para ver si ha iniciado sesion para cargar los pokemons favoritos
                    if($nombreUsuario==""||$tipoUsuario=="administrador"){
                    
                        // Insertamos los datos en el array
                        $arrayDatosPokemons[] = array("nombrePokemon" => $nombrePokemonn,"imagenPokemon" => $fotoPokemon,"color" => $colorPokemon,"array" => array());
                    }else{

                       //consulta id Usuario
                       $consultaIdUsuario=$conexionDB->query("SELECT idUsuario FROM usuario WHERE usuario='$nombreUsuario'");
                       
                       //obtenemos el id del usuario
                       $arrayIdUsuario=$consultaIdUsuario->fetch(PDO::FETCH_ASSOC);
                       $idUsuario=$arrayIdUsuario['idUsuario'];


                       //consulta id Pokemon
                       $consultaIdPokemon=$conexionDB->query("SELECT idPokemon FROM pokemon WHERE nombrePokemon='$nombrePokemonn'");

                       //obtenemos el id pokemon
                       $arrayIdPokemon=$consultaIdPokemon->fetch(PDO::FETCH_ASSOC);
                       $idPokemon=$arrayIdPokemon['idPokemon'];


                       //consulta para comprobar si se ha añadido a favoritos el pokemon
                       $consultaComprobarFavorito=$conexionDB->query("SELECT * FROM pokemonusuario WHERE FK_usuario=$idUsuario AND FK_pokemon=$idPokemon");

                       //comprobamos si el usuario ha añadido a favoritos el pokemon
                        if($consultaComprobarFavorito->rowCount()>0){
                            // Insertamos los datos en el array
                            $arrayDatosPokemons[] = array("nombrePokemon" => $nombrePokemonn,"imagenPokemon" => $fotoPokemon,"color" => $colorPokemon,"estadoFavorito"=>"favorito","array" => array());
                       }else{
                            // Insertamos los datos en el array
                            $arrayDatosPokemons[] = array("nombrePokemon" => $nombrePokemonn,"imagenPokemon" => $fotoPokemon,"color" => $colorPokemon,"estadoFavorito"=>"noFavorito","array" => array());
                       }
                   }

                    // Agregamos los tipos del Pokémon al array correspondiente
                    while ($fila2 = $datosTipoPokemon->fetch(PDO::FETCH_OBJ)) {
                        $arrayDatosPokemons[$contadorArray]["array"][] = $fila2->nombreTipo;
                    }

                    // Aumentamos el contador para el siguiente Pokémon
                    $contadorArray++;
                }

                return $arrayDatosPokemons;

            } catch (Exception $e) {
                // En caso de que ocurra un error, mostramos el mensaje
                echo "Error: " . $e->getMessage();
            }finally{
                $conexionDB=null;
            }

        }

        static function visualizarSelectHabitat(){

          
            try {

                $conexionDB = ConexionDB::conectar();
              
                // Realizamos la consulta para obtener los nombres de los hábitats
                $habitatsPokemon = $conexionDB->query("SELECT nombreHabitat FROM habitat");
            
                // Verificamos si hay resultados
                if ($habitatsPokemon->rowCount()>0) {
                    $arrayHabitat = array();
                    
                    // Recorrer los resultados y almacenarlos en el array
                    while ($habitatFila = $habitatsPokemon->fetch(PDO::FETCH_ASSOC)) {
                        array_push($arrayHabitat, $habitatFila['nombreHabitat']);
                    }
                    return $arrayHabitat;
                } else {
                    echo "<h5>0 Habitats</h5>";
                }
            } catch (Exception $e) {
                // Si ocurre un error en la consulta o en la conexión, lo capturamos y mostramos un mensaje
                echo "Error: " . $e->getMessage();
            }finally{
                $conexionDB=null;
            }
          
            
        }

        static function visualizarSelectTipo(){

            try {

                $conexionDB = ConexionDB::conectar();
               
                // Realizamos la consulta para obtener los tipos de Pokémon
                $tiposPokemon = $conexionDB->query("SELECT nombreTipo FROM tipo");
            
                // Inicializamos el array donde guardaremos los tipos
                $arrayTipo = array();
            
                // Verificamos si hay resultados
                if ($tiposPokemon->rowCount()>0) {
                    // Recorremos los resultados y los agregamos al array
                    while ($tipoFila = $tiposPokemon->fetch(PDO::FETCH_ASSOC)) {
                        array_push($arrayTipo, $tipoFila['nombreTipo']);
                    }
                    return $arrayTipo;
                } else {
                    echo "<h5>0 Types</h5>";
                }
            } catch (Exception $e) {
                // Capturamos cualquier error en la consulta o en la conexión
                echo "Error: " . $e->getMessage();
            }finally{
                $conexionDB=null;
            }
        }

        static public function visualizarDatosPokemon(string $nombrePokemon){
           
            try {

                $conexionDB = ConexionDB::conectar();
               
                $arrayTodosDatosPokemons = array();
            
                // Consulta principal para obtener los datos del Pokémon
                $filaPokemonSeleccionado = $conexionDB->query("SELECT * 
                                                               FROM pokemon p 
                                                               INNER JOIN habitat h 
                                                               ON p.FK_habitat = h.idHabitat 
                                                               WHERE p.nombrePokemon = '$nombrePokemon';");
            
                // Almacenamos los datos del Pokémon
                $arrayFilaPokemon = array();
                while ($fila = $filaPokemonSeleccionado->fetch(PDO::FETCH_ASSOC)) {
                    array_push($arrayFilaPokemon, $fila);
                }
            
                // Consulta para obtener los tipos del Pokémon
                $tiposPokemon = $conexionDB->query("SELECT tip.nombreTipo 
                                                    FROM pokemon p 
                                                    INNER JOIN tipopokemon tp ON p.IDPokemon = tp.FK_pokemon 
                                                    INNER JOIN tipo tip ON tip.idTipo = tp.FK_tipo 
                                                    WHERE p.nombrePokemon = '$nombrePokemon';");
            
                $arrayTipos = array();
                while ($fila = $tiposPokemon->fetch(PDO::FETCH_OBJ)) {
                    array_push($arrayTipos, $fila->nombreTipo);
                }
            
                // Consulta para obtener las habilidades del Pokémon
                $habitatsPokemon = $conexionDB->query("SELECT h.nombreHabilidad 
                                                       FROM habilidad h 
                                                       INNER JOIN pokemonhabilidad p ON h.idHabilidad = p.FK_habilidad 
                                                       INNER JOIN pokemon po ON po.IDPokemon = p.FK_pokemon 
                                                       WHERE po.nombrePokemon = '$nombrePokemon';");
            
                $arrayHabilidades = array();
                while ($fila = $habitatsPokemon->fetch(PDO::FETCH_OBJ)) {
                    array_push($arrayHabilidades, $fila->nombreHabilidad);
                }
            
                // Consulta para obtener las frases del Pokémon
                $frasesPokemon = $conexionDB->query("SELECT f.contenidoFrase 
                                                     FROM frasespokemon f 
                                                     INNER JOIN pokemon p ON f.FK_pokemon = p.IDPokemon 
                                                     WHERE p.nombrePokemon = '$nombrePokemon';");
            
                $arrayFrases = array();
                while ($fila2 = $frasesPokemon->fetch(PDO::FETCH_OBJ)) {
                    array_push($arrayFrases, $fila2->contenidoFrase);
                }
            
                // Consulta para obtener el hábitat del Pokémon
                $habitatPokemon = $conexionDB->query("SELECT ha.nombreHabitat 
                                                      FROM habitat ha 
                                                      INNER JOIN pokemon po ON po.FK_habitat = ha.idHabitat 
                                                      WHERE po.nombrePokemon = '$nombrePokemon';");
            
                // Obtener el hábitat 
                $arrayHabitatPokemon = $habitatPokemon->fetch(PDO::FETCH_ASSOC);
            
                // Añadimos todos los datos a un solo array
                array_push($arrayTodosDatosPokemons, array(
                    "datosPrincipales" => $arrayFilaPokemon,
                    "tipos" => $arrayTipos,
                    "habilidades" => $arrayHabilidades,
                    "frases" => $arrayFrases,
                    "habitat" => $arrayHabitatPokemon['nombreHabitat']
                ));
            
                return $arrayTodosDatosPokemons;
            
            } catch (Exception $e) {
                
                // Si ocurre un error en cualquier parte del proceso
                echo "Error: " . $e->getMessage();
            }finally{
                $conexionDB=null;
            }
        }

        
        static public function obtenerNombrePokemonAlmacenarCookie(string $datoBuscadorPokemon){
            
            try {

                $conexionDB = ConexionDB::conectar();

                // Realizamos la consulta con PDO (sin consultas preparadas)
                $consulta = $conexionDB->query("SELECT nombrePokemon FROM pokemon WHERE nombrePokemon='$datoBuscadorPokemon'");
            
                // Verificamos si se encontraron resultados
                if ($consulta->rowCount()>0) {

                    // Se encontró el Pokémon
                    return 1; 
                } else {

                    // No se encontró el Pokémon
                    return 0; 
                }
            
            } catch (Exception $e) {
                // Si ocurre algún error, mostramos el mensaje
                echo "Error: " . $e->getMessage();
            }finally{
                $conexionDB=null;
            }
        }


        static public function visualizarTablaPokemonFavoritos(string $nombreUsuario,string $tipoUsuario){
            try{
                $conexionDB = ConexionDB::conectar();

                //Consulta para obtener los datos del Pokémon 
                $datosTablaPokemons=$conexionDB->query("SELECT nombrePokemon,imagenPokemon,color FROM pokemon;");

                $arrayDatosPokemons=array();
                $contadorArray=0;


                while($fila=$datosTablaPokemons->fetch(PDO::FETCH_OBJ)){
                    
                    $datosTipoPokemon=$conexionDB->query("SELECT t.nombreTipo
                                                        FROM pokemon p 
                                                        INNER JOIN tipopokemon tp
                                                        ON p.IDPokemon=tp.FK_pokemon
                                                        INNER JOIN tipo t 
                                                        ON tp.FK_tipo=t.idTipo
                                                        WHERE p.nombrePokemon='$fila->nombrePokemon';");

                    $nombrePokemonn=$fila->nombrePokemon;
                    $fotoPokemon=$fila->imagenPokemon;
                    $colorPokemon=$fila->color;

                    //comprobamos si el nombre del usuario está vació o no para ver si ha iniciado sesion para cargar los pokemons favoritos
                    if($nombreUsuario!=""||$tipoUsuario!="administrador"){
              

                        //consulta id Usuario
                        $consultaIdUsuario=$conexionDB->query("SELECT idUsuario FROM usuario WHERE usuario='$nombreUsuario'");
                        
                        //obtenemos el id del usuario
                        $arrayIdUsuario=$consultaIdUsuario->fetch(PDO::FETCH_ASSOC);
                        $idUsuario=$arrayIdUsuario['idUsuario'];


                        //consulta id Pokemon
                        $consultaIdPokemon=$conexionDB->query("SELECT idPokemon FROM pokemon WHERE nombrePokemon='$nombrePokemonn'");

                        //obtenemos el id pokemon
                        $arrayIdPokemon=$consultaIdPokemon->fetch(PDO::FETCH_ASSOC);
                        $idPokemon=$arrayIdPokemon['idPokemon'];

                        //consulta para comprobar si se ha añadido a favoritos el pokemon
                        $consultaComprobarFavorito=$conexionDB->query("SELECT * FROM pokemonusuario WHERE FK_usuario=$idUsuario AND FK_pokemon=$idPokemon");

                        //comprobamos si el usuario ha añadido a favoritos el pokemon
                        if($consultaComprobarFavorito->rowCount()>0){
                            array_push($arrayDatosPokemons,array("nombrePokemon"=>$nombrePokemonn,"imagenPokemon"=>$fotoPokemon,"color"=>$colorPokemon,"estadoFavorito"=>"favorito","array"=>array()));
                            
                            while($fila2=$datosTipoPokemon->fetch(PDO::FETCH_OBJ)){
                                array_push($arrayDatosPokemons[$contadorArray]["array"],$fila2->nombreTipo);
                            }
                            ++$contadorArray;
                        }
                    }
                    

                }
                
                if(count($arrayDatosPokemons)==0){
                    return "<h2>NONE POKEMON FAVORITE</h2>" ;
                }else{
                    return $arrayDatosPokemons;
                }
               


            }catch(Exception $e){
                // Si ocurre algún error, mostramos el mensaje
                echo "Error: " . $e->getMessage();
            }
            finally{
                $conexionDB=null;
            }
        }


        static public function obtenerDatosPokemondia(){
            try{
                $conexionDB = ConexionDB::conectar();

                //consulta para obtener el nombre del pokemon y su imagen para crear la cookie de pokemon del dia
                $consultaTablaPokemon=$conexionDB->query("SELECT nombrePokemon,imagenPokemon FROM pokemon");

                $numeroFilasTablaPokemon=$consultaTablaPokemon->rowCount();

                //para obtener un pokemon random de los primeros 50 pokemons de la base ded atos y crear una cookie con sus datos
                $numeroRandom=rand(1,50);

                $contador=1;
                while($fila=$consultaTablaPokemon->fetch(PDO::FETCH_OBJ)){
                    if($contador==$numeroRandom){
                        $arrayPokemonDia=array();

                        $nombrePokemon=$fila->nombrePokemon;
                        $imagenPokemon=$fila->imagenPokemon;

                        array_push($arrayPokemonDia,$nombrePokemon);
                        array_push($arrayPokemonDia,$imagenPokemon);
                        return $arrayPokemonDia;
                        break;
                    }
                    ++$contador;
                }
            }catch(Exception $e){
               // Si ocurre algún error, mostramos el mensaje
               echo "Error: " . $e->getMessage();
            }finally{
                $conexionDB=null;
            }
        }
    }


   
?>
