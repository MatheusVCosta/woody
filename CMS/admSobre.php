<?php
    require_once("conexao.php");
    session_start();
    $botao = "Gravar";

    $conexao = conexaoBD();
    $checked1 = "";
    $checked = ""; 

    $titulo = "";
    $desc = "";
    $status = "";
    $txtNomeFoto = "";
    $ImagemBanco = "";

    if(isset($_GET["status"])){
        $id = $_GET['id'];
        $status = $_GET['status'];
        
        if($status == 1){
            $sql = "UPDATE tbl_pagina_sobre SET status = '0' WHERE id_sobre =".$id;
        }
        else if ($status == 0){
            $sql = "UPDATE tbl_pagina_sobre SET status = '1' WHERE id_sobre =".$id;
        }
        mysqli_query($conexao, $sql);
    }

    if(isset($_GET['btnSalvar'])){
        $btnSalvar = $_GET['btnSalvar'];
       
        $txtTitulo = $_GET['txtTitulo'];
        $txtDescricao = $_GET['txtDescricao'];
        $rdoAtiv = $_GET['rdoAtivar'];
        $nomeFoto = $_GET['txtNomeFoto'];


        if($btnSalvar == 'Gravar'){
            $sql = "INSERT INTO tbl_pagina_sobre (titulo_sobre, descricao_sobre, foto_sobre, status)VALUES('".$txtTitulo."','".$txtDescricao."','".$nomeFoto."','".$rdoAtiv."')";
        }
        else if($btnSalvar == 'Editar'){
            $sql = "UPDATE tbl_pagina_sobre SET titulo_sobre = '".$txtTitulo."', descricao_sobre = '".$txtDescricao."', foto_sobre = '".$nomeFoto."', status = '".$rdoAtiv."' where id_sobre =".$_SESSION['id_sobre'];
        }
        mysqli_query($conexao, $sql);
    }

    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        
        if($modo == "excluir"){
            $id = $_GET['id'];
            $status = $_GET['statusDelete'];
            $foto = $_GET['nomeFoto'];
            if($status == "1"){
                echo('<script>alert("Esse autor esta sendo usado na página Autores")</script>');
            }
            else{
                
                $sql = "DELETE FROM tbl_pagina_sobre WHERE id_sobre = ".$id." AND status = 0";
                // unlink($foto);
                mysqli_query($conexao,$sql);

            }  
        }
        else if($modo == "editar"){
            $botao = "Editar";
            $id = $_GET['id'];
            $_SESSION['id_sobre'] = $id;
            $sql = "SELECT * FROM tbl_pagina_sobre where id_sobre =".$id;
            $select = mysqli_query($conexao,$sql);
        

            if($rsConsultaSobre = mysqli_fetch_array($select)){
                $titulo = $rsConsultaSobre["titulo_sobre"];
                $desc = $rsConsultaSobre["descricao_sobre"];
                $status = $rsConsultaSobre["status"];
                $txtNomeFoto = $rsConsultaSobre["foto_sobre"];

                $ImagemBanco = "<img src='$txtNomeFoto'>";
            }
            if($status == 1){
                $checked = "checked";
                $checked1 = "";
            }
            else if($status == 0){
                $checked = "";
                $checked1 = "checked";
            }
            $disabled = "disabled";
        
        }
        
    }
    
?>
<!DOCTYPE html>
<html>
<head>

<script>
    $(document).ready(function(){
        $('#btnImagem').click(function(){
            $('#AbrirFile').trigger('click');
        });
       

        $("#foto").live('change', function(){
            
            $("#visualizar1").html("<img src='ajax-loader.gif'>");

            setTimeout(function(){
                $("#foto").ajaxForm({
                    target:'#visualizar1'
                }).submit();
            },800);
        });
    });
    </script>
</head>

