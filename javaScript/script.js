
$(function(){
    $('#slider').excoloSlider({
        mouseNav: false,
        autoPlay: true,
        interval: 3000, 
        repeat: true
    });
});
$(function(){
        
    var element = $('.seguraRede');
    $(window).scroll(function(){
        if($(this).scrollTop()>30){
           element.css({
               'position':'fixed',
               'top':'100px'
           });
           $('.seguraRede').fadeIn();
        }
        else{
            element.css({
               'position':'relative',
               'top':'auto'
           });
        }
    });
});
$(document).ready(function() {
    $("#content-slider").lightSlider({
        loop:true,
        keyPress:true,
        speed:600,
        auto:true,        
    });
});
// $(document).ready(function(){
//     $('.imgCurti').click(function(){
//         $('.imgCurti').slideUp();
//         $(".imgCurti").css('backgroundImage","url(../imagem/redeSocial/facebook.png)');
//     });

// });


   
