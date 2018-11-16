
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

function validar(caracter, tipo, id){
    //Bloquei de numeros
    document.getElementById(id).style='border:1px solid gray;';
    if(window.event){
        //guarda o ascii da letra digitada pelo usuario
        var letra = caracter.charCode;    
    }
    else{
        var letra = caracter.which;
    }
    if(tipo == 'numero'){
        // alert(letra);
        if(letra != 8){
            if(letra < 32 || letra > 32 && letra >= 32 && letra <=57 ){
                document.getElementById(id).style='border:1px solid red;';
                //cancela a ação da tecla
                return false;
            }
        }
    }

    //bloqueio de letras
    else if(tipo == 'letra'){
        // alert(letra);
        if(letra != 8){
            if(letra < 32 || letra > 32 && letra < 45 || letra > 45 && letra < 47 || letra > 57){
                document.getElementById(id).style='border:1px solid red;';
                //cancela a ação da tecla
                return false;
            }
        }
        
        
       
    }

}