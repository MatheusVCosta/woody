<?php
    function conexaoBD(){
        $host="localhost";
        $user = "root";
        $password = "bcd127";
        $database = "db_woody_inf3m"; 

        if(!$conexao = mysqli_connect($host,$user,$password,$database)){
            echo("Erro de conexão");
        }  
        return $conexao;
    }
?>