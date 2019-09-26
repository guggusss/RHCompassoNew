
<?php
$connect = mysqli_connect("localhost", "root", "", "bancorh");
$sql = "SELECT * FROM admissao_dominio as a
LEFT JOIN parametros_captacao as p
on a.ID_CAPTACAO = p.CAPTACAO_ID
JOIN sede as s
on a.ID_SEDE = s.SEDE_ID
JOIN tipo as t
on a.ID_TIPO = t.TIPO_ID
";
$result = mysqli_query($connect, $sql);
?>
<html>
 <head>
  <meta charset="UTF-8">
  <title>RH Contratações</title>

  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/arquivo.css">
  <link rel="stylesheet" href="../css/menuPrincipal.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

 </head>
 <body>

  <header class="site-header">
          <img src="http://www.compasso.com.br/wp-content/uploads/2018/04/Logo_Compasso_01-mini.png" alt="Compasso Tecnologia">
          <nav>
              <a class='nav inicio' href='../telas/menuPrincipal.php'>Início</a>
          </nav>
      </header>

      <section class='menu-inicial'>

      <h2 id = 'nome' align="center">Exportar tabelas para Excel</h2><br />


      </section>
  <div class="container estruct">
   <br />
   <form method="post" action="ExcelTotal.php">
        <input type="submit" name="export" class="btn btn-success" value="EXPORTAR TODAS" />
     </form>
   <br />
   <br />
   <div class="table-responsive">
    <h1>Menu Principal</h1>
    <table class="table table-bordered">

                        <th width='150px'>Status</th>
                        <th width='60px'>Sede</th>
                        <th width='60px'>Tipo</th>
                        <th width='100px'>Captação</th>
                        <th width='100px'>Carga Horária</th>
                        <th width='100px'>Horário</th>
                        <th width='200px'>Nome</th>
                        <th width='200px'>Sexo</th>
                        <th width='85px'>Fone</th>
                        <th width='100px'>Cargo</th>
                        <th width='110px'>Controle Data Admissão</th>
                        <th width='100px'>Remuneração Base</th>
                        <th width='100px'>Gratificação</th>
                        <th width='200px'>Solicitante</th>
                        <th width= "150px">Cliente</th>
                        <th width='150px'>Projeto</th>
                        <th width='250px'>Email</th>
                        <th width='110px'>Data Admissão</th>
                        <th width='200px'>Posição(Comentários)</th>
                        <th width='200px'>Administrativo + Flyback - Hotel</th>

     <?php
     while($row = mysqli_fetch_array($result))
     {
        echo '
       <tr>
         <td>'.$row["STATUS"].'</td>
         <td>'.$row["NOME_SEDE"].'</td>
         <td>'.$row["NOME_TIPO"].'</td>
         <td>'.$row['NOME_PARAMETRO'].'</td>
         <td>'.$row["CARGA_HORARIA"].'</td>
         <td>'.$row['HORARIO'].'</td>
         <td>'.$row["NOME"].'</td>
         <td>'.$row["SEXO"].'</td>
         <td>'.$row["FONE_CONTATO"].'</td>
         <td>'.$row["CARGO"].'</td>
         <td>'.$row["CONTROLE_DATA_ADMISSAO"].'</td>
         <td>'.$row["REMUNERACAO_BASE"].'</td>
         <td>'.$row["GRATIFICACAO"].'</td>
         <td>'.$row["SOLICITANTE"].'</td>
         <td>'.$row["PROJETO"].'</td>
         <td>'.$row["CLIENTE"].'</td>
         <td>'.$row["EMAIL"].'</td>
         <td>'.$row["DATA_ADMISSAO"].'</td>
         <td>'.$row["POSICAO_COMENTARIO"].'</td>
         <td>'.$row["ADMINISTRATIVO"].'</td>
       </tr>
        ';
     }
     ?>
     </table>
     <br />
     <form method="post" action="exportPagina1.php">
      <input type="submit" name="export" class="btn btn-success" value="EXPORTAR" />
     </form>
    </div>
   </div>
  </body>
</html>



