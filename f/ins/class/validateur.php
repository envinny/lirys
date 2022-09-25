<?php

//on cr�e la class charger de controler les formulaires

class validateur{
	
    // variable de connexion
    private $_BD;
	
	// valeur de retour
    private $erreurs;

	// private $email
    
    // le constructeur
    public function __construct($BD){
		
		$this->setDb($BD);
	}

	#
	#
	#la function qui v�rifie si tous les champs ne sont pas vide
	#
	function vide($champs){
		
		
		//v�rifie si on a affaire � un tableau
		
		if(is_array($champs)){
				
			foreach($champs as $c){
				
				if(!empty($c)){
					
					return true;
					
				}else{
					return $this->_erreurs = "Veuillez remplir tous les champs";
					break;
				}
				
			}
			
		}else{
			
			if(!empty($champs)){
			
				return true;
				
			}else{
				echo "<script>alert('Veuillez remplir le champ');</script>";
				return false;
			}
			
		}
	}
	
	#
	#
	#function pour v�rifier les expression r�gulier
	#
	function regulax($champs, $long){
		
		//v�rifie si on a affaire � un tableau
		
		if(is_array($champs)){
			
		
			foreach($champs as $c){
				
				if(preg_match("#^[a-zA-Z������������ ]$long$#",$c)){
					return true;
					
				}else{
					echo "<script>alert('Les champs ne doivent pas contenir des caracrt�res sp�ciaux');</script>";
					return false;
					break;
				}
				
			}
			
		}else{
			
			if(preg_match("#^[a-zA-Z������������ ]$long$#",$champs)){
				
				return true;	
					
			}else{
					
				echo "<script>alert('Le champ ne doit pas contenir des caracrt�res sp�ciaux');</script>";
				return false;
			}
		}
		
	}
	
	#
	#
	#function pour les email
	#
	function email($champs, $table){
		
		//on v�rifie si l'email est valide
		if(filter_var($champs,FILTER_VALIDATE_EMAIL)){
			
			//on v�rifie si l'amail existe dans la bdd
			$r = $this->_BD->prepare("select * from $table where email = '$champs'");
			$r->execute();
			
			//si le resultat est diff�rent de z�ro on continu, au cas contraire on s'arret
			if($r->rowCount() === 0){
				return true;
				
			}else{
				
				return $this->_erreurs = "L'email entrer est d�j� utiliser par un autre utilisateur";
			}
			
		}else{
			
			return $this->_erreurs ="L'email entrer n'est pas valide";
		}
	}
	
	#
	#
	#function pour les mot de passe
	#
	function mdp($mdp_1, $mdp_2, $long){
		
			if(strlen($mdp_1) == $long){
				
				if($mdp_1 == $mdp_2){
					
					return true;
					
				}else{
					
					return $this->_erreurs = "Les mots de passe ne sont pas identique";
					
				}
				
			}else{
						
				return $this->_erreurs = "Votre mot de passe ne doit contenir ".$long." caracrt�res";
			}
		
	}
	
	public function long($champs, $long, $nomChamps){
		
		if(mb_strlen($champs) > $long){
			
			echo "<script>alert('le champ $nomChamps ne doit pas contenir plus de $long caract�res');</script>";
			return false;
			
		}else{
			
			return true;
			
		}
		
	}
	
	public function date($champs, $nomChamps){
		
		if(DateTime::createFromFormat('Y-m-d', $champs) === false){
			
			echo "<script>alert('$nomChamps est pas invalide');</script>";
			return false;
		}else{
			return true;
		}
		
		
	}
	
	public function setDb($BD){
		
		$this->_BD = $BD;
		
	}
	
}



?>