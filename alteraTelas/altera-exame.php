<?php
include("../db/conexao.php");
include("../update.php");
session_start();
$id = $_SESSION['id'];
?>

<?php

$ID_USUARIO = $_POST['ID_USUARIO'];
$AGENDAMENTO_EXAM_ADM = $_POST['AGENDAMENTO_EXAM_ADM'];
$ENVIO_FUNC_EXAME = $_POST['ENVIO_FUNC_EXAME'];
$EMAIL_RECEBIDO_EXAM = $_POST['EMAIL_RECEBIDO_EXAM'];



if (exame($conn, $ID_USUARIO, $AGENDAMENTO_EXAM_ADM, $ENVIO_FUNC_EXAME, $EMAIL_RECEBIDO_EXAM)) {
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
header("Refresh:1; url=../telas/exame.php?id=$id");
?>