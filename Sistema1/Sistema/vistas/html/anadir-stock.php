<!-- Contenedor principal del contenido de la página -->
<div class="content-wrapper">

  <!-- Encabezado del contenido -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Añadir Stock</h1>
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

            <!-- Cuerpo de la caja con tabla -->
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead class>
                    <tr>
                      <th style="width: 40px;">#</th>
                      <th>Código de barras</th>
                      <th>Nombre</th>
                      <th>Tamaño</th>
                      <th>Marca</th>
                      <th>Cantidad</th>
                      <th>Fecha de recepcion</th>
                      <th>Fecha de vencimiento</th>
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
                            <td>'.$value["fecha_recepcion"].'</td>
                            <td>'.$value["fecha_vencimiento"].'</td>
                            <td>'.$value["proveedor"].'</td>
                            <td>
                              <div class="btn-group">
                                <button class="btn btn-primary btn-sm btnAgregarStock" idProducto="'.$value["id"].'" data-toggle="modal" data-target="#modalAgregarStock">
                                  Añadir stock
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

<!-- Modal: Añadir Stock -->
<div class="modal fade" id="modalAgregarStock" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form method="post">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Añadir Stock</h5>
          <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          
          <input type="hidden" name="idProductoStock" id="idProductoStock">

          <div class="form-group">
            <label>Cantidad recibida</label>
            <input type="number" class="form-control" name="nuevaCantidadStock" required>
          </div>

          <div class="form-group">
            <label>Fecha de recepción</label>
            <input type="date" class="form-control" name="nuevaFechaRecepcion" required>
          </div>

          <div class="form-group">
            <label>Fecha de vencimiento</label>
            <input type="date" class="form-control" name="nuevaFechaVencimiento">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

        <?php
          $agregarStock = new ControladorProductos();
          $agregarStock -> ctrAgregarStock();
        ?>
      </div>
    </form>
  </div>
</div>

<script src="vistas/js/productos.js"></script>
<link rel="stylesheet" href="vistas/css/stock.css">