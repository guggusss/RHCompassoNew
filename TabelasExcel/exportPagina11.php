<?php
//export.php
$connect = mysqli_connect("mysql-server", "root", "password", "bancorh");
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT ID_USUARIO, EMAIL_CADERNO_COMPASSO_SOLICITADO,
            EMAIL_CADERNO_COMPASSO_RECEBIDO, MALOTE_CADERNO_COMPASSO_CTPS,
            DOCUMENTOS_RECEBIDOS_ASSINADOS, SALVAR_PASTA, CRACHA_DATA_PEDIDO, CRACHA_CONTROLE, CRACHA_PROTOCOLO,
            STATUS, PROJETO, NOME
            from vias_documentos_funcionarios  as p
            LEFT JOIN admissao_dominio as a
            on p.ID_USUARIO = a.USUARIO_ID
            where ID_USUARIO = USUARIO_ID";

$result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">
            <tr>
                <th></th>
                <th></th>
                <th colspan = "3">Crachá + Cordão + Roller</th>
                <th colspan="2">E-mail Adm Caderno Compasso</th>
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
                <th>Recebido após assinatura Escanear Docs>/th>
                <th>Salvar na Pasta</th>
                <th width="150px">Projeto</th>
            </tr>';

  while($row = mysqli_fetch_array($result))
  {
   $output .= '
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
            <td>'.$row["SALVAR_PASTA"].'</td>
            <td>'.$row["PROJETO"].'</td>
            </tr>
            ';
  
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=Tabela11.xls');
  echo $output;
 }
}
?>