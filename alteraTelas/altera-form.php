<?php
include("../db/conexao.php");
include_once("../update.php");
require_once('../validacoes/login/user.php');

$id = $_GET['id'];
$funcionarios = buscaFuncionarios($conn, $id);

$get_dados = "SELECT * FROM admissao_dominio WHERE USUARIO_ID = '$id'";
$return_dados_1 = mysqli_query($conn, $get_dados);
$return_dados_2 = mysqli_query($conn, $get_dados);


$get_sede = "SELECT DISTINCT ID_SEDE, NOME_SEDE, SEDE_ID FROM admissao_dominio as a RIGHT JOIN sede as s on s.SEDE_ID = a.ID_SEDE";
$return_sede = mysqli_query($conn, $get_sede);

$get_tipo = "SELECT DISTINCT ID_TIPO, NOME_TIPO, TIPO_ID FROM admissao_dominio as a RIGHT JOIN tipo as t on t.TIPO_ID = a.ID_TIPO";
$return_tipo = mysqli_query($conn, $get_tipo);

$get_captacao = "SELECT DISTINCT ID_CAPTACAO, NOME_PARAMETRO, CAPTACAO_ID FROM admissao_dominio as a RIGHT JOIN parametros_captacao as p on p.CAPTACAO_ID = a.ID_CAPTACAO";
$return_captacao = mysqli_query($conn, $get_captacao);

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>RH Contratações</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/arquivo.css">
    <link rel="stylesheet" href="../css/menuPrincipal.css">



</head>