<?PHP
$connect = mysqli_connect("localhost", "root", "", "bancorh");
$sql = "SELECT ID_USUARIO, PROPOSTA_RECEBIDA,
        DE_ACORDO_DIRECAO,ENQUADRAMENTO,
        ENVIO_PROPOSTA,COMUNICAR_PROPOSTA_ENVIADA,
        ACEITE_RECUSA_CANDIDATO,COMENTARIO,
        COMUNICAR_STATUS, STATUS, NOME
        from propostas_contratacoes as p
        LEFT JOIN admissao_dominio as a
        on p.ID_USUARIO = a.USUARIO_ID
        where ID_USUARIO = USUARIO_ID";

$result = mysqli_query($connect, $sql);
?>
<html>
 <head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 </head>
 <body>
  <div class="container estruct">
   <br />
   <br />
   <br />
   <div class="table-responsive">
   <h1>Proposta de Contratação</h1>
    <table class="table table-bordered">
                        <th>Nome</th>
                        <th>Enquadramento remuneração envio</th>
                        <th>Enquadramento remuneração retorno</th>
                        <th>Enquadramento(Validação Ex Funcionário)</th>
                        <th>Envio da Proposta</th>
                        <th>Comunicar proposta enviada Solicitante</th>
                        <th>Aceite/recusa candidato</th>
                        <th>Comentário</th>
                        <th>Comunicar Status da Proposta ao Solicitante</th>

     <?php
     while($row = mysqli_fetch_array($result))
     {
        echo '
       <tr>
        <td>'.$row["NOME"].'</td>
         <td>'.$row["PROPOSTA_RECEBIDA"].'</td>
         <td>'.$row["DE_ACORDO_DIRECAO"].'</td>
         <td>'.$row['ENQUADRAMENTO'].'</td>
         <td>'.$row["ENVIO_PROPOSTA"].'</td>
         <td>'.$row['COMUNICAR_PROPOSTA_ENVIADA'].'</td>
         <td>'.$row["ACEITE_RECUSA_CANDIDATO"].'</td>
         <td>'.$row["COMENTARIO"].'</td>
         <td>'.$row["COMUNICAR_STATUS"].'</td>
       </tr>
        ';
     }
     ?>
    </table>
    <br />
    <form method="post" action="exportPagina2.php">
     <input type="submit" name="export" class="btn btn-success" value="EXPORTAR" />
    </form>
   </div>
  </div>
 </body>
</html>

<?PHP
$connect = mysqli_connect("localhost", "root", "", "bancorh");
$sql = "SELECT ID_USUARIO, GESTOR,
        GESTOR_SABE, GESTOR_LOCAL,
        GESTOR_LOCAL_sABE, RECEPTOR_PESSOA,
        STATUS, PROJETO, NOME
        from gestao as p
        LEFT JOIN admissao_dominio as a
        on p.ID_USUARIO = a.USUARIO_ID
        where ID_USUARIO = USUARIO_ID";

$result = mysqli_query($connect, $sql);
?>
<html>
 <head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 </head>
 <body>
  <div class="container estruct">
   <br />
   <br />
   <br />
   <div class="table-responsive">
   <h1>Gestão</h1>
    <table class="table table-bordered">
                        <th>STATUS</th>
                        <th>NOME</th>
                        <th>GESTOR</th>
                        <th>GESTOR SABE?</th>
                        <th>GESTOR LOCAL</th>
                        <th>GESTOR LOCAL SABE?</th>
                        <th>Quem do projeto receberá a pessoa?</th>
                        <th width='150px'>Projeto</th>

     <?php
     while($row = mysqli_fetch_array($result))
     {
        echo '
       <tr>
         <td>'.$row["STATUS"].'</td>
         <td>'.$row["NOME"].'</td>
         <td>'.$row['GESTOR'].'</td>
         <td>'.$row["GESTOR_SABE"].'</td>
         <td>'.$row['GESTOR_LOCAL'].'</td>
         <td>'.$row["GESTOR_LOCAL_sABE"].'</td>
         <td>'.$row["RECEPTOR_PESSOA"].'</td>
         <td>'.$row["PROJETO"].'</td>
       </tr>
        ';
     }
     ?>
    </table>
    <br />
    <form method="post" action="exportPagina3.php">
     <input type="submit" name="export" class="btn btn-success" value="EXPORTAR" />
    </form>
   </div>
  </div>
 </body>
