<?php

require_once "MySQL.php";

class ModeloProductos {

    // MOSTRAR PRODUCTOS
    public static function mdlMostrarProductos($tabla, $item, $valor){

        if($item !=null){

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
    }

    // AÑADIR PRODUCTOS
    public static function mdlIngresarProducto($tabla, $datos) {

        $stmt = Conexion::conectar()->prepare(
            "INSERT INTO $tabla (
                codigo, nombre, tamano, marca, cantidad, 
                precio_compra, precio_venta, proveedor, fecha_vencimiento
            ) VALUES (
                :codigo, :nombre, :tamano, :marca, :cantidad, 
                :precio_compra, :precio_venta, :proveedor, :fecha_vencimiento
            )"
        );

        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":tamano", $datos["tamano"], PDO::PARAM_STR);
        $stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
        $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
        $stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
        $stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);
        $stmt->bindParam(":proveedor", $datos["proveedor"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR); // nuevo campo

        if ($stmt->execute()) {
            $stmt = null;
            return "ok";
        } else {
            $stmt = null;
            return "error";
        }
    }

    // ELIMINAR PRODUCTO
    public static function mdlEliminarProducto($tabla, $datos) {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
        $stmt->bindParam(":id", $datos, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt -> close();
        $stmt = null;
    }

    // ACTUALIZAR PRODUCTO
    public static function mdlActualizarProducto($tabla, $item1, $valor1, $valor2){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

        $stmt->bindParam(":$item1", $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":id", $valor2, PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        } else {
            return "error";
        }

        $stmt -> close();
        $stmt = null;
    }

    // ACTUALIZAR STOCK
    public static function mdlSumarStock($tabla, $id, $cantidadNueva, $fechaRecepcion, $fechaVencimiento) {

        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla 
            SET cantidad = cantidad + :cantidad, 
                fecha_recepcion = :fechaRecepcion, 
                fecha_vencimiento = :fechaVencimiento 
            WHERE id = :id"
        );

        $stmt->bindParam(":cantidad", $cantidadNueva, PDO::PARAM_INT);
        $stmt->bindParam(":fechaRecepcion", $fechaRecepcion, PDO::PARAM_STR);
        $stmt->bindParam(":fechaVencimiento", $fechaVencimiento, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }
}