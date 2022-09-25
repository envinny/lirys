<style>
	.div_ins_normal, #div_ins_ins{		
		overflow: scroll;
		height : 100%;
	}
</style>
	<center><div id="div_ins" class="div_ins_normal" style="overflow: scroll;overflow-x: hidden;">
		<div style="" id="div_ins_ins">
			<center><a href="/lirys" style="color: #212121;text-decoration:none;"><h3><img src="images/logo.png" id="img_logo_ins" style="width:40px;"> LirYs</h3></a><br>
			<label id="l_ins_ins">INSCRIPTION</label><br>
			<label id="l_ins_0"><b style="color: #F44336;cursor: pointer;" class="l_ins_err"></b></label></center><br><br>
			<form class="form_ins_normal" method="post">
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
				<input maxlength="8" class="mdp_1_ins" type="password" name="mdp_1_ins" id="select_ins" placeholder="Mot de passe">
				<input maxlength="8" class="mdp_2_ins" type="password" name="mdp_2_ins" id="select_ins" placeholder="Confimer mot de passe"><br>
				<button id="select_ins" style="background-color: #629024;color: #fff;font-weight: bolder;text-align: center;">S'inscrire</button><br>
				<input class="hidden_ins" type="hidden" name="hidden_ins">
			</form>
		</div>
		<div id="div_ins_ins_0">
			<label id="l_ins_2">Vous avez déjà un compte ? <b><u> Connectez-vous →</u></b></label>
		</div>
	</div></center>