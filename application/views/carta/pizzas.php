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
        }).done(function(msg){
            console.log("done: "+msg)
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