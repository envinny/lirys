<?php
#charger de faire la repartition des commissions
$verif_si_parin_a_parin = $r->select("SELECT * FROM users WHERE identifiant='$parrain_rec'");
$verif_si_parin_a_parin_fetch = $verif_si_parin_a_parin->fetch();
$parin_du_parin = $verif_si_parin_a_parin_fetch->parrain;

$nom_ins = $dataUs->nom;
$prenom_ins = $dataUs->prenom;
#on vérifie si le parrain à un parrain
#si le parrain du parrain d=est vide ou null alors son parrain se met au niveau 1
#pour les commissions
$com = new chop_commission($prix);
$pp = $com->pp();
$l = $com->l();
$os = $com->os();
$p1 = $com->p1();
$p2 = $com->p2();
$p3 = $com->p3();
$p4 = $com->p4();
#on prent la somme total des commissions
$smm_comm_pp = $r->select("SELECT * FROM smm WHERE typ = 'pp'")->fetch()->val;
$smm_comm_l = $r->select("SELECT * FROM smm WHERE typ = 'l'")->fetch()->val;
$smm_comm_os = $r->select("SELECT * FROM smm WHERE typ = 'os'")->fetch()->val;
$nw_pp = $pp + $smm_comm_pp;
$nw_l = $l + $smm_comm_l;
$nw_os = $os + $smm_comm_os;
#on récupère les commission du parrain
$parrain_n1_smm_com = $verif_si_parin_a_parin_fetch->smm_cp;
$nw_parrain_n1_smm_com = $parrain_n1_smm_com + $p1; 
#pour les notifiaction
#pour admin
$txtNot = "Vous avez reçu des commissions de la part de ".$nom_ins." ".$prenom_ins." Pour Projet ".$pp." XAF, pour LirYs ".$l." XAF pour les Oeuvre Sociales ".$os." XAF pour l'achat de produit";
#pour le parrain_n1
$txtNotN1 = "Vous avez reçu des commissions de la part de ".$nom_ins." ".$prenom_ins." du montant de ".$p1." XAF";
$txtNotN2 = "Vous avez reçu des commissions de la part de ".$nom_ins." ".$prenom_ins." du montant de ".$p2." XAF";
$txtNotN3 = "Vous avez reçu des commissions de la part de ".$nom_ins." ".$prenom_ins." du montant de ".$p3." XAF";
$txtNotN4 = "Vous avez reçu des commissions de la part de ".$nom_ins." ".$prenom_ins." du montant de ".$p4." XAF";
 // strtoupper
