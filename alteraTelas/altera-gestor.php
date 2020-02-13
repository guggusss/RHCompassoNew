<?php
include("../db/conexao.php");
include("../update.php");
include("../static/php/RemoveMascAndFormatDate.php");
session_start();
$id = $_SESSION['id'];

$ID_USUARIO = $_POST['ID_USUARIO'];
$GESTOR = $_POST['GESTOR'];
$GESTOR_SABE = $_POST['GESTOR_SABE'];
$GESTOR_LOCAL = $_POST['GESTOR_LOCAL'];
$GESTOR_LOCAL_sABE = $_POST['GESTOR_LOCAL_sABE'];
$RECEPTOR_PESSOA = $_POST['RECEPTOR_PESSOA'];

if (gestao($conn, $ID_USUARIO, $GESTOR, $GESTOR_SABE, $GESTOR_LOCAL, $GESTOR_LOCAL_sABE, $RECEPTOR_PESSOA)) {

    include("../telas/includes/salvoSucesso.php");
} 
else 
{
    $msg = mysqli_error($conn);
    include("../telas/includes/naoSalvo.php");
}

?>
<meta http-equiv="refresh" content="1;  url=../telas/gestao.php?id=<?php echo $id ?>"/>
