<link rel="stylesheet" href="<?= base_url() ?>/assets/css/carta/pizza2.css">
<script type="text/javascript">
    $(document).ready(function () {
        //hover titulo y blur
        $("#pizzaContainer li img").hover(function () {
            var text = $(this).attr("src");
            $(this).attr("src", text.replace(".png", "_t.png"));
            $(this).next().show();
            $(this).next().next().show();

        }, function () {
            //mouseout
            var text = $(this).attr("src");
            $(this).attr("src", text.replace("_t.png", ".png"));
            $(this).next().hide();
            $(this).next().next().hide();
        });


        $("#cerrarPubli i").click(function () {
            $("#bannerPizza").hide();
        });

        cont = 0;
        $("#btnpizdiab").on("mouseenter", function () {
            if (cont <= 4) {
                $("#btnpizdiab").addClass("anim" + cont);

                cont = cont + 1;
            }
        });

        $("#btnpizdiab").on("click", function () {
            document.getElementById("captcha").style.visibility = "visible";
            document.getElementById("inputCaptcha").focus();
        });

        $("#inputCaptcha").keypress(function (e) {
            if (e.which == 13) {
                if ($("#inputCaptcha").val().toLowerCase() == "alt f4" || $("#inputCaptcha").val().toLowerCase() == "alt + f4" || $("#inputCaptcha").val().toLowerCase() == "alt+f4" || $("#inputCaptcha").val().toLowerCase() == "altf4") {
                    alert("Está bien, tú ganas...");
                    $("#captcha").hide();
                }
                else {
                    $("#inputCaptcha").val("");
                }
            }
        });

        mostrado = false;
        $("#btnpizdiab").hover(function () {
            if (!mostrado) {
                $("#bannerPizza").show();
                mostrado = true;
            }
        });
    });
</script>
<div class="container">
    <?php foreach ($body['pizza'] as $pizza) : ?>
        <div class="pizzaColumna" id="pizzaContainer">
            <li class="pizza" id="<?= $pizza['nref'] ?>">
                <div class="imagenTitulo" style="">
                    <img src="<?= base_url() ?>assets/images/<?= $pizza['imgsrc'] ?>" alt="<?= $pizza['nombre'] ?>">
                    <h5 hidden><?= $pizza['nombre'] ?></h5>
                    <p hidden><?= $pizza['descri'] ?></p>
                </div>
                <button id="btn<?= $pizza['nref'] ?>">Añadir</button>
            </li>
            <?php if ($pizza['nref'] === "pizdiab") {
                //ponemos banner en la pizza diabolica ?>
                <div id="captcha">
                    <label id="textoCaptcha">Vaya, esto es algo inusual. Tenemos que comprobar que de verdad no eres un
                        robot...</label>
                    <div id="captchaContainer">
                        <img src="<?= base_url() ?>assets/images/captcha.PNG" alt="">
                        <input id="inputCaptcha" type="text">
                    </div>
                </div>
                <div id="bannerPizza">
                    <a href="<?= base_url() ?>"><img src="<?= base_url() ?>assets/images/publi2.png" alt=""></a>
                    <div id="cerrarPubli"><i class="fa fa-times" aria-hidden="true"></i></div>
                </div>
            <?php } ?>
        </div>
    <?php endforeach; ?>
</div>