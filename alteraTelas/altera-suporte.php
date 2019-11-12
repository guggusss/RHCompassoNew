<?php
include("../db/conexao.php");
include("../update.php");
session_start();
$id = $_SESSION['id'];
$ID_USUARIO = $_POST['ID_USUARIO'];
$EMAIL_SUP = $_POST['EMAIL_SUP'];
$USUARIO = $_POST['USUARIO'];
$SENHA = $_POST['SENHA'];
$EQUIPAMENTO = $_POST['EQUIPAMENTO'];
$TRANSLADO = $_POST['TRANSLADO'];
$EQUIPE = (isset($_POST['EQUIPE'])) ? $_POST['EQUIPE'] : array();

if (suporte($conn, $ID_USUARIO, $EMAIL_SUP, $USUARIO, $SENHA, $EQUIPAMENTO, $TRANSLADO, $EQUIPE)) {

    include("../telas/salvoSucesso.php");
} 
else 
{
    $msg = mysqli_error($conn);
    include("../telas/naoSalvo.php");
}
header("Refresh:1; url=../telas/suporteinterno.php?id=$id");
?>