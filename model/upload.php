<?php
session_start();
include "../db/db_conn.php";
$conn = OpenCon();
if (isset($_FILES['file']['name'])) {
    $filename = $_FILES['file']['name'];
    $file = file_get_contents($_FILES['file']['tmp_name']);
    try {
        $estado = '1';
        $stmt = $conn->prepare("INSERT INTO documentos (nombre,documento,id_usuario, descripcion, mime , id_area, id_estado, created_at, updated_at) VALUES (?,?,?,?,?,?,?,NOW(), NOW())");
        $stmt->bind_param("sssssss", $_FILES['file']['name'], $file, $_SESSION['id_usuario'], $_POST['descripcion'], $_FILES['file']['type'], $_POST['area'], $estado);
        $stmt->execute();
        if ($stmt) {
            $arr = array('code' => '200', 'message' => 'Se envió la información correctamente');
        } else {
            $arr = array('code' => '400', 'message' => 'Consulte con el administrador, sucedio algún error.');
        }
        $stmt->close();
        header('Content-Type: application/json');
        echo json_encode($arr);
        exit;
    } catch (Exception $e) {
        echo 'Errores';
        echo $e;
    }
}
