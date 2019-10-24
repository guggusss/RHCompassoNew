<?php
   
    require_once('../validacoes/login/user.php');
    include("../db/conexao.php");
    include("../update.php");

    $listar = listar($conn);

    if (!isset ($id)){
     $id = $_SESSION['id'];
    }

$resultado1 = mysqli_query($conn,"SELECT ID_USUARIO, NOME,DATE_FORMAT(DATA_ADMISSAO,'%d/%m/%Y') as DATA_ADMISSAO,STATUS FROM propostas_contratacoes as p LEFT JOIN admissao_dominio as a on p.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
$conn1 = mysqli_num_rows($resultado1);
$status = buscaFuncionarios($conn, $id);
$campoV = 'class="txtVazio" ';

    //$count =  mysqli_num_rows($conn,"SELECT COUNT(*) FROM propostas_contratacoes WHERE ID_USUARIO = '$id'");
    $resultado = mysqli_query($conn, "SELECT `ID_VENCIMENTO`, `ID_USUARIO`, DATE_FORMAT(ENVIO_SOLICITANTE_PRI,'%d/%m/%Y') as ENVIO_SOLICITANTE_PRI, DATE_FORMAT(DATA_VENCIMENTO_PRI,'%d/%m/%Y') as DATA_VENCIMENTO_PRI, `RENOVACAO`, DATE_FORMAT(ENVIO_SOLICITANTE_SEG,'%d/%m/%Y') as ENVIO_SOLICITANTE_SEG, DATE_FORMAT(DATA_VENCIMENTO_SEG,'%d/%m/%Y') as DATA_VENCIMENTO_SEG, `EFETIVACAO` FROM `vencimentos` as d LEFT JOIN admissao_dominio as a on d.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
    $count = mysqli_num_rows($resultado);

    if($count == 1){
        $resultado = mysqli_query($conn, "SELECT `ID_VENCIMENTO`, `ID_USUARIO`, DATE_FORMAT(ENVIO_SOLICITANTE_PRI,'%d/%m/%Y') as ENVIO_SOLICITANTE_PRI, DATE_FORMAT(DATA_VENCIMENTO_PRI,'%d/%m/%Y') as DATA_VENCIMENTO_PRI, `RENOVACAO`, DATE_FORMAT(ENVIO_SOLICITANTE_SEG,'%d/%m/%Y') as ENVIO_SOLICITANTE_SEG, DATE_FORMAT(DATA_VENCIMENTO_SEG,'%d/%m/%Y') as DATA_VENCIMENTO_SEG, `EFETIVACAO` FROM `vencimentos` as d LEFT JOIN admissao_dominio as a on d.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
    }else{
        $controleDataAdmissao = date_create($status['LOG_REGISTRO_DIA_RH_ENVIA_DP']);
        date_modify( $controleDataAdmissao, '+ 44 day');
        $vencimentoPri = date_format($controleDataAdmissao, 'Y-m-d');
        $vencimentoPriAux = date_create($vencimentoPri);
        date_modify($vencimentoPriAux, '- 10 day');
        $envioSolicitante1 = date_format($vencimentoPriAux, 'Y-m-d');
        $controleDataAdmissao2 = date_create($status['LOG_REGISTRO_DIA_RH_ENVIA_DP']);
        date_modify( $controleDataAdmissao2, '+ 89 day');
        $vencimentoSec =  date_format($controleDataAdmissao2, 'Y-m-d');
        $vencimentoSecAux = date_create($vencimentoSec);;
        date_modify($vencimentoSecAux, '- 10 day');
        $envioSolicitante2 = date_format($vencimentoSecAux, 'Y-m-d');

        mysqli_query($conn,"INSERT INTO `vencimentos`(`ID_VENCIMENTO`, `ID_USUARIO`, `ENVIO_SOLICITANTE_PRI`, `DATA_VENCIMENTO_PRI`, `RENOVACAO`, `ENVIO_SOLICITANTE_SEG`, `DATA_VENCIMENTO_SEG`, `EFETIVACAO`) VALUES (NULL,$id,'$envioSolicitante1','$vencimentoPri',NULL,'$envioSolicitante2','$vencimentoSec',NULL)");

        $resultado = mysqli_query($conn, "SELECT `ID_VENCIMENTO`, `ID_USUARIO`, DATE_FORMAT(ENVIO_SOLICITANTE_PRI,'%d/%m/%Y') as ENVIO_SOLICITANTE_PRI, DATE_FORMAT(DATA_VENCIMENTO_PRI,'%d/%m/%Y') as DATA_VENCIMENTO_PRI, `RENOVACAO`, DATE_FORMAT(ENVIO_SOLICITANTE_SEG,'%d/%m/%Y') as ENVIO_SOLICITANTE_SEG, DATE_FORMAT(DATA_VENCIMENTO_SEG,'%d/%m/%Y') as DATA_VENCIMENTO_SEG, `EFETIVACAO` FROM `vencimentos` as d LEFT JOIN admissao_dominio as a on d.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
    }


$funcionario = buscavencimentos($conn, $id);
$envio_Pri = buscavencimentos($conn, $id);
$renovacao = buscavencimentos($conn, $id);
$envio_seg = buscavencimentos($conn, $id);
$data_venc_seg = buscavencimentos($conn, $id);
$efetivacao = buscavencimentos($conn, $id);
$formRec = buscadocs($conn, $id);
$inclui = buscaadmissao($conn, $id);
$anexar = buscaexame($conn, $id);
$form = buscaBancario($conn, $id);
$emailges = buscainterno($conn, $id);
$emailsoli = buscavias($conn, $id);
$translado = buscasuporte($conn, $id);
?>

    <?php echo file_get_contents("telasHeader.html"); ?>
    
    <main>
        <section class='menu-inicial'>
            <h2 id='nome'>Vencimentos Contratos</h2>
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
                            <a href="vencimentosContratos.php?id=<?=$id?>" id="botao"  type="button" class="btn btn-success btn-circle">4</a>
                        </div>
                        <div title="Documentação" class="stepwizard-step col-md-auto">
                            <a href="documentacao.php?id=<?=$id?>" type="button" id="botao5"  class="btn btn-default btn-circle">5</a>
                        </div>
                        <div title= "Plataforma Admissão Domínio Dados + Fichas de Cadastro" class="stepwizard-step col-md-auto">
                            <a href="admissao.php?id=<?=$id?>" type="button" id="botao6"  class="btn btn-default  btn-circle" >6</a>
                        </div>
                        <div title="Exame Admissional" class="stepwizard-step col-md-auto">
                            <a href="exame.php?id=<?=$id?>" type="button" id="botao7" class="btn btn-default  btn-circle" >7</a>
                        </div>
                        <div title= "Dados Bancários" class="stepwizard-step col-md-auto">
                            <a href="bancarios.php?id=<?=$id?>" type="button" id="botao8" class="btn btn-default btn-circle" >8</a>
                        </div>
                        <div title= "Suporte Interno" class="stepwizard-step col-md-auto">
                            <a href="suporteinterno.php?id=<?=$id?>"  id="botao9" type="button" class="btn btn-default btn-circle" >9</a>
                        </div>
                        <div title = "Interno" class="stepwizard-step col-md-auto">
                            <a href="interno.php?id=<?=$id?>"  id="botao10" type="button" class="btn btn-default btn-circle" >10</a>
                        </div>
                        <div title= "Vias Documentos funcionários" class="stepwizard-step col-md-auto">
                            <a href="viasdocumentos.php?id=<?=$id?>" id="botao11"  type="button" class="btn btn-default btn-circle" >11</a>
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
                        <th></th>
                        <th colspan = '3'>1°Alerta Vencimento 45 dias <p>10DD</th>
                        <th colspan = '3'>2°Alerta Vencimetno 90 dias <p>20DD</th>
                        <th></th>
                        <th></th>

                    </tr>
                    <tr>
                        <th>Status</th>
                        <th>Envio Solicitante</th>
                        <th>Data do Vencimento</th>
                        <th>Renovação <p>S = Sim N = Não</th>
                        <th>Envio Solicitante</th>
                        <th>Data do Vencimento</th>
                        <th>Efetivção <p>S = Sim N = Não</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($rows_dados = mysqli_fetch_assoc($resultado)) {  ?>
                            <tr>
                            <td><?=$status['STATUS']?></td>
                            <td id="data"><?php echo $rows_dados['ENVIO_SOLICITANTE_PRI']; ?></td>
                            <td id="data2"><?php echo $rows_dados['DATA_VENCIMENTO_PRI']; ?></td>
                            <td <?php if($rows_dados['RENOVACAO'] == ""){echo($campoV);} ?>><?php echo $rows_dados['RENOVACAO']; ?></td>
                            <td id="data3"><?php echo $rows_dados['ENVIO_SOLICITANTE_SEG']; ?></td>
                            <td id="data4"><?php echo $rows_dados['DATA_VENCIMENTO_SEG']; ?></td>
                            <td <?php if($rows_dados['EFETIVACAO'] == ""){echo($campoV);} ?>><?php echo $rows_dados['EFETIVACAO']; ?></td>
                            <td><a title="Vencimentos Contratos" id="proximo" class="  btn btn-default" href="documentacao.php?id=<?=$id?>"> Próximo </td>
                            <td><button title="Editar" type="button" class="bto-update btn btn-default curInputs">Editar</button></span></button></td>


                        </tr>
                    <?php } ?>

                    <tr class='funcionario atualiza'>
                        <form method="POST" action="../alteraTelas/altera-vencimento.php">
                            <input type="hidden" name="ID_USUARIO" value="<?php echo $funcionario['ID_USUARIO']?>">
                            <td><input class='intable' readonly name="STATUS" value='<?=$status['STATUS']?>'></td>
                            <td><input type='date' id="campo" class='intable' name="ENVIO_SOLICITANTE_PRI" value="<?=$envio_Pri['ENVIO_SOLICITANTE_PRI']?>"></td>
                            <td><input type='date' id="campo2" class='intable' name ="DATA_VENCIMENTO_PRI" value="<?=$envio_Pri['DATA_VENCIMENTO_PRI']?>"></td>
                            <td><select class="intable" name="RENOVACAO" >
                              <?php
                                  if($renovacao['RENOVACAO'] == NULL){?>
                                    <option value="<?=$renovacao['RENOVACAO']?>"><?=$renovacao['RENOVACAO']?></option>
                                    <option value="Sim">Sim</option>
                                    <option value="Não">Não</option>
                              <?php
                                  }elseif($renovacao['RENOVACAO'] == "Sim"){ ?>
                                    <option value="<?=$renovacao['RENOVACAO']?>"><?=$renovacao['RENOVACAO']?></option>
                                    <option value="Não">Não</option>
                              <?php
                            }else{?>
                                    <option value="<?=$renovacao['RENOVACAO']?>"><?=$renovacao['RENOVACAO']?></option>
                                    <option value="Sim">Sim</option>
                              <?php
                                  }
                               ?>
                            </select></td>
                            <td><input type='date' id="campo3" class='intable' name="ENVIO_SOLICITANTE_SEG" value="<?=$envio_seg['ENVIO_SOLICITANTE_SEG']?>"></td>
                            <td><input type='date' id='campo4' class='intable' name="DATA_VENCIMENTO_SEG" value="<?=$data_venc_seg['DATA_VENCIMENTO_SEG']?>"></td>
                            <td><select class="intable" name="EFETIVACAO" >
                              <?php
                                  if($efetivacao['EFETIVACAO'] == NULL){?>
                                    <option value="<?=$efetivacao['EFETIVACAO']?>"><?=$efetivacao['EFETIVACAO']?></option>
                                    <option value="Sim">Sim</option>
                                    <option value="Não">Não</option>
                              <?php
                                  }elseif($efetivacao['EFETIVACAO'] == "Sim"){ ?>
                                    <option value="<?=$efetivacao['EFETIVACAO']?>"><?=$efetivacao['EFETIVACAO']?></option>
                                    <option value="Não">Não</option>
                              <?php
                            }else{?>
                                    <option value="<?=$efetivacao['EFETIVACAO']?>"><?=$efetivacao['EFETIVACAO']?></option>
                                    <option value="Sim">Sim</option>
                              <?php
                                  }
                               ?>
                            </select></td>
                            <td></td>
                            <td><button title="Salvar" type="submit" class="botao-salvar btao btn btn-default">Salvar</td>


                    </form>
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
    <script src="../js/calculaVencimento.js">
        calculaVencimento();
    </script>
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
    }               
    </script>
</body>
</html>
