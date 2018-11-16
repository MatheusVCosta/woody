<?php
   
   require_once("login.php");
   session_start();
  

   $file = $_SERVER["REQUEST_URI"];
    if(isset($_SESSION['nomeUser'])){
        session_destroy();
    }
   
    $msg= "";

    if(isset($_GET['btnLogin'])){
        $boolean = false;
        
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
        <title>Woody Woodpecker - home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/jquery.excoloSlider.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        
        <script src="javaScript/jquery-1.9.1.min.js"></script>
        <script src="javaScript/jquery.excoloSlider.js"></script>
        <script src="javaScript/lightslider.js"></script> 
        <script src="javaScript/script.js"></script>
       
       
    </head>
    <body>
        <div id="principal">
            <!-- Cabeçalho -->
            <header>
                <div id="seguraItens">
                    <a href="index.php"><div id="logo"></div></a>
                    <!-- MENU -->
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
                    <!-- Final Menu -->
                    <div id="form">
                    <!--Formulario de login -->
                        <form name="frmLogin" method="GET" action="index.php">
                            <div class="frmLogin">
                                <label class="lblAutenticacao">Login</label>
                                <input type="text" name="txtLogin" placeholder="Usuário" class="txtAutenticacao">    
                            </div>
                            <div class="frmSenha">
                                <label class="lblAutenticacao">Senha</label><br>
                                <input type="password" name="txtSenha" placeholder="Senha" class="txtAutenticacao">
                                <input type="submit" class="btnLogin" name="btnLogin" value="ok">
                            </div>
                            <label class="erroLogin"><?php echo($msg)?></label>
                        </form>
                    </div>
                </div>
            </header> 
            <!-- Final cabeçalho -->
            <!-- Inici da div que segura todo conteudo -->
            <div id="conteudo">

                <div class="seguraConteudo">
                    <!-- Slide -->
                    <div id="slider">
                        <img class="tamanhoImagem" src="imagem/slide/1.jpg" alt="imagem" title="slide">
                        <img class="tamanhoImagem" src="imagem/slide/2.jpg" alt="imagem" title="slide">
                        <img class="tamanhoImagem" src="imagem/slide/3.jpg" alt="imagem" title="slide">
                        <img class="tamanhoImagem" src="imagem/slide/4.jpg" alt="imagem" title="slide">
                        <img class="tamanhoImagem" src="imagem/slide/5.jpg" alt="imagem" title="slide">
                        <img class="tamanhoImagem" src="imagem/slide/6.jpg" alt="imagem" title="slide">
                    </div>
                    <!-- Fim slide -->
                    <!-- Conteiner que segura o conteudo  -->
                    <div class="container">
                        <div id="menuLateral">
                            <ul>
                                <li class="itensMenuLateral"><a>Item1</a></li>
                                <li class="itensMenuLateral"><a>Item1</a></li>
                                <li class="itensMenuLateral"><a>Item1</a></li>
                                <li class="itensMenuLateral"><a>Item1</a></li>
                            </ul>
                        </div>
                        <div id="areaEstoque">
                            <!--Div para separar em sesão-->
                            <div class="linhaEstoque">
                                <!-- Coluna para cada produto -->
                                <div class="col-estoque">
                                    <div class="imagem">
                                        <img src="imagem/1.jpg" alt="imagem" title="12 anos de escravidão">
                                    </div>
                                    <div class="breveDescricao">
                                        <span class="info">Nome:</span> <span class="txtNome">12 anos de escravidão</span>
                                        <span class="info">Descrição:</span> <span class="desc">A extraordinária história do violinista Solomon Northup, um negro livre que foi ...</span><br>
                                        <span class="infoPreco">Preço: </span><span class="txtPreco">R$ 19,90</span><br>
                                        <a class="detalhes" href="#">Detalhes</a>
                                    </div>
                                </div>
                                 <!-- Coluna para cada produto -->
                                <div class="col-estoque">
                                    <div class="imagem">
                                        <img src="imagem/1.jpg" alt="imagem" title="12 anos de escravidão">
                                    </div>
                                    <div class="breveDescricao">
                                        <span class="info">Nome:</span> <span class="txtNome">12 anos de escravidão</span>
                                        <span class="info">Descrição:</span> <span class="desc">A extraordinária história do violinista Solomon Northup, um negro livre que foi ...</span><br>
                                        <span class="infoPreco">Preço: </span><span class="txtPreco">R$ 19,90</span><br>
                                        <a class="detalhes" href="#">Detalhes</a>
                                    </div>
                                </div>
                                 <!-- Coluna para cada produto -->
                                <div class="col-estoque">
                                    <div class="imagem">
                                        <img src="imagem/1.jpg" alt="imagem" title="12 anos de escravidão">
                                    </div>
                                    <div class="breveDescricao">
                                        <span class="info">Nome:</span> <span class="txtNome">12 anos de escravidão</span>
                                        <span class="info">Descrição:</span> <span class="desc">A extraordinária história do violinista Solomon Northup, um negro livre que foi ...</span><br>
                                        <span class="infoPreco">Preço: </span><span class="txtPreco">R$ 19,90</span><br>
                                        <a class="detalhes" href="#">Detalhes</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Linhas 2 segura conteudo -->
                            <div class="linhaEstoque"> 
                                 <!-- Coluna para cada produto -->   
                                <div class="col-estoque">
                                    <div class="imagem">
                                        <img src="imagem/1.jpg" alt="imagem" title="12 anos de escravidão">
                                    </div>
                                    <div class="breveDescricao">
                                        <span class="info">Nome:</span> <span class="txtNome">12 anos de escravidão</span>
                                        <span class="info">Descrição:</span> <span class="desc">A extraordinária história do violinista Solomon Northup, um negro livre que foi ...</span><br>
                                        <span class="infoPreco">Preço: </span><span class="txtPreco">R$ 19,90</span><br>
                                        <a class="detalhes" href="#">Detalhes</a>
                                    </div>
                                </div>
                                 <!-- Coluna para cada produto -->
                                <div class="col-estoque">
                                    <div class="imagem">
                                        <img src="imagem/1.jpg" alt="imagem" title="12 anos de escravidão">
                                    </div>
                                    <div class="breveDescricao">
                                        <span class="info">Nome:</span> <span class="txtNome">12 anos de escravidão</span>
                                        <span class="info">Descrição:</span> <span class="desc">A extraordinária história do violinista Solomon Northup, um negro livre que foi ...</span><br>
                                        <span class="infoPreco">Preço: </span><span class="txtPreco">R$ 19,90</span><br>
                                        <a class="detalhes" href="#">Detalhes</a>
                                    </div>
                                </div>
                                 <!-- Coluna para cada produto -->
                                <div class="col-estoque">
                                    <div class="imagem">
                                        <img src="imagem/1.jpg" alt="imagem" title="12 anos de escravidão">
                                    </div>
                                    <div class="breveDescricao">
                                        <span class="info">Nome:</span> <span class="txtNome">12 anos de escravidão</span>
                                        <span class="info">Descrição:</span> <span class="desc">A extraordinária história do violinista Solomon Northup, um negro livre que foi ...</span><br>
                                        <span class="infoPreco">Preço: </span><span class="txtPreco">R$ 19,90</span><br>
                                        <a class="detalhes" href="#">Detalhes</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Linha 3 segura conteudo -->
                            <div class="linhaEstoque">
                                 <!-- Coluna para cada produto -->
                                <div class="col-estoque">
                                    <div class="imagem">
                                        <img src="imagem/1.jpg" alt="imagem" title="12 anos de escravidão">
                                    </div>
                                    <div class="breveDescricao">
                                        <span class="info">Nome:</span> <span class="txtNome">12 anos de escravidão</span>
                                        <span class="info">Descrição:</span> <span class="desc">A extraordinária história do violinista Solomon Northup, um negro livre que foi ...</span><br>
                                        <span class="infoPreco">Preço: </span><span class="txtPreco">R$ 19,90</span><br>
                                        <a class="detalhes" href="#">Detalhes</a>
                                    </div>
                                </div>
                                 <!-- Coluna para cada produto -->
                                <div class="col-estoque">
                                    <div class="imagem">
                                        <img src="imagem/1.jpg" alt="imagem" title="12 anos de escravidão">
                                    </div>
                                    <div class="breveDescricao">
                                        <span class="info">Nome:</span> <span class="txtNome">12 anos de escravidão</span>
                                        <span class="info">Descrição:</span> <span class="desc">A extraordinária história do violinista Solomon Northup, um negro livre que foi ...</span><br>
                                        <span class="infoPreco">Preço: </span><span class="txtPreco">R$ 19,90</span><br>
                                        <a class="detalhes" href="#">Detalhes</a>
                                    </div>
                                </div>
                                 <!-- Coluna para cada produto -->
                                <div class="col-estoque">
                                    <div class="imagem">
                                        <img src="imagem/1.jpg" alt="imagem" title="12 anos de escravidão">
                                    </div>
                                    <div class="breveDescricao">
                                        <span class="info">Nome:</span> <span class="txtNome">12 anos de escravidão</span>
                                        <span class="info">Descrição:</span> <span class="desc">A extraordinária história do violinista Solomon Northup, um negro livre que foi ...</span><br>
                                        <span class="infoPreco">Preço: </span><span class="txtPreco">R$ 19,90</span><br>
                                        <a class="detalhes" href="#">Detalhes</a>
                                    </div>
                                </div>
                            </div>   
                        </div> 
                    </div>
                </div>
                <!-- Segura rede social -->
                <div id="rdSocial">
                    <div class="seguraRede">
                        <div class="redes">
                            <img src="imagem/redeSocial/facebook.png" alt="facebook" title="facrbook">
                        </div>
    
                        <div class="redes">
                            <img src="imagem/redeSocial/instagram.png" alt="instagram" title="instagram">
                        </div>
    
                        <div class="redes">
                            <img src="imagem/redeSocial/twitter.png" alt="twitter" title="twitter">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
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
        </div>
    </body>
</html>