<?php
    require_once("conexao.php");
    $conexao = conexaoBD();
    $botao = "Gravar";

    $cidade = "";
    $uf = "";
    $rua = "";
    $bairro = "";
    $numero =  "";

    if(isset($_GET['btnSalvarEndereco'])){
        $cidade = $_GET['txtCidade'];
        $uf = $_GET['txtUf'];
        $rua = $_GET['txtRua'];
        $bairro = $_GET['txtBairro'];
        $numero = $_GET['txtNumero'];
        
        if($_GET['btnSalvarEndereco'] == "Gravar"){
            $sql = "INSERT INTO tbl_endereco (cidade, uf, rua, bairro, numero) VALUES ('".$cidade."', '".$uf."', '".$rua."', '".$bairro."', '".$numero."' )";
        }
        if($_GET['btnSalvarEndereco'] == "Editar"){
            $sql = "UPDATE tbl_endereco SET = cidade = '".$cidade."', uf = '".$uf."', rua = '".$rua."', bairro = '".$bairro."', numero = '".$numero."'";
        }
        mysqli_query($conexao, $sql);
        header('location:cms.php');

        

    }
    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        if($modo == "excluir"){
            $id = $_GET['id'];
            $sql = "DELETE FROM tbl_endereco WHERE id = ".$id;
            mysqli_query($conexao,$sql);
        }
        else if($modo == "editar"){
            ;$botao = "Editar";
            $id = $_GET['id'];
            $_SESSION['id_endereco'] = $id;
            $sql = "SELECT * FROM tbl_endereco where id = ".$id;
            $select = mysqli_query($conexao, $sql);

            if($rsConsultaEndereco = mysqli_fetch_array($select)){
                $cidade = $rsConsultaEndereco['cidade'];
                $uf = $rsConsultaEndereco['uf'];
                $rua = $rsConsultaEndereco['rua'];
                $bairro = $rsConsultaEndereco['bairro'];
                $numero = $rsConsultaEndereco['numero'];
            }

        }
    }
?>
<!DOCTYPE html>
<html>
<head>
   
</head>
<body>
    <div id="cadastroEndereco">
        <form method="GET" action="cadastrarEndereco.php" >
            <div class="colFormEndereco">
                <label>Cidade</label><br>
                <input type="text" name="txtCidade" value="<?php echo($cidade)?>" class="txtEndereco"><br>
                <label>UF</label><br>
                <input type="text" name="txtUf" value="<?php echo($uf)?>" class="txtEndereco"><br>
                <label>Rua</label><br>
                <input type="text" name="txtRua" value="<?php echo($rua)?>" class="txtEndereco" >
            </div>
            <div class="colFormEndereco">
                <label>Bairro</label><br>
                <input type="text" name="txtBairro" value="<?php echo($bairro)?>"class="txtEndereco" ><br>
                <label>Número</label><br>
                <input type="text" name="txtNumero" value="<?php echo($numero)?>" class="txtEndereco"><br>
            </div>
            <input type="submit" value="<?php echo($botao)?>" name="btnSalvarEndereco" class="buttonSave"> 
        </form>
    </div>
    <div id="tableEndereco"> 
       <div id="lineEndereco">
            <div class="colEndereco" style="width:195px;  border-right:1px solid #3c97d3;  border-bottom:1px solid #3c97d3;">
                <p>Rua</p>
            </div>
            <div class="colEndereco" style="width:125px; border-right:1px solid #3c97d3; border-bottom:1px solid #3c97d3;">
                <p>Cidade</p>
            </div>
            <div class="colEndereco" style="width:70px; border-right:1px solid #3c97d3; border-bottom:1px solid#3c97d3;">
                <p>UF</p>
            </div>
            <div class="colEndereco" style="width:100px; border-bottom:1px solid #3c97d3;">
                <p>Opções</p>
            </div>
       </div>

       <?php

            $sql = "SELECT * FROM tbl_endereco";
            $select = mysqli_query($conexao, $sql);
            while($rsConsultaEndereco = mysqli_fetch_array($select)){

            

       ?>
       <div id="lineEnderecoResult">

            <div class="colEnderecoResult"  style="width:195px;  border-right:1px solid #3c97d3;  border-bottom:1px solid #3c97d3;">
                <p><?php echo($rsConsultaEndereco['rua'])?></p>
            </div>
            <div class="colEnderecoResult"  style="width:125px; border-right:1px solid #3c97d3;  border-bottom:1px solid #3c97d3;"> 
                <p><?php echo($rsConsultaEndereco['cidade'])?></p>
            </div>
            <div class="colEnderecoResult" style="width:70px; border-right:1px solid #3c97d3;  border-bottom:1px solid #3c97d3;">
                <p><?php echo($rsConsultaEndereco['uf'])?></p>
            </div>
            <div class="colEnderecoResult" style="width:100px; border-bottom:1px solid #3c97d3;">
                <img src="icon/edit.png" alt="user" title="Editar autor" onclick="atualizar(<?php echo($rsConsultaEndereco['id'])?>, 'cadastrarEndereco', '#PaginasDescarregadas')">
                <img src="icon/delete.png" alt="deletar" title="deletar endereço" onclick="deletarEndereco(<?php echo($rsConsultaEndereco['id'])?>)">   
            </div>
        </div>
        <?php
            }
        ?>
    <div>

</body>
</html>