<div class="container mt-3">
<center><h2 class="ui header"><i class="calendar alternate icon" id="icon_pro"></i>EVENEMENT</h2></center>
</div>
<hr>
<div class="container mt-3">
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
            <label for="" class="ui button m-1" id="evn_btn_evn"><i class="list icon"></i>Evénements</label>
            <label for="" class="ui button m-1" id="evn_btn_att"><i class="history icon"></i>En attente</label>
            <label for="" class="ui button m-1" id="evn_btn_rfs"><i class="x icon icon"></i>En Refusé</label>        
            <label for="" class="ui button m-1" id="evn_btn_act"><i class="check icon"></i>Acheté</label>
        </div>
        <hr>
<div class="container">
    
    <div class="container mt-5">
        
        <div class="container" id="evn_evn">
            <h3 class="ui header"><i class="list icon" id="icon_pro"></i>Evénements</h3><hr>
            <div class="container">
                
            <?php
            while ($a = $even->fetch(PDO::FETCH_OBJ)) {
                ?>
                <div class="ui middle aligned divided list">
                    <div class="item">
                        <div class="content">
                            <div class="ui relaxed divided list">
                                <div class="item">
                                    <i class="minus icon"></i>
                                    <div class="content">
                                    <div class="description">TICKET</div>
                                    <div class="description mb-3"><?php echo $a->dsc; ?></div>
                                    <a class="header"><?php echo $a->prix; ?> XAF</a>
                                    <div class="description mt-3"><a href="?evn=<?php echo $a->id; ?>" class="ui button">Acheter</a></div>
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
        <div class="container" id="evn_att">
            <h3 class="ui header"><i class="history icon" id="icon_pro"></i> En attente</h3><hr>
            <div class="container">
                
            <?php
            while ($b = $chop_att->fetch(PDO::FETCH_OBJ)) {
                $idArt = $b->id_art;
                $dataArt = $r->s_a_s_a_w("chop", "id", $idArt)->fetch();
                if ($dataArt->typ == 'event') {
                    ?>
                    <div class="ui middle aligned divided list">
                        <div class="item">
                            <div class="content">
                                <div class="ui relaxed divided list">
                                    <div class="item">
                                        <i class="minus icon"></i>
                                        <div class="content">
                                        <div class="description">TICKET</div>
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
            }
            ?>
            </div>
        </div>
        <div class="container" id="evn_rfs">
            <h3 class="ui header"><i class="x icon icon" id="icon_pro"></i> Refusé</h3><hr>
            <div class="container">
                
            <?php
            while ($d = $chop_rfs->fetch(PDO::FETCH_OBJ)) {
                $idArt = $d->id_art;
                $dataArt = $r->s_a_s_a_w("chop", "id", $idArt)->fetch();
                if ($dataArt->typ == "event") {
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
            }
            ?>
            </div>
        </div>
        <div class="container" id="evn_act">
            <h3 class="ui header"><i class="check icon" id="icon_pro"></i> Acheté</h3><hr>
            <div class="container">
                
            <?php
            while ($d = $chop_act->fetch(PDO::FETCH_OBJ)) {
                $idArt = $d->id_art;
                $dataArt = $r->s_a_s_a_w("chop", "id", $idArt)->fetch();
                if ($dataArt->typ == 'event') {
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
            }
            ?>
            </div>
        </div>
    </div>

</div>