</html>


<?PHP
$connect = mysqli_connect("localhost", "root", "", "bancorh");
$sql = "SELECT ID_USUARIO, ENVIO_SOLICITANTE_PRI,
        DATA_VENCIMENTO_PRI, RENOVACAO,
        ENVIO_SOLICITANTE_SEG, DATA_VENCIMENTO_SEG,
        EFETIVACAO, STATUS, PROJETO, NOME
        from vencimentos as p
        LEFT JOIN admissao_dominio as a
        on p.ID_USUARIO = a.USUARIO_ID
        where ID_USUARIO = USUARIO_ID";

$result = mysqli_query($connect, $sql);
?>
<html>
 <head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 </head>
 <body>
  <div class="container estruct">
   <br />
   <br />
   <br />
   <div class="table-responsive">
   <h1>Vencimentos Contratos</h1>
    <table class="table table-bordered">
                      <tr>
                        <th></th>
                        <th></th>
                        <th colspan='3'>1° Alerta Vencimento 45 dias</th>
                        <th colspan='3'>1° Alerta Vencimento 90 dias</th>
                        <th></th>
                      </tr>
                      <tr>
                        <th>STATUS</th>
                        <th>NOME</th>
                        <th>Envio Solicitante</th>
                        <th>Data vencimento</th>
                        <th>Renovação</th>
                        <th>Envio Solicitante</th>
                        <th>Data Vencimento</th>
                        <th>Efetivação</th>
                        <th width='150px'>Projeto</th>
                      </tr>

     <?php
     while($row = mysqli_fetch_array($result))
     {
        echo '
       <tr>
         <td>'.$row["STATUS"].'</td>
         <td>'.$row["NOME"].'</td>
         <td>'.$row['ENVIO_SOLICITANTE_PRI'].'</td>
         <td>'.$row["DATA_VENCIMENTO_PRI"].'</td>
         <td>'.$row['RENOVACAO'].'</td>
         <td>'.$row["ENVIO_SOLICITANTE_SEG"].'</td>
         <td>'.$row["DATA_VENCIMENTO_SEG"].'</td>
         <td>'.$row["EFETIVACAO"].'</td>
         <td>'.$row["PROJETO"].'</td>
       </tr>
        ';
     }
     ?>
    </table>
    <br />
    <form method="post" action="exportPagina4.php">
     <input type="submit" name="export" class="btn btn-success" value="EXPORTAR" />
    </form>
   </div>
  </div>
 </body>
</html>


<?PHP
$connect = mysqli_connect("localhost", "root", "", "bancorh");
$sql = "SELECT ID_USUARIO, FORMULARIOS_ENVIADOS,
        FORMULARIOS_RECEBIDOS, DOCUMENTOS_FISICOS,
        CTPS_RECEBIDA,
        STATUS, PROJETO, NOME
        from documentacao as p
        LEFT JOIN admissao_dominio as a
        on p.ID_USUARIO = a.USUARIO_ID
        where ID_USUARIO = USUARIO_ID";

$result = mysqli_query($connect, $sql);
?>
<html>
 <head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 </head>
 <body>
  <div class="container estruct">
   <br />
   <br />
   <br />
   <div class="table-responsive">
   <h1>Documentação</h1>
    <table class="table table-bordered">
                      <tr>
                        <th></th>
                        <th></th>
                        <th colspan='2'>E-mail  formulários admissão</th>
                        <th>Documentos Físicos</th>
                        <th>CTPS</th>
                        <th></th>
                      </tr>
                      <tr>
                        <th>STATUS</th>
                        <th>NOME</th>
                        <th>Formulários Enviados</th>
                        <th>Formulários Recebidos</th>
                        <th>Cópia RG/CPF/PIS/Titulo  Eleitor/Declaração Oracle/Foto 3x4/Comprovante endereço</th>
                        <th>CTPS Recebida</th>
                        <th width='150px'>Projeto</th>
                      </tr>

     <?php
     while($row = mysqli_fetch_array($result))
     {
        echo '
       <tr>
         <td>'.$row["STATUS"].'</td>
         <td>'.$row["NOME"].'</td>
         <td>'.$row['FORMULARIOS_ENVIADOS'].'</td>
         <td>'.$row["FORMULARIOS_RECEBIDOS"].'</td>
         <td>'.$row['DOCUMENTOS_FISICOS'].'</td>
         <td>'.$row["CTPS_RECEBIDA"].'</td>
         <td>'.$row["PROJETO"].'</td>
       </tr>
        ';
     }
     ?>
    </table>
    <br />
    <form method="post" action="exportPagina5.php">
     <input type="submit" name="export" class="btn btn-success" value="EXPORTAR" />
    </form>
   </div>
  </div>
 </body>
