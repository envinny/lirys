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
        <div class="container col-2"><center>
            <a style="color:#fff;" class="nav-link active" aria-current="page" href="?f=cdl"><i class="clipboard icon" id="icon_pro"></i> CARNET DE LOYER</a>
        </div></center>
        <div class="container col-"><center>
            <a style="color:#fff;" class="nav-link active ui button" aria-current="page" href=""><i class="clipboard icon" id="icon_pro"></i> ACHAT EN LIGNE</a>
        </div></center>
    </div>
</nav>
<div class="container mt-3">
<center><h2 class="ui header"><i class="shopping cart icon" id="icon_pro"></i>CHOP</h2></center>
</div>
<hr>
<div class="container">
    <button class="ui active button"><?php echo $smm_cp; ?> XAF</button>
    <?php
    if ($com_chp->fetch() == null) {
    ?>
        <a class="ui blue button" href="?chp_rec"><i class="cloud download icon" id="icon_pro"></i> Récupérer</a>
    <?php
    } else {
        $smm_rec = $com_chp->fetch()->smm;
    ?>
        <label class="ui button"><i class="cloud download icon" id="icon_pro"></i> Retrait de <b><?php echo $smm_rec; ?></b> XAF en attente</label>
    <?php
    }
    ?>
    <label for="" class="ui button m-1" id="chp_btn_art"><i class="list icon"></i>Articles</label>
    <label for="" class="ui button m-1" id="chp_btn_att"><i class="history icon"></i>En attente</label>
    <label for="" class="ui button m-1" id="chp_btn_rfs"><i class="x icon icon"></i>En Refusé</label>        
    <label for="" class="ui button m-1" id="chp_btn_act"><i class="check icon"></i>Acheté</label>        
</div>
<hr>
<div class="container" style="">
    
    <div class="container mt-5">
        <div class="container" id="chp_art">
            <h3 class="ui header"><i class="list icon" id="icon_pro"></i>Article</h3><hr>
            <div class="container">
                
            <?php
            while ($a = $chop->fetch(PDO::FETCH_OBJ)) {
                ?>
                <div class="ui middle aligned divided list">
                    <div class="item">
                        <div class="content">
                            <div class="ui relaxed divided list">
                                <div class="item">
                                    <i class="minus icon"></i>
                                    <div class="content">
                                    <div class="description"><?php echo $a->typ; ?></div>
                                    <div class="description mb-3"><?php echo $a->dsc; ?></div>
                                    <a class="header"><?php echo $a->prix; ?> XAF</a>
                                    <div class="description mt-3"><a href="?chp=<?php echo $a->id; ?>" class="ui button">Acheter</a></div>
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
        <div class="container" id="chp_att">
            <h3 class="ui header"><i class="history icon" id="icon_pro"></i> En attente</h3><hr>
            <div class="container">
                
            <?php
            while ($b = $chop_att->fetch(PDO::FETCH_OBJ)) {
                $idArt = $b->id_art;
                $dataArt = $r->s_a_s_a_w("chop", "id", $idArt)->fetch();
                ?>
                <div class="ui middle aligned divided list">
                    <div class="item">
                        <div class="content">
                            <div class="ui relaxed divided list">
                                <div class="item">
                                    <i class="minus icon"></i>
                                    <div class="content">
                                    <div class="description"><?php echo $dataArt->typ; ?></div>
                                    <div class="description mb-3"><?php echo $dataArt->dsc; ?></div>
                                    <a class="header"><?php echo $dataArt->prix; ?> XAF</a>
                                    <div class="description mb-3"><?php echo $b->dat; ?></div>
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
        <div class="container" id="chp_rfs">
            <h3 class="ui header"><i class="x icon icon" id="icon_pro"></i> Refusé</h3><hr>
            <div class="container">
                
            <?php
            while ($d = $chop_rfs->fetch(PDO::FETCH_OBJ)) {
                $idArt = $d->id_art;
                $dataArt = $r->s_a_s_a_w("chop", "id", $idArt)->fetch();
                ?>
                <div class="ui middle aligned divided list">
                    <div class="item">
                        <div class="content">
                            <div class="ui relaxed divided list">
                                <div class="item">
                                    <i class="minus icon"></i>
                                    <div class="content">
                                    <div class="description"><?php echo $dataArt->typ; ?></div>
                                    <div class="description mb-3"><?php echo $dataArt->dsc; ?></div>
                                    <a class="header"><?php echo $dataArt->prix; ?> XAF</a>
                                    <div class="description mb-3"><?php echo $d->dat; ?></div>
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
        <div class="container" id="chp_act">
            <h3 class="ui header"><i class="check icon" id="icon_pro"></i> Acheté</h3><hr>
            <div class="container">
                
            <?php
            while ($d = $chop_act->fetch(PDO::FETCH_OBJ)) {
                $idArt = $d->id_art;
                $dataArt = $r->s_a_s_a_w("chop", "id", $idArt)->fetch();
                ?>
                <div class="ui middle aligned divided list">
                    <div class="item">
                        <div class="content">
                            <div class="ui relaxed divided list">
                                <div class="item">
                                    <i class="minus icon"></i>
                                    <div class="content">
                                    <div class="description"><?php echo $dataArt->typ; ?></div>
                                    <div class="description mb-3"><?php echo $dataArt->dsc; ?></div>
                                    <a class="header"><?php echo $dataArt->prix; ?> XAF</a>
                                    <div class="description mb-3"><?php echo $d->dat; ?></div>
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

</div>