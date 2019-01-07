<?php 

session_start();
$_SESSION["mail"] = "";
session_destroy(); 
header("location:../login.php");
       
?>