if ($parin_du_parin == "vide" || $parin_du_parin == 'null') {
    $r->update("UPDATE chop_achat SET statut = :statut WHERE id = :id", array('statut' => 1, 'id' => $ida));
    #n1
    $r->update("UPDATE users SET smm_cp = :smm_cp WHERE identifiant = :identifiant",
    array("smm_cp" => $nw_parrain_n1_smm_com, "identifiant" => $parrain_rec));
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
    ?><script type="text/javascript">document.location.replace('index.php?chp');</script><?php
} else {
    
    #par nivo toujours
    if ($r->select("SELECT * FROM users WHERE identifiant='$parrain_rec' AND n1 = '$parin_du_parin' AND n2='vide' AND n3='vide' AND n4='vide'")->rowCount()!==0) {
    $r->update("UPDATE chop_achat SET statut = :statut WHERE id = :id", array('statut' => 1, 'id' => $ida));
    #la somme du parrain du parrain
    $smm_cm_n2=$r->select("SELECT * FROM users WHERE identifiant='$parin_du_parin'")->fetch()->smm_cp;
    $nw_n2_smm_com = $smm_cm_n2 + $p2;
    
    #n1
    $r->update("UPDATE users SET smm_cp = :smm_cp WHERE identifiant = :identifiant",
    array("smm_cp" => $nw_parrain_n1_smm_com, "identifiant" => $parrain_rec));
    #n2
    $r->update("UPDATE users SET smm_cp = :smm_cp WHERE identifiant = :identifiant",
    array("smm_cp" => $nw_n2_smm_com, "identifiant" => $parin_du_parin));
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
        ?><script type="text/javascript">document.location.replace('index.php?chp');</script><?php

    } elseif ($r->select("SELECT * FROM users WHERE identifiant='$parrain_rec' AND n1 = '$parin_du_parin' AND n2!='vide' AND n3='vide' AND n4='vide'")->rowCount()!==0) {
        $r->update("UPDATE chop_achat SET statut = :statut WHERE id = :id", array('statut' => 1, 'id' => $ida));
        #on récupère les date
        $recup_nivo_2=$r->select("SELECT * FROM users WHERE identifiant='$parrain_rec' AND n1='$parin_du_parin' AND n2!='vide' AND n3='vide' AND n4='vide'")->fetch();
        $nivo_1=$recup_nivo_2->n1;
        $nivo_2=$recup_nivo_2->n2;
        
        #la somme du parrain du parrain
        $smm_cm_n2=$r->select("SELECT * FROM users WHERE identifiant='$parin_du_parin'")->fetch()->smm_cp;
        $nw_n2_smm_com = $smm_cm_n2 + $p2;
        #n3
        $smm_cm_n3=$r->select("SELECT * FROM users WHERE identifiant='$nivo_2'")->fetch()->smm_cp;
        $nw_n3_smm_com = $smm_cm_n3 + $p3;
        
        #n1
        $r->update("UPDATE users SET smm_cp = :smm_cp WHERE identifiant = :identifiant",
        array("smm_cp" => $nw_parrain_n1_smm_com, "identifiant" => $parrain_rec));
        #n2
        $r->update("UPDATE users SET smm_cp = :smm_cp WHERE identifiant = :identifiant",
        array("smm_cp" => $nw_n2_smm_com, "identifiant" => $parin_du_parin));
        #n3
        $r->update("UPDATE users SET smm_cp = :smm_cp WHERE identifiant = :identifiant",
        array("smm_cp" => $nw_n3_smm_com, "identifiant" => $nivo_2));
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
        ?><script type="text/javascript">document.location.replace('index.php?chp');</script><?php

    }elseif ($r->select("SELECT * FROM users WHERE identifiant='$parrain_rec' AND n1 = '$parin_du_parin' AND n2!='vide' AND n3!='vide' AND n4='vide'")->rowCount()!==0) {
        $r->update("UPDATE chop_achat SET statut = :statut WHERE id = :id", array('statut' => 1, 'id' => $ida));
        #on récupère les date
        $recup_nivo_2=$r->select("SELECT * FROM users WHERE identifiant='$parrain_rec' AND n1='$parin_du_parin' AND n2!='vide' AND n3!='vide' AND n4='vide'")->fetch();
        $nivo_1=$recup_nivo_2->n1;
        $nivo_2=$recup_nivo_2->n2;
        $nivo_3=$recup_nivo_2->n3;
    
        #la somme du parrain du parrain
        $smm_cm_n2=$r->select("SELECT * FROM users WHERE identifiant='$parin_du_parin'")->fetch()->smm_cp;
        $nw_n2_smm_com = $smm_cm_n2 + $p2;
        #n3
        $smm_cm_n3=$r->select("SELECT * FROM users WHERE identifiant='$nivo_2'")->fetch()->smm_cp;
        $nw_n3_smm_com = $smm_cm_n3 + $p3;
        #n4
        $smm_cm_n4=$r->select("SELECT * FROM users WHERE identifiant='$nivo_3'")->fetch()->smm_cp;
        $nw_n4_smm_com = $smm_cm_n4 + $p4;
        
        #n1
        $r->update("UPDATE users SET smm_cp = :smm_cp WHERE identifiant = :identifiant",
        array("smm_cp" => $nw_parrain_n1_smm_com, "identifiant" => $parrain_rec));
        #n2
        $r->update("UPDATE users SET smm_cp = :smm_cp WHERE identifiant = :identifiant",
        array("smm_cp" => $nw_n2_smm_com, "identifiant" => $parin_du_parin));
        #n3
        $r->update("UPDATE users SET smm_cp = :smm_cp WHERE identifiant = :identifiant",
        array("smm_cp" => $nw_n3_smm_com, "identifiant" => $nivo_2));
        #n4
        $r->update("UPDATE users SET smm_cp = :smm_cp WHERE identifiant = :identifiant",
        array("smm_cp" => $nw_n4_smm_com, "identifiant" => $nivo_3));
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
        ?><script type="text/javascript">document.location.replace('index.php?chp');</script><?php

    }elseif ($r->select("SELECT * FROM users WHERE identifiant='$parrain_rec' AND n1 = '$parin_du_parin' AND n2!='vide' AND n3!='vide' AND n4!='vide'")->rowCount()!==0) {
        $r->update("UPDATE chop_achat SET statut = :statut WHERE id = :id", array('statut' => 1, 'id' => $ida));
        #on récupère les date
        $recup_nivo_2=$r->select("SELECT * FROM users WHERE identifiant='$parrain_rec' AND n1='$parin_du_parin' AND n2!='vide' AND n3!='vide' AND n4!='vide'")->fetch();
        $nivo_1=$recup_nivo_2->n1;
        $nivo_2=$recup_nivo_2->n2;
        $nivo_3=$recup_nivo_2->n3;
        $nivo_4=$recup_nivo_2->n4;
    
        #la somme du parrain du parrain
        $smm_cm_n2=$r->select("SELECT * FROM users WHERE identifiant='$parin_du_parin'")->fetch()->smm_cp;
        $nw_n2_smm_com = $smm_cm_n2 + $p2;
        #n3
        $smm_cm_n3=$r->select("SELECT * FROM users WHERE identifiant='$nivo_2'")->fetch()->smm_cp;
        $nw_n3_smm_com = $smm_cm_n3 + $p3;
        #n4
        $smm_cm_n4=$r->select("SELECT * FROM users WHERE identifiant='$nivo_3'")->fetch()->smm_cp;
        $nw_n4_smm_com = $smm_cm_n4 + $p4;
        
        #n1
        $r->update("UPDATE users SET smm_cp = :smm_cp WHERE identifiant = :identifiant",
        array("smm_cp" => $nw_parrain_n1_smm_com, "identifiant" => $parrain_rec));
        #n2
        $r->update("UPDATE users SET smm_cp = :smm_cp WHERE identifiant = :identifiant",
        array("smm_cp" => $nw_n2_smm_com, "identifiant" => $parin_du_parin));
        #n3
        $r->update("UPDATE users SET smm_cp = :smm_cp WHERE identifiant = :identifiant",
        array("smm_cp" => $nw_n3_smm_com, "identifiant" => $nivo_2));
        #n4
        $r->update("UPDATE users SET smm_cp = :smm_cp WHERE identifiant = :identifiant",
        array("smm_cp" => $nw_n4_smm_com, "identifiant" => $nivo_3));
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
        ?><script type="text/javascript">document.location.replace('index.php?chp');</script><?php
        
    }else{
        echo "Une erreur c'est produit";
    }

}	









?>