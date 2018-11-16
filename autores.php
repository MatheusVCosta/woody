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
        <title>Woody Woodpecker - Autores</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div id="principal">
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
                            <li class="listaMenu"><a href="nossasLojas.php">Nossas Lojas</a></li>
                            <li class="listaMenu"><a href="livrosDestaque.php">Livro do mês</a></li>
                            <li class="listaMenu"><a href="formulario/formulario.php">Fale conosco</a></li>
                        </ul>
                    </nav>
                    <!-- FINAL MENU -->
                    <div id="form">
                         <!-- FORMULARIO DE LOGIN -->
                        <form name="frmLogin" method="GET" action="autores.php">
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
                         <!-- FINAL FORMULARIO -->
                    </div>
                </div>
            </header> 
            <!-- Div segura conteudo  -->
            <div id="conteudoAutores">  
                <section>  
                
                    <h3 class="titulo">Autores em destaques</h3> 
                    <!-- Seção de linhas autor -->
                    <?php

                $sql = "SELECT * from tbl_autor where status = 1";
                $select = mysqli_query($conexao, $sql);

                while($rsConsultaAutor = mysqli_fetch_array($select)){



                ?>
                    <div class="linhaAutor">

                        

                        <div class="fotoAutor">
                            <img src="CMS/<?php echo($rsConsultaAutor['foto'])?>" alt="NeilGaiman" title="NeilGaiman">
                        </div>
                       
                        <div class="seguraTexto">
                            <h3 class="nomeAutor"><?php echo($rsConsultaAutor['nome_autor'])?></h3>
                            <span class="infoAutor">País de origem:</span> <span class="infoAutor2"><?php echo($rsConsultaAutor['pais_origem'])?></span><br>
                            <span class="infoAutor">Gêneros: </span> <span class="infoAutor2"><?php echo($rsConsultaAutor['genero'])?></span>
                            <div class="sobreAutor">
                                <p class="biografia"><?php 
                                
                                $result = $rsConsultaAutor['descricao_autor']; 
                                
                                echo (nl2br($result, false));
                                
                                
                                
                                ?></p>
                                <a class="leiaMais" href="#">Leia mais</a>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                    <!-- Seção de linhas autor -->
                    
                </section>
            </div>
            <!-- FOOTER -->
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