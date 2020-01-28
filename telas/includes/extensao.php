<?php while ($rows_dados = mysqli_fetch_assoc($resultadoBarr)) {  ?>
    <th width='100px'><?php echo $rows_dados['STATUS']; ?></th>
    <th width='100px'><?php echo $rows_dados['NOME']; ?></th>
    <th width='170px'><?php echo $rows_dados['DATA_ADMISSAO']; ?></th>
    <th width='170px'><?php foreach ($listar as $linha) : ?>
    <span value="<?= $linha['SEDE_ID'] ?>">
    <?php if($linha['SEDE_ID'] == $rows_dados['ID_SEDE']){ echo $linha['NOME_SEDE']; } ?></span>
    <?php endforeach ?></th>
<?php  } ?>