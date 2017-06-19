$( document ).ready(function() {
    console.log( "Jquery is ready!" );

    $("#header a.cartIcon i").on("click", function(ev){
        ev.preventDefault();
        $(this).toggleClass("iconClicked");
        $("#header .cart").stop().slideToggle();
    });

    $(document).on("click",function(ev){
        var cart = $("#header .cart");
        var target = $(ev.target);
        if(cart.css("display")!=="hidden"){
            if(!target.hasClass("cart") && !target.hasClass("fa-shopping-cart") && target.parents("div.cart").length===0 ){
                cart.slideUp();
                $("#header a.cartIcon i").removeClass("iconClicked");
            }
        }
    });

});