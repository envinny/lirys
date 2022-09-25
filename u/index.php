<?php
session_start();
#inclusion des class
require_once 'extends_class/extends.php';
#la class momo
require_once '../class/momo/all_class_momo.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php
    if (isset($_COOKIE['nom'])) {
        echo utf8_encode(ucwords($_COOKIE['nom']." ". $_COOKIE['prenom']));
    } 
    
    ?></title>
    <link rel="stylesheet" href="style/Semantic-UI-master/dist/semantic.css">
    <link rel="stylesheet" href="style/fontawesome-free-6.1.1-web/css/all.css">
    <link rel="stylesheet" href="style/bootstrap-5.1.3/dist/css/bootstrap.css">
    <link rel="icon" type="image/icon" href="img\icn.ico">

    <script src="style/bootstrap-5.1.3/dist/js/bootstrap.js"></script>
    <script src="script/jquery-3.3.1.min.js"></script>
    <script src="script/function.js"></script>

</head>
<style>
    a{text-decoration:none};
</style>
<body>
	<div class="container-fluid alert-danger">
	<?php #fichier des traitement
    require_once 'php/traitement.php'; 
    ?>
	</div>
    <!-- la function charger de recharger la page en cas d'échèque de paiement -->
    <script>
        $("#btn_reload").click(function(){
            document.location.reload();
        });
    </script>
    <?php
    #le header
    include "p/head.php";
    if (isset($_GET['f'])) {
        #les fenetre
        $f = $_GET['f'];
        #profil
        if ($f == "pro") {
            include "p/pro.php";
        #tableau de bord
        }elseif ($f == "tdb") {
            include "p/tdb.php";
        #epargne
        }elseif ($f == "epn") {
            include "p/epn.php";
        #reseau
        }elseif ($f == "abr") {
            include "p/abr.php";
        #evenement
        }elseif ($f == "evn") {
            include "p/evn.php";
        #notification
        }elseif ($f == "ntf") {
            include "p/ntf.php";
        #chat
        }elseif ($f == "msg") {
            include "p/msg.php";
        #chop
        }elseif ($f == "chp") {
            include "p/chp.php";
        #les transactions
        } elseif ($f == "lst") {
            include "p/lst.php";
        ##################
        #pour la ristourne
        #page d'accueil
        }elseif ($f == "rst") {
            include "p/ristourne/ristourne.php";
        #creer le groupe
        }elseif ($f == "rst_creer") {
            include "p/ristourne/creer.php";
        #ajouter des membres dans le groupe
        }elseif ($f == "rst_ajt") {
            include "p/ristourne/ajout.php";
        #voir le groupe
        }elseif ($f == "rst_grp") {
            include "p/ristourne/groupe.php";
        ##########################
        #pour les cartes de loyers
        #acceuil
        }elseif ($f == "cdl") {
            include "p/cdl/cdl.php";
        #creer
        }elseif ($f == "cdl_creer") {
            include "p/cdl/cdl_creer.php";
        #voir le carnet
        }elseif ($f == "carnet") {
            include "p/cdl/carnet.php";
        #####################
        #pour le porte feuille
        }elseif ($f == "ptf") {
            include "p/ptf.php";
        }
        ###################################################
    } else { include "p/acl.php"; }
    
    ?>
</body>
</html>