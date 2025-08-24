<?php 
// Detectar en qué página estamos
$rutaActiva = $_GET["ruta"] ?? "inicio"; 
?>

<!-- Barra lateral del sistema -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Nombre del sistema -->
    <a href="inicio" class="brand-link d-flex align-items-center px-3">
        <span class="brand-text titulo-logo">Botillería Joaquín</span>
    </a>

    <!-- Contenido del sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false">

                <!-- Opción: Inicio -->
                <li class="nav-item">
                    <a href="inicio" class="nav-link <?php echo ($rutaActiva == 'inicio') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Inicio</p>
                    </a>
                </li>

                <!-- Opción: Crear Venta -->
                <li class="nav-item">
                    <a href="crear-venta" class="nav-link <?php echo ($rutaActiva == 'crear-venta') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Crear venta</p>
                    </a>
                </li>

                <!-- Opción: Ver ventas -->
                <li class="nav-item">
                    <a href="ver-ventas" class="nav-link <?php echo ($rutaActiva == 'ver-ventas') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>Listado de Ventas</p>
                    </a>
                </li>

                <!-- Opción: Inventario -->
                <li class="nav-item">
                    <a href="inventario" class="nav-link <?php echo ($rutaActiva == 'inventario') ? 'active' : ''; ?>">
                        <i class="nav-icon fa-solid fa-basket-shopping"></i>
                        <p>Inventario</p>
                    </a>
                </li>

                <!-- Sección solo para el rol Administrador -->
                <?php if ($_SESSION["rol"] === "Administrador"): ?>

                    <?php 
                    // Revisa si estamos en alguna de las subpáginas de Productos para abrir el submenú
                    $activoProductos = in_array($rutaActiva, ['crear-producto', 'anadir-stock']); 
                    ?>

                    <!-- Menú desplegable: Productos -->
                    <li class="nav-item has-treeview <?php echo $activoProductos ? 'menu-open' : ''; ?>">
                        <a href="#" class="nav-link <?php echo $activoProductos ? 'active' : ''; ?>">
                            <i class="nav-icon fa-solid fa-clipboard"></i>
                            <p>
                                Productos
                                <i class="right fas fa-angle-down"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <!-- Subopción: Crear productos -->
                            <li class="nav-item">
                                <a href="crear-producto" class="nav-link <?php echo ($rutaActiva == 'crear-producto') ? 'active' : ''; ?>">
                                    <i class="nav-icon fas fa-plus-circle"></i>
                                    <p>Crear Productos</p>
                                </a>
                            </li>
                            <!-- Subopción: Añadir stock -->
                            <li class="nav-item">
                                <a href="anadir-stock" class="nav-link <?php echo ($rutaActiva == 'anadir-stock') ? 'active' : ''; ?>">
                                    <i class="nav-icon fas fa-boxes"></i>
                                    <p>Añadir Stock</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Opción: Administrar usuarios -->
                    <li class="nav-item">
                        <a href="usuarios" class="nav-link <?php echo ($rutaActiva == 'usuarios') ? 'active' : ''; ?>">
                            <i class="nav-icon fa-solid fa-users-cog"></i>
                            <p>Administrar Usuarios</p>
                        </a>
                    </li>

                <?php endif; ?>

            </ul>
        </nav>
    </div>
</aside>

<!-- Iconos de Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Tus estilos personalizados del sidebar -->
<link rel="stylesheet" href="vistas/css/sidebar.css">
