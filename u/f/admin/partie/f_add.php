
	<div id="div_ins_00" style="" class="container">
			<center>
			<label id="l_ins">INFO INSCRIPTION</label>
			</center><br><br><br>
			<?php 
			echo "Vous avez ajouté : <b><u>". ucwords(utf8_encode($f_date->nom))." ".ucwords(utf8_encode($f_date->prenom))."</u></b> <br><br><u style='color: #F44336;'>Information d'Inscription</u><br>
				<table id='table_fadd'>
					<tr>
						<td id='td_fadd'>Nom de compte</td>
						<td id='td_fadd'>:".utf8_encode($f_date->nom_compte)." </td>
					</tr>
					<tr>
						<td id='td_fadd'>Email</td>
						<td id='td_fadd'>:".$f_date->email." </td>
					</tr>
					<tr>
						<td id='td_fadd'>Adresse</td>
						<td id='td_fadd'>:".utf8_encode($f_date->adresse)." </td>
					</tr>
					<tr>
						<td id='td_fadd'>Mot de passe</td>
						<td id='td_fadd'>:".$f_date->mdp." </td>
					</tr>
					<tr>
						<td id='td_fadd'>Code d'identification ou identifiant</td>
						<td id='td_fadd'>:".$f_date->identifiant." </td>
					</tr>
					<tr>
						<td id='td_fadd'>Code pay</td>
						<td id='td_fadd'>:".$f_date->cp." </td>
					</tr>
				</table>";
			?>
			<br><br>
				<center>
					<a href="index.php"><span class="btn_dc" id="select_ins" style="background-color: #629024;color: #fff;font-weight: bolder;text-align: center;margin-top: 10%;">Retour</span></a>
				</center><br>
	</div>