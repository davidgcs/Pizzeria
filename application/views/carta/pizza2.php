<script type="text/javascript">
    var containerHTML = $(".container").html();

    function dosColumnas(){
        var contador = 0;
        var contenido = '';
        $(".container").each($("#pizzaContainer"), function (i, element) {
            if (contador === 0) {
                contenido+= '<div class="row"><div class="col-md-6" id="pizzaContainer">'+element.html()+'</div>';
            } else {
                contenido+= '<div class="col-md-6" id="pizzaContainer">'+element.html()+'</div></div>';
            }

            contador += 1;
            if(contador === 2) {
                contador = 0;
            }
        });

        return contenido;
    }

    var mediaquery = window.matchMedia("(max-width: 1000px)");
    function handleOrientationChange(mediaquery) {
        if (mediaquery.matches) {
            //menos de 1000px
            console.log("menos");
            $(".container").html(dosColumnas());
        } else {
            //mas de 1000px
            console.log("mas");
            $(".container").html(containerHTML);
        }
    }
    mediaquery.addListener(handleOrientationChange);

    //hover titulo y blur
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
<style>

    #pizzaContainer li {
        list-style: none;
        text-align: center;
    }

    div.imagenTitulo{
        position: relative;
        margin-bottom: -5%;
    }

    div.imagenTitulo h5{
        position: absolute;
        top: 46%;
        bottom: 50%;
        width: 100%;
        pointer-events: none !important;
        text-shadow: 2px 2px #2e3842;
        font-size: 1em;
    }

    div.imagenTitulo img {
        width: 80%;
    }

</style>
<div class="container">
    <?php
    $pizzasPintadas = 0;
    $divAbierto = false;
    foreach ($body['pizza'] as $pizza) :
        //comprobar si hemos metido 3 y pasar de linea
        if ($pizzasPintadas == 0) {
            echo '<div class="row">';
            $divAbierto = true;
        }
        ?>
        <div class="col-md-4" id ="pizzaContainer">
            <li class="pizza" id="<?= $pizza['nref'] ?>">
                <div class="imagenTitulo" style="">
                    <img src="<?= base_url() ?>assets/images/<?= $pizza['imgsrc'] ?>" alt="<?= $pizza['nombre'] ?>">
                    <h5 hidden>PERSONALIZADA</h5>
                </div>
                <button type="button" onclick="addPizza(<?= $pizza['nref'] ?>)">Añadir</button>
            </li>
        </div>
        <?php
        //end foreach
        $pizzasPintadas += 1;
        if ($pizzasPintadas == 3) {
            echo '</div>';
            $pizzasPintadas = 0;
        }

    endforeach;

    if ($divAbierto) {
        //cerramos div
        echo '</div>';
    }
    ?>
</div>