// AGREGAR PRODUCTOS DESDE LA TABLA
$(".btnAgregarProducto").click(function () {

    // SI YA SE AGREGÓ, NO HACER NADA
    if ($(this).hasClass("btn-default")) {
        return; // evita que se vuelva a ejecutar
    }

    var idProducto = $(this).attr("idProducto");

    // Cambia el estilo del botón
    $(this).removeClass("btn-primary agregarProducto");
    $(this).addClass("btn-default");

    var datos = new FormData();
    datos.append("idProducto", idProducto);

    $.ajax({
        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            var nombre = respuesta["nombre"];
            var stock = respuesta["cantidad"];
            var precio = respuesta["precio_venta"];

            // SI NO HAY STOCK
            if(stock == 0){

                swal({
                    title: "No hay stock disponible",
                    type: "error",
                    confirmButtonText: "¡Cerrar!"
                });

                $("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");

                return;
            }

         $(".nuevoProducto").append(
            '<div class="row align-items-center py-2 border-bottom text-center producto-item productoVenta">' +

                // Nombre
                '<div class="col-sm-4">' +
                '<input type="text" class="form-control agregarProducto" name="agregarProducto" idProducto="' + idProducto + '" value="' + nombre + '" readonly>' +
                '</div>' +

                // Cantidad + botones
                '<div class="col-sm-2">' +
                '<div class="input-group justify-content-center">' +
                    '<button class="btn btn-sm btn-outline-secondary btnRestar" type="button">–</button>' +
                    '<input type="number" class="form-control form-control-sm nuevaCantidad text-center" name="nuevaCantidad" min="1" stock="' + stock + '" value="1" style="width: 60px;">' +
                    '<button class="btn btn-sm btn-outline-secondary btnSumar" type="button">+</button>' +
                '</div>' +
                '</div>' +

                // Precio
                '<div class="col-sm-3 ingresoPrecio">' +
                '<div class="input-group">' +
                    '<span class="input-group-text">$</span>' +
                    '<input type="text" class="form-control nuevoPrecio" precioReal="' + precio + '" name="nuevoPrecio" value="' + Number(precio).toLocaleString("es-CL") + '" readonly required>' +
                '</div>' +
                '</div>' +

                // Botón eliminar
                '<div class="col-sm-3">' +
                '<button type="button" class="btn btn-danger btn-sm btnQuitarProducto" idProducto="' + idProducto + '">' +
                    '<i class="fa fa-trash"></i> Eliminar' +
                '</button>' +
                '</div>' +

            '</div>'
            );

            sumarTotal()
            guardarProductos()
        }
    });
});

// QUITAR PRODUCTO
$(".formularioVenta").on("click", ".btnQuitarProducto", function() {

    var idProducto = $(this).attr("idProducto");

    $(this).closest(".row").remove();

    // Reactivar el botón en la tabla
    $("button.btnAgregarProducto[idProducto='" + idProducto + "']")
        .removeClass("btn-default")
        .addClass("btn-primary agregarProducto");
    
    sumarTotal()
    guardarProductos()
});


// MODIFICAR CANTIDAD Y ACTUALIZAR PRECIO
$(".formularioVenta").on("input change", "input.nuevaCantidad", function () {

    const contenedorProducto = $(this).closest(".row");
    const inputPrecio = contenedorProducto.find(".nuevoPrecio");
    const precioReal = Number(inputPrecio.attr("precioReal"));
    let cantidad = Number($(this).val());
    const stockDisponible = Number($(this).attr("stock"));

    if (isNaN(cantidad) || cantidad < 1) {
        cantidad = 1;
        $(this).val(1);
    }

    if (cantidad > stockDisponible) {
        Swal.fire({
            title: 'La cantidad supera el stock disponible',
            text: "Solo hay " + stockDisponible + " unidades",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Cerrar'
        });

        cantidad = stockDisponible;
        $(this).val(stockDisponible);
    }

    const precioFinal = precioReal * cantidad;

    inputPrecio.val(precioFinal.toLocaleString("es-CL"));
    sumarTotal();
    guardarProductos();
});

$(".formularioVenta").on("submit", function(e) {
    e.preventDefault();
});

// CALCULAR TOTAL
function sumarTotal() {
    var precioProducto = $(".nuevoPrecio");
    var arrayTotal = [];

    for (var i = 0; i < precioProducto.length; i++) {
        var valor = Number($(precioProducto[i]).val().replace(/\./g, ""));
        arrayTotal.push(valor);
    }

    var sumaTotal = arrayTotal.reduce((total, numero) => total + numero, 0);

    // Mostrar total formateado
    $("#totalVenta").val(sumaTotal.toLocaleString("es-CL")); 
}

