<?php

require_once('../validacoes/login/user.php');
include("../db/conexao.php");
include("../update.php");

$listar = listar($conn);


    if (!isset ($id)){
     $id = $_SESSION['id'];
    }

$resultado1 = mysqli_query($conn, "SELECT ID_USUARIO, NOME, DATE_FORMAT(DATA_ADMISSAO,'%d/%m/%Y') as DATA_ADMISSAO,STATUS FROM propostas_contratacoes as p LEFT JOIN admissao_dominio as a on p.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
$conn1 = mysqli_num_rows($resultado1);


$resultado = mysqli_query($conn, "SELECT `ID_PLATAFORMA_ADM_DOMIN`, `ID_USUARIO`, DATE_FORMAT(QUALIFIC_CADASTRAL_CEP,'%d/%m/%Y') as QUALIFIC_CADASTRAL_CEP, DATE_FORMAT(CAD_ADM_PLATAFORMA_ADM_DIMIN,'%d/%m/%Y') as CAD_ADM_PLATAFORMA_ADM_DIMIN,  DATE_FORMAT(DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO,'%d/%m/%Y') as DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO,
 DATE_FORMAT(TERMO_PSI,'%d/%m/%Y') as TERMO_PSI,DATE_FORMAT(INCLUI_ADM_PROV,'%d/%m/%Y') as INCLUI_ADM_PROV FROM `admissao` as p LEFT JOIN admissao_dominio as a on p.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
$count = mysqli_num_rows($resultado);

if($count == 1){
    $resultado = mysqli_query($conn, "SELECT `ID_PLATAFORMA_ADM_DOMIN`, `ID_USUARIO`, DATE_FORMAT(QUALIFIC_CADASTRAL_CEP,'%d/%m/%Y') as QUALIFIC_CADASTRAL_CEP, DATE_FORMAT(CAD_ADM_PLATAFORMA_ADM_DIMIN,'%d/%m/%Y') as CAD_ADM_PLATAFORMA_ADM_DIMIN,  DATE_FORMAT(DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO,'%d/%m/%Y') as DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO,
    DATE_FORMAT(TERMO_PSI,'%d/%m/%Y') as TERMO_PSI,DATE_FORMAT(INCLUI_ADM_PROV,'%d/%m/%Y') as INCLUI_ADM_PROV FROM `admissao` as p LEFT JOIN admissao_dominio as a on p.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
}else{
    mysqli_query($conn,"INSERT INTO `admissao`(`ID_PLATAFORMA_ADM_DOMIN`, `ID_USUARIO`, `QUALIFIC_CADASTRAL_CEP`, `CAD_ADM_PLATAFORMA_ADM_DIMIN`, `DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO`, `TERMO_PSI`, `INCLUI_ADM_PROV`) VALUES (NULL,$id,NULL,NULL,NULL,NULL,NULL)");

    $resultado = mysqli_query($conn, "SELECT `ID_PLATAFORMA_ADM_DOMIN`, `ID_USUARIO`, DATE_FORMAT(QUALIFIC_CADASTRAL_CEP,'%d/%m/%Y') as QUALIFIC_CADASTRAL_CEP, DATE_FORMAT(CAD_ADM_PLATAFORMA_ADM_DIMIN,'%d/%m/%Y') as CAD_ADM_PLATAFORMA_ADM_DIMIN,  DATE_FORMAT(DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO,'%d/%m/%Y') as DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO,
    DATE_FORMAT(TERMO_PSI,'%d/%m/%Y') as TERMO_PSI,DATE_FORMAT(INCLUI_ADM_PROV,'%d/%m/%Y') as INCLUI_ADM_PROV FROM `admissao` as p LEFT JOIN admissao_dominio as a on p.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
}

$status = buscaFuncionarios($conn, $id);
$funcionario = buscaProposta($conn, $id);
$quali = buscaadmissao($conn, $id);
$cad= buscaadmissao($conn, $id);
$doc = buscaadmissao($conn, $id);
$termo = buscaadmissao($conn, $id);
$inclui = buscaadmissao($conn, $id);
$formRec = buscadocs($conn, $id);
$anexar = buscaexame($conn, $id);
$form = buscaBancario($conn, $id);
$emailges = buscainterno($conn, $id);
$emailsoli = buscavias($conn, $id);
$translado = buscasuporte($conn, $id);
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
            <a class='nav inicio' href='menuPrincipal.php'>Início</a>
            <div class="dropdown">
            <a class="dropbtn nav">Emails <span class='caret'></span></a>
            <div class="dropdown-content">
                <a href='../emails/body-email/admissaoPOA.php?id=<?php echo $id?>'>5. Documentos Admissão POA</a>
                <a href='../emails/body-email/admissãoRG.php?id=<?php echo $id?>'>5.1 Documentos Admissão RG</a>
                <a href='../emails/body-email/admissãoPF.php?id=<?php echo $id?>'>5.2 Documentos de Admissão PF</a>
                <a href='../emails/body-email/admissãoERE.php?id=<?php echo $id?>'>5.3 Documentos de Admissão ERE</a>
                <a href='../emails/body-email/admissãoCWB.php?id=<?php echo $id?>'>5.4 Documentos de Admissão CWB</a>
                <a href='../emails/body-email/admissãoSP.php?id=<?php echo $id?>'>5.5 Documentos de Admissão SP</a>
                <a href='../emails/body-email/admissãoFNL.php?id=<?php echo $id?>'>5.6 Documentos Admissão FNL</a>
                <a href='../emails/body-email/primeiro-alerta.php?id=<?php echo $id?>'>7. ALERTA - 1ª Experiência expira em 20 dias</a>
                <a href='../emails/body-email/segundo-alerta.php?id=<?php echo $id?>'>7.1 ALERTA - 2ª Experiência expira em 20 dias</a>
                <a href='../emails/body-email/novo-acesso.php?id=<?php echo $id?>'>8. Novo Acesso</a>
                <a href='../emails/body-email/acesso-liberado.php?id=<?php echo $id?>>'>9. Acessos Liberado</a>
                </div>
            </div>
            <a class='nav filter last' href='../login/user/sair.php'>Sair</a>
        </nav>

    </header>
    <main>
        <section class='menu-inicial'>
            <h2 id='nome'>Plataforma Admissão Domínio Dados + Fichas de Cadastro</h2>
        </section>
        <section class='container estruct'>
        <div class='menu-inicial1'>
                <table>
                    <thead>
                        <tr id='titulo-table1' margin-top='0' >
                            <th width='170px'>Status</th>
                            <th width='170px'>Nome</th>
                            <th width='170px'>Data de Admissao</th>
                        </tr>
                    <thead>
                <tbody>
                <tr>
                        <?php while ($rows_dados = mysqli_fetch_assoc($resultado1)) {  ?>
                            <th width='100px'><?php echo $rows_dados['STATUS'];?></th>
                            <th width='100px'><?php echo $rows_dados['NOME']; ?></th>
                            <th width='170px'><?php echo $rows_dados['DATA_ADMISSAO'];?></th>
                        <?php  } ?>
                    </tr>
                </tbody>
                </table>
        </div>
        <div style="height: 25px;"></div>
        <div class="passos">
                <div class="stepwizard">
                    <div class="passos stepwizard-row1 setup-panel">
                        <div class="stepwizard-step col-md-auto">
                            <a title="Menu Principal" href="menuPrincipal.php?id=<?=$id?>" type="button" class="btn btn-default btn-circle">1</a>
                        </div>
                        <div title ="Proposta de Contratação" class="stepwizard-step col-md-auto">
                            <a href="funcionario.php?id=<?=$id?>" type="button" class="btn btn-default btn-circle" >2</a>
                        </div>
                        <div title ="Gestão" class="stepwizard-step col-md-auto">
                            <a href="gestao.php?id=<?=$id?>" id="gestao" type="button"  class="btn btn-default btn-circle">3</a>
                        </div>
                        <div title="Vencimento Contratos" class="stepwizard-step col-md-auto">
                            <a href="vencimentosContratos.php?id=<?=$id?>" id="botao"  type="button" class="btn btn-default btn-circle  ">4</a>
                        </div>
                        <div title="Documentação" class="stepwizard-step col-md-auto">
                            <a href="documentacao.php?id=<?=$id?>" type="button" id="botao5"  class="btn btn-default btn-circle ">5</a>
                        </div>
                        <div title= "Plataforma Admissão Domínio Dados + Fichas de Cadastro" class="stepwizard-step col-md-auto">
                            <a href="admissao.php?id=<?=$id?>" type="button" id="botao6"  class="btn btn-success btn-circle" >6</a>
                        </div>
                        <div title="Exame Admissional" class="stepwizard-step col-md-auto">
                            <a href="exame.php?id=<?=$id?>" type="button" id="botao7"  class="btn btn-default  btn-circle" >7</a>
                        </div>
                        <div title= "Dados Bancários" class="stepwizard-step col-md-auto">
                            <a href="bancarios.php?id=<?=$id?>" type="button" id="botao8" class="btn btn-default  btn-circle" >8</a>
                        </div>
                        <div title= "Suporte Interno" class="stepwizard-step col-md-auto">
                            <a href="suporteinterno.php?id=<?=$id?>" id="botao9" type="button" class="btn btn-default btn-circle" >9</a>
                        </div>
                        <div title = "Interno" class="stepwizard-step col-md-auto">
                            <a href="interno.php?id=<?=$id?>" id="botao10" type="button" class="btn btn-default btn-circle" >10</a>
                        </div>
                        <div title= "Vias Documentos funcionários" class="stepwizard-step col-md-auto">
                            <a href="viasdocumentos.php?id=<?=$id?>" id="botao11" type="button" class="btn btn-default btn-circle" >11</a>
                        </div>
                        <div title= "Boas Vindas" class="stepwizard-step col-md-auto">
                            <a href="recepcao.php?id=<?=$id?>" id="botao12" type="button" class="btn btn-default btn-circle" >12</a>
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
                        <th>Cadastrada Admissão<br/> Plataforma Domínio</th>
                        <th>Documentos Recebidos Plataforma<br/> Domínio + Validação  CBO</th>
                        <th>Termo PSI</th>
                        <th>Incluir Admissão na Provisória</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($rows_dados = mysqli_fetch_assoc($resultado)) {  ?>
                        <tr>
                            <td><?=$status['STATUS']?></td>
                            <td id="data"><?php echo $rows_dados['QUALIFIC_CADASTRAL_CEP']; ?></td>
                            <td id="data2"><?php echo $rows_dados['CAD_ADM_PLATAFORMA_ADM_DIMIN']; ?></td>
                            <td id="data3"><?php echo $rows_dados['DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO']; ?></td>
                            <td id="data4"><?php echo $rows_dados['TERMO_PSI']; ?></td>
                            <td id="data5"><?php echo $rows_dados['INCLUI_ADM_PROV']; ?></td>
                            <td><a title="Exame Admissional" id="proximo" class="btn btn-default" href="exame.php"> Próximo </td>
                            <td><button title="Editar" type="button" class="bto-update btn btn-default curInputs">Editar</button></span></button></td>

                        </tr>
                    <?php } ?>
                    <tr class='funcionario atualiza'>
                        <form method="POST" action="../alteraTelas/altera-admissao.php">
                            <input type="hidden" name="ID_USUARIO" value="<?php echo $funcionario['ID_USUARIO']?>">
                            <td><input class='intable' readonly name="STATUS" value='<?=$status['STATUS']?>'></td>
                            <td><input type='date' id="campo" class='intable' name="QUALIFIC_CADASTRAL_CEP"  value="<?=$quali['QUALIFIC_CADASTRAL_CEP']?>"></td>
                            <td><input type="date" id="campo2" class='intable' name ="CAD_ADM_PLATAFORMA_ADM_DIMIN"  value="<?=$cad['CAD_ADM_PLATAFORMA_ADM_DIMIN']?>"></td>
                            <td><input type="date" id="campo3" class='intable' name="DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO"  value="<?=$doc['DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO']?>"></td>
                            <td><input type="date" id="campo4" class='intable' name="TERMO_PSI"  value="<?=$termo['TERMO_PSI']?>"></td>
                            <td><input type="date" id="campo5" class='intable' name="INCLUI_ADM_PROV"  value="<?=$inclui['INCLUI_ADM_PROV']?>"></td>
                            <td></td>
                            <td><button title="Salvar" type="submit" class="botao-salvar btao btn btn-default">Salvar</td>
                        </form>
                    </tr>

                </tbody>
            </table>
        </section>
        <section class="container estruct">
                <h2 class="titulo" align='center'>Legendas</h2>
                <table id='table-legendas'>
                    <tr class='tb2'>
                        <th scope="col" class='tb2'>STATUS</th>
                        <th scope="col" class='tb2'>TIPO</th>
                    </tr>
                    <tr class='tb2'>
                        <td class='tb2'>SOLICITAÇÃO DE PROPOSTA</td>
                        <td class='tb2'>Gestor solicitou a proposta de contratação</td>
                        <td align='center'><input type='button' value='Aprovação' onclick =  ??? ></td>
                    </tr>
                    <tr class='tb2'>
                        <td class='tb2'>AGUARDANDO APROVAÇÃO</td>
                        <td class='tb2'>Gestor submeteu a proposta de contratação para aprovação da diretoria</td>
                    </tr>
                    <tr>
                        <td class='tb2'>APROVADO DIRETORIA</td>
                        <td class='tb2'>Diretoria aprovou recrutamento irá seguir</td>
                    </tr>
                    <tr>
                        <td class='tb2'>EM VALIDAÇÃO</td>
                        <td class='tb2'>Proposta em elaboração pelo time de recrutamento</td>
                    </tr>
                    <tr>
                        <td class='tb2'>NEGOCIAÇÃO</td>
                        <td class='tb2'>Profissional solicitou contra proposta</td>
                    </tr>
                    <tr class='tb2'>
                        <td class='tb2'>PROPOSTA ENVIADA</td>
                        <td class='tb2'>Recrutamento enviou a proposta e está aguardando retorno</td>
                    </tr>
                    <tr>
                        <td class='tb2'>E-MAIL: PROPOSTA ACEITA</td>
                        <td class='tb2'>Profissional aceitou a proposta</td>
                    </tr>
                    <tr class='tb2'>
                        <td class='tb2'>E-MAIL: EM ANDAMENTO</td>
                        <td class='tb2'>DP aprovou a proposta e seguirá a admissão</td>
                    </tr>
                    <tr class='tb2'>
                        <td class='tb2'>E-MAIL: PROPOSTA INVÁLIDA</td>
                        <td class='tb2'>DP reprovou recrutamento revisar a proposta</td>
                    </tr>
                    <tr class='tb2'>
                        <td class='tb2'>EM CONTRATO</td>
                        <td class='tb2'>Admissão concluída - envio dos alerta de vencimento de contrato</td>
                    </tr>
                    <tr class='tb2'>
                        <td class='tb2'>RETORNO DOCS</td>
                        <td class='tb2'>Admissão concluída - aguardando documentos fisícos admissão assinados</td>
                    </tr>
                    <tr class='tb2'>
                        <td class='tb2'>E-MAIL: DESISTENCIA</td>
                        <td class='tb2'>Profissional desistiu da admissão após aceite</td>
                    </tr>
                    <tr class='tb2'>
                        <td class='tb2'>E-MAIL RECUSADO</td>
                        <td class='tb2'>Profissional recusou a proposta</td>
                    </tr>
                </table>
                </table>
                <table class='legendas-sedes'>
                <tr>
                    <th class='tb2'>SEDE</th>
                </tr>
                <?php foreach ($listar as $linha):?>
                <tr><td class='tb2'><?php echo $linha['NOME_SEDE']?></td></tr>
                <?php endforeach ?>
                </table>
                <table class='legendas-tipos'>
                    <tr>
                        <th class='tb2'>TIPO</th>
                        <th class='tb2'>COMENTÁRIOS</th>
                    </tr>
                    <tr>
                        <td class='tb2'>CLT</td>
                        <td class='tb2'>Colaborador CLT</td>
                    </tr>
                    <tr>
                        <td class='tb2'>CC</td>
                        <td class='tb2'>Cargo de Confiança</td>
                    </tr>
                    <tr>
                        <td class='tb2'>HO</td>
                        <td class='tb2'>Home Office - Teletrabalho</td>
                    </tr>
                    <tr>
                        <td class='tb2'>TEMP</td>
                        <td class='tb2'>Contrato por tempo determinado</td>
                    </tr>
                    <tr>
                        <td class='tb2'>APDZ</td>
                        <td class='tb2'>Aprendiz</td>
                    </tr>
                </table>
            </section>
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
        if(document.getElementById("campo").value == ""){
            $("#data").addClass("dataVazia");
        } 
        if(document.getElementById("campo2").value == ""){
            $("#data2").addClass("dataVazia");
        }
        if(document.getElementById("campo3").value == ""){
            $("#data3").addClass("dataVazia");
        }
        if(document.getElementById("campo4").value == ""){
            $("#data4").addClass("dataVazia");
        }
        if(document.getElementById("campo5").value == ""){
            $("#data5").addClass("dataVazia");
        }
    }               
    </script>

</body>

</html>
