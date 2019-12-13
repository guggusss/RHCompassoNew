<?php
//export.php
$connect = mysqli_connect("localhost", "root", "", "bancorh");
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT ID_USUARIO, GESTOR,
        GESTOR_SABE, GESTOR_LOCAL,
        GESTOR_LOCAL_sABE, RECEPTOR_PESSOA,
        STATUS, PROJETO, NOME
        from gestao as p
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
                  <th width= "150px">Gestor</th>
                  <th width= "150px">Gestor Sabe?</th>
                  <th width= "150px">Gestor Local</th>
                  <th width= "150px">Gestor Local Sabe?</th>
                  <th width= "150px">Quem do projeto receberá a pessoa?</th>
                  <th width= "150px">Projeto</th>
                  </tr>

  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
            <tr>
            <td>'.$row["STATUS"].'</td>
            <td>'.$row["NOME"].'</td>
            <td>'.$row["GESTOR"].'</td>
            <td>'.$row["GESTOR_SABE"].'</td>
            <td>'.$row['GESTOR_LOCAL'].'</td>
            <td>'.$row['GESTOR_LOCAL_sABE'].'</td>
            <td>'.$row['RECEPTOR_PESSOA'].'</td>
            <td>'.$row["PROJETO"].'</td>
            </tr>
            ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=Tabela3.xls');
  echo $output;
 }
}
?>