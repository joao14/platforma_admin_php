<?php
session_start();
include "../db/db_conn.php";
$conn = OpenCon();

if (isset($_SESSION['id_usuario']) && isset($_SESSION['nombres'])) {
    try {
        if ($_SESSION['id_perfil'] == "2") {
            $sql = "SELECT d.*,e.nombres FROM documentos d INNER JOIN estados e ON e.id_estado=d.id_estado ORDER BY created_at asc";
        } else {
            $sql = "SELECT d.*,e.nombres FROM documentos d INNER JOIN estados e ON e.id_estado=d.id_estado WHERE d.id_usuario=" . $_SESSION['id_usuario'] . " ORDER BY created_at asc";
        }
        $result = mysqli_query($conn, $sql);
        $filesbyuser = ""; 
        while ($data = mysqli_fetch_assoc($result)) {
            if ($_SESSION['id_perfil'] == 1) {
                $filesbyuser .= '<tr><td>' . $data['id_documento'] . '</td><td>' . $data['nombre'] . '</td><td><button type="button" class="btn btn-warning" disabled>' . $data['nombres'] . '</button></td><td>' . $data['created_at'] . '</td><td>' . $data['descripcion'] . '</td><td>' . $data['observacion'] . '</td><td><a target=\'_blank\' href="model/view.php?id=' . $data['id_documento'] . '">' . $data['nombre'] . '</a></td></tr>';
            } else {
                $filesbyuser .= '<tr><td><a href="upload.php?documento=' . $data['id_documento'] . '" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Editar</a></td><td>' . $data['id_documento'] . '</td><td>' . $data['nombre'] . '</td><td><button type="button" class="btn btn-warning" disabled>' . $data['nombres'] . '</button></td><td>' . $data['created_at'] . '</td><td>' . $data['descripcion'] . '</td><td>' . $data['observacion'] . '</td><td><a target=\'_blank\' href="model/view.php?id=' . $data['id_documento'] . '">' . $data['nombre'] . '</a></td></tr>';
            }
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
