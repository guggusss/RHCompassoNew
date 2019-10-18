<?php
require_once("db/conexao.php");
include("update.php");
include("emails/defineNomeDoGrupoDeEmail.php");

		
		$status = $_POST['status'];
		$id_sede = $_POST["sede"];
		$id_tipo = $_POST["tipo"];
		$id_captacao = $_POST["captacao"];
		$carga_horaria = $_POST["carga_horaria"];
		$horario = $_POST["horario"];

		$nome = $_POST["nome"];
		$sexo = $_POST['sexo'];
		$fone_contato = $_POST["fone_contato"];
		$data_admissao = $_POST["data_admissao"];
		$cargo = $_POST["cargo"];
		$solicitante = $_POST["solicitante"];
		$LOG_REGISTRO_DIA_RH_ENVIA_DP = $_POST["LOG_REGISTRO_DIA_RH_ENVIA_DP"];

		$remuneracao_base = $_POST["remuneracao_base"];
		$gratificacao = $_POST["gratificacao"];


		//$remuneracao_total = soma dos campos remuneração base e gratificação;
		$cliente = $_POST["cliente"];
		$projeto = $_POST["projeto"];
		$email = $_POST["EMAIL"];
		$posicao_comentario = $_POST["posicao_comentario"];
		$comentarios = $_POST["comentarios"];
		$administrativo = $_POST["administrativo"];
		$comentarios = $_POST["comentarios"];




		$sql = "INSERT INTO `admissao_dominio` ( `STATUS`,`ID_SEDE`,`ID_TIPO`,`ID_CAPTACAO`,`CARGA_HORARIA`, `HORARIO`,`NOME`,`SEXO`, `FONE_CONTATO`, `DATA_ADMISSAO`,  `CARGO`, `SOLICITANTE`, `LOG_REGISTRO_DIA_RH_ENVIA_DP`, `REMUNERACAO_BASE`, `GRATIFICACAO`, `CLIENTE` , `PROJETO`, `EMAIL`, `POSICAO_COMENTARIO`, `ADMINISTRATIVO`, `COMENTARIOS`)
		VALUES ('$status','$id_sede','$id_tipo','$id_captacao','$carga_horaria','$horario','$nome', '$sexo', '$fone_contato', '$data_admissao', '$cargo',  '$solicitante', '$LOG_REGISTRO_DIA_RH_ENVIA_DP', '$remuneracao_base', '$gratificacao', '$cliente', '$projeto', '$email', '$posicao_comentario', '$administrativo', '$comentarios')";



		$execQuery = mysqli_query($conn,$sql);
		
		if($execQuery == ""){
			echo("<h2>Ocorreu um erro durante a inserção na tabela! Verifique se há algum espaço em branco e/ou se o E-Mail digitado é Unico</h2>");
		}else{
			header("Location: http://localhost/RHCompasso/telas/menuPrincipal.php");
		}
		?>

		<?php 		
		header("Refresh:1; url= http://localhost/RHCompasso/telas/menuPrincipal.php");		
		?>
