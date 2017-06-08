$(document).ready(function () {
    //hover titulo y blur
    $("#productoContainer li img").hover(function () {
        var text = $(this).attr("src");
        $(this).attr("src", text.replace(".png", "_t.png"));
        $(this).next().show();
        $(this).next().next().show();

    }, function () {
        //mouseout
        var text = $(this).attr("src");
        $(this).attr("src", text.replace("_t.png", ".png"));
        $(this).next().hide();
        $(this).next().next().hide();
    });
});