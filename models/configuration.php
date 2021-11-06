<?php
require_once ("../db/db_conn.php");
  
class Configuration { 
   
    private $estados; 
    private $areas; 
    private $db;  
 
    public function __construct() { 
        $this->areas = array();
        $this->estados = array();
        $this->db = Conectar::conexion();  
    }  
    
    public function getAllAreas(){        
        
        $sql = "SELECT * FROM areas";
       
        foreach ($this->db->query($sql) as $res) {
            $this->areas[] = $res;
        }
        return $this->areas;
        $this->db = null;  
    }

    public function getAllEstados(){        
        
        $sql = "SELECT * FROM estados";
       
        foreach ($this->db->query($sql) as $res) {
            $this->estados[] = $res;
        }
        return $this->estados;
        $this->db = null;  
    }





}