<?php

require_once  "controladores/principal.controlador.php";
require_once  "controladores/usuarios.controlador.php";
require_once  "controladores/ventas.controlador.php";
require_once  "controladores/productos.controlador.php";

require_once  "modelos/usuarios.modelo.php";
require_once  "modelos/ventas.modelo.php";
require_once  "modelos/producto.modelo.php";

$principal = new ControladorPrincipal();
$principal->ctrPrincipal();
