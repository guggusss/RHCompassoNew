<?php
include("../db/conexao.php");
include("../update.php");
include("../static/php/RemoveMascAndFormatDate.php");
session_start();
$id = $_SESSION['id'];

$ID_USUARIO = $_POST['ID_USUARIO'];
$INTRANET_CADASTRO_USUARIO = $_POST['INTRANET_CADASTRO_USUARIO'];
$INTRANET_CADASTRO_SENHA = $_POST['INTRANET_CADASTRO_SENHA'];
$KAIROS_CADASTRO_USUARIO = $_POST['KAIROS_CADASTRO_USUARIO'];
$KAIROS_CADASTRO_SENHA = $_POST['KAIROS_CADASTRO_SENHA'];
$EMAIL_GESTOR_APOIO_SEDE = $_POST['EMAIL_GESTOR_APOIO_SEDE'];
$EMAIL_INICIO_ATIVIDADES = $_POST['EMAIL_INICIO_ATIVIDADES'];
$EMAIL_BOAS_VINDAS = $_POST['EMAIL_BOAS_VINDAS'];
$ACESSOS = $_POST['ACESSOS'];

if (interno($conn, $ID_USUARIO, $INTRANET_CADASTRO_USUARIO, $INTRANET_CADASTRO_SENHA, $KAIROS_CADASTRO_USUARIO, $KAIROS_CADASTRO_SENHA, $EMAIL_GESTOR_APOIO_SEDE, $EMAIL_INICIO_ATIVIDADES, $EMAIL_BOAS_VINDAS, $ACESSOS)) {
    
    include("../telas/salvoSucesso.php");
} 
else 
{
    $msg = mysqli_error($conn);
    include("../telas/naoSalvo.php");
}
?>
<meta http-equiv="refresh" content="1;  url=../telas/interno.php?id=<?php echo $id ?>"/>
