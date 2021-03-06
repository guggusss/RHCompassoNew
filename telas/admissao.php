  
<?php
require_once('../validacoes/login/user.php');
include("../db/conexao.php");
include("../update.php");
include("../static/php/RemoveMascAndFormatDate.php");
include("header.php"); 
$listar = listar($conn);

if($grupo == "Suporte Interno"){
    if(!isset($_SERVER['HTTP_REFERER'])){
        header('location:index.php');
        exit;
    }
}

if($grupo == "Gestores"){
    if(!isset($_SERVER['HTTP_REFERER'])){
        header('location:index.php');
        exit;
    }
}

if($grupo == "Compasso - RH Integração"){
    if(!isset($_SERVER['HTTP_REFERER'])){
        header('location:index.php');
        exit;
    }
}


if (!isset($id)) {
    $id = $_SESSION['id'];
}

$resultado1 = mysqli_query($conn, "SELECT ID_USUARIO, NOME, ID_SEDE, DATE_FORMAT(DATA_ADMISSAO,'%d/%m/%Y') as DATA_ADMISSAO,STATUS FROM propostas_contratacoes as p LEFT JOIN admissao_dominio as a on p.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
$conn1 = mysqli_num_rows($resultado1);


$resultado = mysqli_query($conn, "SELECT `ID_PLATAFORMA_ADM_DOMIN`, `ID_USUARIO`, DATE_FORMAT(QUALIFIC_CADASTRAL_CEP,'%d/%m/%Y') as QUALIFIC_CADASTRAL_CEP, DATE_FORMAT(CAD_ADM_PLATAFORMA_ADM_DIMIN,'%d/%m/%Y') as CAD_ADM_PLATAFORMA_ADM_DIMIN,  DATE_FORMAT(DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO,'%d/%m/%Y') as DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO,
 DATE_FORMAT(TERMO_PSI,'%d/%m/%Y') as TERMO_PSI,DATE_FORMAT(INCLUI_ADM_PROV,'%d/%m/%Y') as INCLUI_ADM_PROV, `COMENTARIO` FROM `admissao` as p LEFT JOIN admissao_dominio as a on p.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
$count = mysqli_num_rows($resultado);

if ($count == 1) 
{
    $resultado = mysqli_query($conn, "SELECT `ID_PLATAFORMA_ADM_DOMIN`, `ID_USUARIO`, DATE_FORMAT(QUALIFIC_CADASTRAL_CEP,'%d/%m/%Y') as QUALIFIC_CADASTRAL_CEP, DATE_FORMAT(CAD_ADM_PLATAFORMA_ADM_DIMIN,'%d/%m/%Y') as CAD_ADM_PLATAFORMA_ADM_DIMIN,  DATE_FORMAT(DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO,'%d/%m/%Y') as DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO,
    DATE_FORMAT(TERMO_PSI,'%d/%m/%Y') as TERMO_PSI,DATE_FORMAT(INCLUI_ADM_PROV,'%d/%m/%Y') as INCLUI_ADM_PROV, `COMENTARIO` FROM `admissao` as p LEFT JOIN admissao_dominio as a on p.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
} 
else 
{
    mysqli_query($conn, "INSERT INTO `admissao`(`ID_PLATAFORMA_ADM_DOMIN`, `ID_USUARIO`, `QUALIFIC_CADASTRAL_CEP`, `CAD_ADM_PLATAFORMA_ADM_DIMIN`, `DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO`, `TERMO_PSI`, `INCLUI_ADM_PROV`, `COMENTARIO`) VALUES (NULL,$id,NULL,NULL,NULL,NULL,NULL,NULL)");

    $resultado = mysqli_query($conn, "SELECT `ID_PLATAFORMA_ADM_DOMIN`, `ID_USUARIO`, DATE_FORMAT(QUALIFIC_CADASTRAL_CEP,'%d/%m/%Y') as QUALIFIC_CADASTRAL_CEP, DATE_FORMAT(CAD_ADM_PLATAFORMA_ADM_DIMIN,'%d/%m/%Y') as CAD_ADM_PLATAFORMA_ADM_DIMIN,  DATE_FORMAT(DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO,'%d/%m/%Y') as DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO,
    DATE_FORMAT(TERMO_PSI,'%d/%m/%Y') as TERMO_PSI,DATE_FORMAT(INCLUI_ADM_PROV,'%d/%m/%Y') as INCLUI_ADM_PROV, `COMENTARIO` FROM `admissao` as p LEFT JOIN admissao_dominio as a on p.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
}

$resultadoBarr = mysqli_query($conn, "SELECT USUARIO_ID, NOME, ID_SEDE, DATE_FORMAT(DATA_ADMISSAO,'%d/%m/%Y') as DATA_ADMISSAO,STATUS FROM admissao_dominio as a where USUARIO_ID = '$id'");

$connBarr = mysqli_num_rows($resultadoBarr);
$status = buscaFuncionarios($conn, $id);
$funcionario = buscaProposta($conn, $id);
$quali = buscaadmissao($conn, $id);
$cad = buscaadmissao($conn, $id);
$doc = buscaadmissao($conn, $id);
$termo = buscaadmissao($conn, $id);
$inclui = buscaadmissao($conn, $id);
$formRec = buscadocs($conn, $id);
$anexar = buscaexame($conn, $id);
$form = buscaBancario($conn, $id);
$emailges = buscainterno($conn, $id);
$emailsoli = buscavias($conn, $id);
$translado = buscasuporte($conn, $id);
$comentario = buscaadmissao($conn, $id);
$campoV = 'class="txtVazio" ';
?>

    <main>

        <section class='menu-inicial'>
            <h2 id='nome'>Plataforma Admissão Domínio Dados + Fichas de Cadastro</h2>
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
                            <a href="documentacao.php?id=<?= $id ?>" type="button" id="botao5" class="btn btn-default btn-circle ">4</a>
                        </div>
                        <div title="Plataforma Admissão Domínio Dados + Fichas de Cadastro" class="stepwizard-step col-md-auto">
                            <a href="admissao.php?id=<?= $id ?>" type="button" id="botao6" class="btn btn-success btn-circle">5</a>
                        </div>
                        <div title="Exame Admissional" class="stepwizard-step col-md-auto">
                            <a href="exame.php?id=<?= $id ?>" type="button" id="botao7" class="btn btn-default  btn-circle">6</a>
                        </div>
                        <div title="Dados Bancários" class="stepwizard-step col-md-auto">
                            <a href="bancarios.php?id=<?= $id ?>" type="button" id="botao8" class="btn btn-default  btn-circle">7</a>
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
                            <a href="vencimentosContratos.php?id=<?= $id ?>" id="botao" type="button" class="btn btn-default btn-circle  ">12</a>
                        </div>
                    </div>
                </div>
            </div>

            <table id='first-table'>
                <h2 id='titulo-table'></h2>
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Qualificação Cadastral e CEP</th>
                        <th>Cadastrada Admissão<br /> Plataforma Domínio</th>
                        <th>Documentos Recebidos Plataforma<br /> Domínio + Validação CBO</th>
                        <th>Termo PSI</th>
                        <th>Incluir Admissão na Provisória</th>
                        <th>Comentarios</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php while ($rows_dados = mysqli_fetch_assoc($resultado)) {  ?>
                        <tr>
                            <td><?= $status['STATUS'] ?></td>
                            <td id="data"><?= $rows_dados['QUALIFIC_CADASTRAL_CEP']; ?></td>
                            <td id="data2"><?= $rows_dados['CAD_ADM_PLATAFORMA_ADM_DIMIN']; ?></td>
                            <td id="data3"><?= $rows_dados['DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO']; ?></td>
                            <td id="data4"><?= $rows_dados['TERMO_PSI']; ?></td>
                            <td id="data5"><?= $rows_dados['INCLUI_ADM_PROV']; ?></td>
                            <td><?= $rows_dados['COMENTARIO']; ?></td>

                            <td><a title="Exame Admissional" id="proximo" class="btn btn-default" href="exame.php?id=<?= $id ?>"> Próximo </td>
                            <td><button title="Editar" type="button" class="bto-update btn btn-default curInputs">Editar</button></span></button></td>
                        </tr><?php } ?>

                    <tr class='funcionario atualiza'>
                        <form method="POST" action="../alteraTelas/altera-admissao.php">
                            <input type="hidden" name="ID_USUARIO" value="<?= $funcionario['ID_USUARIO'] ?>">
                            <td><input class='intable' readonly name="STATUS" value='<?= $status['STATUS'] ?>'></td>
                            <td><input type='date' id="campo" class='intable' name="QUALIFIC_CADASTRAL_CEP" value="<?= $quali['QUALIFIC_CADASTRAL_CEP'] ?>"></td>
                            <td><input type="date" id="campo2" class='intable' name="CAD_ADM_PLATAFORMA_ADM_DIMIN" value="<?= $cad['CAD_ADM_PLATAFORMA_ADM_DIMIN'] ?>"></td>
                            <td><input type="date" id="campo3" class='intable' name="DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO" value="<?= $doc['DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO'] ?>"></td>
                            <td><input type="date" id="campo4" class='intable' name="TERMO_PSI" value="<?= $termo['TERMO_PSI'] ?>"></td>
                            <td><input type="date" id="campo5" class='intable' name="INCLUI_ADM_PROV" value="<?= $inclui['INCLUI_ADM_PROV'] ?>"></td>
                            <td id='COMENTARIO'><input class='intable' type="text" name="COMENTARIO" value="<?= $comentario['COMENTARIO'] ?>"></td>
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
