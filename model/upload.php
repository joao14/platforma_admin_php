<?php
session_start();
include "../db/db_conn.php";
$conn = OpenCon();

if (isset($_FILES['file']['name'])) { 
    $filename = $_FILES['file']['name']; 
    $file = file_get_contents($_FILES['file']['tmp_name']); 
    try { 
        $data = '1'; 
        $valor = 1;
        $name = 'Algoritmos';
        $stmt = $conn->prepare("INSERT INTO documentos (nombre,estado,documento,id_usuario) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", $name, $data, $file, $valor);
        $stmt->execute();
        if ($stmt) {
            echo 'Consulta exitosa';
        } else {
            echo 'Consulta con errores';
        }
        $stmt->close();
        $arr = array('ok' => 'Ingreso exitoso');
        return ($arr);
    } catch (Exception $e) {
        echo 'Errores';
        echo $e;
    }
}
