
<!-- la fenetre des chat -->
<div class="container mt-3">
<center><h2 class="ui header"><i class="comments icon" id="icon_pro"></i>CHAT GENERAL</h2></center>
</div>
<div class="container p-5">
    <div class="container ui floating message" style="max-height : 500px;overflow-y:scroll;overflow-x:hidden;">
        <?php
        while ($a = $msg->fetch(PDO::FETCH_OBJ)) {
            $msgUs = $r->s_a_s_a_w("users", "identifiant", $a->id_post)->fetch()->nom_compte;

            if ($a->id_post == $idUs) {
                ?>
            <div class="ui green message" style="">
            
                <div class="content"><a class="header">Vous</a></div>
                <?php echo $a->texte;?>
                <div class="description"><?php echo $a->dat; ?></div>
            </div>
                <?php
            } else {
                ?>
                <div class="ui teal message" style="">
                <div class="content"><a class="header"><?php echo $msgUs; ?></a></div>
                    <?php echo $a->texte;?>
                    <div class="description"><?php echo $a->dat; ?></div>
                </div>
                <?php
            }
            
        }
        
        ?>
    </div>
    <div class="container">
        <form action="" method="post">
            <textarea name="msg" id="" cols="30" rows="5" style="resize:none;" class="form-control"></textarea><br>
            <button type="submit" class="ui blue button" name="btn_msg">Envoyer</button>
        </form>
    </div>
</div>