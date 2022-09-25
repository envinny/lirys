<?php  
#pour la connexion
#les code pay
$alea_0=$alea->alea();
$alea_1=substr($alea_0, 0, 8);
include "class/commission.php";
require_once "../../../class/momo/all_class_momo.php";
$erreur_paye = "Une erreur est survenu lors du paiement, cliquez <label class='ui button' id='btn_reload'>ici</label> pour réessayer.";
######################################################
// echo $uuid;
#le bouton de connexion
if (isset($_POST['btn_cnx'])) {
	$mdp_cnx = $_POST['mdp_cnx'];
	$id_cnx = $_POST['id_cnx'];
	if (!empty($mdp_cnx) AND !empty($id_cnx)) {
		$cnx=$r->select("SELECT * FROM admin WHERE identifiant='$id_cnx' AND mdp='$mdp_cnx'");
		$cnx_data=$cnx->fetch();
		$nivo_cnx = $cnx_data->nivo;
		if ($cnx->rowCount()!=0) {
			// $data_cnx = array($id_cnx, $nivo_cnx);
			$_SESSION['nivo']=$nivo_cnx;
			$_SESSION['admin']=$id_cnx;
			echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
		} else { echo "<script type='text/javascript'>alert('Les informations sont incorrectes');</script>"; }
	} else { echo "<script type='text/javascript'>alert('Veuillez remplir les champs');</script>"; }
	
}
#si la session de ladministrateur existe
if (isset($_SESSION['admin'])) {
	
	$id_admin = $_SESSION['admin'];
	$admin_data=$r->select("SELECT * FROM admin WHERE identifiant = '$id_admin'")->fetch();
	$nbre_fieu=$r->select("SELECT * FROM users");
	$nbre_dadmin=$r->select("SELECT * FROM admin");
	#dernier inscription
	$dern_ins=$r->select("SELECT * FROM users WHERE cp!='vide' AND identifiant!='vide' ORDER BY id DESC LIMIT 0,20");
	#les codes libébé non utilisé
	$code_utl=$r->select("SELECT * FROM users WHERE cp!='vide' AND identifiant='vide' ORDER BY id DESC LIMIT 0,20");
}
#pour ajouter un fieu
if (isset($_POST['btn_ajt_fieu'])) {
	$cat_ins = htmlspecialchars($_POST['cat_ins']);
	$nom_ins = htmlspecialchars($_POST['nom_ins']);
	$prenom_ins = htmlspecialchars($_POST['prenom_ins']);
	$phone_ins = htmlspecialchars($_POST['phone_ins']);
	$email_ins = htmlspecialchars($_POST['email_ins']);
	$pseudo_ins = htmlspecialchars($_POST['pseudo_ins']);
	$ville_ins = htmlspecialchars($_POST['ville_ins']);
	$adresse_ins = htmlspecialchars($_POST['adresse_ins']);
	$mdp_1_ins = htmlspecialchars($_POST['mdp_1_ins']);
	$mdp_2_ins = htmlspecialchars($_POST['mdp_2_ins']);
	if (!empty($nom_ins) AND !empty($prenom_ins) AND !empty($phone_ins) AND !empty($email_ins) AND !empty($pseudo_ins) AND !empty($ville_ins) AND !empty($adresse_ins) AND !empty($mdp_1_ins) AND !empty($mdp_2_ins)) {
		if (strlen($phone_ins)==9 AND is_numeric($phone_ins)) {
			if (filter_var($email_ins,FILTER_VALIDATE_EMAIL)) {
				if ($r->s_a_s_a_w("users","email",$email_ins)->rowCount()==0) {
					$verif_mdp = $v->mdp($mdp_2_ins,$mdp_1_ins,"8");
					if ($verif_mdp === true){
						#on gère lindentifiant
						$id_users_minuscule = $remplace->rpl($nom_ins);
						$id_users_coupe = $remplace->couper($id_users_minuscule, 2, "-");
						$num_id_users_long = $alea_0;
						$num_id_users = substr($num_id_users_long, 0, 4);
						$id_users = $id_users_coupe.$num_id_users;
						$parrain_null = 'null';
						#pour les commissions
						$com = new commission($cat_ins);
						$pp = $com->pp($cat_ins);
						$l = $com->l($cat_ins);
						$os = $com->os($cat_ins);
						#le somme a payer
						$smm_apy = $com->somme($cat_ins);
						#le numero
						$num_apy = "242".$phone_ins;
						#on prent la somme total des commissions
						$smm_comm_pp = $r->select("SELECT * FROM smm WHERE typ = 'pp'")->fetch()->val;
						$smm_comm_l = $r->select("SELECT * FROM smm WHERE typ = 'l'")->fetch()->val;
						$smm_comm_os = $r->select("SELECT * FROM smm WHERE typ = 'os'")->fetch()->val;
						$nw_pp = $pp + $smm_comm_pp;
						$nw_l = $l + $smm_comm_l;
						$nw_os = $os + $smm_comm_os;
						#pour les notifiaction
						$txtNot = "Vous avez reçu des commissions de la part de ".$nom_ins." ".$prenom_ins." Pour Projet ".$pp." XAF, pour LirYs ".$l." XAF pour les Oeuvre Sociales ".$os." XAF";
						######################################################################
						#on effectue le paiement momo
						#lapius 
						// echo "<br>".$uuid_ins;
						$uuid = $mmUi->genere();
						$apius = $mmUs->user($uuid);
						if ($apius == "1") {
							#lapikey
							$apikey = $mmKY->key($uuid);
							if ($apikey != "2") {
								#le token
								$token = $mmTk->token($uuid, $apikey);
								if ($token != "2") {
									#le paiement
									#les messages
									$msg_obj = "Inscription LiRys";
									$msg_ctn = "Votre inscription sur LirYs a été effectué avec succès";
									#le paiement
									$paye = $clct->paye($token, $uuid, $smm_apy, $num_apy, $msg_obj, $msg_ctn);
								} else { $paye = false; }
							} else { $paye = false; }
						} else { $paye = false; }
						#si le paiement est bon on peut enfin inscrire
						if ($paye == "1") {
							$r->insert("INSERT INTO users(typ, cp, identifiant, mdp, nom, prenom, phone, email, nom_compte, ville, adresse, dat) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
							array(
								$cat_ins,
								$alea_1,
								$id_users,
								$mdp_1_ins,
								$nom_ins,
								$prenom_ins,
								$phone_ins,
								$email_ins,
								$pseudo_ins,
								$ville_ins,
								$adresse_ins,
								$d
							));
							#on insert les notification
							$r->insert("INSERT INTO notif(id_dest, typ, txt, dt) VALUES(?, ?, ?, ?)", array("a", 1, $txtNot, $d));
							#on insert les commissions
							$r->insert("INSERT INTO commission(pprojet, lrs, os, id_us, dt) VALUES(?, ?, ?, ?, ?)", array($pp, $l, $os, $id_users, $d));
							#on insert la somme générale des commissions
							$r->update("UPDATE smm SET val = :val WHERE typ = :typ", array('val' => $nw_pp, 'typ' => "pp" ));
							$r->update("UPDATE smm SET val = :val WHERE typ = :typ", array('val' => $nw_l, 'typ' => "l" ));
							$r->update("UPDATE smm SET val = :val WHERE typ = :typ", array('val' => $nw_os, 'typ' => "os" ));
							
							?>
							<script type="text/javascript">
								document.location.replace('index.php?f_add=<?php echo $id_users; ?>');
							</script>
							<?php
						} else {
							echo $erreur_paye;
						}
					}else{ echo $verif_mdp; }
				} else { echo "Cette adresse email est déjà utilisé"; }
			} else { echo "L'email saisie est invalide"; }
		} else { echo "Le numéro de téléphone saisie est invalide"; }
	} else { echo "Veuillez remplir tous les champs"; }
}
if (isset($_GET['f_add'])) {
	$f_add=htmlspecialchars($_GET['f_add']);
	$f_date=$r->select("SELECT * FROM users WHERE identifiant='$f_add'")->fetch(); 
}
#pour libérer un code
if (isset($_POST['btn_lc'])) {
	$parrain_lc=$_POST['parrain_lc'];
	$cat_lc=$_POST['cat_lc'];
	if (!empty($parrain_lc)) {
		if ($r->select("SELECT * FROM users WHERE identifiant = '$parrain_lc'")->rowCount()!=0) {

			if ($r->select("SELECT * FROM users WHERE cp != 'vide' AND identifiant = '$parrain_lc'")->rowCount()!=0) {
				#on vérifie le nombre de fieu
				if ($r->select("SELECT * FROM users WHERE parrain = '$parrain_lc' AND identifiant !='vide'")->rowCount() >= 4 || $r->select("SELECT * FROM users WHERE parrain = '$parrain_lc' AND identifiant !='vide'")->rowCount() == 3) {
					?>
					<script type='text/javascript'>
					alert("Ce parrain a atteint le nombre maximal de fieu");
					</script>
					<?php
				} else {
					$r->insert("INSERT INTO users(parrain, typ, cp) VALUES(?, ?, ?)", array($parrain_lc, $cat_lc, $alea_1));
					?>
					<script type='text/javascript'>
					document.location.replace('index.php');
					</script>
					<?php
				}
			} else {
				?>
				<script type='text/javascript'>
				alert("Le compte de ce parrain n'est pas activé");
				</script>
				<?php
				

			}
			
		} else {
			?>
			<script type='text/javascript'>
			alert("Ce parrain n'existe pas");
			</script>
			<?php
		}
	} else {
		?>
		<script type='text/javascript'>
		alert('Veuillez remplir le champs');
		</script>
		<?php
	}
	
}
?>