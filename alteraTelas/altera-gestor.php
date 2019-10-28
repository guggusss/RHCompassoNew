<?php
include("../db/conexao.php");
include("../update.php");
session_start();
$id = $_SESSION['id'];
?>

<?php

$ID_USUARIO = $_POST['ID_USUARIO'];
$GESTOR = $_POST['GESTOR'];
$GESTOR_SABE = $_POST['GESTOR_SABE'];
$GESTOR_LOCAL = $_POST['GESTOR_LOCAL'];
$GESTOR_LOCAL_sABE = $_POST['GESTOR_LOCAL_sABE'];
$RECEPTOR_PESSOA = $_POST['RECEPTOR_PESSOA'];



if (gestao($conn, $ID_USUARIO, $GESTOR, $GESTOR_SABE, $GESTOR_LOCAL, $GESTOR_LOCAL_sABE, $RECEPTOR_PESSOA)) {
    /*/if($STATUS == 'EM ANDAMENTO' && $ENQUADRAMENTO != NULL){
$STATUS = 'EM CONTRATO';
        status($conn, $ID_USUARIO, $STATUS);
}else{
        status($conn, $ID_USUARIO, $STATUS);
}
        /*/
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

header("Refresh:1; url=../telas/gestao.php?id=$id");
?>