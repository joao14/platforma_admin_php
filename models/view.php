<?php
session_start();
include "../db/db_conn.php";
$conn = OpenCon();
if (isset($_GET['id'])) {
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $sql = "SELECT * FROM documentos WHERE id_documento=$id";
    $result = mysqli_query($conn, $sql);

    while ($data = mysqli_fetch_array($result)) {
        $file = $data['documento'];
        $type = $data['mime'];
    }
    header('Content-Type:' . $type);
    echo $file;
}
