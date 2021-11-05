<?php
session_start();
include "../db/db_conn.php";
$conn = OpenCon();

if (isset($_SESSION['id_usuario']) && isset($_SESSION['nombres'])) {
    try {
        $sql = "SELECT * FROM estados";
        $result = mysqli_query($conn, $sql);
        $options = "";
        while ($data = mysqli_fetch_assoc($result)) {
            $options .= '<option value="' . $data['id_estado'] . '">' . $data['nombres'] . '</option>';
        }
        echo $options;
        $conn->close(); 
        header('Content-Type: application/json');
        exit;
    } catch (Exception $e) {
        echo 'Errores';
        echo $e;
    }
}
