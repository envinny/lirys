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
$ms_crn = $r->select("SELECT * FROM cdl WHERE id_us = '$idUs' OR id_lct = '$idUs'");
?>
<div class="container mt-3"><center><h2 class="ui header"><i class="clipboard icon" id="icon_pro"></i>CARNET DE LOYER</h2></center></div>
<div class="container">
    <div class="container p-3">
        <center><a class="ui active button" href="?f=cdl_creer"><i class="plus icon" id="icon_pro"></i>CREER</a></center>
    </div>
</div>
<div class="container">
    <div class="container">
        <div class="container mt-3">
            <div class="container mt-3 mb-3"><center><h3 class="ui header">VOS CARNETS</h3></center></div>
            <div class="container mb-5">

                <div class="ui middle aligned divided list"><center>
                <?php
                while ($c = $ms_crn->fetch(PDO::FETCH_OBJ)) {
                    ?>
                    <div class="item mb-3">
                        <div class="right floated content">
                        </div>
                        <a href="?f=carnet&carnet=<?php echo $c->id_cdl; ?>" class="ui button"><div class="content">
                        <?php echo $c->dsc.", ".$c->adr; ?><br>
                        <?php echo $c->smm; ?> XAF<br>
                        </div></a>
                    </div>
                    <?php    
                }
                ?>
                
                </center></div>
            </div>
        </div>
    </div>
</div>

