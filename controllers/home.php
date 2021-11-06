<?php
    require_once("../models/home.php");
    session_start();
    
    $services = new Home();
    
    $result = $services->getDocumentosByUser($_SESSION['id_usuario'], $_SESSION['perfil']);     
      
    $filesbyuser = "";  
    foreach($result as $data){
        if ($_SESSION['perfil'] != "ADMIN") {
                $filesbyuser .= '<tr><td>' . $data['id_documento'] . '</td><td>' . $data['nombre'] . '</td><td><button type="button" class="btn btn-warning" disabled>' . $data['nombres'] . '</button></td><td>' . $data['created_at'] . '</td><td>' . $data['descripcion'] . '</td><td>' . $data['observacion'] . '</td><td><a target=\'_blank\' href="model/view.php?id=' . $data['id_documento'] . '">' . $data['nombre'] . '</a></td></tr>';
        } else {
                $filesbyuser .= '<tr><td><a href="upload.php?documento=' . $data['id_documento'] . '" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Editar</a></td><td>' . $data['id_documento'] . '</td><td>' . $data['nombre'] . '</td><td><button type="button" class="btn btn-warning" disabled>' . $data['nombres'] . '</button></td><td>' . $data['created_at'] . '</td><td>' . $data['descripcion'] . '</td><td>' . $data['observacion'] . '</td><td><a target=\'_blank\' href="model/view.php?id=' . $data['id_documento'] . '">' . $data['nombre'] . '</a></td></tr>';
        }
    }
    echo $filesbyuser;            
    header('Content-Type: application/json'); 
    exit;     
?>  