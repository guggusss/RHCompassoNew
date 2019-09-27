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
		$sexo = $_POST['sexo'];
		$fone_contato = $_POST["fone_contato"];
		$data_admissao = $_POST["data_admissao"];
		$cargo = $_POST["cargo"];
		$solicitante = $_POST["solicitante"];
		$LOG_REGISTRO_DIA_RH_ENVIA_DP = $_POST["LOG_REGISTRO_DIA_RH_ENVIA_DP"];

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




		$sql = "INSERT INTO `admissao_dominio` ( `STATUS`,`ID_SEDE`,`ID_TIPO`,`ID_CAPTACAO`,`CARGA_HORARIA`, `HORARIO`,`NOME`,`SEXO`, `FONE_CONTATO`, `DATA_ADMISSAO`,  `CARGO`, `SOLICITANTE`, `LOG_REGISTRO_DIA_RH_ENVIA_DP`, `REMUNERACAO_BASE`, `GRATIFICACAO`, `CLIENTE` , `PROJETO`, `EMAIL`, `POSICAO_DATA`, `POSICAO_COMENTARIO`, `ADMINISTRATIVO`)
		VALUES ('EM VALIDAÇÃO','$id_sede','$id_tipo','$id_captacao','$carga_horaria','$horario','$nome', '$sexo', '$fone_contato', '$data_admissao', '$cargo',  '$solicitante', '$log_registro_dia_rh_envia_dp', '$remuneracao_base', '$gratificacao', '$cliente', '$projeto', '$email', '$posicao_data', '$posicao_comentario', '$administrativo')";



		$execQuery = mysqli_query($conn,$sql);

		if($execQuery == ""){
			echo("Ocorreu um erro durante a inserção na tabela!!");
		}else{
			//echo("Dados inseridos com sucesso");
			header("Location: http://localhost/RHCompasso/telas/menuPrincipal.php");
		}



?>
