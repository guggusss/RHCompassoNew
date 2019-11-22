<?php
session_start();
include("../db/conexao.php");
include("../update.php");
include("../static/php/RemoveMascAndFormatDate.php");


if (!isset($id)) {
    $id =  $_GET['id'];
}

$ID_USUARIO = $id;
$STATUS = 'EXCLUIDO';


if (deleteAD($conn, $ID_USUARIO, $STATUS)) {
    
    echo "<head>
        <meta charset='UTF-8'>
        <title>RH Contratações</title>
        <link rel='stylesheet' href='../css/reset.css'>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
        <link rel='stylesheet' href='../css/bootstrap.min.css'>
        <link rel='stylesheet' href='../css/arquivo.css'>
    </head>
    <h1 class='text-success'>Excluido com sucesso!</h1>";

} 
else 
{
    $msg = mysqli_error($conn);
    include("../telas/naoSalvo.php");
}

//header("Refresh:1; url=../telas/Index.php");
?>
<meta http-equiv="refresh" content="1;  url=../telas/Index.php?id=<?php echo $id ?>"/>
