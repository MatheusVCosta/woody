<?php
    session_start();
    require_once("conexao.php");
    $conexao = conexaoBD();
    
    if(!isset($_SESSION['nomeUser'])){
        echo('<script>
        alert("Para acessar essa página por favor faça a autenticação");
        window.location.replace("../index.php");
        </script>');
        
    }

    if(isset($_GET['logout'])){
        $booblean = $_GET['logout'];
        session_destroy();
        header('location:../index.php');
    }
   
    

  ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <title>CMS-WoodyPecker</title>
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="css/styleModal.css"/>
    <script src="js/jquery-1.9.1.min.js"></script>
    
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/functionJquery.js"></script>   
</head>
<body>
    <div class="container">
        <div id="modal">
            <div id="fecharContainer">
                <img src="icon/close.png" alt="close" style="margin-top:10px; margin-left:10px;">
            </div>
            <div id="PaginasDescarregadas">
            </div>
        </div>
    </div>
    <div id="containerCMS">
        <header>
            <div id="titulo">
                <p>CMS-Sistema de Gerenciamento do Site</p>
            </div>
            <div id="logo">
                <img src="../imagem/logo.png" alt="logo" title="logo">
            </div>
        </header>
        <div class="seguraMenu">
            <nav>
                <div class="linkMenu" id="defaultOpen" onclick="AbrirConteudo('opcao1')">
                    <img src="icon/page.png" alt="gear"><br>
                    <p class="opMenu">Adm.Conteúdo</p>
                </div>
                <div class="linkMenu" onclick="AbrirConteudo('opcao2')" id="abrirTabela">
                    <img src="icon/fale.png" alt="gear"><br>
                    <p class="opMenu">Adm.Fale Conosco</p>
                </div>
                <div class="linkMenu" onclick="AbrirConteudo('opcao3')"  >
                    <img src="icon/produto.png" alt="gear"><br>
                    <p class="opMenu">Adm.Produtos</p>
                </div>
                <div class="linkMenu" onclick="AbrirConteudo('opcao4')" id="abrirTabelaUsers">
                    <img src="icon/users.png" alt="gear"><br>
                    <p class="opMenu">Adm.Usuários</p>
                </div>
            </nav>
            <div class="informacoes">
                <label id="lblFrase">Bem Vindo:</label><label id="lblUser"><?php echo($_SESSION["nomeUser"]);?></label><br>
                <div id="seguraLink">
                    <a id="logout" href="cms.php?logout=false">Logout</a>
                </div>
            </div>
        </div>

        <div id="areaControle">
            <div class="seguraConfig" id="opcao1">
                <div class="configPagina">
                    <ul>
                        <li class="liPagina" onclick="descarregarPaginasADM('admAutores')">
                            <img src="icon/user.png" alt="gear"><br>
                            <p class="linkPag">Autores</p>
                        </li>
                        <li  class="liPagina"  onclick="descarregarPaginasADM('admSobre')">
                            <img src="icon/sobre.png" alt="gear"><br>
                            <p class="linkPag">Sobre</p>
                        </li>

                        <li class="liPagina"  onclick="descarregarPaginasADM('admPromocoes')">
                            <img src="icon/promocao.png" alt="gear"><br>
                            <p class="linkPag">Promoções</p>
                        </li>
                        <li  class="liPagina"  onclick="descarregarPaginasADM('cadastrarLojas')">
                            <img src="icon/nossas.png" alt="gear" ><br>
                            <p class="linkPag">Nossas lojas</p>
                        </li>
                        <li class="liPagina"  onclick="descarregarPaginasADM('admLivroMes')">
                            <img src="icon/book.png" alt="gear"><br>
                            <p class="linkPag">Livro do mês</p>
                        </li>
                    </ul>
                </div>
                <div class="admPaginas">
                    
                </div>
            </div>
            <!-- Area do Fale conosco-tabela -->
            <div class="seguraConfig" id="opcao2" style="padding-top:0px;">
                <div id="seguraTabela">
                   
                </div>
            </div>
            <div class="seguraConfig" id="opcao3">
                   
            </div>
            <div class="seguraConfig" id="opcao4">
                <div class="configPagina">
                    <ul>
                        <li class="liPagina visualizar"  id="abrirCadastro" data-page="User">
                            <img src="icon/addUser.png" alt="gear"><br>
                            <p class="linkPag">Cadastrar usuários</p>
                        </li>
                    </ul>
                    <ul>
                        <li class="liPagina visualizar" id="abrirCadastro" data-page="Nivel">
                            <img src="icon/addLevels.png" alt="gear" ><br>
                            <p class="linkPag">Cadastrar nivel</p>
                        </li>
                    </ul>
                </div>
                <div class="carregarConteudo">
                    <div class="divConteudo" id="viewUsers">
                        
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <p id="rodape">Desenvolvido por: MatheusVCosta</p>
        </footer>
        

    </div>
    <script src="js/script.js"></script>
</body>
</html>