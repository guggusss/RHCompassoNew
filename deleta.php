<?php

include_once("db/conexao.php");

$id = $_GET['id'];
$query = "DELETE FROM admissao_dominio WHERE EMAIL = '$id'";
$deleta = mysqli_query($conn, $query);
if($deleta == ''){
echo('Houve um erro ao deletar!');
}else{
header("Location: http://localhost/RHCompasso/telas/menuPrincipal.php");
}
?>