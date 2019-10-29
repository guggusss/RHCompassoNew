<?php
include("../db/conexao.php");
include("../update.php");
session_start();
$id = $_SESSION['id'];
?>

<?php

$ID_USUARIO = $_POST['ID_USUARIO'];
$GESTOR = $_POST['GESTOR'];
$GESTOR_SABE = $_POST['GESTOR_SABE'];
$GESTOR_LOCAL = $_POST['GESTOR_LOCAL'];
$GESTOR_LOCAL_sABE = $_POST['GESTOR_LOCAL_sABE'];
$RECEPTOR_PESSOA = $_POST['RECEPTOR_PESSOA'];



if (gestao($conn, $ID_USUARIO, $GESTOR, $GESTOR_SABE, $GESTOR_LOCAL, $GESTOR_LOCAL_sABE, $RECEPTOR_PESSOA)) {
    /*/if($STATUS == 'EM ANDAMENTO' && $ENQUADRAMENTO != NULL){
$STATUS = 'EM CONTRATO';
        status($conn, $ID_USUARIO, $STATUS);
}else{
        status($conn, $ID_USUARIO, $STATUS);
}
        /*/
    ?>

<?php
        include("../telas/salvoSucesso.php");
} 
else 
{
    $msg = mysqli_error($conn);
    include("../telas/salvaErro.php");
}

header("Refresh:1; url=../telas/gestao.php?id=$id");
?>