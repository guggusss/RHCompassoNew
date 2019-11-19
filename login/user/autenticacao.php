<?php
require_once('../../db/serverLDAP.php');
require_once('../../db/conexao.php');
session_start();

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

if ($usuario == NULL || $senha == NULL) {
    header("Location:./login.php?erro=fail");
}

$dominio = "pampa.compasso";

// Versao do protocolo       
ldap_set_option($link, LDAP_OPT_PROTOCOL_VERSION, 3);
// Usara as referencias do servidor AD, neste caso nao
ldap_set_option($link, LDAP_OPT_REFERRALS, 0);

$r = @ldap_bind($link, $usuario . '@' . $dominio, $senha);

$filtro = "(samaccountname=" . $usuario . ")";
$justthese = array("*");
$res = ldap_search($link, "dc=pampa,dc=compasso", $filtro, $justthese);
$saida = ldap_get_entries($link, $res);
$nomeGrupo = null;

if ($saida['count'] > 0) {
    $groupPerfil = isValidPerfilAllAccess($saida);
    if($groupPerfil != false){
        $_SESSION["InfoUser"] = $saida;
        $_SESSION["grupo"] = $groupPerfil;
        
        header("location:../../telas/menuPrincipal.php");
    } else{
        $groupPerfil = isRH($saida);
        if ($groupPerfil) {
            $_SESSION["InfoUser"] = $saida;
            $_SESSION["grupo"] = $groupPerfil;
            
            header("location:../../telas/menuPrincipal.php");
        } else{
            $groupPerfil = isGestor($saida);
            if($groupPerfil){
                $_SESSION["InfoUser"] = $saida;
                $_SESSION["grupo"] = $groupPerfil;
                
                header("location:../../telas/menuPrincipal.php");
            }else{
                $groupPerfil = isSuporteInterno($saida);
                if($groupPerfil){
                    $_SESSION["InfoUser"] = $saida;
                    $_SESSION["grupo"] = $groupPerfil;
                    
                    header("location:../../telas/menuPrincipal.php"); 
                }else{
                    $groupPerfil = isApoioSede($saida);
                    if($groupPerfil){
                        $_SESSION["InfoUser"] = $saida;
                        $_SESSION["grupo"] = $groupPerfil;
                        
                        header("location:../../telas/menuPrincipal.php"); 
                    }
                    else {
                        ldap_close($link);
                        header("Location:./login.php?erro=fail");
                    }
                }
            }
        }
    }
 } else {
    ldap_close($link);
    header("login.php?erro=fail");
}

function isValidPerfilAllAccess($saida)
{
    for ($i = 0; $i < $saida[0]['memberof']['count']; $i++) {
        $grupoAd = $saida[0]['memberof'][$i];
        $textGroup = preg_split('/=|\,/', $grupoAd);
        
        $grupo = $textGroup[1];
                
        if ($grupo == "Diretoria" || $grupo == "Compasso - RH contratacoes") {
            return $grupo;
        }
    }
    return false;
} 

function isRH($saida){
    for ($i = 0; $i < $saida[0]['memberof']['count']; $i++) {
        $grupoAd = $saida[0]['memberof'][$i];
        $textGroup = preg_split('/=|\,/', $grupoAd);

        $grupo = $textGroup[1];
        
        if ($grupo == "Departamento de Recursos Humanos") {
            return $grupo;
        }      
    }
    return false;
}
function isGestor($saida){
    for ($i = 0; $i < $saida[0]['memberof']['count']; $i++) {
        $grupoAd = $saida[0]['memberof'][$i];
        $textGroup = preg_split('/=|\,/', $grupoAd);

        $grupo = $textGroup[1];
        
        if (strpos($grupo, "Gestores") !== false || $grupo == "Gestores") {
            return $grupo;
        }
    }
    return false;
}
function isSuporteInterno($saida){
    for ($i = 0; $i < $saida[0]['memberof']['count']; $i++) {
        $grupoAd = $saida[0]['memberof'][$i];
        $textGroup = preg_split('/=|\,/', $grupoAd);

        $grupo = $textGroup[1];
        
        if ($grupo == "Suporte Interno") {
            return $grupo;
        }
    }
    return false;
}
function isApoioSede($saida){
    for ($i = 0; $i < $saida[0]['memberof']['count']; $i++) {
        $grupoAd = $saida[0]['memberof'][$i];
        $textGroup = preg_split('/=|\,/', $grupoAd);

        if (preg_match('/Compasso - RH Integração/', $textGroup[1], $grupoAd)) {
            $grupo = $grupoAd[0];
        } else {
            $grupo = $textGroup[1];
        }
        if ($grupo == "Compasso - RH Integração") {
            return $grupo;
        }
    }
    return false;
}

$_SESSION['usuario'] = $usuario;
$_SESSION['senha'] = $senha;
?>