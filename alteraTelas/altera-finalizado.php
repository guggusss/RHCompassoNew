<?php
session_start();
    include("../db/conexao.php");
    include("../update.php");


    if (!isset ($id)){
     $id = $_SESSION['id'];
    }

?>
<?php

$ID_USUARIO = $id;
$STATUS = 'FINALIZADO';


if(status($conn, $ID_USUARIO, $STATUS)){
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
    
    header("Refresh:1; url=../telas/menuPrincipal.php");
    ?>