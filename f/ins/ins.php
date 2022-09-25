<script type="text/javascript" src="script/jquery-3.3.1.min.js"></script>
<?php  
session_start();
require_once 'extends_class/extends.php';
require_once "class/commission.php";
$erreur_paye = "Une erreur est survenu lors du paiement, veuillez réessayer";
###########################################
#la class qui charge de momo
require_once "../../class/momo/all_class_momo.php";
#le premier nivo de linscription quand il ya le parrain et le code
if (isset($_POST['parrain_ins']) AND isset($_POST['cp_ins'])) {
	$parrain = htmlspecialchars(htmlentities($_POST['parrain_ins']));
	$cp = htmlspecialchars(htmlentities($_POST['cp_ins']));
	if (!empty($parrain) AND !empty($cp)) {
		#on vérifie si le parrain a un compte
		$parrain_compte = $r->select("SELECT * FROM users WHERE identifiant = '$parrain'");
		if ($parrain_compte->rowCount()!=0) {
			#on vérifie si le compte est validé
			$parrain_compte_fetch = $parrain_compte->fetch();
			$pcp = $parrain_compte_fetch->cp;
			if ($pcp!="vide") {
				#on vérifie si lutilisateur na pas dépassé ne nombre denfant
				if ($r->select("SELECT * FROM users WHERE parrain = '$parrain' AND identifiant !='vide'")->rowCount() >= 4 || $r->select("SELECT * FROM users WHERE parrain = '$parrain' AND identifiant !='vide'")->rowCount() == 3) {
					echo "Ce parrain a atteint le nombre maximal de fieu";
				} else {
					if ($r->verifie("users", "parrain", "cp", $parrain, $cp)->rowCount()!=0) {
						// echo "verifie";
						#on recupàre le type de compte
						$typ = $r->verifie("users", "parrain", "cp", $parrain, $cp)->fetch()->typ;
						$_SESSION['ins']=array($parrain,$cp, $typ);
						?>
						<script type="text/javascript">
							$(".div_ins").slideUp();
							$(".div_ins_normal").slideDown();
						</script>
						<?php
						
					} else { echo "Les information saisies sont invalide"; }
				}
			} else { echo "Le compte de votre parrain n'est pas encore activé"; }
		} else { echo "Le code du parrain est relié à aucun code"; }
	} else { echo "Veuillez remplir tous les champs"; }
}
################################################################
#deuxième niveau de linscription quand il y le parrain et le code
if (isset($_POST['hidden_ins'])) {

	$nom_ins=htmlspecialchars($_POST['nom_ins']);
	$prenom_ins=htmlspecialchars($_POST['prenom_ins']);
	$phone_ins=htmlspecialchars($_POST['phone_ins']);
	$email_ins=htmlspecialchars($_POST['email_ins']);
	$pseudo_ins=htmlspecialchars($_POST['pseudo_ins']);
	$ville_ins=htmlspecialchars($_POST['ville_ins']);
	$adresse_ins=htmlspecialchars($_POST['adresse_ins']);
	$mdp_1_ins=htmlspecialchars($_POST['mdp_1_ins']);
	$mdp_2_ins=htmlspecialchars($_POST['mdp_2_ins']);
	// echo $nom_ins.$prenom_ins.$phone_ins.$email_ins.$pseudo_ins.$ville_ins.$adresse_ins.$mdp_1_ins.$mdp_2_ins;
	if (!empty($nom_ins) AND !empty($prenom_ins) AND !empty($phone_ins) AND !empty($email_ins) AND !empty($pseudo_ins) AND !empty($ville_ins) AND !empty($adresse_ins) AND !empty($mdp_1_ins) AND !empty($mdp_2_ins)) {
		if (strlen($phone_ins)==9 AND is_numeric($phone_ins)) {
			#verifie email
			if (filter_var($email_ins,FILTER_VALIDATE_EMAIL)) {
				if ($r->s_a_s_a_w("users","email",$email_ins)->rowCount()==0) {
					$verif_mdp = $v->mdp($mdp_2_ins,$mdp_1_ins,"8");
					if ($verif_mdp === true) {
						
						#################################################
						#on definie les UUID dont on peut avoir besoin à l'avenir
						$uuid1 = $mmUi->genere();
						$uuid2 = $mmUi->genere();
						$uuid3 = $mmUi->genere();
						$uuid4 = $mmUi->genere();

						#le numero
						$num_apy = "242".$phone_ins;

						#on prend le parrain du parrain
						$parrain_rec = $_SESSION['ins'][0];
						#on prend le numéro de téléphone du parrain pour éffectuer le paiement de la commission
						$p1_phone = $r->s_a_s_a_w("users", "identifiant", $parrain_rec)->fetch()->phone;
						$p1_phone = "242".$p1_phone;
						#code pay
						$cp = $_SESSION['ins'][1];
						#typ de compte
						$typ = $_SESSION['ins'][2];

						$verif_si_parin_a_parin=$r->select("SELECT * FROM users WHERE identifiant='$parrain_rec'");
						$verif_si_parin_a_parin_fetch=$verif_si_parin_a_parin->fetch();
						$parin_du_parin=$verif_si_parin_a_parin_fetch->parrain;
						#on vérifie si le parrain à un parrain
						#si le parrain du parrain d=est vide ou null alors son parrain se met au niveau 1
						#on gère lindentifiant
						$id_users_minuscule = $remplace->rpl($nom_ins);
						$id_users_coupe = $remplace->couper($id_users_minuscule, 2, "-");
						$num_id_users_long = $alea->alea();
						$num_id_users = substr($num_id_users_long, 0, 4);
						$id_users = $id_users_coupe.$num_id_users; 
						#met le mot den majuscule
						
						#pour les commissions
						$com = new commission($typ);
						$smm_apy = $com->somme($typ);
						$pp = $com->pp($typ);
						$l = $com->l($typ);
						$os = $com->os($typ);
						$p1 = $com->p1($typ);
						$p2 = $com->p2($typ);
						$p3 = $com->p3($typ);
						$p4 = $com->p4($typ);
						#on prent la somme total des commissions
						$smm_comm_pp = $r->select("SELECT * FROM smm WHERE typ = 'pp'")->fetch()->val;
						$smm_comm_l = $r->select("SELECT * FROM smm WHERE typ = 'l'")->fetch()->val;
						$smm_comm_os = $r->select("SELECT * FROM smm WHERE typ = 'os'")->fetch()->val;
						$nw_pp = $pp + $smm_comm_pp;
						$nw_l = $l + $smm_comm_l;
						$nw_os = $os + $smm_comm_os;
						#on récupère les commission du parrain
						$parrain_n1_smm_com = $verif_si_parin_a_parin_fetch->smm_cm;
						$nw_parrain_n1_smm_com = $parrain_n1_smm_com + $p1; 
						#pour les notifiaction
						#pour admin
						$txtNot = "Vous avez reçu des commissions de la part de ".$nom_ins." ".$prenom_ins." Pour Projet ".$pp." XAF, pour LirYs ".$l." XAF pour les Oeuvre Sociales ".$os." XAF";
						#pour le parrain_n1
						$txtNotN1 = "Vous avez reçu des commissions de la part de ".$nom_ins." ".$prenom_ins." du montant de ".$p1." XAF";
						$txtNotN2 = "Vous avez reçu des commissions de la part de ".$nom_ins." ".$prenom_ins." du montant de ".$p2." XAF";
						$txtNotN3 = "Vous avez reçu des commissions de la part de ".$nom_ins." ".$prenom_ins." du montant de ".$p3." XAF";
						$txtNotN4 = "Vous avez reçu des commissions de la part de ".$nom_ins." ".$prenom_ins." du montant de ".$p4." XAF";
						//si le parrain n'a pas de parrain
						 // strtoupper######################################################################
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
							if ($parin_du_parin == "vide" || $parin_du_parin == 'null' || $parin_du_parin == 'default') {
							
								$r->update("UPDATE users SET identifiant = :identifiant, mdp = :mdp, nom = :nom, prenom = :prenom, phone = :phone, email = :email, nom_compte = :nom_compte, ville = :ville, adresse = :adresse, n1 = :n1, dat = :dat WHERE parrain = :parrain AND cp = :cp",
								array(
									"identifiant" => $id_users,
									"mdp" => $mdp_1_ins,
									"nom" => $nom_ins,
									"prenom" => $prenom_ins,
									"phone" => $phone_ins,
									"email" => $email_ins,
									"nom_compte" => $pseudo_ins,
									"ville" => $ville_ins,
									"adresse" => $adresse_ins,
									"n1" => $parrain_rec,
									"dat" => $d,
									"parrain" => $parrain_rec,
									"cp" => $cp
	
								));
								$nom_prenom=$nom_ins." ".$prenom_ins;
								#on modifie la somme
								#n1
								$r->update("UPDATE users SET smm_cm = :smm_cm WHERE identifiant = :identifiant",
									array("smm_cm" => $nw_parrain_n1_smm_com, "identifiant" => $parrain_rec));
								#on insert les notification
								#admin
								$r->insert("INSERT INTO notif(id_dest, typ, txt, dt) VALUES(?, ?, ?, ?)", array("a", 1, $txtNot, $d));
								#n1
								$r->insert("INSERT INTO notif(id_dest, typ, txt, dt) VALUES(?, ?, ?, ?)", array($parrain_rec, 1, $txtNotN1, $d));
								#on insert les commissions
								$r->insert("INSERT INTO commission(pprojet, lrs, os, id_us, id_dest, dt) VALUES(?, ?, ?, ?, ?, ?)", array($pp, $l, $os, $id_users, $parrain_rec, $d));
								#on insert la somme générale des commissions
								$r->update("UPDATE smm SET val = :val WHERE typ = :typ", array('val' => $nw_pp, 'typ' => "pp" ));
								$r->update("UPDATE smm SET val = :val WHERE typ = :typ", array('val' => $nw_l, 'typ' => "l" ));
								$r->update("UPDATE smm SET val = :val WHERE typ = :typ", array('val' => $nw_os, 'typ' => "os" ));
								$_SESSION['ins_nrml'] = array($id_users,$nom_ins,$prenom_ins,$pseudo_ins,$mdp_1_ins,$cp);
								?>
								<script type="text/javascript">
									$(".div_ins_normal").slideUp();
									$(".div_ins_info").slideDown();
									document.location.replace('index.php');
								</script>
								<?php
							} else {
								#par nivo toujours
								if ($r->select("SELECT * FROM users WHERE identifiant='$parrain_rec' AND n1 = '$parin_du_parin' AND n2='vide' AND n3='vide' AND n4='vide'")->rowCount()!==0) {
	
									$r->update("UPDATE users SET identifiant = :identifiant, mdp = :mdp, nom = :nom, prenom = :prenom, phone = :phone, email = :email, nom_compte = :nom_compte, ville = :ville, adresse = :adresse, n1 = :n1, n2 = :n2, dat = :dat WHERE parrain = :parrain AND cp = :cp",
									array(
										"identifiant" => $id_users,
										"mdp" => $mdp_1_ins,
										"nom" => $nom_ins,
										"prenom" => $prenom_ins,
										"phone" => $phone_ins,
										"email" => $email_ins,
										"nom_compte" => $pseudo_ins,
										"ville" => $ville_ins,
										"adresse" => $adresse_ins,
										"n1" => $parrain_rec,
										"n2" => $parin_du_parin,
										"dat" => $d,
										"parrain" => $parrain_rec,
										"cp" => $cp
	
									));
									#la somme du parrain du parrain
									$smm_cm_n2=$r->select("SELECT * FROM users WHERE identifiant='$parin_du_parin'")->fetch()->smm_cm;
									$nw_n2_smm_com = $smm_cm_n2 + $p2;
									
									#n1
									$r->update("UPDATE users SET smm_cm = :smm_cm WHERE identifiant = :identifiant",
									array("smm_cm" => $nw_parrain_n1_smm_com, "identifiant" => $parrain_rec));
									#n2
									$r->update("UPDATE users SET smm_cm = :smm_cm WHERE identifiant = :identifiant",
									array("smm_cm" => $nw_n2_smm_com, "identifiant" => $parin_du_parin));
									#on insert les notification
									#admin
									$r->insert("INSERT INTO notif(id_dest, typ, txt, dt) VALUES(?, ?, ?, ?)", array("a", 1, $txtNot, $d));
									#n1
									$r->insert("INSERT INTO notif(id_dest, typ, txt, dt) VALUES(?, ?, ?, ?)", array($parrain_rec, 1, $txtNotN1, $d));
									#n2
									$r->insert("INSERT INTO notif(id_dest, typ, txt, dt) VALUES(?, ?, ?, ?)", array($parin_du_parin, 1, $txtNotN2, $d));
									#on insert les commissions
									$r->insert("INSERT INTO commission(pprojet, lrs, os, id_us, id_dest, dt) VALUES(?, ?, ?, ?, ?, ?)", array($pp, $l, $os, $id_users, $parrain_rec, $d));
									#on insert la somme générale des commissions
									$r->update("UPDATE smm SET val = :val WHERE typ = :typ", array('val' => $nw_pp, 'typ' => "pp" ));
									$r->update("UPDATE smm SET val = :val WHERE typ = :typ", array('val' => $nw_l, 'typ' => "l" ));
									$r->update("UPDATE smm SET val = :val WHERE typ = :typ", array('val' => $nw_os, 'typ' => "os" ));
	
									$nom_prenom=$nom_ins." ".$prenom_ins;
	
									$_SESSION['ins_nrml'] = array($id_users,$nom_ins,$prenom_ins,$pseudo_ins,$mdp_1_ins,$cp);
									?>
									<script type="text/javascript">
										$(".div_ins_normal").slideUp();
										$(".div_ins_info").slideDown();
										document.location.replace('index.php');
									</script>
									<?php
	
								} elseif ($r->select("SELECT * FROM users WHERE identifiant='$parrain_rec' AND n1 = '$parin_du_parin' AND n2!='vide' AND n3='vide' AND n4='vide'")->rowCount()!==0) {
									#on récupère les date
									$recup_nivo_2=$r->select("SELECT * FROM users WHERE identifiant='$parrain_rec' AND n1='$parin_du_parin' AND n2!='vide' AND n3='vide' AND n4='vide'")->fetch();
									$nivo_1=$recup_nivo_2->n1;
									$nivo_2=$recup_nivo_2->n2;
	
									$r->update("UPDATE users SET identifiant = :identifiant, mdp = :mdp, nom = :nom, prenom = :prenom, phone = :phone, email = :email, nom_compte = :nom_compte, ville = :ville, adresse = :adresse, n1 = :n1, n2 = :n2, n3 = :n3, dat = :dat WHERE parrain = :parrain AND cp = :cp",
									array(
										"identifiant" => $id_users,
										"mdp" => $mdp_1_ins,
										"nom" => $nom_ins,
										"prenom" => $prenom_ins,
										"phone" => $phone_ins,
										"email" => $email_ins,
										"nom_compte" => $pseudo_ins,
										"ville" => $ville_ins,
										"adresse" => $adresse_ins,
										"n1" => $parrain_rec,
										"n2" => $parin_du_parin,
										"n3" => $nivo_2,
										"dat" => $d,
										"parrain" => $parrain_rec,
										"cp" => $cp
	
									));
									
									#la somme du parrain du parrain
									$smm_cm_n2=$r->select("SELECT * FROM users WHERE identifiant='$parin_du_parin'")->fetch()->smm_cm;
									$nw_n2_smm_com = $smm_cm_n2 + $p2;
									#n3
									$smm_cm_n3=$r->select("SELECT * FROM users WHERE identifiant='$nivo_2'")->fetch()->smm_cm;
									$nw_n3_smm_com = $smm_cm_n3 + $p3;
									
									#n1
									$r->update("UPDATE users SET smm_cm = :smm_cm WHERE identifiant = :identifiant",
									array("smm_cm" => $nw_parrain_n1_smm_com, "identifiant" => $parrain_rec));
									#n2
									$r->update("UPDATE users SET smm_cm = :smm_cm WHERE identifiant = :identifiant",
									array("smm_cm" => $nw_n2_smm_com, "identifiant" => $parin_du_parin));
									#n3
									$r->update("UPDATE users SET smm_cm = :smm_cm WHERE identifiant = :identifiant",
									array("smm_cm" => $nw_n3_smm_com, "identifiant" => $nivo_2));
									#on insert les notification
									#admin
									$r->insert("INSERT INTO notif(id_dest, typ, txt, dt) VALUES(?, ?, ?, ?)", array("a", 1, $txtNot, $d));
									#n1
									$r->insert("INSERT INTO notif(id_dest, typ, txt, dt) VALUES(?, ?, ?, ?)", array($parrain_rec, 1, $txtNotN1, $d));
									#n2
									$r->insert("INSERT INTO notif(id_dest, typ, txt, dt) VALUES(?, ?, ?, ?)", array($parin_du_parin, 1, $txtNotN2, $d));
									#n3
									$r->insert("INSERT INTO notif(id_dest, typ, txt, dt) VALUES(?, ?, ?, ?)", array($nivo_2, 1, $txtNotN3, $d));
									#on insert les commissions
									$r->insert("INSERT INTO commission(pprojet, lrs, os, id_us, id_dest, dt) VALUES(?, ?, ?, ?, ?, ?)", array($pp, $l, $os, $id_users, $parrain_rec, $d));
									#on insert la somme générale des commissions
									$r->update("UPDATE smm SET val = :val WHERE typ = :typ", array('val' => $nw_pp, 'typ' => "pp" ));
									$r->update("UPDATE smm SET val = :val WHERE typ = :typ", array('val' => $nw_l, 'typ' => "l" ));
									$r->update("UPDATE smm SET val = :val WHERE typ = :typ", array('val' => $nw_os, 'typ' => "os" ));
	
									$_SESSION['ins_nrml'] = array($id_users,$nom_ins,$prenom_ins,$pseudo_ins,$mdp_1_ins,$cp);
									?>
									<script type="text/javascript">
										$(".div_ins_normal").slideUp();
										$(".div_ins_info").slideDown();
										document.location.replace('index.php');
									</script>
									<?php
								}elseif ($r->select("SELECT * FROM users WHERE identifiant='$parrain_rec' AND n1 = '$parin_du_parin' AND n2!='vide' AND n3!='vide' AND n4='vide'")->rowCount()!==0) {
									#on récupère les date
									$recup_nivo_2=$r->select("SELECT * FROM users WHERE identifiant='$parrain_rec' AND n1='$parin_du_parin' AND n2!='vide' AND n3!='vide' AND n4='vide'")->fetch();
									$nivo_1=$recup_nivo_2->n1;
									$nivo_2=$recup_nivo_2->n2;
									$nivo_3=$recup_nivo_2->n3;
	
									$r->update("UPDATE users SET identifiant = :identifiant, mdp = :mdp, nom = :nom, prenom = :prenom, phone = :phone, email = :email, nom_compte = :nom_compte, ville = :ville, adresse = :adresse, n1 = :n1, n2 = :n2, n3 = :n3, n4 = :n4, dat = :dat WHERE parrain = :parrain AND cp = :cp",
									array(
										"identifiant" => $id_users,
										"mdp" => $mdp_1_ins,
										"nom" => $nom_ins,
										"prenom" => $prenom_ins,
										"phone" => $phone_ins,
										"email" => $email_ins,
										"nom_compte" => $pseudo_ins,
										"ville" => $ville_ins,
										"adresse" => $adresse_ins,
										"n1" => $parrain_rec,
										"n2" => $parin_du_parin,
										"n3" => $nivo_2,
										"n4" => $nivo_3,
										"dat" => $d,
										"parrain" => $parrain_rec,
										"cp" => $cp
	
									));
									$nom_prenom=$nom_ins." ".$prenom_ins;
								
									#la somme du parrain du parrain
									$smm_cm_n2=$r->select("SELECT * FROM users WHERE identifiant='$parin_du_parin'")->fetch()->smm_cm;
									$nw_n2_smm_com = $smm_cm_n2 + $p2;
									#n3
									$smm_cm_n3=$r->select("SELECT * FROM users WHERE identifiant='$nivo_2'")->fetch()->smm_cm;
									$nw_n3_smm_com = $smm_cm_n3 + $p3;
									#n4
									$smm_cm_n4=$r->select("SELECT * FROM users WHERE identifiant='$nivo_3'")->fetch()->smm_cm;
									$nw_n4_smm_com = $smm_cm_n4 + $p4;
									
									#n1
									$r->update("UPDATE users SET smm_cm = :smm_cm WHERE identifiant = :identifiant",
									array("smm_cm" => $nw_parrain_n1_smm_com, "identifiant" => $parrain_rec));
									#n2
									$r->update("UPDATE users SET smm_cm = :smm_cm WHERE identifiant = :identifiant",
									array("smm_cm" => $nw_n2_smm_com, "identifiant" => $parin_du_parin));
									#n3
									$r->update("UPDATE users SET smm_cm = :smm_cm WHERE identifiant = :identifiant",
									array("smm_cm" => $nw_n3_smm_com, "identifiant" => $nivo_2));
									#n4
									$r->update("UPDATE users SET smm_cm = :smm_cm WHERE identifiant = :identifiant",
									array("smm_cm" => $nw_n4_smm_com, "identifiant" => $nivo_3));
									#on insert les notification
									#admin
									$r->insert("INSERT INTO notif(id_dest, typ, txt, dt) VALUES(?, ?, ?, ?)", array("a", 1, $txtNot, $d));
									#n1
									$r->insert("INSERT INTO notif(id_dest, typ, txt, dt) VALUES(?, ?, ?, ?)", array($parrain_rec, 1, $txtNotN1, $d));
									#n2
									$r->insert("INSERT INTO notif(id_dest, typ, txt, dt) VALUES(?, ?, ?, ?)", array($parin_du_parin, 1, $txtNotN2, $d));
									#n3
									$r->insert("INSERT INTO notif(id_dest, typ, txt, dt) VALUES(?, ?, ?, ?)", array($nivo_2, 1, $txtNotN3, $d));
									#n4
									$r->insert("INSERT INTO notif(id_dest, typ, txt, dt) VALUES(?, ?, ?, ?)", array($nivo_3, 1, $txtNotN4, $d));
									#on insert les commissions
									$r->insert("INSERT INTO commission(pprojet, lrs, os, id_us, id_dest, dt) VALUES(?, ?, ?, ?, ?, ?)", array($pp, $l, $os, $id_users, $parrain_rec, $d));
									#on insert la somme générale des commissions
									$r->update("UPDATE smm SET val = :val WHERE typ = :typ", array('val' => $nw_pp, 'typ' => "pp" ));
									$r->update("UPDATE smm SET val = :val WHERE typ = :typ", array('val' => $nw_l, 'typ' => "l" ));
									$r->update("UPDATE smm SET val = :val WHERE typ = :typ", array('val' => $nw_os, 'typ' => "os"));
	
									$_SESSION['ins_nrml'] = array($id_users,$nom_ins,$prenom_ins,$pseudo_ins,$mdp_1_ins,$cp);
									?>
									<script type="text/javascript">
										$(".div_ins_normal").slideUp();
										$(".div_ins_info").slideDown();
										document.location.replace('index.php');
									</script>
									<?php
								}elseif ($r->select("SELECT * FROM users WHERE identifiant='$parrain_rec' AND n1 = '$parin_du_parin' AND n2!='vide' AND n3!='vide' AND n4!='vide'")->rowCount()!==0) {
									#on récupère les date
									$recup_nivo_2=$r->select("SELECT * FROM users WHERE identifiant='$parrain_rec' AND n1='$parin_du_parin' AND n2!='vide' AND n3!='vide' AND n4!='vide'")->fetch();
									$nivo_1=$recup_nivo_2->n1;
									$nivo_2=$recup_nivo_2->n2;
									$nivo_3=$recup_nivo_2->n3;
									$nivo_4=$recup_nivo_2->n4;
	
									$r->update("UPDATE users SET identifiant = :identifiant, mdp = :mdp, nom = :nom, prenom = :prenom, phone = :phone, email = :email, nom_compte = :nom_compte, ville = :ville, adresse = :adresse, n1 = :n1, n2 = :n2, n3 = :n3, n4 = :n4, dat = :dat WHERE parrain = :parrain AND cp = :cp",
									array(
										"identifiant" => $id_users,
										"mdp" => $mdp_1_ins,
										"nom" => $nom_ins,
										"prenom" => $prenom_ins,
										"phone" => $phone_ins,
										"email" => $email_ins,
										"nom_compte" => $pseudo_ins,
										"ville" => $ville_ins,
										"adresse" => $adresse_ins,
										"n1" => $parrain_rec,
										"n2" => $parin_du_parin,
										"n3" => $nivo_2,
										"n4" => $nivo_3,
										"dat" => $d,
										"parrain" => $parrain_rec,
										"cp" => $cp
	
									));
									$nom_prenom=$nom_ins." ".$prenom_ins;
								
									#la somme du parrain du parrain
									$smm_cm_n2=$r->select("SELECT * FROM users WHERE identifiant='$parin_du_parin'")->fetch()->smm_cm;
									$nw_n2_smm_com = $smm_cm_n2 + $p2;
									#n3
									$smm_cm_n3=$r->select("SELECT * FROM users WHERE identifiant='$nivo_2'")->fetch()->smm_cm;
									$nw_n3_smm_com = $smm_cm_n3 + $p3;
									#n4
									$smm_cm_n4=$r->select("SELECT * FROM users WHERE identifiant='$nivo_3'")->fetch()->smm_cm;
									$nw_n4_smm_com = $smm_cm_n4 + $p4;
									
									#n1
									$r->update("UPDATE users SET smm_cm = :smm_cm WHERE identifiant = :identifiant",
									array("smm_cm" => $nw_parrain_n1_smm_com, "identifiant" => $parrain_rec));
									#n2
									$r->update("UPDATE users SET smm_cm = :smm_cm WHERE identifiant = :identifiant",
									array("smm_cm" => $nw_n2_smm_com, "identifiant" => $parin_du_parin));
									#n3
									$r->update("UPDATE users SET smm_cm = :smm_cm WHERE identifiant = :identifiant",
									array("smm_cm" => $nw_n3_smm_com, "identifiant" => $nivo_2));
									#n4
									$r->update("UPDATE users SET smm_cm = :smm_cm WHERE identifiant = :identifiant",
									array("smm_cm" => $nw_n4_smm_com, "identifiant" => $nivo_3));
									#on insert les notification
									#admin
									$r->insert("INSERT INTO notif(id_dest, typ, txt, dt) VALUES(?, ?, ?, ?)", array("a", 1, $txtNot, $d));
									#n1
									$r->insert("INSERT INTO notif(id_dest, typ, txt, dt) VALUES(?, ?, ?, ?)", array($parrain_rec, 1, $txtNotN1, $d));
									#n2
									$r->insert("INSERT INTO notif(id_dest, typ, txt, dt) VALUES(?, ?, ?, ?)", array($parin_du_parin, 1, $txtNotN2, $d));
									#n3
									$r->insert("INSERT INTO notif(id_dest, typ, txt, dt) VALUES(?, ?, ?, ?)", array($nivo_2, 1, $txtNotN3, $d));
									#n4
									$r->insert("INSERT INTO notif(id_dest, typ, txt, dt) VALUES(?, ?, ?, ?)", array($nivo_3, 1, $txtNotN4, $d));
									#on insert les commissions
									$r->insert("INSERT INTO commission(pprojet, lrs, os, id_us, id_dest, dt) VALUES(?, ?, ?, ?, ?, ?)", array($pp, $l, $os, $id_users, $parrain_rec, $d));
									#on insert la somme générale des commissions
									$r->update("UPDATE smm SET val = :val WHERE typ = :typ", array('val' => $nw_pp, 'typ' => "pp" ));
									$r->update("UPDATE smm SET val = :val WHERE typ = :typ", array('val' => $nw_l, 'typ' => "l" ));
									$r->update("UPDATE smm SET val = :val WHERE typ = :typ", array('val' => $nw_os, 'typ' => "os"));
	
									$_SESSION['ins_nrml'] = array($id_users,$nom_ins,$prenom_ins,$pseudo_ins,$mdp_1_ins,$cp);
									?>
									<script type="text/javascript">
										$(".div_ins_normal").slideUp();
										$(".div_ins_info").slideDown();
										document.location.reload();
									</script>
									<?php
								}else{ echo "Une erreur c'est produit"; }
							}
						} else {
							echo $erreur_paye;
						}
						
						
					} else { echo $verif_mdp; }
				} else { echo "Cette adresse est utilisé"; }
			} else { echo "Votre email est invalide"; }
		} else { echo "Le numéro de téléphone est invalide"; }
	} else { echo "Veuillez remplir tous les champs"; }	
}
?>