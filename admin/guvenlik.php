<?php
include 'dbconnect.php';

session_start();

 if(isset($_SESSION["mail"]))  
 {  
    
 }  
 else  
 {  
      header("location:login.php");
      session_destroy();  
 } 

 function tumbosluksil($veri)
{
$veri = str_replace("/s+/","",$veri);
$veri = str_replace(" ","",$veri);
$veri = str_replace(" ","",$veri);
$veri = str_replace(" ","",$veri);
$veri = str_replace("/s/g","",$veri);
$veri = str_replace("/s+/g","",$veri);		
$veri = trim($veri);
return $veri; 
};


?>