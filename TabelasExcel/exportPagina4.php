<?php  
//export.php  
$connect = mysqli_connect("localhost", "root", "", "bancorh");
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT ID_USUARIO, ENVIO_SOLICITANTE_PRI,
            DATA_VENCIMENTO_PRI, RENOVACAO,
            ENVIO_SOLICITANTE_SEG, DATA_VENCIMENTO_SEG,
            EFETIVACAO, STATUS, PROJETO, NOME 
            from vencimentos as p 
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
                <th colspan="3">1° Alerta Vencimento 45 dias</th>
                <th colspan="3">1° Alerta Vencimento 90 dias</th>
                <th></th>
            </tr>
            <tr>
                <th width= "150px">STATUS</th>
                <th width= "150px">NOME</th>
                <th width= "150px">Envio Solicitante</th>
                <th width= "150px">Data vencimento</th>
                <th width= "150px">Renovação</th>
                <th width= "150px">Envio Solicitante</th>
                <th width= "150px">Data Vencimento</th>
                <th width= "150px">Efetivação</th>
                <th width= "150px">Projeto</th>
            </tr>
                    
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
            <tr>  
            <td>'.$row["STATUS"].'</td>
            <td>'.$row["NOME"].'</td>
            <td>'.$row["ENVIO_SOLICITANTE_PRI"].'</td>  
            <td>'.$row["DATA_VENCIMENTO_PRI"].'</td>  
            <td>'.$row['RENOVACAO'].'</td>
            <td>'.$row["ENVIO_SOLICITANTE_SEG"].'</td>  
            <td>'.$row['DATA_VENCIMENTO_SEG'].'</td>
            <td>'.$row['EFETIVACAO'].'</td>
            <td>'.$row["PROJETO"].'</td>
            </tr>  
            ';  
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=Tabela4.xls');
  echo $output;
 }
}
?>
