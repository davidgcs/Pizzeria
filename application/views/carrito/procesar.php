<div class="container">
    <h1>¡El último paso!</h1>
    <h4>Tu pedido:</h4>
    <div id="pedido">

    </div>
    <p>Total: <b class="cartTotal">0</b>€</p>
    <form id="f3" action="#" method="post">
        <?php if(sizeof($body) === 0):?>
            <h4>Introduce tu dirección</h4>
            Calle: <input type="text" name="newCalle" value="">
            Número: <input type="text" name="newNumero" value="">
            Ciudad: <input type="text" name="newCiudad" value="">
            Cod. Postal: <input type="text" maxlength="5" name="newCP" value="">
        <?php else: ?>
            <h4>Revisa si tus datos son correctos</h4>
            Calle: <input type="text" name="newCalle" value="<?= $body["usuarioActual"]["calle"] ?>">
            Número: <input type="text" name="newNumero" value="<?= $body["usuarioActual"]["numero"] ?>">
            Ciudad: <input type="text" name="newCiudad" value="<?= $body["usuarioActual"]["ciudad"] ?>">
            Cod. Postal: <input type="text" maxlength="5" name="newCP" value="<?= $body["usuarioActual"]["cp"] ?>">
        <?php endif; ?>
        <button class="btn btn-success" type="submit">¡Pedir!</button>
    </form>
</div>
<script>
    $(document).ready(function() {
        var productos =<?= json_encode(isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [])?>;
        var baseUrl = "<?=base_url()?>";
        var addedCarrito = {};
        console.log(productos);
        if (productos.length === 0) {
            $("#header .cart .btnPagar").addClass("disabled");
        }
        else {
            $("#header p.cartEmpty").hide();
            for (var i = 0; i < Object.keys(productos).length; i++) {
                console.log(i);
                var producto = productos[i];
                var pIndex = Object.keys(producto)[0];
                var productoId = producto[pIndex].id;
                if (addedCarrito[productoId] === undefined) {
                    addedCarrito[productoId] = 1;

                    var $cartItem = $("<div class='cartItem' id='cartItem" + productoId + "'></div>");
                    $cartItem.append("<img src='" + baseUrl + "assets/images/" + producto[pIndex].imgsrc + "' alt='" + producto[pIndex].nombre + "'>");
                    $cartItem.append("<span class='ciNombre'>" + producto[pIndex].nombre.toLowerCase() + "</span>");
                    $cartItem.append("<span class='ciCantidad'>x" + addedCarrito[productoId] + "</span>");
                    $cartItem.append("<span class='ciPrecio'>" + producto[pIndex].precio + "€ </span>");
                    $cartItem.data("nref", producto[pIndex].nref);

                    $cartItem.appendTo("#pedido");
                }
                else {
                    addedCarrito[productoId] += 1;
                    $("#cartItem" + productoId + " .ciCantidad").html("x" + addedCarrito[productoId]);
                    $("#cartItem" + productoId + " .ciPrecio").html((producto[pIndex].precio * addedCarrito[productoId]) + "€");
                }
            }
        }
        var totalPagar = 0;
        $("#pedido .cartItem").each(function(ind, el){
            totalPagar += parseInt($(el).find("span.ciPrecio").html().split("€")[0]);
            console.log(totalPagar)
        });
        $(".container .cartTotal").html(parseFloat(totalPagar).toFixed(2));
    });
</script>

