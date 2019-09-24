
<?php
    
    require_once('../validacoes/login/user.php');
    include("../db/conexao.php");
    include("../update.php");

    $listar = listar($conn);

    $id = $_GET['id'];
    $_SESSION['id'] = $id;
    
$resultado1 = mysqli_query($conn,"SELECT ID_USUARIO, NOME,DATE_FORMAT(DATA_ADMISSAO,'%d/%m/%Y') as DATA_ADMISSAO,STATUS FROM propostas_contratacoes as p LEFT JOIN admissao_dominio as a on p.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
$conn1 = mysqli_num_rows($resultado1);


$resultado = mysqli_query($conn, "SELECT `ID_GESTOR`, `ID_USUARIO`, `GESTOR`, `GESTOR_SABE`, `GESTOR_LOCAL`, `GESTOR_LOCAL_sABE`, `RECEPTOR_PESSOA` FROM `gestao` as d LEFT JOIN admissao_dominio as a on d.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
$count = mysqli_num_rows($resultado);

if($count == 1){
    $resultado = mysqli_query($conn, "SELECT `ID_GESTOR`, `ID_USUARIO`, `GESTOR`, `GESTOR_SABE`, `GESTOR_LOCAL`, `GESTOR_LOCAL_sABE`, `RECEPTOR_PESSOA` FROM `gestao` as d LEFT JOIN admissao_dominio as a on d.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
}else{
    mysqli_query($conn,"INSERT INTO `gestao`(`ID_GESTOR`, `ID_USUARIO`, `GESTOR`, `GESTOR_SABE`, `GESTOR_LOCAL`, `GESTOR_LOCAL_sABE`, `RECEPTOR_PESSOA`) VALUES (NULL,$id,NULL,NULL,NULL,NULL, NULL)");

    $resultado = mysqli_query($conn, "SELECT `ID_GESTOR`, `ID_USUARIO`, `GESTOR`, `GESTOR_SABE`, `GESTOR_LOCAL`, `GESTOR_LOCAL_sABE`, `RECEPTOR_PESSOA` FROM `gestao` as d LEFT JOIN admissao_dominio as a on d.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
}

$status = buscaFuncionarios($conn, $id);
$gestor = buscagestao($conn, $id);
$gestor_sabe = buscagestao($conn, $id);
$gestor_local = buscagestao($conn, $id);
$gestorL_sabe = buscagestao($conn, $id);
$receptor = buscagestao($conn, $id);
$funcionario = buscagestao($conn, $id);
$formRec = buscadocs($conn, $id);
$inclui = buscaadmissao($conn, $id);
$anexar = buscaexame($conn, $id);
$form = buscaBancario($conn, $id);
$emailges = buscainterno($conn, $id);
$emailsoli = buscavias($conn, $id);
$translado = buscasuporte($conn, $id);
$efetivacao = buscavencimentos($conn, $id);
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
            <h2 id='nome'>Gestão</h2>
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
                            <a href="gestao.php?id=<?=$id?>" type="button" id="botao3" class="btn btn-success btn-circle">3</a>
                        </div>
                        <div title="Vencimento Contratos" class="stepwizard-step col-md-auto">
                            <a href="vencimentosContratos.php?id=<?=$id?>" id="botao4"   type="button" class="btn btn-default btn-circle  ">4</a>
                        </div>
                        <div title="Documentação" class="stepwizard-step col-md-auto">
                            <a href="documentacao.php?id=<?=$id?>"  id="botao5" type="button" class="btn btn-default btn-circle  ">5</a>
                        </div>
                        <div title= "Plataforma Admissão Domínio Dados + Fichas de Cadastro" class="stepwizard-step col-md-auto">
                            <a href="admissao.php?id=<?=$id?>"   type="button" id="botao6" class="btn btn-default btn-circle  " >6</a>
                        </div>
                        <div title="Exame Admissional" class="stepwizard-step col-md-auto">
                            <a href="exame.php?id=<?=$id?>" type="button"   id="botao7" class="btn btn-default btn-circle  " >7</a>
                        </div>
                        <div title= "Dados Bancários" class="stepwizard-step col-md-auto">
                            <a href="bancarios.php?id=<?=$id?>" type="button" id="botao8" class="btn btn-default btn-circle  " >8</a>
                        </div>
                        <div title= "Suporte Interno" class="stepwizard-step col-md-auto">
                            <a href="suporteinterno.php?id=<?=$id?>" type="button" id="botao9" class="btn btn-default btn-circle  " >9</a>
                        </div>
                        <div title = "Interno" class="stepwizard-step col-md-auto">
                            <a href="interno.php?id=<?=$id?>" type="button" id="botao10" class="btn btn-default btn-circle  " >10</a>
                        </div>
                        <div title= "Vias Documentos funcionários" class="stepwizard-step col-md-auto">
                            <a href="viasdocumentos.php?id=<?=$id?>" type="button" id="botao11" class="btn btn-default btn-circle  " >11</a>
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
                        <th colspan='8'>Gestão</th>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <th>Gestor</th>
                        <th>Gestor sabe?</th>
                        <th>Gestor local</th>
                        <th>Gestor local sabe?</th>
                        <th>Quem do projeto receberá a pessoa?</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($rows_dados = mysqli_fetch_assoc($resultado)) {  ?>
                        <tr>
                            <td><?=$status['STATUS']; ?></td>
                            <td><?php echo $rows_dados['GESTOR']; ?></td>
                            <td><?php echo $rows_dados['GESTOR_SABE']; ?></td>
                            <td><?php echo $rows_dados['GESTOR_LOCAL']; ?></td>
							<td><?php echo $rows_dados['GESTOR_LOCAL_sABE']; ?></td>
							<td><?php echo $rows_dados['RECEPTOR_PESSOA']; ?></td>
                            <?php unset($_GET['id']); ?>
                            <td><a title="Vencimentos Contratos" id="proximo" class="  btn btn-default" href="vencimentosContratos.php"> Próximo </td>
                            <td><button title="Editar" type="button" class="bto-update btn btn-default curInputs">Editar</button></span></button></td>
                        </tr>
                    <?php  } ?>
                    <tr class='funcionario atualiza'>
                        <form method="POST" action="../alteraTelas/altera-gestor.php?id=<?=$id?>">
                            <input type="hidden" name="ID_USUARIO" value="<?php echo $funcionario['ID_USUARIO']?>">
                            <td><input class='intable' readonly name="STATUS" value='<?=$status['STATUS']?>'></td>
                            <td><input type='text' class='intable' name="GESTOR"  value="<?=$gestor['GESTOR']?>"></td>
                            <td><select class="intable" name ="GESTOR_SABE" >
                              <?php
                                  if($gestor_sabe['GESTOR_SABE']== NULL){?>
                                    <option value="<?=$gestor_sabe['GESTOR_SABE']?>"><?=$gestor_sabe['GESTOR_SABE']?></option>
                                    <option value="Sim">Sim</option>
                                    <option value="Não">Não</option>
                              <?php
                                  }elseif($gestor_sabe['GESTOR_SABE'] == "Sim"){ ?>
                                    <option value="<?=$gestor_sabe['GESTOR_SABE']?>"><?=$gestor_sabe['GESTOR_SABE']?></option>
                                    <option value="Não">Não</option>
                              <?php
                            }else{?>
                                    <option value="<?=$gestor_sabe['GESTOR_SABE']?>"><?=$gestor_sabe['GESTOR_SABE']?></option>
                                    <option value="Sim">Sim</option>
                              <?php
                                  }
                               ?>
                            </select></td>
                            <td><input type="text" class='intable' name="GESTOR_LOCAL"  value="<?=$gestor_local['GESTOR_LOCAL']?>"></td>
                            <td><select class="intable" name ="GESTOR_LOCAL_sABE" >
                              <?php
                                  if($gestorL_sabe['GESTOR_LOCAL_sABE']== NULL){?>
                                    <option value="<?=$gestorL_sabe['GESTOR_LOCAL_sABE']?>"><?=$gestorL_sabe['GESTOR_LOCAL_sABE']?></option>
                                    <option value="Sim">Sim</option>
                                    <option value="Não">Não</option>
                              <?php
                                  }elseif($gestorL_sabe['GESTOR_LOCAL_sABE'] == "Sim"){ ?>
                                    <option value="<?=$gestor_sabe['GESTOR_LOCAL_sABE']?>"><?=$gestor_sabe['GESTOR_LOCAL_sABE']?></option>
                                    <option value="Não">Não</option>
                              <?php
                            }else{?>
                                    <option value="<?=$gestor_sabe['GESTOR_LOCAL_sABE']?>"><?=$gestor_sabe['GESTOR_LOCAL_sABE']?></option>
                                    <option value="Sim">Sim</option>
                              <?php
                                  }
                               ?>
                            </select></td>
                            <td><input type="text" id='campo' class='intable' name="RECEPTOR_PESSOA"  value="<?=$receptor['RECEPTOR_PESSOA']?>"></td>
                            <td></td>
                            <td><button title="Salvar" type="submit" class="botao-salvar btao btn btn-default">Salvar</td>
                        </form>
                    </tr>
                </tbody>
            </table>
        </section>
            <section class="legendas estruct">
                <h2>Legendas</h2>
                <table id='table-legendas'>
                    <tr class='tb2'>
                        <th class='tb2'>STATUS</th>
                        <th class='tb2'>TIPO</th>
                    </tr>
                    <tr class='tb2'>
                        <td class='tb2'>AGUARDAR ACEITE</td>
                        <td class='tb2'>Aguardando o Aceite após o envio da proposta</td>
                    </tr>
                    <tr class='tb2'>
                        <td class='tb2'>FINALIZADO</td>
                        <td class='tb2'>Admissao concluída</td>
                    </tr>
                    <tr>
                        <td class='tb2'>DESISTENCIA</td>
                        <td class='tb2'>Aceitou a proposta, mas desistiu antes da admissão</td>
                    </tr>
                    <tr>
                        <td class='tb2'>EM ANDAMENTO</td>
                        <td class='tb2'>Em andamento admissão</td>
                    </tr>
                    <tr>
                        <td class='tb2'>EM CONTRATO</td>
                        <td class='tb2'>Em contrato, admissão concluída, pendente os envios de contrato</td>
                    </tr>
                    <tr class='tb2'>
                        <td class='tb2'>EM VALIDAÇÃO</td>
                        <td class='tb2'>Dados da proposta estão em validação antes do envio</td>
                    </tr>
                    <tr>
                        <td class='tb2'>RETORNO DOCS</td>
                        <td class='tb2'>Aguardando documentos de admissão assinados pelo funcionário</td>
                    </tr>
                    <tr class='tb2'>
                        <td class='tb2'>NEGOCIAÇÃO</td>
                        <td class='tb2'>Quando o candato faz uma contraproposta e estamos negociando com o Gestor</td>
                    </tr>
                    <tr class='tb2'>
                        <td class='tb2'>REALIZAR CONTATO</td>
                        <td class='tb2'>Time Contratações ainda não entrou em contato com o canditado para verificar se o profissional irá aceitar a proposta</td>
                    </tr>
                    <tr class='tb2'>
                        <td class='tb2'>CONTATO REALIZADO</td>
                        <td class='tb2'>Time Contratações realizou contato com o canditado para verificar se o profissional irá aceitar a proposta</td>
                    </tr>
                    <tr class='tb2'>
                        <td class='tb2'>RETORNO PENDENTE</td>
                        <td class='tb2'>Aguardando retorno do profissional do aceite da proposta</td>
                    </tr>
                    <tr class='tb2'>
                        <td class='tb2'>RECUSADO</td>
                        <td class='tb2'>Profissional recusou a proposta contratação</td>
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
    <script src='../js/desabilitaStepWizard.js'></script>
    <script>
        let grupo = "<?=$grupo?>";
            window.onload = () => {
            if(grupo == "Gestores"){
                desbilitaStepWizard(2,4,5,6,7,8,9,10,11);
                $("#proximo").prop("disabled", true);
                $("#proximo").attr("disabled", true);
                $("#proximo").attr("href", "#");
            }
            
        }
    </script>
    <script>
        
    </script>
</body>
</html>
