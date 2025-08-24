<?php

require_once "MySQL.php";

class ModeloVentas {

    // MOSTRAR VENTAS
    public static function mdlMostrarVentas($tabla, $item, $valor) {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY fecha DESC");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY fecha DESC");
            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt = null;
    }

    // INGRESAR VENTAS
    public static function mdlIngresarVenta($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_usuario, productos, total, metodo_pago, fecha) 
                                                VALUES (:id_usuario, :productos, :total, :metodo_pago, :fecha)");

        $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
        $stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
        $stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        } else {
            return "error";
        }

        $stmt = null; 
        
    }
}
