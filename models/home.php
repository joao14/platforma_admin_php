<?php
 
require_once ("../db/db_conn.php");
  
class Home {  
      
    private $documentos; 
    private $db;  
 
    public function __construct() { 
        $this->documentos = array();
        $this->db = Conectar::conexion();  
    }    

    public function getDocumentosByUser($id_usuario , $perfil){        
        if ($perfil == "ADMIN") {
            $sql = "SELECT d.*,e.nombres FROM documentos d INNER JOIN estados e ON e.id_estado=d.id_estado ORDER BY created_at asc";
        }else{
            $sql = "SELECT d.*,e.nombres FROM documentos d INNER JOIN estados e ON e.id_estado=d.id_estado WHERE d.id_usuario=" . $id_usuario . " ORDER BY created_at asc";
        }

        foreach ($this->db->query($sql) as $res) {
            $this->documentos[] = $res;
        }

        return $this->documentos;
        $this->db = null;  
    }

    
}
?>