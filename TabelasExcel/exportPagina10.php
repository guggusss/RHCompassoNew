<?php  
//export.php  
$connect = mysqli_connect("localhost", "root", "", "bancorh");
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT ID_USUARIO, INTRANET_CADASTRO_USUARIO,
            INTRANET_CADASTRO_SENHA, KAIROS_CADASTRO_USUARIO,
            KAIROS_CADASTRO_SENHA, EMAIL_GESTOR_APOIO_SEDE,
            EMAIL_INICIO_ATIVIDADES, EMAIL_BOAS_VINDAS,
            ACESSOS,STATUS, PROJETO, NOME 
            from interno as p 
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
                <th colspan="2">Intranet</th>
                <th colspan="2">Kairos</th>
                <th colspan="3">E-mail</th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <th width= "150px">STATUS</th>
                <th width= "150px">NOME</th>
                <th width= "150px">Cadastro Usuário</th>
                <th width= "150px">Senha</th>
                <th width= "150px">Cadastro Usuário</th>
                <th width= "150px">Código/Senha</th>
                <th width= "150px">Gestor + Apoio Sede</th>
                <th width= "150px">E-mail início das atividades</th>
                <th width= "150px">E-mail Boas Vindas</th>
                <th width= "150px">Acessos</th>
                <th width= "150px">projeto</th>
            </tr>        
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
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
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=Tabela10.xls');
  echo $output;
 }
}
?>