// SELECCIONAR MÉTODO DE PAGO
$("#metodoPago").change(function () {

    var metodo = $(this).val();

    if (metodo == "efectivo") {

        $("#contenedorMetodos").html(
            '<div class="row">' +
                // Campo recibido
                '<div class="col-md-6">' +
                    '<label class="fw-bold">Recibido</label>' +
                    '<div class="input-group mb-2">' +
                         '<span class="input-group-text">$</span>' +
                        '<input type="number" class="form-control valorRecibido" placeholder="0" required>' +
                    '</div>' +
                '</div>' +
                // Campo vuelto
                '<div class="col-md-6">' +
                    '<label class="fw-bold">Vuelto</label>' +
                    '<div class="input-group mb-2">' +
                        '<span class="input-group-text">$</span>' +
                        '<input type="text" class="form-control vueltoEfectivo" readonly value="0">' +
                    '</div>' +
                '</div>' +
            '</div>'
        );
    } else {
        $("#contenedorMetodos").html('');
    }
});

// CALCULAR CAMBIO
$(".formularioVenta").on("input", ".valorRecibido", function () {
    var efectivo = Number($(this).val());

    var totalTexto = $(".totalVenta").val();
    var total = Number(totalTexto.replace(/\./g, ""));

    // Calcular cambio
    var cambio = efectivo - total;

    // Mostrar vuelto si es suficiente
    if (cambio >= 0) {
        $(".vueltoEfectivo").val(cambio.toLocaleString("es-CL"));
    }
});


//GUARDAR PRODUCTOS
function guardarProductos(){

    var listaProductos  = [];
    var nombre = $(".agregarProducto");
    var cantidad = $(".nuevaCantidad");
    var precio = $(".nuevoPrecio");

    for (var i = 0; i < nombre.length; i++){
        listaProductos.push({
                            "id": $(nombre[i]).attr("idProducto"),
                            "nombre": $(nombre[i]).val(),
                            "cantidad": $(cantidad[i]).val(),
                            "precioUnitario": $(precio[i]).attr("precioReal"),
                            "precioTotal": $(precio[i]).val()
                        });
    }
    $("#listaProductos").val(JSON.stringify(listaProductos));
}

// GUARDAR MÉTODO DE PAGO
function guardarMetodos() {
    var metodo = $("#metodoPago").val();

    if (metodo === "efectivo") {
        $("#listaMetodoPago").val("Efectivo");
    } else if (metodo === "tarjeta") {
        $("#listaMetodoPago").val("Tarjeta");
    }
}

$(".formularioVenta").off("submit").on("submit", function (e) {
    e.preventDefault();

    guardarProductos();
    guardarMetodos();

    // Validación método de pago
    if ($("#metodoPago").val() === null) {
        Swal.fire({
            icon: "warning",
            title: "Método de pago requerido",
            text: "Por favor selecciona un método de pago."
        });
        return;
    }

    // Validación productos
    if ($(".nuevoProducto .productoVenta").length === 0) {
        Swal.fire({
            icon: "warning",
            title: "Sin productos",
            text: "Debes agregar al menos un producto antes de guardar la venta."
        });
        return;
    }

    // 💡 Asegurarse que total esté calculado
    sumarTotal();

    // 💡 Limpiar el total para enviarlo sin puntos
    let totalLimpio = $("#totalVenta").val().replace(/\./g, "");
    $("#totalVenta").val(totalLimpio);

    // Enviar formulario limpio
    this.submit();
});

// Botón +
$(".formularioVenta").on("click", ".btnSumar", function () {
  const grupo = $(this).closest(".input-group");
  const input = grupo.find(".nuevaCantidad");
  let cantidad = parseInt(input.val());
  const stock = parseInt(input.attr("stock"));

  if (cantidad < stock) {
    input.val(++cantidad).trigger("change");
  } else {
    Swal.fire({
      icon: "warning",
      title: "Stock insuficiente",
      text: "No puedes agregar más unidades que el stock disponible."
    });
  }
});

// Botón –
$(".formularioVenta").on("click", ".btnRestar", function () {
  const grupo = $(this).closest(".input-group");
  const input = grupo.find(".nuevaCantidad");
  let cantidad = parseInt(input.val());

  if (cantidad > 1) {
    input.val(--cantidad).trigger("change");
  }
});

