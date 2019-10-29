<?php
include("../db/conexao.php");
include("../update.php");
session_start();
$id = $_SESSION['id'];
?>

<?php

$ID_USUARIO = $_POST['ID_USUARIO'];
$FORMULARIOS_ENVIADOS = $_POST['FORMULARIOS_ENVIADOS'];
$FORMULARIOS_RECEBIDOS = $_POST['FORMULARIOS_RECEBIDOS'];
$DOCUMENTOS_FISICOS = $_POST['DOCUMENTOS_FISICOS'];
$CTPS_RECEBIDA = $_POST['CTPS_RECEBIDA'];


if (Documentacao($conn, $ID_USUARIO, $FORMULARIOS_ENVIADOS, $FORMULARIOS_RECEBIDOS, $DOCUMENTOS_FISICOS, $CTPS_RECEBIDA)) { ?>
    <?php

        /*/if($STATUS == 'EM ANDAMENTO' && $ENQUADRAMENTO != NULL){
    $STATUS = 'EM CONTRATO';
            status($conn, $ID_USUARIO, $STATUS);
    //}else{
            status($conn, $ID_USUARIO, $STATUS);
    }
            /*/

    
    include("../telas/salvoSucesso.php");
} 
else 
{
    $msg = mysqli_error($conn);
    include("../telas/salvaErro.php");
}
header("Refresh:1; url= ../telas/documentacao.php?id=$id");
?>