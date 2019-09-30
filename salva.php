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
		$email = $_POST["email"];
		$posicao_comentario = $_POST["posicao_comentario"];
		$comentarios = $_POST["comentarios"];
		$administrativo = $_POST["administrativo"];




		$sql = "INSERT INTO `admissao_dominio` ( `STATUS`,`ID_SEDE`,`ID_TIPO`,`ID_CAPTACAO`,`CARGA_HORARIA`, `HORARIO`,`NOME`,`SEXO`, `FONE_CONTATO`, `DATA_ADMISSAO`,  `CARGO`, `SOLICITANTE`, `LOG_REGISTRO_DIA_RH_ENVIA_DP`, `REMUNERACAO_BASE`, `GRATIFICACAO`, `CLIENTE` , `PROJETO`, `COMENTARIOS`, `EMAIL`, `POSICAO_COMENTARIO`, `ADMINISTRATIVO`)
		VALUES ('$status','$id_sede','$id_tipo','$id_captacao','$carga_horaria','$horario','$nome', '$sexo', '$fone_contato', '$data_admissao', '$cargo',  '$solicitante', '$log_registro_dia_rh_envia_dp', '$remuneracao_base', '$gratificacao', '$cliente', '$projeto', '$email', '$posicao_comentario', '$administrativo', '$comentarios')";



		$execQuery = mysqli_query($conn,$sql);

		if($execQuery == ""){
			echo("Ocorreu um erro durante a inserção na tabela!!");
		}else{
			//echo("Dados inseridos com sucesso");
			header("Location: http://localhost/RHCompasso/telas/menuPrincipal.php");
		}



?>
