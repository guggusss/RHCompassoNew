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
 DATE_FORMAT(MALOTE_CADERNO_COMPASSO_CTPS,'%d/%m/%Y') as MALOTE_CADERNO_COMPASSO_CTPS,DATE_FORMAT(DOCUMENTOS_RECEBIDOS_ASSINADOS,'%d/%m/%Y') as DOCUMENTOS_RECEBIDOS_ASSINADOS,DATE_FORMAT(SALVAR_PASTA,'%d/%m/%Y') as SALVAR_PASTA, VIAS_DOCUMENTOS_OBS FROM `vias_documentos_funcionarios` as e LEFT JOIN admissao_dominio as a on e.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
$count = mysqli_num_rows($resultado);

if ($count == 1) {
    $resultado = mysqli_query($conn, "SELECT DATE_FORMAT(CRACHA_DATA_PEDIDO,'%d/%m/%Y') as CRACHA_DATA_PEDIDO,`ID_USUARIO` , DATE_FORMAT(CRACHA_CONTROLE,'%d/%m/%Y') as CRACHA_CONTROLE, DATE_FORMAT(CRACHA_PROTOCOLO,'%d/%m/%Y') as CRACHA_PROTOCOLO, DATE_FORMAT(VIAS_DOCUMENTOS_FUNCIONARIO_ID,'%d/%m/%Y') as VIAS_DOCUMENTOS_FUNCIONARIO_ID, DATE_FORMAT(EMAIL_CADERNO_COMPASSO_SOLICITADO,'%d/%m/%Y') as EMAIL_CADERNO_COMPASSO_SOLICITADO, DATE_FORMAT(EMAIL_CADERNO_COMPASSO_RECEBIDO,'%d/%m/%Y') as EMAIL_CADERNO_COMPASSO_RECEBIDO,
    DATE_FORMAT(MALOTE_CADERNO_COMPASSO_CTPS,'%d/%m/%Y') as MALOTE_CADERNO_COMPASSO_CTPS,DATE_FORMAT(DOCUMENTOS_RECEBIDOS_ASSINADOS,'%d/%m/%Y') as DOCUMENTOS_RECEBIDOS_ASSINADOS,DATE_FORMAT(SALVAR_PASTA,'%d/%m/%Y') as SALVAR_PASTA, VIAS_DOCUMENTOS_OBS FROM `vias_documentos_funcionarios` as e LEFT JOIN admissao_dominio as a on e.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
} else {
    mysqli_query($conn, "INSERT INTO `vias_documentos_funcionarios`(`CRACHA_DATA_PEDIDO`, `CRACHA_CONTROLE`, `CRACHA_PROTOCOLO`,`VIAS_DOCUMENTOS_FUNCIONARIO_ID`, `ID_USUARIO`, `EMAIL_CADERNO_COMPASSO_SOLICITADO`, `EMAIL_CADERNO_COMPASSO_RECEBIDO`, `MALOTE_CADERNO_COMPASSO_CTPS`, `DOCUMENTOS_RECEBIDOS_ASSINADOS`, `SALVAR_PASTA`, `VIAS_DOCUMENTOS_OBS`) VALUES (NULL,NULL,NULL,NULL, $id,NULL,NULL,NULL,NULL,NULL,NULL)");

    $resultado = mysqli_query($conn, "SELECT DATE_FORMAT(CRACHA_DATA_PEDIDO,'%d/%m/%Y') as CRACHA_DATA_PEDIDO,`ID_USUARIO` , DATE_FORMAT(CRACHA_CONTROLE,'%d/%m/%Y') as CRACHA_CONTROLE, DATE_FORMAT(CRACHA_PROTOCOLO,'%d/%m/%Y') as CRACHA_PROTOCOLO, DATE_FORMAT(VIAS_DOCUMENTOS_FUNCIONARIO_ID,'%d/%m/%Y') as VIAS_DOCUMENTOS_FUNCIONARIO_ID, DATE_FORMAT(EMAIL_CADERNO_COMPASSO_SOLICITADO,'%d/%m/%Y') as EMAIL_CADERNO_COMPASSO_SOLICITADO, DATE_FORMAT(EMAIL_CADERNO_COMPASSO_RECEBIDO,'%d/%m/%Y') as EMAIL_CADERNO_COMPASSO_RECEBIDO,
    DATE_FORMAT(MALOTE_CADERNO_COMPASSO_CTPS,'%d/%m/%Y') as MALOTE_CADERNO_COMPASSO_CTPS,DATE_FORMAT(DOCUMENTOS_RECEBIDOS_ASSINADOS,'%d/%m/%Y') as DOCUMENTOS_RECEBIDOS_ASSINADOS,DATE_FORMAT(SALVAR_PASTA,'%d/%m/%Y') as SALVAR_PASTA, VIAS_DOCUMENTOS_OBS FROM `vias_documentos_funcionarios` as e LEFT JOIN admissao_dominio as a on e.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
}

$resultadoBarr = mysqli_query($conn, "SELECT USUARIO_ID, NOME, ID_SEDE, DATE_FORMAT(DATA_ADMISSAO,'%d/%m/%Y') as DATA_ADMISSAO,STATUS FROM admissao_dominio as a where USUARIO_ID = '$id'");
$connBarr = mysqli_num_rows($resultadoBarr);

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
<? include("includes/header.php") ?>
    <main>
        <section class='menu-inicial'>
            <h2 id='nome'>Vias Documentos funcionário</h2>
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
                                <?php include("includes/extensao.php"); ?>
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
                        <th>Observações</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($rows_dados = mysqli_fetch_assoc($resultado)) {  ?>
                        <tr>
                            <td><?= $status['STATUS'] ?></td>
                            <td id="data"><?php echo $rows_dados['CRACHA_DATA_PEDIDO']; ?></td>
                            <td id="data2"><?php echo $rows_dados['CRACHA_CONTROLE']; ?></td>
                            <td id="data3"><?php echo $rows_dados['CRACHA_PROTOCOLO']; ?></td>
                            <td id="data4"><?php echo $rows_dados['EMAIL_CADERNO_COMPASSO_SOLICITADO']; ?></td>
                            <td id="data5"><?php echo $rows_dados['EMAIL_CADERNO_COMPASSO_RECEBIDO']; ?></td>
                            <td id="data6"><?php echo $rows_dados['MALOTE_CADERNO_COMPASSO_CTPS']; ?></td>
                            <td id="data7"><?php echo $rows_dados['DOCUMENTOS_RECEBIDOS_ASSINADOS']; ?></td>
                            <td id="data8"><?php echo $rows_dados['SALVAR_PASTA']; ?></td>
                            <td><?php echo $rows_dados['VIAS_DOCUMENTOS_OBS']; ?></td>
                            <td><a title="Boas Vindas" href='recepcao.php?id=<?= $id ?>' class="btn btn-default">Próximo</td>
                            <td><button ttile="Editar" type="button" class="bto-update btn btn-default curInputs">Editar</button></span></button></td>
                        </tr>
                    <?php } ?>
                    <tr class='funcionario atualiza'>
                        <form method="POST" action="../alteraTelas/altera-vias.php">
                            <input type="hidden" name="ID_USUARIO" value="<?php echo $funcionario['ID_USUARIO'] ?>">
                            <td><input class='intable' readonly name="STATUS" value='<?= $status['STATUS'] ?>'></td>
                            <td><input type='date' id="campo" class='intable' name="CRACHA_DATA_PEDIDO" value="<?= $emailsoli['CRACHA_DATA_PEDIDO'] ?>"></td>
                            <td><input type='date' id="campo2" class='intable' name="CRACHA_CONTROLE" value="<?= $emailsoli['CRACHA_CONTROLE'] ?>"></td>
                            <td><input type='date' id="campo3" class='intable' name="CRACHA_PROTOCOLO" value="<?= $emailsoli['CRACHA_PROTOCOLO'] ?>"></td>
                            <td><input type='date' id="campo4" class='intable' name="EMAIL_CADERNO_COMPASSO_SOLICITADO" value="<?= $emailsoli['EMAIL_CADERNO_COMPASSO_SOLICITADO'] ?>"></td>
                            <td><input type="date" id="campo5" class='intable' name="EMAIL_CADERNO_COMPASSO_RECEBIDO" value="<?= $emailreceb['EMAIL_CADERNO_COMPASSO_RECEBIDO'] ?>"></td>
                            <td><input type="date" id="campo6" class='intable' name="MALOTE_CADERNO_COMPASSO_CTPS" value="<?= $malote['MALOTE_CADERNO_COMPASSO_CTPS'] ?>"></td>
                            <td><input type="date" id="campo7" class='intable' name="DOCUMENTOS_RECEBIDOS_ASSINADOS" value="<?= $docreceb['DOCUMENTOS_RECEBIDOS_ASSINADOS'] ?>"></td>
                            <td><input type="date" id="campo8" class='intable' name="SALVAR_PASTA" value="<?= $docreceb['SALVAR_PASTA'] ?>"></td>
                            <td><input class='intable' name="VIAS_DOCUMENTOS_OBS" value="<?= $docreceb['VIAS_DOCUMENTOS_OBS'] ?>"></td>
                            <td></td>
                            <td><button title="Salvar" type="submit" class="botao-salvar btao btn btn-default">Salvar</td>
                        </form>
                </tbody>
            </table>
        </section>
        <?php echo file_get_contents("includes/telasLegendas.html"); ?>
    </main>
    <footer>
        <h2></h2>
    </footer>
    <script src="../js/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../js/funcionamento.js"></script>
    <script src="../js/filter.js"></script>
    <script src="../js/campo-destaque.js"></script>


</body>

</html>