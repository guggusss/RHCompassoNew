<?php
include("../db/conexao.php");
include("../update.php");
session_start();
$id = $_SESSION['id'];
$ID_USUARIO = $_POST['ID_USUARIO'];
$AGENDAMENTO_EXAM_ADM = $_POST['AGENDAMENTO_EXAM_ADM'];
$ENVIO_FUNC_EXAME = $_POST['ENVIO_FUNC_EXAME'];
$EMAIL_RECEBIDO_EXAM = $_POST['EMAIL_RECEBIDO_EXAM'];
$COMENTARIO = $_POST['COMENTARIO'];



if (exame($conn, $ID_USUARIO, $AGENDAMENTO_EXAM_ADM, $ENVIO_FUNC_EXAME, $EMAIL_RECEBIDO_EXAM, $COMENTARIO)) {

    include("../telas/salvoSucesso.php");
} 
else 
{
    $msg = mysqli_error($conn);
    include("../telas/naoSalvo.php");
}
header("Refresh:1; url=../telas/exame.php?id=$id");
?>