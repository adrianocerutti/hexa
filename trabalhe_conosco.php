<?php include("include/header.php"); ?>

<?php
 
if(isset($_POST["acao"]) && isset($_POST["acao"]) == "enviar_contato"){
 
    if( PATH_SEPARATOR ==';'){
        $quebra_linha="\r\n";
    } elseif (PATH_SEPARATOR==':'){
        $quebra_linha="\n";
    } elseif ( PATH_SEPARATOR!=';' and PATH_SEPARATOR!=':' )  {
        echo ('Esse script não funcionará corretamente neste servidor, a função PATH_SEPARATOR não retornou o parâmetro esperado.');
    }
 
    //pego os dados enviados pelo formulario
    $nome       = $_POST["nome"];
    $mensagem2  = $_POST["mensagem"];
    $fone       = $_POST["fone"];
    $endereco   = $_POST["endereco"];
    $cidade     = $_POST["cidade"];
    $assunto    = "Envio de Currículo pelo site";
    $email      = $_POST["email"];
 
    //defina aqui o remetente do email (campo From:)
    $email_from = $_POST["email"];
 
    //defina aqui o destinatário do email
    $destinatario = 'adrianocerutti@gmail.com';
 
    //formato o campo da mensagem
    $mensagem2 = wordwrap( $mensagem2, 50, "<br>", 1);
 
    //valido os emails
    if (!ereg("^([0-9,a-z,A-Z]+)([.,_]([0-9,a-z,A-Z]+))*[@]([0-9,a-z,A-Z]+)([.,_,-]([0-9,a-z,A-Z]+))*[.]([0-9,a-z,A-Z]){2}([0-9,a-z,A-Z])?$", $email)){
        echo "<script>alert('Digite um e-mail válido!')</script>";
        echo "<script>window.location.href='trabalhe_conosco.php'</script>";
        exit;
    }
 
    //tratamento do arquivo que vai ser anexado
    $arquivo = isset($_FILES["arquivo"]) ? $_FILES["arquivo"] : FALSE;
 
    if(file_exists($arquivo["tmp_name"]) and !empty($arquivo)){
 
    $fp = fopen($_FILES["arquivo"]["tmp_name"],"rb");
    $anexo = fread($fp,filesize($_FILES["arquivo"]["tmp_name"]));
    $anexo = base64_encode($anexo);
 
    fclose($fp);
 
    $anexo = chunk_split($anexo);
 
    $boundary = "XYZ-" . date("dmYis") . "-ZYX";
 
    $mens = "--$boundary" . $quebra_linha . "";
    $mens .= "Content-Transfer-Encoding: 8bits" . $quebra_linha . "";
    $mens .= "Content-Type: text/html; charset=\"ISO-8859-1\"" . $quebra_linha . "" . $quebra_linha . ""; //plain
    $mens .= "<p align=\"left\"><strong><font face=\"Verdana, Geneva, sans-serif\">Contato pelo Site</font></strong></p>" . $quebra_linha . "";
    $mens .= "<strong>Assunto:</strong> $assunto<br>" . $quebra_linha . "";
    $mens .= "<strong>Nome:</strong> $nome<br>" . $quebra_linha . "";
    $mens .= "<strong>Tel.:</strong> $fone<br>" . $quebra_linha . ""; 
    $mens .= "<strong>Email:</strong> $email<br>" . $quebra_linha . "";
    $mens .= "<strong>Endereço:</strong> $endereco<br>" . $quebra_linha . "";
    $mens .= "<strong>Cidade:</strong> $cidade<br>" . $quebra_linha . ""; 
    $mens .= "<strong>Mensagem:</strong> $mensagem2<br>" . $quebra_linha . "";
    $mens .= "--$boundary" . $quebra_linha . "";
    $mens .= "Content-Type: ".$arquivo["type"]."" . $quebra_linha . "";
    $mens .= "Content-Disposition: attachment; filename=\"".$arquivo["name"]."\"" . $quebra_linha . "";
    $mens .= "Content-Transfer-Encoding: base64" . $quebra_linha . "" . $quebra_linha . "";
    $mens .= "$anexo" . $quebra_linha . "";
    $mens .= "--$boundary--" . $quebra_linha . "";
 
    $headers = "MIME-Version: 1.0" . $quebra_linha . "";
    $headers .= "From: $email_from " . $quebra_linha . "";
    $headers .= "Return-Path: $email_from " . $quebra_linha . "";
    $headers .= "Content-type: multipart/mixed; boundary=\"$boundary\"" . $quebra_linha . "";
    $headers .= "$boundary" . $quebra_linha . "";
 
        //envio o email com o anexo
        if(!mail($destinatario,$assunto,$mens,$headers)){
            print "Falha no envio da mensagem";
        } else {
            echo $ok = "<script language=\"javascript\">alert('Mensagem enviada com sucesso!')</script>";
        }
 
    }
 
    //se nao tiver anexo
    else{
 
    $body = "<body>
    <p align=\"left\"><strong><font face=\"Verdana, Geneva, sans-serif\">Contato pelo Site</font></strong></p>
    <table width=\"60%\" border=\"0\" align=\"left\" cellpadding=\"0\" cellspacing=\"5\">
      <tr>
         <td width=\"7%\" align=\"right\"><strong>Nome:</strong></td>
         <td width=\"93%\">".$nome."</td>
      </tr>
      <tr>
         <td align=\"right\"><strong>Email:</strong></td>
         <td>".$email."</td>
      </tr>
      <tr>
         <td align=\"right\"><strong>Assunto:</strong></td>
         <td>".$assunto."</td>
      </tr>
      <tr>
         <td><strong>Mensagem:</strong></td>
         <td>".$mensagem2."</td>
      </tr>
    </table>";
 
    $mensagem = "$body";
    $headers = "MIME-Version: 1.0" . $quebra_linha . "";
    $headers .= "Content-type: text/html; charset=iso-8859-1" . $quebra_linha . "";
    $headers .= "From: $email_from " . $quebra_linha . "";
    $headers .= "Return-Path: $email_from " . $quebra_linha . "";
 
        //envia o email sem anexo
        if(!mail($destinatario,$assunto,$mensagem,$headers)){
            print "Falha no envio da mensagem";
        } else {
            echo $ok = "<script language=\"javascript\">alert('Mensagem enviada com sucesso!')</script>";
        }
    }
 
}
?>

<div id="conteudo">
    <div id="trabalhe">
        <h2>Trabalhe conosco</h2>
        <form id="frmTrabalhe" method="post" action="" enctype="multipart/form-data">
            <fieldset>
                <label>Nome:</label>
                <input type="tex" name="nome" id="frmNome">
                <label>Tel.:</label>
                <input type="text" name="fone" id="frmFone">
                <label>E-mail:</label>
                <input type="text" name="email" id="frmEmail">
                <label>Endereço:</label>
                <input type="text" name="endereco" id="frmEndereco">
                <label>Cidade:</label>
                <input type="text" name="cidade" id="frmCidade">
                <label id="mensagem">Mensagem:</label>
                <textarea name="mensagem" id="frmMensagem"></textarea>
                <label>Currículo:</label>
                <input type="file" name="arquivo" id="frmCurriculo">
                <input type="submit" name="enviar" id="frmEnviar" value="Enviar">
                <input type="hidden" name="acao" value="enviar_contato">
            </fieldset>
        </form>
    </div>
</div><!--conteudo-->
<?php include("include/footer.php"); ?>