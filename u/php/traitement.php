<?php
#fichier de traitement

#si la session nest pas ouverte on repart à laccuil
if (!isset($_SESSION['u'])) {
    ?>
    <script type="text/javascript">
        document.location.replace('../index.php');
    </script>
    <?php
}
#le code pay de la session
$cp = $_SESSION['u'];
#les donné de lutilisateur
$dataUs = $r->select("SELECT * FROM users WHERE cp = '$cp'")->fetch();
$parrain = $dataUs->parrain;
setcookie("nom", $dataUs->nom);
setcookie("prenom", $dataUs->prenom);
$idUs = $dataUs->identifiant;
$typ = $dataUs->typ;
$num_apy = "242".$dataUs->phone;
#les donné du parrain
$pData = $r->select("SELECT * FROM users WHERE identifiant = '$parrain'");
if ($pData->rowCount()!=0) {
    $parrainData = $r->select("SELECT * FROM users WHERE identifiant = '$parrain'")->fetch();
}
#la somme de lepargne
$smm_ep = $dataUs->smm_ep;
#la somme de commission
$smm_cm = $dataUs->smm_cm;
#la somme de commission chop
$smm_cp = $dataUs->smm_cp;
#pour les épargne
#attente
$epn_att = $r->select("SELECT * FROM epargne WHERE id_us = '$idUs' AND statut='0'");
#accepter
$epn_act = $r->select("SELECT * FROM epargne WHERE id_us = '$idUs' AND statut='1' OR statut='2'");
#refusé
// $epn_rfs = $r->select("SELECT * FROM epargne WHERE id_us = '$idUs' AND statut='2'");
#rentrait en attente
$epn_rec_att = $r->select("SELECT * FROM epargne_rec WHERE typ = '1' AND id_us = '$idUs' AND statut='0'");
$epn_rec_act = $r->select("SELECT * FROM epargne_rec WHERE typ = '1' AND id_us = '$idUs' AND statut='1'");
$epn_rec_rfs = $r->select("SELECT * FROM epargne_rec WHERE typ = '1' AND id_us = '$idUs' AND statut='2'");
$epn_rec_all = $r->select("SELECT * FROM epargne_rec WHERE id_us = '$idUs' AND statut !='0' LIMIT 0,3");
#chop
$chop = $r->select("SELECT * FROM chop WHERE typ !='event'");
$chop_att = $r->verifie("chop_achat", "id_us", "statut", $idUs, 0);
$chop_act = $r->verifie("chop_achat", "id_us", "statut", $idUs, 1);
$chop_rfs = $r->verifie("chop_achat", "id_us", "statut", $idUs, 2);
#recuperation des commission résaux en attente
$com_rso = $r->select("SELECT * FROM epargne_rec WHERE typ = '2' AND id_us = '$idUs' AND statut='0'");
#recuperation des commission du chop en attente
$com_chp = $r->select("SELECT * FROM epargne_rec WHERE typ = '3' AND id_us = '$idUs' AND statut='0'");
#pour la ristourne
#on vérifie si la ristourne est déjà
#evenement
$even = $r->select("SELECT * FROM chop WHERE typ ='event'");
#les notifications
$ntf = $r->select("SELECT * FROM notif WHERE id_dest ='$idUs' ORDER BY id DESC");
$ntf_drn = $r->select("SELECT * FROM notif WHERE id_dest ='$idUs' ORDER BY id DESC LIMIT 0,3");
$ntf_att = $r->select("SELECT * FROM notif WHERE id_dest ='$idUs' AND statut = 0")->rowCount();
#on récupère les messages
$msg = $r->select("SELECT * FROM msg ORDER BY id");
#pour avoir les membres du résaeu

