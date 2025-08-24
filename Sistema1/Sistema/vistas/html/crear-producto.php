<!-- Contenedor principal del contenido de la página -->
<div class="content-wrapper">

  <!-- Encabezado del contenido -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Crear Productos</h1>
        </div>
      </div>
    </div>
  </section>

  <!-- Contenido principal -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <!-- Caja por defecto -->
          <div class="card">

            <!-- Encabezado de la caja -->
            <div class="card-header d-flex justify-content-between align-items-center">
              <button class="btn btn-primary btn-agregar-producto" data-toggle="modal" data-target="#modalAgregarProducto">
                <i class="fas fa-box mr-2"></i> Agregar producto
              </button>
            </div>

            <!-- Cuerpo de la caja con tabla -->
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead class="thead">
                    <tr>
                      <th style="width: 40px;">#</th>
                      <th>Código de barras</th>
                      <th>Nombre</th>
                      <th>Tamaño</th>
                      <th>Marca</th>
                      <th>Cantidad</th>
                      <th>Precio de compra</th>
                      <th>Precio de venta</th>
                      <th>Proveedor</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php 
                      $item = null;
                      $valor = null;

                      $productos = ControladorProductos::ctrMostrarProductos($item, $valor);

                      foreach ($productos as $key => $value){

                        echo '<tr>
                            <td>'.$value["id"].'</td>
                            <td>'.$value["codigo"].'</td>
                            <td>'.$value["nombre"].'</td>
                            <td>'.$value["tamano"].'</td>
                            <td>'.$value["marca"].'</td>
                            <td>'.$value["cantidad"].'</td>
                            <td>'.$value["precio_compra"].'</td>
                            <td>'.$value["precio_venta"].'</td>
                            <td>'.$value["proveedor"].'</td>
                            <td>
                              <div class="btn-group">
                                <button class="btn btn-danger btn-sm btnEliminarProducto" idProducto="'.$value["id"].'">
                                  <i></i> Eliminar
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
    </div>
  </section>
</div>

<!-- Modal: Agregar Producto -->
<div class="modal fade" id="modalAgregarProducto" tabindex="-1" role="dialog" aria-labelledby="modalAgregarProductoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <!-- Formulario -->
      <form role="form" method="post" enctype="multipart/form-data">

        <!-- Encabezado del modal -->
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="modalAgregarProductoLabel">
            <i class="fas fa-box me-2"></i> Agregar nuevo producto
          </h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <!-- Cuerpo del modal -->
        <div class="modal-body">
          <!-- Código de barras -->
          <div class="form-group">
            <label for="nuevoCodigo">Código de barras</label>
            <input type="text" class="form-control" id="nuevoCodigo" name="nuevoCodigo" placeholder="Ej: 7804320950023" required>
          </div>

          <!-- Nombre -->
          <div class="form-group">
            <label for="nuevoNombreProducto">Nombre del producto</label>
            <input type="text" class="form-control" id="nuevoNombreProducto" name="nuevoNombreProducto" placeholder="Ej: Pisco Mistral 35°" required>
          </div>

          <!-- Tamaño -->
          <div class="form-group">
            <label for="nuevoTamano">Tamaño</label>
            <input type="text" class="form-control" id="nuevoTamano" name="nuevoTamano" placeholder="Ej: 700ml, 1L, 350cc" required>
          </div>

          <!-- Marca -->
          <div class="form-group">
            <label for="nuevaMarca">Marca</label>
            <input type="text" class="form-control" id="nuevaMarca" name="nuevaMarca" placeholder="Ej: Mistral, Coca-Cola" required>
          </div>
          
          <!-- Cantidad Actual -->
          <div class="form-group">
            <label for="nuevaCantidad">Cantidad</label>
            <input type="number" class="form-control" id="nuevaCantidad" name="nuevaCantidad" placeholder="Ej: 12" min="0" required>
          </div> 

          <!-- Precios -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="nuevoPrecioCompra">Precio de compra (CLP)</label>
                <input type="number" class="form-control" id="nuevoPrecioCompra" name="nuevoPrecioCompra" placeholder="Ej: 3500" min="0" step="any" prequired>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="nuevoPrecioVenta">Precio de venta (CLP)</label>
                <input type="number" class="form-control" id="nuevoPrecioVenta" name="nuevoPrecioVenta" placeholder="Ej: 4990" min="0" step="any" required>
              </div>
            </div>
          </div>

          <!-- Fecha de vencimiento -->
          <div class="form-group">
            <label for="nuevaFechaVencimiento">Fecha de vencimiento</label>
            <input type="date" class="form-control" id="nuevaFechaVencimiento" name="nuevaFechaVencimiento">
          </div>

          <!-- Proveedor -->
          <div class="form-group">
            <label for="nuevoProveedor">Proveedor</label>
            <input type="text" class="form-control" id="nuevoProveedor" name="nuevoProveedor" placeholder="Ej: Distribuidora Los Andes" required>
          </div>
        </div>

        <!-- Footer del modal -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-guardar-producto">Guardar producto</button>
        </div>

        <?php
          $crearProducto = new ControladorProductos();
          $crearProducto -> ctrCrearProducto();
        ?>

      </form>
    </div>
  </div>
</div>

<?php
  $eliminarProducto = new ControladorProductos();
  $eliminarProducto -> ctrEliminarProducto();
?>

<!-- Enlace al archivo JS -->
<script src="vistas/js/productos.js"></script>
<!-- Enlace al archivo CSS -->
<link rel="stylesheet" href="vistas/css/productos.css">