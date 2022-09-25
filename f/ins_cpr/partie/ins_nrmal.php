<script>
	$(document).ready(function(){
		var cat_ins = $('.cat_ins').val();	
		$(".cat_ins").change(function(){
			// alert($('.cat_ins').val());
			if ($('.cat_ins').val() == "SP"){
				$('.l_frais').html("1 250 XAF");
			}else if($('.cat_ins').val() == "L1"){
				
				$('.l_frais').html("2 000 XAF");
			}else if($('.cat_ins').val() == "L2"){
				$('.l_frais').html("4 000 XAF");
			}else if($('.cat_ins').val() == "L3"){
				$('.l_frais').html("6 000 XAF");
			}else if($('.cat_ins').val() == "L4"){
				$('.l_frais').html("8 000 XAF");
			}else if($('.cat_ins').val() == "L5"){
				$('.l_frais').html("10 000 XAF");
			}
		})	
	})
</script>
		<!-- ajouter un fieu -->
		<div style="" id="" class="container p-3">
			<center>
			<a href="/lirys" style="color: #212121;text-decoration:none;"><h3><img src="images/logo.png" id="img_logo_ins" style="width:40px;"> LirYs</h3></a><br>
			<label id="l_ins_ins">CREEZ VOTRE RESEAU</label><br>
			<label id="l_ins_0"><b style="color: #F44336;cursor: pointer;" class="l_ins_err"></b></label></center><br>
		<div class="container alert-danger rounded-3 m-3">
		<?php
        // include "partie/ins.php";
        include "php/ins.php";
        
        ?>  	
		</div>
			<form class="" method="post">
				
				<select name="cat_ins" id="input_txt_ins" class="cat_ins">
					<option value="SP">SP</option>
					<option value="L1">L1</option>
					<option value="L2">L2</option>
					<option value="L3">L3</option>
					<option value="L4">L4</option>
					<option value="L5">L5</option>
				</select>
				<div class="ui green button">Frais d'inscription <label for="" class="l_frais">1 250 XAF</label></div>
				<input class="nom_ins" type="text" name="nom_ins" placeholder="Nom(s)"  id="input_txt_ins"><br>
				<input class="prenom_ins" type="text" name="prenom_ins" placeholder="Prénom(s)"  id="input_txt_ins"><br>
				<input class="phone_ins" type="phone" name="phone_ins" placeholder="Téléphone"  id="input_txt_ins" maxlength="9"><br>
				<input class="email_ins" type="mail" name="email_ins" placeholder="Email"  id="input_txt_ins"><br>
				<input class="pseudo_ins" type="text" name="pseudo_ins" placeholder="Nom du compte"  id="input_txt_ins" maxlength="10"><br>
				<select class="ville_ins" id="select_ins" name="ville_ins">
					<option value="Brazzaville">Brazzaville</option>
					<option value="Pointe-Noire">Pointe-Noire</option>
					<option value="Dolisie">Dolisie</option>
					<option value="Nkayi">Nkayi</option>
					<option value="Owando">Owando</option>
				</select>
				<input class="adresse_ins" type="text" name="adresse_ins" id="select_ins" placeholder="Adresse"><br>
				<input maxlength="8" class="mdp_1_ins" type="password" name="mdp_1_ins" id="select_ins" placeholder="Mot de passe"><button id="select_ins" style="background-color: #629024;color: #fff;font-weight: bolder;text-align: center;" name="btn_ajt_fieu">S'inscrire</button><br>
				<input maxlength="8" class="mdp_2_ins" type="password" name="mdp_2_ins" id="select_ins" placeholder="Confimer mot de passe">
			</form>
		</div>