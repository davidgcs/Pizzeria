<div class="container">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/login_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
    <script>
        $(function() {

            $("#f2").hide();
//            $("#btnSiguiente").click(function () {
//
//                //solo ejecutar el siguiente código si los campos de #f1 estan rellenos y son correctos.
//                $("#f1").hide();
//                $("#f2").show();
//            });
        });
    </script>

    <div class="login">
        <h1>Resitro</h1>
        <form id="formRegistro" action="registrarPost" method="post">
            <div id="f1">
                <input type="text" name="nombre" placeholder="Nombre" required="required"/>
                <input type="text" name="nombre" placeholder="Apellidos" required="required"/>
                <input type="tel" name="tel" placeholder="Teléfono">
                <input type="email" name="email" placeholder="Correo electrónico" required="required"/>
                <button id="btnSiguiente" class="btn btn-primary btn-block btn-large">Siguiente</button>
            </div>
            <div id="f2">
                <input type="text" name="u" placeholder="Alias" required="required"/>
                <input type="password" id="contraseña1" name="p" placeholder="Contraseña" required="required"/>
                <input type="password" id="contraseña2" placeholder="Confirmar contraseña" required="required"/>
                <button type="submit" class="btn btn-primary btn-block btn-large">Registrarse</button>
            </div>
        </form>
    </div>


</div>
