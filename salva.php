<?php
require_once("db/conexao.php");
include("update.php");
include("emails/defineNomeDoGrupoDeEmail.php");


		
		$id_captacao = $_POST["captacao"];
		$id_status = $_POST["STATUS_"];
		$id_sede = $_POST["sede"];
		$id_tipo = $_POST["tipo"];
		$sexo = $_POST["sexo"];		
		$carga_horaria = $_POST["carga_horaria"];
		$horario = $_POST["horario"];
		$nome = $_POST["nome"];		
		$fone_contato = $_POST["fone_contato"];		
		$cargo = $_POST["cargo"];		
		$controle_data_admissao = $_POST["controle_data_admissao"];
		$remuneracao_base = $_POST["remuneracao_base"];
		$gratificacao = $_POST["gratificacao"];		
		$solicitante = $_POST["solicitante"];
		$projeto = $_POST["projeto"];
		$cliente = $_POST["cliente"];		
		$email = $_POST["email"];
		$data_admissao = $_POST["data_admissao"];
		//$remuneracao_total = soma dos campos remuneração base e gratificação;		
		$posicao_comentario = $_POST["posicao_comentario"];
		$administrativo = $_POST["administrativo"];
		$comentarios = $_POST["comentarios"];



		$sql = "INSERT INTO `admissao_dominio` (`ID_CAPTACAO`, `ID_STATUS`, `ID_SEDE`, `ID_TIPO`, `SEXO`, `CARGA_HORARIA`, `HORARIO`, `NOME`, `FONE_CONTATO`, `CARGO`, `CONTROLE_DATA_ADMISSAO`, `REMUNERACAO_BASE`, `GRATIFICACAO`, `SOLICITANTE`, `PROJETO`, `CLIENTE`, `EMAIL`, `DATA_ADMISSAO`, `POSICAO_COMENTARIO`, `ADMINISTRATIVO`, `COMENTARIOS`) VALUES ('$id_captacao', '$id_status', '$id_sede', '$id_tipo', '$sexo', '$carga_horaria', '$horario', '$nome', '$fone_contato', '$cargo', '$controle_data_admissao', '$remuneracao_base', '$gratificacao', '$solicitante', '$projeto', '$cliente', '$email', '$data_admissao', '$posicao_comentario', '$administrativo', '$comentarios');"


		$execQuery = mysqli_query($conn,$sql);

		if($execQuery == ""){
			echo("Ocorreu um erro durante a inserção na tabela!!");
		}else{
			//echo("Dados inseridos com sucesso");
			header("Location: http://localhost/RHCompasso/telas/menuPrincipal.php");
		}



?>
