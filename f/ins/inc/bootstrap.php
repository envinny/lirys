<?php

spl_autoload_register('chargeur_Automatique');


function chargeur_Automatique($class){
	require_once "class/$class.php";
}



?>