<?php

class ControladorProductos{
    
    // AGREGAR PRODUCTO
    public static function ctrCrearProducto() {

        if (isset($_POST["nuevoCodigo"])) {

            // Validaciones de campos
            if (
                preg_match('/^[0-9]+$/', $_POST["nuevoCodigo"]) &&
                preg_match('/^[a-zA-Z0-9\sáéíóúÁÉÍÓÚñÑ°.,-]+$/u', $_POST["nuevoNombreProducto"]) &&
                preg_match('/^[0-9a-zA-Z\s°mlMLccCCL.]+$/', $_POST["nuevoTamano"]) &&
                preg_match('/^[a-zA-Z0-9\sáéíóúÁÉÍÓÚñÑ.-]+$/u', $_POST["nuevaMarca"]) &&
                preg_match('/^[0-9]+$/', $_POST["nuevaCantidad"]) &&
                preg_match('/^\d+(\.\d{1,2})?$/', $_POST["nuevoPrecioCompra"])&&
                preg_match('/^\d+(\.\d{1,2})?$/', $_POST["nuevoPrecioVenta"]) &&
                preg_match('/^[a-zA-Z0-9\sáéíóúÁÉÍÓÚñÑ.-]+$/u', $_POST["nuevoProveedor"])
            ) {

                $tabla = "producto";

                $datos = array(
                    "codigo"            => $_POST["nuevoCodigo"],
                    "nombre"            => $_POST["nuevoNombreProducto"],
                    "tamano"            => $_POST["nuevoTamano"],
                    "marca"             => $_POST["nuevaMarca"],
                    "cantidad"          => $_POST["nuevaCantidad"],
                    "precio_compra"     => $_POST["nuevoPrecioCompra"],
                    "precio_venta"      => $_POST["nuevoPrecioVenta"],
                    "fecha_vencimiento" => $_POST["nuevaFechaVencimiento"],
                    "proveedor"         => $_POST["nuevoProveedor"]
                );

                $respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡Producto registrado!",
                            text: "El producto ha sido guardado correctamente.",
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "crear-producto";;
                            }
                        });
                    </script>';
                }

            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Error al registrar",
                        text: "Uno o más campos contienen caracteres no válidos.",
                        confirmButtonText: "Cerrar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "crear-producto";
                        }
                    });
                </script>';
                }
        }
    }

    // MOSTRAR PRODUCTOS
    public static function ctrMostrarProductos($item, $valor){

        $tabla = "producto";
        $respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);
        return $respuesta;
    }

    // ELIMINAR PRODUCTO
    public static function ctrEliminarProducto(){

        if(isset($_GET["idProducto"])){

            $tabla = "producto";
            $datos = $_GET["idProducto"];

            $respuesta = ModeloProductos::mdlEliminarProducto($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "¡Producto Borrado!",
                        text: "El producto ha sido borrado correctamente.",
                        confirmButtonText: "Cerrar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "crear-producto";
                        }
                    });
                </script>';
            }
        }
    }

    // AÑADIR STOCK
    public static function ctrAgregarStock() {

        if (isset($_POST["idProductoStock"])) {

            $tabla = "producto";
            $id = $_POST["idProductoStock"];
            $cantidadNueva = $_POST["nuevaCantidadStock"];
            $fechaRecepcion = $_POST["nuevaFechaRecepcion"];
            $fechaVencimiento = $_POST["nuevaFechaVencimiento"];

            $respuesta = ModeloProductos::mdlSumarStock($tabla, $id, $cantidadNueva, $fechaRecepcion, $fechaVencimiento);

            if ($respuesta == "ok") {
            echo '<script>
                Swal.fire({
                icon: "success",
                title: "Stock actualizado",
                showConfirmButton: false,
                timer: 1500
                }).then(() => {
                window.location = "anadir-stock";
                });
            </script>';
            }
        }
    }

}