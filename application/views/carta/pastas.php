<?php
if(!isset($_SESSION)){
    session_start();
    $_SESSION['carrito']=[];
}
?>
<div class="container">
    <h1 class="productoTitulo">ELIGE TU PASTA</h1>
    <?php foreach ($body['pasta'] as $producto) : ?>
        <div class="productoColumna" id="productoContainer">
            <li class="producto" id="<?= $producto['nref'] ?>">
                <div class="imagenTitulo" style="">
                    <img src="<?= base_url() ?>assets/images/<?= $producto['imgsrc'] ?>" alt="<?= $producto['nombre'] ?>">
                    <h5 hidden><?= $producto['nombre'] ?></h5>
                    <p hidden><?= $producto['descri'] ?></p>
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
        }).done(function(msg){
            console.log("done: "+msg)
        });
    }
    console.log(<?= json_encode($_SESSION)?>);
</script>