<div class="container mt-3">
<h2 class="ui header">Votre Profil</h2>
</div>
<div class="container mt-3">
    <div class="ui list" style="font-size:1.1em;">
        <div class="item mb-3">
            <i class="user circle icon" id="icon_pro"></i>
            <div class="content">
            <?php echo strtoupper($dataUs->nom." ".$dataUs->prenom);?>
            </div>
        </div>
        <div class="item mb-3">
            <i class="id card icon" id="icon_pro"></i>
            <div class="content">
            <?php echo $dataUs->identifiant;?>
            </div>
        </div>
        <div class="item mb-3">
            <i class="barcode icon" id="icon_pro"></i>
            <div class="content">
            <?php echo $dataUs->cp;?>
            </div>
        </div>
        <div class="item mb-3">
            <i class="file outline icon" id="icon_pro"></i>
            <div class="content">
            <?php echo $dataUs->typ;?>
            </div>
        </div>
        <div class="item mb-3">
            <i class="phone icon" id="icon_pro"></i>
            <div class="content">
            <?php echo $dataUs->phone;?>
            </div>
        </div>
        <div class="item mb-3">
            <i class="envelope outline icon" id="icon_pro"></i>
            <div class="content">
            <?php echo $dataUs->email;?>
            </div>
        </div>
        <div class="item mb-3">
            <i class="user icon" id="icon_pro"></i>
            <div class="content">
            <?php echo $dataUs->nom_compte;?>
            </div>
        </div>
        <div class="item mb-3">
            <i class="marker icon" id="icon_pro"></i>
            <div class="content">
            <?php echo $dataUs->ville;?>
            </div>
        </div>
        <div class="item">
            <i class="marker icon" id="icon_pro"></i>
            <div class="content">
            <?php echo $dataUs->adresse;?>
            </div>
        </div>
    </div>
</div>
<?php
if ($pData->rowCount()!=0) {
    ?>
    
<div class="container mt-5">
    <h3>Parrain</h3>
    <p style="font-size:1.2em;"><?php echo $parrainData->nom." ".$parrainData->prenom." </br>".$dataUs->parrain;?></p>
</div>
    <?php
}
?>
