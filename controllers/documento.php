<?php
session_start();
require_once ("../models/documento.php");

$services = new Documento(); 

switch ($_POST["action"]) {
    case 'R'://Read documentos by id
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
        break;
    case 'S'://Save new document

        if (isset($_FILES['file']['name'])) {
            $filename = $_FILES['file']['name'];
            $file = file_get_contents($_FILES['file']['tmp_name']);           
            $estado = '1';
            $result = $services->createDocument($_FILES['file']['name'], $file, $_SESSION['id_usuario'], $_POST['descripcion'], $_FILES['file']['type'], $_POST['area'], $estado); 
                
            if ($result) {
                $arr = array('code' => '200', 'message' => 'Se envió la información correctamente');
            } else {
                $arr = array('code' => '400', 'message' => 'Consulte con el administrador, sucedio algún error.');
            }

            header('Content-Type: application/json');
            echo json_encode($arr);

            exit;
           
        }
       
        break;

    case 'E'://Edit document
            
        if (isset($_SESSION['id_usuario']) && isset($_SESSION['nombres'])) {

            $result = $services->updateDocument($_POST['estado'], $_POST['observacion'], $_POST['documento']);
          
            if ($result) {
                $arr = array('code' => '200', 'message' => 'Se actualizo correctamente la información');
            } else {
                $arr = array('code' => '400', 'message' => 'Consulte con el administrador, sucedio algún error.');
            }
            
            header('Content-Type: application/json');
            echo json_encode($arr);
            exit;            
        }

        break;
    case 'RDS': //Read document by id_user

        $result = $services->getDocumentosByUser($_SESSION['id_usuario'], $_SESSION['perfil']);
        $filesbyuser = "";  
        foreach($result as $data){
            if ($_SESSION['perfil'] != "ADMIN") {
                    $filesbyuser .= '<tr><td>' . $data['id_documento'] . '</td><td>' . $data['nombre'] . '</td><td><button type="button" class="btn btn-warning" disabled>' . $data['nombres'] . '</button></td><td>' . $data['created_at'] . '</td><td>' . $data['descripcion'] . '</td><td>' . $data['observacion'] . '</td><td><a target=\'_blank\' href="../controllers/reporte.php?id=' . $data['id_documento'] . '">' . $data['nombre'] . '</a></td></tr>';
            } else {
                    $filesbyuser .= '<tr><td><a href="upload.php?documento=' . $data['id_documento'] . '" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Editar</a></td><td>' . $data['id_documento'] . '</td><td>' . $data['nombre'] . '</td><td><button type="button" class="btn btn-warning" disabled>' . $data['nombres'] . '</button></td><td>' . $data['created_at'] . '</td><td>' . $data['descripcion'] . '</td><td>' . $data['observacion'] . '</td><td><a target=\'_blank\' href="../controllers/reporte.php?id=' . $data['id_documento'] . '">' . $data['nombre'] . '</a></td></tr>';
            }
        }
        echo $filesbyuser;            
        header('Content-Type: application/json'); 
        exit;     

        break;
    default:
        # code...
        break;
}


