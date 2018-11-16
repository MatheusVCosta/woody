$(document).ready(function(){

    $('#abrirTabelaUsers').click(function(){
        $.ajax({
            type: "GET",
            url: "tabelaUsers.php",
            success: function(dados){
                $('#viewUsers').html(dados);
            }
        });
    });

    $('.visualizar').click(function(){
        $('.container').fadeIn(100);
     });

    $('#fecharContainer').click(function(){
        $('.container').fadeOut(100);
    });
    $('#abrirTabela').click(function(){
        $.ajax({
            type: "GET",
            url: "faleConosco.php",
            success: function(dados){
                $('#seguraTabela').html(dados);
            }
        });
    }); 

    $('.visualizar').click(function(){
        $('#modal').css({"width": "550px", "height": "600px", "margin-top":"80px"});
        
        //data-atributo para passar o nome da pagina
        var page = $(this).data("page");
         $.ajax({
             type:"POST",
             url:"cadastrar"+page+".php",
             success:function(dados){
                 $("#PaginasDescarregadas").html(dados);
             }
         });
         

     });
     $(".cadastrarEndereco").click(function(){
        $('.container').fadeIn(100);
        $.ajax({
            type:"GET",
            url:"cadastrarEndereco.php",
            success:function(dados){
                $("#PaginasDescarregadas").html(dados);
            }
        });
     });


   
       
     
    
});

//Descarregar o arquivo com as informacões do fale conosco em uma modal
function visualizar(id){
    $.ajax({
        type:"POST",
        url:"modalFaleConosco.php",
        data:{idConsulta:id},
        success:function(dados){
            $("#PaginasDescarregadas").html(dados);
        }
    });   
}
//Função para descarregar dados sobe um usuario no form de cadatro
function editarUser(id){
    $('.container').fadeIn(100);
    $.ajax({
        type:"GET",
        url:"cadastrarUser.php?modo=editar&id="+id,
        success:function(dados){
            $("#PaginasDescarregadas").html(dados);
        }
    });
}



//Função para trocar a imagem do status
function verificarStatus(status, id, acao, div){
    //trazendo o status o id acao'que é o nome da pagina' e a div onde sera descarregado o conteudo
   $.ajax({ 
        type: "GET",
        url:  acao+".php?id="+ id + "&status= " + status, 
        success: function(dados){
            $(div).html(dados);
        }  
    });  
}
//Funções para as paginas de adm
function descarregarPaginasADM(url){
    $.ajax({
        type:"POST",
        url: url+".php",
        success: function(dados){
            $(".admPaginas").html(dados);
        }
        
    });
}

function atualizar(id, url, div){
    $.ajax({
        type: "GET",
        url: url+".php?modo=editar&id="+id,        
        success: function(dados){
            $(div).html(dados);
        }
        
    });
}
// Deletar conteudo do autores
function deletarConteudo(id, status, pagina, nomeFoto, div){
    $.ajax({
        type: "GET",
        url: pagina+'.php?modo=excluir&id='+id+'&statusDelete='+status+'&nomeFoto='+nomeFoto,
        success: function(dados){
            $(div).html(dados);
        }
    });
}

// deletar endereço
function deletarEndereco(id){
    $.ajax({
        type: "GET",
        url: 'cadastrarEndereco.php?modo=excluir&id='+id,
        success: function(dados){
            $('#PaginasDescarregadas').html(dados);
        }
    });
}
function salvarSemPiscar(form, caminho, div){
    $(form).ajaxForm({
        type: 'GET',
        url: caminho+'.php',
        cache: false,
        processData: false,
        contentType: false,  
        target: div,
        
        success: function(dados){
            $(div).html(dados);

            
            $("input").val( '' );
            // $("input[name='txtGenero']").val( '' );
            // $("input[name='txtPais']").val( '' );
            // $("input[name='txtDescricao']").val( '' );
        }
    });
}





