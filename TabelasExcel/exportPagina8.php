<?php
include('../db/conexao.php');
//export.php
$connect = mysqli_connect("localhost", "root", "", "bancorh");
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT ID_USUARIO, ENVIO,
            RECEBIDO,
            PLANILHA_CONTAS, FORM_COMPR_BANCARIO, AGENCIA, NUMERO_CONTA, TIPO_CONTA,
            STATUS, PROJETO, NOME
            from bancarios as p
            LEFT JOIN admissao_dominio as a
            on p.ID_USUARIO = a.USUARIO_ID
            where ID_USUARIO = USUARIO_ID";

$result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">
        <tr>
            <th width= "150px">Status</th>
            <th width= "150px">Nome</th>
            <th width= "150px">Envio</th>
            <th width= "150px">Recebido</th>
            <th width= "150px">Cadstro Intranet</th>
            <th width= "150px">Formuário + comprovante bancário</th>
            <th width= "150px">Agência</th>
            <th width= "150px">Conta</th>
            <th width= "150px">Tipo da Conta</th>
            <th width= "150px">Projeto</th>
        </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
        <tr>
            <td>'.$row['STATUS'].'</td>
            <td>'.$row['NOME'].'</td>
            <td>'.$row['ENVIO'].'</td>
            <td>'.$row['RECEBIDO'].'</td>
            <td>'.$row['PLANILHA_CONTAS'].'</td>
            <td>'.$row['FORM_COMPR_BANCARIO'].'</td>
            <td>'.$row['AGENCIA'].'</td>
            <td>'.$row['NUMERO_CONTA'].'</td>
            <td>'.$row['TIPO_CONTA'].'</td>
            <td>'.$row['PROJETO'].'</td>
        </tr>
        ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=Tabela8.xls');
  echo $output;
 }
}
?>
