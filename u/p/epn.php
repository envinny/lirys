<!-- lentête -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#06AE31;border-top:2px solid #fff;">
    <div class="container-fluid row">
        <div class="container col-3"><center>
            <a style="color:#fff;" class="nav-link active ui button" aria-current="page" href=""><i class="cloud upload icon" id="icon_pro"></i>EPARGNE</a>
        </div></center>
        <div class="container col-3"><center>
            <a style="color:#fff;" class="nav-link active" aria-current="page" href="?f=abr"><i class="sitemap icon" id="icon_pro"></i> RESEAU</a>
        </div></center>
        <div class="container col-3"><center>
            <a style="color:#fff;" class="nav-link active" aria-current="page" href="?f=rst"><i class="sync alternate icon" id="icon_pro"></i> RISTOURNE</a>
        </div></center>
        <div class="container col-3"><center>
            <a style="color:#fff;" class="nav-link active" aria-current="page" href="?f=cdl"><i class="clipboard icon" id="icon_pro"></i> CARNET DE LOYER</a>
        </div></center>
    </div>
</nav>
<script>
    
</script>
<!-- la fenetre des épargnes -->
<div class="container mt-3">
<center><h2 class="ui header"><i class="cloud upload icon" id="icon_pro"></i>EPARGNE</h2></center>
</div>
<div class="container mt-3 header">
    <h4>Epargnez en un clic</h4>
</div>
<div class="container mt-3">
    <div class="ui tag labels">
        <a class="ui label" href="?epn=1000">1000 XAF</a>
        <a class="ui label" href="?epn=2000">2000 XAF</a>
        <a class="ui label" href="?epn=4000">4000 XAF</a>
        <a class="ui label" href="?epn=8000">8000 XAF</a>
        <a class="ui label" href="?epn=16000">16000 XAF</a>
        <a class="ui label" href="?epn=32000">32000 XAF</a>
        <a class="ui label" href="?epn=64000">64000 XAF</a>
        <a class="ui label" href="?epn=128000">128000 XAF</a>
        <a class="ui label" href="?epn=256000">256000 XAF</a>
        <a class="ui label" href="?epn=512000">512000 XAF</a>
    </div>
</div>
<hr>
<div class="container mt-3">
    <label class="ui active button m-1"><?php echo $smm_ep; ?> XAF</label>
    <?php
    if ($epn_rec_att->rowCount() == 0) {
        ?>
    <a class="ui blue button m-1" href="?epn_rec"><i class="cloud download icon" id="icon_pro"></i> Récupérer</a>
        <?php
    } else {
        $smm_rec = $epn_rec_att->fetch()->smm;
        ?>
    <label class="ui button m-1"><i class="cloud download icon" id="icon_pro"></i> Retrait de <b><?php echo $smm_rec; ?></b> XAF en attente</label>
        <?php
    }    
    ?>
    <label for="" class="ui button m-1" id="epn_btn_att"><i class="history icon"></i>Dépot en attente</label>
    <label for="" class="ui button m-1" id="epn_btn_act"><i class="check icon"></i> Activitées</label>
    <label for="" class="ui button m-1" id="epn_btn_acp"><i class="money bill alternate icon"></i> Accepté</label>
    <label for="" class="ui button m-1" id="epn_btn_rfs"><i class="x icon icon"></i> Refusé</label>
        
</div>
<hr>

<div class="container mt-5">
    <div class="container" id="epn_dpo">
        <h3 class="ui header"><i class="history icon" id="icon_pro"></i>Dépot en attente</h3><hr>
        <div class="container">
            
        <?php
        while ($a = $epn_att->fetch(PDO::FETCH_OBJ)) {
            ?>
            <div class="ui middle aligned divided list">
                <div class="item">
                    <div class="content">
                        <div class="ui relaxed divided list">
                            <div class="item">
                                <i class="minus icon"></i>
                                <div class="content">
                                <a class="header"><?php echo $a->smm; ?> XAF</a>
                                <div class="description"><?php echo $a->dat; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php    
        }
        ?>
        </div>
    </div>
    <div class="container" id="epn_act">
        <h3 class="ui header"><i class="check icon" id="icon_pro"></i> Activitées</h3><hr>
        <div class="container">
        <?php
        while ($b = $epn_act->fetch(PDO::FETCH_OBJ)) {
            ?>
            <div class="ui middle aligned divided list" style="border: 1px solid <?php if ($b->statut == "1") {
                echo "green";
            } else {
                echo "red";
            }
             ?>">
                <div class="item">
                    <div class="content">
                        <div class="ui relaxed divided list">
                            <div class="item">
                                <i class="minus icon"></i>  
                                <div class="content">
                                <a class="header"><?php echo $b->smm; ?> XAF</a>
                                <div class="description"><?php echo $b->dat; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php    
        }
        ?>
        </div>
    </div>
    <div class="container" id="epn_rfs">
        <h3 class="ui header"><i class="x icon icon" id="icon_pro"></i> Refusé</h3><hr>
        <div class="container">
        <?php
        while ($d = $epn_rec_rfs->fetch(PDO::FETCH_OBJ)) {
            ?>
            <div class="ui middle aligned divided list" style="border: 1px solid red">
                <div class="item">
                    <div class="content">
                        <div class="ui relaxed divided list">
                            <div class="item">
                                <i class="minus icon"></i>  
                                <div class="content">
                                <a class="header"><?php echo $d->smm; ?> XAF</a>
                                <div class="description"><?php echo $d->dat; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php    
        }
        ?>
        </div>
    </div>
    <div class="container" id="epn_acp">
        <h3 class="ui header"><i class="money bill alternate icon" id="icon_pro"></i> Accepté</h3><hr>
        <div class="container">
        <?php
        while ($e = $epn_rec_act->fetch(PDO::FETCH_OBJ)) {
            ?>
            <div class="ui middle aligned divided list" style="border: 1px solid green">
                <div class="item">
                    <div class="content">
                        <div class="ui relaxed divided list">
                            <div class="item">
                                <i class="minus icon"></i>  
                                <div class="content">
                                <a class="header"><?php echo $e->smm; ?> XAF</a>
                                <div class="description"><?php echo $e->dat; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php    
        }
        ?>
        </div>
    </div>
</div>