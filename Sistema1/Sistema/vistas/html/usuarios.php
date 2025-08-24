<!-- Contenedor general -->
<div class="content-wrapper">

  <!-- Título de la página -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Administrar Usuarios</h1>
        </div>
      </div>
    </div>
  </section>

  <!-- Sección principal del contenido -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <!-- Caja visual que contiene la tabla -->
          <div class="card">

            <!-- Encabezado -->
            <div class="card-header d-flex justify-content-between align-items-center">
              <!-- Boton Agregar Usuario -->
              <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
                <i class="fas fa-user-plus"></i> Agregar usuario
              </button>
            </div>

            <!-- Cuerpo de la caja -->
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <!-- Encabezado de la tabla -->
                  <thead class="thead">
                    <tr>
                      <th style="width: 40px;">#</th>
                      <th>Nombre</th>
                      <th>Usuario</th>
                      <th>Rol</th>
                      <th style="width: 120px;">Acciones</th>
                    </tr>
                  </thead>

                  <!-- Cuerpo de la tabla -->
                  <tbody>
                    <?php
                      $item = null;
                      $valor = null;
                      $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                      foreach ($usuarios as $key => $value){
                        echo '<tr>
                                <td>'.$value["id"].'</td>
                                <td>'.$value["nombre"].'</td>
                                <td>'.$value["usuario"].'</td>
                                <td>'.$value["rol"].'</td>
                                <td>
                                  <div class="btn-group">
                                    <!-- Botón para abrir modal de edición -->
                                    <button class="btn btn-sm btnEditarUsuario btn-editar" idUsuario="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarUsuario" title="Editar">
                                      <i class="fa fa-pencil-alt"></i> Editar
                                    </button>
                                    <!-- Botón para eliminar -->
                                    <button class="btn btn-sm btnEliminarUsuario btn-eliminar" idUsuario="'.$value["id"].'" usuario="'.$value["usuario"].'" title="Eliminar">
                                      <i class="fa fa-times"></i> Eliminar
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

<!--Modal para Agregar Usuario -->
<div class="modal fade" id="modalAgregarUsuario" tabindex="-1" role="dialog" aria-labelledby="modalAgregarUsuarioLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <!-- Formulario para crear usuario -->
      <form role="form" method="post" enctype="multipart/form-data">

        <!-- Título del modal -->
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="modalAgregarUsuarioLabel"><i class="fas fa-user-plus"></i> Agregar nuevo usuario</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <!-- Campos del formulario -->
        <div class="modal-body">
          <!-- Campo nombre -->
          <div class="form-group">
            <label for="nuevoNombre">Nombre completo</label>
            <input type="text" class="form-control" id="nuevoNombre" name="nuevoNombre" placeholder="Ingrese nombre completo" required>
          </div>

          <!-- Campo usuario -->
          <div class="form-group">
            <label for="nuevoUsuario">Nombre de usuario</label>
            <input type="text" class="form-control" id="nuevoUsuario" name="nuevoUsuario" placeholder="Ingrese nombre de usuario" required>
          </div>

          <!-- Campo contraseña -->
          <div class="form-group">
            <label for="nuevaPassword">Contraseña</label>
            <input type="password" class="form-control" id="nuevaPassword" name="nuevaPassword" placeholder="Ingrese una contraseña" required>
          </div>

          <!-- Campo rol -->
          <div class="form-group">
            <label for="nuevoRol">Rol</label>
            <select class="form-control" id="nuevoRol" name="nuevoRol" required>
              <option value="">Seleccione un rol</option>
              <option value="Administrador">Administrador</option>
              <option value="Vendedor">Vendedor</option>
            </select>
          </div>
        </div>

        <!-- Botones del modal -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar usuario</button>
        </div>

        <!-- Procesa el formulario desde PHP -->
        <?php
          $crearUsuario = new ControladorUsuarios();
          $crearUsuario -> ctrCrearUsuario();
        ?>

      </form>
    </div>
  </div>
</div>

<!-- Modal para Editar Usuario -->
<div class="modal fade" id="modalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="modalAgregarUsuarioLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <!-- Formulario para editar usuario -->
      <form role="form" method="post" enctype="multipart/form-data">

        <!-- Encabezado del modal -->
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title"><i class="fas fa-user-plus"></i> Editar usuario</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <!-- Campos para editar -->
        <div class="modal-body">
          <!-- Nombre -->
          <div class="form-group">
            <label for="editarNombre">Nombre completo</label>
            <input type="text" class="form-control" id="editarNombre" name="editarNombre" required>
          </div>

          <!-- Usuario (solo lectura) -->
          <div class="form-group">
            <label for="editarUsuario">Nombre de usuario</label>
            <input type="text" class="form-control" id="editarUsuario" name="editarUsuario" readonly>
          </div>

          <!-- Contraseña -->
          <div class="form-group">
            <label for="editarPassword">Contraseña</label>
            <input type="password" class="form-control" id="editarPassword" name="editarPassword" placeholder="Solo si desea cambiar la contraseña">
            <input type="hidden" id="passwordActual" name="passwordActual">
          </div>

          <!-- Rol -->
          <div class="form-group">
            <label for="editarRol">Rol</label>
            <select class="form-control" id="editarRol" name="editarRol" required>
              <option value="" id="editarRol"></option>
              <option value="Administrador">Administrador</option>
              <option value="Vendedor">Vendedor</option>
            </select>
          </div>
        </div>

        <!-- Botones del modal -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar usuario</button>
        </div>

        <!-- Procesamiento desde PHP -->
        <?php
          $editarUsuario = new ControladorUsuarios();
          $editarUsuario  -> ctrEditarUsuario();
        ?>

      </form>
    </div>
  </div>
</div>

<!-- PHP para borrar usuarios cuando se llama el botón eliminar -->
<?php
  $borrarUsuario = new ControladorUsuarios();
  $borrarUsuario  -> ctrBorrarUsuario();
?>

<!-- Enlace al archivo JS -->
<script src="vistas/js/usuarios.js"></script>

<!-- Enlace al archivo CSS -->
<link rel="stylesheet" href="vistas/css/usuarios.css">
