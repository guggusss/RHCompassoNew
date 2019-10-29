<?php
include("../db/conexao.php");
include("../update.php");
session_start();
$id = $_SESSION['id'];
?>

<?php

$ID_USUARIO = $_POST['ID_USUARIO'];
$INTRANET_CADASTRO_USUARIO = $_POST['INTRANET_CADASTRO_USUARIO'];
$INTRANET_CADASTRO_SENHA = $_POST['INTRANET_CADASTRO_SENHA'];
$KAIROS_CADASTRO_USUARIO = $_POST['KAIROS_CADASTRO_USUARIO'];
$KAIROS_CADASTRO_SENHA = $_POST['KAIROS_CADASTRO_SENHA'];
$EMAIL_GESTOR_APOIO_SEDE = $_POST['EMAIL_GESTOR_APOIO_SEDE'];
$EMAIL_INICIO_ATIVIDADES = $_POST['EMAIL_INICIO_ATIVIDADES'];
$EMAIL_BOAS_VINDAS = $_POST['EMAIL_BOAS_VINDAS'];
$ACESSOS = $_POST['ACESSOS'];



if (interno($conn, $ID_USUARIO, $INTRANET_CADASTRO_USUARIO, $INTRANET_CADASTRO_SENHA, $KAIROS_CADASTRO_USUARIO, $KAIROS_CADASTRO_SENHA, $EMAIL_GESTOR_APOIO_SEDE, $EMAIL_INICIO_ATIVIDADES, $EMAIL_BOAS_VINDAS, $ACESSOS)) { ?>
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
header("Refresh:1; url= ../telas/interno.php?id=$id");
?>