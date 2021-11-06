<?php
require_once ("../db/db_conn.php");
  
class Documento {    

    private $documento;   
    private $db;  
 
    public function __construct() { 
        $this->documento = null;
        $this->db = Conectar::conexion();  
    }  
    
    public function getDocumentbyId($id_documento){  
        $sql = "SELECT * FROM documentos WHERE id_documento=" . $id_documento . "";
        $documento=$this->db->query($sql);        
        return $documento;
        $this->db = null;  
    }

    





}