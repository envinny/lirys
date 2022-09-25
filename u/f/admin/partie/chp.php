<?php
#attente
$chp_att = $r->select("SELECT * FROM chop_achat WHERE statut='0' ORDER BY id DESC");
$epn_act = $r->select("SELECT * FROM epargne WHERE statut='1' OR statut='2'");
$rec_att = $r->select("SELECT * FROM epargne_rec WHERE statut='0'");
$rec_act = $r->select("SELECT * FROM epargne_rec WHERE statut='1' OR statut='2'");


?>
<div class="container mt-3">
<center><h2 class="ui header">CHOP</h2></center>

</div>
<div class="container d-flex mt-5 mb-5">
    <div class="container col-md-3">
        <h3 class="ui header"><i class="history icon" id="icon_pro"></i>Achat en attente</h3><hr>
        <div class="container">
        <?php
        while ($a = $chp_att->fetch(PDO::FETCH_OBJ)) {
            $idUsEpAt = $a->id_us;
            $usDtaEpA = $r->s_a_s_a_w("users", "identifiant", $idUsEpAt)->fetch();

            $idArt = $a->id_art;
            $dataArt = $r->s_a_s_a_w("chop", "id", $idArt)->fetch();
            ?>
            <div class="ui middle aligned divided list">
                <div class="item">
                    <div class="content">
                        <div class="ui relaxed divided list">
                            <div class="item">
                                <i class="minus icon"></i>
                                <div class="content">
                                <a class="header"><?php echo ucwords($usDtaEpA->nom." ".$usDtaEpA->prenom); ?></a>
                                <div class="description"><?php echo $a->dat; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                        <div class="content">
                            <div class="ui relaxed divided list">
                                <div class="item">
                                    <i class="minus icon"></i>
                                    <div class="content">
                                    <div class="description"><?php echo $dataArt->typ; ?></div>
                                    <div class="description mb-3"><?php echo $dataArt->dsc; ?></div>
                                    <a class="header"><?php echo $dataArt->prix; ?> XAF</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="item" style="border:none;">
                    <div class="ui buttons">
                        <a class="ui positive button" href="?ach=<?php echo $a->id_art; ?>&act=1&ida=<?php echo $a->id; ?>">V</a>
                        <div class="or" data-text="ou"></div>
                        <a class="ui red button" href="?ach=<?php echo $a->id_art; ?>&act=2&ida=<?php echo $a->id; ?>">R</a>
                    </div>
                </div>
            </div>
            <?php    
        }
        ?>
        </div>
    </div>
    <div class="container col-md-3">
        <h3 class="ui header"><i class="check icon" id="icon_pro"></i> Activitées</h3><hr>
        <div class="container">
        <?php
        while ($b = $epn_act->fetch(PDO::FETCH_OBJ)) {
            $idUsEpAt = $b->id_us;
            $usDtaEpA = $r->s_a_s_a_w("users", "identifiant", $idUsEpAt)->fetch();
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
                                <a class="header"><?php echo ucwords($usDtaEpA->nom." ".$usDtaEpA->prenom); ?></a><?php echo $b->smm; ?> XAF
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
    <div class="container col-md-3">
        <h3 class="ui header"><i class="history icon" id="icon_pro"></i> Retrait en attente</h3><hr>
        <div class="container">
        <?php
        while ($c = $rec_att->fetch(PDO::FETCH_OBJ)) {
            $idUsEpAt = $c->id_us;
            $usDtaEpA = $r->s_a_s_a_w("users", "identifiant", $idUsEpAt)->fetch();
            ?>
            <div class="ui middle aligned divided list">
                <div class="item">
                    <div class="content">
                        <div class="ui relaxed divided list">
                            <div class="item">
                                <i class="minus icon"></i>
                                <div class="content">
                                <a class="header"><?php echo ucwords($usDtaEpA->nom." ".$usDtaEpA->prenom); ?></a><?php echo $c->smm; ?> XAF
                                <div class="description"><?php echo $c->dat; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item" style="border:none;">
                    <div class="ui buttons">
                        <a class="ui positive button" href="?rec=<?php echo $c->id; ?>&act=1">V</a>
                        <div class="or" data-text="ou"></div>
                        <a class="ui red button" href="?rec=<?php echo $c->id; ?>&act=2">R</a>
                    </div>
                </div>
            </div>
            <?php    
        }
        ?>
        </div>
    </div>
    <div class="container col-md-3">
        <h3 class="ui header"><i class="check icon" id="icon_pro"></i> Activitées</h3><hr>
        <div class="container">
        <?php
        while ($d = $rec_act->fetch(PDO::FETCH_OBJ)) {
            $idUsEpAt = $d->id_us;
            $usDtaEpA = $r->s_a_s_a_w("users", "identifiant", $idUsEpAt)->fetch();
            ?>
            <div class="ui middle aligned divided list" style="border: 1px solid <?php if ($d->statut == "1") {
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
                                <a class="header"><?php echo ucwords($usDtaEpA->nom." ".$usDtaEpA->prenom); ?></a><?php echo $d->smm; ?> XAF
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
</div>