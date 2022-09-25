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
if (isset($_POST['btn_cree_rst'])) {
    
    $nom = $_POST['nom_cree_rst'];
    $smm = intval($_POST['smm_cree_rst']);
    $id_grp = $alea->alea_2();
    if (!empty($nom) AND !empty($smm)) {
        if (is_numeric($smm)) {
            $typ = $dataUs->typ;
            if ($typ == "SP") {
                $err = "Vous ne pouvez pas faire de ristourne avec un compte simple épargne";
            }elseif ($typ == "L1") {
                if ($smm >= 1000 AND $smm <= 20000) { $smm = $smm;} 
                else { $err = "Pour les comptes ".$typ." les ristournes vont de 1000 XAF à 20 000 XAF"; }
            }elseif ($typ == "L2") {
                if ($smm >= 21000 AND $smm <= 40000) { $smm = $smm; } 
                else {$err = "Pour les comptes ".$typ." les ristournes vont de 21 000 XAF à 40 000 XAF";}
            }elseif ($typ == "L3") {
                if ($smm >= 41000 AND $smm <= 60000) { $smm = $smm; } 
                else {$err = "Pour les comptes ".$typ." les ristournes vont de 41 000 XAF à 80 000 XAF";}
            }elseif ($typ == "L4") {
                if ($smm >= 61000 AND $smm <= 80000) {$smm = $smm;} 
                else {$err = "Pour les comptes ".$typ." les ristournes vont de 61 000 XAF à 80 000 XAF";}
            }elseif ($typ == "L5") {
                if ($smm >= 81000 AND $smm <= 100000) {$smm = $smm;} 
                else {$err = "Pour les comptes ".$typ." les ristournes vont de 81 000 XAF à 100 000 XAF";}
            }
            if (!isset($err)) {
                $r->insert("INSERT INTO ristourne(id_grp, id_us, nom, smm, dt) VALUES(?, ?, ?, ?, ?)", array($id_grp, $idUs, $nom, $smm, $d));
                $r->insert("INSERT INTO ristourne_mbr(id_us, id_grp, statut) VALUES(?, ?, ?)", array($idUs, $id_grp, 1));
                
                ?>
                <script type="text/javascript">
                    document.location.replace('index.php?f=rst_ajt&rst_ajt=<?php echo $id_grp; ?>');
                </script>
                <?php
            }
            
        } else {$err = "La valeur du montant est invalide";}
        
    } else {$err = "Veuillez remplir tous les champs";}
}

?>
<div class="container mt-3"><center><h2 class="ui header">CREER UN GROUPE DE RISTOURNE</h2></center></div>
<div class="container">
    <div class="ui green segment">
        <div class="container alert-danger"><?php if (isset($err)) { echo $err; }?> </div>
        <form action="" method="post" name="frm_creer_rst">
            <div class="ui green form">
                <div class="three fields">
                    <div class="field">
                        <label>Nom du groupe</label>
                        <input placeholder="Nom du groupe" type="text" name="nom_cree_rst">
                    </div>
                    <div class="field">
                        <label>Montant à faire tourner</label>
                        <input placeholder="1000" type="number" name="smm_cree_rst">
                    </div>
                    <div class="field">
                        <label>Interval de jour</label>
                        <input placeholder="7" type="number" name="int_cree_rst">
                    </div>
                </div>
                <div class="container p-0"><button class="ui submit button" name="btn_cree_rst">Créer</button> </div>
            </div>
        </form>
    </div>
</div>