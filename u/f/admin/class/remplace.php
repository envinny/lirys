<?php

class remplace{
	
	private $text_de_retour;
	
	private $nom_de_retour;
	
	private $text_couper;
	
	function rpl($champs){
		
		$this->_text_de_retour = strtolower(str_replace(array("é", "è", "ê", "ë", "à", "â", "ä", "ç", "î", "ï", " ", "ù", "û", " ü", "ô", "ö",), array("e", "e", "e", "e", "a", "a", "a", "c", "i", "i", "_", "u", "u",  "u", "o", "o"), $champs));
		
		return $this->_text_de_retour;
	}
	
	function name($champs, $nouveau_nom){
		
		//on réduit le nom de la photo jusqu'à garder que l'extension dans $extensionUpload
        $extensionUpload = strtolower(substr(strrchr($champs, '.'), 1));
		
		//nouveau nom
		$this->_nom_de_retour = $nouveau_nom.".".$extensionUpload;
		
		return $this->_nom_de_retour;
		
	}
	
	function couper($champs, $long, $complement){
		
        $this->_text_couper = substr($champs,0,$long).$complement;
		
		return $this->_text_couper;
	}
	
}

?>