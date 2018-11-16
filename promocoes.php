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
        <title>Woody Woodpecker - promoções</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet"  href="css/lightslider.css"/>

        <script src="javaScript/jquery-1.9.1.min.js"></script>
        <script src="javaScript/jquery.excoloSlider.js"></script>
        <script src="javaScript/lightslider.js"></script> 
        <script src="javaScript/script.js"></script>
        <style>
            ul{
                list-style: none outside none;
                margin: 0;
            }
            .content-slider li{
                text-align: center;
                color: #FFF;
            }
            .content-slider h3 {
                margin: 0;
                height: 900px;
                width: 900px;
            }
            
        </style>
    </head>
    <body>
        <div id="principal">
            <!-- cabeçalho -->
            <header>
                <div id="seguraItens">
                    <a href="index.php"><div id="logo"></div></a>
                    <!-- MEnu -->
                    <nav id="navMenu">
                        <ul>
                            <li class="listaMenu"><a href="autores.php">Autores</a></li>
                            <li class="listaMenu"><a href="sobre.php">Sobre</a></li>
                            <li class="listaMenu"><a href="promocoes.php">Promoções</a></li>
                            <li class="listaMenu"><a href="nossasLojas.php">Nossas Lojas</a></li>
                            <li class="listaMenu"><a href="livrosDestaque.php">Livro do mês</a></li>
                            <li class="listaMenu"><a href="formulario/formulario.php">Fale conosco</a></li>
                        </ul>
                    </nav>
                    <!-- MEnu final -->
                    <div id="form">
                        <!-- Formulario de login -->
                        <form name="frmLogin" method="GET" action="promocoes.php">
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
                        <!--****************-->
                    </div>
                </div>
            </header> 
            <!--******************************* -->
            <!-- Inicio conteudo -->
            <div id="conteudo">
                <div class="seguraConteudo">
                    <section>
                        <h3 class="titulo">Promoções do mês</h3> 
                        <!-- Linhas promoção 1 com slide -->
                        <div class="linhaPromocao">
                            <div class="item">
                                <!-- Inicio da lista de slide com promoçoes -->
                                <ul id="content-slider" class="content-slider">
                                    
                                <?php
                                    $sql = "SELECT tbl_promocao.*, tbl_livro.* FROM tbl_promocao, tbl_livro WHERE tbl_promocao.id_livro = tbl_livro.id_livro AND tbl_promocao.status = 1";
                                    $select = mysqli_query($conexao, $sql);
                                    while($rsConsultaPromocao = mysqli_fetch_array($select)){
                                
                                
                                ?>
                                    <li>
                                        <div class="col-promocao" style='margin-left:1px;'>
                                            <div class="imagemPromocao">
                                                <img src="CMS/<?php echo($rsConsultaPromocao['foto'])?>" title="12 anos de escravisão" alt="12 anos de escravisão">
                                            </div>
                                            <div class="guardaTexto">
                                                <p class="tituloLivro"><?php echo($rsConsultaPromocao['titulo'])?></p>
                                                <p class="precoAntigo"><?php echo($rsConsultaPromocao['preco'])?></p>
                                                <p class="precoPromocao"><?php echo($rsConsultaPromocao['preco_novo'])?></p>
                                                <input type="button" value="Confira" class="btnComprar">
                                                <div class="imgCurti"></div>
                                            </div>
                                        </div>
                                    </li>
                                    <?php 
                                    }
                                    ?>
                                </ul>
                                <!-- Final da lista -->
                            </div>
                        </div>
                         <!-- Linhas promoção 1 -->
                        <div class="linhaPromocao">

                            <?php
                                $sql = "SELECT tbl_promocao.*, tbl_livro.* FROM tbl_promocao, tbl_livro WHERE tbl_promocao.id_livro = tbl_livro.id_livro AND tbl_promocao.status = 1";
                                $select = mysqli_query($conexao, $sql);
                                while($rsConsultaPromocao = mysqli_fetch_array($select)){
                            
                            
                            ?>

                            <div class="col-promocao">
                                <div class="imagemPromocao">
                                    <img style="width:300px;" src="CMS/<?php echo($rsConsultaPromocao['foto'])?>" title="12 anos de escravisão" alt="12 anos de escravisão">
                                </div>
                                <div class="guardaTexto">
                                    <p class="tituloLivro"><?php echo($rsConsultaPromocao['titulo'])?></p>
                                    <p class="precoAntigo"><?php echo($rsConsultaPromocao['preco'])?></p>
                                    <p class="precoPromocao"><?php echo($rsConsultaPromocao['preco_novo'])?></p>
                                    <input type="button" value="Confira" class="btnComprar">
                                    <div class="imgCurti"></div>
                                </div>
                            </div>

                             <?php 
                                }
                            ?>
                        </div>

                    </section>
                </div>
            </div>
            <!-- FOoter -->
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
            <!-- Footer Final -->
        </div>
       
    </body>
</html>