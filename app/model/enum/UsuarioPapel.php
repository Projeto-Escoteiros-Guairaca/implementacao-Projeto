<?php
#Nome do arquivo: UsuarioPapel.php
#Objetivo: classe Enum para os papeis de permissões do model de Usuario

class UsuarioPapel {

    public static string $SEPARADOR = "|";

    const LOBINHO = "LOBINHO";
    const ADMINISTRADOR = "ADMINISTRADOR";
    const CHEFE = "CHEFE";

    public static function getAllAsArray() {
        return [UsuarioPapel::LOBINHO, UsuarioPapel::ADMINISTRADOR, UsuarioPapel::CHEFE];
    }

}