</html>

<?php
$connect = mysqli_connect("localhost", "root", "", "bancorh");
$sql = "SELECT ID_USUARIO, QUALIFIC_CADASTRAL_CEP,
        CAD_ADM_PLATAFORMA_ADM_DIMIN, DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO,
        TERMO_PSI, INCLUI_ADM_PROV,
        ADMINISTRATIVO,
        STATUS, PROJETO, NOME
        from admissao as p
        LEFT JOIN admissao_dominio as a
        on p.ID_USUARIO = a.USUARIO_ID
        where ID_USUARIO = USUARIO_ID";

$result = mysqli_query($connect, $sql);
?>
<html>
 <head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 </head>
 <body>
  <div class="container estruct">
   <br />
   <br />
   <br />
   <div class="table-responsive">
   <h1>Plataforma Admissão Domínio Dados + Fichas de Cadastro</h1>
    <table class="table table-bordered">
                        <th>Status</th>
                        <th>Nome</th>
                        <th>Qualificação Cadastral e CEP</th>
                        <th>Cadastrada Admissão Plataforma Domínio</th>
                        <th>Documentos recebidos plataforma domínio + validação CBO</th>
                        <th>Termo PSI</th>
                        <th>Inclui admissão na provisória</th>
                        <th width='150px'>Projeto</th>

     <?php
     while($row = mysqli_fetch_array($result))
     {
        echo '
       <tr>
        <td>'.$row["STATUS"].'</td>
         <td>'.$row["NOME"].'</td>
         <td>'.$row["QUALIFIC_CADASTRAL_CEP"].'</td>
         <td>'.$row['CAD_ADM_PLATAFORMA_ADM_DIMIN'].'</td>
         <td>'.$row["DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO"].'</td>
         <td>'.$row['TERMO_PSI'].'</td>
         <td>'.$row["INCLUI_ADM_PROV"].'</td>
         <td>'.$row["PROJETO"].'</td>
       </tr>
        ';
     }
     ?>
    </table>
    <br />
    <form method="post" action="exportPagina6.php">
     <input type="submit" name="export" class="btn btn-success" value="EXPORTAR" />
    </form>
   </div>
  </div>
 </body>
</html>


<?php
$connect = mysqli_connect("localhost", "root", "", "bancorh");
$sql = "SELECT ID_USUARIO, AGENDAMENTO_EXAM_ADM,
        ENVIO_FUNC_EXAME, EMAIL_RECEBIDO_EXAM,
        ANEXAR_ASO,
        STATUS, PROJETO, NOME
        from exame_admissional as p
        LEFT JOIN admissao_dominio as a
        on p.ID_USUARIO = a.USUARIO_ID
        where ID_USUARIO = USUARIO_ID";

