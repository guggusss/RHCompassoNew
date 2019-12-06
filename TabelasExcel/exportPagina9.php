<?php
//export.php
$connect = mysqli_connect("mysql-server", "root", "password", "bancorh");
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT ID_USUARIO, EMAIL_SUP, USUARIO, SENHA, EQUIPE, EQUIPAMENTO, TRANSLADO, STATUS, PROJETO, NOME, USUARIO_ATV
            from suporte_interno as p
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
            <th width= "250px">Email</th>
            <th width= "150px">Usuário</th>
            <th width= "150px">Senha de acesso</th>
            <th width= "150px">Equipamento</th>
            <th width= "150px">Necessidade de translado</th>
            <th width= "150px">Grupos de Email</th>
            <th width= "150px">Projeto</th>
            <th width= "150px">Usuário Ativo</th>
        </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
        <tr>
            <td>'.$row["STATUS"].'</td>
            <td>'.$row["NOME"].'</td>
            <td>'.$row["EMAIL_SUP"].'</td>
            <td>'.$row['USUARIO'].'</td>
            <td>'.$row["SENHA"].'</td>
            <td>'.$row['EQUIPAMENTO'].'</td>
            <td>'.$row['TRANSLADO'].'</td>
            <td>'.$row['EQUIPE'].'</td>
            <td>'.$row["PROJETO"].'</td>
            <td>'.$row["USUARIO_ATV"].'</td>

        </tr>
        ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=Tabela9.xls');
  echo $output;
 }
}
?>