<?php
//export.php
$connect = mysqli_connect("localhost", "root", "", "bancorh");
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT ID_USUARIO, QUALIFIC_CADASTRAL_CEP,
            CAD_ADM_PLATAFORMA_ADM_DIMIN, DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO,
            TERMO_PSI, INCLUI_ADM_PROV,
            ADMINISTRATIVO,
            STATUS, PROJETO, NOME
            from admissao as p
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
            <th width= "150px">Qualificação Cadastral e CEP</th>
            <th width= "150px">Cadastrada Admissão Plataforma Domínio</th>
            <th width= "150px">Documentos recebidos plataforma domínio + validação CBO</th>
            <th width= "150px">Termo PSI</th>
            <th width= "150px">Inclui admissão na provisória</th>
            <th width= "150px">Projeto</th>
        </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
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
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=Tabela6.xls');
  echo $output;
 }
}
?>