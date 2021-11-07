<?php
session_start();
require_once ("../models/documento.php");
$services = new Documento(); 

$id = isset($_GET['id']) ? $_GET['id'] : "";
$result = $services->getDocumentbyId($id); 

if (mysqli_num_rows($result) === 1) { 
    foreach($result as $data){ 
        $file = $data['documento'];
        $type = $data['mime'];
    }
}  
header('Content-Type:' . $type);
echo $file;

