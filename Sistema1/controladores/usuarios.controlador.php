<?php

class ControladorUsuarios {

    //LOGIN USUARIO
    static public function ctrIngresoUsuario() {

        // Revisar si el formulario fue enviado
        if (isset($_POST["ingUsuario"])) {

            // Validar que el usuario y la contraseña solo tengan letras o números
            if (
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){

                $encriptar = crypt($_POST["ingPassword"], '$2a$07$usesomesillystringforsalt$' );

                // Nombre de la tabla que se va a consultar
                $tabla = "usuario";

                // Campo que se va a usar como filtro
                $item = "usuario";

                // Valor que ingresó el usuario
                $valor = $_POST["ingUsuario"];

                // Consultar en el modelo si existe el usuario
                $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

                // Verificar si se encontró el usuario
                if ($respuesta) {

                    // Verificar si los datos coinciden
                    if ($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar){
                        
                        $_SESSION["iniciarSesion"] = "ok";
                        $_SESSION["id"] = $respuesta["id"];
                        $_SESSION["nombre"] = $respuesta["nombre"];
                        $_SESSION["usuario"] = $respuesta["usuario"];
                        $_SESSION["rol"] = $respuesta["rol"];

                        echo '<script> 
                            window.location = "inicio";
                        </script>';
                    } 
                    else {
                        echo '<br><div class="alert alert-danger">Usuario o contraseña incorrectos</div><br>';
                    }

                } else {
                    echo '<br><div class="alert alert-warning">⚠️ Usuario no encontrado</div><br>';
                }
            }
        }
    }

    //CREAR USUARIO
    public static function ctrCrearUsuario() {

    if (isset($_POST["nuevoUsuario"])) {

        // Validaciones de campos
       if (
            preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s]+$/u', $_POST["nuevoNombre"]) &&
            preg_match('/^[a-zA-Z0-9_.]+$/', $_POST["nuevoUsuario"]) &&
            preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevaPassword"])){

            $tabla = "usuario";

            $encriptar = crypt($_POST["nuevaPassword"], '$2a$07$usesomesillystringforsalt$' );

            $datos = array(
                "nombre" => $_POST["nuevoNombre"],
                "usuario" => $_POST["nuevoUsuario"], 
                "password" => $encriptar,
                "rol" => $_POST["nuevoRol"]
            );

            $respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "¡Usuario registrado!",
                        text: "El usuario ha sido guardado correctamente.",
                        confirmButtonText: "Cerrar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "usuarios";
                        }
                    });
                </script>';
            }

        } else {
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Error al registrar",
                    text: "El usuario no puede llevar caracteres especiales.",
                    confirmButtonText: "Cerrar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "usuarios";
                    }
                });
            </script>';
            }   
        }
    }

    // MOSTRAR USUARIOS
    public static function ctrMostrarUsuarios($item, $valor) {

        $tabla = "usuario";

        $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

        return $respuesta;
    }

    // EDITAR USUARIOS
    public static function ctrEditarUsuario(){

    if(isset($_POST["editarUsuario"])){

        // Validaciones de campos
        if (preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s]+$/u', $_POST["editarNombre"])){

            $tabla = "usuario";

            // Manejo de contraseña
            if($_POST["editarPassword"] != ""){

                if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){

                    $encriptar = crypt($_POST["editarPassword"], '$2a$07$usesomesillystringforsalt$' );

                } else {

                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Error al registrar",
                            text: "La contraseña no puede llevar caracteres especiales.",
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "usuarios";
                            }
                        });
                    </script>';
                    return; // salir para evitar que siga ejecutando
                }

            } else {
                // Si no se modifica la contraseña, se mantiene la actual
                $encriptar = $_POST["passwordActual"];
            }

            $datos = array(
                "nombre" => $_POST["editarNombre"],
                "usuario" => $_POST["editarUsuario"],
                "password" => $encriptar,
                "rol" => $_POST["editarRol"]
            );

            $respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "¡Usuario editado!",
                        text: "El usuario ha sido editado correctamente.",
                        confirmButtonText: "Cerrar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "usuarios";
                        }
                    });
                </script>';
            }

            } else {

                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Error al registrar",
                        text: "El nombre no puede llevar caracteres especiales.",
                        confirmButtonText: "Cerrar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "usuarios";
                        }
                    });
                </script>';
            }
        }
    }

    // ELIMINAR USUARIO
    public static function ctrBorrarUsuario(){

        if(isset($_GET["idUsuario"])){

            $tabla = "usuario";
            $datos = $_GET["idUsuario"];

            $respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "¡Usuario Borrado!",
                        text: "El usuario ha sido borrado correctamente.",
                        confirmButtonText: "Cerrar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "usuarios";
                        }
                    });
                </script>';
            }
        }
    }
}
