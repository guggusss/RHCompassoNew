<?php
include("header.php");
require_once('../validacoes/login/user.php');
include("../db/conexao.php");
include("../update.php");
include("../static/php/RemoveMascAndFormatDate.php");

$listar = listar($conn);

if (!isset($id)) 
{
    $id = $_SESSION['id'];
}

$resultado1 = mysqli_query($conn, "SELECT ID_USUARIO, NOME, ID_SEDE, DATE_FORMAT(DATA_ADMISSAO,'%d/%m/%Y') as DATA_ADMISSAO,STATUS FROM propostas_contratacoes as p LEFT JOIN admissao_dominio as a on p.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
$conn1 = mysqli_num_rows($resultado1);


//$count =  mysqli_num_rows($conn,"SELECT COUNT(*) FROM propostas_contratacoes WHERE ID_USUARIO = '$id'");
$resultado = mysqli_query($conn, "SELECT `DOCUMENTACAO_ID`, `ID_USUARIO`, DATE_FORMAT(FORMULARIOS_ENVIADOS,'%d/%m/%Y') as FORMULARIOS_ENVIADOS, DATE_FORMAT(FORMULARIOS_RECEBIDOS,'%d/%m/%Y') as FORMULARIOS_RECEBIDOS , DATE_FORMAT(DOCUMENTOS_FISICOS,'%d/%m/%Y') as DOCUMENTOS_FISICOS, DATE_FORMAT(CTPS_RECEBIDA,'%d/%m/%Y') as CTPS_RECEBIDA, COMENTARIO
                                  FROM `documentacao` as d LEFT JOIN admissao_dominio as a on d.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
$count = mysqli_num_rows($resultado);

if ($count == 1) 
{
    $resultado = mysqli_query($conn, "SELECT `DOCUMENTACAO_ID`, `ID_USUARIO`, DATE_FORMAT(FORMULARIOS_ENVIADOS,'%d/%m/%Y') as FORMULARIOS_ENVIADOS, DATE_FORMAT(FORMULARIOS_RECEBIDOS,'%d/%m/%Y') as FORMULARIOS_RECEBIDOS , DATE_FORMAT(DOCUMENTOS_FISICOS,'%d/%m/%Y') as DOCUMENTOS_FISICOS, DATE_FORMAT(CTPS_RECEBIDA,'%d/%m/%Y') as CTPS_RECEBIDA, COMENTARIO
                                      FROM `documentacao` as d LEFT JOIN admissao_dominio as a on d.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
}
else 
{
    mysqli_query($conn, "INSERT INTO `documentacao`(`DOCUMENTACAO_ID`, `ID_USUARIO`, `FORMULARIOS_ENVIADOS`, `FORMULARIOS_RECEBIDOS`, `DOCUMENTOS_FISICOS`, `CTPS_RECEBIDA`, `COMENTARIO`) VALUES (NULL,$id,NULL,NULL,NULL,NULL,NULL)");

    $resultado = mysqli_query($conn, "SELECT `DOCUMENTACAO_ID`, `ID_USUARIO`, DATE_FORMAT(FORMULARIOS_ENVIADOS,'%d/%m/%Y') as FORMULARIOS_ENVIADOS, DATE_FORMAT(FORMULARIOS_RECEBIDOS,'%d/%m/%Y') as FORMULARIOS_RECEBIDOS , DATE_FORMAT(DOCUMENTOS_FISICOS,'%d/%m/%Y') as DOCUMENTOS_FISICOS, DATE_FORMAT(CTPS_RECEBIDA,'%d/%m/%Y') as CTPS_RECEBIDA, COMENTARIO
                                      FROM `documentacao` as d LEFT JOIN admissao_dominio as a on d.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
}

$resultadoBarr = mysqli_query($conn, "SELECT USUARIO_ID, NOME, ID_SEDE, DATE_FORMAT(DATA_ADMISSAO,'%d/%m/%Y') as DATA_ADMISSAO,STATUS FROM admissao_dominio as a where USUARIO_ID = '$id'");
$connBarr = mysqli_num_rows($resultadoBarr);
$status = buscaFuncionarios($conn, $id);
$funcionario = buscaProposta($conn, $id);
$formEnv = buscadocs($conn, $id);
$formRec = buscadocs($conn, $id);
$docfis = buscadocs($conn, $id);
$ctps = buscadocs($conn, $id);
$codRast = buscadocs($conn, $id);
$formRec = buscadocs($conn, $id);
$inclui = buscaadmissao($conn, $id);
$anexar = buscaexame($conn, $id);
$form = buscaBancario($conn, $id);
$emailges = buscainterno($conn, $id);
$emailsoli = buscavias($conn, $id);
$translado = buscasuporte($conn, $id);
$campoV = 'class="txtVazio" ';
/* $usuarios = mysql_fetch_assoc($resultado); */
?>

    <main>
        <section class='menu-inicial'>
            <h2 id='nome'>Documentação</h2>
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
                            <a href="documentacao.php?id=<?= $id ?>" type="button" id="botao5" class="btn btn-success btn-circle ">4</a>
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
                            <a href="viasdocumentos.php?id=<?= $id ?>" id="botao11" type="button" class="btn btn-default btn-circle">10</a>
                        </div>
                        <div title="Boas Vindas" class="stepwizard-step col-md-auto">
                            <a href="recepcao.php?id=<?= $id ?>" id="botao12" type="button" class="btn btn-default btn-circle">11</a>
                        </div>
                        <div title="Vencimento Contratos" class="stepwizard-step col-md-auto">
                            <a href="vencimentosContratos.php?id=<?= $id ?>" id="botao" type="button" class="btn btn-default btn-circle ">12</a>
                        </div>
                    </div>
                </div>
            </div>

            <table id='first-table'>
                <h2 id='titulo-table'></h2>
                <thead>
                    <tr>
                        <th></th>
                        <th colspan="2">E-mail formulários Admissão</th>
                        <th>Documentos físicos</th>
                        <th>CTPS</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>

                    <tr>
                        <th width='200px'>Status</th>
                        <th>Formulários Enviados</th>
                        <th>Formulários Recebidos</th>
                        <th>Cópia RG/CPF/PIS/Titulo Eleitor/<br />Declaração Oracle/Foto 3x4/<br />Comprovante endereço</th>
                        <th>CTPS Recebida</th>
                        <th>Comentários</th>                        
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php while ($rows_dados = mysqli_fetch_assoc($resultado)) {  ?>
                        <tr>
                            <td><?= $status['STATUS'] ?></td>
                            <td id="data"><?= $rows_dados['FORMULARIOS_ENVIADOS']; ?></td>
                            <td id="data2"><?= $rows_dados['FORMULARIOS_RECEBIDOS']; ?></td>
                            <td id="data3"><?= $rows_dados['DOCUMENTOS_FISICOS']; ?></td>
                            <td id="data4"><?= $rows_dados['CTPS_RECEBIDA']; ?></td>
                            <td><?= $rows_dados['COMENTARIO']; ?></td>
                            
                            <td><a title="Plataforma Admissão Domínio Dados + Fichas de Cadastro" id="proximo" class="btn btn-default" href="admissao.php?id=<?= $id ?>"> Próximo </td>
                            <td><button title="Editar" type="button" class="bto-update btn btn-default curInputs">Editar</button></span></button></td>
                        </tr><?php } ?>

                    <tr class='funcionario atualiza'>
                        <form method="POST" action="../alteraTelas/altera-documentacao.php">
                            <input type="hidden" name="ID_USUARIO" value=<?= $funcionario['ID_USUARIO'] ?>>
                            <td><input class='intable' readonly name="STATUS" value='<?= $status['STATUS'] ?>'></td>
                            <td><input type='date' id="campo" class='intable' name="FORMULARIOS_ENVIADOS" value="<?= $formEnv['FORMULARIOS_ENVIADOS'] ?>"></td>
                            <td><input type="date" id="campo2" class='intable' name="FORMULARIOS_RECEBIDOS" value="<?= $formRec['FORMULARIOS_RECEBIDOS'] ?>"></td>
                            <td><input type="date" id="campo3" class='intable' name="DOCUMENTOS_FISICOS" value="<?= $docfis['DOCUMENTOS_FISICOS'] ?>"></td>
                            <td><input type="date" id="campo4" class='intable' name="CTPS_RECEBIDA" value="<?= $ctps['CTPS_RECEBIDA'] ?>"></td>
                            <td><input type="text" class='intable' name="COMENTARIO" value="<?= $ctps['COMENTARIO'] ?>"></td>
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