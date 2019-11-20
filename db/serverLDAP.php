<?php
$ldapuri = "ldap://ad.pampa.compasso:389";

$link = ldap_connect($ldapuri)  or die("Server LDAP nao encontrado");
?>