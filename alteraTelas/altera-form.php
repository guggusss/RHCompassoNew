<?php
    include("../db/conexao.php");
    include_once("../update.php");

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
                    <th width='60px'>Sede</th>
                    <th width='60px'>Tipo</th>
                    <th width='100px'>Captação</th>
                    <th width='100px'>Carga Horária</th> 
                    <th width='150px'>Horário</th> 
                    <th width='200px'>Nome</th>
                    <th width='200px'>Sexo</th>
                    <th width='150px'>Fone</th>
                    <th width='200px'>Cargo</th>
                    <th width='110px'>Controle Data Admissão</th>
                    <th width='100px'>Remuneração Base</th>
                    <th width='100px'>Gratificação</th>
                    <th width='200px'>Solicitante</th>
                    <th width='150px'>Cliente</th>
                    <th width='150px'>Projeto</th>
                    <th width='330px'>Email</th>
                    <th width='110px'>Data Admissão</th>
                    <th width='110px'>Posição(Data)</th>
                    <th width='200px'>Posição(Comentários)</th>
                    <th width='200px'>Administrativo + Flyback - Hotel</th>
                    <th width='200px'>Comentários</th>
                    <th width='150px'></th>
                </tr>
            </thead>

            <tbody>
            
                <form  id='altera-func' method='POST' action='altera-funcionario.php'>
                    <input type='hidden' name="USUARIO_ID" value='<?php echo $funcionarios['USUARIO_ID']?>' />

                    <td><select name="ID_SEDE" class="selectadd intable" id="recipient-funcao">
                        <option>Escolha...</option>
                        <?php while($rows_funcoes = mysqli_fetch_assoc($return_sede)){ ?>
                            <option value="<?php echo $rows_funcoes['SEDE_ID']; ?>" <?php if($rows_funcoes['SEDE_ID'] == $funcionarios['ID_SEDE']){echo "selected";} ?>><?php echo $rows_funcoes['NOME_SEDE']; ?></option>
                        <?php } ?>
                    </select></td>
                    
                    <td width="100px"><select id="tipo" class="selectadd intable" name='ID_TIPO'>
                    <option>Escolha...</option>
                        <?php while($rows_funcoes = mysqli_fetch_assoc($return_tipo)){ ?>
                            <option value="<?php echo $rows_funcoes['TIPO_ID']; ?>" <?php if($rows_funcoes['TIPO_ID'] == $funcionarios['ID_TIPO']){echo "selected";} ?>><?php echo $rows_funcoes['NOME_TIPO']; ?></option>
                        <?php } ?>
                    </select></td>

                    <td><select name="ID_CAPTACAO" class="selectadd intable" id="recipient-funcao">
                        <option>Escolha...</option>
                        <?php while($rows_funcoes = mysqli_fetch_assoc($return_captacao)){ ?>
                            <option value="<?php echo $rows_funcoes['CAPTACAO_ID']; ?>" <?php if($rows_funcoes['CAPTACAO_ID'] == $funcionarios['ID_CAPTACAO']){echo "selected";} ?>><?php echo $rows_funcoes['NOME_PARAMETRO']; ?></option>
                        <?php } ?>
                    </select></td>
                            
                            <?php $REMUNERACAO_BASE = number_format($funcionarios['REMUNERACAO_BASE'], 2, ',', '.'); ?>
                            <?php $GRATIFICACAO = number_format($funcionarios['GRATIFICACAO'], 2, ',', '.'); ?>


                            <td id='add-carga_horaria'><input class='intable' type="text" name="CARGA_HORARIA" value = "<?=$funcionarios['CARGA_HORARIA']; ?>"></td>
                            <td id='add-horario'><input class='intable' type="text" name="HORARIO" value = "<?=$funcionarios['HORARIO']; ?>"></td>
                            <td id='add-nome'><input class='intable' type="text" name="NOME" value = "<?=$funcionarios['NOME']; ?>"></td>
                            <td><select name="sexo" class="intable" value="<?=$rows_dados['SEXO']?>">
                                <option value="" selected="selected"></option>
                                <option>Não informou</option>
                                <option>Masculino</option>
                                <option>Feminino</option>
                                <option>Não definido</option>
                            </select></td>
                            <td id='add-fone'><input class='intable' type="tel" name="FONE_CONTATO" value = "<?=$funcionarios['FONE_CONTATO']; ?>"></td>
                            <td id='add-cargo'><input class='intable' type="text" name="CARGO" value = "<?=$funcionarios['CARGO']; ?>"></td>
                            <td id='add-contole-data'><input class='intable' type="date" name="CONTROLE_DATA_ADMISSAO" value = "<?=$funcionarios['CONTROLE_DATA_ADMISSAO']; ?>"></td>
                            <td id='add-remuneracao'><input class='intable' type="text" name="REMUNERACAO_BASE" value = "<?=$REMUNERACAO_BASE?>"></td>
                            <td id='add-gratificacao'><input class='intable' type="text" name="GRATIFICACAO" value = "<?=$GRATIFICACAO?>"></td>
                            <td id='add-solicitante'><input  class='intable' type="text" name="SOLICITANTE" value = "<?=$funcionarios['SOLICITANTE']; ?>"></td>
                            <td id='add-cliente'><input class='intable' type="text" name="CLIENTE" value = "<?=$funcionarios['CLIENTE']; ?>"></td>
                            <td id='add-projeto'><input class='intable' type="text" name="PROJETO" value = "<?=$funcionarios['PROJETO']; ?>"></td>
                            <td id='add-email'><input class='intable' type="email" name="EMAIL" value = "<?=$funcionarios['EMAIL']; ?>"></td>
                            <td id='add-admissao'><input class='intable' type="date" name="DATA_ADMISSAO" value = "<?=$funcionarios['DATA_ADMISSAO']; ?>"></td>
                            <td id='add-posicao_data'><input class='intable' type="date" name="POSICAO_DATA" value = "<?=$funcionarios['POSICAO_DATA']; ?>"></td>
                            <td id='add-posicao_comentario'><input class='intable' type="text" name="POSICAO_COMENTARIO" value = "<?=$funcionarios['POSICAO_COMENTARIO']; ?>"></td>
                            <td id='add-administrativo'><input class='intable' type="text" name="ADMINISTRATIVO" value = "<?=$funcionarios['ADMINISTRATIVO']; ?>"></td>
                    <td><button class="btn btn-default" type="submit">Alterar</button></td>
                </form>
            
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
                <table class='legendas-sedes'>
                    <tr>
                        <th class='tb2'>SEDE</th>
                    </tr>
                    <tr><td class='tb2'>CWB</td></tr>
                    <tr><td class='tb2'>ERE</td></tr>
                    <tr><td class='tb2'>PF</td></tr>
                    <tr><td class='tb2'>POA</td></tr>
                    <tr><td class='tb2'>RG</td></tr>
                    <tr><td class='tb2'>SP</td></tr>
                    <tr><td class='tb2'>FLN</td></tr>
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
</body>