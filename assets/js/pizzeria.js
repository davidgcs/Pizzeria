/**
 * Created by David on 07/05/2017.
 */
$( document ).ready(function() {
    console.log( "Jquery is ready!" );

    $("#header a.cartIcon i").on("click", function(){
        $(this).toggleClass("iconClicked");
        $("#header .cart").animate({
            height: $("#header .cart").height()==0 ? "400px":"0"
        }, 500);
    });
});