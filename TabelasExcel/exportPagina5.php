<?php
//export.php
$connect = mysqli_connect("localhost", "root", "", "bancorh");
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT ID_USUARIO, FORMULARIOS_ENVIADOS,
            FORMULARIOS_RECEBIDOS, DOCUMENTOS_FISICOS,
            CTPS_RECEBIDA,
            STATUS, PROJETO, NOME
            from documentacao as p
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
                <th colspan="2">E-mail  formulários admissão</th>
                <th>Documentos Físicos</th>
                <th>CTPS</th>
                <th></th>
            </tr>
            <tr>
                <th width= "150px">STATUS</th>
                <th width= "150px">NOME</th>
                <th width= "150px">Formulários Enviados</th>
                <th width= "150px">Formulários Recebidos</th>
                <th width= "150px">Cópia RG/CPF/PIS/Titulo  Eleitor/Declaração Oracle/Foto 3x4/Comprovante endereço</th>
                <th width= "150px">CTPS Recebida</th>
                <th width= "150px">Projeto</th>
            </tr>

  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
            <tr>
            <td>'.$row["STATUS"].'</td>
            <td>'.$row["NOME"].'</td>
            <td>'.$row["FORMULARIOS_ENVIADOS"].'</td>
            <td>'.$row["FORMULARIOS_RECEBIDOS"].'</td>
            <td>'.$row['DOCUMENTOS_FISICOS'].'</td>
            <td>'.$row["CTPS_RECEBIDA"].'</td>
            <td>'.$row["PROJETO"].'</td>
            </tr>
            ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=Tabela5.xls');
  echo $output;
 }
}
?>

