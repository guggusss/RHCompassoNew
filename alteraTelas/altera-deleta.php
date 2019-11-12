<?php
session_start();
include("../db/conexao.php");
include("../update.php");


if (!isset($id)) {
    $id =  $_GET['id'];
}

$ID_USUARIO = $id;
$STATUS = 'EXCLUIDO';


if (deleteAD($conn, $ID_USUARIO, $STATUS)) {
    
    include("../telas/salvoSucesso.php");
} 
else 
{
    $msg = mysqli_error($conn);
    include("../telas/naoSalvo.php");
}

header("Refresh:1; url=../telas/menuPrincipal.php");
?>