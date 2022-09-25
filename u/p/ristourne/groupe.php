<!-- lentête -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#06AE31;border-top:2px solid #fff;">
    <div class="container-fluid row">
        <div class="container col-3"><center>
            <a style="color:#fff;" class="nav-link active" aria-current="page" href="?f=epn"><i class="cloud upload icon" id="icon_pro"></i>EPARGNE</a>
        </div></center>
        <div class="container col-3"><center>
            <a style="color:#fff;" class="nav-link active" aria-current="page" href="?f=abr"><i class="sitemap icon" id="icon_pro"></i> RESEAU</a>
        </div></center>
        <div class="container col-3"><center>
            <a style="color:#fff;" class="nav-link active ui button" aria-current="page" href=""><i class="sync alternate icon" id="icon_pro"></i> RISTOURNE</a>
        </div></center>
        <div class="container col-3"><center>
            <a style="color:#fff;" class="nav-link active" aria-current="page" href="?f=cdl"><i class="clipboard icon" id="icon_pro"></i> CARNET DE LOYER</a>
        </div></center>
    </div>
</nav>
<?php
$rst_grp = $_GET['rst_grp'];
$dta_grp = $r->s_a_s_a_w("ristourne", "id_grp", $rst_grp)->fetch();
$mbr_grp = $r->s_a_s_a_w("ristourne_mbr", "id_grp", $rst_grp);
$mbr_grp_att = $r->verifie("ristourne_mbr", "id_grp", "statut", $rst_grp, 0);
$mbr_grp_pym = $r->verifie("ristourne_mbr", "id_us", "id_grp", $idUs, $rst_grp)->fetch();
$rst_rec = $r->s_a_s_a_w("ristourne_rec", "id_grp", $rst_grp);
$mbr_grp_dpo = $r->verifie("ristourne_mbr", "id_grp", "dpo", $rst_grp, 1);
$mbr_grp_pst = $r->verifie("ristourne_mbr", "id_grp", "pst", $rst_grp, 1);
$mbr_grp_dpo2 = $r->verifie("ristourne_mbr", "id_grp", "statut", $rst_grp, 1);
$nbr1 = $mbr_grp_dpo->rowCount();
$nbr2 = $mbr_grp_dpo2->rowCount();

?>
<div class="container mt-3"><center><h2 class="ui header">GROUPE DE RISTOURNE : <?php echo $dta_grp->nom; ?></h2></center></div>
<div class="container"> <center><b class="ui button"><?php echo $dta_grp->smm; ?> XAF</b></center>  </div>



<div class="container mt-3">
        <div class="container"><center>
            <?php
            if ($dta_grp->id_us == $idUs) {
                if ($dta_grp->statut == 0) {
                    ?><a href="?f=rst_ajt&rst_ajt=<?php echo $rst_grp; ?>" class="ui blue button"><i class="plus icon" id="icon_pro"></i>AJOUTER</a><?php
                } else {
                    ?><a href="" class="ui button">En cours...</a><?php
                }   
            } else {
                if ($dta_grp->statut == 0) {
                    ?><a href="" class="ui button">En attente</a><?php
                } else {
                    ?><a href="" class="ui button">En cours...</a><?php
                }
            }

            if ($dta_grp->id_us == $idUs) {
                if ($dta_grp->statut == 1) {
                    ?><a href="" class="ui red button">Arrêter</a><?php
                } else {
                    ?><a href="" class="ui button">En attente</a><?php
                }
                
                
            }
            
        
            if ($dta_grp->statut == 0) {
                ?><a class="ui button">En attente</a><?php
            } else {
                if ($mbr_grp_pym->dpo == 0) {
                    ?><a href="?rst_pye=<?php echo $rst_grp; ?>" class="ui blue button">PAYER</a><?php
                } else {
                    ?><label class="ui green button">OK</label><?php
                }
                

                
            }
            ?>
            
        </center></div>

