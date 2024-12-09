<?php

interface interfaceUsuarioCliente{
    public function addPokemonFavoritos(string $nombrePokemon);
}


class UsuarioCliente extends Usuarios implements interfaceUsuario,interfaceUsuarioCliente{

    public function addPokemonFavoritos(string $nombrePokemon){

           try{
                $conexionDB = ConexionDB::conectar();
                $nombreUsuario=$this->usuario;
                //consulta obtener id usuario
                $consultaIdUsuario=$conexionDB->query("SELECT idUsuario FROM usuario WHERE usuario='$nombreUsuario'");

                //obtenemos el id del usuario
                $arrayIdUsuario=$consultaIdUsuario->fetch(PDO::FETCH_ASSOC);
                $idUsuario=$arrayIdUsuario['idUsuario'];
                
                //consulta obtener id pokemon
                $consultaIdPokemon=$conexionDB->query("SELECT idPokemon FROM pokemon WHERE nombrePokemon='$nombrePokemon'");

                //obtenemos el id del pokemon
                $arrayIdPokemon=$consultaIdPokemon->fetch(PDO::FETCH_ASSOC);
                $idPokemon=$arrayIdPokemon['idPokemon'];
        
                //consulta para obtener la fila de la tabla pokemonusuario para comprobar si se añadió a favoritoas o no
                $consultaFavorito=$conexionDB->query("SELECT * FROM pokemonusuario WHERE FK_usuario=$idUsuario AND FK_pokemon=$idPokemon");

                if($consultaFavorito->rowCount()>0){
                    $conexionDB->query("DELETE FROM pokemonusuario WHERE FK_usuario=$idUsuario AND FK_pokemon=$idPokemon");

                    return "nofavorito";
                }else{
                    $conexionDB->query("INSERT INTO pokemonusuario (FK_usuario,FK_pokemon) VALUES($idUsuario,$idPokemon)");
                    return "favorito";
                }

           }catch(Exception $e){
                echo "Error: " . $e->getMessage();
           }finally{
            $conexionDB=null;
           }
    }


}



?>