$result = mysqli_query($connect, $sql);
?>
<html>
 <head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 </head>
 <body>
  <div class="container estruct">
   <br />
   <br />
   <br />
   <div class="table-responsive">
   <h1>Exame Admissional</h1>
    <table class="table table-bordered">
                        <th>Status</th>
                        <th>Nome</th>
                        <th>Agendamento</th>
                        <th>Envio para Funcionário</th>
                        <th>Recebido por e-mail ASO assinado</th>
                        <th>Anexar ASO na domínio</th>
                        <th width='150px'>Projeto</th>

     <?php
     while($row = mysqli_fetch_array($result))
     {
        echo '
       <tr>
        <td>'.$row["STATUS"].'</td>
         <td>'.$row["NOME"].'</td>
         <td>'.$row["AGENDAMENTO_EXAM_ADM"].'</td>
         <td>'.$row['ENVIO_FUNC_EXAME'].'</td>
         <td>'.$row["EMAIL_RECEBIDO_EXAM"].'</td>
         <td>'.$row['ANEXAR_ASO'].'</td>
         <td>'.$row["PROJETO"].'</td>
       </tr>
        ';
     }
     ?>
    </table>
    <br />
    <form method="post" action="exportPagina7.php">
     <input type="submit" name="export" class="btn btn-success" value="EXPORTAR" />
    </form>
   </div>
  </div>
 </body>
</html>


<?php
$connect = mysqli_connect("localhost", "root", "", "bancorh");
$sql = "SELECT ID_USUARIO, ENVIO,
        RECEBIDO, ANEXAR_COMPR_DOMIN,
        PLANILHA_CONTAS, FORM_COMPR_BANCARIO,
        STATUS, PROJETO, NOME
        from bancarios as p
        LEFT JOIN admissao_dominio as a
        on p.ID_USUARIO = a.USUARIO_ID
        where ID_USUARIO = USUARIO_ID";

$result = mysqli_query($connect, $sql);
?>
<html>
 <head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 </head>
 <body>
  <div class="container estruct">
   <br />
   <br />
   <br />
   <div class="table-responsive">
   <h1>Dados bancários</h1>
    <table class="table table-bordered">
                        <th>Status</th>
                        <th>Nome</th>
                        <th>Envio</th>
                        <th>Recebido</th>
                        <th>Anexar comprovante na Domínio</th>
                        <th>Cadastro Intranet</th>
                        <th>Formuário + comprovante bancário</th>
                        <th width='150px'>Projeto</th>

     <?php
     while($row = mysqli_fetch_array($result))
     {
        echo '
       <tr>
        <td>'.$row["STATUS"].'</td>
         <td>'.$row["NOME"].'</td>
         <td>'.$row["ENVIO"].'</td>
         <td>'.$row['RECEBIDO'].'</td>
         <td>'.$row["ANEXAR_COMPR_DOMIN"].'</td>
         <td>'.$row['PLANILHA_CONTAS'].'</td>
         <td>'.$row['FORM_COMPR_BANCARIO'].'</td>
         <td>'.$row["PROJETO"].'</td>
       </tr>
        ';
     }
     ?>
    </table>
    <br />
    <form method="post" action="exportPagina8.php">
     <input type="submit" name="export" class="btn btn-success" value="EXPORTAR" />
    </form>
   </div>
  </div>
 </body>
</html>


<?php
$connect = mysqli_connect("localhost", "root", "", "bancorh");
$sql = "SELECT ID_USUARIO, EMAIL_SUP,
        USUARIO, SENHA,
        EQUIPAMENTO, TRANSLADO, EQUIPE,
        STATUS, PROJETO, NOME
        from suporte_interno as p
        LEFT JOIN admissao_dominio as a
        on p.ID_USUARIO = a.USUARIO_ID
        where ID_USUARIO = USUARIO_ID";

$result = mysqli_query($connect, $sql);
?>
<html>
 <head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 </head>
 <body>
  <div class="container estruct">
   <br />
   <br />
   <br />
   <div class="table-responsive">
   <h1>Suporte Interno</h1>
    <table class="table table-bordered">
                        <th>Status</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Usuário</th>
                        <th>Senha de acesso</th>
                        <th>Equipamento</th>
                        <th>Necessidade de translado</th>
                        <th>Grupos de Email</th>
                        <th width='150px'>Projeto</th>

     <?php
     while($row = mysqli_fetch_array($result))
     {
        echo '
       <tr>
        <td>'.$row["STATUS"].'</td>
         <td>'.$row["NOME"].'</td>
         <td>'.$row["EMAIL_SUP"].'</td>
         <td>'.$row["USUARIO"].'</td>
         <td>'.$row["SENHA"].'</td>
         <td>'.$row["EQUIPAMENTO"].'</td>
         <td>'.$row["TRANSLADO"].'</td>
         <td>'.$row["EQUIPE"].'</td>
         <td>'.$row["PROJETO"].'</td>
       </tr>
        ';
     }
     ?>
    </table>
    <br />
    <form method="post" action="exportPagina9.php">
     <input type="submit" name="export" class="btn btn-success" value="EXPORTAR" />
    </form>
   </div>
  </div>
 </body>
