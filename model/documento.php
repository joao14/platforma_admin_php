<?php
session_start();
include "../db/db_conn.php";
$conn = OpenCon();
if (isset($_SESSION['id_usuario']) && isset($_SESSION['nombres'])) {
    try {
        $sql = "SELECT * FROM documentos WHERE id_documento=" . $_POST['documento'] . "";
        $result = mysqli_query($conn, $sql);
        $arr = null;
        while ($data = mysqli_fetch_assoc($result)) {
            $arr = array('descripcion' => $data['descripcion'], 'id_area' => $data['id_area'], 'id_estado' => $data['id_estado']);
        }
        $conn->close();
        header('Content-Type: application/json');
        echo json_encode($arr);
        exit;
    } catch (Exception $e) {
        echo 'Errores';
        echo $e;
    }
}
