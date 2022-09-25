
		<!-- ajouter un fieu -->
		<div style="" id="div_ins_00" class="container">
			<center>
			<label id="l_ins">AJOUTER UN FIEU</label><br>
			<label id="l_ins_0"><b style="color: #F44336;cursor: pointer;" class="l_ins_err"></b></label></center><br>
			<form class="form_ins_normal" method="post">
				
				<select name="cat_ins" id="input_txt_ins">
					<option value="SP">SP</option>
					<option value="L1">L1</option>
					<option value="L2">L2</option>
					<option value="L3">L3</option>
					<option value="L4">L4</option>
					<option value="L5">L5</option>
				</select>
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
				<input maxlength="8" class="mdp_1_ins" type="password" name="mdp_1_ins" id="select_ins" placeholder="Mot de passe"><button id="select_ins" style="background-color: #629024;color: #fff;font-weight: bolder;text-align: center;" name="btn_ajt_fieu">Ajouter</button><br>
				<input maxlength="8" class="mdp_2_ins" type="password" name="mdp_2_ins" id="select_ins" placeholder="Confimer mot de passe">
				<a href="index.php"><span class="btn_dc" id="select_ins" style="background-color: #629024;color: #fff;font-weight: bolder;text-align: center;margin-top: 10%;">Retour</span></a><br>
			</form>
		</div>