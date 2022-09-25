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
$id_grp = $_GET['rst_ajt'];
$dt_grp = $r->s_a_s_a_w("ristourne", "id_grp", $id_grp)->fetch(); 
#on affiche les utilisateur conforme à etre dans le groupe
$all_us = $r->s_a_s_a_w("users", "typ", $typ);
?>
<div class="container mt-3"><center><h2 class="ui header">AJOUTER DES MEMBRES DANS LE GROUPE</h2></center></div>
<div class="container mt-3"><center><h2 class="ui header"><?php echo $dt_grp->nom;?></h2></center></div>

<div class="container mt-3">
    <div class="ui middle aligned divided list">
    
    <?php
    while ($a = $all_us->fetch(PDO::FETCH_OBJ)) {
        if ($a->identifiant == $idUs) {} 
        else {
        $vrf_grp = $r->verifie("ristourne_mbr", "id_us", "id_grp", $a->identifiant, $id_grp);
        ?>
        <div class="item">
            <div class="right floated content">
            <?php
        if ($vrf_grp->rowCount() == 0) {
            
            ?>
                <a class="ui blue button" href="?rst_ajt=<?php echo $a->identifiant; ?>&rst_grp=<?php echo $id_grp; ?>">Ajouter</a>
            <?php
        } else {
            $v = $vrf_grp->fetch();
            if ($v->statut == 0) {
                ?><a class="ui button" href="#">Envoyé</a><?php
            }elseif ($v->statut == 1) {
                ?><a class="ui button" href="#">Membre</a><?php
            }elseif ($v->statut == 2) {
                ?><a class="ui red button" href="#">Refusé</a><?php
            }
        }
        ?>
            </div>
            <div class="content"><?php echo $a->nom_compte; ?></div>
        </div>
    <?php      
        }
    }
    ?>
    </div>
    <div class="ui middle aligned divided list">
        <div class="item">
            <div class="right floated content">
            <a class="ui green button" href="?f=rst_grp&rst_grp=<?php echo $id_grp;?>">OK</a>
            </div>
            <div class="content">
            
            </div>
        </div>
    </div>
</div>