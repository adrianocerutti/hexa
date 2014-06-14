<?php include("include/header.php"); ?>

<?php
	
	if(isset($_REQUEST) && isset($_REQUEST["acao"]) == "enviar_contato"){
		
		//Recuperando os valores enviados
		$assunto 	= "Contato pelo Site - Hexa Trading";
		$nome		= $_REQUEST["nome"];
		$email		= $_REQUEST["email"];
		$endereco	= $_REQUEST["endereco"];
		$fone           = $_REQUEST["fone"];
		$mensagem	= $_REQUEST["mensagem"];
		
		$destinatario .= 'adrianocerutti@gmail.com'; //email do destinatario

		// corpo do email
		$corpo = '
		<html>
		<head>
		</head>
		<body>
		<table>
		 <tr>
                 <td><th>Nome:</th></td>
                 <td>'.$nome.'</td>
		 </tr>
		 <tr>
		  <td><th>Telefone:</th></td>
		  <td>'.$fone.'</td>
		 </tr>
		 <tr>
		  <td><th>Endereço:</th></td>
		  <td>'.$endereco.'</td>
		 </tr>
		 <tr>
		  <td><th>E-mail:</th></td>
		  <td>'.$email.'</td>
		 </tr>
		 <tr>
		  <td><th>Mensagem:</th></td>
		  <td>'.$mensagem.'</td>
		 </tr>
		</table>
		</body>
		</html>
		';

		// Envio de email em formato HTML
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

		// Headers Adicionais
		$headers .= 'To: '.$destinatario. "\r\n"; 
		$headers .= 'From: ' .$email. "\r\n";
		//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";	//Com Cópia
		//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";	//Cópia Oculta

		// Realiza o envio
		mail($destinatario, $assunto, $corpo, $headers);
		echo "<script>alert('E-mail enviado com sucesso!')</script>";
	}
	
?>
	<div id="conteudo">
		<div id="contato">
                    <h2>Contato</h2>
                    <form method="post" action="" id="form">
                        <fieldset>
                            <label>Nome:</label>
                            <input type="text" name="nome" id="frmNome">
                            <label>Tel.:</label>
                            <input type="text" name="fone" id="frmFone">
                            <label>Endereço:</label>
                            <input type="text" name="endereco" id="frmEndereco">
                            <label>E-mail:</label>
                            <input type="text" name="email" id="frmEmail">
                            <label id="mensagem">Mensagem:</label>
                            <textarea name="mensagem" id="frmMensagem"></textarea>
                            <input type="submit" name="enviar" id="frmEnviar" value="Enviar">
                            <input type="hidden" name="acao" value="enviar_contato">
                        </fieldset>
                    </form>
                    <div id="linha"></div>
                    <div id="infos">E-mal: hexa@hexatrading.com<br />Fone/Fax: +55 16 3329-4505</div>
                    <div id="mapa">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3719.5560731031237!2d-47.80417580000001!3d-21.209787000000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94b9b92ae8ee4551%3A0xdfe2ba7f0f558674!2sRua+Galileu+Galilei!5e0!3m2!1spt-BR!2sbr!4v1398304318730" width="400" height="250" frameborder="0" style="border:0"></iframe>
                    </div>
		</div><!--contato-->
	</div><!--conteudo-->
<?php include("include/footer.php"); ?>