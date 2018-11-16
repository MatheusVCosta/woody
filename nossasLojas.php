<?php

require_once("CMS/conexao.php");
    require_once("login.php");
    session_start();
    $conexao = conexaoBD();

    $msg= "";

    if(isset($_GET['btnLogin'])){
        $login= $_GET["txtLogin"];
        $senha = $_GET["txtSenha"];

        if($login == "" || $senha == ""){
            $msg = "Preencha todos os campos";
        }
        else{
            $boolean = login($login, $senha);
            if($boolean == true){      
                header("location:CMS/cms.php");
            }
            else{
                // header("location:index.php");
                $msg= "Usuario ou senha incorreto";
            }
        }  
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />    
        <title>Woody Woodpecker - Nossas lojas</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/menu_tab.css">
    </head>
    <body>
        <div id="principalLojas">
             <!---CABEÇALHO-->
            <header>
                <div id="seguraItens">
                    <a href="index.php"><div id="logo"></div></a>
                    <!-- MENU -->
                    <nav id="navMenu">
                        <ul>
                            <li class="listaMenu"><a href="autores.php">Autores</a></li>
                            <li class="listaMenu"><a href="sobre.php">Sobre</a></li>
                            <li class="listaMenu"><a href="promocoes.php">Promoções</a></li>
                            <li class="listaMenu"><a href="NossasLojas.php">Nossas lojas</a></li>
                            <li class="listaMenu"><a href="livrosDestaque.php">Livro do mês</a></li>
                            <li class="listaMenu"><a href="formulario/formulario.php">Fale conosco</a></li>
                        </ul>
                    </nav>
                    <!-- Fim MENU -->
                    <!-- Formulario Login -->
                    <div id="form">
                        <form name="frmLogin" method="GET" action="nossasLojas.php">
                            <div class="frmLogin">
                                <label class="lblAutenticacao">Login</label>
                                <input type="text" name="txtLogin" placeholder="Usuário" class="txtAutenticacao">    
                            </div>
                            <div class="frmSenha">
                                <label class="lblAutenticacao">Senha</label><br>
                                <input type="password" name="txtSenha" placeholder="Senha" class="txtAutenticacao">
                                <input type="submit" class="btnLogin" name="btnLogin" value="ok">

                            </div>
                        </form>
                    </div>
                    <!-- Fim formulario -->
                </div>
            </header> 
            <!-- Fim cabeçalho -->
            <!-- Inicinado a parte prinpal do site  -->
            <div id="conteudoLojas">  
                <section>
                    <h3 class="titulo">Nossas Lojas</h3> 
                    <!-- Cada tap recebe uma imagem e essa imagem dica debtro de outra div -->
                    <div class="linhaLojas">
                         <div class="tab">
                            <h3 class="livroTitulo">Lojas disponíveis no Brasil</h3>
                                <?php
                                
                                    $sql="select tbl_nossas_lojas.*, endereco.* from tbl_nossas_lojas, tbl_endereco as endereco where tbl_nossas_lojas.id_endereco = endereco.id and tbl_nossas_lojas.status = 1 LIMIT 4;";
                                    $contador = 1;
                                    $select = mysqli_query($conexao, $sql);
                                    while($rsConsulta = mysqli_fetch_array($select)){
                                        $mapa = 'mapa'.$contador++;
                                   
                                ?>

                                <div class="tablink" onclick="AbrirMapa('<?php echo($mapa)?>', 'this')" id="defaultOpen">
                                    <p><?php echo($rsConsulta['cidade'])?> - <?php echo($rsConsulta['uf'])?></p>
                                    <p><?php echo($rsConsulta['rua'])?></p>
                                    <p> <?php echo($rsConsulta['numero'])?>, <?php echo($rsConsulta['cidade'])?></p>
                                    <p><?php echo($rsConsulta['uf'])?></p>
                                </div>
                            <?php
                                }
                            ?>
                                
                                

                        </div>
                            <?php
                            
                                $sql="select tbl_nossas_lojas.*, endereco.* from tbl_nossas_lojas, tbl_endereco as endereco where tbl_nossas_lojas.id_endereco = endereco.id and tbl_nossas_lojas.status = 1 LIMIT 4;";
                                $contador = 1;
                                $select = mysqli_query($conexao, $sql);
                                while($rsConsulta = mysqli_fetch_array($select)){
                                    $mapa = 'mapa'.$contador++;
                                
                            ?>
                            <div id="<?php echo($mapa)?>" class="tabcontent">
                                <img src="CMS/<?php echo($rsConsulta['foto'])?>" alt="Av. Engenheiro Luís Carlos Berrini" title="Av. Engenheiro Luís Carlos Berrini">
                            </div >

                            <?php
                                }
                            ?>      
                    </div>
                </section>
            </div>
            <!--FOOTER  -->
            <footer>
                <div class="conteudoFooter">
                    <div class="copyright"> 
                        <p class="copyrightFont"> Av. Luis Carlos Berrini, nº 666.</p>
                        <p class="copyrightFont">Copyright©2001-2018, Woody Woodpecker. Todos os direitos reservados.</p>
                    </div>
                    <div class="imagemLogo">
                        <img src="imagem/logo.PNG" title="logo" alt="logo">
                    </div>
                </div>
                
            </footer>
            <!-- FINAL FOOTER -->
        </div>
        <script src="javaScript/tab.js"></script>
     
    </body>
</html>