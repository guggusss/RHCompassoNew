<?php
session_start();
include("../db/conexao.php");
include("../update.php");
include("../static/php/RemoveMascAndFormatDate.php");

if (!isset($id)) {
    $id = $_SESSION['id'];
}

$ID_USUARIO = $id;
$STATUS = 'FINALIZADO';

if (status($conn, $ID_USUARIO, $STATUS)) {

    include("../telas/salvoSucesso.php");
} 
else 
{
    $msg = mysqli_error($conn);
    include("../telas/naoSalvo.php");
}
header("Refresh:1; url=../telas/Index.php");
?>