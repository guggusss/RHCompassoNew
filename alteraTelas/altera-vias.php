<?php
    include("../db/conexao.php");
    include("../update.php");
?>

<?php

$STATUS = $_POST['STATUS'];
$ID_USUARIO = $_POST['ID_USUARIO'];
$CRACHA_DATA_PEDIDO = $_POST['CRACHA_DATA_PEDIDO'];
$CRACHA_CONTROLE = $_POST['CRACHA_CONTROLE'];
$CRACHA_PROTOCOLO = $_POST['CRACHA_PROTOCOLO'];
$EMAIL_CADERNO_COMPASSO_SOLICITADO = $_POST['EMAIL_CADERNO_COMPASSO_SOLICITADO'];
$EMAIL_CADERNO_COMPASSO_RECEBIDO = $_POST['EMAIL_CADERNO_COMPASSO_RECEBIDO'];
$MALOTE_CADERNO_COMPASSO_CTPS = $_POST['MALOTE_CADERNO_COMPASSO_CTPS'];
$DOCUMENTOS_RECEBIDOS_ASSINADOS = $_POST['DOCUMENTOS_RECEBIDOS_ASSINADOS'];
$SALVAR_PASTA = $_POST['SALVAR_PASTA'];



if(viasDocs($conn, $ID_USUARIO, $CRACHA_DATA_PEDIDO, $CRACHA_CONTROLE, $CRACHA_PROTOCOLO, $EMAIL_CADERNO_COMPASSO_SOLICITADO, $EMAIL_CADERNO_COMPASSO_RECEBIDO, $MALOTE_CADERNO_COMPASSO_CTPS, $DOCUMENTOS_RECEBIDOS_ASSINADOS, $SALVAR_PASTA)){

    if($STATUS != null && $MALOTE_CADERNO_COMPASSO_CTPS != null){
        $STATUS = 'RETORNO DOCS';
        status($conn, $ID_USUARIO, $STATUS);
    }
    if($STATUS == 'RETORNO DOCS' && $DOCUMENTOS_RECEBIDOS_ASSINADOS !=null){
        $STATUS = 'EM CONTRATO';
        status($conn, $ID_USUARIO, $STATUS);
    }elseif($STATUS == null){
        $STATUS = 'EM ANDAMENTO';
        status($conn, $ID_USUARIO, $STATUS);
    }
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

header("Refresh:1; url=../telas/viasdocumentos.php?id=$ID_USUARIO");
?>