<?php  
//export.php  
$connect = mysqli_connect("localhost", "root", "", "bancorh");
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT ID_USUARIO, BOAS_VINDAS_INGR_AGENDADA, BOAS_VINDAS_INGR_REALIZADA,
            BOAS_VINDAS_SALA, BOAS_VINDA_ACOMPANHAMENTO_MENSAL, LAYOUT_BOAS_VINDAS_MENSAL,
            STATUS, PROJETO, NOME 
            from boas_vindas as p 
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
                <th colspan="5">Boas Vindas Compasso</th>
                <th></th>
            </tr>
            <tr>
                <th width= "150px">STATUS</th>
                <th width= "150px">NOME</th>
                <th width= "150px">integração agendada</th>
                <th width= "150px">integração realizada</th>
                <th width= "150px">sala</th>
                <th width= "150px">acompanhamento mensal</th>
                <th width= "150px">Layot Boas vindas Mensal</th>
                <th width= "150px">Projeto</th>
            </tr>
                    
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
            <tr>  
                <td>'.$row["STATUS"].'</td>  
                <td>'.$row["NOME"].'</td>  
                <td>'.$row["BOAS_VINDAS_INGR_AGENDADA"].'</td>
                <td>'.$row["BOAS_VINDAS_INGR_REALIZADA"].'</td>
                <td>'.$row["BOAS_VINDAS_SALA"].'</td>
                <td>'.$row["BOAS_VINDA_ACOMPANHAMENTO_MENSAL"].'</td>
                <td>'.$row["LAYOUT_BOAS_VINDAS_MENSAL"].'</td>
                <td>'.$row["PROJETO"].'</td>
            </tr>  
            ';  
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=Tabela12.xls');
  echo $output;
 }
}
?>
