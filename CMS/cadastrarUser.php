<?php

    require_once("conexao.php");
    session_start();
    $conexao = conexaoBD();
    $nome = "";
    $sobrenome = "";
    $login = "";
    $senha = "";
    $status = "";
    $botao = "salvar";
    $checked = "";
    $checked1 = "";
    $id_niveis = 0;

    if(isset($_GET["btnSalvar"])){
        $nome = $_GET["txtNome"];
        $sobrenome = $_GET['txtSobrenome'];
        $login = $_GET['txtLogin'];
        $senha = $_GET['txtSenha'];
        $status = $_GET['rdoAtivado'];
        $id_niveis = $_GET['cbNivel'];

        
        if($_GET["btnSalvar"] == 'salvar'){
            $sql = "INSERT INTO tbl_usuario(nome,sobrenome,login,senha,status,id_niveis) VALUES ('".$nome."','".$sobrenome."','".$login."','".$senha."','".$status."','".$id_niveis."');";
        }
        else if($_GET["btnSalvar"] == "editar"){
            $sql = "UPDATE tbl_usuario set nome ='".$nome."', sobrenome = '".$sobrenome."', login = '".$login."', senha = '".$senha."', status = '".$status."', id_niveis = '".$id_niveis."' where id = ".$_SESSION['id'];
        }
        echo($sql);
        mysqli_query($conexao,$sql);
        header("location:cms.php");

    }

    if(isset($_GET["modo"])){
        $modo = $_GET["modo"];
        if($modo == "editar"){
            $botao = "editar";
            $id = $_GET['id'];
            $_SESSION['id'] = $id;
            $sql = "SELECT usuario.*, niveis.id as idNivel, niveis.nome as nomeNivel FROM tbl_usuario as usuario, tbl_niveis as niveis WHERE usuario.id = ".$id." and usuario.id_niveis = niveis.id" ;
            $select = mysqli_query($conexao, $sql);

            if($rsConsulta = mysqli_fetch_array($select)){
                $nome = $rsConsulta['nome'];
                $sobrenome = $rsConsulta['sobrenome'];
                $login = $rsConsulta['login'];
                $senha = $rsConsulta['senha'];
                $status = $rsConsulta['status'];
                $id_niveis = $rsConsulta['id_niveis'];
                $nomeNivel = $rsConsulta['nomeNivel'];
        
            }
            if($status == 0){
                $checked = "checked";
                $checked1 = "";
            }
            else if($status == 1){
                $checked = "";
                $checked1 = "checked";
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
    <link rel="stylesheet" type="text/css" media="screen" href="css/styleModal.css"/>
    
</head>
<body>
    <form method="GET" action="cadastrarUser.php">

        <div class="tblUsuario">
            <div class="linhaUser">
                <div class="colUser">Nome: </div>
                <div class="txtUser"><input type="text" value="<?php echo($nome)?>" name="txtNome" ></div>
            </div>
            <div class="linhaUser">
                <div class="colUser">Sobrenome: </div>
                <div class="txtUser"><input type="text" value="<?php echo($sobrenome)?>" name="txtSobrenome" ></div>
            </div>
            <div class="linhaUser">
                <div class="colUser">Login: </div>
                <div class="txtUser"><input type="text" value="<?php echo($login)?>" name="txtLogin" ></div>
            </div>
            <div class="linhaUser">
                <div class="colUser">senha: </div>
                <div class="txtUser"><input type="text" value="<?php echo($senha)?>" name="txtSenha" ></div>
            </div>
            <div class="linhaUser">
                <div class="colUser">Permissão: </div>
                <div class="txtUser">
                    <select class="cbPermissao" name="cbNivel">
                        <?php 
                            if($botao == "salvar"){
                                
                                ?>
                                <option value="" >Selecione um item</option>
                            <?php
                            }else{
                                
                                ?>
                                <option value="<?php echo($id_niveis)?>"><?php echo($nomeNivel)?></option>
                                <?php
                            }

                            $sql = "select * from tbl_niveis WHERE id <> ".$id_niveis;
                            $select = mysqli_query($conexao, $sql);
                            
                            while($rsConsultaNV = mysqli_fetch_array($select)){
                            
                        ?>
                            <option value="<?php echo($rsConsultaNV['id'])?>"><?php echo($rsConsultaNV['nome'])?></option>
                        <?php
                            }
                        ?>
                    </select>

                </div>
            </div>
            <div class="linhaUser" style="padding-top:15px;;">
                <label class="rdoAtivado">Ativado</label><input type="radio" name="rdoAtivado" value="1" <?php echo($checked1)?> >
                <label class="rdoAtivado">Desativado</label><input type="radio" name="rdoAtivado" value="0" <?php echo($checked)?>>
            </div>
            <div class="linhaUser">
                <input type="submit" name="btnSalvar" class="buttonSave" value="<?php echo($botao)?>" style="margin-left:190px;">
            </div>

        </div>
    </form>       
</body>
</html>