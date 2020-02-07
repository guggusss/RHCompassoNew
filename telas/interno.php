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

$resultado = mysqli_query($conn, "SELECT `ID_INTERNO`, `ID_USUARIO`,DATE_FORMAT(INTRANET_CADASTRO_USUARIO,'%d/%m/%Y') as INTRANET_CADASTRO_USUARIO, `INTRANET_CADASTRO_SENHA`,DATE_FORMAT(KAIROS_CADASTRO_USUARIO,'%d/%m/%Y') as KAIROS_CADASTRO_USUARIO, `KAIROS_CADASTRO_SENHA`, DATE_FORMAT(EMAIL_GESTOR_APOIO_SEDE,'%d/%m/%Y') as EMAIL_GESTOR_APOIO_SEDE, DATE_FORMAT(EMAIL_INICIO_ATIVIDADES,'%d/%m/%Y') as EMAIL_INICIO_ATIVIDADES, DATE_FORMAT(EMAIL_BOAS_VINDAS,'%d/%m/%Y') as EMAIL_BOAS_VINDAS, DATE_FORMAT(ACESSOS,'%d/%m/%Y') as ACESSOS, INTERNO_OBS
FROM `interno` AS i LEFT JOIN admissao_dominio AS a ON i.ID_USUARIO = a.USUARIO_ID WHERE ID_USUARIO = '$id'");
$count = mysqli_num_rows($resultado);

if ($count == 1) {
    $resultado = mysqli_query($conn, "SELECT `ID_INTERNO`, `ID_USUARIO`,DATE_FORMAT(INTRANET_CADASTRO_USUARIO,'%d/%m/%Y') as INTRANET_CADASTRO_USUARIO, `INTRANET_CADASTRO_SENHA`,DATE_FORMAT(KAIROS_CADASTRO_USUARIO,'%d/%m/%Y') as KAIROS_CADASTRO_USUARIO, `KAIROS_CADASTRO_SENHA`, DATE_FORMAT(EMAIL_GESTOR_APOIO_SEDE,'%d/%m/%Y') as EMAIL_GESTOR_APOIO_SEDE, DATE_FORMAT(EMAIL_INICIO_ATIVIDADES,'%d/%m/%Y') as EMAIL_INICIO_ATIVIDADES, DATE_FORMAT(EMAIL_BOAS_VINDAS,'%d/%m/%Y') as EMAIL_BOAS_VINDAS, DATE_FORMAT(ACESSOS,'%d/%m/%Y') as ACESSOS, INTERNO_OBS
    FROM `interno` AS i LEFT JOIN admissao_dominio AS a ON i.ID_USUARIO = a.USUARIO_ID WHERE ID_USUARIO = '$id'");
} else {
    mysqli_query($conn, "INSERT INTO `interno`(`ID_INTERNO`, `ID_USUARIO`, `INTRANET_CADASTRO_USUARIO`, `INTRANET_CADASTRO_SENHA`, `KAIROS_CADASTRO_USUARIO`, `KAIROS_CADASTRO_SENHA`, `EMAIL_GESTOR_APOIO_SEDE`, `EMAIL_INICIO_ATIVIDADES`, `EMAIL_BOAS_VINDAS`, `ACESSOS`, `INTERNO_OBS`) VALUES (NULL, '$id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)");

    $resultado = mysqli_query($conn, "SELECT `ID_INTERNO`, `ID_USUARIO`,DATE_FORMAT(INTRANET_CADASTRO_USUARIO,'%d/%m/%Y') as INTRANET_CADASTRO_USUARIO, `INTRANET_CADASTRO_SENHA`,DATE_FORMAT(KAIROS_CADASTRO_USUARIO,'%d/%m/%Y') as KAIROS_CADASTRO_USUARIO, `KAIROS_CADASTRO_SENHA`, DATE_FORMAT(EMAIL_GESTOR_APOIO_SEDE,'%d/%m/%Y') as EMAIL_GESTOR_APOIO_SEDE, DATE_FORMAT(EMAIL_INICIO_ATIVIDADES,'%d/%m/%Y') as EMAIL_INICIO_ATIVIDADES, DATE_FORMAT(EMAIL_BOAS_VINDAS,'%d/%m/%Y') as EMAIL_BOAS_VINDAS, DATE_FORMAT(ACESSOS,'%d/%m/%Y') as ACESSOS, INTERNO_OBS
    FROM `interno` AS i LEFT JOIN admissao_dominio AS a ON i.ID_USUARIO = a.USUARIO_ID WHERE ID_USUARIO = '$id'");
}

$resultadoBarr = mysqli_query($conn, "SELECT USUARIO_ID, NOME, ID_SEDE, DATE_FORMAT(DATA_ADMISSAO,'%d/%m/%Y') as DATA_ADMISSAO,STATUS FROM admissao_dominio as a where USUARIO_ID = '$id'");
$connBarr = mysqli_num_rows($resultadoBarr);

$status = buscaFuncionarios($conn, $id);
$funcionario = buscainterno($conn, $id);
$intranetusu = buscainterno($conn, $id);
$intranetsen = buscainterno($conn, $id);
$kairosusu = buscainterno($conn, $id);
$kairossen = buscainterno($conn, $id);
$emailges = buscainterno($conn, $id);
$emailboas = buscainterno($conn, $id);
$emailinic = buscainterno($conn, $id);
$acessos = buscainterno($conn, $id);
$campoV = 'class="txtVazio" ';
/* $usuarios = mysql_fetch_assoc($resultado); */
include("header.php"); ?>


    <main>
        <section class='menu-inicial'>
            <h2 id='nome'>Interno</h2>
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
                            <a href="gestao.php?id=<?= $id ?>" id="gestao" type="button" class="btn btn-default btn-circle ">3</a>
                        </div>
                        <div title="Documentação" class="stepwizard-step col-md-auto">
                            <a href="documentacao.php?id=<?= $id ?>" type="button" id="botao5" class="btn btn-default btn-circle ">4</a>
                        </div>
                        <div title="Plataforma Admissão Domínio Dados + Fichas de Cadastro" class="stepwizard-step col-md-auto">
                            <a href="admissao.php?id=<?= $id ?>" type="button" id="botao6" class="btn btn-default  btn-circle">5</a>
                        </div>
                        <div title="Exame Admissional" class="stepwizard-step col-md-auto">
                            <a href="exame.php?id=<?= $id ?>" type="button" id="botao7" class="btn btn-default  btn-circle">6</a>
                        </div>
                        <div title="Dados Bancários" class="stepwizard-step col-md-auto">
                            <a href="bancarios.php?id=<?= $id ?>" type="button" id="botao8" class="btn btn-default  btn-circle">7</a>
                        </div>
                        <div title="Suporte Interno" class="stepwizard-step col-md-auto">
                            <a href="suporteinterno.php?id=<?= $id ?>" id="botao9" type="button" class="btn btn-default  btn-circle">8</a>
                        </div>
                        <div title="Interno" class="stepwizard-step col-md-auto">
                            <a href="interno.php?id=<?= $id ?>" id="botao10" type="button" class="btn btn-success  btn-circle">9</a>
                        </div>
                        <div title="Vias Documentos funcionários" class="stepwizard-step col-md-auto">
                            <a href="viasdocumentos.php?id=<?= $id ?>" id="botao11" type="button" class="btn btn-default  btn-circle">10</a>
                        </div>
                        <div title="Boas Vindas" class="stepwizard-step col-md-auto">
                            <a href="recepcao.php?id=<?= $id ?>" id="botao12" type="button" class="btn btn-default btn-circle">11</a>
                        </div>
                        <div title="Vencimento Contratos" class="stepwizard-step col-md-auto">
                            <a href="vencimentosContratos.php?id=<?= $id ?>" id="botao" type="button" class="btn btn-default btn-circle  ">12</a>
                        </div>
                    </div>
                </div>
            </div>
            <table id='first-table'>
                <h2 id='titulo-table'></h2>
                <thead>
                    <tr>
                        <th></th>
                        <th colspan='2'>Intranet</th>
                        <th colspan='2'>Kairos</th>
                        <th colspan='3'>E-mail</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th width='200px'>Status</th>
                        <th>Cadastro Usuário</th>
                        <th>Senha</th>
                        <th>Cadastro Usuário</th>
                        <th>Código/Senha</th>
                        <th>Gestor + Apoio Sede</th>
                        <th>E-mail Início<br /> das Atividades</th>
                        <th>E-mail Boas Vindas</th>
                        <th>Acessos</th>
                        <th>Observações</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($rows_dados = mysqli_fetch_assoc($resultado)) {  ?>
                        <tr>
                            <td><?= $status['STATUS'] ?></td>
                            <td id="data"><?= $rows_dados['INTRANET_CADASTRO_USUARIO']; ?></td>
                            <td <?php if($rows_dados['INTRANET_CADASTRO_SENHA'] == "") {echo ($campoV);} ?>><?= $rows_dados['INTRANET_CADASTRO_SENHA']; ?></td>
                            <td id="data2"><?= $rows_dados['KAIROS_CADASTRO_USUARIO']; ?></td>
                            <td <?php if($rows_dados['KAIROS_CADASTRO_SENHA'] == "") {  echo ($campoV);} ?>><?= $rows_dados['KAIROS_CADASTRO_SENHA']; ?></td>
                            <td id="data3"><?= $rows_dados['EMAIL_GESTOR_APOIO_SEDE']; ?></td>
                            <td id="data4"><?= $rows_dados['EMAIL_INICIO_ATIVIDADES']; ?></td>
                            <td id="data5"><?= $rows_dados['EMAIL_BOAS_VINDAS']; ?></td>
                            <td id="data6"><?= $rows_dados['ACESSOS']; ?></td>
                            <td><?= $rows_dados['INTERNO_OBS']; ?></td>

                            <td><a title="Vias Documentos Funcionários" id="proximo" class="  btn btn-default" href="viasdocumentos.php?id=<?= $id ?>"> Próximo </td>
                            <td><button title="Editar" type="button" class="bto-update btn btn-default curInputs">Editar</button></span></button></td>
                        </tr><?php } ?>

                    <tr class='funcionario atualiza'>
                        <form method="POST" action="../alteraTelas/altera-interno.php">
                            <input type="hidden" name="ID_USUARIO" value=<?= $funcionario['ID_USUARIO'] ?>>
                            <td><input class='intable' readonly name="STATUS"                                    value='<?= $status['STATUS'] ?>'></td>
                            <td><input type='date' id="campo"  class='intable'  name="INTRANET_CADASTRO_USUARIO" value="<?= $intranetusu['INTRANET_CADASTRO_USUARIO'] ?>"></td>
                            <td><input type="text" class='intable' name="INTRANET_CADASTRO_SENHA"                value="<?= $intranetsen['INTRANET_CADASTRO_SENHA'] ?>"></td>
                            <td><input type="date" id="campo2" class='intable' name="KAIROS_CADASTRO_USUARIO"    value="<?= $kairosusu['KAIROS_CADASTRO_USUARIO'] ?>"></td>
                            <td><input type="text" class='intable' name="KAIROS_CADASTRO_SENHA"                  value="<?= $kairossen['KAIROS_CADASTRO_SENHA'] ?>"></td>
                            <td><input type="date" id="campo3" class='intable' name="EMAIL_GESTOR_APOIO_SEDE"    value="<?= $emailges['EMAIL_GESTOR_APOIO_SEDE'] ?>"></td>
                            <td><input type='date' id="campo4" class='intable' name="EMAIL_INICIO_ATIVIDADES"    value="<?= $emailinic['EMAIL_INICIO_ATIVIDADES'] ?>"></td>
                            <td><input type="date" id="campo5" class='intable' name="EMAIL_BOAS_VINDAS"          value="<?= $emailboas['EMAIL_BOAS_VINDAS'] ?>"></td>
                            <td><input type='date' id="campo6" class='intable' name="ACESSOS"                    value="<?= $acessos['ACESSOS'] ?>"></td>
                            <td><input class='intable' id='interno_obs' name="INTERNO_OBS"                       value="<?= $acessos['INTERNO_OBS'] ?>"></td>
                            <td></td>

                            <td><button title="Salvar" type="submit" class="botao-salvar btao btn btn-default">Salvar</td>
                        </form>
                    </tr>
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