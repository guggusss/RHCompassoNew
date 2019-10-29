<?php
include("../db/conexao.php");
include("../update.php");
session_start();
$id = $_SESSION['id'];
?>

<?php

$ID_USUARIO = $_POST['ID_USUARIO'];
$ENVIO = $_POST['ENVIO'];
$RECEBIDO = $_POST['RECEBIDO'];
$PLANILHA_CONTAS = $_POST['PLANILHA_CONTAS'];
$FORM_COMPR_BANCARIO = $_POST['FORM_COMPR_BANCARIO'];
$AGENCIA = $_POST['AGENCIA'];
$NUMERO_CONTA = $_POST['NUMERO_CONTA'];
$TIPO_CONTA = $_POST['TIPO_CONTA'];



if (bancario($conn, $ID_USUARIO, $ENVIO, $RECEBIDO, $PLANILHA_CONTAS, $FORM_COMPR_BANCARIO, $AGENCIA, $NUMERO_CONTA, $TIPO_CONTA)) {
    /*/if($STATUS == 'EM ANDAMENTO' && $ENQUADRAMENTO != NULL){
$STATUS = 'EM CONTRATO';
        status($conn, $ID_USUARIO, $STATUS);
}else{
        status($conn, $ID_USUARIO, $STATUS);
}
/*/
    ?>

<?php
        include("../telas/salvoSucesso.php");
} 
else 
{
    $msg = mysqli_error($conn);
    include("../telas/salvaErro.php");
}
header("Refresh:1; url=../telas/bancarios.php?id=$id");
?>