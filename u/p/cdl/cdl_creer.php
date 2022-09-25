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
if (isset($_POST['btn_cree_cdl'])) {
    
    $id_clt_cdl = $_POST['id_clt_cdl'];
    $adresse_clt_cdl = $_POST['adresse_clt_cdl'];
    $dsc_clt_cdl = $_POST['dsc_clt_cdl'];
    $prix_clt_cdl = intval($_POST['prix_clt_cdl']);
    $id_grp = $alea->alea_2();
    if (!empty($id_clt_cdl) AND !empty($adresse_clt_cdl) AND !empty($dsc_clt_cdl) AND !empty($prix_clt_cdl)) {
        if (is_numeric($prix_clt_cdl)) {
            #on vérifie si lutilisateur existe
            $vr_us = $r->s_a_s_a_w("users", "identifiant", $id_clt_cdl);
            if ($vr_us->rowCount() !== 0 || $id_clt_cdl !== $idUs) {
                
                $r->insert("INSERT INTO cdl(id_cdl, id_us, id_lct, dsc, adr, smm) VALUES(?, ?, ?, ?, ?, ?)", array($id_grp, $idUs, $id_clt_cdl, $dsc_clt_cdl, $adresse_clt_cdl, $prix_clt_cdl));
                $txt = "Un carnet de loyer a été créé en votre identifiant";
                $r->insert("INSERT INTO notif(id_dest, typ, txt, dt) VALUES(?, ?, ?, ?)", array($id_clt_cdl, 5, $txt, $d));
                
                ?>
                <script type="text/javascript">
                    document.location.replace('index.php?f=cdl');
                </script>
                <?php
            } else { $err = "L'utilisateur entré n'existe pas"; }

        } else {$err = "La valeur du montant est invalide";}
        
    } else {$err = "Veuillez remplir tous les champs";}
}

?>
<div class="container mt-3"><center><h2 class="ui header">CREER UNE CARNET DE LOYER</h2></center></div>
<div class="container">
    <div class="ui green segment">
        <div class="container alert-danger"><?php if (isset($err)) { echo $err; }?> </div>
        <form action="" method="post" name="frm_creer_rst">
            <div class="ui green form">
                <div class="two fields">
                    <div class="field">
                        <label>identifiant du client</label>
                        <input placeholder="Identifiant du client" type="text" name="id_clt_cdl">
                    </div>
                    <div class="field">
                        <label>Adresse</label>
                        <input placeholder="Adresse" type="text" name="adresse_clt_cdl">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>Description</label>
                        <textarea id="" cols="30" rows="10" style="resize:none;" name="dsc_clt_cdl"></textarea>
                    </div>
                    <div class="field">
                        <label>Prix</label>
                        <input placeholder="25000" type="number" name="prix_clt_cdl">
                    </div>
                </div>
                <div class="container p-0"><button class="ui submit button" name="btn_cree_cdl">Créer</button> </div>
            </div>
        </form>
    </div>
</div>