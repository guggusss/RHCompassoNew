<?php

require_once('../validacoes/login/user.php');
include("../db/conexao.php");
include("../db/serverLDAP.php");
include("../update.php");
include("../emails/defineNomeDoGrupoDeEmail.php");



$listar = listar($conn);

$id = $_GET['id'];
$_SESSION['id'] = $id;

$suporte = buscasuporte($conn, $id);
$testeGrupoEmail = $suporte['EQUIPE'];
$resultado1 = mysqli_query($conn, "SELECT ID_USUARIO, NOME, ID_SEDE, DATE_FORMAT(DATA_ADMISSAO,'%d/%m/%Y') as DATA_ADMISSAO,STATUS FROM propostas_contratacoes as p LEFT JOIN admissao_dominio as a on p.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
$conn1 = mysqli_num_rows($resultado1);
$resultado = mysqli_query($conn, "SELECT  `ID_USUARIO`, `EMAIL_SUP`, `USUARIO`, `SENHA`, `EQUIPAMENTO`, `TRANSLADO`, `EQUIPE` FROM `suporte_interno` as p LEFT JOIN admissao_dominio as a on p.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
$count = mysqli_num_rows($resultado);
$status = buscaFuncionarios($conn, $id);
$campoV = 'class="txtVazio" ';

if ($count == 1) {
    $resultado = mysqli_query($conn, "SELECT `ID_USUARIO`, `EMAIL_SUP`, `USUARIO`, `SENHA`, `EQUIPAMENTO`, `TRANSLADO`, `EQUIPE` FROM `suporte_interno` as p LEFT JOIN admissao_dominio as a on p.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
} else {
    $sede = buscaSedeFuncionario($conn, $status['ID_SEDE']);
    $cargo = buscaCargoFuncionario($conn, $id, $id);
    $grupDeEmail = grupoEmail($cargo['CARGO'], $sede['nome_sede']);
    $nome = defineUser($conn, $status['NOME'], $id);
    mysqli_query($conn, "INSERT INTO `suporte_interno`( `ID_SUPORTE_INTERNO`,`ID_USUARIO`, `EMAIL_SUP`, `USUARIO`, `SENHA`, `EQUIPAMENTO`, `TRANSLADO`, `EQUIPE`) VALUES (NULL,$id,'$nome@compasso.com.br','$nome',NULL,NULL,NULL,'$grupDeEmail')");
    $resultado = mysqli_query($conn, "SELECT  `ID_USUARIO`, `EMAIL_SUP`, `USUARIO`, `SENHA`, `EQUIPAMENTO`, `TRANSLADO`, `EQUIPE` FROM `suporte_interno` as p LEFT JOIN admissao_dominio as a on p.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
}

$funcionario = buscaProposta($conn, $id);
$mail = buscasuporte($conn, $id);
$usuario = buscasuporte($conn, $id);
$senha = buscasuporte($conn, $id);
$equipamento = buscasuporte($conn, $id);
$translado = buscasuporte($conn, $id);
$nome_email = buscaFuncionarios($conn, $id);
$formRec = buscadocs($conn, $id);
$anexar = buscaexame($conn, $id);
$form = buscaBancario($conn, $id);
$emailges = buscainterno($conn, $id);
$emailsoli = buscavias($conn, $id);
/*$usuario_atv = buscasuporte($conn, $id); */
/*$usuarios = mysql_fetch_assoc($resultado); */
?>
<!DOCTYPE html>

<html lang="pt">
<head>
    <link rel="stylesheet" href="../css/geraSenha.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
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
            <a class='nav inicio' href='Index.php'>Início</a>
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
                    <a href='../emails/body-email/primeiro-alerta.php?id=<?php echo $id ?>'>7. ALERTA - 1ª Experiência expira em 20 dias</a>
                    <a href='../emails/body-email/segundo-alerta.php?id=<?php echo $id ?>'>7.1 ALERTA - 2ª Experiência expira em 20 dias</a>
                    <a href='../emails/body-email/novo-acesso.php?id=<?php echo $id ?>'>8. Novo Acesso</a>
                    <a href='../emails/body-email/acesso-liberado.php?id=<?php echo $id ?>'>9. Acessos Liberado</a>
                </div>
            </div>
            <a class='nav filter last' href='../login/user/sair.php'>Sair</a>
        </nav>

    </header>
    <main>
        <section class='menu-inicial'>
            <h2 id='nome'>Suporte Interno</h2>

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
            <div style="height: 100px;"></div>
            <div class="passos">
                <div class="stepwizard">
                    <div class="passos stepwizard-row1 setup-panel">
                        <div class="stepwizard-step col-md-auto">
                            <a title="Menu Principal" href="Index.php" id="botao1" type="button" class="btn btn-default btn-circle">1</a>
                        </div>
                        <div title="Proposta de Contratação" class="stepwizard-step col-md-auto">
                            <a href="funcionario.php?id=<?= $id ?>" type="button" id="botao2" class="btn btn-default btn-circle">2</a>
                        </div>
                        <div title="Gestão" class="stepwizard-step col-md-auto">
                            <a href="gestao.php?id=<?= $id ?>" type="button" id="botao3" class="btn btn-default btn-circle">3</a>
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
                            <a href="suporteinterno.php?id=<?= $id ?>" type="button" id="botao9" class="btn btn-success btn-circle">8</a>
                        </div>
                        <div title="Interno" class="stepwizard-step col-md-auto">
                            <a href="interno.php?id=<?= $id ?>" id="botao10" type="button" class="btn btn-default btn-circle  ">9</a>
                        </div>
                        <div title="Vias Documentos funcionários" class="stepwizard-step col-md-auto">
                            <a href="viasdocumentos.php?id=<?= $id ?>" type="button" id="botao11" class="btn btn-default btn-circle  ">10</a>
                        </div>
                        <div title="Boas Vindas" class="stepwizard-step col-md-auto">
                            <a href="recepcao.php?id=<?= $id ?>" type="button" id="botao12" class="btn btn-default btn-circle">11</a>
                        </div>
                        <div title="Vencimento Contratos" class="stepwizard-step col-md-auto">
                            <a href="vencimentosContratos.php?id=<?= $id ?>" type="button" id="botao4" class="btn btn-default btn-circle">12</a>
                        </div>
                    </div>
                </div>
            </div>
            <table id='first-table'>
                <h2 id='titulo-table'></h2>
                <thead>
                    <tr>
                        <th width='200px'>Status</th>
                        <th width='150px'>Usuário Ativo</th>
                        <th width='330px'>E-mail</th>
                        <th width='330px'>Usuário</th>
                        <th width='150px'>Senha Acesso</th>
                        <th width='150px'>Equipamento</th>
                        <th width='150px'>Necessidade de Translado</th>
                        <th width='278px = 100%'>Grupos de E-mail</th>
                        <th width='150px'></th>
                        <th width='150px'></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($rows_dados = mysqli_fetch_assoc($resultado)) {  ?>
                        <tr>
                            <td><?= $status['STATUS'] ?></td>
                            <td <?php if ($rows_dados['USUARIO'] and $rows_dados['SENHA'] and $rows_dados['EMAIL_SUP'] != NULL) {
                                                                                                    $usuario_atv = "ATIVO";
                                                                                                }else{
                                                                                                    $usuario_atv = "INVÁLIDO";
                                                                                                    echo ($campoV);
                                                                                                } 
                                                                                                
                                                                                                if(buscasuporteExiste($conn, $rows_dados['USUARIO']) > 1) {
                                                                                                    $usuario_atv = "USUÁRIO E/OU E-MAIL JÁ EXISTE";
                                                                                                    echo ($campoV);                                                                                                    
                                                                                                }elseif(buscasuporteExisteEmail($conn, $rows_dados['EMAIL_SUP']) > 1) {
                                                                                                    $usuario_atv = "USUÁRIO E/OU E-MAIL JÁ EXISTE";
                                                                                                    echo ($campoV);                                                                                                    
                                                                                                } ?>> <?php echo $usuario_atv ?> </td>
                            <td <?php if ($rows_dados['EMAIL_SUP'] == "") {
                                        echo ($campoV);
                                    } ?>><?php echo $rows_dados['EMAIL_SUP']; ?></td>
                            <td <?php if ($rows_dados['USUARIO'] == "") {
                                        echo ($campoV);
                                    } ?>><?php echo $rows_dados['USUARIO']; ?></td>
                            <td <?php if ($rows_dados['SENHA'] == "") {
                                        echo ($campoV);
                                    } ?>><?php echo $rows_dados['SENHA']; ?></td>
                            <td <?php if ($rows_dados['EQUIPAMENTO'] == "") {
                                        echo ($campoV);
                                    } ?>><?php echo $rows_dados['EQUIPAMENTO']; ?></td>
                            <td <?php if ($rows_dados['TRANSLADO'] == "") {
                                        echo ($campoV);
                                    } ?>><?php echo $rows_dados['TRANSLADO']; ?></td>
                            <td <?php if ($rows_dados['EQUIPE'] == "") {
                                        echo ($campoV);
                                    } ?>><?php echo $rows_dados['EQUIPE']; ?></td>
                            <td><a title="Interno" id="proximo" class="  btn btn-default" href="interno.php?id=<?= $id ?>"> Próximo </td>
                            <td><button title="Editar" type="button" class="bto-update btn btn-default curInputs">Editar</button></span></button></td>

                        </tr>
                    <?php } ?>
                    <tr class='funcionario atualiza'>
                        <form method="POST" action="../alteraTelas/altera-suporte.php">
                            <input type="hidden" name="ID_USUARIO" value="<?php echo $funcionario['ID_USUARIO'] ?>">
                            <td><input class='intable' readonly name="STATUS" value='<?= $status['STATUS'] ?>'></td>
                            <td></td>
                            <td><input type='email' class='intable' name="EMAIL_SUP" value="<?= $mail['EMAIL_SUP'] ?>"></td>
                            <td><input type="text" class='intable' name="USUARIO" value="<?= $usuario['USUARIO'] ?>"></td>
                            <td><input type="text" class='intable' name="SENHA" id="jogaSenha" value="<?= $senha['SENHA'] ?>"></td>
                            <td><input type="text" class='intable' name="EQUIPAMENTO" value="<?= $equipamento['EQUIPAMENTO'] ?>"></td>
                            <td><input type="text" class='intable' name="TRANSLADO" id="campo"  value="<?= $translado['TRANSLADO'] ?>"></td>
                            <td><select multiple"" onclick="anexaGrupo()" class="intable" name="EQUIPE[]" id="books"  value="<?= $anexar_equipe['EQUIPE'] ?>"></select></td>

                            <td><input type="button" name="botao-ok" value="Gerar senha" onclick="funcao()" id="senhaUsuario"></td>
                            <td><button title="Salvar" type="submit" class="botao-salvar btao btn btn-default">Salvar</td>
                        </form>
                </tbody>
            </table>

        </section>
        <?php if($usuario_atv == "INVÁLIDO"){ ?>
        <h3>Usuário, E-mail e Senha Acesso precisam ser preenchidos!</h3>
        <?php } ?>
        <?php echo file_get_contents("telasLegendas.html"); ?>
        
    </main>
    <footer>
        <h2></h2>
    </footer>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../js/funcionamento.js"></script>
    <script src="../js/filter.js"></script>
    <script src="../js/anexa-grupo-emails.js"></script>
    <script src="../js/geraSenha.js"></script>
    <script src='../js/desabilitaStepWizard.js'></script>
    <script>
        let grupo = "<?= $grupo ?>";
        /*/console.log(grupo);/*/
        window.onload = () => {
            if (grupo == "Suporte Interno") {
                desbilitaStepWizard(2, 3, 4, 5, 6, 7, 8, 10, 11, 12);
                $("#proximo").prop("disabled", true);
                $("#proximo").attr("disabled", true);
                $("#proximo").attr("href", "#");
            }

        }
        //função para ver se tem usuarios iguais
        function ExisteUsuario($u) {

            $cmd = "SELECT * FROM `suporte_interno` WHERE `USUARIO`='$usuario'";
            $result = mysql_query($cmd);
            $rows = mysql_num_rows($result, $u);

            if (1 == $rows) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</body>

</html>