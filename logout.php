<?php
session_start();
unset($_SESSION['name']);
unset($_SESSION['staffname']);
session_destroy();  
header('location:login.php');
?>