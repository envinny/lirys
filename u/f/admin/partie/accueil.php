
		<!-- profil -->
		<div class="container p-3" id="div_acul" style="background-color: #ECEFF1;">
				<!-- admin -->
				<div class="container col-md-3 col-sm-4 col-xs-12" id="div_admin" style="">
					<center>MON PROFIL</center> <br>
					<label id="l_txt">
						<?php  
						echo "NOM : ".strtoupper($admin_data->nom)."<br>Prénom :".ucwords($admin_data->prenom)."<br> Téléphone : ".$admin_data->phone."<br>Email :".$admin_data->email."<br><br><br>Niveau d'autorisation : ".ucwords($admin_data->nivo)."<br>Identifiant : ".$admin_data->identifiant."<br>"
						?>
					</label>
				</div>

				<!-- résumé tableau -->
				<div class="container col-md-6 col-sm-8 col-xs-12" id="div_rtb" style="">
					<div class="container d-flex row">
						<?php  
						if ($_SESSION['nivo']=='administrateur') {
							?>
							<div class="container col-md-6 col-sm-6 col-xs-6" style="padding: 0px;">
								<a href="?l_c"><div class="ui button" style="width: 100%;border:1px solid #fff;">Liberer</div></a>
							</div>
							<?php
						}
						?>
						<div class="container col-md-6 col-sm-6 col-xs-6" style="padding: 0px;">
							<a href="?add_fieu"><div class="ui button" style="width: 100%;border:1px solid #fff;">Enregistrer</div></a>
						</div>
					</div>
				</div>
		</div>
		<!-- derniere inscription -->
		<div class="container" style="margin-top: 4%;">
			<center><label id="l_ins_att">DERNIERES INSCRIPTIONS</label></center><br>
			<div class="container" id="div_table_ins_att">
				<table id="table_ins_att">
					<tr style="">
						<th style="padding: 3%;"><center>Date d'inscription</center></th>
						<th style="padding: 3%;"><center>ID Parrain</center></th>
						<th style="padding: 3%;"><center>Code pay</center></th>
						<th style="padding: 3%;"><center>ID</center></th>
						<th style="padding: 3%;"><center>Nom et Prénom</center></th>
						<th style="padding: 3%;"><center>Téléphone</center></th>
					</tr>
					<?php  
					while ($d=$dern_ins->fetch(PDO::FETCH_OBJ)) {
						?>
						<tr>
							<td style="padding: 1%;"><?php echo utf8_encode($d->dat); ?></td>
							<td style="padding: 1%;"><?php echo $d->parrain; ?></td>
							<td style="padding: 1%;"><?php echo $d->cp; ?></td>
							<td style="padding: 1%;"><?php echo $d->identifiant; ?></td>
							<td style="padding: 1%;"><?php echo strtoupper(utf8_encode($d->nom))." ".ucwords(utf8_encode($d->prenom)); ?></td>
							<td style="padding: 1%;"><?php echo $d->phone; ?></td>
						</tr>
						<?php
					}
					?>
				</table>
			</div>
		</div>
		<!-- code libéré non utilisé -->
		<?php  
		if ($_SESSION['nivo']=='administrateur') {
			?>
			<div class="container" style="margin-top: 4%;">
				<center><label id="l_ins_att">CODE LIBERE NON UTILISE</label></center><br>
				<div class="container" id="div_table_ins_att">
					<table id="table_ins_att">
						<tr>
							<th><center>Code</center></th>
							<th><center>Type</center></th>
							<th><center>Parrain</center></th>
						</tr>
						<?php  
						while ($e=$code_utl->fetch(PDO::FETCH_OBJ)) {
							?>
							<tr>
								<td style="padding: 1%;"><?php echo $e->cp; ?></td>
								<td style="padding: 1%;"><?php echo $e->typ; ?></td>
								<td style="padding: 1%;"><?php echo $e->parrain; ?></td>
							</tr>
							<?php
						}
						?>
					</table>
				</div>
			</div>
			<?php
		}
		?>
	</div>