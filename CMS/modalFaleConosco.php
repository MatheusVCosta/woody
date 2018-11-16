<?php
    require_once("conexao.php");
    $conexao = conexaoBD();
    $id = $_POST['idConsulta'];
    

    $sql = "SELECT * FROM tbl_fale_conosco WHERE id =".$id;
    $select = mysqli_query($conexao, $sql);

    if($rsConsulta = mysqli_fetch_array($select)){
       
        $nome = $rsConsulta["nome"];
        $sexo = $rsConsulta["sexo"];
        $celular = $rsConsulta["celular"];
        $telefone = $rsConsulta["telefone"];
        $email = $rsConsulta["email"];
        $infoProduto = $rsConsulta["infoProduto"];
        $profissao = $rsConsulta["profissao"];
        $linkFace = $rsConsulta["linkface"];
        $segestao = $rsConsulta["sugestao"];
        $homepage = $rsConsulta["homepage"];

        if($sexo == 1){
            $sexo = "Feminino";
        }
        else{
            $sexo = "masculino";
        }


    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" media="screen" href="css/styleModal.css"/>
    <script src="js/jquery-1.9.1.min.js"></script>
    <script src="js/functionJquery.js"></script>
</head>
<body>  
    <div id="tblConsulta">
        <div class="linhaConsulta">
            <div class="colConsulta"> Nome: </div>
            <div class="colConsultaResult"><?php echo($nome)?></div>
        </div>
        <div class="linhaConsulta">
            <div class="colConsulta">Sexo: </div>
            <div class="colConsultaResult"><?php echo($sexo)?></div>
        </div>
        <div class="linhaConsulta">
            <div class="colConsulta">Celular: </div>
            <div class="colConsultaResult"><?php echo($celular)?></div>
        </div>        
        <div class="linhaConsulta">
            <div class="colConsulta">Email: </div>
            <div class="colConsultaResult"><?php echo($email)?></div>
        </div>
        <div class="linhaConsulta">
            <div class="colConsulta">Profissão: </div>
            <div class="colConsultaResult"><?php echo($profissao)?></div>
        </div>
        <div class="linhaConsulta">
            <div class="colConsulta">Telefone: </div>
            <div class="colConsultaResult"><?php echo($telefone)?></div>
        </div>
        <div class="linhaConsulta">
            <div class="colConsulta">Link Face: </div>
            <div class="colConsultaResult"><?php echo($linkFace)?></div>
        </div>
        <div class="linhaConsulta">
            <div class="colConsulta">Homepage: </div>
            <div class="colConsultaResult"><?php echo($homepage)?></div>
        </div>
        <div class="linhaConsultaText">
            <div class="colConsulta" Style="height:90px;">Informação produto: </div>
            <div class="colConsultaResultText"><?php echo($infoProduto)?></div>
        </div>
        <div class="linhaConsultaText">
            <div class="colConsulta" Style="height:90px;">Sugestão/Criticos : </div>
            <div class="colConsultaResultText"><?php echo($segestao)?></div>
        </div>
    </div>
</body>
</html>