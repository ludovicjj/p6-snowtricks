function redimensionnement(){
    let $image = $(".cover_home");

    let navbar = $(".navbar");
    let navbarHeight = navbar.outerHeight();

    var bodyWidth = $(window).width();
    var bodyHeight = $(window).height();

    $image.css({
        "width": bodyWidth + "px",
        "height": bodyHeight  + "px",
        "top": "-" + navbarHeight + "px",
        "left": "0px"
    });
}
$(document).ready(function(){
    // Au chargement initial
    redimensionnement();

    // En cas de redimensionnement de la fenêtre
    $(window).resize(function(){
        redimensionnement();
    });
});