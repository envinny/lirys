<script type="text/javascript" src="script/jquery-3.3.1.min.js"></script>
<?php  
session_start();
require_once 'extends_class/extends.php';
#pour la connexion
if (isset($_POST['id_cnx']) AND isset($_POST['mdp_cnx'])) {
	$id_cnx = htmlspecialchars($_POST['id_cnx']);
	$mdp_cnx = htmlspecialchars($_POST['mdp_cnx']);
	if (!empty($id_cnx) AND !empty($mdp_cnx)) {
		$data_cnx = $r->select("SELECT * FROM users WHERE identifiant = '$id_cnx' AND mdp='$mdp_cnx'");
		$data_cnx_2 = $r->select("SELECT * FROM users WHERE cp != 'vide' AND identifiant = '$id_cnx' AND mdp='$mdp_cnx'");
		if ($data_cnx->rowCount()!=0) {
			if ($data_cnx_2->rowCount()!=0) {
				$cp_cnx = $data_cnx->fetch()->cp;
				// echo "Connecté :".$cp_cnx;
				$_SESSION['u'] = $cp_cnx;
	            echo "<script type='text/javascript'>document.location.replace('/lirys/u');</script>";
			} else {
				echo "Votre compte n'est pas activé";
			}
			
		} else {
			echo "Les identifiants entrés sont invalide";
		}
		
	} else {
		echo "Veuillez remplir tous les champs";
	}
	
}
?>