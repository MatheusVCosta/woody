<?php

   require_once("conexao.php");
   $conexao = conexaoBD();
   
   if(isset($_GET['modo'])){
       
        if($_GET['modo'] == "excluir"){
            $id = $_GET["id"];
            $sql = "DELETE FROM tbl_usuario WHERE id=".$id;

            mysqli_query($conexao, $sql);
            
        }
    }   

    if(isset($_GET['status'])){
       
        $id = $_GET['id'];
        $status = $_GET['status'];
        if($status == 1){
           
            $sql = "UPDATE tbl_usuario set status = '0' where id =".$id;
           
        }
        else if($status == 0){
            $sql = "UPDATE tbl_usuario set status = '1' where id =".$id;
           
        }
        mysqli_query($conexao, $sql);
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
    <div class="tblUsuarios">
        <div class="tituloFaleConosco">
            <h3>Lista de usuários</h3>
        </div>
        <div class="titulosUsers">
            <div class="colTitulos" style="width:168px;">Nome</div>
            <div class="colTitulos" style="width:188px;">Sobrenome</div>
            <div class="colTitulos" style="width:168px;">Login</div>
            <div class="colTitulos" style="width:108px;">Senha</div>
            <div class="colTitulos" style="width:108px;">Permissão</div>
            <div class="colTitulos" style="width:140px;">opções</div>
        </div>
        <?php
            $sql = "SELECT * FROM viewusuarios;";
            $select = mysqli_query($conexao, $sql);
            while($rsConsulta = mysqli_fetch_array($select)){

        ?>
        <div class="mostrarConsultaUsers">
            <div class="colResultado" style="width:168px; padding-left:10px; padding-top:8px;">
                <?php echo($rsConsulta['nome'])?>
            </div>
            <div class="colResultado" style="width:188px;  padding-left:10px; padding-top:8px;">
                <?php echo($rsConsulta['sobrenome'])?>
            </div>
            <div class="colResultado" style="width:168px;  padding-left:10px; padding-top:8px;"> 
                <?php echo($rsConsulta['login'])?>
            </div>
            <div class="colResultado" style="width:108px; padding-left:10px; padding-top:8px;" >
                <?php echo($rsConsulta['senha'])?>
            </div>
            <div class="colResultado"  style="width:108px;">
            <?php echo($rsConsulta['nome_permissao'])?>
            </div>
            <div class="colResultado"  style="width:152px;">
                <?php
                    if($rsConsulta['status'] == 1){
                        $img = "1";
                    }
                    else if($rsConsulta['status'] == 0){
                        $img = "0";
                    }

                ?>
                <img   onclick="verificarStatus(<?php echo($rsConsulta['status'])?>, <?php echo($rsConsulta['id'])?>, 'tabelaUsers', '.divConteudo')" id="img"  alt="check" src="icon/<?php echo($img)?>.png" class='imagemUser'></a>

                
                <a href="#"><img src="icon/editUser.png" alt="user" title="editar Usuario" class="imagemUser" onclick="editarUser(<?php echo($rsConsulta['id'])?>)"></a>

                <a href="#" onclick="Delete(<?php echo($rsConsulta['id'])?>)"> <img src="icon/deleteUser.png" alt="user" title="deletar usuario" class="imagemUser"></a>
            </div>
        </div>
        <?php
            }
        ?>
        
        </div> 
         
</body>
</html>
