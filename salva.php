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
$administrativo = $_POST["administrativo"];
$comentarios = $_POST["comentarios"];

$sql = "INSERT INTO `admissao_dominio` ( `STATUS`,`ID_SEDE`,`ID_TIPO`,`ID_CAPTACAO`,`CARGA_HORARIA`, `HORARIO`,`NOME`,`SEXO`, `FONE_CONTATO`, `DATA_ADMISSAO`,  `CARGO`, `SOLICITANTE`, `LOG_REGISTRO_DIA_RH_ENVIA_DP`, `REMUNERACAO_BASE`, `GRATIFICACAO`, `CLIENTE` , `PROJETO`, `EMAIL`, `POSICAO_COMENTARIO`, `ADMINISTRATIVO`, `COMENTARIOS`)
		VALUES ('$status','$id_sede','$id_tipo','$id_captacao','$carga_horaria','$horario','$nome', '$sexo', '$fone_contato', '$data_admissao', '$cargo',  '$solicitante', '$LOG_REGISTRO_DIA_RH_ENVIA_DP', '$remuneracao_base', '$gratificacao', '$cliente', '$projeto', '$email', '$posicao_comentario', '$administrativo', '$comentarios')";



$execQuery = mysqli_query($conn, $sql);

if ($execQuery == "") {
	$msg = mysqli_error($conn);
	$dir = __DIR__."/log.txt";
	$today = date("F j, Y, g:i a");
	file_put_contents($dir, $msg." ".$today." || ", FILE_APPEND);?>
	<head>
		<meta charset="UTF-8">
		<title>RH Contratações</title>
		<link rel="stylesheet" href="css/reset.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/arquivo.css">
	</head> 
	<h2 class="text-danger">Ocorreu um erro ao salvar. <?= $msg ?></h2>
	<meta http-equiv="refresh" content="5;  url=telas/index.php"/>
	
<?php
}
else{
	echo "<head>
	<meta charset='UTF-8'>
	<title>RH Contratações</title>
	<link rel='stylesheet' href='css/reset.css'>
	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
	<link rel='stylesheet' href='css/bootstrap.min.css'>
	<link rel='stylesheet' href='css/arquivo.css'>
	</head>
	<h1 class='text-success'>Salvo com sucesso!</h1>";
	?><meta http-equiv="refresh" content="1; url=telas/index.php"/><?php
	}
	
