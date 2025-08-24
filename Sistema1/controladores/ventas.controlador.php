<?php

class ControladorVentas {

  // Mostrar todas las ventas
  public static function ctrMostrarVentas($item, $valor) {

    $tabla = "venta";

    // Este método debe estar en tu modelo
    $respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

    return $respuesta;
  }

  // CREAR VENTA
  public function ctrCrearVenta() {

    if (isset($_POST["nuevaVenta"])) {

      $listaProductos = json_decode($_POST["listaProductos"], true);

      foreach ($listaProductos as $key => $value) {

        $tabla = "producto";

        // Obtener producto actual
        $item = "id";
        $valor = $value["id"];
        $producto = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);

        // Calcular nuevo stock
        $stockActual = $producto["cantidad"];
        $cantidadVendida = $value["cantidad"];
        $nuevoStock = $stockActual - $cantidadVendida;

        // Actualizar stock
        $itemActualizar = "cantidad"; 
        ModeloProductos::mdlActualizarProducto($tabla, $itemActualizar, $nuevoStock, $value["id"]);
      }

      date_default_timezone_set('America/Santiago');
      $tabla = "venta";

      $datos = array(
        "id_usuario"   => $_POST["idUsuario"],
        "productos"     => $_POST["listaProductos"],
        "total"         => $_POST["totalVenta"],
        "metodo_pago"   => $_POST["listaMetodoPago"],
        "fecha"         => date("Y-m-d H:i:s")
      );

      $respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);

      if ($respuesta == "ok") {
        echo "<script>
          Swal.fire({
            icon: 'success',
            title: '¡Venta guardada!',
            text: 'La venta se ha registrado correctamente.',
            confirmButtonText: 'OK'
          }).then((result) => {
            if(result.isConfirmed){
              window.location = 'crear-venta';
            }
          });
        </script>";   
      }
    }
  }
}
