<body class="hold-transition sidebar-mini">

<!-- Contenedor principal -->
<div class="wrapper">

  <!-- Barra superior de navegación -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Lista izquierda: Botón para mostrar/ocultar el menú lateral -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <!-- Ícono de hamburguesa para colapsar el sidebar -->
        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
          <i class="fas fa-bars"></i>
        </a>
      </li>
    </ul>

    <!-- Lista derecha: Perfil del usuario -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown user-menu">

        <!-- Enlace con el nombre del usuario y opción para desplegar el menú -->
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <!-- Mostrar el nombre del usuario desde la sesión -->
          <span class="d-none d-md-inline">
            <?php echo $_SESSION["nombre"]; ?>
          </span>
        </a>

        <!-- Menú desplegable -->
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <li class="user-body">
            <div class="text-right px-3 pb-2">
              <!-- Botón para cerrar sesión -->
              <a href="cerrar-sesion" class="btn btn-default btn-flat">Cerrar Sesión</a>
            </div>
          </li>
        </ul>

      </li>
    </ul>
  </nav>

</body>

<!-- Enlace al archivo CSS -->
<link rel="stylesheet" href="vistas/css/navbar.css">
