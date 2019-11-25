<?php
require_once('../../db/serverLDAP.php');
session_start();
unset($_SESSION['InfoUser']);
ldap_close($link);
session_destroy();
// Modificado:
    
?>
<meta http-equiv="refresh" content="0;  url=login.php"/>
