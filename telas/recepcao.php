<?php
require_once('../validacoes/login/user.php');
include("../db/conexao.php");
include("../update.php");
include("../static/php/RemoveMascAndFormatDate.php");

$listar = listar($conn);

if($grupo == "Suporte Interno"){
    if(!isset($_SERVER['HTTP_REFERER'])){
        header('location:../index.php');
        exit;
    }
}

$id = $_GET['id'];
if (!isset($id)) {
    $id = $_SESSION['id'];
}

$resultado1 = mysqli_query($conn, "SELECT ID_USUARIO, NOME, ID_SEDE, DATE_FORMAT(DATA_ADMISSAO,'%d/%m/%Y') as DATA_ADMISSAO,STATUS FROM propostas_contratacoes as p LEFT JOIN admissao_dominio as a on p.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
$conn1 = mysqli_num_rows($resultado1);


$resultado = mysqli_query($conn, "SELECT `ID_USUARIO`, DATE_FORMAT(BOAS_VINDAS_INGR_AGENDADA,'%d/%m/%Y') as BOAS_VINDAS_INGR_AGENDADA, DATE_FORMAT(BOAS_VINDAS_INGR_REALIZADA,'%d/%m/%Y') as BOAS_VINDAS_INGR_REALIZADA, BOAS_VINDAS_SALA, SURVEY,
  DATE_FORMAT(LAYOUT_BOAS_VINDAS_MENSAL,'%d/%m/%Y') as LAYOUT_BOAS_VINDAS_MENSAL FROM `boas_vindas` as e LEFT JOIN admissao_dominio as a on e.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
$count = mysqli_num_rows($resultado);

if ($count == 1) {
    $resultado = mysqli_query($conn, "SELECT `ID_USUARIO`, DATE_FORMAT(BOAS_VINDAS_INGR_AGENDADA,'%d/%m/%Y') as BOAS_VINDAS_INGR_AGENDADA, DATE_FORMAT(BOAS_VINDAS_INGR_REALIZADA,'%d/%m/%Y') as BOAS_VINDAS_INGR_REALIZADA, BOAS_VINDAS_SALA,SURVEY,
    DATE_FORMAT(LAYOUT_BOAS_VINDAS_MENSAL,'%d/%m/%Y') as LAYOUT_BOAS_VINDAS_MENSAL FROM `boas_vindas` as e LEFT JOIN admissao_dominio as a on e.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
} else {
    mysqli_query($conn, "INSERT INTO `boas_vindas`(`ID_USUARIO`, `BOAS_VINDAS_INGR_AGENDADA`,`BOAS_VINDAS_INGR_REALIZADA`, `BOAS_VINDAS_SALA`, `LAYOUT_BOAS_VINDAS_MENSAL`, `SURVEY`) VALUES ($id,NULL,NULL,NULL,NULL,NULL)");

    $resultado = mysqli_query($conn, "SELECT `ID_USUARIO`, DATE_FORMAT(BOAS_VINDAS_INGR_AGENDADA,'%d/%m/%Y') as BOAS_VINDAS_INGR_AGENDADA,DATE_FORMAT(BOAS_VINDAS_INGR_REALIZADA,'%d/%m/%Y') as BOAS_VINDAS_INGR_REALIZADA, BOAS_VINDAS_SALA,SURVEY,
    DATE_FORMAT(LAYOUT_BOAS_VINDAS_MENSAL,'%d/%m/%Y') as LAYOUT_BOAS_VINDAS_MENSAL FROM `boas_vindas` as e LEFT JOIN admissao_dominio as a on e.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
}

$status = buscaFuncionarios($conn, $id);

$boasVindasAcomp = buscaRecepcao($conn, $id);
$layoutBoasVindas = buscaRecepcao($conn, $id);
$boasVindasIntegrAgendada = buscaRecepcao($conn, $id);
$boasVindasIntegrRealizada = buscaRecepcao($conn, $id);
$boasVindasSala = buscaRecepcao($conn, $id);
$survey= buscaRecepcao($conn,$id);
$funcionario = buscaRecepcao($conn, $id);
$finalizado = buscaFuncionarios($conn, $id);
$formRec = buscadocs($conn, $id);
$envio_Pri = buscavencimentos($conn, $id);
$anexar = buscaexame($conn, $id);
$form = buscaBancario($conn, $id);
$emailges = buscainterno($conn, $id);
$emailsoli = buscavias($conn, $id);
$inclui = buscaadmissao($conn, $id);
$receptor = buscagestao($conn, $id);
$translado = buscasuporte($conn, $id);
$deacordo = buscaProposta($conn, $id);
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
                    <a href='../emails/body-email/admissaoSP_RJ.php?id=<?php echo $id ?>'>5.5 Documentos de Admissão SP e RJ</a>
                    <a href='../emails/body-email/admissaoFNL.php?id=<?php echo $id ?>'>5.6 Documentos de Admissão FLN</a>
                    <a href='../emails/body-email/admissaoRecife.php?id=<?php echo $id ?>'>5.7 Documentos de Admissão REC</a>
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
            <h2 align="center" id='nome'>Boas Vindas</h2>
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
                                                            if($rows_dados['ID_SEDE'] == "9"){echo "REC";}?></th>
                                <?php  } ?>
                            </tr>
                        </tbody>
                </table>
            </div>
            <div style="height: 140px;"></div>
            <div class="passos">
                <div class="stepwizard">
                    <div class="passos stepwizard-row1 setup-panel">
                        <div class="stepwizard-step col-md-auto">
                            <a title="Menu Principal" href="index.php?id=<?= $id ?>" type="button" class="btn btn-default btn-circle">1</a>
                        </div>
                        <div title="Proposta de Contratação" class="stepwizard-step col-md-auto">
                            <a href="funcionario.php?id=<?= $id ?>" id="botao2" type="button" class="btn btn-default btn-circle">2</a>
                        </div>

                        <div title="Gestão" class="stepwizard-step col-md-auto">
                            <a href="gestao.php?id=<?= $id ?>" id="botao3" type="button" class="btn btn-default btn-circle">3</a>
                        </div>
                        <div title="Documentação" class="stepwizard-step col-md-auto">
                            <a href="documentacao.php?id=<?= $id ?>" id="botao4" type="button" class="btn btn-default btn-circle ">4</a>
                        </div>
                        <div title="Plataforma Admissão Domínio Dados + Fichas de Cadastro" class="stepwizard-step col-md-auto">
                            <a href="admissao.php?id=<?= $id ?>" type="button" id="botao5" class="btn btn-default btn-circle">5</a>
                        </div>
                        <div title="Exame Admissional" class="stepwizard-step col-md-auto">
                            <a href="exame.php?id=<?= $id ?>" type="button" id="botao6" class="btn btn-default btn-circle">6</a>
                        </div>
                        <div title="Dados Bancários" class="stepwizard-step col-md-auto">
                            <a href="bancarios.php?id=<?= $id ?>" type="button" id="botao7" class="btn btn-default btn-circle">7</a>
                        </div>
                        <div title="Suporte Interno" class="stepwizard-step col-md-auto">
                            <a href="suporteinterno.php?id=<?= $id ?>" type="button" id="botao8" class="btn btn-default btn-circle">8</a>
                        </div>
                        <div title="Interno" class="stepwizard-step col-md-auto">
                            <a href="interno.php?id=<?= $id ?>" id="botao9" type="button" class="btn btn-default btn-circle">9</a>
                        </div>
                        <div title="Vias Documentos funcionários" class="stepwizard-step col-md-auto">
                            <a href="viasdocumentos.php?id=<?= $id ?>" id="botao10" type="button" class="btn btn-default btn-circle">10</a>
                        </div>
                        <div title="Boas Vindas" class="stepwizard-step col-md-auto">
                            <a href="recepcao.php?id=<?= $id ?>" id="botao11" type="button" class="btn btn-success btn-circle">11</a>
                        </div>
                        <div title="Vencimento Contratos" class="stepwizard-step col-md-auto">
                            <a href="vencimentosContratos.php?id=<?= $id ?>" id="botao12" type="button" class="btn btn-default btn-circle">12</a>
                        </div>
                    </div>
                </div>
            </div>
            <table id='first-table'>
                <h2 id='titulo-table'></h2>
                <thead>
                    <tr>
                        <th <?php if ($grupo == "Gestores" or $grupo == "Compasso - RH Integração") {
                                                            echo 'colspan="7"';
                                                        }else{
                                                            echo 'colspan="8"';
                                                        } ?>>Boas Vindas Compasso</th>
                    </tr>
                    <tr>
                        <th width='200px'>Status</th>
                        <th>Integração Agendada</th>
                        <th>Integração Realizada</th>
                        <th width='200px'>Sala</th>
                        <th>Layout Boas Vindas Mensal</th>
                        <th>Survey</th>
                        <th <?php if ($grupo == "Gestores" or $grupo == "Compasso - RH Integração") {
                                                            echo 'style="display: none;"';
                                                        } ?>></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($rows_dados = mysqli_fetch_assoc($resultado)) {  ?>
                        <tr>
                            <td><?= $status['STATUS'] ?></td>
                            <td <?php if ($layoutBoasVindas['BOAS_VINDAS_INGR_AGENDADA'] == "" or $rows_dados['BOAS_VINDAS_INGR_AGENDADA'] == "") { echo ($campoV);} ?>><?php echo $rows_dados['BOAS_VINDAS_INGR_AGENDADA']; ?></td>
                            <td <?php if ($layoutBoasVindas['BOAS_VINDAS_INGR_REALIZADA'] == "" or $rows_dados['BOAS_VINDAS_INGR_REALIZADA'] == "") { echo ($campoV);} ?>><?php echo $rows_dados['BOAS_VINDAS_INGR_REALIZADA']; ?></td>
                            <td <?php if ($rows_dados['BOAS_VINDAS_SALA'] == "") {
                                        echo ($campoV);
                                    } ?>><?php echo $rows_dados['BOAS_VINDAS_SALA']; ?></td>
                            <td <?php if ($layoutBoasVindas['LAYOUT_BOAS_VINDAS_MENSAL'] == "" or $rows_dados['LAYOUT_BOAS_VINDAS_MENSAL'] == "") { echo ($campoV);} ?>><?php echo $rows_dados['LAYOUT_BOAS_VINDAS_MENSAL']; ?></td>
                            <td <?php if ($rows_dados['SURVEY'] == "") {
                                        echo ($campoV);
                                    } ?>><?php echo $rows_dados['SURVEY']; ?></td>
                            <td <?php if ($grupo == "Gestores" or $grupo == "Compasso - RH Integração") {
                                                            echo 'style="display: none;"';
                                                        } ?>><a title="Vencimentos Contratos" id="proximo" class="  btn btn-default" href="vencimentosContratos.php?id=<?= $id ?>"> Próximo </td>
                            <td><button title="Editar" type="button" class="bto-update btn btn-default curInputs" data-toggle="modal" data-target="#altera2">Editar</button></span></button></td>
                        </tr>
                    <?php } ?>                    
                </tbody>
            </table>
            <div align="center" style="color: black; font-size: 14px;" class="modal fade" id="altera2" role="dialog">                    
                    <div class="modal-dialog">
                    <div style="width: 100%;" class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <section class="container-modal">
                    <div class="modal-body">
                    <table id='first-table'>
                    <thead>
                    <tr>
                        <th>Integração Agendada</th>
                        <th>Integração Realizada</th>
                        <th width='200px'>Sala</th>
                        <th>Layout Boas Vindas Mensal</th>
                        <th>Survey</th>                                            
                    </tr>
                </thead>
                    <tbody>               
                    <form method="POST" action="../alteraTelas/altera-recepcao.php">
                    <input type='hidden' name="ID_USUARIO" value=<?= $funcionario['ID_USUARIO'] ?>>
                    <input type='hidden' class='intable' readonly name="STATUS" value='<?= $status['STATUS'] ?>'></td>
                            <td><input class='intable' id="campo" type='date' name='BOAS_VINDAS_INGR_AGENDADA' value=<?= $boasVindasIntegrAgendada['BOAS_VINDAS_INGR_AGENDADA'] ?>></td>
                            <td><input class='intable' id="campo2" type='date' name='BOAS_VINDAS_INGR_REALIZADA' value=<?= $boasVindasIntegrRealizada['BOAS_VINDAS_INGR_REALIZADA'] ?>></td>
                            <td><input class='intable' type='text' name='BOAS_VINDAS_SALA' value=<?= $boasVindasSala['BOAS_VINDAS_SALA'] ?>></td>
                            <td><input class='intable' id="campo4" type='date' name='LAYOUT_BOAS_VINDAS_MENSAL' value=<?= $layoutBoasVindas['LAYOUT_BOAS_VINDAS_MENSAL'] ?>></td>
                            <td><input class='intable' type='text' name='SURVEY' value=<?= $survey['SURVEY'] ?>></td>
                    </tbody>                    
                    </table>                                  
                    </div>
                    </section>
                     <div class="modal-footer">
                     <td><button title="Salvar" type="submit" id="salvar" class="botao-salvar btao btn btn-default" value="submit">Salvar</td>                                       
                </div>
                </form>
            </div>
        </div>        
    </div>    
        </section>
        <?php echo file_get_contents("telasLegendas.html"); ?>
        <div class="fab"  ontouchstart="">
                    <button data-toggle="modal" data-target="#myModal" id="opcao2" class="main" >
                    </button>
                    </div>
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
            let variavel = "<?= $deacordo['ENQUADRAMENTO_REMUNERACAO_RETORNO'] ?>";
            if (!variavel == "") {
                $("#botao3, #botao4, #botao5, #botao6, #botao7, #botao8, #botao9, #botao10, #botao11").removeClass("disabled").attr("disabled", false);
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
        }
    </script>
    <script src='../js/desabilitaStepWizard.js'></script>
    <script>
        let grupo = "<?= $grupo ?>";
        window.onload = () => {
            if (grupo == "Compasso - RH Integração") {
                desbilitaStepWizard(2, 3, 4, 5, 6, 7, 8, 9, 10, 12);
            } else if (grupo == "Gestores") {
                desbilitaStepWizard(2, 4, 5, 6, 7, 8, 9, 10, 12);
            }
        }
    </script>
</body>

</html>