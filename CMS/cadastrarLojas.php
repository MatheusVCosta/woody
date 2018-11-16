<?php 
        session_start();
        require_once("conexao.php");
        $conexao = conexaoBD();
        $botao = "Gravar";
        $id_endereco = 0;
        $foto = "";
        $txtNomeFoto = "";
        $caminhoImagem = "";
        $imagem = "";
        $checked = "";
        $checked1 = "";


        
    if(isset($_GET["status"])){
        $id = $_GET['id'];
        $status = $_GET['status'];
        
        if($status == 1){
            $sql = "UPDATE tbl_nossas_lojas SET status = '0' WHERE id_loja =".$id;
        }
        else if ($status == 0){
            $sql = "UPDATE tbl_nossas_lojas SET status = '1' WHERE id_loja =".$id;
        }
        mysqli_query($conexao, $sql);
    }

     if(isset($_GET['btnSalvarEndereco'])){
       
        $txtNomeFoto = $_GET['txtNomeFoto'];
        $id_endereco = $_GET['cbEndereco'];
        $rdAtiv = $_GET["rdoAtivar"];
        
        if($_GET['btnSalvarEndereco'] == 'Gravar'){
            $sql = "INSERT INTO tbl_nossas_lojas (id_endereco, foto, status) VALUES ('".$id_endereco."', '".$txtNomeFoto."', '".$rdAtiv."')";
        }
        else if($_GET['btnSalvarEndereco'] == 'Editar'){
            $sql = "UPDATE tbl_nossas_lojas SET id_endereco = '".$id_endereco."', foto = '".$txtNomeFoto ."', status = '".$rdAtiv."' where id =".$_SESSION['id_loja'];
        }
        mysqli_query($conexao, $sql);
        // echo($sql);
        header('location:cms.php');

    }
    if(isset($_GET['modo'])){
       
        $modo = $_GET['modo'];
       
        if($modo == "excluir"){
            
            $id = $_GET['id'];
            $status = $_GET['statusDelete'];
            $foto = $_GET['nomeFoto'];
          
            $sql = "DELETE FROM tbl_nossas_lojas WHERE id= ".$id;
            mysqli_query($conexao,$sql);
        }
        else if($modo == "editar"){
            $botao = "Editar";
            $id = $_GET['id'];
            $_SESSION['id_loja'] = $id;
            $sql = "SELECT lojas.*, endereco.* from tbl_nossas_lojas as lojas, tbl_endereco as endereco where lojas.id_endereco = endereco.id and lojas.id =".$id ;
            $select = mysqli_query($conexao,$sql);
            // echo($sql);
            if($rsConsultaEndereco = mysqli_fetch_array($select)){
                $txtNomeFoto = $rsConsultaEndereco['foto'];
                $id_endereco = $rsConsultaEndereco['id_endereco'];
                $cidade = $rsConsultaEndereco['cidade'];
                $rua = $rsConsultaEndereco['rua'];
                $imagem = $rsConsultaEndereco['foto'];
                $caminhoImagem = "<img src='$imagem'>";
                $status = $rsConsultaEndereco["status"];

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
        
    }    

?>
<!DOCTYPE html>
<html>
<head>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/functionJquery.js"></script>

    <script>
        $(document).ready(function(){
            $('#btnImagem').click(function(){
                $('#AbrirFile').trigger('click');
            });

            $("#foto").live('change', function(){
               
                $(".visualizarFoto").html("<img src='ajax-loader.gif'>");

                setTimeout(function(){
                    $("#foto").ajaxForm({
                        target:'.visualizarFoto'
                    }).submit();
                },100);
            });
            
        });
    </script>
   
</head>
<body>
    <div class="admNossasLojas">
        <div class="seguraFormLojas">
            <form method="GET" action="cadastrarLojas.php" name="frmCadastro" id="frmCadastro">
                <div class="seguraFormEndereco" style="height:172px;">
                    <label>Endereço</label><br>
                    <input type="text" name="txtNomeFoto"  value="<?php echo($imagem)?>" style="display:none;">
                    <select name="cbEndereco" class="cbEndereco">
                     
                         <?php 
                            if($botao == "Gravar"){
                                ?>
                                <option value="" >Selecione um item</option>
                            <?php
                            }else{
                                    
                                ?>
                                
                                <option value="<?php echo($id_endereco)?>"><?php echo($cidade)?> <?php echo($rua)?></option>
                                
                                <?php
                            }

                            $sql = "select * from tbl_endereco WHERE id <>".$id_endereco;
                            $select = mysqli_query($conexao, $sql);
                            // echo($sql);
                            while($rsConsulta = mysqli_fetch_array($select)){
                            
                        ?>
                            <a ><option value="<?php echo($rsConsulta['id'])?>"> <?php echo($rsConsulta['cidade'])?> <?php echo($rsConsulta['rua'])?> </option></a>
                        <?php
                            }
                        ?>

                    </select><br>
                    <input type="radio" value="0" name="rdoAtivar" class="rdoAtiv" <?php echo($checked1)?> style="margin-left:90px;"><label class="tituloCadastro">Desativado</label>
                    <input type="radio" value="1" name="rdoAtivar" class="rdoAtiv" <?php echo($checked)?> style="margin-left:10px;"><label class="tituloCadastro">Ativado</label>

                    <div id="labelEndereco" style="margin-top:5px;"> 
                        <label>Deseja cadastrar um novo endereço?</label> <label class="cadastrarEndereco">Clique aqui</label><br>
                    </div>
                    <input type="submit" value="<?php echo($botao)?>" name="btnSalvarEndereco" class="btnEscolherImagem" style="margin-top:10px; margin-left:115px;">
                </div>
            </form>

            <form method="POST" action="upload.php" name="frmFoto" id="foto"  enctype="multipart/form-data" style="width:170px;height:70px;float:left;">
                <div id="seguraBtn" style="margin-top:20px;">
                    <label class="txtButton">Foto</label>  
                    <div class="btnEscolherImagem" id="btnImagem" style="padding-top: 9px;"> 
                        <label style="cursor:pointer;">Adicionar foto</label>  
                    </div> 
                    <input type="file" name="filefoto" id="AbrirFile" value="escolher arquivo" style="display:none;"> 
                </div>

            </form>
            <div class="visualizarFoto" style="margin-top:20px; height:230px;">
                <?php echo($caminhoImagem)?>
            </div>
        </div>
        <div class="seguraTabelaLojas">
            <div class="tabelaMostrarConteudo">
                <div class="linhaResult"  style="width:400px;">
                    <div class="colResult" style="width:280px; border-right:1px solid #30a5a5; border-bottom:1px solid #30a5a5;"><label>Endereço</label></div>
                    <div class="colResult" style="width:120px; border-bottom:1px solid #30a5a5;"><label>Opções</label></div>
                </div>

                <?php
                    $sql = "SELECT lojas.id_loja, lojas.id_endereco,lojas.foto, lojas.status, endereco.* from tbl_nossas_lojas as lojas, tbl_endereco as endereco WHERE lojas.id_endereco = endereco.id";
                    $select = mysqli_query($conexao,$sql);
                    while($rsConsultaA = mysqli_fetch_array($select)){

                    
                ?>
                <div class="linhaResult"  style="width:400px;">
                    <div class="colResult"  style="width:280px; border-right:1px solid #30a5a5; border-bottom:1px solid #30a5a5;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;"><label><?php echo($rsConsultaA['cidade'])?> <?php echo($rsConsultaA['rua'])?> </label></div>
                    <div class="colResultOpcoes"  style="width:120px; border-bottom:1px solid #30a5a5;">


                      <?php 
                            if($rsConsultaA['status'] == 1){
                                $img = "1";
                            }
                            else{
                                $img = "0";
                            }
                        ?>

                        <img src="icon/<?php echo($img)?>.png" alt="user" title="Ativar ou desativar " onclick="verificarStatus(<?php echo($rsConsultaA['status'])?>, <?php echo($rsConsultaA['id_loja'])?> ,'cadastrarLojas', '.admNossasLojas')">
                        <img src="icon/edit.png" alt="user" title="Editar autor" onclick="atualizar(<?php echo($rsConsultaA['id_loja'])?>, 'cadastrarLojas', '.admNossasLojas')">
                        <img src="icon/delete.png" alt="user" title="deletar autor" onclick="deletarConteudo(<?php echo($rsConsultaA['id_loja'])?>, <?php echo($rsConsultaA['status'])?>, 'cadastrarLojas', '<?php echo($rsConsultaA['foto'])?>', '.admNossasLojas' )">
                    
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