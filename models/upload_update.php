<?php
session_start();
include "../db/db_conn.php";
$conn = OpenCon();
if (isset($_SESSION['id_usuario']) && isset($_SESSION['nombres'])) {
    try {
        $stmt = $conn->prepare("UPDATE documentos SET id_estado=?, observacion=? ,updated_at=NOW() WHERE id_documento=?");
        $stmt->bind_param("sss", $_POST['estado'], $_POST['observacion'], $_POST['documento']);
        $stmt->execute();
        if ($stmt) {
            $arr = array('code' => '200', 'message' => 'Se actualizo correctamente la información');
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
