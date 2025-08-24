<!-- Contenedor para el fondo o imagen decorativa -->
<div id="back"></div>

<!-- Caja principal del formulario de login -->
<div class="login-box">

  <!-- Sección del logo del sistema -->
  <div class="login-logo text-center">
    <img src="vistas/imagenes/logoblanco.jpg" alt="Logo Botillería Joaquín" style="max-width: 370px; width: 100%;">
  </div>

  <!-- Tarjeta que contiene el formulario -->
  <div class="card">

    <!-- Contenedor del formulario -->
    <div class="card-body login-card-body">

      <!-- Título que aparece encima del formulario -->
      <p class="login-box-msg">Ingresar al sistema de ventas e inventario</p>

      <!-- Formulario de login -->
      <form method="post">
        <!-- Campo para el nombre de usuario -->
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span> 
            </div>
          </div>
        </div>

        <!-- Campo para la contraseña -->
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span> 
            </div>
          </div>
        </div>

        <!-- Botón de ingreso centrado -->
        <div class="row justify-content-center">
          <div class="col-6">
            <button type="submit" class="btn btn-custom btn-block">Ingresar</button>
          </div>
        </div>
      <?php
        $login = new ControladorUsuarios();
        $login -> ctrIngresoUsuario();
      ?>
      </form>
    </div>
  </div>
</div>
<link rel="stylesheet" href="vistas/css/login.css">
