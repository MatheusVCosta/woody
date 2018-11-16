<?php 
        session_start();
        require_once("conexao.php");
        $conexao = conexaoBD();
        $botao = "Gravar";
        $id_livro = 0;
        $txtPrecoNovo = "";
        $rdAtiv = "";
        $txtPrecoNovo = "";
        $preco = "";
        $checked = "";
        $checked1 = "";

     if(isset($_GET['btnSalvar'])){
       
        $txtPrecoNovo = $_GET['txtPromocao'];
        $id_livro = $_GET['cbLivro'];
        $rdAtiv = $_GET["rdoAtiv"];
    
        if($_GET['btnSalvar'] == 'Gravar'){
            $sql = "INSERT INTO tbl_promocao(id_livro_promocao, preco_novo, status) VALUES ('".$id_livro."', '".$txtPrecoNovo."', '".$rdAtiv."')";
        }
        else if($_GET['btnSalvar'] == 'Editar'){
            $sql = "UPDATE tbl_promocao SET id_livro_promocao = '".$id_livro."', preco_novo = '".$txtPrecoNovo."', status = '".$rdAtiv."' where id_promocao =".$_SESSION['id_promocao'];
        }
        // echo($sql);
        mysqli_query($conexao, $sql);
        header('location:cms.php');

    }
    if(isset($_GET['modo'])){
       
        $modo = $_GET['modo'];
       
        if($modo == "excluir"){
            $id = $_GET['id'];
            $status = $_GET['statusDelete'];
            $foto = $_GET['nomeFoto'];
          
            $sql = "DELETE FROM tbl_promocao WHERE id_livro_promocao = ".$id;
            mysqli_query($conexao,$sql);
        }
        else if($modo == "editar"){
            $botao = "Editar";
            $id = $_GET['id'];
            $_SESSION['id_promocao'] = $id;
            $sql = "SELECT tbl_promocao.*, tbl_livro.id_livro, tbl_livro.titulo,tbl_livro.preco from tbl_promocao, tbl_livro WHERE tbl_promocao.id_livro_promocao = tbl_livro.id_livro AND tbl_promocao.id_livro_promocao = ".$id;
            $select = mysqli_query($conexao,$sql);
           
            if($rsConsultaLivro = mysqli_fetch_array($select)){
                $txtTitulo = $rsConsultaLivro['titulo'];
                $id_livro = $rsConsultaLivro['id_livro_promocao'];
                $id_promocao = $rsConsultaLivro['id_livro_promocao'];
                $preco = $rsConsultaLivro['preco_novo'];
                $status = $rsConsultaLivro['status'];
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
    if(isset($_GET['status'])){
        
        $id = $_GET['id'];
        $status = $_GET['status'];
        if($status == 1){
            $sql = "UPDATE tbl_promocao set status = '0' where id_promocao =".$id;
           
        }
        else if($status == 0){
            $sql = "UPDATE tbl_promocao set status = '1' where id_promocao =".$id;
           
        }
        mysqli_query($conexao, $sql);
    }    

?>
<!DOCTYPE html>
<html>
<head>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/functionJquery.js"></script>

    <!-- <script>
        // function valor(form, selected){
        //    var i = document.form.selected.selectedIndex;
        //    alert(document.form.selected.[i]);
        // }
        function valor(){
           
          var valor = document.getElementById("cbLivro").value;
          document.getElementById("preco").value = valor;
        }
        
    </script> -->
</head>
<body>
    <div class="admPromocoes">
        <div class="seguraFormLojas">
            <form method="GET" action="admPromocoes.php" name="frmCadastros" id="frmCadastro">
                <div class="seguraFormGeral">
                    <label class="labelFormGeral">Nome Livro</label><br>

                    <select name="cbLivro" id="cbLivro" class="comboBoxSLT"><br>
                        <?php 
                            if($botao == "Gravar"){
                                ?>
                                <option value="" >Selecione um Livro</option>
                            <?php
                            }else{
                                    
                                ?>
                                
                                <option value="<?php echo($id_livro)?>"><?php echo($txtTitulo)?></option>
                                
                                <?php
                            }

                            $sql = "select * from tbl_livro WHERE id_livro <>".$id_livro;
                            $select = mysqli_query($conexao, $sql);
                            
                            while($rsConsulta = mysqli_fetch_array($select)){
                            
                        ?>
                            <option value="<?php echo($rsConsulta['id_livro'])?>"> <?php echo($rsConsulta['titulo'])?></option>
                        <?php
                            }
                        ?>

                    </select><br>
                    <label class="labelFormGeral">Preço Promoção</label><br>
                    <input type="text" name="txtPromocao" value="<?php echo($preco)?>"class="txtFormGeral">
                    <input type="text" name="Preco" id="preco"class="txtFormGeral" style="display:none;">
                       
                    <input type="radio" value="1" name="rdoAtiv" style="margin-left:30px" <?php echo($checked1)?>><span class="rdoFormGeral">Ativado</span>
                    <input type="radio" value="0" name="rdoAtiv" <?php echo($checked)?>><span class="rdoFormGeral">Desativado</span><br>
                    <input type="submit" value="<?php echo($botao)?>" name="btnSalvar" class="btnEscolherImagem" style="margin-left:110px; margin-top:15px;">
                    
                </div>
            </form>
            

            <!-- <div class="visualizarFoto" style="margin-top:20px; height:230px;">
                
            </div> -->
        </div>
        <div class="seguraTabelaLojas">
            <div class="tabelaMostrarConteudo">
                <div class="linhaResult" style="width:400px;">
                    <div class="colResult" style="width:180px; border-right:1px solid #30a5a5; border-bottom:1px solid #30a5a5;"><label>Nome Livro</label></div>
                    <div class="colResult" style="width:100px; border-right:1px solid #30a5a5; border-bottom:1px solid #30a5a5;"><label>Promoção</label></div>
                    <div class="colResult" style="width:120px; border-bottom:1px solid #30a5a5;"><label>Opções</label></div>
                </div>

                <?php
                    $sql = "select livro.titulo,livro.id_livro, promocao.* from tbl_livro as livro, tbl_promocao as promocao where promocao.id_livro_promocao= livro.id_livro ORDER BY id_livro_promocao";
                    $select = mysqli_query($conexao,$sql);
                    while($rsConsultaA = mysqli_fetch_array($select)){

                    
                ?>
                <div class="linhaResult" style="width:400px;">
                    <div class="colResult"  style="width:180px; border-right:1px solid #30a5a5; border-bottom:1px solid #30a5a5;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;"><label><?php echo($rsConsultaA['titulo'])?></label></div>
                    <div class="colResult" style="width:100px; border-right:1px solid #30a5a5; border-bottom:1px solid #30a5a5;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;"><label><?php echo($rsConsultaA['preco_novo'])." R$"?></label></div>
                    <div class="colResultOpcoes"  style="width:120px; border-bottom:1px solid #30a5a5;">

                         <?php
                            if($rsConsultaA['status'] == 1){
                                $img = "1";
                            }
                            else if($rsConsultaA['status'] == 0){
                                $img = "0";
                            }

                        ?>

                        <img src="icon/<?php echo($img)?>.png" alt="user" title="Ativar ou desativar" onclick="verificarStatus(<?php echo($rsConsultaA['status'])?>, <?php echo($rsConsultaA['id_promocao'])?>, 'admPromocoes', '.admPromocoes');">
                        <img src="icon/edit.png" alt="user" title="Editar autor" onclick="atualizar(<?php echo($rsConsultaA['id_livro_promocao'])?>, 'admPromocoes', '.admPromocoes')">
                        <img src="icon/delete.png" alt="user" title="deletar autor" onclick="deletarConteudo(<?php echo($rsConsultaA['id_livro_promocao'])?>, <?php echo($rsConsultaA['status'])?> ,'admPromocoes', 'null' ,'.admPromocoes')">
                    
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