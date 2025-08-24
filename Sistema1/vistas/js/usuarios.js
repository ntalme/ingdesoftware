
// FUNCIÓN PARA EDITAR USUARIO
$(".btnEditarUsuario").click(function(){

    // Obtener el ID del usuario desde el atributo personalizado del botón
    var idUsuario = $(this).attr("idUsuario");

    // Crear un objeto FormData para enviar el ID por AJAX
    var datos = new FormData();
    datos.append("idUsuario", idUsuario);

    // Enviar solicitud AJAX al servidor para obtener los datos del usuario
    $.ajax({
        url: "ajax/usuarios.ajax.php",   
        method: "POST",                  
        data: datos,                    
        cache: false,                   
        contentType: false,              
        processData: false,              
        dataType: "json",                
        success: function(respuesta){
            // Llenar los campos del formulario con los datos del usuario
            $("#editarNombre").val(respuesta["nombre"]);
            $("#editarUsuario").val(respuesta["usuario"]);
            $("#editarRol").val(respuesta["rol"]);
            // Guardar la contraseña actual
            $("#passwordActual").val(respuesta["password"]);
        }
    });
});

// REVISAR SI EL USUARIO NUEVO YA EXISTE
$("#nuevoUsuario").change(function(){

    // Eliminar cualquier alerta anterior
    $(".alert").remove();

    // Obtener el valor ingresado por el usuario
    var usuario = $(this).val();

    // Crear FormData con el valor del nuevo usuario para validar
    var datos = new FormData();
    datos.append("validarUsuario", usuario);

    // Enviar solicitud AJAX para validar si el usuario ya existe
    $.ajax({
        url:"ajax/usuarios.ajax.php",   
        method: "POST",                  
        data: datos,                     
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",                
        success: function(respuesta){
            
            // Si la respuesta tiene contenido, significa que el usuario ya existe
            if(respuesta){
                // Mostrar alerta y limpiar el campo
                $("#nuevoUsuario").parent().after('<div class="alert alert-warning">Ese nombre de usuario ya existe</div>');
                $("#nuevoUsuario").val(""); // Vacía el campo para que se vuelva a ingresar otro nombre
            }
        }
    });
});

// ELIMINAR USUARIO
$(".btnEliminarUsuario").click(function(){

    // Obtener el ID del usuario desde el botón presionado
    var idUsuario = $(this).attr("idUsuario");
    var usuario = $(this).attr("usuario");

    // Mostrar cuadro de confirmación usando SweetAlert2
    Swal.fire({
        title: '¿Estás seguro de eliminar el usuario?',
        text: "¡Esta acción no se puede deshacer!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí, borrar usuario'
    }).then((result) => {
        // Si el usuario confirma la acción
        if (result.isConfirmed) {
            // Redirigir con el ID del usuario en la URL
            window.location = "index.php?ruta=usuarios&idUsuario=" + idUsuario + "&usuario="+usuario;
        }
    });
});
