<?php
require_once('../validacoes/login/user.php');
include("../db/conexao.php");
include("../update.php");

$listar = listar($conn);

    if (!isset ($id)){
     $id = $_SESSION['id'];
    }

$resultado1 = mysqli_query($conn,"SELECT ID_USUARIO, NOME, DATE_FORMAT(DATA_ADMISSAO,'%d/%m/%Y') as DATA_ADMISSAO,STATUS FROM propostas_contratacoes as p LEFT JOIN admissao_dominio as a on p.ID_USUARIO = a.USUARIO_ID where ID_USUARIO = '$id'");
$conn1 = mysqli_num_rows($resultado1);

$resultado = mysqli_query($conn, "SELECT `ID_INTERNO`, `ID_USUARIO`,DATE_FORMAT(INTRANET_CADASTRO_USUARIO,'%d/%m/%Y') as INTRANET_CADASTRO_USUARIO, `INTRANET_CADASTRO_SENHA`,DATE_FORMAT(KAIROS_CADASTRO_USUARIO,'%d/%m/%Y') as KAIROS_CADASTRO_USUARIO, `KAIROS_CADASTRO_SENHA`, DATE_FORMAT(EMAIL_GESTOR_APOIO_SEDE,'%d/%m/%Y') as EMAIL_GESTOR_APOIO_SEDE, DATE_FORMAT(EMAIL_INICIO_ATIVIDADES,'%d/%m/%Y') as EMAIL_INICIO_ATIVIDADES, DATE_FORMAT(EMAIL_BOAS_VINDAS,'%d/%m/%Y') as EMAIL_BOAS_VINDAS, DATE_FORMAT(ACESSOS,'%d/%m/%Y') as ACESSOS
FROM `interno` AS i LEFT JOIN admissao_dominio AS a ON i.ID_USUARIO = a.USUARIO_ID WHERE ID_USUARIO = '$id'");
$count = mysqli_num_rows($resultado);

if($count == 1){
    $resultado = mysqli_query($conn, "SELECT `ID_INTERNO`, `ID_USUARIO`,DATE_FORMAT(INTRANET_CADASTRO_USUARIO,'%d/%m/%Y') as INTRANET_CADASTRO_USUARIO, `INTRANET_CADASTRO_SENHA`,DATE_FORMAT(KAIROS_CADASTRO_USUARIO,'%d/%m/%Y') as KAIROS_CADASTRO_USUARIO, `KAIROS_CADASTRO_SENHA`, DATE_FORMAT(EMAIL_GESTOR_APOIO_SEDE,'%d/%m/%Y') as EMAIL_GESTOR_APOIO_SEDE, DATE_FORMAT(EMAIL_INICIO_ATIVIDADES,'%d/%m/%Y') as EMAIL_INICIO_ATIVIDADES, DATE_FORMAT(EMAIL_BOAS_VINDAS,'%d/%m/%Y') as EMAIL_BOAS_VINDAS, DATE_FORMAT(ACESSOS,'%d/%m/%Y') as ACESSOS
    FROM `interno` AS i LEFT JOIN admissao_dominio AS a ON i.ID_USUARIO = a.USUARIO_ID WHERE ID_USUARIO = '$id'");
}else{
    mysqli_query($conn,"INSERT INTO `interno`(`ID_INTERNO`, `ID_USUARIO`, `INTRANET_CADASTRO_USUARIO`, `INTRANET_CADASTRO_SENHA`, `KAIROS_CADASTRO_USUARIO`, `KAIROS_CADASTRO_SENHA`, `EMAIL_GESTOR_APOIO_SEDE`, `EMAIL_INICIO_ATIVIDADES`, `EMAIL_BOAS_VINDAS`, `ACESSOS`) VALUES (NULL, '$id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)");

    $resultado = mysqli_query($conn, "SELECT `ID_INTERNO`, `ID_USUARIO`,DATE_FORMAT(INTRANET_CADASTRO_USUARIO,'%d/%m/%Y') as INTRANET_CADASTRO_USUARIO, `INTRANET_CADASTRO_SENHA`,DATE_FORMAT(KAIROS_CADASTRO_USUARIO,'%d/%m/%Y') as KAIROS_CADASTRO_USUARIO, `KAIROS_CADASTRO_SENHA`, DATE_FORMAT(EMAIL_GESTOR_APOIO_SEDE,'%d/%m/%Y') as EMAIL_GESTOR_APOIO_SEDE, DATE_FORMAT(EMAIL_INICIO_ATIVIDADES,'%d/%m/%Y') as EMAIL_INICIO_ATIVIDADES, DATE_FORMAT(EMAIL_BOAS_VINDAS,'%d/%m/%Y') as EMAIL_BOAS_VINDAS, DATE_FORMAT(ACESSOS,'%d/%m/%Y') as ACESSOS
    FROM `interno` AS i LEFT JOIN admissao_dominio AS a ON i.ID_USUARIO = a.USUARIO_ID WHERE ID_USUARIO = '$id'");
}

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

?>

    <?php echo file_get_contents("telasHeader.html"); ?>
    
    <main>
        <section class='menu-inicial'>
            <h2 id='nome'>Interno</h2>
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
                            <a href="gestao.php?id=<?=$id?>" id="gestao" type="button" class="btn btn-default btn-circle ">3</a>
                        </div>
                        <div title="Vencimento Contratos" class="stepwizard-step col-md-auto">
                            <a href="vencimentosContratos.php?id=<?=$id?>" id="botao"  type="button" class="btn btn-default btn-circle  ">4</a>
                        </div>
                        <div title="Documentação" class="stepwizard-step col-md-auto">
                            <a href="documentacao.php?id=<?=$id?>" type="button" id="botao5"  class="btn btn-default btn-circle ">5</a>
                        </div>
                        <div title= "Plataforma Admissão Domínio Dados + Fichas de Cadastro" class="stepwizard-step col-md-auto">
                            <a href="admissao.php?id=<?=$id?>" type="button" id="botao6"  class="btn btn-default  btn-circle" >6</a>
                        </div>
                        <div title="Exame Admissional" class="stepwizard-step col-md-auto">
                            <a href="exame.php?id=<?=$id?>" type="button" id="botao7"  class="btn btn-default  btn-circle" >7</a>
                        </div>
                        <div title= "Dados Bancários" class="stepwizard-step col-md-auto">
                            <a href="bancarios.php?id=<?=$id?>" type="button"  id="botao8" class="btn btn-default  btn-circle" >8</a>
                        </div>
                        <div title= "Suporte Interno" class="stepwizard-step col-md-auto">
                            <a href="suporteinterno.php?id=<?=$id?>"  id="botao9" type="button" class="btn btn-default  btn-circle" >9</a>
                        </div>
                        <div title = "Interno" class="stepwizard-step col-md-auto">
                            <a href="interno.php?id=<?=$id?>"  id="botao10" type="button" class="btn btn-success  btn-circle" >10</a>
                        </div>
                        <div title= "Vias Documentos funcionários" class="stepwizard-step col-md-auto">
                            <a href="viasdocumentos.php?id=<?=$id?>" id="botao11"  type="button" class="btn btn-default  btn-circle" >11</a>
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
                        <th width='200px'>Status</th>
                        <th colspan='2'  >Intranet</th>
                        <th colspan='2'  >Kairos</th>
                        <th colspan='3'  >E-mail</th>
                        <th>Acessos</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>Cadastro Usuário</th>
                        <th>Senha</th>
                        <th>Cadastro Usuário</th>
                        <th>Código/Senha</th>
                        <th>Gestor + Apoio Sede</th>
                        <th>E-mail Início<br/> das Atividades</th>
                        <th>E-mail Boas Vindas</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($rows_dados = mysqli_fetch_assoc($resultado)) {  ?>
                    <tr>
                        <td><?=$status['STATUS']?></td>
                        <td id="data"><?php echo $rows_dados['INTRANET_CADASTRO_USUARIO']; ?></td>
                        <td <?php if($rows_dados['INTRANET_CADASTRO_SENHA'] == ""){echo($campoV);} ?>><?php echo $rows_dados['INTRANET_CADASTRO_SENHA']; ?></td>
                        <td id="data2"><?php echo $rows_dados['KAIROS_CADASTRO_USUARIO']; ?></td>
                        <td <?php if($rows_dados['KAIROS_CADASTRO_SENHA'] == ""){echo($campoV);} ?>><?php echo $rows_dados['KAIROS_CADASTRO_SENHA']; ?></td>
                        <td id="data3"><?php echo $rows_dados['EMAIL_GESTOR_APOIO_SEDE']; ?></td>
                        <td id="data4"><?php echo $rows_dados['EMAIL_INICIO_ATIVIDADES']; ?></td>
                        <td id="data5"><?php echo $rows_dados['EMAIL_BOAS_VINDAS']; ?></td>
                        <td id="data6"><?php echo $rows_dados['ACESSOS']; ?></td>
                        <td><a title="Vias Documentos Funcionários" id="proximo" class="  btn btn-default" href="viasdocumentos.php?id=<?=$id?>"> Próximo </td>
                        <td><button title="Editar" type="button" class="bto-update btn btn-default curInputs">Editar</button></span></button></td>
                    </tr>
                    <?php } ?>
                    <tr class='funcionario atualiza'>
                        <form method="POST" action="../alteraTelas/altera-interno.php">
                            <input type="hidden" name="ID_USUARIO" value="<?php echo $funcionario['ID_USUARIO']?>">
                            <td><input class='intable' readonly name="STATUS" value='<?=$status['STATUS']?>'></td>
                            <td><input type='date' id="campo" class='intable' name="INTRANET_CADASTRO_USUARIO"  value="<?=$intranetusu['INTRANET_CADASTRO_USUARIO']?>"></td>
                            <td><input type="text" class='intable' name ="INTRANET_CADASTRO_SENHA" value="<?=$intranetsen['INTRANET_CADASTRO_SENHA']?>"></td>
                            <td><input type="date" id="campo2" class='intable' name="KAIROS_CADASTRO_USUARIO"  value="<?=$kairosusu['KAIROS_CADASTRO_USUARIO']?>"></td>
                            <td><input type="text" class='intable' name="KAIROS_CADASTRO_SENHA" value="<?=$kairossen['KAIROS_CADASTRO_SENHA']?>"></td>
                            <td><input type="date" id="campo3" class='intable' name="EMAIL_GESTOR_APOIO_SEDE"  value='<?=$emailges['EMAIL_GESTOR_APOIO_SEDE']?>'></td>
                            <td><input type='date' id="campo4" class='intable' name="EMAIL_INICIO_ATIVIDADES"  value="<?=$emailinic['EMAIL_INICIO_ATIVIDADES']?>"></td>
                            <td><input class='intable' id="campo5" type="date" name="EMAIL_BOAS_VINDAS"  value='<?=$emailboas['EMAIL_BOAS_VINDAS']?>'></td>
                            <td><input type='date' id="campo6" class='intable' name="ACESSOS"  value="<?=$acessos['ACESSOS']?>"></td>
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
        if(document.getElementById("campo6").value == ""){
            $("#data6").addClass("dataVazia");
        }
    }               
    </script>          
</body>

</html>
