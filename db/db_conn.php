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

/*function OpenCon(){ 
    $dbhost = "localhost";
    $dbuser = "root";  
    $dbpass = "";   
    $db = "plataforma_admin";   
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n" . $conn->error);
    $conn->query("SET NAMES 'utf8'");
    return $conn;
}

function CloseCon($conn)
{
    $conn->close();
}*/
