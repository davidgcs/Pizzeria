<link rel="stylesheet" href="<?= base_url() ?>assets/css/carta/producto.css">
<script type="text/javascript" src="<?= base_url() ?>assets/js/carta/producto.js"></script>
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
                <button id="btn<?= $producto['nref'] ?>">Añadir</button>
            </li>
        </div>
    <?php endforeach; ?>
</div>