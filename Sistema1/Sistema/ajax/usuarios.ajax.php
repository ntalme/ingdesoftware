<?php

// Requiere los archivos necesarios para acceder al controlador y al modelo de usuarios
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";


class AjaxUsuarios {

    // Almacena el ID del usuario que se quiere editar
    public $idUsuario;

    // Permite obtener los datos de un usuario específico para editarlo
    public function ajaxEditarUsuario() {

        // Definimos el campo y el valor para buscar al usuario
        $item = "id";
        $valor = $this->idUsuario;

        // Llamamos al controlador que nos trae los datos del usuario desde la base
        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        // Retornamos los datos en formato JSON (útil para JavaScript)
        echo json_encode($respuesta);
    }

    // Recibe el nombre de usuario para validación 
    public $validarUsuario;

    // Validar si un nombre de usuario ya existe en la base de datos
    public function ajaxValidarUsuario(){

        // Buscamos por el campo "usuario"
        $item = "usuario";
        $valor = $this->validarUsuario;

        // Llamamos al controlador que verifica si ya existe ese nombre de usuario
        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        // Retornamos la respuesta en formato JSON
        echo json_encode($respuesta);
    }

}

// Si se envía por POST el ID de un usuario, se ejecuta la edición (lectura de datos)
if (isset($_POST["idUsuario"])) {

    $editar = new AjaxUsuarios();                 // Creamos instancia de la clase
    $editar->idUsuario = $_POST["idUsuario"];     // Asignamos el ID recibido por POST
    $editar->ajaxEditarUsuario();                 // Llamamos al método para traer los datos
}

// Si se envía por POST un nombre de usuario, se verifica si ya existe
if (isset($_POST["validarUsuario"])){

    $valUsuario = new AjaxUsuarios();                  // Creamos instancia de la clase
    $valUsuario->validarUsuario = $_POST["validarUsuario"];  // Asignamos el nombre de usuario
    $valUsuario->ajaxValidarUsuario();                // Llamamos al método para validación
}