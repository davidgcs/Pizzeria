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

                if(camposCorrectos()) {
                    $("#f1").hide();
                    $("#f2").show();
                }

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
                       $("#alias").removeClass("campoCorrecto");
                       $("#alias").addClass("campoIncorrecto");
                       $("#ialias").addClass("fa fa-times-circle").removeClass("fa-check-circle").css("color", "rgba(224, 48, 48, 0.9)");
                       $("#error").show().children("h4").html("Ese alias ya está en uso");
                       $("#ialias").show();

                   }
                   else if (respuesta==="N"){
                       //$('#errorRegistro').hide();
                       $("#alias").removeClass("campoIncorrecto");
                       $("#alias").addClass("campoCorrecto");
                       $("#ialias").addClass("fa fa-check-circle").removeClass("fa-times-circle").css("color", "rgba(0, 185, 0, 0.86)");
                       $("#error").hide().children("h4").html("");
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
                        $("#email").removeClass("campoCorrecto");
                        $("#email").addClass("campoIncorrecto");
                        $("#imail").addClass("fa fa-times-circle").css("color", "red");
                        $("#imail").show();

                    } else {
                        //$('#errorRegistro').hide();
                        $("#email").removeClass("campoIncorrecto");
                        $("#email").addClass("campoCorrecto");
                        $("#imail").addClass("fa fa-check-circle").css("color", "green");
                        $("#imail").show();
                    }
                });
            });
            function camposCorrectos(){
                $cond = true;


                if($("#nombre").val()==""){
                    $("#nombre").addClass("error");
                    $cond = false;
                }
                else{
                    console.log("remove class");
                    $("#nombre").removeClass("error");
                }


                if($("#apellidos").val()==""){
                    $("#apellidos").addClass("error");
                    $cond = false;
                }
                else{
                    $("#apellidos").removeClass("error");
                }


                if($("#email").val()==""){
                    $("#email").addClass("error");
                    $cond = false;
                }
                else{
                    $("#email").removeClass("error");
                }


                if($("#telefono").val()=="" || !($.isNumeric($("#telefono").val())) || $("#telefono").val().length<9){
                    $("#telefono").addClass("error");
                    $cond = false;
                }
                else{
                    $("#telefono").removeClass("error");
                }


                return $cond;
            }
        });
    </script>

    <div class="login">
        <h1>Registro</h1>
        <form id="formRegistro" action="registrarPost" method="post">
            <div id="f1">
                <input id="nombre" type="text" name="nombre" placeholder="Nombre" required="required"/>
                <input id="apellidos" type="text" name="apellidos" placeholder="Apellidos" required="required"/>
                <input id="telefono" type="tel" name="tel" placeholder="Teléfono" maxlength="9">
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

    <div id="error" hidden>
        <h4></h4>
    </div>
</div>
