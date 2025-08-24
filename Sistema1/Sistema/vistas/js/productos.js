// ELIMINAR PRODUCTO
$(".btnEliminarProducto").click(function(){

    var idProducto = $(this).attr("idProducto");

    Swal.fire({
        title: '¿Estás seguro de eliminar el producto?',
        text: "¡Esta acción no se puede deshacer!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí, borrar producto'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = "index.php?ruta=crear-producto&idProducto=" + idProducto;
        }
    });
});

// AÑADIR STOCK
$(".btnAgregarStock").click(function () {

    var idProducto = $(this).attr("idProducto");
    $("#idProductoStock").val(idProducto);
    
});
