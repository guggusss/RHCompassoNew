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

if (admissao($conn, $ID_USUARIO, $QUALIFIC_CADASTRAL_CEP, $CAD_ADM_PLATAFORMA_ADM_DIMIN, $DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO, $TERMO_PSI, $INCLUI_ADM_PROV, $COMENTARIO)) {

    include("../telas/includes/salvoSucesso.php");
} 
else 
{
    $msg = mysqli_error($conn);
    include("../telas/includes/naoSalvo.php");
}
?>
<meta http-equiv="refresh" content="1;  url=../telas/admissao.php?id=<?php echo $id ?>"/>

