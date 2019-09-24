<?php
  function grupoEmail($cargo, $sede){
    $cargo = strtoupper($cargo);
    if($cargo == "GESTOR" || $cargo == "GESTORES"){
      $grupo = "GESTORES + DESENVOLVIMENTO Interno - Equipe ". $sede;
    }elseif($cargo == "BACK OFFICE" || $cargo == "BACKOFFICE"){
      $grupo = "";
    }elseif($cargo == "SUPORTE"){
      $grupo = "SUPORTE Interno - Equipe ". $sede;
    }else {
      $grupo = "DESENVOLVIMENTO Interno - Equipe " . $sede;
    }

    return $grupo;
  }




?>
