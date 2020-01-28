<?  $msg = mysqli_error($conn);  ?>
        <head>
        <meta charset="UTF-8">
        <title>RH Contratações</title>
        <link rel="stylesheet" href="../css/reset.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/arquivo.css">
    </head>
    <p class="text-danger">Ocorreu um erro: <?= $msg ?></p>
   