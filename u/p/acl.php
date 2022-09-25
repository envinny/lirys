<div class="container m-3">
    <h3 class="header">
    <i class="certificate icon"></i> Bienvenue <b><?php echo ucwords($dataUs->nom);?></b>
    </h3>
</div>
<div class="container-fluid row">
    <div class="container-fluid col-md-6 mb-3">
        <div class=" row col-12 ui green segment">
            <div class="container col-8">
                <i class="users icon"></i><br>
                Membres dans votre réseau 
                <i class="exclamation circle icon"></i>
            </div>
            <div class="container col-4" style="text-align: center;font-size:1.5em;">
                <b><?php echo $n1->rowCount()+$n2->rowCount()+$n3->rowCount()+$n4->rowCount();?></b>
            </div>
        </div>
        <div class="row col-12 ui blue segment">
            <div class="container col-8">
                <i class="money bill alternate icon"></i><br>
                Vos commissions de fieu 
            </div>
            <div class="container col-4" style="text-align: center;font-size:1.5em;">
                <b><?php echo $smm_cm;?> XAF</b>
            </div>    
        </div>
        <div class="container">
            <h4>Dernier membre</h4>
            <div class="ui floating message">
                <?php 
                if ($all_m_acl->rowCount() !== 0) {
                    $a_dnr_mbr = $all_m_acl->fetch();
                    echo ucwords($a_dnr_mbr->nom.' '.$a_dnr_mbr->prenom)."<p>". utf8_encode($a_dnr_mbr->dat)."</p>";
                }
                ?>
            </div>
        </div>
    </div>
    <div class="container col-md-6 mb-3">
        <div class="container mb-3">
            <h3><i class="bell icon"></i>Dernières notifications</h3>
        </div>
        <div class="container">
                    
            <div class="ui relaxed divided list">
                <?php
                while ($a = $ntf_drn->fetch(PDO::FETCH_OBJ)) {
                    ?>
                <div class="item ui raised segment p-1">
                    <i class="minus square outline icon"></i>
                    <div class="content">
                    <a class="header">
                    <?php
                    if ($a->typ == 1) {
                        echo "Commission inscription";
                    }elseif ($a->typ == 2) {
                        echo "Epargne";
                    }elseif ($a->typ == 3) {
                        echo "Retrait";
                    }elseif ($a->typ == 4) {
                        echo "Demande d'adhésion groupe de ristourne";
                    }elseif ($a->typ == 5) {
                        echo "Carnet de départ";
                    }
                    
                    ?>    
                    </a>
                    <div class="header">
                        
                        <?php echo utf8_encode($a->txt); ?>    
                    </div>
                    <div class="description"><?php echo $a->dt; ?></div>
                    </div>
                </div>
                    <?php    
                }
                
                ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="container mb-3">
            <h4><i class="list icon"></i> Vos actions</h4>

        </div>
        <div class="container">
              
        <div class="ui relaxed divided list">
                <?php
                while ($b = $epn_rec_all->fetch(PDO::FETCH_OBJ)) {
                    ?>
                <div class="item ui raised segment p-1">
                    <i class="minus square outline icon"></i>
                    <div class="content">
                    <a class="header">
                    <?php
                    if ($b->typ == 2) {
                        echo "Retrait de commission inscription";
                    }elseif ($b->typ == 1) {
                        echo "Retrait d'épargne";
                    }
                    
                    ?>    
                    </a>
                    <div class="header">
                        
                        <?php echo $b->smm; ?> XAF    
                    </div>
                    <div class="description"><?php echo $b->dat; ?></div>
                    </div>
                </div>
                    <?php    
                }
                
                ?>
            </div>
        </div>
    </div>
</div>