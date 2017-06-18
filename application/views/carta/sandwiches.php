<?php
if(!isset($_SESSION)){
    session_start();
    $_SESSION['carrito']=[];
}
?>
<div class="container">
    <h1 class="productoTitulo">ELIGE TU SÁNDWICH</h1>
    <?php foreach ($body['sandwich'] as $producto) : ?>
        <div class="productoColumna" id="productoContainer">
            <li class="producto" id="<?= $producto['nref'] ?>">
                <div class="imagenTitulo" style="">
                    <img src="<?= base_url() ?>assets/images/<?= $producto['imgsrc'] ?>" alt="<?= $producto['nombre'] ?>">
                    <h5 hidden><?= $producto['nombre'] ?></h5>
                    <p hidden><?= $producto['descri'] ?></p>
                    <p hidden style="top: 58% !important;"><?= $producto['precio'] ?> €</p>
                </div>
                <button onclick="addCarrito(<?= $producto['nref'] ?>)" id="btn<?= $producto['nref'] ?>">Añadir</button>
            </li>
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

            $("#header .cart .pagar .cartTotal").html(
                parseInt($("#header .cart .pagar .cartTotal").html())+parseInt(producto[pIndex].precio)
            );

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

            $(".cartItem").hover(function(){
                $(this).find("span").css("visibility","hidden");
                $(this).find("button.deleteCart").css("visibility","visible");
            }, function(){
                $(this).find("span").css("visibility","visible");
                $(this).find("button.deleteCart").css("visibility","hidden");
            });

            $("#header .deleteCart").on("click", function () {
                var nref = "";
                nref = $(this).parent(".cartItem").data("nref");
                $(this).parent(".cartItem").fadeOut(500,function(){
                    console.log(nref);
                    $(this).remove();
                    $("#header .cart .pagar .cartTotal").html(
                        parseInt($("#header .cart .pagar .cartTotal").html())-parseInt($(this).find("span.ciPrecio").html().split("€")[0])
                    );
                    $("#header .cart").stop().slideDown();
                    if($("#header .cart").find(".cartItem").length === 0){
                        $("#header .cart .cartEmpty").show();
                    }
                });

                $.ajax({
                    method: "POST",
                    url: "<?=base_url()?>carrito/deleteFromCart",
                    data: {nref: nref}
                }).done(function(msg){
                    console.log("done: "+msg)
                });

            });
        });

    }
</script>