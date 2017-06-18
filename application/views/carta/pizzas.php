<?php
if(!isset($_SESSION)){
    session_start();
    $_SESSION['carrito']=[];
}
?>
<div class="container">
    <h1 class="productoTitulo">ELIGE TU PIZZA</h1>
    <?php foreach ($body['pizza'] as $producto) : ?>
        <div class="productoColumna" id="productoContainer">
            <li class="producto" id="<?= $producto['nref'] ?>">
                <div class="imagenTitulo" style="">
                    <img src="<?= base_url() ?>assets/images/<?= $producto['imgsrc'] ?>" alt="<?= $producto['nombre'] ?>">
                    <h5 hidden><?= $producto['nombre'] ?></h5>
                    <p hidden><?= $producto['descri'] ?></p>
                </div>
                <button onclick="addCarrito(<?= $producto['nref'] ?>)" id="btn<?= $producto['nref'] ?>">Añadir</button>
            </li>
            <?php if ($producto['nref'] === "pizdiab") {
                //ponemos banner en la pizza diabolica ?>
                <div id="captcha">
                    <label id="textoCaptcha">Vaya, esto es algo inusual. Tenemos que comprobar que de verdad no eres un
                        robot...</label>
                    <div id="captchaContainer">
                        <img src="<?= base_url() ?>assets/images/captcha.PNG" alt="">
                        <input id="inputCaptcha" type="text">
                    </div>
                </div>
                <div id="bannerProducto">
                    <a href="<?= base_url() ?>"><img src="<?= base_url() ?>assets/images/publi.png" alt=""></a>
                    <div id="cerrarPubli"><i class="fa fa-times" aria-hidden="true"></i></div>
                </div>
            <?php } ?>
        </div>
    <?php endforeach; ?>
</div>
<script>
    function addCarrito(nref){
        console.log(nref.id);
        $.ajax({
            method: "POST",
            url: "<?=base_url()?>carrito/addToCart",
            data: {nref: nref.id}
        }).done(function(prod){
            var baseUrl = "<?=base_url()?>";
            var addedCarrito = {};
            $("#header p.cartEmpty").hide();

            var producto = JSON.parse(prod);
            console.log(producto);
            var pIndex = Object.keys(producto)[0];
            console.log(pIndex);
            var productoId = producto[pIndex].id;
            console.log(productoId);

            if ($("#header .cart #cartItem"+productoId).length === 0) {
                addedCarrito[productoId] = 1;

                var $cartItem = $("<div class='cartItem' id='cartItem" + productoId + "'></div>");
                $cartItem.append("<img src='" + baseUrl + "assets/images/" + producto[pIndex].imgsrc + "' alt='" + producto[pIndex].nombre + "'>");
                $cartItem.append("<span class='ciNombre'>" + producto[pIndex].nombre.toLowerCase() + "</span>");
                $cartItem.append("<span class='ciCantidad'>x" + addedCarrito[productoId] + "</span>");
                $cartItem.append("<span class='ciPrecio'>" + producto[pIndex].precio + "€ </span>");
                $cartItem.data("nref",producto[pIndex].nref);

                $cartItem.append("<button class='deleteCart btn btn-danger'>Eliminar</button>");

                $cartItem.appendTo("#cart");
            }
            else {
                addedCarrito[productoId] = parseInt($("#header .cart #cartItem"+productoId+" .ciCantidad").html().split("x")[1]);
                console.log(addedCarrito[productoId]);
                addedCarrito[productoId] += 1;
                $("#cartItem" + productoId + " .ciCantidad").html("x"+addedCarrito[productoId]);
                $("#cartItem" + productoId + " .ciPrecio").html((producto[pIndex].precio*addedCarrito[productoId])+"€");
            }
        });

    }
    console.log(<?= json_encode($_SESSION)?>);
</script>