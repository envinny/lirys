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
$rst_dmd_att = $r->verifie("ristourne_mbr", "id_us", "statut", $idUs, 0);
$rst_grp_mbr = $r->verifie("ristourne_mbr", "id_us", "statut", $idUs, 1);
$vos_grp = $r->s_a_s_a_w("ristourne", "id_us", $idUs);
?>
<div class="container mt-3"><center><h2 class="ui header"><i class="sync alternate icon" id="icon_pro"></i>RISTOURNE</h2></center></div>
<div class="container">
<div class="container p-3">
    <center><a class="ui active button" href="?f=rst_creer"><i class="plus icon" id="icon_pro"></i>CREER</a></center>
</div>
</div>
<div class="container d-flex">
    <div class="container col-md-6">
        <div class="container mt-3">
            <div class="container mt-3 mb-3"><center><h3 class="ui header">RISTOURNE EN COUR</h3></center></div>
            <div class="container mb-5">

                <div class="ui middle aligned divided list">
                <?php
                while ($c = $rst_grp_mbr->fetch(PDO::FETCH_OBJ)) {
                    $c_data = $r->s_a_s_a_w("ristourne", "id_grp", $c->id_grp)->fetch();
                    ?>
                    <div class="item mb-3">
                        <div class="right floated content">
                        </div>
                        <a href="?f=rst_grp&rst_grp=<?php echo $c->id_grp; ?>" class="ui button"><div class="content">
                        
                            Nom du groupe : <?php echo $c_data->nom; ?><br>
                            Montant à tourner : <?php echo $c_data->smm; ?> XAF
                        </div></a>
                    </div>
                    <?php    
                }
                ?>
                </div>
            </div>
        </div>

        <div class="container mt-3">
            <div class="container mt-3 mb-3"><center><h3 class="ui header">VOS GROUPES</h3></center></div>
            
            <div class="container mb-3">

                <div class="ui middle aligned divided list">
                <?php
                while ($b = $vos_grp->fetch(PDO::FETCH_OBJ)) {
                    ?>
                    <div class="item mb-3">
                        <div class="right floated content">
                        </div>
                        <a href="?f=rst_grp&rst_grp=<?php echo $b->id_grp; ?>" class="ui button"><div class="content">
                        
                            Nom du groupe : <?php echo $b->nom; ?><br>
                            Montant à tourner : <?php echo $b->smm; ?> XAF
                        </div></a>
                    </div>
                    <?php    
                }
                ?>
                </div>
            </div>

        </div>
    </div>
    <div class="container col-md-6">
        <div class="container mt-3 mb-3"><center><h3 class="ui header">DEMANDE</h3></center></div>
        <div class="container">

            <div class="ui middle aligned divided list">
            <?php
            while ($a = $rst_dmd_att->fetch(PDO::FETCH_OBJ)) {
                $id_grp = $a->id_grp;
                $dt_grp = $r->s_a_s_a_w("ristourne", "id_grp", $id_grp)->fetch();
                $nm_grp = $dt_grp->nom;
                $sm_grp = $dt_grp->smm;
                $id_cre = $dt_grp->id_us;
                $nm_cre = $r->s_a_s_a_w("users", "identifiant", $id_cre)->fetch()->nom_compte;
                ?>
                <div class="item">
                    <div class="right floated content">
                    <a class="ui green button" href="?rst=<?php echo $id_grp; ?>&act=1">Rejoindre</a>
                    <a class="ui red button" href="?rst=<?php echo $id_grp; ?>&act=2">Refuser</a>
                    </div>
                    <div class="content">
                    
                        Nom du groupe : <?php echo $nm_grp; ?><br>
                        Crée par :  <?php echo $nm_cre; ?><br>
                        Montant à tourner : <?php echo $sm_grp; ?> XAF
                    </div>
                </div>
                <?php    
            }
            ?>
            </div>
        </div>
    </div>
</div>

