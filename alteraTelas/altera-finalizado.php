<?php
session_start();
include("../db/conexao.php");
include("../update.php");


if (!isset($id)) {
    $id = $_SESSION['id'];
}

?>
<?php

$ID_USUARIO = $id;
$STATUS = 'FINALIZADO';


if (status($conn, $ID_USUARIO, $STATUS)) {

    include("../telas/salvoSucesso.php");
} 
else 
{
    $msg = mysqli_error($conn);
    include("../telas/salvaErro.php");
}
header("Refresh:1; url=../telas/menuPrincipal.php");
?>