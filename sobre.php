<?php

    require_once('CMS/conexao.php');
    require_once("login.php");
    $conexao = conexaoBD();
    session_start();
    $msg = "";

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
            echo($boolean);
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
        <title>Woody Woodpecker - sobre</title>
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
                    <!-- final menu -->
                    <div id="form">
                        <form name="frmLogin" method="GET" action="sobre.php">
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
            <div id="conteudo">
                <div class="seguraConteudo">
                   
                    <section>
                        <h3 class="titulo">Sobre a Woody WoodyPecker</h3> 
                        <!-- linhas 1 -->

                            <div class="sobreWoody">
                                <div class="linhaSobreW">
                                <?php
                                    $sql = "Select * from tbl_pagina_sobre Where status = 1" ;
                                    $select = mysqli_query($conexao, $sql);
                                    while($rsConsulta = mysqli_fetch_array($select)){

                                                              
                                ?>
                                    <picture>
                                        <img src="CMS/<?php echo($rsConsulta["foto_sobre"])?>" alt="biblioteca" class="imgLivraria">
                                    </picture>
                                    <div class="textoSobre">
                                        <h3 class="tituloSobre"><?php echo($rsConsulta['titulo_sobre'])?></h3>

                                        <p class="textoWoody"><?php echo($rsConsulta['descricao_sobre'])?></p>
                                    </div>
                                <?php
                                }
                                ?>    
                                </div>
                            
                                <!-- Linha Missões da empresa -->
                                <div class="linhaSobreW" style="height:380px;">
                                    <h3 class="tituloMissao">Nossa Missão</h3>
                                    <div class="seguraMissao">
                                        <div id="nossaMissao1">
                                            <ul>
                                                <li class="listaMissao">Influenciar as pessoas a criarem gosto pela leitura</li>
                                                <li class="listaMissao">Levar a leitura a todos lugares do mundo</li>
                                                <li class="listaMissao">Garatir total segurança aos produtos</li>
                                                <li class="listaMissao">Atingir o maximo de pessoas pelo o mundo</li>
                                                <li class="listaMissao">Revolucionar a maneira de ler entregando o melhor</li>
                                            </ul>
                                        </div>
                                        <div id="nossaMissao2">
                                            <ul>
                                                <li class="listaMissao">Influenciar as pessoas a criarem gosto pela leitura</li>
                                                <li class="listaMissao">Levar a leitura a todos lugares do mundo</li>
                                                <li class="listaMissao">Garatir total segurança aos produtos</li>
                                                <li class="listaMissao">Atingir o maximo de pessoas pelo o mundo</li>
                                                <li class="listaMissao">Revolucionar a maneira de ler entregando o melhor</li>
                                           </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- Linha Objetivo da empresa -->

                                <?php
                                    $sql = "Select * from tbl_pagina_sobre Where status = 1" ;
                                    $select = mysqli_query($conexao, $sql);
                                    while($rsConsulta = mysqli_fetch_array($select)){

                                                              
                                ?>

                                <div class="linhaSobreW">

                                    <div class="textoSobre">
                                    <h3 class="tituloSobre"><?php echo($rsConsulta['titulo_sobre'])?></h3>

                                    <p class="textoWoody"><?php echo($rsConsulta['descricao_sobre'])?></p>
                                    </div>
                                    <picture>
                                        <img src="CMS/<?php echo($rsConsulta["foto_sobre"])?>" alt="biblioteca" class="imgLivraria">
                                    </picture>
                                </div>
                                <?php 
                                    }
                                ?>
                            </div>
                            <!-- Final linhas 1 -->
                    </section>
                </div>
            </div>
            <!-- Final da div conteudo -->
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
            <!-- Final footer -->
        </div>
       
    </body>
</html>