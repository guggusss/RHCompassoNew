<?php
require_once('../../validacoes/email/email.php');
include('../../db/conexao.php');
include('../../update.php');
$id = $_GET['id'];
$nome = buscaFuncionarios($conn, $id);
$data = buscaFuncionarios($conn, $id);
$funcionario = buscaFuncionarios($conn, $id);
$sede = buscaSedeFuncionario($conn, $funcionario["ID_SEDE"]);

$dataN = $data['DATA_ADMISSAO'];
$dataF = date_create($dataN);
date_modify($dataF, '+ 44 day');
$NewDate =  date_format($dataF, 'd/m/Y');
$DataG = date_create($dataN);
date_modify($DataG, '+ 43 day');
$DataFim = date_format($DataG, 'd/m/Y');
$dataAdmissao = DateTime::createFromFormat('Y-m-d', $funcionario['DATA_ADMISSAO'])->format('d/m/Y');
?>
<!DOCTYPE html>
<html>

<head>
  <button id="foo">Copy</button>
  <meta charset="utf-8" />
  <title>Alerta</title>
  <link rel="stylesheet" type="text/css" media="screen" href="../css/site.css" />
  <link rel="stylesheet" href="../css/rodape.css">
  <script src="../../js/jquery.js"></script>
  <script src="../../js/seleciona.js"></script>
  <link rel="stylesheet" href="../css/alert.css">
</head>

<body>
  <?php include("../headerEmail/header.php") ?>
  <div contenteditable="true" id="bodyEmail" style="border: solid 0.5px black; padding:1%; margin-top: 20px">
    <div id="selecionaPagina">
      <main>
        <p class='h1-principal'>Bom dia, <strong class='sublinhe'><?= $funcionario['SOLICITANTE'] ?></strong></p>
        <p>O funcionário(a) abaixo terá sua <strong>1ª fase</strong> do contrato de experiência expirada em <strong class='sublinhe'><?= $NewDate ?>,</strong> conforme tabela abaixo:</p>
        <div class='container'>
          <table border='1'>
            <tr id='table'>
              <th id='camp'>Nome Coloaborador(a)</th>
              <th id='camp'>Empresa/Filial</th>
              <th id='camp'>Cargo</th>
              <th id='camp'>Data Admissão</th>
              <th id='camp'>Vcto.contrato 45dd</th>
            </tr>
            <tr id='table01'>
              <td><strong class='sublinhe'><?= $funcionario['NOME'] ?></strong></td>
              <td><strong class='sublinhe'><?= $sede['nome_sede'] ?></strong></td>
              <td><strong class='sublinhe'><?= $funcionario['CARGO'] ?></strong></td>
              <td><strong class='sublinhe'><?= $dataAdmissao ?></strong></td>
              <td><strong class='sublinhe'><?= $NewDate ?></strong></td>
            </tr>
          </table>
          <p>Por gentileza, caso deseje encerrar o contrato de trabalho, dentro do prazo, informar ao RH impreterivelmente até o dia <strong class='sublinhe'>
              <font color='red'><?= $DataFim ?></font>
            </strong> para que os documentos de rescisão e pagamento sejam providenciados.</p>
          <p>Caso não sejamos informados, o contrato será renovado por mais 45 dias - entraremos em contato antes do prazo para validarmos se o colaborador permanece ou se haverá reincidência.</p>
          <p>Desde já agradecemos a colaboração.</p>
        </div>
      </main>
    </div>
  </div>
</body>
<script type="text/javascript">
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