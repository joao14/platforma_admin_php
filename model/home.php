<?php
session_start();
include "../db/db_conn.php";
$conn = OpenCon();

if (isset($_SESSION['id_usuario']) && isset($_SESSION['nombres'])) {
    try {
        $sql = "SELECT * FROM documentos WHERE id_usuario=" . $_SESSION['id_usuario'];
        $result = mysqli_query($conn, $sql);
        $filesbyuser = "";
        while ($data = mysqli_fetch_assoc($result)) {
            if ($data['estado'] == '1') {
                $button_estado = '<button type="button" class="btn btn-info" disabled>Enviado</button>';
            } else {
                $button_estado = '<button type="button" class="btn btn-warning" disabled>Aceptado</button>';
            }
            $filesbyuser .= '<tr><td>' . $data['id_documento'] . '</td><td>' . $data['nombre'] . '</td><td>' . $button_estado . '</td><td>' . $data['created_at'] . '</td><td>' . $data['descripcion'] . '</td><td><a target=\'_blank\' href="model/view.php?id=' . $data['id_documento'] . '">' . $data['nombre'] . '</a></td></tr>';
        }
        echo $filesbyuser;
        $conn->close();
        header('Content-Type: application/json');
        exit;
    } catch (Exception $e) {
        echo 'Errores';
        echo $e;
    }
}
