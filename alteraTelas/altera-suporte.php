<?php
    include("../db/conexao.php");
    include("../update.php");
?>

<?php
$ID_USUARIO = $_POST['ID_USUARIO'];
$EMAIL_SUP = $_POST['EMAIL_SUP'];
$USUARIO = $_POST['USUARIO'];
$SENHA = $_POST['SENHA'];
$EQUIPAMENTO = $_POST['EQUIPAMENTO'];
$TRANSLADO = $_POST['TRANSLADO'];
$EQUIPE = (isset($_POST['EQUIPE'])) ? $_POST['EQUIPE'] : array();

if(suporte($conn, $ID_USUARIO, $EMAIL_SUP, $USUARIO, $SENHA, $EQUIPAMENTO, $TRANSLADO, $EQUIPE)){?>
<?php
/*i/f($STATUS == 'EM ANDAMENTO' && $ENQUADRAMENTO != NULL){
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
    <h1 class="text-danger">Não foi alterado: <?= $msg ?></h1>
<?php
    }
    header("Refresh:1; url=../telas/suporteinterno.php?id=$ID_USUARIO");
?>
