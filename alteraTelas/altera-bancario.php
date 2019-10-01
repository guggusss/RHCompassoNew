<?php
    include("../db/conexao.php");
    include("../update.php");
?>

<?php

$ID_USUARIO = $_POST['ID_USUARIO'];
$ENVIO = $_POST['ENVIO'];
$RECEBIDO = $_POST['RECEBIDO'];
$ANEXAR_COMPR_DOMIN = $_POST['ANEXAR_COMPR_DOMIN'];
$PLANILHA_CONTAS = $_POST['PLANILHA_CONTAS'];
$FORM_COMPR_BANCARIO = $_POST['FORM_COMPR_BANCARIO'];
$AGENCIA = $_POST['AGENCIA'];
$NUMERO_CONTA = $_POST['NUMERO_CONTA'];
$TIPO_CONTA = $_POST['TIPO_CONTA'];



if(bancario($conn, $ID_USUARIO, $ENVIO, $RECEBIDO, $ANEXAR_COMPR_DOMIN, $PLANILHA_CONTAS, $FORM_COMPR_BANCARIO, $AGENCIA, $NUMERO_CONTA, $TIPO_CONTA)){
/*/if($STATUS == 'EM ANDAMENTO' && $ENQUADRAMENTO != NULL){
$STATUS = 'EM CONTRATO';
        status($conn, $ID_USUARIO, $STATUS);
}else{
        status($conn, $ID_USUARIO, $STATUS);
/*/}
?>
        <head>
    <meta charset="UTF-8">
    <title>RH Contratações</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/arquivo.css">
    </head>
    <h1 class="text-success margem">Alterado com sucesso!</h1>
<?php
 } else {
    $msg = mysqli_error($conn);
    ?>
        <head>
    <meta charset="UTF-8">
    <title>RH Contratações</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/arquivo.css">
    </head>
    <p class="text-danger margem">Não foi alterado: <?= $msg ?></p>
        <?php
    }
?>
<?php

header("Refresh:1; url=../telas/bancarios.php?id=$ID_USUARIO");
?>