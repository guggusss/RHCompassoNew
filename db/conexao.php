<?php
	$servidor = "mysql-server";
	$usuario = "root";
	$senha = "password";
	$dbname = "bancorh";
	
	//seta timeout
	ini_set('mysql.connect_timeout','30');
	//Criar a conexao
	$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
	
	
	if(!$conn){
		die("Falha na conexao: " . mysqli_connect_error());
	}else{
		//echo "Conexao realizada com sucesso";
	}
?>