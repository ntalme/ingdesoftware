<?php
// Inicia la sesión para poder trabajar con variables de sesión como $_SESSION["iniciarSesion"]
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Inventario y Ventas</title>

  <!-- Fuente desde Google Fonts (Poppins, en distintos grosores) -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Íconos de Font Awesome -->
  <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css">

  <!-- Estilos base del framework AdminLTE -->
  <link rel="stylesheet" href="vistas/dist/css/adminlte.css">

  <!-- Estilos personalizados del sistema -->
  <link rel="stylesheet" href="vistas/css/inicio.css">
  <link rel="stylesheet" href="vistas/css/sidebar.css">
  <link rel="stylesheet" href="vistas/css/navbar.css">

  <!-- jQuery y Bootstrap para funcionalidad y componentes -->
  <script src="vistas/plugins/jquery/jquery.min.js"></script>
  <script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Funcionalidades propias del template AdminLTE -->
  <script src="vistas/js/adminlte.js"></script>

  <!-- Librería de alertas bonitas tipo popup (SweetAlert2) -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<!-- Agrega clases de estilo dependiendo si el usuario está logueado o no -->
<body class="hold-transition sidebar-mini <?php echo (!isset($_SESSION["iniciarSesion"]) || $_SESSION["iniciarSesion"] != "ok") ? 'login-page' : 'sidebar-collapse'; ?>">

<?php 
// Si el usuario está logueado correctamente
if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {

  echo '<div class="wrapper">'; // Contenedor principal para todo el sitio si se está logueado

  // Incluye la barra superior del sitio
  include "html/navbar.php";

  // Incluye el menú lateral
  include "html/sidebar.php";

  // Carga el contenido dinámico según la ruta de la URL
  if (isset($_GET["ruta"])) {
    $ruta = $_GET["ruta"];

    // Permite acceso solo a rutas específicas
    if (
      $ruta == "inicio" ||
      $ruta == "crear-venta" ||
      $ruta == "ver-ventas" ||
      $ruta == "inventario" ||
      $ruta == "cerrar-sesion" ||

      // Estas rutas son exclusivas del rol "Administrador"
      ($ruta == "crear-producto" && $_SESSION["rol"] == "Administrador") ||
      ($ruta == "anadir-stock" && $_SESSION["rol"] == "Administrador") ||
      ($ruta == "usuarios" && $_SESSION["rol"] == "Administrador")
    ) {
      // Incluye el archivo PHP correspondiente a la ruta
      include "html/" . $ruta . ".php";
    }

  } else {
    // Si no hay ruta, se carga por defecto la página de inicio
    include "html/inicio.php";
  }

  // Incluye el pie de página
  include "html/footer.php";

  echo '</div>'; // Cierra el contenedor principal

} else {
  // Si no se ha iniciado sesión, muestra solo el formulario de login
  include "html/login.php";
}
?>

</div> <!-- Esto parece un div suelto innecesario, podrías eliminarlo si no da problemas -->

<!-- Script principal con funcionalidades personalizadas -->
<script src="vistas/js/principal.js"></script>

</body>
</html>
