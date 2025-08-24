<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/producto.modelo.php";


class AjaxProductos{

    public $idProducto;

    public function ajaxEditarProducto(){

        $item = "id";
        $valor = $this->idProducto;

        $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

        echo json_encode($respuesta);
    }
}


if(isset($_POST["idProducto"])){

    $editarProducto = new AjaxProductos();
    $editarProducto -> idProducto = $_POST["idProducto"];
    $editarProducto -> ajaxEditarProducto();
}