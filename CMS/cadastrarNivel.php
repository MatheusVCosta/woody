<?php

    require_once("conexao.php");
    session_start();
    $conexao = conexaoBD();
    $nome = "";
    $status = "";
    $botao = "salvar";
   
    if(isset($_GET["btnSalvar"])){
        $nome = $_GET["txtNome"];
        $status = $_GET["rdoStatus"];
       if($_GET["btnSalvar"] == "salvar"){
            $sql = "INSERT INTO tbl_niveis(nome, status) VALUES ('".$nome."', '".$status."');";
       }
       else if($_GET["btnSalvar"] == "editar"){
            $sql = "UPDATE tbl_niveis SET nome = '".$nome."' where id=".$_SESSION['id'];
       }
       echo($sql);
       mysqli_query($conexao, $sql);
       header("location:cms.php");
        
       
    }
    if(isset($_GET['status'])){
       
        $id = $_GET['id'];
        $status = $_GET['status'];
        if($status == 1){
            $sql = "UPDATE tbl_niveis set status = '0' where id =".$id;
        }
        else if($status == 0){
            $sql = "UPDATE tbl_niveis set status = '1' where id =".$id;
        }
        mysqli_query($conexao, $sql);
    }
    if(isset($_GET["modo"])){
        $modo = $_GET["modo"];
        if($modo == "excluir"){
            $id = $_GET["id"];
            $sql = "DELETE FROM tbl_niveis WHERE id=".$id;
            mysqli_query($conexao, $sql);
            header("location:cms.php");
        }
        if($modo = "editar"){
            $botao = "editar";
            $id = $_GET["id"];
            $_SESSION['id'] = $id;
            $sql = "SELECT * FROM tbl_niveis where id=".$id;

            
            $select = mysqli_query($conexao, $sql);

            if($rsConsulta = mysqli_fetch_array($select)){
                $nome = $rsConsulta['nome'];
            }
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
   
    <div class="seguraCont">
    
        <form mthod="GET" action="cadastrarNivel.php">
            <div class="tblUsuario" style="height:150px;">
                <div class="linhaUser">
                    <div class="colUser">Nome nivel: </div>
                    <div class="txtUser"><input name="txtNome" type="text" value="<?php echo($nome)?>"></div>
                </div>
                <div class="linhaUser">
                    <input type="radio" value="1" name="rdoStatus" >Ativado
                    <input type="radio" value="0" name="rdoStatus" >Desativado<br>
                    <input type="submit" name="btnSalvar"  class="buttonSave" value="<?php echo($botao)?>"  style="margin-left:220px; margin-top:-5px;" >
                </div>

            </div>
        </form>
        <div class="tblNiveis">
            <div class="linhaNivel">
                <h5 class="linhaNiveis" style="width:324px;">Nome nível</h5>
                <h5 class="linhaNiveis" style=" border-left:2px solid #3c97d3;">Opções</h5>
            </div>
                <?php 
                
                    $sql = "select * from tbl_niveis";
                    $select = mysqli_query($conexao, $sql);
                    while($rsConsultaNV = mysqli_fetch_array($select)){
                        
                ?>
                <div class="linhaNivel" >
                    <h5 class="linhaNiveis" style="width:324px;"><?php echo($rsConsultaNV['nome'])?></h5>
                    <div class="linhaNiveis "  style=" border-left:2px solid #3c97d3;">
                        <?php
                            if($rsConsultaNV['status'] == 1){
                                $img = "1";
                            }else if($rsConsultaNV['status'] == 0){
                                $img = "0";
                            }                    
                        
                        ?>
                        <img src="icon/<?php echo($img)?>.png" id="img" alt="check" class="imgNiveis" onclick="verificarStatus(<?php echo($rsConsultaNV['status'])?>, <?php echo($rsConsultaNV['id'])?>, 'cadastrarNivel', '#PaginasDescarregadas')">

                        <a href="cadastrarNivel.php?modo=excluir&id=<?php echo($rsConsultaNV['id'])?>"><img class="imgNiveis" src="icon/delet.png"></a>
                        <a><img class="imgNiveis" src="icon/edit.png" onclick="editar(<?php echo($rsConsultaNV['id'])?>)"></a>
                        
                    </div>
                </div>
                <?php
                    }
                ?>
        </div>
    </div>       
</body>
</html>