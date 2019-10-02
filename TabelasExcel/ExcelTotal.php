<?php

$connect = mysqli_connect("localhost", "root", "", "bancorh");
$output = '';
if(isset($_POST["export"]))
{
    $connect = mysqli_connect("localhost", "root", "", "bancorh");
    $sql = "SELECT *
    FROM admissao_dominio AS a
    LEFT JOIN propostas_contratacoes AS p
    ON p.ID_USUARIO = a.USUARIO_ID
    LEFT JOIN gestao AS g
    ON g.ID_USUARIO = a.USUARIO_ID
    LEFT JOIN vencimentos AS v
    ON v.ID_USUARIO = a.USUARIO_ID
    LEFT JOIN documentacao AS d
    ON d.ID_USUARIO = a.USUARIO_ID
    LEFT JOIN admissao AS ad
    ON ad.ID_USUARIO = a.USUARIO_ID
    LEFT JOIN exame_admissional AS e
    ON e.ID_USUARIO = a.USUARIO_ID
    LEFT JOIN bancarios AS b
    ON b.ID_USUARIO = a.USUARIO_ID
    LEFT JOIN suporte_interno AS s
    ON s.ID_USUARIO = a.USUARIO_ID
    LEFT JOIN interno AS i
    ON i.ID_USUARIO = a.USUARIO_ID
    LEFT JOIN vias_documentos_funcionarios AS vd
    ON vd.ID_USUARIO = a.USUARIO_ID
    LEFT JOIN boas_vindas AS bv
    ON bv.ID_USUARIO = a.USUARIO_ID
    LEFT JOIN parametros_captacao AS c
    ON c.CAPTACAO_ID = a.ID_CAPTACAO
    LEFT JOIN sede AS se
    ON se.SEDE_ID = a.ID_SEDE
    LEFT JOIN tipo AS ti
    ON ti.TIPO_ID = a.ID_TIPO";

    $result = mysqli_query($connect, $sql);


    if(mysqli_num_rows($result) > 0)
    {
     $output .= '

    <table class="table table-bordered">
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th colspan="3">1° Alerta Vencimento 45 dias</th>
                            <th colspan="3">1° Alerta Vencimento 90 dias</th>
                            <th colspan="2">E-mail  formulários admissão</th>
                            <th>Documentos Físicos</th>
                            <th>CTPS</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th colspan="2">Intranet</th>
                            <th colspan="2">Kairos</th>
                            <th colspan="3">E-mail</th>
                            <th></th>
                            <th colspan="2">Posição UOL</th>
                            <th colspan="2">E-mail Adm Caderno Compasso</th>
                            <th></th>
                            <th></th>
                            <th colspan="3">Crachá + Cordão + Roller</th>
                            <th colspan="5">Boas Vindas Compasso</th>

                       </tr>
                        <tr>
                            <th width="150px">Status</th>
                            <th width="60px">Sede</th>
                            <th width="60px">Tipo</th>
                            <th width="100px">Captação</th>
                            <th width="100px">Carga Horária</th>
                            <th width="100px">Horário</th>
                            <th width="200px">Nome</th>
                            <th width="85px">Fone</th>
                            <th width="100px">Cargo</th>
                            <th width="110px">Controle Data Admissão</th>
                            <th width="100px">Remuneração Base</th>
                            <th width="100px">Gratificação</th>
                            <th width="200px">Solicitante</th>
                            <th width="150px">Cliente</th>
                            <th width="150px">Projeto</th>
                            <th width="250px">Email</th>
                            <th width="110px">Data Admissão</th>
                            <th width="110px">Comentarios</th>
                            <th>Enquadramento remuneração envio</th>
                            <th>Enquadramento remuneração retorno</th>
                            <th>Enquadramento(Validação Ex Funcionário)</th>
                            <th>Envio da Proposta</th>
                            <th>Comunicar proposta enviada Solicitante</th>
                            <th>Aceite/recusa candidato</th>
                            <th>Comentário</th>
                            <th>Comunicar Status da Proposta ao Solicitante</th>
                            <th>GESTOR</th>
                            <th>GESTOR SABE?</th>
                            <th>GESTOR LOCAL</th>
                            <th>GESTOR LOCAL SABE?</th>
                            <th>Quem do projeto receberá a pessoa?</th>
                            <th>Envio Solicitante</th>
                            <th>Data vencimento</th>
                            <th>Renovação</th>
                            <th>Envio Solicitante</th>
                            <th>Data Vencimento</th>
                            <th>Efetivação</th>
                            <th>Formulários Enviados</th>
                            <th>Formulários Recebidos</th>
                            <th>Cópia RG/CPF/PIS/Titulo  Eleitor/Declaração Oracle/Foto 3x4/Comprovante endereço</th>
                            <th>CTPS Recebida</th>
                            <th>Qualificação Cadastral e CEP</th>
                            <th>Cadastrada Admissão Plataforma Domínio</th>
                            <th>Documentos recebidos plataforma domínio + validação CBO</th>
                            <th>Termo PSI</th>
                            <th>Inclui admissão na provisória</th>
                            <th>Administrativo + Thays Flyback - Hotel</th>
                            <th>Agendamento</th>
                            <th>Envio para Funcionário</th>
                            <th>Recebido por e-mail ASO assinado</th>
                            <th>Anexar ASO na domínio</th>
                            <th>Envio</th>
                            <th>Recebido</th>
                            <th>Anexar comprovante na Domínio</th>
                            <th>Cadastro Intranet</th>
                            <th>Formuário + comprovante bancário</th>
                            <th>Agência</th>
                            <th>Conta</th>
                            <th>Tipo da Conta</th>
                            <th>Email</th>
                            <th>Usuário</th>
                            <th>Senha de acesso</th>
                            <th>Equipamento</th>
                            <th>Usuário Ativo</th>
                            <th>Necessidade de translado</th>
                            <th>Cadastro Usuário</th>
                            <th>Senha</th>
                            <th>Cadastro Usuário</th>
                            <th>Código/Senha</th>
                            <th>Gestor + Apoio Sede</th>
                            <th>E-mail início das atividades</th>
                            <th>E-mail Boas Vindas</th>
                            <th>Acessos</th>
                            <th>Data</th>
                            <th>Comentário UOL</th>
                            <th>E-mail = Solicitado</th>
                            <th>E-mail = Recebido</th>
                            <th>Malote (Caderno) + CTPS (Controle RH)</th>
                            <th>Recebido após assinatura Escanear Docs e Salvar na Pasta</th>
                            <th>Data do pedido do crachá</th>
                            <th>controle</th>
                            <th>protocolo</th>
                            <th>integração agendada</th>
                            <th>integração realizada</th>
                            <th>sala</th>
                            <th>Layot Boas vindas Mensal</th>
                        </tr>
        ';


     while($row = mysqli_fetch_array($result))
     {
        $output .= '
       <tr>
         <td>'.$row["STATUS"].'</td>
         <td>'.$row["NOME_SEDE"].'</td>
         <td>'.$row["NOME_TIPO"].'</td>
         <td>'.$row['NOME_PARAMETRO'].'</td>
         <td>'.$row["CARGA_HORARIA"].'</td>
         <td>'.$row['HORARIO'].'</td>
         <td>'.$row["NOME"].'</td>
         <td>'.$row["FONE_CONTATO"].'</td>
         <td>'.$row["CARGO"].'</td>
         <td>'.$row["LOG_REGISTRO_DIA_RH_ENVIA_DP"].'</td>
         <td>'.$row["REMUNERACAO_BASE"].'</td>
         <td>'.$row["GRATIFICACAO"].'</td>
         <td>'.$row["SOLICITANTE"].'</td>
         <td>'.$row["PROJETO"].'</td>
         <td>'.$row["CLIENTE"].'</td>
         <td>'.$row["EMAIL"].'</td>
         <td>'.$row["DATA_ADMISSAO"].'</td>
         <td>'.$row["COMENTARIOS"].'</td>
         <td>'.$row["ENQUADRAMENTO_REMUNERACAO_ENVIO"].'</td>
         <td>'.$row["ENQUADRAMENTO_REMUNERACAO_RETORNO"].'</td>
         <td>'.$row['ENQUADRAMENTO'].'</td>
         <td>'.$row["ENVIO_PROPOSTA"].'</td>
         <td>'.$row['COMUNICAR_PROPOSTA_ENVIADA'].'</td>
         <td>'.$row["ACEITE_RECUSA_CANDIDATO"].'</td>
         <td>'.$row["COMENTARIO"].'</td>
         <td>'.$row["COMUNICAR_STATUS"].'</td>
         <td>'.$row['GESTOR'].'</td>
         <td>'.$row["GESTOR_SABE"].'</td>
         <td>'.$row['GESTOR_LOCAL'].'</td>
         <td>'.$row["GESTOR_LOCAL_sABE"].'</td>
         <td>'.$row["RECEPTOR_PESSOA"].'</td>
         <td>'.$row['ENVIO_SOLICITANTE_PRI'].'</td>
         <td>'.$row["DATA_VENCIMENTO_PRI"].'</td>
         <td>'.$row['RENOVACAO'].'</td>
         <td>'.$row["ENVIO_SOLICITANTE_SEG"].'</td>
         <td>'.$row["DATA_VENCIMENTO_SEG"].'</td>
         <td>'.$row["EFETIVACAO"].'</td>
         <td>'.$row['FORMULARIOS_ENVIADOS'].'</td>
         <td>'.$row["FORMULARIOS_RECEBIDOS"].'</td>
         <td>'.$row['DOCUMENTOS_FISICOS'].'</td>
         <td>'.$row["CTPS_RECEBIDA"].'</td>
         <td>'.$row["QUALIFIC_CADASTRAL_CEP"].'</td>
         <td>'.$row['CAD_ADM_PLATAFORMA_ADM_DIMIN'].'</td>
         <td>'.$row["DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO"].'</td>
         <td>'.$row['TERMO_PSI'].'</td>
         <td>'.$row["INCLUI_ADM_PROV"].'</td>
         <td>'.$row["ADMINISTRATIVO"].'</td>
         <td>'.$row["AGENDAMENTO_EXAM_ADM"].'</td>
         <td>'.$row['ENVIO_FUNC_EXAME'].'</td>
         <td>'.$row["EMAIL_RECEBIDO_EXAM"].'</td>
         <td>'.$row['ANEXAR_ASO'].'</td>
         <td>'.$row["ENVIO"].'</td>
         <td>'.$row['RECEBIDO'].'</td>
         <td>'.$row["ANEXAR_COMPR_DOMIN"].'</td>
         <td>'.$row['PLANILHA_CONTAS'].'</td>
         <td>'.$row['FORM_COMPR_BANCARIO'].'</td>
         <td>'.$row['AGENCIA'].'</td>
         <td>'.$row['NUMERO_CONTA'].'</td>
         <td>'.$row['TIPO_CONTA'].'</td>
         <td>'.$row["EMAIL_SUP"].'</td>
         <td>'.$row['USUARIO'].'</td>
         <td>'.$row["SENHA"].'</td>
         <td>'.$row['EQUIPAMENTO'].'</td>
         <td>'.$row['TRANSLADO'].'</td>
         <td>'.$row['INTRANET_CADASTRO_USUARIO'].'</td>
         <td>'.$row["INTRANET_CADASTRO_SENHA"].'</td>
         <td>'.$row['KAIROS_CADASTRO_USUARIO'].'</td>
         <td>'.$row["KAIROS_CADASTRO_SENHA"].'</td>
         <td>'.$row["EMAIL_GESTOR_APOIO_SEDE"].'</td>
         <td>'.$row["EMAIL_INICIO_ATIVIDADES"].'</td>
         <td>'.$row['EMAIL_BOAS_VINDAS'].'</td>
         <td>'.$row["ACESSOS"].'</td>
         <td>'.$row["POSICAO_COMENTARIO"].'</td>
         <td>'.$row['EMAIL_CADERNO_COMPASSO_SOLICITADO'].'</td>
         <td>'.$row["EMAIL_CADERNO_COMPASSO_RECEBIDO"].'</td>
         <td>'.$row['MALOTE_CADERNO_COMPASSO_CTPS'].'</td>
         <td>'.$row["DOCUMENTOS_RECEBIDOS_ASSINADOS"].'</td>
         <td>'.$row['CRACHA_DATA_PEDIDO'].'</td>
         <td>'.$row["CRACHA_CONTROLE"].'</td>
         <td>'.$row['CRACHA_PROTOCOLO'].'</td>
         <td>'.$row["BOAS_VINDAS_INGR_AGENDADA"].'</td>
         <td>'.$row["BOAS_VINDAS_INGR_REALIZADA"].'</td>
         <td>'.$row["BOAS_VINDAS_SALA"].'</td>
         <td>'.$row["LAYOUT_BOAS_VINDAS_MENSAL"].'</td>
       </tr>
        ';

    }
    $output .= '</table>';
    header('Content-Type: application/xls');
    header('Content-Disposition: attachment; filename=Tabelas.xls');
    echo $output;
   }
  }
  ?>
