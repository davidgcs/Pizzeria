<?php
if(!isset($_SESSION)){
    session_start();
    $_SESSION['carrito']=[];
}
?>
<div class="container">
    <h1 class="productoTitulo">ELIGE TU HAMBURGUESA</h1>
    <?php foreach ($body['hamburguesa'] as $producto) : ?>
        <div class="productoColumna" id="productoContainer">
            <li class="producto" id="<?= $producto['nref'] ?>">
                <div class="imagenTitulo" style="">
                    <img src="<?= base_url() ?>assets/images/<?= $producto['imgsrc'] ?>" alt="<?= $producto['nombre'] ?>">
                    <h5 hidden><?= $producto['nombre'] ?></h5>
                    <p hidden><?= $producto['descri'] ?></p>
                </div>
                <button id="btn<?= $producto['nref'] ?>">Añadir</button>
            </li>
        </div>
    <?php endforeach; ?>
</div>