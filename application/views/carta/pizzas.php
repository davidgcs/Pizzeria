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
        }).done(function(msg){
            console.log("done: "+msg)
        });
    }
    console.log(<?= json_encode($_SESSION)?>);
</script>