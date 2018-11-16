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
        <title>Woody Woodpecker - Livros do Mês</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div id="principalLivroMes">
            <!-- cabeçalho -->
            <header>
                <div id="seguraItens">
                    <a href="index.php"><div id="logo"></div></a>
                    <!-- MENU -->
                    <nav id="navMenu">
                        <ul>
                            <li class="listaMenu"><a href="autores.php">Autores</a></li>
                            <li class="listaMenu"><a href="sobre.php">Sobre</a></li>
                            <li class="listaMenu"><a href="promocoes.php">Promoções</a></li>
                            <li class="listaMenu"><a href="nossasLojas.php">Nossas lojas</a></li>
                            <li class="listaMenu"><a href="livrosDestaque.php">Livro do mês</a></li>
                            <li class="listaMenu"><a href="formulario/formulario.php">Fale conosco</a></li>
                        </ul>
                    </nav>
                    <!-- final menu -->
                    <div id="form">
                        <form name="frmLogin" method="GET" action="livrosDestaque.php">
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
                </div>
            </header> 
            <!-- final cabeçalho -->
            <!-- Inicia area de conteudo -->
            <div id="conteudoLivroMes">  
                <section>  

                    <h3 class="titulo">Livro do mês</h3> 
                    <!-- Linha segura conteudo geral -->
                    <div class="linhaLivroDoMes">
                        <!-- segura primeira linha de conteudo  -->
                        <div class="linhaMes">

                            <?php

                                $sql = "SELECT * FROM tbl_livro WHERE status = 1";
                                $select = mysqli_query($conexao, $sql);
                               
                                while($rsConsultaLivro = mysqli_fetch_array($select)){

                                
                            
                            
                            ?>

                            <h3 class="livroTitulo"><?php echo($rsConsultaLivro['titulo'])?></h3>

                           

                            <div class="imagemLivro">
                                <img src="CMS/<?php echo($rsConsultaLivro['foto'])?>" alt="O pequeno principe" title="livro">
                            </div>
                            <!-- Breve historia do livro -->
                            <div class="historia">
                                <p><?php echo($rsConsultaLivro['descricao_livro'])?></p>
                            </div>
                            <div class="infoLivro">
                                <!-- Informações sobre o livro -->
                                <h3 id="sobreLivro">Informações sobre o livro</h3> 
                                <div id="infomacoesLivro">
                                    <span class="informacaoAdicional">Autor: </span><span class="livro"> Antoine de Saint-Exupéry</span><br>
                                    <span class="informacaoAdicional">Idioma: </span><span class="livro"><?php echo($rsConsultaLivro['idioma'])?></span><br>
                                    <span class="informacaoAdicional">País: </span><span class="livro"> <?php echo($rsConsultaLivro['pais'])?></span><br>
                                    <span class="informacaoAdicional">Gênero: </span><span class="livro"> Literatura Infanto-Juvenil, Novela</span><br>
                                    <span class="informacaoAdicional">Lançamento: </span><span class="livro"><?php echo($rsConsultaLivro['ano_publicacao'])?></span><br>
                                    <span class="informacaoAdicional">Páginas: </span><span class="livro"><?php echo($rsConsultaLivro['paginas'])?></span>
                                </div>
                            </div>
                        </div>
                        <!-- Linha 2 para adicionar enredo do livro e adaptaçoes -->
                        <div class="linhasMes">
                            <div class="seguraEnredo">
                                <div id="enredo">
                                    <h3 class="livroTitulo">Enredo</h3>
                                    <p class="textoEnredo"><?php echo($rsConsultaLivro['enredo'])?></p>
                                </div>
                                <div id="adaptacao" style="padding-left:20px;">
                                    <h3 class="livroTitulo">Adaptações</h3>
                                    <p class="textoEnredo"><?php echo($rsConsultaLivro['adaptaloes'])?></p>
                                
                                </div>
                            </div>
                        </div>
                        <?php
                            
                            }
                        ?>
                        <!--Final da div de enredo  -->
                    </div>
                </section>
            </div>
            <!-- Final da linhas de contedo -->
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
        </div>
    </body>
</html>