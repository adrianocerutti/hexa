<?php include("include/header.php"); ?>

<?php
	
	if(isset($_REQUEST) && isset($_REQUEST["acao"]) == "enviar_contato"){
		
		//Recuperando os valores enviados
		$assunto 	= $_REQUEST["assunto"];
		$nome		= $_REQUEST["nome"];
		$email		= $_REQUEST["email"];
		$cidade		= $_REQUEST["cidade"];
		$estado		= $_REQUEST["estado"];
		$telefone	= $_REQUEST["telefone"];
		$celular	= $_REQUEST["celular"];
		$mensagem	= $_REQUEST["mensagem"];
		
		// enviar para múltiplos endereços
		//$destinatario  = 'letiiciia.santos@hotmail.com' . ', '; // separar por vírgula
		
		$destinatario .= 'letiiciia.santos@hotmail.com'; //email do destinatario

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
		  <td>'.$tel.'</td>
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
		<div id="trabalhe">
			<div class="conosco">
				<h2>Trabalhe Conosco</h2>
				<div id="txt_trabalhe">Trabalhe com a Hexa Trading...................................<br />.........., envie seu currículo, breve entraremos em contato.</div>
				<div id="linha2"></div>
				<div class="txt_trab">
					<form action="" method="post" id="form" onsubmit="return valida();">
						Nome: 
							<label class="nome"><input type="text" name="nome" id="nome" size="32" /></label><br />
						Tel.: 
							<label class="tel"><input type="text" name="tel" id="tel" size="32" /></label><br />
						E-mail: 
							<label class="email"><input type="text" name="email" id="email" size="32" /></label><br />
						Endereço: 
							<label class="endereco"><input type="text" name="endereco" id="endereco" size="32" /></label><br />
						Cidade: 
							<label class="cidade"><input type="text" name="cidade" id="cidade" size="32" /></label><br />
						Anexar<br />Curriculo:
							<label for="curriculo"><input type="file" name="curriculo" id="curriculo" /></label><br />
						Mensagem:
							<label class="textarea"><textarea name="textarea" id="textarea" cols="25" rows="5"></textarea></label><br /><br />
							<input type="submit" name="submit" value="Enviar" class="btnContato" />
							<input type="hidden" name="acao" value="enviar_contato" />
					</form>
				</div><!--txt_cont-->
			</div><!--conosco-->
		</div><!--trabalhe-->
	</div><!--conteudo-->
<?php include("include/footer.php"); ?>