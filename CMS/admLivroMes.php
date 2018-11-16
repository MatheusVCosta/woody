    <?php

    session_start();
    require_once("conexao.php");
    $conexao = conexaoBD();

    if(isset($_GET['status'])){
        $id = $_GET['id'];
        $status = $_GET['status'];

        $sql = "UPDATE tbl_livro set status = '0'";
        mysqli_query($conexao, $sql);
    
        $sql = "UPDATE tbl_livro set status = '1' where id_livro =".$id;
        mysqli_query($conexao, $sql); 
    }  

    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css"/>
        <script src="js/jquery-1.9.1.min.js"></script>
    
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.form.js"></script>
        <script src="js/functionJquery.js"></script>   
    </head>
    <body>
        <div class="descarregarLivroMes">
            <div class="seguraTabelaMes">
                <div class="tabelaMostrarConteudo" style="width:900px;">
                    <div class="linhaResult" style="width:900px;">
                        <div class="colResult" style="width:748px; border-right:1px solid #30a5a5; border-bottom:1px solid #30a5a5;"><label>Nome Livro</label></div>
                        <div class="colResult" style="width:150px; border-bottom:1px solid #30a5a5;"><label>Ativar ou Desativar</label></div>
                    </div>

                    <?php
                        $sql = "select * from tbl_livro";
                        $select = mysqli_query($conexao,$sql);

                        while($rsConsultaA = mysqli_fetch_array($select)){

                        
                    ?>
                    <div class="linhaResult" style="width:900px;">
                        <div class="colResult"  style="width:748px; border-right:1px solid #30a5a5; border-bottom:1px solid #30a5a5;"><label><?php echo($rsConsultaA['titulo'])?></label></div>
                        <div class="colResultOpcoes"  style="width:150px; border-bottom:1px solid #30a5a5;">

                            <?php
                                if($rsConsultaA['status'] == 1){
                                    $img = "1";
                                }
                                else if($rsConsultaA['status'] == 0){
                                    $img = "0";
                                }
                            ?>
                            <img style="margin-left:55px;" src="icon/<?php echo($img)?>.png" alt="user" title="Ativar ou desativar" onclick="verificarStatus(<?php echo($rsConsultaA['status'])?>, <?php echo($rsConsultaA['id_livro'])?>, 'admLivroMes', '.descarregarLivroMes');">
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