<?php

//class charger de gérer la date
 class dat{
	 
	 private $d;
	 
	  function dt(){
		  
		//les variables pour la date
		$mois = array("", "Janvier", "Févrié", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
		$date=date("d").' '.$mois[date("n")].' '.date("Y");
		$h = date("H:i");
		$this->_d = "$date à $h ";
		return $this->_d;
		
	  }
 }

?>