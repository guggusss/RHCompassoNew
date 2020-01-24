<?php
require_once('../validacoes/login/user.php');
include("../db/conexao.php");
include("../update.php");
include("../static/php/RemoveMascAndFormatDate.php");

$listar = listar($conn);

$id = $_GET['id'];
$_SESSION['id'] = $id;

$resultado1 = mysqli_query($conn, "SELECT ID_USUARIO, ID_SEDE, NOME, DATE_FORMAT(DATA_ADMISSAO,'%d/%m/%Y') as DATA_ADMISSAO,STATUS FROM propostas_contratacoes as p JOIN admissao_dominio as a on p.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
$conn1 = mysqli_num_rows($resultado1);

//$count =  mysqli_num_rows($conn,"SELECT COUNT(*) FROM propostas_contratacoes WHERE ID_USUARIO = '$id'");
$resultado = mysqli_query($conn, "SELECT ID_USUARIO, DATE_FORMAT(ENQUADRAMENTO_REMUNERACAO_ENVIO,'%d/%m/%Y') as ENQUADRAMENTO_REMUNERACAO_ENVIO , DATE_FORMAT(ENQUADRAMENTO_REMUNERACAO_RETORNO,'%d/%m/%Y') as ENQUADRAMENTO_REMUNERACAO_RETORNO, DATE_FORMAT(ENQUADRAMENTO,'%d/%m/%Y') as ENQUADRAMENTO, DATE_FORMAT(ENVIO_PROPOSTA,'%d/%m/%Y') as ENVIO_PROPOSTA,
DATE_FORMAT(COMUNICAR_PROPOSTA_ENVIADA,'%d/%m/%Y') AS COMUNICAR_PROPOSTA_ENVIADA, DATE_FORMAT(ACEITE_RECUSA_CANDIDATO,'%d/%m/%Y') as ACEITE_RECUSA_CANDIDATO ,COMENTARIO, DATE_FORMAT(COMUNICAR_STATUS,'%d/%m/%Y') AS COMUNICAR_STATUS, STATUS, PROJETO from propostas_contratacoes as p LEFT JOIN admissao_dominio as a on p.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
$count = mysqli_num_rows($resultado);

if ($count == 1) {
    $resultado = mysqli_query($conn, "SELECT ID_USUARIO, DATE_FORMAT(ENQUADRAMENTO_REMUNERACAO_ENVIO,'%d/%m/%Y') as ENQUADRAMENTO_REMUNERACAO_ENVIO , DATE_FORMAT(ENQUADRAMENTO_REMUNERACAO_RETORNO,'%d/%m/%Y') as ENQUADRAMENTO_REMUNERACAO_RETORNO, DATE_FORMAT(ENQUADRAMENTO,'%d/%m/%Y') as ENQUADRAMENTO, DATE_FORMAT(ENVIO_PROPOSTA,'%d/%m/%Y') as ENVIO_PROPOSTA,
    DATE_FORMAT(COMUNICAR_PROPOSTA_ENVIADA,'%d/%m/%Y') AS COMUNICAR_PROPOSTA_ENVIADA, DATE_FORMAT(ACEITE_RECUSA_CANDIDATO,'%d/%m/%Y') as ACEITE_RECUSA_CANDIDATO ,COMENTARIO, DATE_FORMAT(COMUNICAR_STATUS,'%d/%m/%Y') AS COMUNICAR_STATUS, STATUS from propostas_contratacoes as p LEFT JOIN admissao_dominio as a on p.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
} else {
    mysqli_query($conn, "INSERT INTO `propostas_contratacoes` (`PROPOSTA_ID`, `ID_USUARIO`, `ENQUADRAMENTO_REMUNERACAO_ENVIO`, `ENQUADRAMENTO_REMUNERACAO_RETORNO`, `ENQUADRAMENTO`, `ENVIO_PROPOSTA`, `COMUNICAR_PROPOSTA_ENVIADA`, `ACEITE_RECUSA_CANDIDATO`, `COMENTARIO`, `COMUNICAR_STATUS`) VALUES (NULL, '$id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)");

    $resultado = mysqli_query($conn, "SELECT ID_USUARIO, DATE_FORMAT(ENQUADRAMENTO_REMUNERACAO_ENVIO,'%d/%m/%Y') as ENQUADRAMENTO_REMUNERACAO_ENVIO , DATE_FORMAT(ENQUADRAMENTO_REMUNERACAO_RETORNO,'%d/%m/%Y') as ENQUADRAMENTO_REMUNERACAO_RETORNO, DATE_FORMAT(ENQUADRAMENTO,'%d/%m/%Y') as ENQUADRAMENTO, DATE_FORMAT(ENVIO_PROPOSTA,'%d/%m/%Y') as ENVIO_PROPOSTA,
    DATE_FORMAT(COMUNICAR_PROPOSTA_ENVIADA,'%d/%m/%Y') AS COMUNICAR_PROPOSTA_ENVIADA, DATE_FORMAT(ACEITE_RECUSA_CANDIDATO,'%d/%m/%Y') as ACEITE_RECUSA_CANDIDATO ,COMENTARIO, DATE_FORMAT(COMUNICAR_STATUS,'%d/%m/%Y') AS COMUNICAR_STATUS, STATUS from propostas_contratacoes as p LEFT JOIN admissao_dominio as a on p.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
}

$status = buscaFuncionarios($conn, $id);
$funcionario = buscaProposta($conn, $id);
$funcionarios = buscaFuncionarios($conn, $id);
$recebida = buscaProposta($conn, $id);
$deacordo = buscaProposta($conn, $id);
$gestorL_sabe = buscagestao($conn, $id);
$enquadramento = buscaProposta($conn, $id);
$envioprop = buscaProposta($conn, $id);
$comunicarprop = buscaProposta($conn, $id);
$candidato = buscaProposta($conn, $id);
$comentario = buscaProposta($conn, $id);
$comunicar = buscaProposta($conn, $id);
$envio_Pri = buscavencimentos($conn, $id);
$formRec = buscadocs($conn, $id);
$inclui = buscaadmissao($conn, $id);
$anexar = buscaexame($conn, $id);
$form = buscaBancario($conn, $id);
$emailges = buscainterno($conn, $id);
$emailsoli = buscavias($conn, $id);
$translado = buscasuporte($conn, $id);
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
            <a class='nav inicio' href='index.php'>Início</a>
            <div class="dropdown">
                <a class="dropbtn nav">Emails <span class='caret'></span></a>
                <div class="dropdown-content">
                    <a href='../emails/body-email/admissaoPOA.php?id=<?php echo $id ?>'>5. Documentos Admissão POA</a>
                    <a href='../emails/body-email/admissaoRG.php?id=<?php echo $id ?>'>5.1 Documentos Admissão RG</a>
                    <a href='../emails/body-email/admissaoPF.php?id=<?php echo $id ?>'>5.2 Documentos de Admissão PF</a>                  
                    <a href='../emails/body-email/admissaoERE.php?id=<?php echo $id ?>'>5.3 Documentos de Admissão ERE</a>
                    <a href='../emails/body-email/admissaoCWB.php?id=<?php echo $id ?>'>5.4 Documentos de Admissão CWB</a>
                    <a href='../emails/body-email/admissaoSP_RJ.php?id=<?php echo $id ?>'>5.5 Documentos de Admissão SP</a>
                    <a href='../emails/body-email/admissaoFNL.php?id=<?php echo $id ?>'>5.6 Documentos de Admissão FLN</a>
                    <a href='../emails/body-email/admissaoRecife.php?id=<?php echo $id ?>'>5.7 Documentos de Admissão REC</a>
                    <a href='../emails/body-email/admissaoBH.php?id=<?php echo $id ?>'>5.8 Documentos de Admissão BH</a>
                    <a href='../emails/body-email/admissaoJAG.php?id=<?php echo $id ?>'>5.9 Documentos de Admissão JAG</a>
                    <a href='../emails/body-email/admissaoRJ.php?id=<?php echo $id ?>'>5.1.1 Documentos de Admissão RJ</a>
                    <a href='../emails/body-email/admissaoCAX.php?id=<?php echo $id ?>'>5.1.2 Documentos de Admissão CAX </a>
                    <a href='../emails/body-email/primeiro-alerta.php?id=<?php echo $id ?>'>7. ALERTA - 1ª Experiência expira em 45 dias</a>
                    <a href='../emails/body-email/segundo-alerta.php?id=<?php echo $id ?>'>7.1 ALERTA - 2ª Experiência expira em 90 dias</a>
                    <a href='../emails/body-email/novo-acesso.php?id=<?php echo $id ?>'>8. Novo Acesso</a>
                    <a href='../emails/body-email/acesso-liberado.php?id=<?php echo $id ?>'>9. Acessos Liberado</a>
                </div>
            </div>
            <a class='nav filter last' href='../login/user/sair.php'>Sair</a>
        </nav>

    </header>

    <main>
        <section class='menu-inicial'>
            <h2 id='nome'>Proposta de Contratação </h2>
        </section>
        <section class='container estruct'>
            <div class='menu-inicial1'>
                <table class='fixado'>
                    <thead>
                        <tr id='titulo-table1s'>
                            <th width='170px'>Status</th>
                            <th width='170px'>Nome</th>
                            <th width='170px'>Data de Admissao</th>
                            <th width='170px'>Sede</th>
                        </tr>
                    </thead>
                        <tbody>
                            <tr>
                                <?php while ($rows_dados = mysqli_fetch_assoc($resultado1)) {  ?>
                                    <th width='100px'><?php echo $rows_dados['STATUS']; ?></th>
                                    <th width='100px'><?php echo $rows_dados['NOME']; ?></th>
                                    <th width='170px'><?php echo $rows_dados['DATA_ADMISSAO']; ?></th>
                                    <th width='170px'><?php if($rows_dados['ID_SEDE'] == "1"){echo "CWB";} 
                                                            if($rows_dados['ID_SEDE'] == "2"){echo "ERE";}
                                                            if($rows_dados['ID_SEDE'] == "3"){echo "PF";}
                                                            if($rows_dados['ID_SEDE'] == "4"){echo "POA";}
                                                            if($rows_dados['ID_SEDE'] == "5"){echo "RG";}
                                                            if($rows_dados['ID_SEDE'] == "6"){echo "SP";}
                                                            if($rows_dados['ID_SEDE'] == "7"){echo "FLN";}
                                                            if($rows_dados['ID_SEDE'] == "8"){echo "XAP";}
                                                            if($rows_dados['ID_SEDE'] == "9"){echo "REC";}
                                                            if($rows_dados['ID_SEDE'] == "10"){echo "CAX";}
                                                            if($rows_dados['ID_SEDE'] == "11"){echo "RJ";}
                                                            if($rows_dados['ID_SEDE'] == "12"){echo "JAG";}
                                                            if($rows_dados['ID_SEDE'] == "13"){echo "BH";}?></th>
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
                            <a href="funcionario.php?id=<?= $id ?>" type="button" class="btn btn-success btn-circle">2</a>
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
                            <a href="viasdocumentos.php?id=<?= $id ?>" id="botao11" type="button" class="btn btn-default btn-circle">10</a>
                        </div>
                        <div title="Boas Vindas" class="stepwizard-step col-md-auto">
                            <a href="recepcao.php?id=<?= $id ?>" id="botao12" type="button" class="btn btn-default btn-circle">11</a>
                        </div>
                        <div title="Vencimento Contratos" class="stepwizard-step col-md-auto">
                            <a href="vencimentosContratos.php?id=<?= $id ?>" id="botao" type="button" class="btn btn-default btn-circle">12</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <table id='first-table'>
                <h2 id='titulo-table'></h2>
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Enquadramento remuneração envio</th>
                        <th>Enquadramento remuneração retorno</th>
                        <th width='220px'>Enquadramento<br />(Validação Ex Funcionário)</th>
                        <th>Envio da Proposta</th>
                        <th>Comunicar proposta enviada Solicitante</th>
                        <th>Aceite/recusa candidato</th>
                        <th width='300px'>Comentário</th>
                        <th>Comunicar Status da Proposta ao Solicitante</th>

                        <th width='100px'></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($rows_dados = mysqli_fetch_assoc($resultado)) {  ?>
                        <tr>
                            <td><?php echo $rows_dados['STATUS']; ?></td>
                            <td id="data"><?php echo $rows_dados['ENQUADRAMENTO_REMUNERACAO_ENVIO']; ?></td>
                            <td id="data2"><?php echo $rows_dados['ENQUADRAMENTO_REMUNERACAO_RETORNO']; ?></td>
                            <td id="data3"><?php echo $rows_dados['ENQUADRAMENTO']; ?></td>
                            <td id="data4"><?php echo $rows_dados['ENVIO_PROPOSTA']; ?></td>
                            <td id="data5"><?php echo $rows_dados['COMUNICAR_PROPOSTA_ENVIADA']; ?></td>
                            <td id="data6"><?php echo $rows_dados['ACEITE_RECUSA_CANDIDATO']; ?></td>
                            <td><?php echo $rows_dados['COMENTARIO']; ?></td>
                            <td id="data8"><?php echo $rows_dados['COMUNICAR_STATUS']; ?></td>

                            <?php unset($_GET['id']); ?>
                            <td><a title="Gestão" id="proximo" class="btn btn-default" href="gestao.php?id=<?= $id ?>"> Próximo </td>
                            <td><button title="Editar" type="button" class="bto-update btn btn-default curInputs">Editar</button></span></button></td>
                        </tr>
                    <?php  } ?>
                    <tr class='funcionario atualiza'>
                        <form method="POST" action="../alteraTelas/altera-proposta.php">
                            <input type="hidden" name="ID_USUARIO" value=<?php echo $funcionario['ID_USUARIO'] ?>>
                            <td><input class='intable' readonly name="STATUS" value='<?= $status['STATUS'] ?>'></td>
                            <td><input type='date' id="campo" class='intable' name="ENQUADRAMENTO_REMUNERACAO_ENVIO" value=<?= $recebida['ENQUADRAMENTO_REMUNERACAO_ENVIO'] ?>></td>
                            <td><input type="date" id="campo2" class='intable' name="ENQUADRAMENTO_REMUNERACAO_RETORNO" value=<?= $deacordo['ENQUADRAMENTO_REMUNERACAO_RETORNO'] ?>></td>
                            <td><input type="date" id="campo3" class='intable' name="ENQUADRAMENTO" value=<?= $enquadramento['ENQUADRAMENTO'] ?>></td>
                            <td><input type="date" id="campo4" class='intable' name="ENVIO_PROPOSTA" value=<?= $envioprop['ENVIO_PROPOSTA'] ?>></td>
                            <td><input type="date" id="campo5" class='intable' name="COMUNICAR_PROPOSTA_ENVIADA" value=<?= $comunicarprop['COMUNICAR_PROPOSTA_ENVIADA'] ?>></td>
                            <td><input type="date" id="campo6" class='intable' name="ACEITA_RECUSA_CANDIDATO" value=<?= $candidato['ACEITE_RECUSA_CANDIDATO'] ?>></td>
                            <td><input type="text" id="campo7" class='intable' name="COMENTARIO" value=<?= $comentario['COMENTARIO'] ?>></td>
                            <td><input type="date" id="campo8" class='intable' name="COMUNICAR_STATUS" value=<?= $comunicar['COMUNICAR_STATUS'] ?>></td>
                            <td></td>
                            <td><button title="Salvar" type="submit" id="salvar" class="botao-salvar btao btn btn-default" value="submit">Salvar</td>
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
    <script src='../js/desabilitaStepWizard.js'></script>
    <script>
        window.onload = function verifica() {
            let grupo = "<?= $grupo; ?>";
            /*/console.log(grupo);/*/
            let isDepartamentoRH = false;
            if (grupo == "Departamento de Recursos Humanos") {
                desbilitaStepWizard(3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
                $("#proximo").attr("disabled", true);
                $("#botao12").prop("disabled", true);
                $("#botao12").css("pointer-events", "none");
            } else {
                if (!document.getElementById("campo").value == "" && !document.getElementById("campo2").value == "" && !document.getElementById("campo3").value == "" && !document.getElementById("campo4").value == "" && !document.getElementById("campo5").value == "" && !document.getElementById("campo6").value == "" && !document.getElementById("campo8").value == "") {
                    $("#gestao, #proximo, #botao, #botao5, #botao6, #botao7, #botao8, #botao9, #botao10, #botao11").removeClass("disabled").attr("disabled", false);
                }
                if (document.getElementById("campo").value == "") {
                    $("#data").addClass("dataVazia");
                }
                if (document.getElementById("campo2").value == "") {
                    $("#data2").addClass("dataVazia");
                }
                if (document.getElementById("campo3").value == "") {
                    $("#data3").addClass("dataVazia");
                }
                if (document.getElementById("campo4").value == "") {
                    $("#data4").addClass("dataVazia");
                }
                if (document.getElementById("campo5").value == "") {
                    $("#data5").addClass("dataVazia");
                }
                if (document.getElementById("campo6").value == "") {
                    $("#data6").addClass("dataVazia");
                }
                if (document.getElementById("campo8").value == "") {
                    $("#data8").addClass("dataVazia");
                }
            }

        }
    </script>
</body>

</html>
<!-- 
&& document.getElementById("campo3").value == "" && document.getElementById("campo4").value == "" && document.getElementById("campo5").value == "" && document.getElementById("campo6").value == "" && document.getElementById("campo7").value == "" && document.getElementById("campo8").value == "" -->