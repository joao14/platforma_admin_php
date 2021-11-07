<?php

class Conectar{

    public static function conexion(){
        $dbhost = "localhost";
        $dbuser = "root";  
        $dbpass = "";    
        $db = "plataforma_admin"; 
        $conn=new mysqli($dbhost, $dbuser, $dbpass, $db);
        $conn->query("SET NAMES 'utf8'");
        return $conn;
    }


}