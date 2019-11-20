<?php
include("../db/conexao.php");
include("../update.php");
session_start();
$id = $_SESSION['id'];
$ID_USUARIO = $_POST['ID_USUARIO'];
$ENVIO = $_POST['ENVIO'];
$RECEBIDO = $_POST['RECEBIDO'];
$PLANILHA_CONTAS = $_POST['PLANILHA_CONTAS'];
$FORM_COMPR_BANCARIO = $_POST['FORM_COMPR_BANCARIO'];
$AGENCIA = $_POST['AGENCIA'];
$NUMERO_CONTA = $_POST['NUMERO_CONTA'];
$TIPO_CONTA = $_POST['TIPO_CONTA'];

if (bancario($conn, $ID_USUARIO, $ENVIO, $RECEBIDO, $PLANILHA_CONTAS, $FORM_COMPR_BANCARIO, $AGENCIA, $NUMERO_CONTA, $TIPO_CONTA)) {

include("../telas/salvoSucesso.php");
} 
else 
{
    $msg = mysqli_error($conn);
    include("../telas/naoSalvo.php");
}
//header("Refresh:1; url=../telas/bancarios.php?id=$id");
?>
<meta http-equiv="refresh" content="1;  url=../telas/bancarios.php?id=<?php echo $id ?>"/>