$n1 = $r->select("SELECT * FROM users WHERE n1 ='$idUs' AND cp != 'vide' and identifiant != 'vide'");
$n1 = $r->select("SELECT * FROM users WHERE n1 ='$idUs' AND cp != 'vide' and identifiant != 'vide'");
$n2 = $r->select("SELECT * FROM users WHERE n2 ='$idUs' AND cp != 'vide' and identifiant != 'vide'");
$n3 = $r->select("SELECT * FROM users WHERE n3 ='$idUs' AND cp != 'vide' and identifiant != 'vide'");
$n4 = $r->select("SELECT * FROM users WHERE n4 ='$idUs' AND cp != 'vide' and identifiant != 'vide'");
#tous les membres
$all_m = $r->select("SELECT * FROM users WHERE n1='$idUs' OR n2='$idUs' OR n3='$idUs' OR n4='$idUs'");
$all_m_acl = $r->select("SELECT * FROM users WHERE n1='$idUs' OR n2='$idUs' OR n3='$idUs' OR n4='$idUs' ORDER BY id DESC LIMIT 1");
#la variable charger de contenir le message derreur
$erreur_paye = "Une erreur est survenu lors du paiement, cliquez <label class='ui button' id='btn_reload'>ici</label> pour réessayer.";
// echo $erreur_paye;
if (isset($_POST['btn_msg'])) {
    $msg = htmlspecialchars($_POST['msg']);
    if (!empty($msg)) {
        $r->insert("INSERT INTO msg(id_post, texte, dat) VALUES(?, ?, ?)", array($idUs, $msg, $d));
        $r->update("UPDATE users SET msg = :msg WHERE identifiant != :identifiant", array(
            "msg" => 0,
            "identifiant" => $idUs
        ));
        ?><script type="text/javascript">document.location.replace('index.php?f=msg');</script><?php
    }
}
#pour les notification message
if (isset($_GET['f']) AND $_GET['f'] == "msg") {
    $r->update("UPDATE users SET msg = :msg WHERE identifiant = :identifiant", array(
        "msg" => 1,
        "identifiant" => $idUs
    ));
#effectuer un paiement
}elseif (isset($_GET['cdl_pai'])) {
    $cdl_pai = $_GET['cdl_pai'];
    $id_pai = $alea->alea_2();
    #on récupère la somme a payer
    $prix_loyer = $r->s_a_s_a_w("cdl", "id_cdl", $cdl_pai)->fetch()->smm;
    $smm_apy = $prix_loyer; 
    
	#on effectue le paiement momo
    // ######################################################################
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
                $msg_obj = "Paiement sur depuis";
                $msg_ctn = "Votre paiement de loyer sur LirYs a été effectué avec succès";
                #le paiement
                $paye_loyer = $clct->paye($token, $uuid, $smm_apy, $num_apy, $msg_obj, $msg_ctn);
            } else { $paye_loyer = false; }
        } else { $paye_loyer = false; }
    } else { $paye_loyer = false; }

    if ($paye_loyer = "1") {
        $r->insert("INSERT INTO cdl_clt(id_pai, id_cdl, id_us, dt) VALUES(?, ?, ?, ?)", array($id_pai, $cdl_pai, $idUs, $d));
        ?><script type="text/javascript">document.location.replace('index.php?f=carnet&carnet=<?php echo $cdl_pai; ?>');</script><?php
        
    } else {
        echo $erreur_paye;
    }
