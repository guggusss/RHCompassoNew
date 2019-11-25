<?php
include("../db/conexao.php");
include("../update.php");
include("../static/php/RemoveMascAndFormatDate.php");
session_start();
$id = $_SESSION['id'];

$ID_USUARIO = $_POST['ID_USUARIO'];
$FORMULARIOS_ENVIADOS = $_POST['FORMULARIOS_ENVIADOS'];
$FORMULARIOS_RECEBIDOS = $_POST['FORMULARIOS_RECEBIDOS'];
$DOCUMENTOS_FISICOS = $_POST['DOCUMENTOS_FISICOS'];
$CTPS_RECEBIDA = $_POST['CTPS_RECEBIDA'];
$COMENTARIO = $_POST['COMENTARIO'];


if(empty($FORMULARIOS_ENVIADOS)) {
    $FORMULARIOS_ENVIADOS = "0001-01-01";
}
if(empty($FORMULARIOS_RECEBIDOS)) {
    $FORMULARIOS_RECEBIDOS = "0001-01-01";
}if(empty($DOCUMENTOS_FISICOS)) {
    $DOCUMENTOS_FISICOS = "0001-01-01";
}if(empty($CTPS_RECEBIDA)) {
    $CTPS_RECEBIDA = "0001-01-01";
}

if (Documentacao($conn, $ID_USUARIO, $FORMULARIOS_ENVIADOS, $FORMULARIOS_RECEBIDOS, $DOCUMENTOS_FISICOS, $CTPS_RECEBIDA, $COMENTARIO)) {
    
    include("../telas/salvoSucesso.php");
} 
else 
{
    $msg = mysqli_error($conn);
    include("../telas/naoSalvo.php");
}
?>
<meta http-equiv="refresh" content="1;  url=../telas/documentacao.php?id=<?php echo $id ?>"/>
