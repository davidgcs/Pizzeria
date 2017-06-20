<?php if (!isset($_SESSION) || !isset($body["usuarioActual"]))header("Location: " . base_url())?>

<style>
    footer {
        width: 100%;
        position: absolute;
        bottom: 0;
    }

    input {
        margin-bottom: 25px;
    }

    div#info, div#pass {
        width: 25%;
    }

    .btn-primary:hover, .btn-primary:focus {
        background-color: #265a88 !important;
    }

    ul.nav.nav-tabs {
        padding: 100px 100px 0 100px;
    }

    .error {
        border: 1px solid darkred !important;
    }

    #footer {
        position: relative !important;
    }

    p.description {
        color: #FFF;
    }

    table {
        color: #2e3842;
    }

    
    /*modal detalles*/
    #dtPedido {
        width: 50%;
        height: 50%;
        position: absolute;
        top: 25%;
        left: 25%;
        background: #323232;
    }
    #dtPedido p, #dtPedido span{
        color: #fff;
    }
    .details li {
        list-style: none;
    }
    .details .glyphicon, .details .fa {
        width: 50px;
    }
    #dtPedido li {
        margin-bottom:10px;
    }
    #dtPedido p {
        margin-bottom: 1.5em;
    }
    #dtPedido button {
        color: #fff;
        opacity: 1;
        box-shadow: none;
        height: 25px;
    }
    #dtPedido h2 {
        width: 90%;
        float: left;
        margin-bottom: 10px;
    }
    #dtPedido {
        height: 75%;
        top: 12%;
    }
    #dtPedido h3 {
        font-size: 18px;
        letter-spacing: 2px;
        margin: 0;
        border-bottom: 1px solid #fff;
    }
    #lineasPedDt {
        margin: 20px;
    }
    .saltoLin {
        border-top: 1px dashed #fff;
        margin-top: 10px;
    }
    #estadoPedDt .fa {
        margin-left: 50px;
        width: 50px;
    }

</style>
<script>


    function checkPhone(evt) {
        if (document.getElementById("tel").value.length < 9 || isNaN(document.getElementById("tel").value)) {
            document.getElementById("tel").className += " error";
            return false;
        }
        return true;
    }


