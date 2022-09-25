<?php

//la class de connexion
class connexion_a_la_bdd{
	
	private $connexion;
	
	function cnx($host = 'localhost', $dbname, $user, $password){
        
        $this->_connexion = new PDO("mysql:dbname=$dbname;host=$host", $user, $password);
        $this->_connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->_connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		
		return $this->_connexion;
	}
	
	
}


?>