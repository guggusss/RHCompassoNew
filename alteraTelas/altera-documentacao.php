<?php
    include("../db/conexao.php");
    include("../update.php");
?>

<?php

$ID_USUARIO = $_POST['ID_USUARIO'];
$FORMULARIOS_ENVIADOS = $_POST['FORMULARIOS_ENVIADOS'];
$FORMULARIOS_RECEBIDOS = $_POST['FORMULARIOS_RECEBIDOS'];
$DOCUMENTOS_FISICOS = $_POST['DOCUMENTOS_FISICOS'];
$CTPS_RECEBIDA = $_POST['CTPS_RECEBIDA'];
$COD_RASTREIO = $_POST['COD_RASTREIO'];


if(Documentacao($conn, $ID_USUARIO, $FORMULARIOS_ENVIADOS, $FORMULARIOS_RECEBIDOS, $DOCUMENTOS_FISICOS, $CTPS_RECEBIDA, $COD_RASTREIO)) { ?>
    <?php

    /*/if($STATUS == 'EM ANDAMENTO' && $ENQUADRAMENTO != NULL){
    $STATUS = 'EM CONTRATO';
            status($conn, $ID_USUARIO, $STATUS);
    //}else{
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
<?php } else {
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
header("Refresh:1; url= ../telas/documentacao.php?id=$ID_USUARIO");
?>
