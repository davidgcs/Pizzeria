$(document).ready(function () {
    //ocultamos barra
    $("#barra-superior").hide();

    //variable global para controlar barra superior
    var tipoDatos = '';

    //refrescar lista
    $("#btnActualizar").on("click", function () {
        switch (tipoDatos) {
            case "usu":
                listarUsuarios();
                break;
            case "prod":
                listarProductos();
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
                    case "usu":
                        return e.nombre.indexOf(query) > -1 || e.email.indexOf(query) > -1 || e.telefono.indexOf(query) > -1 || e.alias.indexOf(query) > -1;
                        break;
                    case "prod":
                        return e.nombre.indexOf(query) > -1 || e.tipo.indexOf(query) > -1 || e.nref.indexOf(query) > -1 || e.precio.indexOf(query) > -1;
                        break;
                }
            });
            $("#grid").grid("render", result);
        }
    });

    //dialog añadir
    $("#btnAdd").on("click", function () {
        switch (tipoDatos) {
            case "usu":
                iniDialogCreaUser();
                break;
            case "prod":
                iniDialogCreaProd();
                break;
        }
    });

    //USUARIOS
    var data = '';
    var dialogEditUsu, dialogCreaUser;
    //inicializar dialogs
    dialogEditUsu = $('#dialogUser').dialog({
        title: 'Editar Usuario',
        autoOpen: false,
        resizable: false,
        modal: true
    });
    dialogCreaUser = $('#dialogCreaUser').dialog({
        title: 'Añadir Usuario',
        autoOpen: false,
        resizable: false,
        modal: true,
        width: 500
    });

    $("#optUsu").on("click", function () {
        tipoDatos = "usu";
        $("#optADM li").attr("class", "");
        $(this).attr("class", "active");

        $("#barra-superior").show();

        listarUsuarios();
    });

    //listar usuario
    function listarUsuarios() {
        //recibimos datos del PHP
        var url_listaUsuarios = url_index + "admin/listaUsuarios";
        $.ajax({
            url: url_listaUsuarios,
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
                        {
                            width: 200, field: 'nombre', title: 'Nombre', sortable: true,
                            tmpl: '{nombre} {apellidos}'
                        },
                        {width: 150, field: 'email', sortable: true},
                        {width: 50, field: 'telefono', title: 'Teléfono', sortable: true},
                        {width: 80, field: 'alias', title: 'Alias', sortable: true},
                        {width: 60, field: 'es_empleado', title: 'Empleado', align: 'center', sortable: true},
                        {
                            width: 10,
                            title: 'Acción',
                            tmpl: '<button class="btn btn-danger glyphicon glyphicon-remove"></button>',
                            align: 'center',
                            cssClass: 'sinPadding',
                            tooltip: 'Eliminar usuario',
                            events: {
                                'click': function (e) {
                                    borraLineaUsu(e)
                                }
                            }
                        },
                        {
                            width: 10,
                            tmpl: '<button class="btn btn-success glyphicon glyphicon-pencil"></button>',
                            align: 'center',
                            cssClass: 'sinPadding',
                            tooltip: 'Editar usuario',
                            events: {
                                'click': function (e) {
                                    editLineaUsu(e)
                                }
                            }
                        },
                        {
                            width: 10,
                            tmpl: '<button class="btn btn-info glyphicon glyphicon-comment"></button>',
                            align: 'center',
                            cssClass: 'sinPadding',
                            tooltip: 'Detalles del usuario',
                            events: {
                                'click': function (e) {
                                    detallesLineaUsu(e.data.record)
                                }
                            }
                        }
                    ],
                    pager: {limit: 5}
                });

            });
    }

    //borrar usuario
    function borraLineaUsu(e) {

        if (confirm('¿Quieres eliminar el usuario ' + e.data.record.alias + '?')) {

            //eliminamos de la bd
            var url_esEmpleado = url_index + "admin/borraUsu?id=" + e.data.record.id;
            $.ajax({
                url: url_esEmpleado
            })
                .done(function () {
                    //refrescamos la tabla
                    listarUsuarios();
                });
        }
    }

    var dataLineaEditUsu;
    //editar usuario
    function editLineaUsu(e) {
        //obtenemos datos del php
        var url_esEmpleado = url_index + "admin/esEmpleado?alias=" + e.data.record.alias;
        dataLineaEditUsu = e.data;
        $.ajax({
            url: url_esEmpleado
        })
            .done(function (esEmpleado) {

                //abrimos dialog con datos
                $('#aliasEmp').val(e.data.record.alias);
                $('#idEmp').val(esEmpleado);
                $('#dialogUser').dialog('open');
            });
    }

    var esEmpleGrid;
    //editar usuario en BBDD
    $("#btnSave").on("click", function (e) {
        //actualizamos en la BBDD
        var alias = $('#aliasEmp').val();
        var esEmple = $('#idEmp').val();
        esEmpleGrid = (esEmple === 0 ? "NO" : "SI");
        var url_updateUser = url_index + "admin/setEmpleado?alias=" + alias + "&esEmp=" + esEmple;
        $.ajax({
            url: url_updateUser
        })
            .done(function () {
                $("#grid").grid("updateRow", dataLineaEditUsu.id, {
                    "id": dataLineaEditUsu.record.id,
                    "alias": dataLineaEditUsu.record.alias,
                    "email": dataLineaEditUsu.record.email,
                    "nombre": dataLineaEditUsu.record.nombre,
                    "apellidos": dataLineaEditUsu.record.apellidos,
                    "cp": dataLineaEditUsu.record.cp,
                    "calle": dataLineaEditUsu.record.calle,
                    "numero": dataLineaEditUsu.record.numero,
                    "ciudad": dataLineaEditUsu.record.ciudad,
                    "telefono": dataLineaEditUsu.record.telefono,
                    "es_empleado": esEmpleGrid
                });
                //listarUsuarios();
            });

        dialogEditUsu.close();
    });

    //detalles usuario
    function detallesLineaUsu(datos) {
        //asignamos datos al modal
        $("#nomApeUsu").text(datos.nombre + " " + datos.apellidos);
        $("#mailUsu").html('<span class="glyphicon glyphicon-envelope"></span>' + datos.email);
        $("#aliasUsu").html('<span class="glyphicon glyphicon-user"></span>' + datos.alias);
        $("#telfUsu").html('<span class="glyphicon glyphicon-earphone"></span>' + datos.telefono);
        $("#direUsu").html('<span class="glyphicon glyphicon-map-marker"></span>' + datos.calle + (datos.numero === '' ? '' : ', ' + datos.numero) + (datos.cp === '' ? '' : ', ' + datos.cp) + (datos.ciudad === '' ? '' : ', ' + datos.ciudad));
        //mostramos modal
        $("#detallesUser").modal('show');
    }

    //cerrar detalles usu
    $("#detallesUser button").on("click", function () {
        $("#detallesUser").modal("hide");
    });

    //mostrar dialog crear usuario
    function iniDialogCreaUser() {
        $("#dialogCreaUser input").each(function () {
            $(this).css("border", "none");
            $(this).val("");
        });
        $("#idUsuEmp").val(0);
        $('#dialogCreaUser').dialog('open');
    }

    //crear usuario en BBDD
    $("#btnSaveCrearUsu").on("click", function () {
        //recogemos datos
        var nombre = $("#idNombreUsu").val();
        var apellidos = $("#idApellidosUsu").val();
        var telefono = $("#idTelefonoUsu").val();
        var alias = $("#idAliasUsu").val();
        var email = $("#idEmailUsu").val();
        var pass = $("#idPassUsu").val();
        var esEmp = $("#idUsuEmp").val();

        var valido = true;
        //validamos y si está bien cerramos
        $("#dialogCreaUser input").each(function () {
            if ($(this).val() === '') {
                valido = false;
                $(this).css("border", "1px solid red");
            } else {
                $(this).css("border", "none");
            }
        });
        if (valido) {
            //mandamos datos al php
            var url_creaUsu = url_index + "admin/creaUsu?nombre=" + nombre + "&apellidos=" + apellidos + "&telefono=" + telefono + "&alias=" + alias + "&email=" + email + "&pass=" + pass + "&empleado=" + esEmp;
            $.ajax({
                url: url_creaUsu
            })
                .done(function (creado) {
                    if (creado) {
                        listarUsuarios();
                        dialogCreaUser.close();
                    } else {
                        alert("El email o el alias ya existen en el sistema");
                    }
                });
        } else {
            alert("Complete todos los datos");
        }
    });

    //PRODUCTOS
    $("#optPro").on("click", function () {
        tipoDatos = "prod";
        $("#optADM li").attr("class", "");
        $(this).attr("class", "active");

        $("#barra-superior").show();

        listarProductos();
    });

    function listarProductos() {
        //recibimos datos del PHP
        var url_listaProductos = url_index + "admin/listaProductos";
        $.ajax({
            url: url_listaProductos,
            beforeSend: function () {
                //en proceso
                console.log("Cargando productos");
            }
        })
            .done(function (jsonDatos) {
                data = JSON.parse(jsonDatos);
                $("#grid").grid('destroy');
                $('#grid').grid({
                    dataSource: JSON.parse(jsonDatos),
                    columns: [
                        {width: 100, field: 'nombre', title: 'Nombre', sortable: true},
                        {width: 80, field: 'tipo', title: 'Tipo', sortable: true},
                        {width: 60, field: 'nref', title: 'Referencia', sortable: true},
                        {width: 40, field: 'precio', title: 'Precio', sortable: true},
                        {
                            width: 10,
                            title: 'Acción',
                            tmpl: '<button class="btn btn-danger glyphicon glyphicon-remove"></button>',
                            align: 'center',
                            cssClass: 'sinPadding',
                            tooltip: 'Eliminar producto',
                            events: {
                                'click': function (e) {
                                    borraLineaPro(e)
                                }
                            }
                        },
                        {
                            width: 10,
                            tmpl: '<button class="btn btn-success glyphicon glyphicon-pencil"></button>',
                            align: 'center',
                            cssClass: 'sinPadding',
                            tooltip: 'Editar producto',
                            events: {
                                'click': function (e) {
                                    editLineaPro(e)
                                }
                            }
                        },
                        {
                            width: 10,
                            tmpl: '<button class="btn btn-info glyphicon glyphicon-comment"></button>',
                            align: 'center',
                            cssClass: 'sinPadding',
                            tooltip: 'Detalles del producto',
                            events: {
                                'click': function (e) {
                                    detallesLineaPro(e.data.record)
                                }
                            }
                        }
                    ],
                    pager: {limit: 5}
                });

            });

    }

    function borraLineaPro(e) {
        if (confirm('¿Quieres eliminar el producto ' + e.data.record.nref + '?')) {

            //eliminamos de la bd
            var url_borraProd = url_index + "admin/borraProd?id=" + e.data.record.id;
            $.ajax({
                url: url_borraProd
            })
                .done(function () {
                    //refrescamos tabla
                    listarProductos();
                });
        }
    }

    //inicializar dialog editar
    var dialogEditProd;
    dialogEditProd = $('#dialogEditProd').dialog({
        title: 'Editar Producto',
        autoOpen: false,
        resizable: false,
        modal: true,
        width: 500
    });

    var dataLineaEditProd;

    function editLineaPro(e) {
        dataLineaEditProd = e.data;

        //abrimos dialog con datos de la tabla
        $('#idNrefProd').val(e.data.record.nref);
        $("#idNombreProd").val(e.data.record.nombre);
        $("#idTipoProd").val(e.data.record.tipo);
        $("#idDescriProd").val(e.data.record.descri);
        $("#idPrecioProd").val(e.data.record.precio);
        $("#idImgProd").val(e.data.record.imgsrc);

        $('#dialogEditProd').dialog('open');
    }


    //editar usuario en BBDD
    $("#btnSaveEditProd").on("click", function (e) {
        //actualizamos en la BBDD
        var nref = $('#idNrefProd').val();
        var nombre = $("#idNombreProd").val();
        var tipo = $("#idTipoProd").val();
        var descri = $("#idDescriProd").val();
        var precio = $("#idPrecioProd").val();

        var url_updateProd = url_index + "admin/updateProd?nref=" + nref + "&nombre=" + nombre + "&tipo=" + tipo + "&descri=" + descri + "&precio=" + precio;
        $.ajax({
            url: url_updateProd
        })
            .done(function () {
                $("#grid").grid("updateRow", dataLineaEditProd.id, {
                    "id": dataLineaEditProd.record.id,
                    "nref": dataLineaEditProd.record.nref,
                    "nombre": $("#idNombreProd").val(),
                    "tipo": $("#idTipoProd").val(),
                    "precio": $("#idPrecioProd").val(),
                    "descri": $("#idDescriProd").val(),
                    "imgsrc": dataLineaEditProd.record.imgsrc
                });
            });

        dialogEditProd.close();
    });

    //detalles producto
    function detallesLineaPro(datos) {
        //asignamos datos al modal
        $("#nomProd").html('<span class="glyphicon glyphicon-info-sign"></span>' + datos.nombre + ' <small>(' + datos.nref + ')</small>');
        $("#tipoProd").html('<span class="glyphicon glyphicon-grain"></span>' + datos.tipo);
        $("#precioProd").html('<span class="glyphicon glyphicon-euro"></span>' + datos.precio);
        $("#descriProd").html('<span class="glyphicon glyphicon-comment"></span>' + datos.descri);
        //mostramos modal
        $("#detallesProd").modal('show');
    }

    //cerrar detalles usu
    $("#detallesProd button").on("click", function () {
        $("#detallesProd").modal("hide");
    });

    //inicializar dialog producto nuevo
    var dialogCreaProd;
    dialogCreaProd = $('#dialogCreaProd').dialog({
        title: 'Añadir Producto',
        autoOpen: false,
        resizable: false,
        modal: true,
        width: 500
    });

    //mostrar dialog crear producto
    function iniDialogCreaProd() {
        $("#dialogCreaProd input").each(function () {
            $(this).css("border", "none");
            $(this).val("");
        });
        $("#idTipoCreaProd").val("pizza");
        $('#dialogCreaProd').dialog('open');
    }

    //crear usuario en BBDD
    $("#btnSaveCrearProd").on("click", function () {
        //recogemos datos
        var nombre = $("#idNombreCreaProd").val();
        var nref = $("#idNrefCreaProd").val();
        var tipo = $("#idTipoCreaProd").val();
        var precio = $("#idPrecioCreaProd").val();
        var descri = $("#idDescriCreaProd").val();

        //validamos y si está bien cerramos
        var valido = true;
        $("#dialogCreaProd input").each(function () {
            if ($(this).val() === '') {
                valido = false;
                $(this).css("border", "1px solid red");
            } else {
                $(this).css("border", "none");
            }
        });
        if ($("#idDescriCreaProd").val() === '') {
            $("#idDescriCreaProd").css("border", "1px solid red");
        } else {
            $("#idDescriCreaProd").css("border", "none");
        }

        if (valido) {
            //mandamos datos al php
            var url_creaProd = url_index + "admin/creaProd?nombre=" + nombre + "&nref=" + nref + "&tipo=" + tipo + "&precio=" + precio + "&descri=" + descri + "&imgsrc=dummy.png";
            $.ajax({
                url: url_creaProd
            })
                .done(function (creado) {
                    if (creado) {
                        listarProductos();
                        dialogCreaProd.close();
                    } else {
                        alert("La referencia ya existe en el sistema");
                    }
                });
        } else {
            alert("Complete todos los datos");
        }
    });
});