</html>


<?PHP
$connect = mysqli_connect("localhost", "root", "", "bancorh");
$sql = "SELECT ID_USUARIO, INTRANET_CADASTRO_USUARIO,
        INTRANET_CADASTRO_SENHA, KAIROS_CADASTRO_USUARIO,
        KAIROS_CADASTRO_SENHA, EMAIL_GESTOR_APOIO_SEDE,
        EMAIL_INICIO_ATIVIDADES, EMAIL_BOAS_VINDAS,
        ACESSOS, STATUS, PROJETO, NOME
        from interno as p
        LEFT JOIN admissao_dominio as a
        on p.ID_USUARIO = a.USUARIO_ID
        where ID_USUARIO = USUARIO_ID";

$result = mysqli_query($connect, $sql);
?>
<html>
 <head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 </head>
 <body>
  <div class="container estruct">
   <br />
   <br />
   <br />
   <div class="table-responsive">
   <h1>Interno</h1>
    <table class="table table-bordered">
                      <tr>
                        <th></th>
                        <th></th>
                        <th colspan='2'>Intranet</th>
                        <th colspan='2'>Kairos</th>
                        <th colspan='3'>E-mail</th>
                        <th></th>
                        <th></th>
                      </tr>
                      <tr>
                        <th>STATUS</th>
                        <th>NOME</th>
                        <th>Cadastro Usuário</th>
                        <th>Senha</th>
                        <th>Cadastro Usuário</th>
                        <th>Código/Senha</th>
                        <th>Gestor + Apoio Sede</th>
                        <th>E-mail início das atividades</th>
                        <th>E-mail Boas Vindas</th>
                        <th>Acessos</th>
                        <th width='150px'>projeto</th>
                      </tr>

     <?php
     while($row = mysqli_fetch_array($result))
     {
        echo '
       <tr>
         <td>'.$row["STATUS"].'</td>
         <td>'.$row["NOME"].'</td>
         <td>'.$row['INTRANET_CADASTRO_USUARIO'].'</td>
         <td>'.$row["INTRANET_CADASTRO_SENHA"].'</td>
         <td>'.$row['KAIROS_CADASTRO_USUARIO'].'</td>
         <td>'.$row["KAIROS_CADASTRO_SENHA"].'</td>
         <td>'.$row["EMAIL_GESTOR_APOIO_SEDE"].'</td>
         <td>'.$row["EMAIL_INICIO_ATIVIDADES"].'</td>
         <td>'.$row['EMAIL_BOAS_VINDAS'].'</td>
         <td>'.$row["ACESSOS"].'</td>
         <td>'.$row["PROJETO"].'</td>
       </tr>
        ';
     }
     ?>
    </table>
    <br />
    <form method="post" action="exportPagina10.php">
     <input type="submit" name="export" class="btn btn-success" value="EXPORTAR" />
    </form>
   </div>
  </div>
 </body>
</html>


<?PHP
$connect = mysqli_connect("localhost", "root", "", "bancorh");
$sql = "SELECT ID_USUARIO, EMAIL_CADERNO_COMPASSO_SOLICITADO,
        EMAIL_CADERNO_COMPASSO_RECEBIDO, MALOTE_CADERNO_COMPASSO_CTPS,
        DOCUMENTOS_RECEBIDOS_ASSINADOS,CRACHA_DATA_PEDIDO, CRACHA_CONTROLE, CRACHA_PROTOCOLO ,
        STATUS, PROJETO, NOME
        from vias_documentos_funcionarios  as p
        LEFT JOIN admissao_dominio as a
        on p.ID_USUARIO = a.USUARIO_ID
        where ID_USUARIO = USUARIO_ID";

