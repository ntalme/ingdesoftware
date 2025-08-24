<!-- Contenedor general -->
<div class="content-wrapper">

  <!-- Sección del encabezado -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Inventario</h1>
        </div>
      </div>
    </div>
  </section>

  <!-- Sección principal del contenido -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <!-- Caja que contiene la tabla de inventario -->
          <div class="card">

            <!-- Cuerpo de la tarjeta donde va la tabla -->
            <div class="card-body">
              <div class="table-responsive">
                <!-- Tabla de inventario -->
                <table class="table table-bordered table-striped">
                  
                  <!-- Encabezado de la tabla -->
                  <thead> 
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
                    </tr>
                  </thead>

                  <!-- Cuerpo de la tabla generado con PHP -->
                  <tbody>
                    <?php 
                      // Llama al controlador para obtener todos los productos
                      $item = null;
                      $valor = null;

                      $productos = ControladorProductos::ctrMostrarProductos($item, $valor);

                      // Recorre todos los productos uno por uno y genera una fila en la tabla
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

<!-- Enlace al archivo CSS -->
<link rel="stylesheet" href="vistas/css/inventario.css">
