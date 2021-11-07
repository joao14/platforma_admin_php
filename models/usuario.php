<?php

require_once ("../db/db_conn.php");

class Usuario{

	private $user;     
    private $db;	   
 
 
	public function __construct() {
        $this->user = null;  
        $this->db = Conectar::conexion();  
    }	
   
	public function getInformationOfUserByCredentials($uname, $pass ){		
		$sql = "SELECT u.* , p.perfil FROM usuarios u INNER JOIN perfiles p ON p.id_perfil=u.id_perfil WHERE u.user='$uname' AND u.password='$pass' ";
		$user = $this->db->query($sql);  
		return $user;    
        $this->db = null;    
	}  

}

?>