#validement paiement de loyer
#valider un paiement
} elseif (isset($_GET['cdl_act']) AND isset($_GET['act']) AND isset($_GET['id_crn'])) {
    $cdl_act = $_GET['cdl_act'];
    $id_crn = $_GET['id_crn'];
    $act = intval($_GET['act']); 
    #on récupère la somme a payer
    $prix_loyer = $r->s_a_s_a_w("cdl", "id_cdl", $id_crn)->fetch()->smm;
    $smm_apy = $prix_loyer; 
    if ($act == 1) {
        
    
        #on effectue le paiement momo
        // ######################################################################
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
                $token = $mmTkDst->token($uuid, $apikey);
                if ($token != "2") {
                    #le paiement
                    #les messages
                    $msg_obj = "Ristourne sur LiRys";
                    $msg_ctn = "Votre retrait du compte de la ristourne LirYs a été effectué avec succès";
                    $paye_rec_loyer = $dist->paye($token, $uuid, $smm_apy, $num_apy, $msg_obj, $msg_ctn);
                } else { $paye_rec_loyer = false; }
            } else { $paye_rec_loyer = false; }
        } else { $paye_rec_loyer = false; }

        if ($paye_rec_loyer == "1") {
            $r->update("UPDATE cdl_clt SET statut = :statut WHERE id_pai = :id_pai", array('statut' => 1, 'id_pai' => $cdl_act));
            
            ?><script type="text/javascript">document.location.replace('index.php?f=carnet&carnet=<?php echo $id_crn; ?>');</script><?php
        } else {
            echo $erreur_paye;
        }

    } else {
        $r->update("UPDATE cdl_clt SET statut = :statut WHERE id_pai = :id_pai", array('statut' => 2, 'id_pai' => $cdl_act));
        
        ?><script type="text/javascript">document.location.replace('index.php?f=carnet&carnet=<?php echo $id_crn; ?>');</script><?php
    }
    #pour ajouter un membre dans le groupe de ristourne
} elseif (isset($_GET['rst']) AND isset($_GET['act'])) {
    $rst = $_GET['rst'];
    $act = intval($_GET['act']);
    #data sur le createur du groupe
    $id_cree = $r->s_a_s_a_w("ristourne", "id_grp", $rst)->fetch()->id_us; 
    if ($act == 1) {
        $txt = $dataUs->nom." ".$dataUs->prenom." a accepté votre demande de rejoindre votre groupe de ristourne";
        $r->update("UPDATE ristourne_mbr SET statut = :statut WHERE id_us = :id_us AND id_grp = :id_grp", array('statut' => 1, 'id_us' => $idUs, 'id_grp' => $rst));
    } else {
        $txt = $dataUs->nom." ".$dataUs->prenom." a refusé votre demande de rejoindre votre groupe de ristourne";
        $r->update("UPDATE ristourne_mbr SET statut = :statut WHERE id_us = :id_us AND id_grp = :id_grp", array('statut' => 2, 'id_us' => $idUs, 'id_grp' => $rst));
    }
    $r->insert("INSERT INTO notif(id_dest, typ, txt, dt) VALUES(?, ?, ?, ?)", array($id_cree, 4, $txt, $d));
    ?><script type="text/javascript">document.location.replace('index.php?f=rst_grp&rst_grp=<?php echo $rst; ?>');</script><?php
    #pour ajouter un membre dans le groupe de ristourne
}elseif (isset($_GET['rst_ajt']) AND isset($_GET['rst_grp'])) {
    $rst_ajt = $_GET['rst_ajt'];
    $rst_grp = $_GET['rst_grp'];
    $r->insert("INSERT INTO ristourne_mbr(id_us, id_grp) VALUES(?, ?)", array($rst_ajt, $rst_grp));
    $txt = "Vous avez une demande d'adhésion à un groupe de ristourne";
    $r->insert("INSERT INTO notif(id_dest, typ, txt, dt) VALUES(?, ?, ?, ?)", array($rst_ajt, 4, $txt, $d));
    ?><script type="text/javascript">document.location.replace('index.php?f=rst_ajt&rst_ajt=<?php echo $rst_grp; ?>');</script><?php
    #retirer un membre du groupe
} elseif (isset($_GET['rst_rtr']) AND isset($_GET['id_us'])) {
    $id_grp = $_GET['rst_rtr'];
    $id_us = $_GET['id_us'];
    $r->select("DELETE FROM ristourne_mbr WHERE id_us = '$id_us' AND id_grp = '$id_grp'");
    ?><script type="text/javascript">document.location.replace('index.php?f=rst_grp&rst_grp=<?php echo $id_grp; ?>');</script><?php
    #designer qui va recoir
} elseif (isset($_GET['rst_rcv']) AND isset($_GET['id_us'])) {
    $id_grp = $_GET['rst_rcv'];
    $id_us = $_GET['id_us'];
    $r->update("UPDATE ristourne_mbr SET pst = :pst WHERE id_us = :id_us AND id_grp = :id_grp", array("pst" => 1, "id_us" => $id_us, "id_grp" => $id_grp ));
    ?><script type="text/javascript">document.location.replace('index.php?f=rst_grp&rst_grp=<?php echo $id_grp; ?>');</script><?php
    #commencer la ristourne
} elseif (isset($_GET['rst_dbu'])) {
    $rst_dbu = $_GET['rst_dbu'];
    $r->update("UPDATE ristourne SET statut = :statut WHERE id_grp = :id_grp", array("statut" => 1, "id_grp" => $rst_dbu ));
    ?><script type="text/javascript">document.location.replace('index.php?f=rst_grp&rst_grp=<?php echo $rst_dbu; ?>');</script><?php
    #payer pour la ristourne
} elseif (isset($_GET['rst_pye'])) {
    
    $rst_dbu = $_GET['rst_pye'];

    #la somme a tourner
    $dta_rst = $r->select("SELECT * FROM ristourne WHERE id_grp = '$rst_dbu'")->fetch();
    $smm_apy = $dta_rst->smm;
    
	#on effectue le paiement momo
    // ######################################################################
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
                $msg_obj = "Ristourne sur LiRys";
                $msg_ctn = "Votre depot pour la ristourne sur LirYs a été effectué avec succès";
                #le paiement
                $paye_ristourne = $clct->paye($token, $uuid, $smm_apy, $num_apy, $msg_obj, $msg_ctn);
            } else { $paye_ristourne = false; }
        } else { $paye_ristourne = false; }
    } else { $paye_ristourne = false; }
    
    if ($paye_ristourne == "1") {
    
        $r->update("UPDATE ristourne_mbr SET dpo = :dpo WHERE id_us = :id_us AND id_grp = :id_grp", array("dpo" => 1, "id_us" => $idUs, "id_grp" => $rst_dbu ));
        ?><script type="text/javascript">document.location.replace('index.php?f=rst_grp&rst_grp=<?php echo $rst_dbu; ?>');</script><?php
        
    } else {
        echo $erreur_paye;
    }
    #recupérer les ristourne
} elseif (isset($_GET['rst_rec'])) {
    
    $rst_rec = $_GET['rst_rec'];
    $dta_rst = $r->select("SELECT * FROM ristourne WHERE id_grp = '$rst_rec'")->fetch();
    $smm_rst = $dta_rst->smm;
    $grp_rst = $r->select("SELECT * FROM ristourne_mbr WHERE id_grp = '$rst_rec' AND statut = '1'");
    $nbr_mbr = $grp_rst->rowCount();
    $nw_smm = $nbr_mbr * $smm_rst;
    
	#on effectue le paiement momo
    // ######################################################################
    #on effectue le paiement momo
    #lapius 
    // echo "<br>".$uuid_ins;
    $uuid = $mmUi->genere();
    $apius = $mmUs->user($uuid);
    $smm_apy = $nw_smm; 
    
    if ($apius == "1") {
        #lapikey
        $apikey = $mmKY->key($uuid);
        if ($apikey != "2") {
            #le token
            $token = $mmTkDst->token($uuid, $apikey);
            if ($token != "2") {
                #le paiement
                #les messages
                $msg_obj = "Ristourne sur LiRys";
                $msg_ctn = "Votre retrait du compte de la ristourne LirYs a été effectué avec succès";
                $paye_rec_ristourne = $dist->paye($token, $uuid, $smm_apy, $num_apy, $msg_obj, $msg_ctn);
            } else { $paye_rec_ristourne = false; }
        } else { $paye_rec_ristourne = false; }
    } else { $paye_rec_ristourne = false; }

    if ($paye_rec_ristourne == "1") {
        
        $r->insert("INSERT INTO ristourne_rec(id_grp, id_us, smm, dt) VALUES(?, ?, ?, ?)", array($rst_rec, $idUs, $nw_smm, $d));
        $r->update("UPDATE ristourne_mbr SET dpo = :dpo WHERE id_grp = :id_grp", array("dpo" => 0, "id_grp" => $rst_rec ));
        $r->update("UPDATE ristourne_mbr SET pst = :pst WHERE id_grp = :id_grp", array("pst" => 0, "id_grp" => $rst_rec ));
        ?><script type="text/javascript">document.location.replace('index.php?f=rst_grp&rst_grp=<?php echo $rst_rec; ?>');</script><?php
    } else {
        echo $erreur_paye; 
    }
#epargner
}  elseif (isset($_GET['epn'])) {
    
    $epn = intval($_GET['epn']);
    $nw_smm_ep = $smm_ep + $epn;
    $smm_apy = $epn;
	#on effectue le paiement momo
    // ######################################################################
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
                $msg_obj = "Epargne sur LiRys";
                $msg_ctn = "Votre épargne sur LirYs a été effectué avec succès";
                #le paiement
                $paye = $clct->paye($token, $uuid, $smm_apy, $num_apy, $msg_obj, $msg_ctn);
            } else { $paye = false; }
        } else { $paye = false; }
    } else { $paye = false; }
    #on insert
    if ($paye == "1") {
        $r->insert("INSERT INTO epargne(smm, id_us, statut, dat) VALUE(?, ?, ?, ?)", array($epn, $idUs, 1, $d));
        $r->update("UPDATE users SET smm_ep = :smm_ep WHERE identifiant = :identifiant", array("smm_ep" => $nw_smm_ep, "identifiant" => $idUs));
        ?><script type="text/javascript">document.location.replace('index.php?f=epn');</script><?php
    } else {
        echo $erreur_paye;
    }
