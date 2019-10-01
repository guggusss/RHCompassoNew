<?php
    include("../db/conexao.php");
    include("../update.php");
?>

<?php

$ID_USUARIO = $_POST['ID_USUARIO'];
$AGENDAMENTO_EXAM_ADM = $_POST['AGENDAMENTO_EXAM_ADM'];
$ENVIO_FUNC_EXAME = $_POST['ENVIO_FUNC_EXAME'];
$EMAIL_RECEBIDO_EXAM = $_POST['EMAIL_RECEBIDO_EXAM'];
$ANEXAR_ASO = $_POST['ANEXAR_ASO'];



if(exame($conn, $ID_USUARIO, $AGENDAMENTO_EXAM_ADM, $ENVIO_FUNC_EXAME, $EMAIL_RECEBIDO_EXAM, $ANEXAR_ASO)){
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
    <h1 class="text-success">Alterado com sucesso!</h1>
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
    <p class="text-danger">Não foi alterado: <?= $msg ?></p>
        <?php
    }
?>
<?php

header("Refresh:1; url=../telas/exame.php?id=$ID_USUARIO");
?>