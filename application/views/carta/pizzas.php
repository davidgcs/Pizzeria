<?php
if(!isset($_SESSION)){
    session_start();
    $_SESSION['carrito']=[];
}
?>
<style>
    label{
        color: #2e3842;
        display: inline;
    }
    h4{
        color: #2e3842 !important;
    }
    .precio{
        top: 58% !important;
    }
</style>
<div class="container">
    <h1 class="productoTitulo">ELIGE TU PIZZA</h1>
    <?php foreach ($body['pizza'] as $producto) : ?>
        <div class="productoColumna" id="productoContainer">
            <li class="producto" id="<?= $producto['nref'] ?>">
                <div class="imagenTitulo" style="">
                    <img src="<?= base_url() ?>assets/images/<?= $producto['imgsrc'] ?>" alt="<?= $producto['nombre'] ?>">
                    <h5 hidden><?= $producto['nombre'] ?></h5>
                    <p hidden><?= $producto['descri'] ?></p>
                    <p class="precio" hidden><?= $producto['precio'] ?> €</p>
                </div>
                <?php if($producto['nref']=="pizpers"):?>
                    <button id="btn<?= $producto['nref'] ?>" data-toggle="modal" data-target="#myModal">Añadir</button>
                <?php else: ?>
                    <button onclick="addCarrito(<?= $producto['nref'] ?>)" id="btn<?= $producto['nref'] ?>">Añadir</button>
                <?php endif; ?>
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

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">INGREDIENTES</h4>
                </div>
                <div class="modal-body">
                    <?php foreach ($body["ingredientes"] as $i):?>
                        <label for='<?=$i["nombre"]?>' style='color: #2e3842;'><?=$i["nombre"]?></label>
                        <input class='check_list' type='checkbox' id='<?=$i["nombre"]?>' name='<?=$i["nombre"]?>'>
                        <br>
                    <?php endforeach; ?>
                </div>
                <div class="modal-footer">
                    <button onclick="addPersonalizada()" type="button" class="btn btn-primary" data-dismiss="modal">Añadir</button>
                </div>
            </div>
        </div>
    </div>
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
    console.log(<?= json_encode($_SESSION)?>);

    function addPersonalizada(){
        var ing = [];
        $('input[type="checkbox"]').filter(':checked').each(function (i,v) {
            ing.push(v.name);
        });
        $.ajax({
            method: "POST",
            url: "<?=base_url()?>carrito/addPersToCart",
            data: {nref: 'pizpers', ingredientes: ing}
        }).done(function(msg){
            console.log("done: "+msg)
        });
    }
    $(document).ready(function(){

        jQuery(function(){
            var max = 5;
            var checkboxes = $('input[type="checkbox"]');

            checkboxes.change(function(){
                var current = checkboxes.filter(':checked').length;
                checkboxes.filter(':not(:checked)').prop('disabled', current >= max);
            });
        });

    });
</script>