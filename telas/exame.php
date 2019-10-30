<?php

require_once('../validacoes/login/user.php');
include("../db/conexao.php");
include("../update.php");

$listar = listar($conn);

if (!isset($id)) {
    $id = $_SESSION['id'];
}

$resultado1 = mysqli_query($conn, "SELECT ID_USUARIO, NOME,DATE_FORMAT(DATA_ADMISSAO,'%d/%m/%Y') as DATA_ADMISSAO,STATUS FROM propostas_contratacoes as p LEFT JOIN admissao_dominio as a on p.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
$conn1 = mysqli_num_rows($resultado1);


$resultado = mysqli_query($conn, "SELECT `ID_EXAME_ADMISSIONAL`, `ID_USUARIO`, DATE_FORMAT(AGENDAMENTO_EXAM_ADM,'%d/%m/%Y') as AGENDAMENTO_EXAM_ADM,DATE_FORMAT(ENVIO_FUNC_EXAME,'%d/%m/%Y') as ENVIO_FUNC_EXAME, DATE_FORMAT(EMAIL_RECEBIDO_EXAM,'%d/%m/%Y') as EMAIL_RECEBIDO_EXAM
FROM `exame_admissional` as e LEFT JOIN admissao_dominio as a on e.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
$count = mysqli_num_rows($resultado);

if ($count == 1) {
    $resultado = mysqli_query($conn, "SELECT `ID_EXAME_ADMISSIONAL`, `ID_USUARIO`, DATE_FORMAT(AGENDAMENTO_EXAM_ADM,'%d/%m/%Y') as AGENDAMENTO_EXAM_ADM,DATE_FORMAT(ENVIO_FUNC_EXAME,'%d/%m/%Y') as ENVIO_FUNC_EXAME, DATE_FORMAT(EMAIL_RECEBIDO_EXAM,'%d/%m/%Y') as EMAIL_RECEBIDO_EXAM
    FROM `exame_admissional` as e LEFT JOIN admissao_dominio as a on e.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
} else {
    mysqli_query($conn, "INSERT INTO `exame_admissional`(`ID_EXAME_ADMISSIONAL`, `ID_USUARIO`, `AGENDAMENTO_EXAM_ADM`, `ENVIO_FUNC_EXAME`, `EMAIL_RECEBIDO_EXAM`) VALUES (NULL, $id,NULL,NULL,NULL)");

    $resultado = mysqli_query($conn, "SELECT `ID_EXAME_ADMISSIONAL`, `ID_USUARIO`, DATE_FORMAT(AGENDAMENTO_EXAM_ADM,'%d/%m/%Y') as AGENDAMENTO_EXAM_ADM,DATE_FORMAT(ENVIO_FUNC_EXAME,'%d/%m/%Y') as ENVIO_FUNC_EXAME, DATE_FORMAT(EMAIL_RECEBIDO_EXAM,'%d/%m/%Y') as EMAIL_RECEBIDO_EXAM
    FROM `exame_admissional` as e LEFT JOIN admissao_dominio as a on e.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
}

$status = buscaFuncionarios($conn, $id);
$funcionario = buscaProposta($conn, $id);
$agend = buscaexame($conn, $id);
$envio = buscaexame($conn, $id);
$email = buscaexame($conn, $id);
$formRec = buscadocs($conn, $id);
$form = buscaBancario($conn, $id);
$emailges = buscainterno($conn, $id);
$emailsoli = buscavias($conn, $id);

?>



<!DOCTYPE html>
<html lang="pt">

<?php echo file_get_contents("telasHeader.html"); ?>

<body>
    <main>
        <section class='menu-inicial'>
            <h2 id='nome'>Exame Admissional</h2>
        </section>
        <section class='container estruct'>
            <div class='menu-inicial1'>
                <table class="fixado">
                    <thead>
                        <tr id='titulo-table1s'>
                            <th width='170px'>Status</th>
                            <th width='170px'>Nome</th>
                            <th width='170px'>Data de Admissao</th>
                        </tr>
                        <thead>
                        <tbody>
                            <tr>
                                <?php while ($rows_dados = mysqli_fetch_assoc($resultado1)) {  ?>
                                    <th width='100px'><?php echo $rows_dados['STATUS']; ?></th>
                                    <th width='100px'><?php echo $rows_dados['NOME']; ?></th>
                                    <th width='170px'><?php echo $rows_dados['DATA_ADMISSAO']; ?></th>
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
                            <a title="Menu Principal" href="menuPrincipal.php?id=<?= $id ?>" type="button" class="btn btn-default btn-circle">1</a>
                        </div>
                        <div title="Proposta de Contratação" class="stepwizard-step col-md-auto">
                            <a href="funcionario.php?id=<?= $id ?>" type="button" class="btn btn-default btn-circle">2</a>
                        </div>
                        <div title="Gestão" class="stepwizard-step col-md-auto">
                            <a href="gestao.php?id=<?= $id ?>" id="gestao" type="button" class="btn btn-default btn-circle ">3</a>
                        </div>
                        <div title="Vencimento Contratos" class="stepwizard-step col-md-auto">
                            <a href="vencimentosContratos.php?id=<?= $id ?>" id="botao" type="button" class="btn btn-default btn-circle  ">4</a>
                        </div>
                        <div title="Documentação" class="stepwizard-step col-md-auto">
                            <a href="documentacao.php?id=<?= $id ?>" type="button" id="botao5" class="btn btn-default btn-circle ">5</a>
                        </div>
                        <div title="Plataforma Admissão Domínio Dados + Fichas de Cadastro" class="stepwizard-step col-md-auto">
                            <a href="admissao.php?id=<?= $id ?>" type="button" id="botao6" class="btn btn-default  btn-circle">6</a>
                        </div>
                        <div title="Exame Admissional" class="stepwizard-step col-md-auto">
                            <a href="exame.php?id=<?= $id ?>" type="button" id="botao7" class="btn btn-success  btn-circle">7</a>
                        </div>
                        <div title="Dados Bancários" class="stepwizard-step col-md-auto">
                            <a href="bancarios.php?id=<?= $id ?>" type="button" id="botao8" class="btn btn-default  btn-circle">8</a>
                        </div>
                        <div title="Suporte Interno" class="stepwizard-step col-md-auto">
                            <a href="suporteinterno.php?id=<?= $id ?>" id="botao9" type="button" class="btn btn-default  btn-circle">9</a>
                        </div>
                        <div title="Interno" class="stepwizard-step col-md-auto">
                            <a href="interno.php?id=<?= $id ?>" id="botao10" type="button" class="btn btn-default  btn-circle">10</a>
                        </div>
                        <div title="Vias Documentos funcionários" class="stepwizard-step col-md-auto">
                            <a href="viasdocumentos.php?id=<?= $id ?>" id="botao11" type="button" class="btn btn-default  btn-circle">11</a>
                        </div>
                        <div title="Boas Vindas" class="stepwizard-step col-md-auto">
                            <a href="recepcao.php?id=<?= $id ?>" id="botao12" type="button" class="btn btn-default btn-circle">12</a>
                        </div>
                    </div>
                </div>
            </div>
            <table id='first-table'>
                <h2 id='titulo-table'></h2>
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Agendamento</th>
                        <th>Envio para funcionário</th>
                        <th>Recebido por e-mail ASO assinado</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($rows_dados = mysqli_fetch_assoc($resultado)) {  ?>
                        <tr>
                            <td><?= $status['STATUS'] ?></td>
                            <td id="data"><?php echo $rows_dados['AGENDAMENTO_EXAM_ADM']; ?></td>
                            <td id="data2"><?php echo $rows_dados['ENVIO_FUNC_EXAME']; ?></td>
                            <td id="data3"><?php echo $rows_dados['EMAIL_RECEBIDO_EXAM']; ?></td>
                            <td><a title="Dados Bancáriso" id="proximo" class="  btn btn-default" href="bancarios.php?id=<?= $id ?>"> Próximo </td>
                            <td><button title="Editar" type="button" class="bto-update btn btn-default curInputs">Editar</button></span></button></td>
                        </tr>
                    <?php } ?>
                    <tr class='funcionario atualiza'>
                        <form method="POST" action="../alteraTelas/altera-exame.php">
                            <input type="hidden" name="ID_USUARIO" value="<?php echo $funcionario['ID_USUARIO'] ?>">
                            <td><input class='intable' readonly name="STATUS" value='<?= $status['STATUS'] ?>'></td>
                            <td><input type='date' id="campo" class='intable' name="AGENDAMENTO_EXAM_ADM" value="<?= $agend['AGENDAMENTO_EXAM_ADM'] ?>"></td>
                            <td><input type="date" id="campo2" class='intable' name="ENVIO_FUNC_EXAME" value="<?= $envio['ENVIO_FUNC_EXAME'] ?>"></td>
                            <td><input type="date" id="campo3" class='intable' name="EMAIL_RECEBIDO_EXAM" value="<?= $email['EMAIL_RECEBIDO_EXAM'] ?>"></td>
                            <td></td>
                            <td><button title="Salvar" type="submit" class="botao-salvar btao btn btn-default">Salvar</td>
                        </form>
                    </tr>
                </tbody>
            </table>
        </section>
        <?php echo file_get_contents("telasLegendas.html"); ?>
    </main>
    <footer>
        <h2></h2>
    </footer>
    <script src="../js/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../js/funcionamento.js"></script>
    <script src="../js/filter.js"></script>
    <script>
        window.onload = function verifica() {
            if (document.getElementById("campo").value == "") {
                $("#data").addClass("dataVazia");
            }
            if (document.getElementById("campo2").value == "") {
                $("#data2").addClass("dataVazia");
            }
            if (document.getElementById("campo3").value == "") {
                $("#data3").addClass("dataVazia");
            }
            /*/if(document.getElementById("campo4").value == ""){
                $("#data4").addClass("dataVazia");
            }/*/
        }
    </script>

</body>

</html>