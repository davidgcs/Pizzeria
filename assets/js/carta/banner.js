$(document).ready(function () {
    //pizzas
    $("#cerrarPubli i").click(function () {
        $("#bannerProducto").hide();
    });

    cont = 0;
    $("#btnpizdiab").on("mouseenter", function () {
        if (cont <= 4) {
            $("#btnpizdiab").addClass("anim" + cont);

            cont = cont + 1;
        }
    });

    $("#btnpizdiab").on("click", function () {
        document.getElementById("captcha").style.visibility = "visible";
        document.getElementById("inputCaptcha").focus();
    });

    $("#inputCaptcha").keypress(function (e) {
        if (e.which == 13) {
            if ($("#inputCaptcha").val().toLowerCase() == "alt f4" || $("#inputCaptcha").val().toLowerCase() == "alt + f4" || $("#inputCaptcha").val().toLowerCase() == "alt+f4" || $("#inputCaptcha").val().toLowerCase() == "altf4") {
                alert("Está bien, tú ganas...");
                $("#captcha").hide();
            }
            else {
                $("#inputCaptcha").val("");
            }
        }
    });

    mostrado = false;
    $("#btnpizdiab").hover(function () {
        if (!mostrado) {
            $("#bannerProducto").show();
            mostrado = true;
        }
    });
});