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
            <a style="color:#fff;" class="nav-link active" aria-current="page" href="?f=rst"><i class="sync alternate icon" id="icon_pro"></i> RISTOURNE</a>
        </div></center>
        <div class="container col-3"><center>
            <a style="color:#fff;" class="nav-link active ui button" aria-current="page" href=""><i class="clipboard icon" id="icon_pro"></i> CARNET DE LOYER</a>
        </div></center>
    </div>
</nav>
<?php
$crn = $_GET['carnet'];
$dta_crn = $r->select("SELECT * FROM cdl WHERE id_cdl = '$crn'")->fetch();
$id_pro = $dta_crn->id_us;
$id_lct = $dta_crn->id_lct;

$dta_pro = $r->select("SELECT * FROM users WHERE identifiant = '$id_pro'")->fetch();
$dta_lct = $r->select("SELECT * FROM users WHERE identifiant = '$id_lct'")->fetch();

$stt_pai = $r->select("SELECT * FROM cdl_clt WHERE id_cdl = '$crn' AND statut = '0'");
$crn_pai = $r->select("SELECT * FROM cdl_clt WHERE id_cdl = '$crn' AND statut = '1'");
?>

<div class="container mt-3"><center><h2 class="ui header"><i class="clipboard icon" id="icon_pro"></i>CARNET DE LOYER</h2></center></div>
<div class="container">
    <div class="container">
        <hr>
        <label for="" class="" style="font-size:1.1em;"><?php echo $dta_crn->dsc." ".$dta_crn->adr." <b>".$dta_crn->smm." XAF</b>"; ?></label><hr>
    </div>
    
    <div class="container d-flex">
            <div class="container col-6">
                <h5><u><b>Bailleur</b></u></h5>
                <p>
                    <?php echo strtoupper($dta_pro->nom." ".$dta_pro->prenom); ?>
                </p>
            </div>
            <div class="container col-6">
                <h5><u><b>Locataire</b></u></h5>
                <p>
                    <?php echo strtoupper($dta_lct->nom." ".$dta_lct->prenom); ?>
                </p>
            </div>
    </div>
    <hr>
    

    <div class="container">
            <div class="container mb-3">
                
                <?php
                if ($id_pro == $idUs) {
                    
                    if ($stt_pai->rowCount()!==0) {
                        $sp_f = $stt_pai->fetch();
                        ?>
                            <a href="?cdl_act=<?php echo $sp_f->id_pai; ?>&act=1&id_crn=<?php echo $crn; ?>" class="ui blue button">Valider</a>
                            <a href="?cdl_act=<?php echo $sp_f->id_pai; ?>&act=2&id_crn=<?php echo $crn; ?>" class="ui red button">Refuser</a>
                        <?php
                    } else {
                        ?><a class="ui button">Aucun paiement</a><?php
                    }
                } else {

                    if ($stt_pai->rowCount()!==0) {
                        ?><a class="ui button">En attente de validation</a><?php
                    } else {
                        ?><a href="?cdl_pai=<?php echo $crn; ?>" class="ui blue button">PAYER</a><?php
                    }
                    
                    
                }
                 
                ?>
            </div>
    </div>
    <hr>
    <div class="container d-flex">

        <div class="container">
            <div class="container mb-3">
                <div class="container">
                    <h5>Paiement</h5>
                </div>
                
                <div class="container mt-2">
                    
                    <div class="ui inverted segment">
                        <div class="ui inverted relaxed divided list">
                    <?php
                    while ($a = $crn_pai->fetch(PDO::FETCH_OBJ)) {
                        
                            ?>
                                <div class="item">
                                    <div class="content">
                                        <div class="header">Loyer payé le :</div>
                                        <?php echo $a->dt; ?>
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

    </div>
</div>