#####################
######################
#récupération des gains de lépargne
}elseif (isset($_GET['epn_rec'])) {
    
	#on effectue le paiement momo
    // ######################################################################
    #on effectue le paiement momo
    #lapius 
    // echo "<br>".$uuid_ins;
    $uuid = $mmUi->genere();
    $apius = $mmUs->user($uuid);
    $smm_apy = $smm_ep;
    
    if ($apius == "1") {
        #lapikey
        $apikey = $mmKY->key($uuid);
        if ($apikey != "2") {
            #le token
            $token = $mmTkDst->token($uuid, $apikey);
            if ($token != "2") {
                #le paiement
                #les messages
                $msg_obj = "Epargne sur LiRys";
                $msg_ctn = "Votre retrait sur LirYs a été effectué avec succès";
                $paye_rec_epn = $dist->paye($token, $uuid, $smm_apy, $num_apy, $msg_obj, $msg_ctn);
            } else { $paye_rec_epn = false; }
        } else { $paye_rec_epn = false; }
    } else { $paye_rec_epn = false; }
    if ($paye_rec_epn == "1") {
        $r->insert("INSERT INTO epargne_rec(typ, smm, id_us, dat, statut) VALUE(?, ?, ?, ?, ?)", array("1", $smm_ep, $idUs, $d, "1"));
        $r->update("UPDATE users SET smm_ep = :smm_ep WHERE identifiant = :identifiant", array("smm_ep" => 0, "identifiant" => $idUs));
        $r->select("DELETE FROM epargne WHERE id_us = '$idUs'");
        ?><script type="text/javascript">document.location.replace('index.php?f=epn');</script><?php
    } else { echo $erreur_paye; }
    #pour la recupération des commission de réseaux 
}elseif (isset($_GET['com_rec'])) {
    
	#on effectue le paiement momo
    // ######################################################################
    #on effectue le paiement momo
    #lapius 
    // echo "<br>".$uuid_ins;
    $uuid = $mmUi->genere();
    $apius = $mmUs->user($uuid);
    $smm_apy = $smm_cm;
    
    if ($apius == "1") {
        #lapikey
        $apikey = $mmKY->key($uuid);
        if ($apikey != "2") {
            #le token
            $token = $mmTkDst->token($uuid, $apikey);
            if ($token != "2") {
                #le paiement
                #les messages
                $msg_obj = "Epargne sur LiRys";
                $msg_ctn = "Votre retrait sur LirYs a été effectué avec succès";
                $paye_rec_com = $dist->paye($token, $uuid, $smm_apy, $num_apy, $msg_obj, $msg_ctn);
            } else { $paye_rec_com = false; }
        } else { $paye_rec_com = false; }
    } else { $paye_rec_com = false; }

    if ($paye_rec_com == "1") {
        
        $r->insert("INSERT INTO epargne_rec(typ, smm, id_us, dat, statut) VALUE(?, ?, ?, ?, ?)", array("2", $smm_cm, $idUs, $d, "1"));
        $r->update("UPDATE users SET smm_cm = :smm_cm WHERE identifiant = :identifiant", array("smm_cm" => 0, "identifiant" => $idUs));
        ?><script type="text/javascript">document.location.replace('index.php?f=abr');</script><?php
        
    } else {
        echo $erreur_paye;
    }
    #pour la récupération des commission chop
}elseif (isset($_GET['chp_rec'])) {
	#on effectue le paiement momo
    // ######################################################################
    #on effectue le paiement momo
    #lapius 
    // echo "<br>".$uuid_ins;
    $uuid = $mmUi->genere();
    $apius = $mmUs->user($uuid);
    $smm_apy = $smm_cp;
    
    if ($apius == "1") {
        #lapikey
        $apikey = $mmKY->key($uuid);
        if ($apikey != "2") {
            #le token
            $token = $mmTkDst->token($uuid, $apikey);
            if ($token != "2") {
                #le paiement
                #les messages
                $msg_obj = "Epargne sur LiRys";
                $msg_ctn = "Votre retrait sur LirYs a été effectué avec succès";
                $paye_rec_chp = $dist->paye($token, $uuid, $smm_apy, $num_apy, $msg_obj, $msg_ctn);
            } else { $paye_rec_chp = false; }
        } else { $paye_rec_chp = false; }
    } else { $paye_rec_chp = false; }
    if ($paye_rec_chp == "1") {    
    $r->insert("INSERT INTO epargne_rec(typ, smm, id_us, dat, statut) VALUE(?, ?, ?, ?, ?)", array("3", $smm_cp, $idUs, $d, "1"));
    $r->update("UPDATE users SET smm_cp = :smm_cp WHERE identifiant = :identifiant", array("smm_cp" => 0, "identifiant" => $idUs));
    ?><script type="text/javascript">document.location.replace('index.php?f=chp');</script><?php
    } else {
        echo $erreur_paye;
    }
    
    #######################
    #pour acheter un article
}elseif (isset($_GET['chp'])) {
    #on prend le prix de larticl
    $chp = $_GET['chp'];
    $prix = $r->s_a_s_a_w("chop", "id", $chp)->fetch()->prix;
	#on effectue le paiement momo
    // ######################################################################
    #on effectue le paiement momo
    #lapius 
    // echo "<br>".$uuid_ins;
    $uuid = $mmUi->genere();
    $apius = $mmUs->user($uuid);
    $smm_apy = $prix;
    
    if ($apius == "1") {
        #lapikey
        $apikey = $mmKY->key($uuid);
        if ($apikey != "2") {
            #le token
            $token = $mmTk->token($uuid, $apikey);
            if ($token != "2") {
                #le paiement
                #les messages
                $msg_obj = "Achat sur LiRys";
                $msg_ctn = "Votre achat sur LirYs a été effectué avec succès";
                $paye_rec_act = $clct->paye($token, $uuid, $smm_apy, $num_apy, $msg_obj, $msg_ctn);
            } else { $paye_rec_act = false; }
        } else { $paye_rec_act = false; }
    } else { $paye_rec_act = false; }
    if ($paye_rec_act == "1") {
        
        $r->insert("INSERT INTO chop_achat(id_art, id_us, dat, statut) VALUE(?, ?, ?, ?)", array($chp, $idUs, $d,"1"));
        ?><script type="text/javascript">document.location.replace('index.php?f=chp');</script><?php
    } else {
        echo $erreur_paye;
    }
    
} elseif (isset($_GET['evn'])) {
    $chp = $_GET['evn'];
    $r->insert("INSERT INTO chop_achat(id_art, id_us, dat) VALUE(?, ?, ?)", array($chp, $idUs, $d));
    ?><script type="text/javascript">document.location.replace('index.php?f=evn');</script><?php
}
?>