</script>
<div class="container" style="margin: 5% 3%">

    <h3>Pedidos</h3>
    <p class="description">En esta tabla se muestran los pedidos realizados. En verde se verán los pedidos en camino, en
        amarillo los pedidos en curso, en azul los pedidos registrados y en rojo los pedidos ya entregados.</p>
    <table class="table">
        <thead>
        <tr>
            <th>Fecha</th>
            <th>Precio</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($body['pedidos'] as $p): ?>
            <?php switch ($p["estado"]) {
                case "asignado":
                    echo '<tr class="warning">';
                    break;
                case "registrado":
                    echo '<tr class="info">';
                    break;
                case "cerrado":
                    echo '<tr class="danger">';
                    break;
                case "preparado":
                    echo '<tr class="success">';
                    break;
            } ?>
            <td><?= $p["fecha"] ?></td>
            <td><?= $p["precio_total"] ?></td>
            <td><?= $p["estado"] ?></td>
            <td>
                <button onclick="verPedido(<?= $p["id"] ?>)" id="mostrarDatosPedido" type="button" class="btn-info"><i
                            class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
            </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#info">Información Personal</a></li>
        <li><a data-toggle="tab" href="#pass">Contraseña</a></li>
        <li><a data-toggle="tab" href="#dir">Dirección</a></li>
    </ul>

    <div class="tab-content">
        <div id="info" class="tab-pane fade in active">
            <form id="f1" onsubmit="return checkPhone();" action="usuario/editPersonalInfo" method="post">
                <h3>DATOS PERSONALES</h3>
                Nombre: <input type="text" name="newNombre" value="<?= $body["usuarioActual"]["nombre"] ?>">
                Apellidos: <input type="text" name="newApellidos" value="<?= $body["usuarioActual"]["apellidos"] ?>">
                Teléfono: <input id="tel" type="text" maxlength="9" name="newTelefono"
                                 value="<?= $body["usuarioActual"]["telefono"] ?>">
                <input type="hidden" name="aliasUsuarioActual" value="<?= $body["usuarioActual"]["alias"] ?>">
                <button class="btn btn-primary" type="submit">Cambiar</button>
            </form>
        </div>
        <div id="pass" class="tab-pane fade">
            <form id="f2" action="usuario/editPassword" method="post">
                <h3>CONTRASEÑA</h3>
                Contraseña Actual: <input type="password" name="oldPassword">
                Nueva Contraseña: <input type="password" name="newPassword">
                Repetir Nueva Contraseña: <input type="password" name="newPasswordR">
                <input type="hidden" name="aliasUsuarioActual" value="<?= $body["usuarioActual"]["alias"] ?>">
                <button class="btn btn-primary" type="submit">Cambiar</button>
            </form>
        </div>
        <div id="dir" class="tab-pane fade">
            <form id="f3" action="usuario/editDirection" method="post">
                <h3>Dirección</h3>
                Calle: <input type="text" name="newCalle" value="<?= $body["usuarioActual"]["calle"] ?>">
                Número: <input type="text" name="newNumero" value="<?= $body["usuarioActual"]["numero"] ?>">
                Ciudad: <input type="text" name="newCiudad" value="<?= $body["usuarioActual"]["ciudad"] ?>">
                Cod. Postal: <input type="text" maxlength="5" name="newCP" value="<?= $body["usuarioActual"]["cp"] ?>">
                <input type="hidden" name="aliasUsuarioActual" value="<?= $body["usuarioActual"]["alias"] ?>">
                <button class="btn btn-primary" type="submit">Cambiar</button>
            </form>
        </div>
    </div>
    <div id="dtPedido" class="modal">
        <div class="container" style="border-bottom:1px solid white">
            <h2 id="fechaPedidoDt"></h2>
            <button type="button" class="close">X</button>
        </div>
        <hr>
        <ul class="container details">
            <li><p id="estadoPedDt"><span class="glyphicon glyphicon-cog"></span></p></li>
            <li><h3><span class="glyphicon glyphicon-th-list"></span>Lista de productos:</h3></li>
            <ul id="lineasPedDt" class="container">
                <!--nombreproducto, nrefproducto, cantidad-->
            </ul>
            <li><p id="precioPedDt"><span class="glyphicon glyphicon-euro"></span></p></li>
        </ul>
    </div>
    <?php if (isset($_SESSION['editOK']) && $_SESSION['editOK'] == true): ?>
        <label id="ok">Los cambios se han guardado con éxito.</label>
    <?php elseif (isset($_SESSION['editOK']) && $_SESSION['editOK'] == false): ?>
        <label id="error">Error al realizar los cambios.</label>
    <?php else: ?>
    <?php endif; ?>

    <?php $_SESSION['editOK'] = null; ?>

    <script>
        var url_index = "<?=base_url()?>";

        function verPedido(idPedido) {
            iniLineasPed();

            var nombreEmpleado, fecha, estado, precio;
            var contenidoUlLineasPedido = '';
            //obtenemos datos del php
            var url_dtPedido = url_index + "perfil/detallesPedido?id=" + idPedido;
            $.ajax({
                url: url_dtPedido
            })
                .done(function (jsonDetalles) {
                    //fecha, estado, precio_total, empleado
                    var datosJSON = JSON.parse(jsonDetalles);
                    nombreEmpleado = datosJSON.nombreEmpleado;
                    fecha = datosJSON.fecha;
                    estado = datosJSON.estado;
                    precio = datosJSON.precio_total;

                    //llamamos a las lineas de pedido
                    //lineas pedido: nombre y nref producto, cantidad, precio
                    var nombre, nref, cantidad, precioProd;
                    var url_lineasPedido = url_index + "admin/lineasPedido?id=" + idPedido;
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
                                    '<li><p id="nombreLin"><span class="glyphicon glyphicon-cutlery"></span>' + cantidad + ' x ' + nombre + ' (' + nref + ')</p></li>' +
                                    '<li><p id="precioLin"><span class="fa fa-money"></span>' + (precioProd * cantidad) + '€</p></li>' +
                                    '<li class="saltoLin"></li>';
                            }

                            //ponemos fecha y alias en la cabecera h2
                            $("#fechaPedidoDt").text(fecha);
                            $("#estadoPedDt").html('<span class="glyphicon glyphicon-cog"></span>' + estado + '<span class="fa fa-user-o"></span>' + nombreEmpleado);
                            $("#precioPedDt").html('<span class="glyphicon glyphicon-usd"></span>TOTAL: ' + precio + '€');

                            //append al ul
                            $("#lineasPedDt").append(contenidoUlLineasPedido);

                            //mostramos modal
                            $("#dtPedido").modal("show");
                        });
                });
        }

        $("#dtPedido button").on("click", function () {
            $("#dtPedido").modal("hide");
        });

        function iniLineasPed() {
            //append al ul
            $("#lineasPedDt").html("");
        }

    </script>
</div>