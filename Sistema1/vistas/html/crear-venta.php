<!-- Contenedor general -->
<div class="content-wrapper">

  <!-- Título de la vista  -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Crear venta</h1></div>
      </div>
    </div>
  </section>

  <!-- Sección principal del contenido -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">

      <!-- Columna izquierda: formulario de la venta -->
        <div class="col-lg-5">
          <div class="card card-tabla-productos">
            <form class="formularioVenta" method="POST">

            <!-- Encabezado del formulario con nombre del vendedor -->
            <div class="card-header d-flex justify-content-between align-items-center text-white rounded-top">
              <span class="fw-bold">
                <i class="me-2"></i> Venta
              </span>
              <span class="small">
                <i class="fas fa-user me-1"></i> Vendedor: <strong><?php echo $_SESSION["nombre"]; ?></strong>
              </span>
              <!-- ID del usuario (oculto) -->
              <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['id']; ?>">
            </div>

            <!-- Cuerpo del formulario -->
            <div class="card-body">

                <!-- Productos que se han agregado a esta venta -->
                <div class="card mb-3 card-productos mt-2">
                  <div class="card-header">
                    <strong>🧾 Productos en la venta</strong>
                  </div>
                  <div class="card-body p-0">
                    <div class="container-fluid">
                      <!-- Encabezado de columnas -->
                      <div class="row tabla-encabezado border-bottom py-2 text-center">
                        <div class="col-sm-4">Nombre</div>
                        <div class="col-sm-2">Cantidad</div>
                        <div class="col-sm-3">Precio</div>
                        <div class="col-sm-3">Acciones</div>
                      </div>
                      <!-- Aquí se insertan los productos con JS -->
                      <div class="nuevoProducto"></div>
                    </div>
                  </div>
                </div>

                <!-- Total de la venta -->
                <div class="row mb-3">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="fw-bold">Total</label>
                      <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="text" class="form-control totalVenta" id="totalVenta" name="totalVenta" readonly value="000000">
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Selección del método de pago -->
                <div class="row mb-3">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="metodoPago" class="fw-bold">Método de pago</label>
                      <select id="metodoPago" class="form-control">
                        <option disabled selected>Seleccione método de pago</option>
                        <option value="efectivo">Efectivo</option>
                        <option value="tarjeta">Tarjeta</option>
                      </select>
                      <!-- Se guarda en este input el valor seleccionado -->
                      <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">
                    </div>
                  </div>
                  <!-- Aquí se muestran inputs adicionales según el método de pago -->
                  <div id="contenedorMetodos" class="col-md-8"></div>
                </div>

                <!-- Datos ocultos que se envían con el formulario -->
                <input type="hidden" id="listaProductos" name="listaProductos">
                <input type="hidden" name="nuevaVenta" value="1">

                <!-- Botón para guardar la venta -->
                <button type="submit" class="btn btn-guardar w-100">Guardar venta</button>

              </form>

              <!-- Aquí se procesa la venta con PHP -->
              <?php
                $guardarVenta = new ControladorVentas();
                $guardarVenta->ctrCrearVenta();
              ?>
            </div> 
          </div> 
        </div>

        <!-- Columna derecha: tabla de productos para elegir -->
        <div class="col-lg-7">
          <div class="card card-tabla-productos">
            <div class="card-header">🛒 Agregar productos a la venta</div>
            <div class="card-body">
              <table id="tablaProductos" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Stock</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    // Obtener todos los productos desde el controlador
                    $item = null;
                    $valor = null;
                    $productos = ControladorProductos::ctrMostrarProductos($item, $valor);

                    // Recorrer los productos y mostrarlos en la tabla
                    foreach ($productos as $value) {
                      echo '<tr>
                        <td>'.$value["codigo"].'</td>
                        <td>'.$value["nombre"].'</td>
                        <td>'.$value["marca"].'</td>
                        <td>'.$value["cantidad"].'</td>
                        <td>'.$value["precio_venta"].'</td>
                        <td>
                          <div class="btn-group">
                            <!-- Botón para agregar producto a la venta -->
                            <button class="btn btnAgregarProducto btn-sm btn-primary" idProducto="'.$value["id"].'">
                              Agregar
                            </button>
                          </div>
                        </td>
                      </tr>';
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div> 
      </div>
    </div>
  </section>
</div>

<!-- Enlace al archivo JS -->
<script src="vistas/js/ventas.js"></script>
<!-- Enlace al archivo CSS -->
<link rel="stylesheet" href="vistas/css/ventas.css">
