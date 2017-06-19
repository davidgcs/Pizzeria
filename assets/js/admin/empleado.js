$(document).ready(function () {
    //ocultamos barra
    $("#barra-superior").hide();

    //variable global para controlar barra superior
    var tipoDatos = '';

    //refrescar lista
    $("#btnActualizar").on("click", function () {
        switch (tipoDatos) {
            case "ped":
                listarPedidos();
                break;
            case "men":
                listarMensajes();
                break;
        }
        $('#inpt-buscar').val("")
    });

    //buscar
    $("#btnBuscar").on("click", function () {
        if ($('#inpt-buscar').val() != '') {
            var query, result;
            query = $('#inpt-buscar').val();
            result = $.grep(data, function (e) {
                switch (tipoDatos) {
                    case "ped":
                        return e.alias.indexOf(query) > -1 || e.nombre_empleado.indexOf(query) > -1 || e.fecha.indexOf(query) > -1 || e.estado.indexOf(query) > -1 || e.precio_total.indexOf(query) > -1;
                        break;
                    case "men":
                        return e.remitente.indexOf(query) > -1 || e.fecha.indexOf(query) > -1 || e.email.indexOf(query) > -1;
                        break;
                }
            });
            $("#grid").grid("render", result);
        }
    });


    //PEDIDOS
    var data, dialogEditPed;
    //inicializar dialogs
    dialogEditPed = $('#dialogPed').dialog({
        title: 'Editar Pedido',
        autoOpen: false,
        resizable: false,
        modal: true
    });

    $("#optPed").on("click", function () {
        tipoDatos = "ped";
        $("#optADM li").attr("class", "");
        $(this).attr("class", "active");

        $("#barra-superior").show();
        $("#btnAdd").hide();

        listarPedidos();
    });

    //listar pedidos
    function listarPedidos() {
        //recibimos datos del PHP
        var url_listaPedidos = url_index + "admin/listaPedidos";
        $.ajax({
            url: url_listaPedidos,
            beforeSend: function () {
                //en proceso
                console.log("Cargando lista");
            }
        })
            .done(function (jsonDatos) {
                //select id, alias, email, nombre, apellidos, telefono, es_empleado
                data = JSON.parse(jsonDatos);
                $("#grid").grid('destroy');
                $('#grid').grid({
                    dataSource: JSON.parse(jsonDatos),
                    columns: [
                        {width: 80, field: 'alias', title: 'Cliente', sortable: true},
                        {width: 200, field: 'nombre_empleado', title: "Empleado", sortable: true},
                        {width: 80, field: 'fecha', title: 'Fecha', sortable: true},
                        {width: 80, field: 'estado', title: 'Estado', sortable: true},
                        {width: 80, field: 'precio_total', title: 'Precio', tmpl: '{precio_total}€', sortable: true},
                        {
                            width: 10,
                            title: 'Acción',
                            tmpl: '<button class="btn btn-danger glyphicon glyphicon-remove"></button>',
                            align: 'center',
                            cssClass: 'sinPadding',
                            tooltip: 'Eliminar pedido',
                            events: {
                                'click': function (e) {
                                    borrarLineaPed(e)
                                }
                            }
                        },
                        {
                            width: 10,
                            tmpl: '<button class="btn btn-success glyphicon glyphicon-pencil"></button>',
                            align: 'center',
                            cssClass: 'sinPadding',
                            tooltip: 'Editar pedido',
                            events: {
                                'click': function (e) {
                                    editLineaPed(e)
                                }
                            }
                        },
                        {
                            width: 10,
                            tmpl: '<button class="btn btn-info glyphicon glyphicon-comment"></button>',
                            align: 'center',
                            cssClass: 'sinPadding',
                            tooltip: 'Detalles del pedido',
                            events: {
                                'click': function (e) {
                                    detallesLineaPed(e.data.record)
                                }
                            }
                        }
                    ],
                    pager: {limit: 5}
                });

            });
    }

    //borrar pedido
    function borrarLineaPed(e) {
        if (e.data.record.estado !== "cerrado") {

            if (confirm('¿Quieres eliminar el pedido con fecha ' + e.data.record.fecha + '?')) {

                //eliminamos de la bd
                var url_borraPedido = url_index + "admin/borraPedido?id=" + e.data.record.id;
                $.ajax({
                    url: url_borraPedido
                })
                    .done(function (borrado) {
                        if (borrado) {
                            //refrescamos la tabla
                            listarPedidos();
                        } else {
                            alert("No puedes borrar un pedido que no gestionas.");
                        }
                    });
            }
        } else {
            alert("No puedes borrar un pedido cerrado.");
        }
    }

    var dataLineaEditPed;
    //editar pedido
    function editLineaPed(e) {
        dataLineaEditPed = e.data;
        //abrimos dialog con datos de la tabla
        $('#idPed').val(e.data.record.id);
        $('#estadoPed').val(e.data.record.estado);
        $('#dialogPed').dialog('open');
    }

    var esEmpleGrid;
    //editar usuario en BBDD
    $("#btnSavePed").on("click", function () {
        //actualizamos en la BBDD
        var idPed = $('#idPed').val();
        var estadoPed = $('#estadoPed').val();
        var url_updatePed = url_index + "admin/setPedido?id=" + idPed + "&estado=" + estadoPed;
        $.ajax({
            url: url_updatePed
        })
            .done(function (editado) {
                if (editado) {

                    var url_datosPedido = url_index + "admin/getPedidoJson?id=" + idPed;
                    $.ajax({
                        url: url_datosPedido
                    })
                        .done(function (jsonPedido) {
                            //actualizamos linea
                            $("#grid").grid("updateRow", dataLineaEditPed.id, JSON.parse(jsonPedido));
                        });
                } else {
                    alert("No puedes gestionar ese pedido.");
                }
            });
        dialogEditPed.close();
    });

    function detallesLineaPed(datos) {
        //nombre y alias del usu, fecha, nombre empleado, estado, precio
        var nombreCliente, aliasCliente, emailCliente, telfCliente, fecha, nombreEmpleado, estado, precio;
        var contenidoUlLineasPedido = '';
        //llamamos a la BBDD a por datos
        var url_detallesPedido = url_index + "admin/detallesPedido?id=" + datos.id;
        $.ajax({
            url: url_detallesPedido
        })
            .done(function (jsonDetalles) {
                var datosJSON = JSON.parse(jsonDetalles);
                nombreCliente = datosJSON.nombreCliente;
                aliasCliente = datosJSON.aliasCliente;
                emailCliente = datosJSON.emailCliente;
                telfCliente = datosJSON.telfCliente
                nombreEmpleado = datosJSON.nombreEmpleado;
                fecha = datos.fecha;
                estado = datos.estado;
                precio = datos.precio_total;

                //llamamos a las lineas de pedido
                //lineas pedido: nombre y nref producto, cantidad, precio
                var nombre, nref, cantidad, precioProd;
                var url_lineasPedido = url_index + "admin/lineasPedido?id=" + datos.id;
                $.ajax({
                    url: url_lineasPedido
                })
                    .done(function (jsonLineas) {
                        //recorremos lineas y rellenamos el ul
                        var datosLineas = JSON.parse(jsonLineas);
                        for (linea in datosLineas) {
                            for (nombreDato in datosLineas[linea]) {
                                switch (nombreDato) {
                                    case "nombreProducto":
                                        nombre = datosLineas[linea][nombreDato];
                                        break;
                                    case "nref":
                                        nref = datosLineas[linea][nombreDato];
                                        break;
                                    case "cantidad":
                                        cantidad = datosLineas[linea][nombreDato];
                                        break;
                                    case "precio":
                                        precioProd = datosLineas[linea][nombreDato];
                                        break;
                                    default:
                                        break;
                                }
                            }
                            //creamos contenido ul
                            contenidoUlLineasPedido += '' +
                                '<li><p id="nombreLin"><span class="glyphicon glyphicon-cutlery"></span>'+ cantidad +' x '+nombre+' ('+nref+')</p></li>' +
                                '<li><p id="precioLin"><span class="fa fa-money"></span>'+(precioProd * cantidad) +'€</p></li>' +
                                '<li class="saltoLin"></li>';
                        }

                        //ponemos fecha y alias en la cabecera h2
                        $("#fechaAliasPedido").text(fecha + " ("+aliasCliente+")");
                        $("#nombreClientePed").html('<span class="glyphicon glyphicon-user"></span>'+nombreCliente);
                        $("#emailPed").html('<span class="glyphicon glyphicon-envelope"></span>'+emailCliente);
                        $("#telfPed").html('<span class="glyphicon glyphicon-earphone"></span>'+telfCliente);
                        $("#estadoPed").html('<span class="glyphicon glyphicon-cog"></span>Estado: '+estado);
                        $("#precioPed").html('<span class="glyphicon glyphicon-usd"></span>TOTAL: '+precio+'€');

                        //append al ul
                        $("#lineasPed").append(contenidoUlLineasPedido);

                        //mostramos modal
                        $("#detallesPedido").modal("show");
                    });
            });
    }

    $("#detallesPedido button").on("click", function () {
        $("#detallesPedido").modal("hide");
    });

    //MENSAJES
    $("#optMen").on("click", function () {
        tipoDatos = "men";
        $("#optADM li").attr("class", "");
        $(this).attr("class", "active");

        $("#barra-superior").show();
        $("#btnAdd").hide();

        listarMensajes();
    });

    //listar pedidos
    function listarMensajes() {
        //recibimos datos del PHP
        var url_listaMensajes = url_index + "admin/listarMensajes";
        $.ajax({
            url: url_listaMensajes,
            beforeSend: function () {
                //en proceso
                console.log("Cargando lista");
            }
        })
            .done(function (jsonDatos) {
                data = JSON.parse(jsonDatos);
                $("#grid").grid('destroy');
                $('#grid').grid({
                    dataSource: JSON.parse(jsonDatos),
                    columns: [
                        {width: 150, field: 'remitente', title: 'Remitente', sortable: true},
                        {width: 100, field: 'email', title: "e-mail", sortable: true},
                        {width: 80, field: 'fecha', title: 'Fecha', sortable: true},
                        {
                            width: 10,
                            title: 'Acción',
                            tmpl: '<button class="btn btn-danger glyphicon glyphicon-remove"></button>',
                            align: 'center',
                            cssClass: 'sinPadding',
                            tooltip: 'Eliminar Mensaje',
                            events: {
                                'click': function (e) {
                                    borrarLineaMensaje(e)
                                }
                            }
                        },
                        {
                            width: 10,
                            tmpl: '<button class="btn btn-info glyphicon glyphicon-comment"></button>',
                            align: 'center',
                            cssClass: 'sinPadding',
                            tooltip: 'Detalles del pedido',
                            events: {
                                'click': function (e) {
                                    detallesLineaMensaje(e.data.record)
                                }
                            }
                        }
                    ],
                    pager: {limit: 5}
                });

            });
    }

    //borrar mensajes
    function borrarLineaMensaje(e) {
        if (confirm('¿Quieres eliminar el mensaje de ' + e.data.record.remitente + '?')) {

            //eliminamos de la bd
            var url_borraMensaje = url_index + "admin/borraMensaje?id=" + e.data.record.id;
            $.ajax({
                url: url_borraMensaje
            })
                .done(function () {
                    //refrescamos la tabla
                    listarMensajes();
                });
        }
    }

    //detalles mensaje
    function detallesLineaMensaje(datos) {
    //asignamos datos al modal
        $("#fechaMensaje").text(datos.fecha);
        $("#mailMen").html('<span class="glyphicon glyphicon-envelope"></span>' + datos.email);
        $("#remitenteMen").html('<span class="glyphicon glyphicon-user"></span>' + datos.remitente);
        $("#textoMen").html('<span class="glyphicon glyphicon-pencil"></span>' + datos.mensaje);
        //mostramos modal
        $("#detallesMensaje").modal('show');
    }

    //cerrar detalles usu
    $("#detallesMensaje button").on("click", function () {
        $("#detallesMensaje").modal("hide");
    });

});