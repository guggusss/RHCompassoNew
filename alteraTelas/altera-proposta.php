<?php
include("../db/conexao.php");
include("../update.php");
include("../static/php/RemoveMascAndFormatDate.php");
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
     
    include("../telas/includes/salvoSucesso.php");
} 
else 
{
    $msg = mysqli_error($conn);
    include("../telas/includes/naoSalvo.php");
}
?>
<meta http-equiv="refresh" content="1;  url=../telas/funcionario.php?id=<?php echo $id ?>"/>
