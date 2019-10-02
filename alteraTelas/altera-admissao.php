<?php
  include("../db/conexao.php");
  include_once("../update.php");

?>

<?php

$ID_USUARIO = $_POST['ID_USUARIO'];
$QUALIFIC_CADASTRAL_CEP = $_POST['QUALIFIC_CADASTRAL_CEP'];
$CAD_ADM_PLATAFORMA_ADM_DIMIN = $_POST['CAD_ADM_PLATAFORMA_ADM_DIMIN'];
$DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO = $_POST['DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO'];
$TERMO_PSI = $_POST['TERMO_PSI'];
$INCLUI_ADM_PROV = $_POST['INCLUI_ADM_PROV'];



if(admissao($conn, $ID_USUARIO, $QUALIFIC_CADASTRAL_CEP, $CAD_ADM_PLATAFORMA_ADM_DIMIN, $DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO, $TERMO_PSI, $INCLUI_ADM_PROV)){?>
<?php

<<<<<<< Updated upstream
//if($STATUS == 'EM ANDAMENTO' && $ENQUADRAMENTO != NULL){
  //  $STATUS = 'EM CONTRATO';
   // status($conn, $ID_USUARIO, $STATUS);
//}else{
  //  status($conn, $ID_USUARIO, $STATUS);
//}
=======
/*/if($STATUS == 'EM ANDAMENTO' && $ENQUADRAMENTO != NULL){
  $STATUS = 'EM CONTRATO';
      status($conn, $ID_USUARIO, $STATUS);
}else{
      status($conn, $ID_USUARIO, $STATUS);
/*/}
>>>>>>> Stashed changes

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
    header("Refresh:1; url= ../telas/admissao.php?id=$ID_USUARIO");
?>