<?php
session_start();
require_once ("../models/documento.php");

$services = new Documento(); 

switch ($_POST["action"]) {
    case 'R'://Leer documento por id
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
    case 'S'://salvar nuevo documento 
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

    case 'E'://Editar documento
            
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
    case 'RDS': //leer documento por id_user

        $result = $services->getDocumentosByUser($_SESSION['id_usuario'], $_SESSION['perfil']);
        $filesbyuser = "";  
        foreach($result as $data){
            if ($_SESSION['perfil'] != "ADMIN") {
                    $filesbyuser .= '<tr><td>' . $data['id_documento'] . '</td><td>' . $data['nombre'] . '</td><td><button type="button" class="btn btn-warning" disabled>' . $data['nombres'] . '</button></td><td>' . $data['created_at'] . '</td><td>' . $data['descripcion'] . '</td><td>' . $data['observacion'] . '</td><td><a target=\'_blank\' href="../controllers/reporte.php?id=' . $data['id_documento'] . '">' . $data['nombre'] . '</a></td></tr>';
            } else {
                if($data['estado']=="ACCEPTED" || $data['estado']=="CANCEL"){
                    $dias=-1;
                    $filesbyuser .= '<tr><td></td><td style="background-color:'.getColorLightofRisk($dias).';color:white;border-radius: 10px;text-align:center;display: table-cell;vertical-align: middle;">'.getCommentLightofRisk($dias).'</td><td>' . $data['id_documento'] . '</td><td>' . $data['nombre'] . '</td><td><button type="button" class="btn btn-warning" disabled>' . $data['nombres'] . '</button></td><td>' . $data['created_at'] . '</td><td>' . $data['descripcion'] . '</td><td>' . $data['observacion'] . '</td><td><a target=\'_blank\' href="../controllers/reporte.php?id=' . $data['id_documento'] . '">' . $data['nombre'] . '</a></td></tr>';
                }else{
                    $fecha_dada= date_format(date_create($data['created_at']), 'Y/m/d');
                    $fecha_actual= date("Y/m/d"); 
                    $dias=dias_pasados($fecha_dada,$fecha_actual);
                    $filesbyuser .= '<tr><td><a href="upload.php?documento=' . $data['id_documento'] . '" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Editar</a></td><td style="background-color:'.getColorLightofRisk($dias).';color:white;border-radius: 10px;text-align:center;display: table-cell;vertical-align: middle;">'.getCommentLightofRisk($dias).'</td><td>' . $data['id_documento'] . '</td><td>' . $data['nombre'] . '</td><td><button type="button" class="btn btn-warning" disabled>' . $data['nombres'] . '</button></td><td>' . $data['created_at'] . '</td><td>' . $data['descripcion'] . '</td><td>' . $data['observacion'] . '</td><td><a target=\'_blank\' href="../controllers/reporte.php?id=' . $data['id_documento'] . '">' . $data['nombre'] . '</a></td></tr>';
                }
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


function getCommentLightofRisk($day){
   if($day < 0){
    return "Resuelto";
   }
   if($day<=2 && $day >=0){
    return "Nuevo";
   }
   if($day>2&&$day<5){
    return "En peligro";
   }
   if($day>=5){
    return "Atender inmediata";
    }

}

function getColorLightofRisk($day){

    if($day < 0){
        return "#aab7b8";
    }
        
    if($day<=2 && $day >=0){
     return "#33ff49";
    }
    if($day>2&&$day<5){
     return "#FFFF33";
    }
    if($day>=5){
     return "#FF4933";
    }
 
 }

 function dias_pasados($fecha_inicial,$fecha_final)
{
    $dias = (strtotime($fecha_inicial)-strtotime($fecha_final))/86400;
    $dias = abs($dias); $dias = floor($dias);
    return $dias;
}


