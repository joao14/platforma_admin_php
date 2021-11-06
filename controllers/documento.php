<?php
session_start();
require_once ("../models/documento.php");

$services = new Documento(); 

$result = $services->getDocumentbyId($_POST['documento']); 
$arr = null;
if (mysqli_num_rows($result) === 1) { 
    foreach($result as $data){ 
        $arr = array('descripcion' => $data['descripcion'], 'observacion' => $data['observacion'], 'id_area' => $data['id_area'], 'id_estado' => $data['id_estado']);
    }
}  

header('Content-Type: application/json');
echo json_encode($arr);
exit;