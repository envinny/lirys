<?php  
/**
* la classe pour envoyer les mail
*/
class mail
{
	public function sent_mail($expediteur, $recepteur, $objet, $contenu)
	{
		ini_set('display_errors', 1);
		error_reporting( E_ALL );
		#l'adresse de l'expéditeur du mail
		$de=$expediteur;
		#l'adresse du destinataire
		$vers=$recepteur;
		#sujet du mail
		$sujet=$objet;
		#contenu du mail
		$message=$contenu;
		#l'en tête
		$headers="FROM:" . $de;
		#on envoie l'email
		$mail=mail($vers,$sujet,$message,$headers);
		if ($mail) {
			return true;
		} else {
			return false;
		}
		

	}
	
}

?>