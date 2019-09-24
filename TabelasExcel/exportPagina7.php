<?php  
//export.php  
$connect = mysqli_connect("localhost", "root", "", "bancorh");
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT ID_USUARIO, AGENDAMENTO_EXAM_ADM,
            ENVIO_FUNC_EXAME, EMAIL_RECEBIDO_EXAM,
            ANEXAR_ASO, 
            STATUS, PROJETO, NOME 
            from exame_admissional as p 
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
            <th width= "150px">Agendamento</th>
            <th width= "150px">Envio para Funcionário</th>
            <th width= "150px">Recebido por e-mail ASO assinado</th>
            <th width= "150px">Anexar ASO na domínio</th>
            <th width= "150px">Projeto</th>
        </tr>            
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
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
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=Tabela7.xls');
  echo $output;
 }
}
?>
