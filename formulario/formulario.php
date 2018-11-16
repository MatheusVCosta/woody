<?php

   $host = "localhost";
   $database = "db_woody_inf3m";
   $user = "root";
   $password = "bcd127";
   require_once("../login.php");

    if(!$conexao = mysqli_connect($host, $user, $password,$database)){
        echo("Erro na conexão");
    }

    if(isset($_POST['btnSalvar'])){
        
        $nome = $_POST["txtNome"];
        $celular = $_POST["txtCelular"];
        $sexo = $_POST["sltSexo"];
        $telefone = $_POST["txtTelefone"];
        $email = $_POST["txtEmail"];
        $profissao = $_POST["txtProfissao"];
        $linkFace = $_POST["txtLink"];
        $sugestao = $_POST["txtSugestao"];
        $infoPro = $_POST["txtInfoPro"];
        $home = $_POST["txtHome"];

        $sql = "INSERT INTO tbl_fale_conosco
        (nome, celular, sexo, telefone, email, profissao, linkFace, sugestao, infoProduto, homepage) 
        VALUES ('".$nome."','".$celular."','".$sexo."','".$telefone."','".$email."','".$profissao."','".$linkFace."','".$sugestao."','".$infoPro."','".$home."')";

       
        mysqli_query($conexao, $sql);
       header('location: formulario.php');
    }

    if(isset($_GET['btnLogin'])){
        $login= $_GET["txtLogin"];
        $senha = $_GET["txtSenha"];
    
        if($login == "" || $senha == ""){
            $msg = "Preencha todos os campos";
        }
        else{
            $boolean = login($login, $senha);
            if($boolean == true){      
                header("location:../CMS/cms.php");
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
         
        <title>Woody Woodpecker - fale Conosco</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="../javaScript/jquery-1.9.1.min.js"></script>
        <script src="script.js"></script>
    </head>
    <body>
        <div id="principal">
        <!---CABEÇALHO-->
            <header>
                <div id="seguraItens">
                    <a href="../index.php"><div id="logo"></div></a>
                    <!-- MENU -->
                    <nav id="navMenu">
                        <ul>
                            <li class="listaMenu"><a href="../autores.php">Autores</a></li>
                            <li class="listaMenu"><a href="../sobre.php">Sobre</a></li>
                            <li class="listaMenu"><a href="../promocoes.php">Promoções</a></li>
                            <li class="listaMenu"><a href="../nossasLojas.php">Nossas Lojas</a></li>
                            <li class="listaMenu"><a href="../livrosDestaque.php">Livro do mês</a></li>
                            <li class="listaMenu"><a href="formulario.php">Fale conosco</a></li>
                        </ul>
                    </nav>
                    <!-- FINAL MENU -->
                    <div id="form">
                    <!-- FORMULARIO DE LOGIN -->
                        <form name="frmLogin" method="GET" action="formulario.php">
                            <div class="frmLogin">
                                <label class="lblAutenticacao">Login</label>
                                <input type="text" placeholder="Usuário" class="txtAutenticacao" name="txtLogin">    
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
            <!-- FINAL CABEÇALHO -->

            <!-- AREA DE CONTEUDO DO SITE -->
            <div id="conteudo">
                <div class="seguraConteudo">
                    <div class="formularioFC">
                    <!-- FORMULARIO FALE CONOSCO -->
                        <form method="POST" action="formulario.php">
                            <h3 class="titulo">Fale Conosco</h3>
                            <!-- AREA LINHA INPUTS -->
                            <div class="linha" >
                                <div class="col">
                                    <label class="lblForm">Nome:* </label><br>
                                    <input type="text" class="txtForm" id="txtNome" placeholder="Nome" name="txtNome" onkeypress="return validar(event, 'numero', id)" required>
                                </div>
                                <div class="col">
                                    <label class="lblForm">Celular:*</label><br>
                                    <input type="text" id="txtCel" class="txtForm" placeholder="011 99999-9999" pattern="[0-9]{3} [0-9]{5}-[0-9]{4}" name="txtCelular" maxlength="14" required onkeypress="return validar(event, 'letra', id)">
                                </div>
                                
                            </div>
                            <!-- AREA LINHA INPUTS -->
                            <div class="linha">
                                <div class="col">
                                    <label class="lblForm" >Sexo:*</label><br>
                                    <select class="txtForm" required name="sltSexo">
                                        <option value="">Sexo</option>
                                        <option value="1">Mulher</option>
                                        <option value="2">Homem</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="lblForm">Telefone: </label><br>
                                    <input type="text" class="txtForm" id="txtTel" placeholder="011 99999-9999" pattern="[0-9]{3} [0-9]{4}-[0-9]{4}" name="txtTelefone"  maxlength="13" required onkeypress="return validar(event, 'letra', id)">
                                </div>
                               
                            </div>
                            <!-- AREA LINHA INPUTS -->
                            <div class="linha">
                                <div class="col">
                                    <label class="lblForm" >Email:* </label><br>
                                    <input type="email" class="txtForm" placeholder="exemplo@hotmail.com" name="txtEmail" required>
                                </div>
                                <div class="col">
                                    <label class="lblForm">Profissão:*  </label><br>
                                    <input type="text" class="txtForm" placeholder="Profissão" name="txtProfissao" required>
                                </div>
                               
                            </div>
                            <!-- AREA LINHA INPUTS -->
                            <div class="linha">
                                <div class="col">
                                    <label class="lblForm">Link no Facebook: </label><br>
                                    <input type="text" class="txtForm" placeholder="Link no Facebook" name="txtLink">
                                </div>
                                <div class="col">
                                    <label class="lblForm">Homepage: </label><br>
                                    <input type="text" class="txtForm" placeholder="Homepage" name="txtHome">
                                </div>
                                
                                
                            </div>
                            <!-- AREA LINHA INPUTS -->
                            <div class="linha">
                                <div class="col">
                                    <label class="lblForm">Informações de Produtos: </label><br>
                                    <textarea class="txtAreaForm" placeholder="Informações de Produtos" name="txtInfoPro"></textarea>
                                </div>
                                <div class="col">
                                    <label class="lblForm">Sugestão/Criticas: </label><br>
                                    <textarea class="txtAreaForm" placeholder="Sugestão/Criticas" name="txtSugestao"></textarea>
                                </div>  
                            </div>
                            <!-- AREA LINHA INPUTS -->
                            <div class="linha">
                                <div class="col">
                                    <input type="submit" class="btnForm" value="Salvar" name="btnSalvar">
                                </div>
                                <div class="col">
                                    <input type="button" class="btnForm" value="Limpar">
                                </div>
                            </div>
                        </form>
                        <!-- FINAL DO FORMULARIO FALECONOSCO -->
                    </div>
                </div>
            </div>
            <!-- FOOTER -->
            <footer>
                <div class="conteudoFooter">
                    <div class="copyright"> 
                        <p class="copyrightFont"> Av. Luis Carlos Berrini, nº 666.</p>
                        <p class="copyrightFont">Copyright©2001-2018, Woody Woodpecker. Todos os direitos reservados.</p>
                    </div>
                    <div class="imagem">
                        <img src="../imagem/logo.PNG" title="logo" alt="logo">
                    </div>
                </div>
            </footer>
            <!-- FINAL FOOTER -->
        </div>
        <!-- FINAL AREA CONTEUDO -->
    </body>
</html>