<?php
require_once ("../db/db_conn.php");
  
class Documento {     

    private $documento;
    private $documentos;    
    private $db;  
 
    public function __construct() { 
        $this->documentos = array();
        $this->documento = null;
        $this->db = Conectar::conexion();  
    }  
    
    public function getDocumentbyId($id_documento){  
        $sql = "SELECT * FROM documentos WHERE id_documento=" . $id_documento . "";
        $documento=$this->db->query($sql);        
        return $documento;
        $this->db = null;  
    }

    public function updateDocument($id_estado,$observacion, $id_documento){ 
        $sql = "UPDATE documentos SET id_estado=?, observacion=? ,updated_at=NOW() WHERE id_documento=?";
        $stmt = $this->db->prepare($sql); 
        $stmt->bind_param("sss", $id_estado, $observacion, $id_documento);
        $stmt->execute();
        return $stmt;
        $this->db = null;
    }


    public function createDocument($name_file,$file,$id_usuario,$descripcion,$type_file,$area,$estado){
        $sql="INSERT INTO documentos (nombre,documento,id_usuario, descripcion, mime , id_area, id_estado, created_at, updated_at) VALUES (?,?,?,?,?,?,?,NOW(), NOW())";
        $stmt=$this->db->prepare($sql);
        $stmt->bind_param("sssssss", $name_file, $file, $id_usuario, $descripcion, $type_file, $area, $estado);
        $stmt->execute();
        return $stmt;
        $this->db = null;
    }


    public function getDocumentosByUser($id_usuario , $perfil){        
        if ($perfil == "ADMIN") {
            $sql = "SELECT d.*,e.nombres,e.estado FROM documentos d INNER JOIN estados e ON e.id_estado=d.id_estado ORDER BY created_at asc";
        }else{
            $sql = "SELECT d.*,e.nombres,e.estado FROM documentos d INNER JOIN estados e ON e.id_estado=d.id_estado WHERE d.id_usuario=" . $id_usuario . " ORDER BY created_at asc";
        } 
        foreach ($this->db->query($sql) as $res) {
            $this->documentos[] = $res;
        }
        return $this->documentos;
        $this->db = null;  
    }


    





}