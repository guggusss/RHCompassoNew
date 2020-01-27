<?php
require_once('../../validacoes/email/email.php');
include('../../db/conexao.php');
include('../../update.php');
$id = $_GET['id'];
$nome = buscaFuncionarios($conn, $id);
$data = buscadocs($conn, $id);

$dataN = $data['FORMULARIOS_ENVIADOS'];
$dataF = date_create($dataN);
date_modify($dataF, '+ 1 day');
$NewDate =  date_format($dataF, 'd/m/Y');

?>
<!DOCTYPE html>
<html>

<head>
  <button id="foo">Copy</button>
  <meta charset="utf-8">
  <script src="../../js/jquery.js"></script>
  <script src="../../js/seleciona.js"></script>

  <link rel="stylesheet" href="../css/site.css">
  <link rel="stylesheet" href="../css/admissao.css">
  <link rel="stylesheet" href="../css/rodape.css">
  <title>Admissão PF</title>
</head>

<body>
  <?php include("../headerEmail/header.php") ?>
  <div contenteditable="true" id="bodyEmail" style="border: solid 0.5px black; padding:1%; margin-top: 20px">
    <div id="selecionaPagina">
      <header>
        <p id='title'>Boa tarde, <strong class='sublinhe'><?= $nome['NOME']; ?></strong></p>
        <p><strong class='cor'>Seja bem vindo ao time!!</strong></p>
        <p id='title'>Por gentileza, preencha e nos devolva através deste e-mail os formulários, em anexo <strong class='sublinhe'>
            <font color='red'><?= $NewDate ?>, às 12h</font>
          </strong> , conforme especificações abaixo:</p>
      </header>
      <table border="0" cellspacing="0" cellpadding="0" style="width: 1044.5pt; border-collapse: collapse; transform: scale(0.918822, 0.918822); transform-origin: left top;" min-scale="0.9188218390804598">
        <tbody>
          <tr style="height:35.25pt;">
            <td style="background-color:#1F3864;width:248.75pt;height:35.25pt;padding:0 3.5pt;border:1pt solid gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <b><span style="color:white;font-size:10pt;">DOCUMENTO</span></b><span style="color:white;"></span></p>
            </td>
            <td nowrap="" style="background-color:#1F3864;width:95.2pt;height:35.25pt;padding:0 3.5pt;border-width:1pt;border-style:solid solid solid none;border-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <b><span style="color:white;font-size:10pt;">ENVIAR POR E-MAIL</span></b><span style="color:white;"></span></p>
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <b><span style="color:white;font-size:7pt;">DOCUMENTOS OBRIGATÓRIOS</span></b><span style="color:white;"></span></p>
            </td>
            <td style="background-color:#1F3864;width:80.55pt;height:35.25pt;padding:0 3.5pt;border-width:1pt;border-style:solid solid solid none;border-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <b><span style="color:white;font-size:10pt;">ENVIAR VIAS IMPRESSAS</span></b><span style="color:white;"></span></p>
            </td>
            <td style="background-color:#1F3864;width:619.55pt;height:35.25pt;padding:0 3.5pt;border-width:1pt;border-style:solid solid solid none;border-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <b><span style="color:white;font-size:10pt;">ORIENTAÇÕES ADICIONAIS</span></b><span style="color:white;"></span></p>
            </td>
          </tr>
          <tr style="height:10.4pt;">
            <td nowrap="" style="width:248.75pt;height:10.4pt;padding:0 3.5pt;border-width:1pt;border-style:none solid solid solid;border-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">Formulário 1. COMPASSO - Ficha cadastro funcionários</span></b></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:95.2pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">Excel</span></p>
            </td>
            <td nowrap="" style="width:80.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="text-align:center;"><span style="font-size:10pt;">NÃO</span></p>
            </td>
            <td valign="bottom" nowrap="" style="width:619.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">&nbsp;</span></p>
            </td>
          </tr>
          <tr style="height:10.4pt;">
            <td nowrap="" style="width:248.75pt;height:10.4pt;padding:0 3.5pt;border-width:1pt;border-style:none solid solid solid;border-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">Formulário 2. Informações de Qualificação</span></b></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:95.2pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">.pdf</span></p>
            </td>
            <td nowrap="" style="width:80.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">NÃO</span></p>
            </td>
            <td valign="bottom" nowrap="" style="width:619.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">&nbsp;</span></p>
            </td>
          </tr>
          <tr style="height:10.4pt;">
            <td nowrap="" style="width:248.75pt;height:10.4pt;padding:0 3.5pt;border-width:1pt;border-style:none solid solid solid;border-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">Formulário 3. Declaração funcionários Oracle</span></b></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:95.2pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">.pdf</span></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:80.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">SIM</span></b></p>
            </td>
            <td valign="bottom" nowrap="" style="width:619.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">O documento deverá ser imprimido e assinado (Assinatura a mão).</span></p>
            </td>
          </tr>
          <tr style="height:10.4pt;">
            <td nowrap="" style="width:248.75pt;height:10.4pt;padding:0 3.5pt;border-width:1pt;border-style:none solid solid solid;border-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">Formulário 4. Adesão benefícios</span></b></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:95.2pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">.pdf</span></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:80.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">SIM</span></b></p>
            </td>
            <td valign="bottom" nowrap="" style="width:619.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">O documento deverá ser imprimido e assinado (Assinatura a mão).</span></p>
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">&nbsp;</span></p>
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">Termo Allianz - Formulário inclusão 2018 - Somente para funcionários alocados em São Paulo/SP.</span></p>
            </td>
          </tr>
          <tr style="height:117.6pt;">
            <td nowrap="" style="width:248.75pt;height:117.6pt;padding:0 3.5pt;border-width:1pt;border-style:none solid solid solid;border-color:gray;">
              <p><b><span style="font-size:10pt;">Formulário 5. Cadastro de funcionários</span></b></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:95.2pt;height:117.6pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">Excel</span></p>
            </td>
            <td nowrap="" style="width:80.55pt;height:117.6pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">NÃO</span></p>
            </td>
            <td valign="bottom" nowrap="" style="width:619.55pt;height:117.6pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">Este formulário é para seu cadastro em nosso sistema financeiro para fins de depósito como <u>adiantamentos&nbsp;e reembolsos de despesas</u>, entre outros que&nbsp;<u>não&nbsp;sejam relacionados à folha de pagamento</u>.</span></b></p>
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">&nbsp;</span></p>
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">Ao preencher o campo&nbsp;CPF, por favor, coloque com pontos conforme modelo&nbsp;xxx.xxx.xxx-xx.</span></p>
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">&nbsp;&nbsp;</span></p>
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">Caso já tenha aberto sua conta no Itaú e a mesma seja modalidade&nbsp;Conta Corrente&nbsp;poderá ser utilizada para estes tipos de depósito, mas caso tenha aberto uma conta&nbsp;SALÁRIO, não poderá utilizá-la para este fim, deste modo, por favor,
                  informar o banco e os dados onde possui sua conta corrente, ok?</span></p>
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">&nbsp;</span></p>
              <p><span style="font-size:10pt;">É necessário enviar também um comprovante dos dados bancários (pode ser um print da tela do banco no qual conste a Agência e Conta ou foto do cartão). Sinalizar qual a modalidade de sua conta: Salário ou C/C.</span></p>
            </td>
          </tr>
          <tr style="height:10.4pt;">
            <td nowrap="" style="width:248.75pt;height:10.4pt;padding:0 3.5pt;border-width:1pt;border-style:none solid solid solid;border-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">Formulário 6. Termo Opção Contribuição Sindical</span></b></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:95.2pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">.pdf</span></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:80.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">SIM</span></b></p>
            </td>
            <td valign="bottom" nowrap="" style="width:619.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">O documento deverá ser imprimido e assinado (Assinatura a mão).</span></p>
            </td>
          </tr>
          <tr style="height:10.4pt;">
            <td nowrap="" style="width:248.75pt;height:10.4pt;padding:0 3.5pt;border-width:1pt;border-style:none solid solid solid;border-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">Formulário 7. Declaração de Dependentes IR</span></b></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:95.2pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">.pdf</span></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:80.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">SIM</span></b></p>
            </td>
            <td valign="bottom" nowrap="" style="width:619.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">O documento deverá ser imprimido e assinado (Assinatura a mão).</span></p>
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">O documento assinado deverá ser enviado mesmo na ausência de dependentes.</span></p>
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">Para os casos de Dependentes declarados: </span></p>
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">- Cópia Certidão de Nascimento filhos para menores de 18 anos </span></p>
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">- Cópia RG e CPF a partir de&nbsp; 8 anos</span></p>
            </td>
          </tr>
          <tr style="height:10.4pt;">
            <td nowrap="" style="width:248.75pt;height:10.4pt;padding:0 3.5pt;border-width:1pt;border-style:none solid solid solid;border-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">CTPS – Carteira de Trabalho e Previdência Social</span></b></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:95.2pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">.pdf</span></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:80.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">SIM</span></b></p>
            </td>
            <td valign="bottom" nowrap="" style="width:619.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p><span style="font-size:10pt;">Enviar imagens da sua Carteira da Trabalho (frente e versos dos seus dados, a página da sua última contração com a baixa do Contrato de Trabalho e a página em branco disponível para preenchimento pela Compasso).</span></p>
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">&nbsp;</span></p>
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <b><span style="font-size:12pt;background-color:yellow;">Sem a entrega da via física da Carteira de Trabalho não será possível a admissão. </span></b></p>
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;background-color:yellow;">Caso não tenha a baixa da empresa anterior, favor entregar também a carta do pedido de desligamento, com carimbo e assinatura da empresa.</span></b><span style="font-size:10pt;font-family:Times New Roman,serif;">
                </span></p>
            </td>
          </tr>
          <tr style="height:10.4pt;">
            <td nowrap="" style="width:248.75pt;height:10.4pt;padding:0 3.5pt;border-width:1pt;border-style:none solid solid solid;border-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">Certidão de Casamentos/União Estável</span></b></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:95.2pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">.pdf</span></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:80.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">SIM</span></b></p>
            </td>
            <td valign="bottom" nowrap="" style="width:619.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">&nbsp;</span></p>
            </td>
          </tr>
          <tr style="height:10.4pt;">
            <td nowrap="" style="width:248.75pt;height:10.4pt;padding:0 3.5pt;border-width:1pt;border-style:none solid solid solid;border-color:gray;">
              <p><b><span style="font-size:10pt;">Dependentes Salário Família</span></b></p>
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">(salário até R$ 1.319,18)</span></b></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:95.2pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">.pdf</span></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:80.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">SIM</span></b></p>
            </td>
            <td valign="bottom" nowrap="" style="width:619.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">Encaminhar: </span></p>
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">- Cópia Certidão de Nascimento filhos até 14 anos</span></p>
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">- Cópia Cartão de vacinação dos filhos até 06 anos</span></p>
            </td>
          </tr>
          <tr style="height:10.4pt;">
            <td nowrap="" style="width:248.75pt;height:10.4pt;padding:0 3.5pt;border-width:1pt;border-style:none solid solid solid;border-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">Comprovante de residência</span></b></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:95.2pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">.pdf</span></p>
            </td>
            <td nowrap="" style="width:80.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="text-align:center;"><b><span style="font-size:10pt;">SIM</span></b></p>
            </td>
            <td valign="bottom" nowrap="" style="width:619.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">&nbsp;</span></p>
            </td>
          </tr>
          <tr style="height:10.4pt;">
            <td nowrap="" style="width:248.75pt;height:10.4pt;padding:0 3.5pt;border-width:1pt;border-style:none solid solid solid;border-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">CPF</span></b></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:95.2pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">.pdf</span></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:80.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">SIM</span></b></p>
            </td>
            <td valign="bottom" nowrap="" style="width:619.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">&nbsp;</span></p>
            </td>
          </tr>
          <tr style="height:10.4pt;">
            <td nowrap="" style="width:248.75pt;height:10.4pt;padding:0 3.5pt;border-width:1pt;border-style:none solid solid solid;border-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">Dispensa Militar</span></b></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:95.2pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">.pdf</span></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:80.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="text-align:center;"><b><span style="font-size:10pt;">SIM</span></b></p>
            </td>
            <td valign="bottom" nowrap="" style="width:619.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">- Para homens</span></p>
            </td>
          </tr>
          <tr style="height:10.4pt;">
            <td nowrap="" style="width:248.75pt;height:10.4pt;padding:0 3.5pt;border-width:1pt;border-style:none solid solid solid;border-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">Foto 3x4</span></b></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:95.2pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">.pdf</span></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:80.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">SIM</span></b></p>
            </td>
            <td valign="bottom" nowrap="" style="width:619.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">Encaminhar foto 3x4 por e-mail e entregar 1 via física para emissão do seu crachá funcional.</span></p>
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">&nbsp;</span></p>
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">Nós apresentamos os novos colegas em uma comunicação interna. Se você preferir, pode enviar uma foto, por e-mail, diferente da que será usada no crachá!</span></p>
            </td>
          </tr>
          <tr style="height:10.4pt;">
            <td nowrap="" style="width:248.75pt;height:10.4pt;padding:0 3.5pt;border-width:1pt;border-style:none solid solid solid;border-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">PIS</span></b></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:95.2pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">.pdf</span></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:80.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">SIM</span></b></p>
            </td>
            <td valign="bottom" nowrap="" style="width:619.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">&nbsp;</span></p>
            </td>
          </tr>
          <tr style="height:10.4pt;">
            <td nowrap="" style="width:248.75pt;height:10.4pt;padding:0 3.5pt;border-width:1pt;border-style:none solid solid solid;border-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">RG</span></b></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:95.2pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">.pdf</span></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:80.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">SIM</span></b></p>
            </td>
            <td valign="bottom" nowrap="" style="width:619.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">&nbsp;</span></p>
            </td>
          </tr>
          <tr style="height:10.4pt;">
            <td nowrap="" style="width:248.75pt;height:10.4pt;padding:0 3.5pt;border-width:1pt;border-style:none solid solid solid;border-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">Título de Eleitor</span></b></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:95.2pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">.pdf</span></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:80.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">SIM</span></b></p>
            </td>
            <td valign="bottom" nowrap="" style="width:619.55pt;height:10.4pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">&nbsp;</span></p>
            </td>
          </tr>
          <tr style="height:42.95pt;">
            <td nowrap="" style="width:248.75pt;height:42.95pt;padding:0 3.5pt;border-width:1pt;border-style:none solid solid solid;border-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">Conta no Banco Itaú</span></b></p>
            </td>
            <td nowrap="" style="background-color:#FFE599;width:95.2pt;height:42.95pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">.pdf</span></p>
            </td>
            <td nowrap="" style="width:80.55pt;height:42.95pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p align="center" style="font-size:11pt;font-family:Calibri,sans-serif;text-align:center;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">NÃO</span></p>
            </td>
            <td valign="bottom" nowrap="" style="width:619.55pt;height:42.95pt;padding:0 3.5pt;border-style:none solid solid none;border-right-width:1pt;border-bottom-width:1pt;border-right-color:gray;border-bottom-color:gray;">
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <b><span style="font-size:10pt;">Os pagamentos relacionados à folha de Pagamento e Benefícios são realizados pelo Banco Itaú. </span></b></p>
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">&nbsp;</span></p>
              <p><span style="font-size:10pt;">Por favor informar os dados bancários caso possua conta no&nbsp;Banco Itaú. </span></p>
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">- Enviar o comprovante dos dados bancários (pode ser um print da tela do banco no qual conste a Agência e Conta ou foto do cartão)</span></p>
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">&nbsp;</span></p>
              <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
                <span style="font-size:10pt;">Caso <u>NÃO</u> possua conta no Banco Itaú iremos encaminhar a Carta para Abertura da Conta. </span></p>
            </td>
          </tr>
        </tbody>
      </table>
      <p id='title'>Entregar as vias impressas da documentação acima destacada <strong class='sublinhe'>
          <font color='red'> até xxxxxxx às 12h</font>
        </strong>, aos cuidados de Inês Meira na Compasso Passo Fundo - Rua Coronel Chicuta, 575 – Sala 705 – Centro – Passo Fundo/RS.</p>
      <p style="font-size:11pt;font-family:Calibri,sans-serif;margin-right:0;margin-left:0;">
        <span style="background-color:yellow;">Caso a documentação e a Carteira de Trabalho não sejam entregues na data acima destacada, será necessário a alteração da data de admissão.</span> </p>
      <p id='title'> Assim que tivermos a data para seu exame admissional lhe informaremos.</p>
      <p id='title'>Por gentileza confirmar o recebimento deste e-mail</p>

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