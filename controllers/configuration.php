<?php
session_start();
require_once ("../models/configuration.php");

$services = new Configuration();    
$options = "";

if($_POST["type"]=="A"){

    $result = $services->getAllAreas();      
    foreach($result as $data){
        $options .= '<option value="' . $data['id_area'] . '">' . $data['nombre'] . '</option>';
    } 
}else
if($_POST["type"]=="E"){ 

    $result = $services->getAllEstados();      
    foreach($result as $data){
        $options .= '<option value="' . $data['id_estado'] . '">' . $data['nombres'] . '</option>';
    }
}
   
  
echo $options;        
header('Content-Type: application/json');
exit;
  
