<?php
require_once("CMS/conexao.php");
$loginConsulta = "";
$senhaConsulta = "";
$nomeUser = "";

function login($login, $senha){
    $boolean = false;
    $conexao = conexaoBD();
    
    $sql = "SELECT login, senha,nome FROM tbl_usuario WHERE login='".$login."' AND status = 1";
    $select = mysqli_query($conexao, $sql);

    if($rsConsultaUsuario =  mysqli_fetch_array($select)){
        $loginConsulta = $rsConsultaUsuario['login'];
        $senhaConsulta = $rsConsultaUsuario['senha'];
        $nomeUser = $rsConsultaUsuario['nome'];

        if($login == $loginConsulta && $senha == $senhaConsulta){
            echo("sadas");
            session_start();
            $_SESSION["nomeUser"] = $nomeUser; 
            $boolean = true;  
        }
        else{
            echo("sadas");
            $boolean = false;
        }
    }
    return $boolean;
}

?>
