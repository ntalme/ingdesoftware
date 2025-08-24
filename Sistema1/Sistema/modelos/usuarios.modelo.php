<?php

require_once "MySQL.php";

class ModeloUsuarios {

    // MOSTRAR USUARIOS
    public static function mdlMostrarUsuarios($tabla, $item, $valor) {

        if($item != null){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt -> fetch();
        }
        else{
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt -> fetchAll();
        }

        $stmt -> close();
        $stmt = null;
    }

    // REGISTRAR UN NUEVO USUARIO
    public static function mdlIngresarUsuario($tabla, $datos) {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, usuario, password, rol) 
                                               VALUES (:nombre, :usuario, :password, :rol)");

        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt->bindParam(":rol", $datos["rol"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $stmt = null;
            return "ok";
        } 
        else {
            $stmt = null;
            return "error";
        }
        $stmt -> close();
        $stmt = null;
    }

    // EDITAR USUARIO
    public static function mdlEditarUsuario($tabla, $datos) {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla 
                                            SET nombre = :nombre, password = :password, rol = :rol 
                                            WHERE usuario = :usuario");

        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt->bindParam(":rol", $datos["rol"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $stmt = null;
            return "ok";
        } else {
            $stmt = null;
            return "error";
        }
    }

    // BORRAR USUARIO
    public static function mdlBorrarUsuario($tabla, $datos) {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
        $stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt = null;
            return "ok";
        } 
        else {
            $stmt = null;
            return "error";
        }
        $stmt -> close();
        $stmt = null;

    }
}
