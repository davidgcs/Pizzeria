<div class="container">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/login_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
    <script>
        $(function() {

            <?php if (isset($_SESSION['errorRegistro'])): ?>
            <?php session_destroy();?>
                $("#errorRegistro").show();
            <?php else: ?>
                $("#errorRegistro").hide();
            <?php endif;?>

            $("#btnSiguiente").click(function () {

                //solo ejecutar el siguiente código si los campos de #f1 estan rellenos y son correctos.


                <?php /*foreach ($registro as $user): */?><!--
                    <?php /*if ($user["email"] == $("#email")):*/?>
                --><?php /*endforeach;*/?>

                $("#f1").hide();
                $("#f2").show();
            });

            $("#btnRegistro").click(function () {

                if(($("#contraseña1").val()==$("#contraseña2").val())){
                    console.log("pass repetida correctamente");
                }
                else {
                    console.log("pass repetida incorrectamente");
                    $("#contraseña1,#contraseña2").val("");

                    $("#errorContraseñas").show();
                    /* Evita el submit. No es necesario debido a que se borran antes los campos de contraseña y salta error en el required
                    $("#formRegistro").submit(function (e) {
                        e.preventDefault();
                    });*/
                }
            });

            $("#alias").on("keyup", function () {
               var url_comprobarAlias = "<?=base_url()."usuario/compruebaAlias"?>"+"?alias="+$(this).val();
               var coincide = false;
               $.post(url_comprobarAlias, function (respuesta) {
                   if (respuesta==="S"){
                       //$('#errorRegistro').show();
                       $("#alias").addClass("campoIncorrecto");
                       $("#ialias").addClass("fa fa-times-circle").removeClass("fa-check-circle").css("color", "rgba(224, 48, 48, 0.9)");
                       $("#ialias").show();

                   }
                   else if (respuesta==="N"){
                       //$('#errorRegistro').hide();
                       $("#alias").removeClass("campoIncorrecto");
                       $("#ialias").addClass("fa fa-check-circle").removeClass("fa-times-circle").css("color", "rgba(0, 185, 0, 0.86)");
                       $("#ialias").show();
                   }
               });
            });

            $("#email").on("keyup", function () {
                var url_comprobarMail = "<?=base_url()."usuario/compruebaMail"?>"+"?email="+$(this).val();
                var coincide = false;
                $.post(url_comprobarMail, function (respuesta) {
                    if (respuesta==="S"){
                        //$('#errorRegistro').show();
                        $("#email").addClass("yaExiste");
                        $("#imail").addClass("fa fa-times-circle").css("color", "red");
                        $("#imail").show();

                    } else {
                        //$('#errorRegistro').hide();
                        $("#email").removeClass("yaExiste");
                        $("#imail").addClass("fa fa-check-circle").css("color", "green");
                        $("#imail").show();
                    }
                });
            });
        });
    </script>

    <div class="login">
        <h1>Registro</h1>
        <form id="formRegistro" action="registrarPost" method="post">
            <div id="f1">
                <input type="text" name="nombre" placeholder="Nombre" required="required"/>
                <input type="text" name="apellidos" placeholder="Apellidos" required="required"/>
                <input type="tel" name="tel" placeholder="Teléfono">
                <i id="imail"></i>
                <input id="email" type="email" name="email" placeholder="Correo electrónico" required="required"/>
                <button type="button" id="btnSiguiente" class="btn btn-primary btn-block btn-large">Siguiente</button>
            </div>
            <div id="f2" hidden>
                <i id="ialias"></i>
                <input type="text" id="alias" name="u" placeholder="Alias" required="required"/>
                <input type="password" id="contraseña1" name="p" placeholder="Contraseña" required="required"/>
                <input type="password" id="contraseña2" placeholder="Repetir contraseña" required="required"/>
                <button type="submit" id="btnRegistro" class="btn btn-primary btn-block btn-large">Registrarse</button>
            </div>
        </form>
    </div>

    <div id="errorRegistro" hidden>
        <h4>El correo electrónico o usuario ya están en uso. Intentalo de nuevo.</h4>
    </div>
    <div id="errorContraseñas" hidden>
        <h4>Las contraseñas no coinciden.</h4>
    </div>
</div>
