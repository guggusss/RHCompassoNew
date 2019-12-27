<?php
require_once('../validacoes/login/user.php');
include("../db/conexao.php");
include("../update.php");
include("../static/php/RemoveMascAndFormatDate.php");
$listar = listar($conn);
//if ($_GET['botaoLimpar']=='Limpar') {
if (isset($_POST['botaoVolta'])) {
    ?>    
    <meta http-equiv="refresh" content="0;  url=index.php"/>
<?php 
    
}
//if ($_GET['botao']=='Filtrar') {
if (isset($_POST['botaoVolta'])) {
    ?>    
    <meta http-equiv="refresh" content="0;  url=index.php"/>
<?php
}
//if ($_GET['botao']=='Filtrar') {
if (isset($_POST['botao'])) {

    $where = array();

    if (!empty($_POST['status'])) {
        $status = $_POST['status'];
        $where[] = " `STATUS` = '{$status}'";
    }
    if (!empty($_POST['sede'])) {
        $sede = $_POST['sede'];
        $where[] = " `ID_SEDE` = '{$sede}'";
    }
    if (!empty($_POST['tipo'])) {
        $tipo = $_POST['tipo'];
        $where[] = " `ID_TIPO` = '{$tipo}'";
    }
    if (!empty($_POST['captacao'])) {
        $captacao = $_POST['captacao'];
        $where[] = " `ID_CAPTACAO` = '{$captacao}'";
    }
    if (!empty($_POST['solicitante'])) {
        $solicitante = $_POST['solicitante'];
        $where[] = " `SOLICITANTE` = '{$solicitante}'";
    }
    if (!empty($_POST['cliente'])) {
        $cliente = $_POST['cliente'];
        $where[] = " `CLIENTE` = '{$cliente}'";
    }
    if (!empty($_POST['projeto'])) {
        $projeto = $_POST['projeto'];
        $where[] = " `PROJETO` = '{$projeto}'";
    }
    if (!empty($_POST['data_admissao'])) {
        $data_admissao = $_POST['data_admissao'];
        $where[] = " `DATA_ADMISSAO` = '{$data_admissao}'";
    }
    if (!empty($_POST['vencimento'])) {
        $vencimento = $_POST['vencimento'];
        $where[] = " `DATA_VENCIMENTO_PRI` = '{$vencimento}'";
    }
    if (!empty($_POST['vencimentos'])) {
        $vencimentos = $_POST['vencimentos'];
        $where[] = " `DATA_VENCIMENTO_SEG` = '{$vencimentos}'";
    }

    if (!empty($_POST['envio_solicitante45'])) {
        $envio_solicitante45 = $_POST['envio_solicitante45'];
        $where[] = " `ENVIO_SOLICITANTE_PRI` = '{$envio_solicitante45}'";
    }

    if (!empty($_POST['envio_solicitante90'])) {
        $envio_solicitante90 = $_POST['envio_solicitante90'];
        $where[] = " `ENVIO_SOLICITANTE_SEG` = '{$envio_solicitante90}'";
    }

    if (isset($_POST['formularios_enviados_check'])) {
        $where[] = " `formularios_enviados` IS NULL";
    } elseif (!empty($_POST['formularios_enviados'])) {
        $formularios_enviados = $_POST['formularios_enviados'];
        $where[] = " `formularios_enviados` = '{$formularios_enviados}'";
    }
    if (isset($_POST['formularios_recebidos_check'])) {
        $where[] = " `formularios_recebidos` IS NULL";
    } elseif (!empty($_POST['formularios_recebidos'])) {
        $formularios_recebidos = $_POST['formularios_recebidos'];
        $where[] = " `formularios_recebidos` = '{$formularios_recebidos}'";
    }
    if (isset($_POST['documentos_fisicos_check'])) {
        $where[] = " `documentos_fisicos` IS NULL";
    } elseif (!empty($_POST['documentos_fisicos'])) {
        $documentos_fisicos = $_POST['documentos_fisicos'];
        $where[] = " `documentos_fisicos` = '{$documentos_fisicos}'";
    }
    if (isset($_POST['ctps_check'])) {
        $where[] = " `ctps_recebida` IS NULL";
    } elseif (!empty($_POST['ctps'])) {
        $ctps = $_POST['ctps'];
        $where[] = " `ctps_recebida` = '{$ctps}'";
    }
    if (isset($_POST['qualific_check'])) {
        $where[] = " `QUALIFIC_CADASTRAL_CEP` IS NULL";
    } elseif (!empty($_POST['qualific'])) {
        $qualific = $_POST['qualific'];
        $where[] = " `QUALIFIC_CADASTRAL_CEP` = '{$qualific}'";
    }
    if (isset($_POST['cad_adm_check'])) {
        $where[] = " `CAD_ADM_PLATAFORMA_ADM_DIMIN` IS NULL";
    } elseif (!empty($_POST['cad_adm'])) {
        $cad_adm = $_POST['cad_adm'];
        $where[] = " `CAD_ADM_PLATAFORMA_ADM_DIMIN` = '{$cad_adm}'";
    }
    if (isset($_POST['doc_rec_check'])) {
        $where[] = " `DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO` IS NULL";
    } elseif (!empty($_POST['doc_rec'])) {
        $doc_rec = $_POST['doc_rec'];
        $where[] = " `DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO` = '{$doc_rec}'";
    }
    if (isset($_POST['termo_psi_check'])) {
        $where[] = " `TERMO_PSI` IS NULL";
    } elseif (!empty($_POST['termo_psi'])) {
        $termo_psi = $_POST['termo_psi'];
        $where[] = " `TERMO_PSI` = '{$termo_psi}'";
    }
    if (isset($_POST['inclui_adm_check'])) {
        $where[] = " `INCLUI_ADM_PROV` IS NULL";
    } elseif (!empty($_POST['inclui_adm'])) {
        $inclui_adm = $_POST['inclui_adm'];
        $where[] = " `INCLUI_ADM_PROV` = '{$inclui_adm}'";
    }
    if (isset($_POST['agendamento_exam_check'])) {
        $where[] = " `AGENDAMENTO_EXAM_ADM` IS NULL";
    } elseif (!empty($_POST['agendamento_exam'])) {
        $agendamento_exam = $_POST['agendamento_exam'];
        $where[] = " `AGENDAMENTO_EXAM_ADM` = '{$agendamento_exam}'";
    }
    if (isset($_POST['envio_func_check'])) {
        $where[] = " `EMAIL_RECEBIDO_EXAM` IS NULL";
    } elseif (!empty($_POST['envio_func'])) {
        $envio_func = $_POST['envio_func'];
        $where[] = " `EMAIL_RECEBIDO_EXAM` = '{$envio_func}'";
    }
    if (isset($_POST['email_exame_check'])) {
        $where[] = " `ENVIO_FUNC_EXAME` IS NULL";
    } elseif (!empty($_POST['email_exame'])) {
        $email_exame = $_POST['email_exame'];
        $where[] = " `ENVIO_FUNC_EXAME` = '{$email_exame}'";
    }
    if (isset($_POST['anexar_aso_check'])) {
        $where[] = " `ANEXAR_ASO` IS NULL";
    } elseif (!empty($_POST['anexar_aso'])) {
        $anexar_aso = $_POST['anexar_aso'];
        $where[] = " `ANEXAR_ASO` = '{$anexar_aso}'";
    }
    if (isset($_POST['envio_check'])) {
        $where[] = " `ENVIO` IS NULL";
    } elseif (!empty($_POST['envio'])) {
        $envio = $_POST['envio'];
        $where[] = " `ENVIO` = '{$envio}'";
    }
    if (isset($_POST['recebido_check'])) {
        $where[] = " `RECEBIDO` IS NULL";
    } elseif (!empty($_POST['recebido'])) {
        $recebido = $_POST['recebido'];
        $where[] = " `RECEBIDO` = '{$recebido}'";
    }
    if (isset($_POST['anexar_recebido_check'])) {
        $where[] = " `ANEXAR_COMPR_DOMIN` IS NULL";
    } elseif (!empty($_POST['anexar_recebido'])) {
        $anexar_recebido = $_POST['anexar_recebido'];
        $where[] = " `ANEXAR_COMPR_DOMIN` = '{$anexar_recebido}'";
    }
    if (isset($_POST['planilha_contas_check'])) {
        $where[] = " `PLANILHA_CONTAS` IS NULL";
    } elseif (!empty($_POST['planilha_contas'])) {
        $planilha_contas = $_POST['planilha_contas'];
        $where[] = " `PLANILHA_CONTAS` = '{$planilha_contas}'";
    }
    if (isset($_POST['form_compro_check'])) {
        $where[] = " `FORM_COMPR_BANCARIO` IS NULL";
    } elseif (!empty($_POST['form_compro'])) {
        $form_compro = $_POST['form_compro'];
        $where[] = " `FORM_COMPR_BANCARIO` = '{$form_compro}'";
    }
    if (isset($_POST['intra_data_check'])) {
        $where[] = " `INTRANET_CADASTRO_USUARIO` IS NULL";
    } elseif (!empty($_POST['intra_data'])) {
        $intra_data = $_POST['intra_data'];
        $where[] = " `INTRANET_CADASTRO_USUARIO` = '{$intra_data}'";
    }
    if (isset($_POST['kairos_data_check'])) {
        $where[] = " `KAIROS_CADASTRO_USUARIO` IS NULL";
    } elseif (!empty($_POST['kairos_data'])) {
        $kairos_data = $_POST['kairos_data'];
        $where[] = " `KAIROS_CADASTRO_USUARIO` = '{$kairos_data}'";
    }
    if (isset($_POST['email_gestor_check'])) {
        $where[] = " `EMAIL_GESTOR_APOIO_SEDE` IS NULL";
    } elseif (!empty($_POST['email_gestor'])) {
        $email_gestor = $_POST['email_gestor'];
        $where[] = " `EMAIL_GESTOR_APOIO_SEDE` = '{$email_gestor}'";
    }
    if (isset($_POST['email_inicio_check'])) {
        $where[] = " `EMAIL_INICIO_ATIVIDADES` IS NULL";
    } elseif (!empty($_POST['email_inicio'])) {
        $email_inicio = $_POST['email_inicio'];
        $where[] = " `EMAIL_INICIO_ATIVIDADES` = '{$email_inicio}'";
    }
    if (isset($_POST['email_boas_check'])) {
        $where[] = " `EMAIL_BOAS_VINDAS` IS NULL";
    } elseif (!empty($_POST['email_boas'])) {
        $email_boas = $_POST['email_boas'];
        $where[] = " `EMAIL_BOAS_VINDAS` = '{$email_boas}'";
    }
    if (isset($_POST['acessos_check'])) {
        $where[] = " `ACESSOS` IS NULL";
    } elseif (!empty($_POST['acessos'])) {
        $acessos = $_POST['acessos'];
        $where[] = " `ACESSOS` = '{$acessos}'";
    }
    if (isset($_POST['cracha_pedido_check'])) {
        $where[] = " `ACESSOS` IS NULL";
    } elseif (!empty($_POST['cracha_pedido'])) {
        $cracha_pedido = $_POST['cracha_pedido'];
        $where[] = " `CRACHA_DATA_PEDIDO` = '{$cracha_pedido}'";
    }
    if (isset($_POST['cracha_controle_check'])) {
        $where[] = " `CRACHA_CONTROLE` IS NULL";
    } elseif (!empty($_POST['cracha_controle'])) {
        $cracha_controle = $_POST['cracha_controle'];
        $where[] = " `CRACHA_CONTROLE` = '{$cracha_controle}'";
    }
    if (isset($_POST['cracha_protocolo_check'])) {
        $where[] = " `CRACHA_PROTOCOLO` IS NULL";
    } elseif (!empty($_POST['cracha_protocolo'])) {
        $cracha_protocolo = $_POST['cracha_protocolo'];
        $where[] = " `CRACHA_PROTOCOLO` = '{$cracha_protocolo}'";
    }
    if (isset($_POST['email_caderno_check'])) {
        $where[] = " `EMAIL_CADERNO_COMPASSO_SOLICITADO` IS NULL";
    } elseif (!empty($_POST['email_caderno'])) {
        $email_caderno = $_POST['email_caderno'];
        $where[] = " `EMAIL_CADERNO_COMPASSO_SOLICITADO` = '{$email_caderno}'";
    }
    if (isset($_POST['email_r_check'])) {
        $where[] = " `EMAIL_CADERNO_COMPASSO_RECEBIDO` IS NULL";
    } elseif (!empty($_POST['email_r'])) {
        $email_r = $_POST['email_r'];
        $where[] = " `EMAIL_CADERNO_COMPASSO_RECEBIDO` = '{$email_r}'";
    }
    if (isset($_POST['malote_check'])) {
        $where[] = " `MALOTE_CADERNO_COMPASSO_CTPS` IS NULL";
    } elseif (!empty($_POST['malote'])) {
        $malote = $_POST['malote'];
        $where[] = " `MALOTE_CADERNO_COMPASSO_CTPS` = '{$malote}'";
    }
    if (isset($_POST['assinados_check'])) {
        $where[] = " `DOCUMENTOS_RECEBIDOS_ASSINADOS` IS NULL";
    } elseif (!empty($_POST['assinados'])) {
        $assinados = $_POST['assinados'];
        $where[] = " `DOCUMENTOS_RECEBIDOS_ASSINADOS` = '{$assinados}'";
    }
    $sql = "SELECT * ,DATE_FORMAT(DATA_ADMISSAO,'%d/%m/%Y') as DATA_ADMISSAO
        FROM admissao_dominio as a
        LEFT JOIN parametros_captacao as p
        on a.ID_CAPTACAO = p.CAPTACAO_ID
        LEFT JOIN vencimentos as v
        on a.USUARIO_ID = v.ID_USUARIO
        JOIN sede as s
        on a.ID_SEDE = s.SEDE_ID
        JOIN tipo as t
        on a.ID_TIPO = t.TIPO_ID
        LEFT JOIN documentacao as d
        on d.ID_USUARIO = a.USUARIO_ID
        LEFT JOIN admissao as adm
        on adm.ID_USUARIO = a.USUARIO_ID
        LEFT JOIN exame_admissional as exe
        on exe.ID_USUARIO = a.USUARIO_ID
        LEFT JOIN bancarios as banc
        on banc.ID_USUARIO = a.USUARIO_ID
        LEFT JOIN interno as i
        on i.ID_USUARIO = a.USUARIO_ID
        LEFT JOIN vias_documentos_funcionarios as via
        ON via.ID_USUARIO = a.USUARIO_ID";
    if (sizeof($where))
        $sql .= ' WHERE ' . implode(' AND ', $where);
    $resultado = mysqli_query($conn, $sql);
} else {
    $resultado = mysqli_query($conn, "SELECT * ,DATE_FORMAT(DATA_ADMISSAO,'%d/%m/%Y') as DATA_ADMISSAO
                                        FROM admissao_dominio as a
                                        LEFT JOIN parametros_captacao as p
                                        on a.ID_CAPTACAO = p.CAPTACAO_ID
                                        JOIN sede as s
                                        on a.ID_SEDE = s.SEDE_ID
                                        JOIN tipo as t
                                        on a.ID_TIPO = t.TIPO_ID
                                        LEFT JOIN documentacao as d
                                        on d.ID_USUARIO = a.USUARIO_ID
                                        LEFT JOIN admissao as adm
                                        on adm.ID_USUARIO = a.USUARIO_ID
                                        LEFT JOIN exame_admissional as exe
                                        on exe.ID_USUARIO = a.USUARIO_ID
                                        LEFT JOIN bancarios as banc
                                        on banc.ID_USUARIO = a.USUARIO_ID
                                        LEFT JOIN interno as i
                                        on i.ID_USUARIO = a.USUARIO_ID
                                        LEFT JOIN vias_documentos_funcionarios as via
                                        ON via.ID_USUARIO = a.USUARIO_ID
                                        where  STATUS <> 'FINALIZADO' && STATUS <> 'RECUSADO' && STATUS <> 'DESISTENCIA'
                                        order by YEAR(DATA_ADMISSAO) ASC, MONTH(DATA_ADMISSAO) ASC, DAY(DATA_ADMISSAO) ASC");
}
//$resultado = mysqli_query($conn, "SELECT * FROM teste");
// $usuarios = mysql_fetch_assoc($resultado);
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
            <a class='nav filter pos'>Filtragem</a>
            <a class='nav filter last' href='../login/user/sair.php'>Sair</a>
        </nav>
    </header>
    <main>
        <section class='menu-inicial'>
            <h2 id='nome'>Plataforma Admissão</h2>
        </section>
        <section class='inputs panel-body display campo-filtro estruct'>
            <h2 id='Filtro'>Filtro</h2>
            <fieldset>
                <form id='form-filtrar' method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div>
                        <div>
                            <label for="status">Status</label>
                            <select name="status" class="form-control campo-filter">
                                <option value="" selected="selected"></option>
                                <option value="SOLICITAÇÃO DE PROPOSTA">SOLICITAÇÃO DE PROPOSTA</option>
                                <option value="AGUARDANDO APROVAÇÃO">AGUARDANDO APROVAÇÃO</option>
                                <option value="APROVADO DIRETORIA">APROVADO DIRETORIA</option>
                                <option value="EM VALIDAÇÃO">EM VALIDAÇÃO</option>
                                <option value="NEGOCIAÇÃO">NEGOCIAÇÃO</option>
                                <option value="PROPOSTA ENVIADA">PROPOSTA ENVIADA</option>
                                <option value="PROPOSTA ACEITA">PROPOSTA ACEITA</option>
                                <option value="EM ANDAMENTO">EM ANDAMENTO</option>
                                <option value="PROPOSTA INVÁLIDA">PROPOSTA INVÁLIDA</option>
                                <option value="EM CONTRATO">EM CONTRATO</option>
                                <option value="RETORNO DOCS">RETORNO DOCS</option>
                                <option value="DESISTENCIA">DESISTENCIA</option>
                                <option value="RECUSADO">RECUSADO</option>
                                <option value="FINALIZADO">FINALIZADO</option>
                            </select>
                        </div>
                        <div>
                            <label for="sede">Sede</label>
                            <select id="sede" name="sede" class="form-control campo-filter">
                                <option value="" selected="selected"></option>
                                <?php foreach ($listar as $linha) : ?>
                                    <option value="<?= $linha['SEDE_ID'] ?>"><?php echo $linha['NOME_SEDE'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div>
                            <label for="tipo">Tipo</label>
                            <select id="tipo" name="tipo" class="form-control campo-filter">
                                <option value="" selected="selected"></option>
                                <option value="1">CLT</option>
                                <option value="2">CC</option>
                                <option value="3">HO</option>
                                <option value="4">TEMP</option>
                                <option value="5">APDZ</option>
                            </select>
                        </div>
                        <div>
                            <label for="captacao">Captação</label>
                            <select id="captacao" name="captacao" class="form-control campo-filter">
                                <option value="" selected="selected"></option>
                                <option value="1">Ex-Funcionário</option>
                                <option value="2">Ex-Bolsista</option>
                                <option value="3">Ex-Estágiario</option>
                                <option value="4">NOVO</option>
                            </select>
                        </div>
                        <div>
                            <label for="solicitante">Solicitante</label>
                            <input type="text" id='solicitante' name="solicitante" class="form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Solicitante" />
                        </div>
                        <div>
                            <label for="cliente">Cliente</label>
                            <input type="text" id='cliente' name="cliente" class="form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Cliente" />
                        </div>
                        <div>
                            <label for="PROJETO">Projeto</label>
                            <input type="text" id='projeto' name="projeto" class="form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Projeto" />
                        </div>
                        <div>
                            <label for="data_admissao">Data de Admissão</label>
                            <input type="date" id="data_admissao" name="data_admissao" class="form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Data Admissão" />
                        </div>                       

                        <h2>Tela 4 - Documentação</h2>
                        <div>
                            <label for="formularios_enviados">Formulários Enviados</label>
                            <input type="date" id='formularios_enviados' name="formularios_enviados" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Formulários Enviados" />
                            <input type="checkbox" name="formularios_enviados_check" value="NULL" />Vazio
                        </div>
                        <div>
                            <label for="formularios_recebidos">Formulários Recebidos</label>
                            <input type="date" id='formularios_recebidos' name="formularios_recebidos" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Formulários Recebidos" />
                            <input type="checkbox" name="formularios_recebidos_check" value="NULL" />Vazio
                        </div>
                        <div>
                            <label for="documentos_fisicos">Documentos Físicos</label>
                            <input type="date" id='documentos_fisicos' name="documentos_fisicos" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Documentos Físicos" />
                            <input type="checkbox" name="documentos_fisicos_check" value="NULL" />Vazio
                        </div>
                        <div>
                            <label for="ctps">CTPS</label>
                            <input type="date" id='r' name="ctps" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="CTPS" />
                            <input type="checkbox" name="ctps_check" value="NULL" />Vazio
                        </div>
                        <h2>Tela 5 - Admissão</h2>
                        <div>
                            <label for="qualific">Qualificação Cadastral e CEP</label>
                            <input type="date" id='qualific' name="qualific" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Qualificação Cadastral e CEP" />
                            <input type="checkbox" name="qualific_check" value="NULL" />Vazio
                        </div>
                        <div>
                            <label for="cad_adm">Cadastrada Admissão Plataforma Domínio</label>
                            <input type="date" id='cad_adm' name="cad_adm" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Cadastrada Admissão Plataforma Domínio" />
                            <input type="checkbox" name="cad_adm_check" value="NULL" />Vazio
                        </div>
                        <div>
                            <label for="doc_rec">Documentos Recebidos Plataforma Domínio + Validação CBO</label>
                            <input type="date" id='doc_rec' name="doc_rec" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Documentos Recebidos Plataforma Domínio + Validação  CBO" />
                            <input type="checkbox" name="doc_rec_check" value="NULL" />Vazio
                        </div>
                        <div>
                            <label for="termo_psi">Termo PSI</label>
                            <input type="date" id='termo_psi' name="termo_psi" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Termo PSI" />
                            <input type="checkbox" name="termo_psi_check" value="NULL" />Vazio
                        </div>
                        <div>
                            <label for="inclui_adm">Incluir Admissão na Provisória</label>
                            <input type="date" id='inclui_adm' name="inclui_adm" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Incluir Admissão na Provisória" />
                            <input type="checkbox" name="inclui_adm_check" value="NULL" />Vazio
                        </div>
                        <h2>Tela 6 - Exame</h2>
                        <div>
                            <label for="agendamento_exam">Agendamento</label>
                            <input type="date" id='agendamento_exam' name="agendamento_exam" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Agendamento" />
                            <input type="checkbox" name="agendamento_exam_check" value="NULL" />Vazio
                        </div>
                        <div>
                            <label for="envio_func">Envio para funcionário</label>
                            <input type="date" id='envio_func' name="envio_func" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Envio para funcionário" />
                            <input type="checkbox" name="envio_func_check" value="NULL" />Vazio
                        </div>
                        <div>
                            <label for="email_exame">Recebido por e-mail ASO assinado</label>
                            <input type="date" id='email_exame' name="email_exame" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Recebido por e-mail ASO assinado" />
                            <input type="checkbox" name="email_exame_check" value="NULL" />Vazio
                        </div>
                        <div>
                            <label for="anexar_aso">Anexar ASO assinado na Domínio </label>
                            <input type="date" id='anexar_aso' name="anexar_aso" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Anexar ASO assinado na Domínio" />
                            <input type="checkbox" name="anexar_aso_check" value="NULL" />Vazio
                        </div>
                        <h2>Tela 7 - Dados Bancários</h2>
                        <div>
                            <label for="envio">Envio</label>
                            <input type="date" id='envio' name="envio" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Envio" />
                            <input type="checkbox" name="envio_check" value="NULL" />Vazio
                        </div>
                        <div>
                            <label for="recebido">Recebido</label>
                            <input type="date" id='recebido' name="recebido" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Recebido" />
                            <input type="checkbox" name="recebido_check" value="NULL" />Vazio
                        </div>
                        <div>
                            <label for="anexar_recebido">Anexar comprovante na Domínio</label>
                            <input type="date" id='anexar_recebido' name="anexar_recebido" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Anexar comprovante na Domínio" />
                            <input type="checkbox" name="anexar_check" value="NULL" />Vazio
                        </div>
                        <div>
                            <label for="planilha_contas">Planilha de Contas</label>
                            <input type="date" id='planilha_contas' name="planilha_contas" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Planilha de Contas" />
                            <input type="checkbox" name="planilha_contas_check" value="NULL" />Vazio
                        </div>
                        <div>
                            <label for="form_compro">Formulário + Comprovante Bancário</label>
                            <input type="date" id='form_compro' name="form_compro" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Formulário + Comprovante Bancário" />
                            <input type="checkbox" name="form_compro_check" value="NULL" />Vazio
                        </div>
                        <h2>Tela 9 - Interno</h2>
                        <div>
                            <label for="intra_data">Intranet - Cadastro Usuário</label>
                            <input type="date" id='intra_data' name="intra_data" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Intranet - Cadastro Usuário" />
                            <input type="checkbox" name="intra_data_check" value="NULL" />Vazio
                        </div>
                        <div>
                            <label for="kairos_data">Kairos - Cadastro Usuário</label>
                            <input type="date" id='kairos_data' name="kairos_data" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Kairos - Cadastro Usuário" />
                            <input type="checkbox" name="kairos_data_check" value="NULL" />Vazio
                        </div>
                        <div>
                            <label for="email_gestor">E-mail Gestor + Apoio Sede</label>
                            <input type="date" id='email_gestor' name="email_gestor" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="E-mail Gestor + Apoio Sede" />
                            <input type="checkbox" name="email_gestor_check" value="NULL" />Vazio
                        </div>
                        <div>
                            <label for="email_inicio">E-mail Início das Atividades</label>
                            <input type="date" id='email_inicio' name="email_inicio" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="E-mail Início das Atividades" />
                            <input type="checkbox" name="email_inicio_check" value="NULL" />Vazio
                        </div>
                        <div>
                            <label for="email_boas">E-mail Boas Vindas </label>
                            <input type="date" id='email_boas' name="email_boas" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="E-mail Boas Vindas	" />
                            <input type="checkbox" name="email_boas_check" value="NULL" />Vazio
                        </div>
                        <div>
                            <label for="acessos">DATA</label>
                            <input type="date" id='acessos' name="acessos" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Acessos" />
                            <input type="checkbox" name="acessos_check" value="NULL" />Vazio
                        </div>
                        <h2>Tela 10 - Vias documentos</h2>
                        <div>
                            <label for="cracha_pedido">Data do pedido do crachá</label>
                            <input type="date" id='cracha_pedido' name="cracha_pedido" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Data do pedido do crachá" />
                            <input type="checkbox" name="cracha_pedido_check" value="NULL" />Vazio
                        </div>
                        <div>
                            <label for="cracha_controle">Controle crachá</label>
                            <input type="date" id='cracha_controle' name="cracha_controle" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Controle crachá" />
                            <input type="checkbox" name="cracha_controle_check" value="NULL" />Vazio
                        </div>
                        <div>
                            <label for="cracha_protocolo">Protocolo crachá</label>
                            <input type="date" id='cracha_protocolo' name="cracha_protocolo" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Protocolo crachá" />
                            <input type="checkbox" name="cracha_protocolo_check" value="NULL" />Vazio
                        </div>
                        <div>
                            <label for="email_caderno">Data E-mail solicitado</label>
                            <input type="date" id='email_caderno' name="email_caderno" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Data E-mail solicitado" />
                            <input type="checkbox" name="email_caderno_check" value="NULL" />Vazio
                        </div>
                        <div>
                            <label for="email_r">Data E-mail recebido</label>
                            <input type="date" id='email_r' name="email_r" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Data E-mail recebido" />
                            <input type="checkbox" name="email_r_check" value="NULL" />Vazio
                        </div>
                        <div>
                            <label for="malote">Malote (Caderno) + CTPS (Controle RH)</label>
                            <input type="date" id='malote' name="malote" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Malote (Caderno) + CTPS (Controle RH)" />
                            <input type="checkbox" name="malote_check" value="NULL" />Vazio
                        </div>
                        <div>
                            <label for="assinados">Recebido após assinatura Escanear Docs e Salvar na Pasta</label>
                            <input type="date" id='assinados' name="assinados" class="filtrosContrarios form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Recebido após assinatura Escanear Docs e Salvar na Pasta" />
                            <input type="checkbox" name="assinados_check" value="NULL" />Vazio
                        </div>
                        <h2>Tela 12 - Vencimentos Contratos</h2>
                        <div>
                            <label for="envio_solicitante45">Envio Solicitante 45 dias</label>
                            <input type="date" id='envio_solicitante45' name="envio_solicitante45" class="form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Envio Solicitante" />
                        </div>                        
                        <div>
                            <label for="vencimento">Data Venc. Efetivação 45 dias</label>
                            <input type="date" id='vencimento' name="vencimento" class="form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Data Vencimento" />
                        </div>
                        <div>
                            <label for="envio_solicitante90">Envio Solicitante 90 dias</label>
                            <input type="date" id='envio_solicitante90' name="envio_solicitante90" class="form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Envio Solicitantes" />
                        </div>
                        <div>
                            <label for="vencimentos">Data Venc. Efetivação 90 dias</label>
                            <input type="date" id='vencimentos' name="vencimentos" class="form-control campo-filter" data-action="filter" data-filters="#dev-table" placeholder="Data Vencimentos" />
                        </div>
                        <input type="submit" name="botao" class="botao btn btn-default btn-xs btn-filter campo-filter" value="Filtrar">
                    </div>
                </form>
            </fieldset>
        </section>
        <section class='container estruct'>
            <div id='first-table' class=" passos">
                <div class="stepwizard">
                    <div class="passos stepwizard-row setup-panel">
                        <div title="Menu Principal" class="stepwizard-step col-md-auto ">
                            <a href="index.php" type="button" class="btn btn-success btn-circle">1</a>
                        </div>
                        <div title="Proposta de Contratação" class="stepwizard-step col-md-auto">
                            <a href="funcionario.php" type="button" class="btn btn-default btn-circle disabled" disabled>2</a>
                        </div>
                        <div title="Gestão" class="stepwizard-step col-md-auto">
                            <a href="gestao.php" type="button" class="btn btn-default btn-circle disabled" disabled>3</a>
                        </div>
                        <div title="Documentação" class="stepwizard-step col-md-auto">
                            <a href="documentacao.php" type="button" class="btn btn-default btn-circle disabled" disabled>4</a>
                        </div>
                        <div title="Plataforma Admissão Domínio Dados + Fichas de Cadastro" class="stepwizard-step col-md-auto">
                            <a href="admissao.php" type="button" class="btn btn-default btn-circle disabled" disabled>5</a>
                        </div>
                        <div title="Exame Admissional" class="stepwizard-step col-md-auto">
                            <a href="exame.php" type="button" class="btn btn-default btn-circle disabled" disabled>6</a>
                        </div>
                        <div title="Dados Bancários" class="stepwizard-step col-md-auto">
                            <a href="bancarios.php" type="button" class="btn btn-default btn-circle disabled" disabled>7</a>
                        </div>
                        <div title="Suporte Interno" class="stepwizard-step col-md-auto">
                            <a href="suporteinterno.php" type="button" class="btn btn-default btn-circle disabled" disabled>8</a>
                        </div>
                        <div title="Interno" class="stepwizard-step col-md-auto">
                            <a href="interno.php" type="button" class="btn btn-default btn-circle disabled" disabled>9</a>
                        </div>
                        <div title="Vias Documentos funcionários" class="stepwizard-step col-md-auto">
                            <a href="viasdocumentos.php" type="button" class="btn btn-default btn-circle disabled" disabled>10</a>
                        </div>
                        <div title="Boas Vindas" class="stepwizard-step col-md-auto">
                            <a href="recepcao.php" type="button" class="btn btn-default btn-circle disabled" disabled>11</a>
                        </div>
                                <div title="Vencimento Contratos" class="stepwizard-step col-md-auto">
                                    <a href="vencimentosContratos.php" type="button" class="btn btn-default btn-circle disabled" disabled>12</a>
                                </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered" id='first-table'>
                <h2 id='titulo-table'></h2>
                <thead>
                    <tr>
                        <th scope="col" width='200px'>Status</th>
                        <th scope="col" width='300px'>Nome</th>
                        <th scope="col" width='110px'>Data Admissão</th>
                        <th scope="col" width='60px'>Sede</th>
                        <th scope="col" width='60px'>Tipo</th>
                        <th scope="col" width='150px'>Captação</th>
                        <th scope="col" width='150px'>Carga Horária<br />(em horas)</th>
                        <th scope="col" width='150px'>Horário</th>
                        <th scope="col" width='200px'>Sexo</th>
                        <th scope="col" width='150px'>Fone</th>
                        <th scope="col" width='200px' <?php if ($grupo == "Suporte Interno") {
                                                            echo 'style="display: none;"';
                                                        } ?>>Cargo</th>
                        <th scope="col" width='110px'>Log Registro Dia RH Envia DP</th>
                        <th scope="col" width='120px' <?php if ($grupo == "Suporte Interno") {
                                                            echo 'style="display: none;"';
                                                        } ?>>Remuneração Base</th>
                        <th scope="col" width='100px' <?php if ($grupo == "Suporte Interno") {
                                                            echo 'style="display: none;"';
                                                        } ?>>Gratificação</th>
                        <th scope="col" width='120px' <?php if ($grupo == "Suporte Interno") {
                                                            echo 'style="display: none;"';
                                                        } ?>>Remuneração Total</th>
                        <th scope="col" width='200px'>Solicitante</th>
                        <th scope="col" width='150px'>Cliente</th>
                        <th scope="col" width='150px'>Projeto</th>
                        <th scope="col" width='330px'>Email Pessoal</th>
                        <th scope="col" width='200px'>Posição<br />(Comentários)</th>
                        <th scope="col" width='200px'>Administrativo + Flyback <br /> - Hotel</th>
                        <th scope="col" width='200px'>Comentários</th>
                        <th scope="col" width='150px'></th>
                        <th scope="col" width='150px' <?php if ($grupo == "Suporte Interno") {
                                                            echo 'style="display: none;"';
                                                        } ?>></th>
                        <th scope="col" width='100px' <?php if ($grupo == "Suporte Interno") {
                                                            echo 'style="display: none;"';
                                                        } ?>></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($resultado) {
                        while ($rows_dados = mysqli_fetch_assoc($resultado)) {
                                $SOMA = $rows_dados['REMUNERACAO_BASE'] + $rows_dados['GRATIFICACAO']; ?>
                            <tr style="vertical-align: right !important;">
                                <td><?php echo $rows_dados['STATUS']; ?></td>
                                <td><?php echo $rows_dados['NOME']; ?></td>
                                <td><?php echo $rows_dados['DATA_ADMISSAO']; ?></td>
                                <td><?php echo $rows_dados['NOME_SEDE']; ?></td>
                                <td><?php echo $rows_dados['NOME_TIPO']; ?></td>
                                <td><?php echo $rows_dados['NOME_PARAMETRO']; ?></td>
                                <td><?php echo $rows_dados['CARGA_HORARIA']; ?></td>
                                <td><?php echo $rows_dados['HORARIO']; ?></td>
                                <td><?php echo $rows_dados['SEXO']; ?></td>
                                <td><?php echo $rows_dados['FONE_CONTATO']; ?></td>
                                <td <?php if ($grupo == "Suporte Interno") {
                                                echo 'style="display: none;"';
                                            } ?>><?php echo $rows_dados['CARGO']; ?></td>
                                <td><?php echo formatDateApresentation($rows_dados['LOG_REGISTRO_DIA_RH_ENVIA_DP']); ?></td>
                                <td <?php if ($grupo == "Suporte Interno") {
                                                echo 'style="display: none;"';
                                            } ?>><?php echo 'R$' . number_format($rows_dados['REMUNERACAO_BASE'], 2, ',', '.'); ?></td>
                                <td <?php if ($grupo == "Suporte Interno") {
                                                echo 'style="display: none;"';
                                            } ?>><?php echo 'R$' . number_format($rows_dados['GRATIFICACAO'], 2, ',', '.'); ?></td>
                                <td <?php if ($grupo == "Suporte Interno") {
                                                echo 'style="display: none;"';
                                            } ?>><?php echo 'R$' . number_format($SOMA, 2, ',', '.'); ?></td>
                                <td><?php echo $rows_dados['SOLICITANTE']; ?></td>
                                <td><?php echo $rows_dados['CLIENTE']; ?></td>
                                <td><?php echo $rows_dados['PROJETO']; ?></td>
                                <td><?php echo $rows_dados['EMAIL']; ?></td>
                                <td style="overflow:hidden; text-overflow: ellipsis;"><?php echo $rows_dados['POSICAO_COMENTARIO']; ?></td>
                                <td style="overflow:hidden; text-overflow: ellipsis;"><?php echo $rows_dados['ADMINISTRATIVO']; ?></td>
                                <td style="overflow:hidden; text-overflow: ellipsis;"><?php echo $rows_dados['COMENTARIOS']; ?></td>
                                <td><a title="Proposta de Contratação" class="btn btn-default selectUser" id="selectUser" href='funcionario.php?id=<?php echo $rows_dados['USUARIO_ID']; ?>'> Ver Detalhes </td>
                                <td <?php if ($grupo == "Suporte Interno") {
                                                echo 'style="display: none;"';
                                            } ?>><a title="Editar" href="../alteraTelas/altera-form.php?id=<?= $rows_dados['USUARIO_ID'] ?>" type="button" class="btn btn-default" <?php if ($grupo == "Suporte Interno") {
                                                                                                                                                                                                                                                            echo 'style="display: none;"';
                                                                                                                                                                                                                                                        } ?>>Editar</span></a></td>
                                <td <?php if ($grupo == "Suporte Interno") {
                                                echo 'style="display: none;"';
                                            } ?>><a title="Finalizar" href="../alteraTelas/altera-deleta.php?id=<?= $rows_dados['USUARIO_ID'] ?>" type="button" class="btn btn-default" <?php if ($grupo == "Suporte Interno") {
                                                                                                                                                                                                                                                                echo 'style="display: none;"';
                                                                                                                                                                                                                                                            } ?>>Excluir</span></a></td>
                                </td>
                        <?php
                            }
                        } ?>

                            <tr <?php if ($grupo == "Suporte Interno") {
                                                            echo 'style="display: none;"';
                                                        } ?>>
                                
                            <form id='form-add' method="POST" action="../salva.php">
                            <?/*/ verifica se salvou ou nao /*/?>
                                    <td><select name="status" class="intable" value="<?= $rows_dados['STATUS'] ?>" required>
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
                                    <td id='add-nome'><input class='intable' type="text" name="nome" required></td>
                                    <td id='add-admissao'><input class='intable' type="date" name="data_admissao" required></td>
                                    <td><select id="add-sede" name='sede' class="selectadd intable" required>
                                            <option value="" selected="selected"></option>
                                            <?php foreach ($listar as $linha) : ?>
                                                <option value="<?= $linha['SEDE_ID'] ?>"><?php echo $linha['NOME_SEDE'] ?></option>
                                            <?php endforeach ?>
                                        </select></td>
                                    <td><select id="add-tipo" name='tipo' class="selectadd intable" onclick="validaCargo()" required>
                                            <option value="" selected="selected"></option>
                                            <option value="1">CLT</option>
                                            <option value="2">CC</option>
                                            <option value="3">HO</option>
                                            <option value="4">TEMP</option>
                                            <option value="5">APDZ</option>
                                        </select></td>
                                    <td><select id="add-captacao" name='captacao' class="selectadd intable" required>
                                            <option value="" selected="selected"></option>
                                            <option value="1">Ex-Funcionario</option>
                                            <option value="2">Ex-Bolsista</option>
                                            <option value="3">Ex-Estagiario</option>
                                            <option value="4">Novo</option>
                                        </select></td>
                                    <td id='add-carga_horaria'><input id="campo-carga_horaria" class='intable' type="text" name="carga_horaria" required></td>
                                    <td id='add-horario'><input class='intable' type="text" name="horario" required></td>
                                    <td><select name="sexo" class="intable" value="<?= $rows_dados['SEXO'] ?>" required>
                                            <option value="" selected="selected"></option>
                                            <option>Não informou</option>
                                            <option>Masculino</option>
                                            <option>Feminino</option>
                                            <option>Não definido</option>
                                        </select></td>
                                        <td id='add-fone'><input class='intable' type="text" pattern="\([0-9]{2}\) [0-9]{4,6}-[0-9]{3,4}$" name="fone_contato" id="telefone" maxlength="15" required></td>
                                    <td id="add-cargo" <?php if ($grupo == "Suporte Interno") {
                                                            echo 'style="display: none;"';
                                                        } ?>><input class='intable' type="text" name="cargo"></td>
                                    <td id='add-log-registro-dia-rh-envia-dp'><input class='intable' type="date" name="LOG_REGISTRO_DIA_RH_ENVIA_DP"></td>
                                    <td id="add-remuneracao" <?php if ($grupo == "Suporte Interno") {
                                                                    echo 'style="display: none;"';
                                                                } ?>><input class='intable' type="number" step=".01" name="remuneracao_base" min="0" value="0"></td>
                                    <td id="add-gratificacao" <?php if ($grupo == "Suporte Interno") {
                                                                    echo 'style="display: none;"';
                                                                } ?>><input class='intable' type="number" step=".01" name="gratificacao" min="0" value="0"></td>
                                    <td <?php if ($grupo == "Suporte Interno") {
                                            echo 'style="display: none;"';
                                        } ?>></td>
                                    <td id='add-solicitante'><input class='intable' type="text" name="solicitante" required></td>
                                    <td id='add-cliente'><input class='intable' type="text" name="cliente" required></td>
                                    <td id='add-projeto'><input class='intable' type="text" name="projeto" required></td>
                                    <td id='add-email'><input class='intable' type="email" name="EMAIL" unique required></td>
                                    <td id='add-posicao_comentario'><input class='intable' type="text" name="posicao_comentario" required></td>
                                    <td id='add-administrativo'><input class='intable' type="text" name="administrativo" required></td>
                                    <td id='add-comentarios'><input class='intable' type="text" name="comentarios"></td>
                                    <td><button title="Salvar" type="submit" value="salva" class="btn btn-default" action="#">Salvar</button></td>
                                    <td></td>
                                    <td></td>
                                </form>
                            </tr>
                </tbody>
            </table>
            <section>
                <a title="Exportar telas p/Excel" name="botao" href="../TabelasExcel/ExcelPaginas.php" class="btn btn-default" <?php if ($grupo == "Suporte Interno") {
                                                            echo 'style="display: none;"';
                                                        } ?>>Exportar para Excel</a>
            </section>

        </section>
        <?php echo file_get_contents("telasLegendas.html"); ?>
    </main>
    <footer>
        <h2></h2>
    </footer>
    <script src="../js/jquery.js"></script>
    <script src="../js/jquery.mask.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../js/funcionamento.js"></script>
    <script src="../js/filter.js"></script>
    <script src="../js/validaCargo.js"></script>
    <script src='../js/desabilitaStepWizard.js'></script>
    <?php
    include('../validacoes/login/permissoes.php');
    ?>
    <script type="text/javascript">
        function mascara(o, f) {
            v_obj = o
            v_fun = f
            setTimeout("execmascara()", 1)
        }

        function execmascara() {
            v_obj.value = v_fun(v_obj.value)
        }

        function mtel(v) {
            v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito
            v = v.replace(/^(\d{2})(\d)/g, "($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
            v = v.replace(/(\d)(\d{4})$/, "$1-$2"); //Coloca hífen entre o quarto e o quinto dígitos
            return v;
        }

        function id(el) {
            return document.getElementById(el);
        }
        window.onload = function() {
            id('telefone').onkeyup = function() {
                mascara(this, mtel);
            }
        }
    </script>
    <script type="text/javascript">
        function valida_horas(edit) {
            if (event.keyCode < 48 || event.keyCode > 57) {
                event.returnValue = false;
            }
            if (edit.value.length == 2) {
                edit.value += ":";
            }
            if (edit.value.length == 5) {
                edit.value += " - ";
            }
            if (edit.value.length == 10) {
                edit.value += ":";
            }
        }
    </script>

</body>

</html>
