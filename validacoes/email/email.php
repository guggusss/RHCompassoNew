<?php
session_start();

if (!isset($_SESSION['InfoUser'])) {
  header("location:../../login/user/login.php");
}

$InfoUser = $_SESSION['InfoUser'];

?>