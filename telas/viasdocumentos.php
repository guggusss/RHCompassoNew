<?php
require_once('../validacoes/login/user.php');
include("../db/conexao.php");
include("../update.php");
include("../static/php/RemoveMascAndFormatDate.php");

$listar = listar($conn);

if (!isset($id)) {
    $id = $_SESSION['id'];
}

$resultado1 = mysqli_query($conn, "SELECT ID_USUARIO, NOME, ID_SEDE, DATE_FORMAT(DATA_ADMISSAO,'%d/%m/%Y') as DATA_ADMISSAO,STATUS FROM propostas_contratacoes as p LEFT JOIN admissao_dominio as a on p.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
$conn1 = mysqli_num_rows($resultado1);


$resultado = mysqli_query($conn, "SELECT DATE_FORMAT(CRACHA_DATA_PEDIDO,'%d/%m/%Y') as CRACHA_DATA_PEDIDO,`ID_USUARIO` , DATE_FORMAT(CRACHA_CONTROLE,'%d/%m/%Y') as CRACHA_CONTROLE, DATE_FORMAT(CRACHA_PROTOCOLO,'%d/%m/%Y') as CRACHA_PROTOCOLO, DATE_FORMAT(VIAS_DOCUMENTOS_FUNCIONARIO_ID,'%d/%m/%Y') as VIAS_DOCUMENTOS_FUNCIONARIO_ID, DATE_FORMAT(EMAIL_CADERNO_COMPASSO_SOLICITADO,'%d/%m/%Y') as EMAIL_CADERNO_COMPASSO_SOLICITADO, DATE_FORMAT(EMAIL_CADERNO_COMPASSO_RECEBIDO,'%d/%m/%Y') as EMAIL_CADERNO_COMPASSO_RECEBIDO,
 DATE_FORMAT(MALOTE_CADERNO_COMPASSO_CTPS,'%d/%m/%Y') as MALOTE_CADERNO_COMPASSO_CTPS,DATE_FORMAT(DOCUMENTOS_RECEBIDOS_ASSINADOS,'%d/%m/%Y') as DOCUMENTOS_RECEBIDOS_ASSINADOS,DATE_FORMAT(SALVAR_PASTA,'%d/%m/%Y') as SALVAR_PASTA FROM `vias_documentos_funcionarios` as e LEFT JOIN admissao_dominio as a on e.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
$count = mysqli_num_rows($resultado);

if ($count == 1) {
    $resultado = mysqli_query($conn, "SELECT DATE_FORMAT(CRACHA_DATA_PEDIDO,'%d/%m/%Y') as CRACHA_DATA_PEDIDO,`ID_USUARIO` , DATE_FORMAT(CRACHA_CONTROLE,'%d/%m/%Y') as CRACHA_CONTROLE, DATE_FORMAT(CRACHA_PROTOCOLO,'%d/%m/%Y') as CRACHA_PROTOCOLO, DATE_FORMAT(VIAS_DOCUMENTOS_FUNCIONARIO_ID,'%d/%m/%Y') as VIAS_DOCUMENTOS_FUNCIONARIO_ID, DATE_FORMAT(EMAIL_CADERNO_COMPASSO_SOLICITADO,'%d/%m/%Y') as EMAIL_CADERNO_COMPASSO_SOLICITADO, DATE_FORMAT(EMAIL_CADERNO_COMPASSO_RECEBIDO,'%d/%m/%Y') as EMAIL_CADERNO_COMPASSO_RECEBIDO,
    DATE_FORMAT(MALOTE_CADERNO_COMPASSO_CTPS,'%d/%m/%Y') as MALOTE_CADERNO_COMPASSO_CTPS,DATE_FORMAT(DOCUMENTOS_RECEBIDOS_ASSINADOS,'%d/%m/%Y') as DOCUMENTOS_RECEBIDOS_ASSINADOS,DATE_FORMAT(SALVAR_PASTA,'%d/%m/%Y') as SALVAR_PASTA FROM `vias_documentos_funcionarios` as e LEFT JOIN admissao_dominio as a on e.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
} else {
    mysqli_query($conn, "INSERT INTO `vias_documentos_funcionarios`(`CRACHA_DATA_PEDIDO`, `CRACHA_CONTROLE`, `CRACHA_PROTOCOLO`,`VIAS_DOCUMENTOS_FUNCIONARIO_ID`, `ID_USUARIO`, `EMAIL_CADERNO_COMPASSO_SOLICITADO`, `EMAIL_CADERNO_COMPASSO_RECEBIDO`, `MALOTE_CADERNO_COMPASSO_CTPS`, `DOCUMENTOS_RECEBIDOS_ASSINADOS`, `SALVAR_PASTA`) VALUES (NULL,NULL,NULL,NULL, $id,NULL,NULL,NULL,NULL,NULL)");

    $resultado = mysqli_query($conn, "SELECT DATE_FORMAT(CRACHA_DATA_PEDIDO,'%d/%m/%Y') as CRACHA_DATA_PEDIDO,`ID_USUARIO` , DATE_FORMAT(CRACHA_CONTROLE,'%d/%m/%Y') as CRACHA_CONTROLE, DATE_FORMAT(CRACHA_PROTOCOLO,'%d/%m/%Y') as CRACHA_PROTOCOLO, DATE_FORMAT(VIAS_DOCUMENTOS_FUNCIONARIO_ID,'%d/%m/%Y') as VIAS_DOCUMENTOS_FUNCIONARIO_ID, DATE_FORMAT(EMAIL_CADERNO_COMPASSO_SOLICITADO,'%d/%m/%Y') as EMAIL_CADERNO_COMPASSO_SOLICITADO, DATE_FORMAT(EMAIL_CADERNO_COMPASSO_RECEBIDO,'%d/%m/%Y') as EMAIL_CADERNO_COMPASSO_RECEBIDO,
    DATE_FORMAT(MALOTE_CADERNO_COMPASSO_CTPS,'%d/%m/%Y') as MALOTE_CADERNO_COMPASSO_CTPS,DATE_FORMAT(DOCUMENTOS_RECEBIDOS_ASSINADOS,'%d/%m/%Y') as DOCUMENTOS_RECEBIDOS_ASSINADOS,DATE_FORMAT(SALVAR_PASTA,'%d/%m/%Y') as SALVAR_PASTA FROM `vias_documentos_funcionarios` as e LEFT JOIN admissao_dominio as a on e.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
}


$status = buscaFuncionarios($conn, $id);
$funcionario = buscaProposta($conn, $id);
$emailsoli = buscavias($conn, $id);
$emailreceb = buscavias($conn, $id);
$malote = buscavias($conn, $id);
$docreceb = buscavias($conn, $id);
$campoV = 'class="txtVazio" ';
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>RH Contratações</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/arquivo.css">
    <link rel="stylesheet" href="../css/menuPrincipal.css">
</head>
<body>
<header class="site-header">
        <img src="http://www.compasso.com.br/wp-content/uploads/2018/04/Logo_Compasso_01-mini.png" alt="Compasso Tecnologia">
        <nav>
            <a class='nav inicio-total' href='index.php'>Início</a>
            <a class="nav inicio" data-toggle="modal" data-target="#myModal">Legendas</a>
            <div class="dropdown">
                <a class="dropbtn nav">Emails <span class='caret'></span></a>
                <div class="dropdown-content">
                    <a href='../emails/body-email/admissaoPOA.php?id=<?= $id ?>'>5. Documentos Admissão POA</a>
                    <a href='../emails/body-email/admissaoRG.php?id=<?= $id ?>'>5.1 Documentos Admissão RG</a>
                    <a href='../emails/body-email/admissaoPF.php?id=<?= $id ?>'>5.2 Documentos de Admissão PF</a>
                    <a href='../emails/body-email/admissaoERE.php?id=<?= $id ?>'>5.3 Documentos de Admissão ERE</a>
                    <a href='../emails/body-email/admissaoCWB.php?id=<?= $id ?>'>5.4 Documentos de Admissão CWB</a>
                    <a href='../emails/body-email/admissaoSP_RJ.php?id=<?= $id ?>'>5.5 Documentos de Admissão SP e RJ</a>
                    <a href='../emails/body-email/admissaoFNL.php?id=<?= $id ?>'>5.6 Documentos de Admissão FLN</a>
                    <a href='../emails/body-email/admissaoRecife.php?id=<?= $id ?>'>5.7 Documentos de Admissão REC</a>
                    <a href='../emails/body-email/primeiro-alerta.php?id=<?= $id ?>'>7. ALERTA - 1ª Experiência expira em 45 dias</a>
                    <a href='../emails/body-email/segundo-alerta.php?id=<?= $id ?>'>7.1 ALERTA - 2ª Experiência expira em 90 dias</a>
                    <a href='../emails/body-email/novo-acesso.php?id=<?= $id ?>'>8. Novo Acesso</a>
                    <a href='../emails/body-email/acesso-liberado.php?id=<?= $id ?>'>9. Acessos Liberado</a>
                </div>
            </div>
            <a class='nav filter last' href='../login/user/sair.php'>Sair</a>
        </nav>
        </header>
    <main>
        <section class='menu-inicial'>
            <h2 align='center' id='nome'>Vias Documentos funcionário</h2>
        </section>
        <section class='container estruct'>
            <div class='menu-inicial1'>
                <table class="fixado">
                    <thead>
                        <tr id='titulo-table1s'>
                            <th width='170px'>Status</th>
                            <th width='170px'>Nome</th>
                            <th width='170px'>Data de Admissao</th>
                            <th width='170px'>Sede</th>
                        </tr>
                        <thead>
                        <tbody>
                            <tr>
                                <?php while ($rows_dados = mysqli_fetch_assoc($resultado1)) {  ?>
                                    <th width='100px'><?= $rows_dados['STATUS']; ?></th>
                                    <th width='100px'><?= $rows_dados['NOME']; ?></th>
                                    <th width='170px'><?= $rows_dados['DATA_ADMISSAO']; ?></th>
                                    <th width='170px'><?php if($rows_dados['ID_SEDE'] == "1"){echo "CWB";} 
                                                            if($rows_dados['ID_SEDE'] == "2"){echo "ERE";}
                                                            if($rows_dados['ID_SEDE'] == "3"){echo "PF";}
                                                            if($rows_dados['ID_SEDE'] == "4"){echo "POA";}
                                                            if($rows_dados['ID_SEDE'] == "5"){echo "RG";}
                                                            if($rows_dados['ID_SEDE'] == "6"){echo "SP";}
                                                            if($rows_dados['ID_SEDE'] == "7"){echo "FLN";}
                                                            if($rows_dados['ID_SEDE'] == "8"){echo "XAP";}
                                                            if($rows_dados['ID_SEDE'] == "9"){echo "REC";}?></th>
                                <?php  } ?>
                            </tr>
                        </tbody>
                </table>
            </div>
            <div style="height: 100px;"></div>
            <div class="passos">
                <div class="stepwizard">
                    <div class="passos stepwizard-row1 setup-panel">
                        <div class="stepwizard-step col-md-auto">
                            <a title="Menu Principal" href="index.php?id=<?= $id ?>" type="button" class="btn btn-default btn-circle">1</a>
                        </div>
                        <div title="Proposta de Contratação" class="stepwizard-step col-md-auto">
                            <a href="funcionario.php?id=<?= $id ?>" type="button" class="btn btn-default btn-circle">2</a>
                        </div>

                        <div title="Gestão" class="stepwizard-step col-md-auto">
                            <a href="gestao.php?id=<?= $id ?>" id="gestao" type="button" class="btn btn-default btn-circle">3</a>
                        </div>
                        <div title="Documentação" class="stepwizard-step col-md-auto">
                            <a href="documentacao.php?id=<?= $id ?>" type="button" id="botao5" class="btn btn-default btn-circle">4</a>
                        </div>
                        <div title="Plataforma Admissão Domínio Dados + Fichas de Cadastro" class="stepwizard-step col-md-auto">
                            <a href="admissao.php?id=<?= $id ?>" type="button" id="botao6" class="btn btn-default btn-circle">5</a>
                        </div>
                        <div title="Exame Admissional" class="stepwizard-step col-md-auto">
                            <a href="exame.php?id=<?= $id ?>" type="button" id="botao7" class="btn btn-default btn-circle">6</a>
                        </div>
                        <div title="Dados Bancários" class="stepwizard-step col-md-auto">
                            <a href="bancarios.php?id=<?= $id ?>" type="button" id="botao8" class="btn btn-default btn-circle">7</a>
                        </div>
                        <div title="Suporte Interno" class="stepwizard-step col-md-auto">
                            <a href="suporteinterno.php?id=<?= $id ?>" id="botao9" type="button" class="btn btn-default btn-circle">8</a>
                        </div>
                        <div title="Interno" class="stepwizard-step col-md-auto">
                            <a href="interno.php?id=<?= $id ?>" id="botao10" type="button" class="btn btn-default btn-circle">9</a>
                        </div>
                        <div title="Vias Documentos funcionários" class="stepwizard-step col-md-auto">
                            <a href="viasdocumentos.php?id=<?= $id ?>" id="botao11" type="button" class="btn btn-success btn-circle">10</a>
                        </div>
                        <div title="Boas Vindas" class="stepwizard-step col-md-auto">
                            <a href="recepcao.php?id=<?= $id ?>" id="botao12" type="button" class="btn btn-default btn-circle">11</a>
                        </div>
                        <div title="Vencimento Contratos" class="stepwizard-step col-md-auto">
                            <a href="vencimentosContratos.php?id=<?= $id ?>" id="botao4" type="button" class="btn btn-default btn-circle ">12</a>
                        </div>
                    </div>
                </div>
            </div>

            <table id='first-table'>
                <h2 id='titulo-table'></h2>
                <thead>
                    <tr>
                        <th></th>
                        <th colspan='3'>Crachá + Cordão + Roller</th>
                        <th colspan='2'>E-mail Adm Caderno Compasso </th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <th>Pedido do crachá</th>
                        <th>Controle</th>
                        <th>Protocolo</th>
                        <th>E-mail Solicitado </th>
                        <th>Recebido</th>
                        <th>Malote (Caderno) + <br />CTPS (Controle RH)</th>
                        <th>Recebido após assinatura Escanear Docs</th>
                        <th>Salvar na Pasta</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($rows_dados = mysqli_fetch_assoc($resultado)) {  ?>
                        <tr>
                            <td><?= $status['STATUS'] ?></td>
                            <td <?php if ($malote['CRACHA_DATA_PEDIDO'] == "01-01-0101" or $rows_dados['CRACHA_DATA_PEDIDO'] == "") { echo ($campoV);} ?>><?php echo $rows_dados['CRACHA_DATA_PEDIDO']; ?></td>
                            <td <?php if ($malote['CRACHA_CONTROLE'] == "0101-01-01" or $rows_dados['CRACHA_CONTROLE'] == "") { echo ($campoV);} ?>><?php echo $rows_dados['CRACHA_CONTROLE']; ?></td>
                            <td <?php if ($malote['CRACHA_PROTOCOLO'] == "0101-01-01" or $rows_dados['CRACHA_PROTOCOLO'] == "") { echo ($campoV);} ?>><?php echo $rows_dados['CRACHA_PROTOCOLO']; ?></td>
                            <td <?php if ($malote['EMAIL_CADERNO_COMPASSO_SOLICITADO'] == "0101-01-01" or $rows_dados['EMAIL_CADERNO_COMPASSO_SOLICITADO'] == "") { echo ($campoV);} ?>><?php echo $rows_dados['EMAIL_CADERNO_COMPASSO_SOLICITADO']; ?></td>
                            <td <?php if ($malote['EMAIL_CADERNO_COMPASSO_RECEBIDO'] == "0101-01-01" or $rows_dados['EMAIL_CADERNO_COMPASSO_RECEBIDO'] == "") { echo ($campoV);} ?>><?php echo $rows_dados['EMAIL_CADERNO_COMPASSO_RECEBIDO']; ?></td>
                            <td <?php if ($malote['MALOTE_CADERNO_COMPASSO_CTPS'] == "0101-01-01" or $rows_dados['MALOTE_CADERNO_COMPASSO_CTPS'] == "") { echo ($campoV);} ?>><?php echo $rows_dados['MALOTE_CADERNO_COMPASSO_CTPS']; ?></td>
                            <td <?php if ($malote['DOCUMENTOS_RECEBIDOS_ASSINADOS'] == "0101-01-01" or $rows_dados['DOCUMENTOS_RECEBIDOS_ASSINADOS'] == "") { echo ($campoV);} ?>><?php echo $rows_dados['DOCUMENTOS_RECEBIDOS_ASSINADOS']; ?></td>
                            <td <?php if ($malote['SALVAR_PASTA'] == "0101-01-01" or $rows_dados['SALVAR_PASTA'] == "") { echo ($campoV);} ?>><?php echo $rows_dados['SALVAR_PASTA']; ?></td>
                            <td><a title="Boas Vindas" href='recepcao.php?id=<?= $id ?>' class="btn btn-default">Próximo</td>
                            <td><button ttile="Editar" type="button" class="bto-update btn btn-default curInputs">Editar</button></span></button></td>
                        </tr>
                    <?php } ?>
                    <tr class='funcionario atualiza'>
                        <form method="POST" action="../alteraTelas/altera-vias.php">
                            <input type="hidden" name="ID_USUARIO" value='<?= $funcionario['ID_USUARIO'] ?>'>
                            <td><input class='intable' readonly name="STATUS" value='<?= $status['STATUS'] ?>'></td>
                            <td><input type='date' id="campo" class='intable' name="CRACHA_DATA_PEDIDO" value='<?= $emailsoli['CRACHA_DATA_PEDIDO'] ?>'></td>
                            <td><input type='date' id="campo2" class='intable' name="CRACHA_CONTROLE" value='<?= $emailsoli['CRACHA_CONTROLE'] ?>'></td>
                            <td><input type='date' id="campo3" class='intable' name="CRACHA_PROTOCOLO" value='<?= $emailsoli['CRACHA_PROTOCOLO'] ?>'></td>
                            <td><input type='date' id="campo4" class='intable' name="EMAIL_CADERNO_COMPASSO_SOLICITADO" value='<?= $emailsoli['EMAIL_CADERNO_COMPASSO_SOLICITADO'] ?>'></td>
                            <td><input type="date" id="campo5" class='intable' name="EMAIL_CADERNO_COMPASSO_RECEBIDO" value='<?= $emailreceb['EMAIL_CADERNO_COMPASSO_RECEBIDO'] ?>'></td>
                            <td><input type="date" id="campo6" class='intable' name="MALOTE_CADERNO_COMPASSO_CTPS" value='<?= $malote['MALOTE_CADERNO_COMPASSO_CTPS'] ?>'></td>
                            <td><input type="date" id="campo7" class='intable' name="DOCUMENTOS_RECEBIDOS_ASSINADOS" value='<?= $docreceb['DOCUMENTOS_RECEBIDOS_ASSINADOS'] ?>'></td>
                            <td><input type="date" id="campo8" class='intable' name="SALVAR_PASTA" value="<?= $docreceb['SALVAR_PASTA'] ?>"></td>
                            <td></td>
                            <td><button title="Salvar" type="submit" class="botao-salvar btao btn btn-default">Salvar</td>
                        </form>
                </tbody>
            </table>
            <?= file_get_contents("telasLegendas.html"); ?>
        </section>        
    </main>
    <footer>
        <h2></h2>
    </footer>
    <script src="../js/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../js/funcionamento.js"></script>
    <script src="../js/filter.js"></script>
</body>

</html>