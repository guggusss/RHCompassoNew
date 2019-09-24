<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../../css/login.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="../../css/reset.css">   
  <link rel="stylesheet" href="../../css/menuPrincipal.css">
  <title> Login do Usuário </title>
</head>
<body>
  <div class="centraliza">
    <form class="centro" action="autenticacao.php" method="POST">
      <div class="t">       
        <label class="user"> Usuário: </label>
        <input type="text" class="usuario" name="usuario" id="usuario" autofocus>
        <label class="user"> Senha: </label>
        <input class="pw" type="password" name="senha" id="senha">
        <div class="oculto" id="oculto" hidden> Usuário e/ou Senha inválidos! </div>
        <button class="butao botao btn btn-default btn-xs btn-filter campo-filter" type="submit" id="entrar"> Entrar </button>
      </div>
    </form>
  </div>
</body>

<?php
// ../ volta uma pasta:
require_once('../../validacoes/login/login.php');
?>

</html>
