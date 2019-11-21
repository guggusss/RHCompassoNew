<?php
session_start();

if (!isset($_SESSION['InfoUser'])) {
  ?>    
    <meta http-equiv="refresh" content="0;  url=../login/user/login.php"/>
<?php 
}

$InfoUser = $_SESSION['InfoUser'];
$grupo = $_SESSION['grupo'];
?>