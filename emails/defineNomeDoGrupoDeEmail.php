<?php
  function grupoEmail($cargo, $sede){
    $cargo = strtoupper($cargo);
    if($cargo == "GESTOR" || $cargo == "GESTORES"){
      $grupo = "Equipe ". $sede;
    }elseif($cargo == "BACK OFFICE" || $cargo == "BACKOFFICE"){
      $grupo = "";
    }elseif($cargo == "SUPORTE"){
      $grupo = "Equipe ". $sede;
    }else {
      $grupo = "Equipe " . $sede;
    }

    return $grupo;
  }

  function grupoEmail2($cargo, $sede){
    $cargo = strtoupper($cargo);
    if($cargo == "GESTOR" || $cargo == "GESTORES"){
      $grupo = "GESTORES + DESENVOLVIMENTO Interno - ";
    }elseif($cargo == "BACK OFFICE" || $cargo == "BACKOFFICE"){
      $grupo = "";
    }elseif($cargo == "SUPORTE"){
      $grupo = "SUPORTE Interno - ";
    }else {
      $grupo = "DESENVOLVIMENTO Interno - ";
    }

    return $grupo;
  }
?>