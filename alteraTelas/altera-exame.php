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
$EXAME_OBS = $_POST['EXAME_OBS'];


if (exame($conn, $ID_USUARIO, $AGENDAMENTO_EXAM_ADM, $ENVIO_FUNC_EXAME, $EMAIL_RECEBIDO_EXAM, $COMENTARIO, $EXAME_OBS)) {

    include("../telas/includes/salvoSucesso.php");
} 
else 
{
    $msg = mysqli_error($conn);
    include("../telas/includes/naoSalvo.php");
}
?>
<meta http-equiv="refresh" content="1;  url=../telas/exame.php?id=<?php echo $id ?>"/>
