<?php

    if($_SESSION['grupo'] == "Gestores"){
        echo "<script src='../js/valida/gestores.js'></script>";
    }elseif($_SESSION['grupo'] == "Suporte Interno"){
        echo "<script src='../js/valida/suporteInterno.js'></script>";
    }elseif($_SESSION['grupo'] == "Compasso - RH Integração"){
        echo "<script src='../js/valida/apoioSede.js'></script>";
    }
?>