<link rel="stylesheet" href="<?= base_url() ?>/assets/css/carta/pizza2.css">
<script type="text/javascript">
    $(document).ready(function () {
        //hover titulo y blur
        $("#pizzaContainer li img").hover(function () {
            var text = $(this).attr("src");
            $(this).attr("src", text.replace(".png", "_t.png"));
            //console.log("mousein " + $(this).attr("src"));
            $(this).next().show();
            $(this).next().next().show();

        }, function () {
            //mouseout
            var text = $(this).attr("src");
            $(this).attr("src", text.replace("_t.png", ".png"));
            //console.log("mouseoute " + $(this).attr("src"));
            $(this).next().hide();
            $(this).next().next().hide();
        });
        var diabX = $("#pizdiab").get

        //boton piña
        $("#pizdiab").hover( function () {

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
                <button id="<?= $pizza['nref'] ?>">Añadir</button>
            </li>
        </div>
    <?php endforeach; ?>
</div>