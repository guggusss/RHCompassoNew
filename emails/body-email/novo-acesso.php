<?php
require_once('../../validacoes/email/email.php');
include('../../db/conexao.php');
include('../../update.php');
$id = $_GET['id'];
$nome = buscaFuncionarios($conn, $id);
$funcionario = buscaFuncionarios($conn, $id);
$dados = buscainterno($conn, $id);
$email = buscasuporte($conn, $id);
$dataAdmissao = DateTime::createFromFormat('Y-m-d', $funcionario['DATA_ADMISSAO'])->format('d/m/Y');
$usuario = buscasuporte($conn, $id);
?>
<!DOCTYPE html>
<html>

<head>
  <button id="foo">Copy</button>
  <meta charset="utf-8" />
  <title>Novo Acesso</title>
  <script src="../../js/jquery.js"></script>
  <script src="../../js/seleciona.js"></script>
  <link rel="stylesheet" href="../css/site.css">
  <link rel="stylesheet" href="../css/rodape.css">
  <link rel="stylesheet" href="../css/novo_acesso.css">
</head>

<body>
  <?php include("../headerEmail/header.php") ?>
  <div contenteditable="true" id="bodyEmail" style="border: solid 0.5px black; padding:1%; margin-top: 20px">
    <div id="selecionaPagina">
      <main>
        <h1 class='h1-principal'>Suporte</h1>
        <p id='seg'>Seguem as informações para criação de usuário:</p>
        <div class='container'>
          <table border='1'>
            <tr id='table'>
              <th id='camp'>Nome</th>
              <th id='camp'>Login</th>
              <th id='camp'>Grupos</th>
              <th id='camp'>Data de início</th>
              <th id='camp'>E-mail</th>
            </tr>
            <tr id='table01'>
              <td><Strong class='sublinhe'><?= $nome['NOME'] ?></Strong></td>
              <td><strong class='sublinhe'><?= $usuario['USUARIO'] ?></strong></td>
              <td>Desenvolvimento, Equipe CLT, Interno, Equipe SP<strong>(RH ajusta manual)</strong></td>
              <td><strong class='sublinhe'><?= $dataAdmissao ?></strong></td>
              <td><strong class='sublinhe'><?= $email['EMAIL_SUP'] ?></strong></td>
            </tr>
          </table>
          <p><u>Senha de acesso e confirmação de ativação devem ser atualizadas no sistema.</u></p>
        </div>
      </main>
    </div>
  </div>

</body>
<script>
  $("#enviar").on("click", function() {
    let divBody = document.getElementById("bodyEmail");
    let divInput = $("#inputBody");
    divInput.val(divBody.innerHTML);
  });
</script>
<script>
  var senha = $('#senha');
  var olho = $("#olho");

  olho.mousedown(function() {
    senha.attr("type", "text");
  });

  olho.mouseup(function() {
    senha.attr("type", "password");
  });
  $("#olho").mouseout(function() {
    $("#senha").attr("type", "password");
  });
</script>

</html>