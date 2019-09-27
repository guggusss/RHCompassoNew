
<?php

require_once('../validacoes/login/user.php');
include("../db/conexao.php");
include("../db/serverLDAP.php");
include("../update.php");
include("../emails/defineNomeDoGrupoDeEmail.php");



$listar = listar($conn);

$id = $_GET['id'];
$_SESSION['id'] = $id;

/*
 $existe = ExisteUsuario($usuario);

            if(!$existe){
                $cmd = "INSERT INTO `users`(`usuario`) VALUES('$usuario')";
                $result = mysql_query($cmd);
                if(!$result){
                    echo "<script>alert('Já exite um usuário registrado com os mesmo dados! Faça login...');</script>";
                }

                else{
                    echo "<script>alert('Usuario registrado! Faça login agora!');</script>";
                }
            }

            else if($existe){
                echo "<script>alert('Já exite um usuário registrado com os mesmo dados! Faça login...');</script>";
            } 
            */

$suporte = buscasuporte($conn, $id);
$testeGrupoEmail = $suporte['EQUIPE'];
$resultado1 = mysqli_query($conn,"SELECT ID_USUARIO, NOME, DATE_FORMAT(DATA_ADMISSAO,'%d/%m/%Y') as DATA_ADMISSAO,STATUS FROM propostas_contratacoes as p LEFT JOIN admissao_dominio as a on p.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
$conn1 = mysqli_num_rows($resultado1);
$resultado = mysqli_query($conn, "SELECT  `ID_USUARIO`, `EMAIL_SUP`, `USUARIO`, `SENHA`, `EQUIPAMENTO`, `TRANSLADO`, `EQUIPE`, `USUARIO_ATV` FROM `suporte_interno` as p LEFT JOIN admissao_dominio as a on p.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
$count = mysqli_num_rows($resultado);
$status = buscaFuncionarios($conn, $id);

if($count == 1){
    $resultado = mysqli_query($conn, "SELECT `ID_USUARIO`, `EMAIL_SUP`, `USUARIO`, `SENHA`, `EQUIPAMENTO`, `TRANSLADO`, `EQUIPE` , `USUARiO_ATV`FROM `suporte_interno` as p LEFT JOIN admissao_dominio as a on p.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
}else{
    $sede = buscaSedeFuncionario($conn, $status['ID_SEDE']);
    $cargo = buscaCargoFuncionario($conn, $id, $id);
    $grupDeEmail = grupoEmail($cargo['CARGO'], $sede['nome_sede']);
    //$nome = defineUser($conn, $status['NOME'], $id);
    $nome = defineUser($link, $status['NOME'], $id);
    mysqli_query($conn,"INSERT INTO `suporte_interno`( `ID_SUPORTE_INTERNO`,`ID_USUARIO`, `EMAIL_SUP`, `USUARIO`, `SENHA`, `EQUIPAMENTO`, `TRANSLADO`, `EQUIPE`, `USUARIO_ATV`) VALUES (NULL,$id,'$nome@compasso.com.br','$nome',NULL,NULL,NULL,'$grupDeEmail')");
    $resultado = mysqli_query($conn, "SELECT  `ID_USUARIO`, `EMAIL_SUP`, `USUARIO`, `SENHA`, `EQUIPAMENTO`, `TRANSLADO`, `EQUIPE` FROM `suporte_interno` as p LEFT JOIN admissao_dominio as a on p.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
}

$funcionario = buscaProposta($conn, $id);
$mail = buscasuporte($conn, $id);
$usuario= buscasuporte($conn, $id);
$senha = buscasuporte($conn, $id);
$equipamento = buscasuporte($conn, $id);
$translado = buscasuporte($conn, $id);
$nome_email = buscaFuncionarios($conn, $id);
$formRec = buscadocs($conn, $id);
$anexar = buscaexame($conn, $id);
$form = buscaBancario($conn, $id);
$emailges = buscainterno($conn, $id);
$emailsoli = buscavias($conn, $id);
$usuario_atv = buscasuporte($conn, $id);
/* $usuarios = mysql_fetch_assoc($resultado); */



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
    <link rel="stylesheet" href="../css/geraSenha.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />

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
                <a href='../emails/body-email/admissaoRG.php?id=<?php echo $id?>'>5.1 Documentos Admissão RG</a>
                <a href='../emails/body-email/admissaoPF.php?id=<?php echo $id?>'>5.2 Documentos de Admissão PF</a>
                <a href='../emails/body-email/admissaoERE.php?id=<?php echo $id?>'>5.3 Documentos de Admissão ERE</a>
                <a href='../emails/body-email/admissaoCWB.php?id=<?php echo $id?>'>5.4 Documentos de Admissão CWB</a>
                <a href='../emails/body-email/admissaoSP.php?id=<?php echo $id?>'>5.5 Documentos de Admissão SP</a>
                <a href='../emails/body-email/admissaoFNL.php?id=<?php echo $id?>'>5.6 Documentos Admissão FNL</a>
                <a href='../emails/body-email/primeiro-alerta.php?id=<?php echo $id?>'>7. ALERTA - 1ª Experiência expira em 20 dias</a>
                <a href='../emails/body-email/segundo-alerta.php?id=<?php echo $id?>'>7.1 ALERTA - 2ª Experiência expira em 20 dias</a>
                <a href='../emails/body-email/novo-acesso.php?id=<?php echo $id?>'>8. Novo Acesso</a>
                <a href='../emails/body-email/acesso-liberado.php?id=<?php echo $id?>'>9. Acessos Liberado</a>
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
                            <a title="Menu Principal" href="menuPrincipal.php" id="botao1" type="button" class="btn btn-default btn-circle">1</a>
                        </div>
                        <div title ="Proposta de Contratação" class="stepwizard-step col-md-auto">
                            <a href="funcionario.php?id=<?=$id?>" type="button" id="botao2" class="btn btn-default btn-circle" >2</a>
                        </div>
                        <div title ="Gestão" class="stepwizard-step col-md-auto">
                            <a href="gestao.php?id=<?=$id?>" type="button" id="botao3" class="btn btn-default btn-circle">3</a>
                        </div>
                        <div title="Vencimento Contratos" class="stepwizard-step col-md-auto">
                            <a href="vencimentosContratos.php?id=<?=$id?>" type="button" id="botao4" class="btn btn-default btn-circle">4</a>
                        </div>
                        <div title="Documentação" class="stepwizard-step col-md-auto">
                            <a href="documentacao.php?id=<?=$id?>" type="button" id="botao5" class="btn btn-default btn-circle">5</a>
                        </div>
                        <div title= "Plataforma Admissão Domínio Dados + Fichas de Cadastro" class="stepwizard-step col-md-auto">
                            <a href="admissao.php?id=<?=$id?>" type="button" id="botao6" class="btn btn-default btn-circle" >6</a>
                        </div>
                        <div title="Exame Admissional" class="stepwizard-step col-md-auto">
                            <a href="exame.php?id=<?=$id?>" type="button" id="botao7" class="btn btn-default btn-circle" >7</a>
                        </div>
                        <div title= "Dados Bancários" class="stepwizard-step col-md-auto">
                            <a href="bancarios.php?id=<?=$id?>" type="button" id="botao8" class="btn btn-default btn-circle" >8</a>
                        </div>
                        <div title= "Suporte Interno" class="stepwizard-step col-md-auto">
                            <a href="suporteinterno.php?id=<?=$id?>" type="button" id="botao9" class="btn btn-success btn-circle" >9</a>
                        </div>
                        <div title = "Interno" class="stepwizard-step col-md-auto">
                            <a href="interno.php?id=<?=$id?>" id="botao10" type="button"   class="btn btn-default btn-circle  " >10</a>
                        </div>
                        <div title= "Vias Documentos funcionários" class="stepwizard-step col-md-auto">
                            <a href="viasdocumentos.php?id=<?=$id?>"   type="button" id="botao11" class="btn btn-default btn-circle  " >11</a>
                        </div>
                        <div title= "Boas Vindas" class="stepwizard-step col-md-auto">
                            <a href="recepcao.php?id=<?=$id?>" type="button" id="botao12" class="btn btn-default btn-circle" >12</a>
                        </div>
                    </div>
                </div>
            </div>
            <table id='first-table'>
                <h2 id='titulo-table'></h2>
                <thead>
                    <tr>
                        <th width='200px'>Status</th>
                        <th width= '330px'>E-mail</th>
                        <th>Usuário</th>
                        <th>Senha Acesso</th>
                        <th>Equipamento</th>
                        <th>Necessidade de Translado</th>
                        <th width='278px'>Grupos de E-mail</th>
                        <th>Usuário Ativo</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($rows_dados = mysqli_fetch_assoc($resultado)) {  ?>
                            <tr>
                            <td><?=$status['STATUS']?></td>
                            <td><?php echo $rows_dados['EMAIL_SUP']; ?></td>
                            <td><?php echo $rows_dados['USUARIO']; ?></td>
                            <td><?php echo $rows_dados['SENHA']; ?></td>
                            <td><?php echo $rows_dados['EQUIPAMENTO']; ?></td>
                            <td><?php echo $rows_dados['TRANSLADO']; ?></td>
                            <td><?php echo $rows_dados['EQUIPE']; ?></td>
                            <td><?php ?></td>
                            <td><a title="Interno" id="proximo" class="  btn btn-default" href="interno.php"> Próximo </td>
                            <td><button title="Editar" type="button" class="bto-update btn btn-default curInputs">Editar</button></span></button></td>

                        </tr>
                    <?php } ?>

                    <tr class='funcionario atualiza'>
                        <form method="POST" action="../alteraTelas/altera-suporte.php">
                            <input type="hidden" name="ID_USUARIO" value="<?php echo $funcionario['ID_USUARIO']?>">
                            <td><input class='intable' readonly name="STATUS"  value='<?=$status['STATUS']?>'></td>
                            <td><input type='email' class='intable' name="EMAIL_SUP"  value="<?=$mail['EMAIL_SUP']?>"></td>
                            <td><input type="text" class='intable' name ="USUARIO"  value="<?=$usuario['USUARIO']?>"></td>
                            <td><input type="text" class='intable' name="SENHA" id="jogaSenha" value="<?=$senha['SENHA']?>"></td>
                            <td><input type="text" class='intable' name="EQUIPAMENTO"  value="<?=$equipamento['EQUIPAMENTO']?>"></td>
                            <td><input type="text" class='intable' id="campo" name="TRANSLADO"  value="<?=$translado['TRANSLADO']?>"></td>
                            <td><select multiple"" onclick="anexaGrupo()" class="intable" id="books" name="EQUIPE[]" value="<?=$anexar_equipe['EQUIPE']?>"></select></td>
                            <td><input type="text" class='intable' name ="USUARIO_ATV"  value="<?=$usuario_atv['USUARIO_ATV']?>"></td>
                            <td><input type="text" class='intable' name ="NULL"  value="<?=$usuario['NULL']?>"></td>
                            <td><button title="Salvar" type="submit" class="botao-salvar btao btn btn-default">Salvar</td>
                    </form>
                </tbody>
            </table>
			<input type="button" name="botao-ok" value="Gerar uma senha" onclick = "funcao()" id="senhaUsuario">
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../js/funcionamento.js"></script>
    <script src="../js/filter.js"></script>
    <script src="../js/anexa-grupo-emails.js"></script>
    <script src="../js/geraSenha.js"></script>
    <script src='../js/desabilitaStepWizard.js'></script>
    <script>
        let grupo = "<?=$grupo?>";
        console.log(grupo);
            window.onload = () => {
            if(grupo == "Suporte Interno"){
                desbilitaStepWizard(2,3,4,5,6,7,8,10,11,12);
                $("#proximo").prop("disabled", true);
                $("#proximo").attr("disabled", true);
                $("#proximo").attr("href", "#");
            }
            
        }
            //função para ver se tem usuarios iguais
        function ExisteUsuario($u){

            $cmd = "SELECT * FROM `suporte_interno` WHERE `USUARIO`='$u'";
            $result = mysql_query($cmd);
            $rows = mysql_num_rows($result);

        if(1 == $rows){
            return true;
        }

        else{
            return false;
        }
        }

    </script>
</body>

</html>
