<?php  
session_start();
#inclusion des class
require_once 'extends_class/extends.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title>LirYs - Administration</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1">
	<!-- style -->
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<!-- pour le responsive -->
	<link rel="stylesheet" type="text/css" media="screen and (max-width: 767px)" href="style\mobile.css">
	<!-- <link rel="stylesheet" type="text/css" media="screen and (max-width: 991px)" href="style\tablette.css"> -->
	<!-- script -->
	<script type="text/javascript" src="script/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="script/function.js"></script>
	<!-- icon -->

    <link rel="stylesheet" href="../../../style/Semantic-UI-master/dist/semantic.css">
    <link rel="stylesheet" href="../../../style/fontawesome-free-6.1.1-web/css/all.css">
    <link rel="stylesheet" href="../../../style/bootstrap-5.1.3/dist/css/bootstrap.css">

    <script src="style/bootstrap-5.1.3/dist/js/bootstrap.js"></script>
	<link rel="icon" type="image/icon" href="..\..\..\images\icn.ico">
</head>
<body>
	<div class="container-fluid alert-danger">
	<?php include 'php/ins.php'; ?>
	</div>
    <!-- la function charger de recharger la page en cas d'échèque de paiement -->
    <script>
        $("#btn_reload").click(function(){
            document.location.reload();
        });
    </script>
	<?php  
	if (isset($_SESSION['admin'])) {
		#le header
		include 'partie/header.php';
		#le tableau de bord
		if (isset($_GET['tdb'])) {
			include 'partie/tdb.php';
		#les épargne
		}elseif (isset($_GET['epn'])) {
			include 'partie/epn.php';
		#le chop
		}elseif (isset($_GET['chp'])) {
			include 'partie/chp.php';
		######################################################
		#pour les épargne quand quelqun effectue un dépot
		} elseif (isset($_GET['dpo']) AND isset($_GET['act'])) {
			#laction a effectuer
			$act = $_GET["act"];
			#lidentifiant de lutilisateur
			$dpo = $_GET["dpo"];
			$Ep = $r->s_a_s_a_w("epargne", "id", $dpo)->fetch();
			$idUsEp = $Ep->id_us;
			if ($act == "1") {
				$smm = $Ep->smm;
				$smmUs = $r->s_a_s_a_w("users", "identifiant", $idUsEp)->fetch()->smm_ep;
				$nwSmm = $smmUs + $smm;
				$txtNot = "Votre demande dépargne a été accepté";
				$r->update("UPDATE epargne SET statut = :statut WHERE id = :id", array('statut' => 1, 'id' => $dpo));
				$r->update("UPDATE users SET smm_ep = :smm_ep WHERE identifiant = :identifiant", array('smm_ep' => $nwSmm, 'identifiant' => $idUsEp));

			}else {
				$r->update("UPDATE epargne SET statut = :statut WHERE id = :id", array('statut' => 2, 'id' => $dpo));
				$txtNot = "Votre demande dépargne a été refusé";
				
			}
			$r->insert("INSERT INTO notif(id_dest, typ, txt, dt) VALUES(?, ?, ?, ?)", array($idUsEp, "2", $txtNot, $d));
			?>
			<script type="text/javascript">
				document.location.replace('index.php?epn');
			</script>
			<?php
		############################################################################
		#pour les chat
		#quand quelqu'un effectue lachat dun produit
		} elseif (isset($_GET['ach']) AND isset($_GET['act']) AND isset($_GET['ida'])) {
			#action à effectuer
			$act = $_GET["act"];
			#identifiant du client
			$dpo = $_GET["ach"];
			#identifiant de l'article
			$ida = $_GET['ida'];
			$Ep = $r->s_a_s_a_w("chop", "id", $dpo)->fetch();
			$chp_achat = $r->s_a_s_a_w("chop_achat", "id", $ida)->fetch();
			$idUsEp = $chp_achat->id_us;
			$id_users = $chp_achat->id_us;
			if ($act == "1") {
				$smm = $Ep->prix;
				$smmUs = $r->s_a_s_a_w("users", "identifiant", $idUsEp)->fetch()->smm_cp;
				$parrain_rec = $r->s_a_s_a_w("users", "identifiant", $idUsEp)->fetch()->parrain;
				$dataUs = $r->s_a_s_a_w("users", "identifiant", $idUsEp)->fetch();
				$prix = $Ep->prix;
				#on inclue la class charger des la repartition des commission
				include "php/ach.php";

			}else {
				$r->update("UPDATE chop_achat SET statut = :statut WHERE id = :id", array('statut' => 2, 'id' => $ida));
				$txtNot = "Votre demande dépargne a été refusé";$r->insert("INSERT INTO notif(id_dest, typ, txt, dt) VALUES(?, ?, ?, ?)", array($idUsEp, "2", $txtNot, $d));
				?>
				<script type="text/javascript">
					document.location.replace('index.php?chp');
				</script>
				<?php
				
			}
		#########################################################
		#pour récupérer
		#quand un utilisateur veut recupérer ce qu'il a épargner
		}elseif (isset($_GET['rec']) AND isset($_GET['act'])) {
			#laction a effectuer
			$act = $_GET["act"];
			#lidentifiant de lutilisateur
			$rec = $_GET["rec"];
			$Ep = $r->s_a_s_a_w("epargne_rec", "id", $rec)->fetch();
			$idUsEp = $Ep->id_us;
			if ($act == "1") {
				$txtNot = "Votre demande retrait a été accepté";
				$r->update("UPDATE epargne_rec SET statut = :statut WHERE id = :id", array('statut' => 1, 'id' => $rec));
			}else {
				$r->update("UPDATE epargne_rec SET statut = :statut WHERE id = :id", array('statut' => 2, 'id' => $rec));
				$txtNot = "Votre demande retrait a été refusé";
			}	
			$r->insert("INSERT INTO notif(id_dest, typ, txt, dt) VALUES(?, ?, ?, ?)", array($idUsEp, "3", $txtNot, $d));
			?>
			<script type="text/javascript">
				document.location.replace('index.php?epn');
			</script>
			<?php
		#ajouter un utilisateur
		}elseif (isset($_GET['add_fieu'])) {
			include 'partie/add_fieu.php';
		#les informations sur le fieu que l'on vient d'ajouter
		}elseif (isset($_GET['f_add'])) {
			include 'partie/f_add.php';
		#pour libérer un code
		}elseif (isset($_GET['l_c'])) {
			include 'partie/l_c.php';
		#la page d'accueil
		} else {
			include 'partie/accueil.php';
		}
		#le footer
		include 'partie/footer.php';
	#si la session n'est pas ouverte on affiche page de connexion
	} else {
		include 'partie/cnx.php';
	}
	

	?>

</body>
</html>