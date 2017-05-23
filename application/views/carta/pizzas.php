<script type="text/javascript">
    $(document).ready( function () {
       $("#pizzaContainer li img").hover(function () {
          $(this).next().show();
       }, function () {
          //mouseout
          $(this).next().hide();
       });
    });

</script>
<div class="container">
    <div class="row">
        <ul id="pizzaContainer">
            <li class="pizza" id="p1">
                <img src="<?= base_url() ?>assets/images/pizza1.png" alt="">
                <h1 hidden>TITULO DE LA PIZZA</h1>
                <button type="button">Añadir</button>
            </li>
            <li class="pizza" id="p2">
                <img src="<?= base_url() ?>assets/images/pizza2.png" alt="">
                <h1 hidden>TITULO DE LA PIZZA</h1>
                <button type="button">Añadir</button>
            </li>
            <li class="pizza" id="p3">
                <img src="<?= base_url() ?>assets/images/pizza3.png" alt="">
                <h1 hidden>TITULO DE LA PIZZA</h1>
                <button type="button">Añadir</button>
            </li>
            <li class="pizza" id="p4">
                <img src="<?= base_url() ?>assets/images/pizza4.png" alt="">
                <h1 hidden>TITULO DE LA PIZZA</h1>
                <button type="button">Añadir</button>
            </li>
            <li class="pizza" id="p5">
                <img src="<?= base_url() ?>assets/images/pizza5.png" alt="">
                <h1 hidden>TITULO DE LA PIZZA</h1>
                <button type="button">Añadir</button>
            </li>
            <li class="pizza" id="p6">
                <img src="<?= base_url() ?>assets/images/pizza6.png" alt="">
                <h1 hidden>TITULO DE LA PIZZA</h1>
                <button type="button">Añadir</button>
            </li>
            <li class="pizza" id="p7">
                <img src="<?= base_url() ?>assets/images/pizza7.png" alt="">
                <h1 hidden>TITULO DE LA PIZZA</h1>
                <button type="button">Añadir</button>
            </li>
            <li class="pizza" id="p8">
                <img src="<?= base_url() ?>assets/images/pizza8.png" alt="">
                <h1 hidden>TITULO DE LA PIZZA</h1>
                <button type="button">Añadir</button>
            </li>
            <li class="pizza" id="p9">
                <img src="<?= base_url() ?>assets/images/pizza9.png" alt="">
                <h1 hidden>TITULO DE LA PIZZA</h1>
                <button type="button">Añadir</button>
            </li>
            <li class="pizza" id="p10">
                <img src="<?= base_url() ?>assets/images/pizza10.png" alt="">
                <h1 hidden>TITULO DE LA PIZZA</h1>
                <button type="button">Añadir</button>
            </li>
        </ul>
    </div>
</div>