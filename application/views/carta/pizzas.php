<script type="text/javascript">
    $(document).ready(function () {
        $("#pizzaContainer li img").hover(function () {
            var text = $(this).attr("src");
            $(this).attr("src", text.replace(".png", "_t.png"));
            console.log("mousein " + $(this).attr("src"));
            $(this).next().show();
        }, function () {
            //mouseout
            var text = $(this).attr("src");
            $(this).attr("src", text.replace("_t.png", ".png"));
            console.log("mouseoute " + $(this).attr("src"));
            $(this).next().hide();
        });

        $("#cerrarPubli i").click(function () {
            $("#bannerPizza").hide();
        });
    });

</script>
<div class="container">
    <div class="row">
        <ul id="pizzaContainer">
            <li class="pizza" id="p1">
                <div class="imagenTitulo" style="">
                    <img src="<?= base_url() ?>assets/images/pizza5.png" alt="">
                    <h5 hidden>PERSONALIZADA</h5>
                </div>
                <button type="button" onclick="addPizza(1)">Añadir</button>
            </li>
            <li class="pizza" id="p2">
                <div class="imagenTitulo" style="">
                    <img src="<?= base_url() ?>assets/images/pizza1.png" alt="">
                    <h5 hidden>MARGARITA</h5>
                </div>
                <button type="button" onclick="addPizza(2)">Añadir</button>
            </li>
            <li class="pizza" id="p3">
                <div class="imagenTitulo" style="">
                    <img src="<?= base_url() ?>assets/images/pizza2.png" alt="">
                    <h5 hidden>COMPLETA</h5>
                </div>
                <button type="button" onclick="addPizza(3)">Añadir</button>
            </li>
            <li class="pizza" id="p4">
                <div class="imagenTitulo" style="">
                    <img src="<?= base_url() ?>assets/images/pizza3.png" alt="">
                    <h5 hidden>QUESERA</h5>
                </div>
                <button type="button" onclick="addPizza(4)">Añadir</button>
            </li>
            <li class="pizza" id="p5">
                <div class="imagenTitulo" style="">
                    <img src="<?= base_url() ?>assets/images/pizza4.png" alt="">
                    <h5 hidden>VEGETARIANA</h5>
                </div>
                <button type="button" onclick="addPizza(5)">Añadir</button>
            </li>
            <li class="pizza" id="p6">
                <div class="imagenTitulo" style="">
                    <img src="<?= base_url() ?>assets/images/pizza6.png" alt="">
                    <h5 hidden>PEPERONI</h5>
                </div>
                <button type="button" onclick="addPizza(6)">Añadir</button>
            </li>
            <li class="pizza" id="p7">
                <div class="imagenTitulo" style="">
                    <img src="<?= base_url() ?>assets/images/pizza7.png" alt="">
                    <h5 hidden>IBÉRICA</h5>
                </div>
                <button type="button" onclick="addPizza(7)">Añadir</button>
            </li>
            <li class="pizza" id="p8">
                <div class="imagenTitulo" style="">
                    <img src="<?= base_url() ?>assets/images/pizza8.png" alt="">
                    <h5 hidden>BARBACOA</h5>
                </div>
                <button type="button" onclick="addPizza(8)">Añadir</button>
            </li>
            <li class="pizza" id="p9">
                <div class="imagenTitulo" style="">
                    <img src="<?= base_url() ?>assets/images/pizza9.png" alt="">
                    <h5 hidden>CARBONARA</h5>
                </div>
                <button type="button" onclick="addPizza(9)">Añadir</button>
            </li>
            <li class="pizza" id="p10">
                <div class="imagenTitulo" style="">
                    <img src="<?= base_url() ?>assets/images/pizza10.png" alt="">
                    <h5 hidden>DIABÓLICA</h5>
                </div>
                <button id="btnMover" type="button" onclick="addPizza(10)">Añadir</button>
            </li>
        </ul>
    </div>
    <div id="bannerPizza">
        <a href="<?= base_url() ?>"><img src="<?= base_url() ?>assets/images/publi.png" alt=""></a>
        <div id="cerrarPubli"><i class="fa fa-times" aria-hidden="true"></i></div>
    </div>
</div>

