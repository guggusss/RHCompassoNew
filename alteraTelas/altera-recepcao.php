<?php
include("../db/conexao.php");
include("../update.php");
include("../static/php/RemoveMascAndFormatDate.php");
session_start();
$id = $_SESSION['id'];

$ID_USUARIO = $_POST['ID_USUARIO'];
$BOAS_VINDAS_INGR_AGENDADA = $_POST['BOAS_VINDAS_INGR_AGENDADA'];
$BOAS_VINDAS_INGR_REALIZADA = $_POST['BOAS_VINDAS_INGR_REALIZADA'];
$BOAS_VINDAS_SALA = $_POST['BOAS_VINDAS_SALA'];
$LAYOUT_BOAS_VINDAS_MENSAL = $_POST['LAYOUT_BOAS_VINDAS_MENSAL'];
$SURVEY = $_POST['SURVEY'];

if (recepcao($conn, $ID_USUARIO, $BOAS_VINDAS_INGR_AGENDADA, $BOAS_VINDAS_INGR_REALIZADA, $BOAS_VINDAS_SALA, $LAYOUT_BOAS_VINDAS_MENSAL, $SURVEY)) {

    include("../telas/salvoSucesso.php");
} 
else 
{
    $msg = mysqli_error($conn);
    include("../telas/naoSalvo.php");
}
?>
<meta http-equiv="refresh" content="1;  url=../telas/recepcao.php?id=<?php echo $id ?>"/>
