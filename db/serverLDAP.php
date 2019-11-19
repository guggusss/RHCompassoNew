<?php
$ldapuri = "ldap://ad.pampa.compasso";

$link = ldap_connect($ldapuri)  or die("Server LDAP nao encontrado");
?>