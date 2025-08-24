<?php

// Clase que gestiona la conexión a la base de datos
class Conexion {

    // Método que establece y devuelve la conexión
    public static function conectar() {

        // Crear una nueva conexión PDO a la base de datos 'pos' en localhost con usuario 'root' y sin contraseña
        $link = new PDO("mysql:host=localhost;dbname=pos", "root", "");

        // Configurar la conexión para que utilice codificación UTF-8 (permite tildes y ñ sin problemas)
        $link->exec("set names utf8");

        // Retornar la conexión lista para ser utilizada por los modelos
        return $link;
    }
}