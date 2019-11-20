<?php
include("../db/conexao.php");
include_once("../update.php");

$STATUS = $_POST['status'];
$USUARIO_ID = $_POST['USUARIO_ID'];
$ID_SEDE = $_POST['ID_SEDE'];
$ID_TIPO = $_POST['ID_TIPO'];
$ID_CAPTACAO = $_POST['ID_CAPTACAO'];
$CARGA_HORARIA = $_POST['CARGA_HORARIA'];
$HORARIO = $_POST['HORARIO'];
$NOME = $_POST['NOME'];
$SEXO = $_POST['sexo'];
$FONE_CONTATO = $_POST['FONE_CONTATO'];
$CARGO = $_POST['CARGO'];
$SOLICITANTE = $_POST['SOLICITANTE'];
$LOG_REGISTRO_DIA_RH_ENVIA_DP = $_POST['LOG_REGISTRO_DIA_RH_ENVIA_DP'];
$REMUNERACAO_BASE = $_POST['REMUNERACAO_BASE'];
$GRATIFICACAO = $_POST['GRATIFICACAO'];
$CLIENTE = $_POST['CLIENTE'];
$PROJETO = $_POST['PROJETO'];
$EMAIL = $_POST['EMAIL'];
$DATA_ADMISSAO = $_POST['DATA_ADMISSAO'];
$POSICAO_COMENTARIO = $_POST['POSICAO_COMENTARIO'];
$ADMINISTRATIVO = $_POST['ADMINISTRATIVO'];
$COMENTARIOS = $_POST['COMENTARIOS'];
$REMUNERACAO_BASE = str_replace(',', '.', preg_replace('#[^\d\,]#is', '', $REMUNERACAO_BASE));
$GRATIFICACAO = str_replace(',', '.', preg_replace('#[^\d\,]#is', '', $GRATIFICACAO));

if (funcionario($conn, $USUARIO_ID, $ID_SEDE, $ID_TIPO, $ID_CAPTACAO, $CARGA_HORARIA, $HORARIO, $NOME, $SEXO, $FONE_CONTATO, $DATA_ADMISSAO, $CARGO, $SOLICITANTE, $LOG_REGISTRO_DIA_RH_ENVIA_DP, $REMUNERACAO_BASE, $GRATIFICACAO, $CLIENTE, $PROJETO, $EMAIL, $ADMINISTRATIVO, $POSICAO_COMENTARIO, $COMENTARIOS) && status($conn, $USUARIO_ID, $STATUS)) {

    include("../telas/salvoSucesso.php");

    } else {
    $msg = mysqli_error($conn); 
    include("../telas/naoSalvo.php");
}
header("Refresh:1; url=../telas/Index.php");
?>