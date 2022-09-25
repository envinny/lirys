<?php

class validateur_2{
	
	private $donne;
	protected $erreurs = [];
	
	public function validates($donne){
		$this->_erreurs = [];
		$this->_donne = $donne;
		
	}
	
	public function validate($champs, $method, $parametre){
		
		if(!isset($this->_donne[$champs])){
			
			echo $this->_erreurs[$champs] = "Le champs $champs n'est pas rempli";
			
		}else{
			
			call_user_func([$this, $method], $champs, $parametre);
		}
		
		
	}
	
	public function minLength($champs, $longueur){
		
		if(mb_strlen($champs) < $length){
			
			$this->_erreurs[$champs] = "Le champs doit contenir plus de $length caractère";
			return $this->_erreurs;
			
		}
		
	}
	
	
}



?>