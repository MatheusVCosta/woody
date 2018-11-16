
function AbrirConteudo(opcao) {
    // Mostrar todos elementos da class tabContent */
    var seguraConfig;
    seguraConfig = document.getElementsByClassName("seguraConfig");
    for (i = 0; i < seguraConfig.length; i++) {
        seguraConfig[i].style.display = "none";
    }

    document.getElementById(opcao).style.display ="block";

}
document.getElementById("defaultOpen").click();

//atualizar a tabela sem piscar a pagina
function atualizarTabela(id){
    $.ajax({
        type: "GET",
        url: "faleConosco.php?modo=excluir&id="+id,        
        success: function(dados){
            $('#seguraTabela').html(dados);
        }
        
    });
}
//delete da tabela de usuarios
function Delete(id){
    $.ajax({
        type: "GET",
        url: "tabelaUsers.php?modo=excluir&id="+id, 
        success: function(dados){
            $('#viewUsers').html(dados);
        }
        
    });
}
//Editar tabela de niveis
function editar(id){
    $.ajax({
        type: "GET",
        url: "cadastrarNivel.php?modo=editar&id="+id,   
             
        success: function(dados){
           $("#PaginasDescarregadas").html(dados);
        }
        
    });
}





