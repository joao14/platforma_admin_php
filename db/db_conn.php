<?php

function OpenCon(){
 
$dbhost = "localhost";
$dbuser = "root";  
$dbpass = "M4rk3t1ng";   
$db = "plataforma_admin";   

$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
  
return $conn;

}

function CloseCon($conn)
 {
 $conn -> close();
 }