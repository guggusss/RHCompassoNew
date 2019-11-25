<?php
include("../db/conexao.php");
include_once("../update.php");
include("../static/php/RemoveMascAndFormatDate.php");
session_start();
$id = $_SESSION['id'];

$ID_USUARIO = $_POST['ID_USUARIO'];
$QUALIFIC_CADASTRAL_CEP = $_POST['QUALIFIC_CADASTRAL_CEP'];
$CAD_ADM_PLATAFORMA_ADM_DIMIN = $_POST['CAD_ADM_PLATAFORMA_ADM_DIMIN'];
$DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO = $_POST['DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO'];
$TERMO_PSI = $_POST['TERMO_PSI'];
$INCLUI_ADM_PROV = $_POST['INCLUI_ADM_PROV'];
$COMENTARIO = $_POST['COMENTARIO'];





if(empty($QUALIFIC_CADASTRAL_CEP)) {
    $QUALIFIC_CADASTRAL_CEP = "0001-01-01";
}

if(empty($CAD_ADM_PLATAFORMA_ADM_DIMIN)) {
    $CAD_ADM_PLATAFORMA_ADM_DIMIN = "0001-01-01";
}

if(empty($DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO)) {
   $DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO = "0001-01-01";

}if(empty($TERMO_PSI)) {
    $TERMO_PSI = "0001-01-01";
}

if(empty($INCLUI_ADM_PROV)) {
    $INCLUI_ADM_PROV = "0001-01-01";
}



if (admissao($conn, $ID_USUARIO, $QUALIFIC_CADASTRAL_CEP, $CAD_ADM_PLATAFORMA_ADM_DIMIN, $DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO, $TERMO_PSI, $INCLUI_ADM_PROV, $COMENTARIO)) {

include("../telas/salvoSucesso.php");
} 
else 
{
    $msg = mysqli_error($conn);
    include("../telas/naoSalvo.php");
}
?>
<meta http-equiv="refresh" content="1;  url=../telas/admissao.php?id=<?php echo $id ?>"/>

