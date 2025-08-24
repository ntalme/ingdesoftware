<!-- Contenedor principal -->
<div class="content-wrapper">

  <!-- Encabezado de la página -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Listado de Ventas</h1>
        </div>
      </div>
    </div>
  </section>

  <!-- Sección del contenido principal -->
  <section class="content">
    <div class="container-fluid">

      <!-- Caja que contiene la tabla de ventas -->
      <div class="card card-tabla-productos">

        <!-- Título de la caja -->
        <div class="card-header bg-dark text-white rounded-top">
          <!-- Ícono vacío por si más adelante quieres poner algo -->
          <i class></i> Ventas realizadas
        </div>

        <!-- Cuerpo de la caja -->
        <div class="card-body">

          <!-- Tabla donde se muestran las ventas -->
          <table id="tablaVentas" class="table table-bordered table-striped">
            <thead>
              <tr class="text-center">
                <th>#</th>
                <th>Vendedor</th>
                <th>Total</th>
                <th>Método de pago</th>
                <th>Fecha y Hora</th>
                <th>Productos</th>
              </tr>
            </thead>

            <!-- Cuerpo de la tabla que se llena dinámicamente con PHP -->
            <tbody>
              <?php
                // Obtener todas las ventas desde la base de datos
                $ventas = ControladorVentas::ctrMostrarVentas(null, null);

                // Recorrer todas las ventas una por una
                foreach ($ventas as $key => $venta) {

                  // Decodificar el JSON de productos vendidos 
                  $productos = json_decode($venta["productos"], true);

                  // Obtener el nombre del vendedor a partir del id_usuario
                  $item = "id";
                  $valor = $venta["id_usuario"];
                  $usuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                  $nombreVendedor = $usuario ? $usuario["nombre"] : "Sin nombre";

                  // Mostrar fila de la tabla con todos los datos
                  echo '<tr>
                          <td class="text-center">#'.$venta["id"].'</td>
                          <td class="text-center">'.$nombreVendedor.'</td>
                          <td class="text-center">$'.number_format($venta["total"], 0, ",", ".").'</td>
                          <td class="text-center">'.$venta["metodo_pago"].'</td>
                          <td class="text-center">'.date("d/m/Y H:i", strtotime($venta["fecha"])).'</td>
                          <td><ul class="mb-0">';

                            // Listar los productos vendidos con su cantidad
                            foreach ($productos as $prod) {
                              $nombre = isset($prod["nombre"]) ? $prod["nombre"] : "Producto sin nombre";
                              $cantidad = isset($prod["cantidad"]) ? $prod["cantidad"] : "0";
                              echo '<li>' . $nombre . ' x' . $cantidad . '</li>';
                            }

                  echo     '</ul></td>
                        </tr>';
                }
              ?>
            </tbody>
          </table>
        </div> 
      </div>
    </div> 
  </section> 
</div>

<!-- Enlace al archivo CSS -->
<link rel="stylesheet" href="vistas/css/listaventas.css">
