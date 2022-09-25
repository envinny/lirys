
<style>
#div_ins{
	z-index: 1000;
	background-color: #fff;
}
</style>
<?php  
if (isset($_SESSION['ins_nrml'])) {
	?>
	<div id="div_ins" style="width: 100%; left: 0%; height: 100%; padding-top: 5%;padding-bottom: 5%;" class="div_ins_info">
		<div style="" id="div_ins_ins">
			<center><br>
			<label id="l_ins_ins">INSCRIPTION REUSSIT</label>
			</center><br><br><br>
			<label id="l_ins_0" style="font-weight: normal;">
			<?php 
			$data_users = $_SESSION['ins_nrml'];
			echo "<u>". ucwords($data_users[1])." ".ucwords($data_users[2])."</u> votre compte a bien été créé et activé <br><br><u style='color: #F44336;'>Information d'Inscription</u><br>
				<table style='width: 100%;'>
					<tr>
						<td>Nom de compte</td>
						<td style='width: 50%;padding-left:2%;'>:".$data_users[3]." </td>
					</tr>
					<tr>
						<td>Mot de passe</td>
						<td style='width: 50%;padding-left:2%;'>:".$data_users[4]." </td>
					</tr>
					<tr>
						<td>Code d'identification ou identifiant</td>
						<td style='width: 50%;padding-left:2%;'>:".$data_users[0]." </td>
					</tr>
					<tr>
						<td>Code pay</td>
						<td style='width: 50%;padding-left:2%;'>:".$data_users[5]." </td>
					</tr>
				</table>";
			?>
			<br><br><u style="color: #F44336;">NB </u>: Vos identifiants sont personnels</label>
			<form class="" method="post">
				<input type="hidden" name="red_ins" value="<?php echo $data_users[5]; ?>">
				<center>
					<!-- <a name="btn_cmcer_ins" id="select_ins" style="background-color: #629024;color: #fff;font-weight: bolder;text-align: center;margin-top: 10%;" href="/lirys/f/u">Commencer</a> -->
					<a href="../../deconnexion"><span class="btn_dc" id="select_ins" style="background-color: #629024;color: #fff;font-weight: bolder;text-align: center;margin-top: 10%;">OK</span></a>
				</center><br>
			</form>
		</div>
	</div>
	<?php
	
}

?>