<body>
    <div class="admSobre">
        <div class="seguraFormSobre" style="width:460px; height:455px;"> 
            <form method="GET" action="admSob~re.php" name="frmCadastro" id="frmCadastro">
                
                <div class="divCadastro" style="width:235px; height:235px;">
                    <div class="linhasForm">
                        <label class="labelFormGeral">Titulo da Pagina</label><br>
                        <input class="txtFormGeral" value="<?php echo($titulo)?>" name="txtTitulo" style="width:210px;"><br>
                        <input type="text" name="txtNomeFoto" value="<?php echo($txtNomeFoto)?>" style="display:none;"><br>
                    </div>
                    <div class="linhaForm" style="margin-top:25px; margin-left:10px;">
                        <input type="radio" value="0" name="rdoAtivar" class="rdoAtiv" <?php echo($checked1)?>> <label class="tituloCadastro">Desativado</label>
                        <input type="radio" value="1" name="rdoAtivar" class="rdoAtiv" <?php echo($checked)?>> <label class="tituloCadastro">Ativado</label>
                    </div>
                    <div class="linhaForm" >
                        <input name="btnSalvar" class="btnEscolherImagem" onclick="salvarSemPiscar('#frmCadastro', 'admSobre', '.admSobre');" type="submit" id="btnSalvar" value="<?php echo($botao)?>" style="margin-left:45px; margin-top:60px; width:130px;">
                    </div>
                </div>
                <div class="divCadastro" style="width:223px; height:235px;">
                    <div class="linhaForm">
                        <label class="labelFormGeral">Historia</label><br>
                        <textarea class="txtForm" name="txtDescricao" style="resize:none; height:180px;"><?php echo($desc)?></textarea>
                    </div>
                
                </div>
            </form>


            <form method="POST" action="upload.php" name="frmfoto" id="foto" style=" float:left;">
                <div id="seguraBtn">
                    <label class="txtButton" style="margin-left:65px;">Foto</label>  
                    <div class="btnEscolherImagem" id="btnImagem" style="padding-top: 9px;"> 
                        <label style="cursor:pointer;">Adicionar foto</label>  
                    </div> 
                    <input type="file" name="filefoto" id="AbrirFile" value="escolher arquivo" style="display:none;"> 
                </div>
                
                
            </form>
            <div class="visualizarFoto" id="visualizar1" style="width:275px;">
                <?php echo($ImagemBanco)?>
            </div>
        </div>




        <div class="seguraTabelaSobre" style="width:430px;">
            <div class="tabelaS0bre">
                <div class="linhaResult">
                    <div class="colResult" style="width:315px; border-right:1px solid #30a5a5; border-bottom:1px solid #30a5a5;">Titulo</div>
                    <div class="colResult" style="width:113px; border-bottom:1px solid #30a5a5;">Opções</div>
                </div>
                    <?php
                        $sql = "SELECT * FROM tbl_pagina_sobre";
                        $select = mysqli_query($conexao, $sql);
                        while($rsConsultaSobre = mysqli_fetch_array($select)){

                    ?>
                   

                <div class="linhaResult">
                    <div class="colResult" style="width:315px; border-right:1px solid #30a5a5; border-bottom:1px solid #30a5a5;"><?php echo($rsConsultaSobre["titulo_sobre"])?></div>
                    <div class="colResultOpcoes" style="width:113px; border-bottom:1px solid #30a5a5;">

                       <?php 
                        if($rsConsultaSobre['status'] == 1){
                            $img = "1";
                        }
                        else{
                            $img = "0";
                        }
                        ?>


                        <img onclick="verificarStatus(<?php echo($rsConsultaSobre['status'])?>, <?php echo($rsConsultaSobre['id_sobre'])?> ,'admSobre', '.admSobre')" src="icon/<?php echo($img)?>.png" alt="user" title="Ativar ou desativar">
                        <img src="icon/edit.png" alt="user" title="Editar" onclick="atualizar(<?php echo($rsConsultaSobre['id_sobre'])?>,'admSobre', '.admSobre')">
                        <a onclick="deletarConteudo(<?php echo($rsConsultaSobre['id_sobre'])?>, <?php echo($rsConsultaSobre['status'])?>, 'admSobre', '<?php echo($rsConsultaSobre['foto_sobre'])?>', '.admSobre')"><img src="icon/delete.png" alt="user" title="deletar"></a>   
                    </div>
                </div>

                <?php
                    }
                ?>
            </div>
        </div>  

    </div>
</body>
</html>