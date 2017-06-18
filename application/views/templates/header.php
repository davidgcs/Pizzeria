<?php if(!isset($_SESSION)) session_start();?>
<header id="header" class="alt">
    <a href="<?=base_url()?>"><img src="<?= base_url() ?>assets/images/LogoPizHubTransp.png" alt="PizHub" id="logo_header"></a>
    <nav id="nav">
        <ul>
            <li class="special">
                <a href="#menu" class="menuToggle"><span>Menu</span></a>
                <div id="menu">
                    <ul>
                        <li><a href="<?=base_url()?>">Inicio</a></li>

                        <li><a href="<?php
                            echo ($this->uri->segment(1)==""||$this->uri->segment(1)=="home")?"":base_url() //escribe solo el anchor si estamos en home
                            ?>#carta" class="scrolly">Carta</a></li>

                        <li><a href="<?php
                            echo ($this->uri->segment(1)==""||$this->uri->segment(1)=="home")?"":base_url() //escribe solo el anchor si estamos en home
                            ?>#localizacion" class="scrolly">¿Dónde estamos?</a></li>

<!--                        <li><a href="--><?//=base_url()?><!--#carta" class="scrolly">Carta</a></li>-->
                        <li><a href="<?=base_url()?>usuario/login">Perfil</a></li>
                        <li><a href="<?=base_url()?>empresa/contacto">Contacto</a></li>
                        <li><a href="<?=base_url()?>empresa/acerca">Acerca de Nosotros</a></li>
                        <?php if(isset($_SESSION['logeado']) && $_SESSION["logeado"]==true):?>
                            <li><a href="<?=base_url()?>usuario/logout">Salir </a></li>
                        <?php endif;?>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
    <a class="cartIcon" href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
    <div class="cart" id="cart">
        <p class="cartEmpty">El carrito está vacío</p>
        <div class="pagar">Pagar</div>
    </div>
    <h5 id="saludo"><?php if(isset($_SESSION['logeado']) && $_SESSION["logeado"]==true) echo $_SESSION["usuarioActual"]?></h5> <a href="<?= base_url() ?>usuario/login"><i class="<?php echo (isset($_SESSION['logeado']) && $_SESSION["logeado"]==true) ? 'fa fa-user-circle' : 'fa fa-sign-in';?>"></i></a>
    <script>
        $(document).ready(function() {
            var productos =<?= json_encode(isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [])?>;
            var baseUrl = "<?=base_url()?>";
            var addedCarrito = {};
            console.log(productos);
            if(productos.length === 0){

            }
            else {
                $("#header p.cartEmpty").hide();
//                $(productos).each(function (ind, el) {
                for(var i = 0; i<Object.keys(productos).length; i++){
                    console.log(i);
//                    var prod = el[Object.keys(el)[0]];
//                    var producto = el[Object.keys(el)[0]];
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
                        $cartItem.data("nref",producto[pIndex].nref);

                        $cartItem.append("<button class='deleteCart btn btn-danger'>Eliminar</button>");

                        $cartItem.appendTo("#cart");
                    }
                    else {
                        addedCarrito[productoId] += 1;
                        $("#cartItem" + productoId + " .ciCantidad").html("x"+addedCarrito[productoId]);
                        $("#cartItem" + productoId + " .ciPrecio").html((producto[pIndex].precio*addedCarrito[productoId])+"€");
                    }
                }
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
    </script>
</header>