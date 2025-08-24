<!-- Contenedor principal del contenido de la página (excluye barra lateral y navbar) -->
<div class="content-wrapper">

  <!-- Sección del encabezado (título de la página) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <!-- Título principal de bienvenida -->
          <h1>Bienvenido/a al Sistema de Gestión</h1>
        </div>
      </div>
    </div>
  </section>

  <!-- Contenido principal de la página -->
  <section class="content">

    <!-- Tarjeta (card) de bienvenida -->
    <div class="card">
      
      <!-- Encabezado de la tarjeta -->
      <div class="card-header">
        <!-- Muestra el nombre del usuario logueado usando la variable de sesión -->
        <h3 class="card-title">Hola, <strong><?php echo $_SESSION["nombre"]; ?></strong></h3>
      </div>

      <!-- Cuerpo de la tarjeta -->
      <div class="card-body">
        <!-- Muestra el rol con el que inició sesión el usuario -->
        <p>Has iniciado sesión como <strong><?php echo $_SESSION["rol"]; ?></strong>.</p>

        <!-- Si el usuario es Administrador, muestra esta sección -->
        <?php if ($_SESSION["rol"] == "Administrador"): ?>
          <p><strong>Como Administrador puedes:</strong></p>
          <ul>
            <li>Crear nuevas ventas</li>
            <li>Ver el listado completo de ventas</li>
            <li>Consultar y gestionar el inventario</li>
            <li>Registrar nuevos productos</li>
            <li>Añadir stock a productos existentes</li>
            <li>Administrar usuarios del sistema</li>
          </ul>

          <p><strong>Consejos para ti:</strong></p>
          <ul>
            <li>Revisa el stock de productos críticos diariamente.</li>
            <li>Gestiona accesos y roles de los usuarios según sus funciones.</li>
            <li>Supervisa las ventas y mantén actualizada la base de productos.</li>
          </ul>

        <!-- Si el usuario es Vendedor, muestra esta otra sección -->
        <?php elseif ($_SESSION["rol"] == "Vendedor"): ?>
          <p><strong>Como Vendedor puedes:</strong></p>
          <ul>
            <li>Registrar nuevas ventas</li>
            <li>Revisar tus ventas anteriores</li>
            <li>Ver el stock disponible de los productos</li>
          </ul>

          <p><strong>Consejos para ti:</strong></p>
          <ul>
            <li>Verifica el stock antes de realizar una venta.</li>
            <li>Asegúrate de ingresar correctamente los datos de cada venta.</li>
            <li>Consulta siempre con el administrador si necesitas ayuda con el sistema.</li>
          </ul>
        <?php endif; ?>
      </div>

      <!-- Pie de la tarjeta: muestra fecha y hora del acceso -->
      <?php date_default_timezone_set("America/Santiago"); ?>
      <div class="card-footer">
        Último acceso: <?php echo date("d/m/Y H:i"); ?> hrs.
      </div>
  </section>
</div>

