<?php
require_once('../../db/serverLDAP.php');
session_start();
unset($_SESSION['InfoUser']);
ldap_close($link);
session_destroy();
header("Location: login.php"); exit;
// Modificado:
    
?>

