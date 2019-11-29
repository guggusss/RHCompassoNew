<?php
include("../db/conexao.php");
include("../update.php");
include("../static/php/RemoveMascAndFormatDate.php");
session_start();
$id = $_SESSION['id'];

$ID_USUARIO = $_POST['ID_USUARIO'];
$AGENDAMENTO_EXAM_ADM = $_POST['AGENDAMENTO_EXAM_ADM'];
$ENVIO_FUNC_EXAME = $_POST['ENVIO_FUNC_EXAME'];
$EMAIL_RECEBIDO_EXAM = $_POST['EMAIL_RECEBIDO_EXAM'];
$COMENTARIO = $_POST['COMENTARIO'];


if(empty($AGENDAMENTO_EXAM_ADM)) {
    $AGENDAMENTO_EXAM_ADM = "0001-01-01";
}if(empty($ENVIO_FUNC_EXAME)) {
    $ENVIO_FUNC_EXAME = "0001-01-01";
}if(empty($EMAIL_RECEBIDO_EXAM)) {
    $EMAIL_RECEBIDO_EXAM = "0001-01-01";
}

if (exame($conn, $ID_USUARIO, $AGENDAMENTO_EXAM_ADM, $ENVIO_FUNC_EXAME, $EMAIL_RECEBIDO_EXAM, $COMENTARIO)) {

    include("../telas/salvoSucesso.php");
} 
else 
{
    $msg = mysqli_error($conn);
    include("../telas/naoSalvo.php");
}
?>
<meta http-equiv="refresh" content="1;  url=../telas/exame.php?id=<?php echo $id ?>"/>
