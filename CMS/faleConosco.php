<?php

   require_once("conexao.php");
   $conexao = conexaoBD();
   
   
    if(isset($_GET['modo'])){
        
        if($_GET['modo'] == "excluir"){
            $id = $_GET["id"];
            $sql = "DELETE FROM tbl_fale_conosco WHERE id =".$id;
            mysqli_query($conexao, $sql);
        }
       
        
    }


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Page Title</title>
    
    <script src="js/jquery-1.9.1.min.js"></script>
    <script src="js/functionJquery.js"></script>
    
</head>
<body>
    <div class="tblFaleConosco">
        <div class="tituloFaleConosco">
            <h3 >Fale Conosco</h3>
        </div>
        <div class="titulos">
            <div class="colTitulos" style="width:272px;">Nome</div>
            <div class="colTitulos" style="width:323px;">E-mail</div>
            <div class="colTitulos" style="width:198px;">Celular</div>
            <div class="colTitulos" style="width:98px;">Visualizar</div>
            <div class="colTitulos" style="width:98px;">Excluir</div>
        </div>
        <?php
            $sql = "SELECT * FROM tbl_fale_conosco";
            $select = mysqli_query($conexao, $sql);
            while($rsConsulta = mysqli_fetch_array($select)){

        ?>
        <div class="mostrarConsulta">
            <div class="colResultado" style="width:272px; padding-left:10px; padding-top:8px;">
                <?php echo($rsConsulta['nome'])?>
            </div>
            <div class="colResultado" style="width:323px;  padding-left:10px; padding-top:8px;">
                <?php echo($rsConsulta['email'])?>
            </div>
            <div class="colResultado" style="width:198px;  padding-left:10px; padding-top:8px;"> 
                <?php echo($rsConsulta['celular'])?>
            </div>
            <div class="colResultado" style="width:98px; ">
                <a href="#" class="visualizar" onclick="visualizar(<?php echo($rsConsulta['id']);?>)" ><img class="imgPadding" src="icon/lupa.png" alt="visualizar" title="Visualizar um item"></a>
            </div>
            <div class="colResultado"  style="width:98px;">
                <a href="#" onclick="atualizarTabela(<?php echo($rsConsulta['id']);?>)"> <img class="imgPadding" src="icon/delete.png" alt="delete" title="apagar um item" ></a>
            </div>
        </div>
        <?php
            }
        ?>
        
        </div>  
</body>
</html>
