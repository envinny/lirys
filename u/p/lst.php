<div class="container mt-3">
<center><h2 class="ui header"><i class="list alternate icon" style=""></i>VOS TRANSACTIONS</h2></center>
</div>
<div class="container">
    <div class="ui relaxed divided list">
        <?php
        while ($a = $ntf->fetch(PDO::FETCH_OBJ)) {
            ?>
        <div class="item">
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
                
                <?php echo $a->txt; ?>    
            </div>
            <div class="description"><?php echo $a->dt; ?></div>
            </div>
        </div>
            <?php    
        }
        
        ?>
    </div>
</div>