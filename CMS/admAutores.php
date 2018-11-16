<?php
    require_once("conexao.php");
    session_start();
    $conexao = conexaoBD();

    $botao = "Gravar";
    $nomeAutor = "";
    $pais = "";
    $genero = "";
    $desc = "";
    $status = "";
    $checked = "";
    $checked1 = "";
    $caminhoImagem = "";
    $nomeFoto = "";
    $disabled = ""; 
    $msg = "";
   
    if(isset($_GET["status"])){
        $id = $_GET['id'];
        $status = $_GET['status'];
        
        if($status == 1){
            $sql = "UPDATE tbl_autor SET status = '0' WHERE id_autor =".$id;
        }
        else if ($status == 0){
            $sql = "UPDATE tbl_autor SET status = '1' WHERE id_autor =".$id;
        }
        mysqli_query($conexao, $sql);
    }
   
    if(isset($_GET['btnSalvar'])){
        $btnSalvar = $_GET['btnSalvar'];
        $nomeAutor = $_GET['txtNomeAutor'];
        $pais = $_GET['txtPais'];
        $genero = $_GET['txtGenero'];
        $desc = $_GET['txtDescricao'];
        $radio = $_GET['rdoAtivar'];
        $foto = $_GET['txtNomeFoto'];

        if($btnSalvar == 'Gravar'){
            $sql = "INSERT INTO tbl_autor (nome_autor, pais_origem, descricao_autor, foto, status, genero)VALUES('".$nomeAutor."','".$pais."','".$desc."','".$foto."','".$radio."', '". $genero."')";
        }
        else if($btnSalvar == 'Editar'){
            $sql = "UPDATE tbl_autor SET nome_autor = '".$nomeAutor."', pais_origem = '".$pais."', descricao_autor = '".$desc."', foto = '".$foto."',genero = '".$genero."' where id_autor =".$_SESSION['id_autor'];
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
                
                $sql = "DELETE FROM tbl_autor WHERE id_autor = ".$id." AND status = 0";
                // unlink($foto);
                mysqli_query($conexao,$sql);

            }  
        }
        else if($modo == "editar"){
            $botao = "Editar";
            $id = $_GET['id'];
            $_SESSION['id_autor'] = $id;
            $sql = "SELECT * FROM tbl_autor where id_autor =".$id;
            $select = mysqli_query($conexao,$sql);
        

            if($rsConsultaAutores = mysqli_fetch_array($select)){
                $nomeAutor = $rsConsultaAutores['nome_autor'];
                $pais = $rsConsultaAutores['pais_origem'];
                $genero = $rsConsultaAutores['genero'];
                $desc = $rsConsultaAutores['descricao_autor'];
                $status  =$rsConsultaAutores['status'];
                $nomeFoto = $rsConsultaAutores['foto'];
                $imagem = $rsConsultaAutores['foto'];
                $caminhoImagem = "<img src='$imagem'>";
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
    <meta charset="utf-8" />
    <title>Page Title</title>
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
    <!-- <script>
        function quebraLinha(linha){
            var letra = linha.length;

            var inserirQuebra = document.getElementById("txtArea").value;
            
            if(letra > 85){
              
                linhas = inserirQuebra.replace(/\s/g,'<\br>');
                alert(linhas);
            }
            
           
        }
    </script> -->
</head>
<body>
<div id="conteudoAdm">
    <h3 class="tituloForm">Autores</h3>
        <div class="seguraForm">
            <form name="frmCadastro" id="frmCadastro" method="GET" action="admAutores.php">
                <div id="formCadastro">
                    <div class="divCadastro" style=" border-right:1px solid #30a5a5;">
                        <div class="linhasForm">
                            <label class="tituloCadastro">Nome Autor: </label><br><input type="text" name="txtNomeAutor" class="txtForm" value="<?php echo($nomeAutor)?>" required> 
                            <input  type="text" name="txtNomeFoto" style="display:none;" value="<?php echo($nomeFoto)?>">
                        </div> 
                        <div class="linhasForm">
                            <label class="tituloCadastro">Gêneros: </label><br><input type="text" name="txtGenero" class="txtForm" value="<?php echo($genero)?>" required> 
                        </div>
                        <div class="linhasForm">
                            <label style="margin-left:5px;" class="tituloCadastro">Status do Autor</label><br>
                            <input type="radio" value="0" name="rdoAtivar" class="rdoAtiv" <?php echo($disabled)?> <?php echo($checked1)?> required><label class="tituloCadastro" required>Desativado</label>
                            <input type="radio" value="1" name="rdoAtivar" class="rdoAtiv"  <?php echo($disabled)?>><label class="tituloCadastro" required>Ativado</label>
                        </div>
                        <div class="linhasForm" style="height:55px;">
                            <input type="submit" value="<?php echo($botao)?>" name="btnSalvar" id="btnSalvar"class="btnEscolherImagem" style="margin-top:2px; margin-left:25px; " onclick="salvarSemPiscar('#frmCadastro', 'admAutores', '#conteudoAdm')">
                        </div>
                    </div>
                    <div class="divCadastro">
                        <div class="linhasForm">
                            <label class="tituloCadastro">País de origem: </label><br><input type="text" name="txtPais" class="txtForm" value="<?php echo($pais)?>" required> 
                        </div>
                        <div class="linhasForm" style=" height:170px;">
                            <label class="tituloCadastro">Descrição sobre o autor: </label><br>
                            <textarea cols="20"  name="txtDescricao" class="txtForm" style="resize: none; height:130px;margin-top:10px;" id="txtArea"   required><?php echo($desc)?></textarea>
                        </div>
                        
                    </div>
                </div>
            </form>
            <!-- Formulario de imagens -->
            <form  method="POST" action="upload.php" name="frmFoto" id="foto" enctype="multipart/form-data" style="width:170px;height:70px;float:left;">
                <div id="seguraBtn">
                    <label class="txtButton">Foto</label>  
                    <div class="btnEscolherImagem" id="btnImagem" style="padding-top: 9px;"> 
                        <label style="cursor:pointer;">Adicionar foto</label>  
                    </div> 
                    <input type="file" name="filefoto" id="AbrirFile" value="escolher arquivo" style="display:none;"> 
                </div>
            </form>
            <div class="visualizarFoto">
                <?php echo($caminhoImagem);?>
            </div>
        </div>
        <div class="seguraTable">
            <div class="tabelaAutores">
                <div class="linhaResult">
                    <div class="colResult" style="width:200px; border-right:1px solid #30a5a5; border-bottom:1px solid #30a5a5;"><label>Nome</label></div>
                    <div class="colResult" style="width:127px; border-right:1px solid #30a5a5; border-bottom:1px solid #30a5a5;"><label>Gênero<label></div>
                    <div class="colResult" style="width:120px; border-bottom:1px solid #30a5a5;"><label>Opções</label></div>
                </div>

                <?php
                    $sql = "SELECT * from tbl_autor";
                    $select = mysqli_query($conexao,$sql);
                    //$rsConsultaA = $rsConsultaAltores 
                    while($rsConsultaA = mysqli_fetch_array($select)){

                    
                ?>
                <div class="linhaResult">
                    <div class="colResult"  style="width:200px; border-right:1px solid #30a5a5; border-bottom:1px solid #30a5a5;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;"><label><?php echo($rsConsultaA['nome_autor'])?></label></div>
                    <div class="colResult"  style="width:127px; border-right:1px solid #30a5a5; border-bottom:1px solid #30a5a5;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;"><label><?php echo($rsConsultaA['genero'])?></label></div>
                    <div class="colResultOpcoes"  style="width:120px; border-bottom:1px solid #30a5a5;">

                        <?php 
                            if($rsConsultaA['status'] == 1){
                                $img = "1";
                            }
                            else{
                                $img = "0";
                            }
                        ?>


                        <img onclick="verificarStatus(<?php echo($rsConsultaA['status'])?>, <?php echo($rsConsultaA['id_autor'])?> ,'admAutores', '#conteudoAdm')" src="icon/<?php echo($img)?>.png" alt="user" title="Ativar ou desativar">
                        <img src="icon/edit.png" alt="user" title="Editar autor" onclick="atualizar(<?php echo($rsConsultaA['id_autor'])?>,'admAutores', '#conteudoAdm')">
                        <a onclick="deletarConteudo(<?php echo($rsConsultaA['id_autor'])?>, <?php echo($rsConsultaA['status'])?>, 'admAutores', '<?php echo($rsConsultaA['foto'])?>', '#conteudoAdm')"><img src="icon/delete.png" alt="user" title="deletar autor"></a>   
                    
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