</div>
<hr>
<div class="container d-flex mt-3">
    <div class="container mt-3 col-md-4">
        <div class="container mb-3"><h4 class="ui header">MEMBRES</h4></div>
        <div class="container">
            <div class="ui middle aligned divided list">
    <?php
    while ($a = $mbr_grp->fetch(PDO::FETCH_OBJ)) {

        $id_rst_mbr = $a->id_us;
        $dta_us_grp = $r->s_a_s_a_w("users", "identifiant", $id_rst_mbr)->fetch();
        ?>
                <div class="item">
                    <div class="right floated content">
        <?php
        if ($dta_grp->statut == 1) {
            if ($a->dpo == 0 ) {
                ?><a class="ui button">Non payé</a><?php
            } else {
                ?><a class="ui green button">Payé</a><?php
            }
            
        } else {
            if ($dta_grp->id_us == $idUs) {
                if ($id_rst_mbr == $dta_grp->id_us) {
                    # code...
                } else {
                        
                    ?><a class="ui red button" href="?rst_rtr=<?php echo $a->id_grp; ?>&id_us=<?php echo $a->id_us; ?>">Retirer</a><?php
                }
                    
            }
            
            if ($a->statut == 0) {
                ?><a class="ui button" href="#">En attente</a><?php
            }elseif ($a->statut == 1) {
                ?><a class="ui button" href="#">Membre</a><?php
            }elseif ($a->statut == 2) {
                ?><a class="ui red button" href="#">Refusé</a><?php
            }
            
        }
        if ($dta_grp->id_us == $idUs) {
            if ($nbr1 == $nbr2) {
                if ($mbr_grp_pst->rowCount() != 0 ) {
                    # code...
                } else {       
                    if ($a->pst == "0") {
                        ?><a class="ui button" href="?rst_rcv=<?php echo $a->id_grp; ?>&id_us=<?php echo $a->id_us; ?>">Recevoir</a><?php
                    }
                }
                if ($a->pst == "1") {
                    ?><a class="ui blue button" href="?rst_rcv=<?php echo $a->id_grp; ?>&id_us=<?php echo $a->id_us; ?>">Peut recevoir</a><?php
                }elseif ($a->pst == "2") {
                    ?><a class="ui green button" href="?rst_rcv=<?php echo $a->id_grp; ?>&id_us=<?php echo $a->id_us; ?>">A reçu</a><?php

                }
            } 
            
        }
        ?>
                    </div>
                    <div class="content"><?php echo $dta_us_grp->nom_compte; ?></div>
                </div>
        <?php
    }
    ?>
                <div class="container mt-3"><center>
                <?php
                if ($nbr1 == $nbr2) {
                    if ($mbr_grp_pym->pst == "1") {
                        ?><a href="?rst_rec=<?php echo $rst_grp; ?>" class="ui blue button">Récupérer</a><?php
                    }

                } else {

                    if ($mbr_grp_att->rowCount() == 0) {
                        if ($dta_grp->id_us == $idUs) {
                            if ($dta_grp->statut == 1) {
                                ?><a class="ui button">En cours...</a><?php
                            } else {
                                ?><a class="ui green button" href="?rst_dbu=<?php echo $rst_grp; ?>">Commencer</a><?php
                            }
                            
                            
                        } else {
                            if ($dta_grp->statut == 1) {
                                ?><a class="ui button">En cours...</a><?php
                            } else {
                                ?><a class="ui green button">Peut Commencer</a><?php
                            }
                        }
                        
                        
                    } else {
                        ?><a class="ui button" href="#">Tous les membres doivent avoir accepter pour commencer</a><?php
                    }
                    
                }
                ?>    
                </center></div>
            </div>
        </div>
    </div>


    <div class="container mt-3 col-md-4">
        <div class="container">
            <h4>Retraits</h4>

            <div class="ui inverted segment">
                <div class="ui inverted relaxed divided list">
            <?php
            while ($b = $rst_rec->fetch(PDO::FETCH_OBJ)) {
                $id_us = $b->id_us;
                $dt_us = $r->select("SELECT * FROM users WHERE identifiant = '$id_us'")->fetch();
                
                    ?>
                        <div class="item">
                            <div class="content">
                                <div class="header"><?php echo $dt_us->nom_compte." - <b>".$b->smm." XAF</b>"; ?></div>
                                <?php echo $b->dt; ?>
                            </div>
                        </div>
                    <?php   
            }
            ?>
                </div>
            </div>
        </div>

    </div>
</div>
