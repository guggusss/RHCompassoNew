<?php
include("../db/conexao.php");
include("../update.php");
$DATA = date_create();
$DATA_HOJE = date_format($DATA, 'y-m-d');
session_start();
$id = $_SESSION['id'];

$STATUS = $_POST['STATUS'];
$ID_USUARIO = $_POST['ID_USUARIO'];
$ENQUADRAMENTO_REMUNERACAO_ENVIO = $_POST['ENQUADRAMENTO_REMUNERACAO_ENVIO'];
$ENQUADRAMENTO_REMUNERACAO_RETORNO = $_POST['ENQUADRAMENTO_REMUNERACAO_RETORNO'];
$ENQUADRAMENTO = $_POST['ENQUADRAMENTO'];
$ENVIO_PROPOSTA = $_POST['ENVIO_PROPOSTA'];
$COMUNICAR_PROPOSTA_ENVIADA = $_POST['COMUNICAR_PROPOSTA_ENVIADA'];
$ACEITA_RECUSA_CANDIDATO = $_POST['ACEITA_RECUSA_CANDIDATO'];
$COMENTARIO = $_POST['COMENTARIO'];
$COMUNICAR_STATUS = $_POST['COMUNICAR_STATUS'];
$id = $ID_USUARIO;

if (Proposta($conn, $ID_USUARIO, $ENQUADRAMENTO_REMUNERACAO_ENVIO, $ENQUADRAMENTO_REMUNERACAO_RETORNO, $ENQUADRAMENTO, $ENVIO_PROPOSTA, $COMUNICAR_PROPOSTA_ENVIADA, $ACEITA_RECUSA_CANDIDATO, $COMENTARIO, $COMUNICAR_STATUS) && status($conn, $ID_USUARIO, $STATUS)) {
    /*/if($STATUS == 'EM VALIDAÇÃO' && $ENVIO_PROPOSTA != NULL){
        $STATUS = 'AGUARDAR ACEITE';
        status($conn, $ID_USUARIO, $STATUS);
    } elseif ($STATUS == 'AGUARDAR ACEITE' && strtotime($ENVIO_PROPOSTA) < strtotime($DATA_HOJE)){
        $STATUS = 'REALIZAR CONTATO';
        status($conn, $ID_USUARIO, $STATUS);
    } elseif ($STATUS == 'REALIZAR CONTATO' && strtotime($ENVIO_PROPOSTA) < strtotime($DATA_HOJE)){
        $STATUS = 'RETORNO PENDENTE';
        status($conn, $ID_USUARIO, $STATUS);
    }else{
        status($conn, $ID_USUARIO, $STATUS);
    }/*/
   
    include("../telas/salvoSucesso.php");
} 
else 
{
    $msg = mysqli_error($conn);
    include("../telas/naoSalvo.php");
}
header("Refresh:1; url= ../telas/funcionario.php?id=$id");

?>