<body>
    <header class="site-header">
        <img src="http://www.compasso.com.br/wp-content/uploads/2018/04/Logo_Compasso_01-mini.png" alt="Compasso Tecnologia">
        <nav>
            <a class='nav inicio' href='../telas/menuPrincipal.php'>Início</a>
        </nav>
    </header>
    <main>
        <section class='menu-inicial'>
            <h2 id='nome'>Altera Funcionário</h2>
        </section>
        <section class=" container estruct">
            <table id="first-table">
                <h2 id='titulo-table'></h2>
                <thead>
                    <tr>
                        <th width='200px'>Status</th>
                        <th width='200px'>Nome</th>
                        <th width='110px'>Data Admissão</th>
                        <th width='60px'>Sede</th>
                        <th width='60px'>Tipo</th>
                        <th width='100px'>Captação</th>
                        <th width='100px'>Carga Horária</th>
                        <th width='150px'>Horário</th>

                        <th width='200px'>Sexo</th>
                        <th width='150px'>Fone</th>
                        <th width='200px' <?php if ($grupo == "Suporte Interno") {
                                                echo 'style="display: none;"';
                                            } ?>>Cargo</th>
                        <th width='110px'>Log Registro Dia RH Envia DP</th>
                        <th width='100px' <?php if ($grupo == "Suporte Interno") {
                                                echo 'style="display: none;"';
                                            } ?>>Remuneração Base</th>
                        <th width='100px' <?php if ($grupo == "Suporte Interno") {
                                                echo 'style="display: none;"';
                                            } ?>>Gratificação</th>
                        <th width='200px'>Solicitante</th>
                        <th width='150px'>Cliente</th>
                        <th width='150px'>Projeto</th>
                        <th width='330px'>Email Pessoal</th>


                        <th width='200px'>Posição(Comentários)</th>
                        <th width='200px'>Administrativo + Flyback - Hotel</th>
                        <th scope="col" width='200px'>Comentários</th>
                        <th scope="col" width='150px'></th>


                    </tr>
                </thead>

                <tbody>

                    <form id='altera-func' method='POST' action='altera-funcionario.php'>
                        <input type='hidden' name="USUARIO_ID" value='<?php echo $funcionarios['USUARIO_ID'] ?>' />

                        <td><select name="status" class="intable" value="<?= $rows_dados['STATUS'] ?>" required>
                                <option value="" selected="selected"></option>
                                <option>SOLICITAÇÃO DE PROPOSTA</option>
                                <option>AGUARDANDO APROVAÇÃO</option>
                                <option>APROVADO DIRETORIA</option>
                                <option>EM VALIDAÇÃO</option>
                                <option>NEGOCIAÇÃO</option>
                                <option>PROPOSTA ENVIADA</option>
                                <option>PROPOSTA ACEITA</option>
                                <option>EM ANDAMENTO</option>
                                <option>PROPOSTA INVÁLIDA</option>
                                <option>EM CONTRATO</option>
                                <option>RETORNO DOCS</option>
                                <option>DESISTENCIA</option>
                                <option>RECUSADO</option>
                            </select></td>

                        <td id='add-nome'><input class='intable' type="text" name="NOME" value="<?= $funcionarios['NOME']; ?>"></td>
                        <td id='add-admissao'><input class='intable' type="date" name="DATA_ADMISSAO" value="<?= $funcionarios['DATA_ADMISSAO']; ?>"></td>
                        <td><select name="ID_SEDE" class="selectadd intable" id="recipient-funcao">
                                <option>Escolha...</option>
                                <?php while ($rows_funcoes = mysqli_fetch_assoc($return_sede)) { ?>
                                    <option value="<?php echo $rows_funcoes['SEDE_ID']; ?>" <?php if ($rows_funcoes['SEDE_ID'] == $funcionarios['ID_SEDE']) {
                                                                                                    echo "selected";
                                                                                                } ?>><?php echo $rows_funcoes['NOME_SEDE']; ?></option>
                                <?php } ?>
                            </select></td>

                        <td width="100px"><select id="tipo" class="selectadd intable" name='ID_TIPO'>
                                <option>Escolha...</option>
                                <?php while ($rows_funcoes = mysqli_fetch_assoc($return_tipo)) { ?>
                                    <option value="<?php echo $rows_funcoes['TIPO_ID']; ?>" <?php if ($rows_funcoes['TIPO_ID'] == $funcionarios['ID_TIPO']) {
                                                                                                    echo "selected";
                                                                                                } ?>><?php echo $rows_funcoes['NOME_TIPO']; ?></option>
                                <?php } ?>
                            </select></td>

                        <td><select name="ID_CAPTACAO" class="selectadd intable" id="recipient-funcao">
                                <option>Escolha...</option>
                                <?php while ($rows_funcoes = mysqli_fetch_assoc($return_captacao)) { ?>
                                    <option value="<?php echo $rows_funcoes['CAPTACAO_ID']; ?>" <?php if ($rows_funcoes['CAPTACAO_ID'] == $funcionarios['ID_CAPTACAO']) {
                                                                                                        echo "selected";
                                                                                                    } ?>><?php echo $rows_funcoes['NOME_PARAMETRO']; ?></option>
                                <?php } ?>
                            </select></td>

                        <?php $REMUNERACAO_BASE = number_format($funcionarios['REMUNERACAO_BASE'], 2, ',', '.'); ?>
                        <?php $GRATIFICACAO = number_format($funcionarios['GRATIFICACAO'], 2, ',', '.'); ?>


                        <td id='add-carga_horaria'><input class='intable' type="text" name="CARGA_HORARIA" value="<?= $funcionarios['CARGA_HORARIA']; ?>"></td>
                        <td id='add-horario'><input class='intable' type="text" name="HORARIO" value="<?= $funcionarios['HORARIO']; ?>"></td>

                        <td><select name="sexo" class="intable" value="<?= $rows_dados['SEXO'] ?>">
                                <option value="" selected="selected"></option>
                                <option>Não informou</option>
                                <option>Masculino</option>
                                <option>Feminino</option>
                                <option>Não definido</option>
                            </select></td>
                        <td id='add-fone'><input class='intable' type="tel" name="FONE_CONTATO" value="<?= $funcionarios['FONE_CONTATO']; ?>"></td>
                        <td id="add-cargo" <?php if ($grupo == "Suporte Interno") {
                                                echo 'style="display: none;"';
                                            } ?>><input class='intable' type="text" name="CARGO" value="<?= $funcionarios['CARGO']; ?>"></td>
                        <td id='add-log-registro-dia-rh-envia-dp'><input class='intable' type="date" name="LOG_REGISTRO_DIA_RH_ENVIA_DP" value="<?= $funcionarios['LOG_REGISTRO_DIA_RH_ENVIA_DP']; ?>"></td>
                        <td id="add-remuneracao" <?php if ($grupo == "Suporte Interno") {
                                                        echo 'style="display: none;"';
                                                    } ?>><input class='intable' type="text" name="REMUNERACAO_BASE" value="<?= $REMUNERACAO_BASE ?>"></td>
                        <td id="add-gratificacao" <?php if ($grupo == "Suporte Interno") {
                                                        echo 'style="display: none;"';
                                                    } ?>><input class='intable' type="text" name="GRATIFICACAO" value="<?= $GRATIFICACAO ?>"></td>
                        <td id='add-solicitante'><input class='intable' type="text" name="SOLICITANTE" value="<?= $funcionarios['SOLICITANTE']; ?>"></td>
                        <td id='add-cliente'><input class='intable' type="text" name="CLIENTE" value="<?= $funcionarios['CLIENTE']; ?>"></td>
                        <td id='add-projeto'><input class='intable' type="text" name="PROJETO" value="<?= $funcionarios['PROJETO']; ?>"></td>
                        <td id='add-email'><input class='intable' type="email" name="EMAIL" value="<?= $funcionarios['EMAIL']; ?>"></td>


                        <td id='add-posicao_comentario'><input class='intable' type="text" name="POSICAO_COMENTARIO" value="<?= $funcionarios['POSICAO_COMENTARIO']; ?>"></td>
                        <td id='add-administrativo'><input class='intable' type="text" name="ADMINISTRATIVO" value="<?= $funcionarios['ADMINISTRATIVO']; ?>"></td>
                        <td id='add-comentario'><input class='intable' type="text" name="COMENTARIOS" value="<?= $funcionarios['COMENTARIOS']; ?>"></td>
                        <td><button class="btn btn-default" type="submit" >Alterar</button></td>
                    </form>

                </tbody>
            </table>

        </section>
        <section class="container estruct">
            <h2 class="titulo" align='center'>Legendas</h2>
            <table id='table-legendas'>
                <tr class='tb2'>
                    <th class='tb2'>STATUS</th>
                    <th class='tb2'>TIPO</th>
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
                    <td class='tb2'> PROPOSTA ACEITA</td>
                    <td class='tb2'>Profissional aceitou a proposta</td>
                </tr>
                <tr class='tb2'>
                    <td class='tb2'> EM ANDAMENTO</td>
                    <td class='tb2'>DP aprovou a proposta e seguirá a admissão</td>
                </tr>
                <tr class='tb2'>
                    <td class='tb2'> PROPOSTA INVÁLIDA</td>
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
                    <td class='tb2'> DESISTENCIA</td>
                    <td class='tb2'>Profissional desistiu da admissão após aceite</td>
                </tr>
                <tr class='tb2'>
                    <td class='tb2'>E-MAIL RECUSADO</td>
                    <td class='tb2'>Profissional recusou a proposta</td>
                </tr>
            </table>
            <table class='legendas-sedes'>
        <tr>
            <th scope="col" class='tb2'>SEDE</th>
            <th scope="col" class='tb2'>NOME</th>
        </tr>
        <tr>
            <td class='tb2'>CWB</td>
            <td class='tb2'>Curitiba</td>
        </tr>
        <tr>
            <td class='tb2'>ERE</td>
            <td class='tb2'>Erechim</td>
        </tr>
        <tr>
            <td class='tb2'>PF</td>
            <td class='tb2'>Passo Fundo</td>
        </tr>
        <tr>
            <td class='tb2'>POA</td>
            <td class='tb2'>Porto Alegre</td>
        </tr>
        <tr>
            <td class='tb2'>RG</td>
            <td class='tb2'>Rio Grande</td>
        </tr>
        <tr>
            <td class='tb2'>SP</td>
            <td class='tb2'>São Paulo</td>
        </tr>
        <tr>
            <td class='tb2'>FLN</td>
            <td class='tb2'>Florianópolis</td>
        </tr>
        <tr>
            <td class='tb2'>XAP</td>
            <td class='tb2'>Chapecó</td>
        </tr>
        <tr>
            <td class='tb2'>REC</td>
            <td class='tb2'>Recife</td>
        </tr>
    </table>
            <table class='legendas-tipos'>
                <tr>
                    <th class='tb2'>TIPO</th>
                    <th class='tb2'>COMENTÁRIOS</th>
                </tr>
                <tr>
                    <td class='tb2'>CLT</td>
                    <td class='tb2'>Celetista</td>
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
            <table class='legendas-tipos'>
                <tr>
                    <th class='tb2'>Captação</th>
                </tr>
                <tr>
                    <td class='tb2'>Novo</td>

                </tr>
                <tr>
                    <td class='tb2'>Ex-Estagiário</td>

                </tr>
                <tr>
                    <td class='tb2'>Ex-Funcionário</td>

                </tr>
                <tr>
                    <td class='tb2'>Ex-Bolsista</td>
                </tr>
            </table>
        </section>
    </main>

    <script src="../js/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../js/funcionamento.js"></script>
    <script src="../js/filter.js"></script>
    <script src='../js/desabilitaStepWizard.js'></script>

</body>