$result = mysqli_query($connect, $sql);
?>
<html>
 <head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 </head>
 <body>
  <div class="container estruct">
   <br />
   <br />
   <br />
   <div class="table-responsive">
   <h1>Vias Documentos funcionário</h1>
    <table class="table table-bordered">
                      <tr>
                        <th></th>
                        <th></th>
                        <th colspan = '3'>Crachá + Cordão + Roller</th>
                        <th colspan='2'>E-mail Adm Caderno Compasso</th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                      <tr>
                        <th>STATUS</th>
                        <th>NOME</th>
                        <th>Data do pedido do crachá</th>
                        <th>Controle</th>
                        <th>Protocolo</th>
                        <th>E-mail = Solicitado</th>
                        <th>E-mail = Recebido</th>
                        <th>Malote (Caderno) + CTPS (Controle RH)</th>
                        <th>Recebido após assinatura Escanear Docs e Salvar na Pasta</th>
                        <th width='150px'>Projeto</th>
                      </tr>

     <?php
     while($row = mysqli_fetch_array($result))
     {
        echo '
       <tr>
         <td>'.$row["STATUS"].'</td>
         <td>'.$row["NOME"].'</td>
         <td>'.$row["CRACHA_DATA_PEDIDO"].'</td>
         <td>'.$row["CRACHA_CONTROLE"].'</td>
         <td>'.$row["CRACHA_PROTOCOLO"].'</td>
         <td>'.$row['EMAIL_CADERNO_COMPASSO_SOLICITADO'].'</td>
         <td>'.$row["EMAIL_CADERNO_COMPASSO_RECEBIDO"].'</td>
         <td>'.$row['MALOTE_CADERNO_COMPASSO_CTPS'].'</td>
         <td>'.$row["DOCUMENTOS_RECEBIDOS_ASSINADOS"].'</td>
         <td>'.$row["PROJETO"].'</td>
       </tr>
        ';
     }
     ?>
    </table>
    <br />
    <form method="post" action="exportPagina11.php">
     <input type="submit" name="export" class="btn btn-success" value="EXPORTAR" />
    </form>
   </div>
  </div>
 </body>
</html>


<?PHP
$connect = mysqli_connect("localhost", "root", "", "bancorh");
$sql = "SELECT ID_USUARIO, BOAS_VINDAS_INGR_AGENDADA, BOAS_VINDAS_INGR_REALIZADA,
        BOAS_VINDAS_SALA, LAYOUT_BOAS_VINDAS_MENSAL,
        STATUS, PROJETO, NOME
        from boas_vindas as p
        LEFT JOIN admissao_dominio as a
        on p.ID_USUARIO = a.USUARIO_ID
        where ID_USUARIO = USUARIO_ID";

$result = mysqli_query($connect, $sql);
?>
<html>
 <head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 </head>
 <body>
  <div class="container estruct">
   <br />
   <br />
   <br />
   <div class="table-responsive">
   <h1>Boas Vindas</h1>
    <table class="table table-bordered">
                      <tr>
                        <th colspan='7'>Boas Vindas Compasso</th>
                      </tr>
                      <tr>
                        <th>STATUS</th>
                        <th>NOME</th>
                        <th>integração agendada</th>
                        <th>integração realizada</th>
                        <th>sala</th>
                        <th>Layot Boas vindas Mensal</th>
                        <th width='150px'>Projeto</th>
                      </tr>

     <?php
     while($row = mysqli_fetch_array($result))
     {
        echo '
       <tr>
         <td>'.$row["STATUS"].'</td>
         <td>'.$row["NOME"].'</td>
         <td>'.$row["BOAS_VINDAS_INGR_AGENDADA"].'</td>
         <td>'.$row["BOAS_VINDAS_INGR_REALIZADA"].'</td>
         <td>'.$row["BOAS_VINDAS_SALA"].'</td>
         <td>'.$row["LAYOUT_BOAS_VINDAS_MENSAL"].'</td>
         <td>'.$row["PROJETO"].'</td>
       </tr>
        ';
     }
     ?>
    </table>
    <br />
    <form method="post" action="exportPagina12.php">
     <input type="submit" name="export" class="btn btn-success" value="EXPORTAR" />
    </form>
   </div>
  </div>
 </body>
</html>
<br />
