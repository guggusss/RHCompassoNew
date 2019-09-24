<?php
session_start();
unset($_SESSION['InfoUser']);
ldap_close($link);
session_destroy();
// Modificado:
header("Location: login.php");
?>
