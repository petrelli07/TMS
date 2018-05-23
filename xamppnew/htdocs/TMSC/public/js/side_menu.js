$(document).ready(function(){
    $(".fa-times").click(function(){
        $(".sidemenu").addClass("hide_menu");
        $(".toggle_menu").addClass("opacity_one");
    });

    $(".toggle_menu").click(function(){
        $(".sidemenu").removeClass("hide_menu");
        $(".toggle_menu").removeClass("opacity_one");
    });

});