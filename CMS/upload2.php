<?php 

if(isset($_POST)){

    $arquivo = $_FILES['filefoto2']['name'];
    
    $tamanho_arquivo = $_FILES['filefoto2']['size'];
    
    $tamanho_arquivo = round($tamanho_arquivo/1024);
   
    $ext_arquivo = strrchr($arquivo, ".");
    
    $nome_arquivo = pathinfo($arquivo, PATHINFO_FILENAME);
    
    $nome_arquivo = md5(uniqid(time()).$nome_arquivo);

    $diretorio_arquivo = "arquivos/";

    $arquivos_permitidos = array(".jpg", ".png", "jpeg");

    if(in_array($ext_arquivo,$arquivos_permitidos)){

        if($tamanho_arquivo <=2000){
            $arquivo_tmb = $_FILES['filefoto2']['tmp_name'];
            $foto = $diretorio_arquivo.$nome_arquivo.$ext_arquivo;
            
            if(move_uploaded_file($arquivo_tmb, $foto)){
                echo("<img src='".$foto."'>");
                echo("
                    <script>
                        frmCadastro.txtNomeFoto2.value='".$foto."';
                    </script>
                ");
            }
            else{
                echo("Não foi possivel enviar o arquivo para o servidor");
            }
        }
        else{
            echo("tamanho de arquivo invalido");
        }
        
    }
    else{
        echo("extesão invalida");
    }

}
?>