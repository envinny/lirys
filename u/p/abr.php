<!-- lentête -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#06AE31;border-top:2px solid #fff;">
    <div class="container-fluid row">
        <div class="container col-3"><center>
            <a style="color:#fff;" class="nav-link active" aria-current="page" href="?f=epn"><i class="cloud upload icon" id="icon_pro"></i>EPARGNE</a>
        </div></center>
        <div class="container col-3"><center>
            <a style="color:#fff;" class="nav-link active ui button" aria-current="page" href=""><i class="sitemap icon" id="icon_pro"></i> RESEAU</a>
        </div></center>
        <div class="container col-3"><center>
            <a style="color:#fff;" class="nav-link active" aria-current="page" href="?f=rst"><i class="sync alternate icon" id="icon_pro"></i> RISTOURNE</a>
        </div></center>
        <div class="container col-3"><center>
            <a style="color:#fff;" class="nav-link active" aria-current="page" href="?f=cdl"><i class="clipboard icon" id="icon_pro"></i> CARNET DE LOYER</a>
        </div></center>
    </div>
</nav>
<?php

?>

<div class="container mt-3">
    
	<div class="container d-flex">
            <div class="container">
            <button class="ui active button"><?php echo $smm_cm; ?> XAF</button>
			
            <?php
            if ($com_rso->fetch() == null) {
                ?>
                <a class="ui blue button" href="?com_rec"><i class="cloud download icon" id="icon_pro"></i> Récupérer</a>
                <?php
            } else {
                $smm_rec = $com_rso->fetch()->smm;
                ?>
                <label class="ui button"><i class="cloud download icon" id="icon_pro"></i> Retrait de <b><?php echo $smm_rec; ?></b> XAF en attente</label>
                <?php
            }
            
            ?>
            </div>
            
    </div>
			<!-- organigramme -->
			<div class="">
				<!-- organigramme -->
				<div id="div_mon_r" class="container">
					<u><b> MON RESEAUX</b></u><br>
					<?php 
					echo $n1->rowCount()+$n2->rowCount()+$n3->rowCount()+$n4->rowCount();
					?>
					membres dans votre réseau <br>
					<?php 
					echo "<b>Vos commissions ".$smm_cm. " XAF</b>";
					?>
				</div>
				<div id="legend_org">Organigramme</div>
				<div class="container" id="div_organigramme" style="overflow: scroll;">
					<center><fieldset style="">
						<div id="div_org" style="">
							<?php  
							while ($a=$n1->fetch(PDO::FETCH_OBJ)) {
								$code_n1 = $a->identifiant;
								#on prend les enfants de son enfant
								#pour cest le nivo 2
								$n2_0=$r->select("SELECT * FROM users WHERE parrain='$code_n1'AND identifiant != 'vide'");
								?>
								<div id="div_n1">
									<center><span id="span_1"><label id="l_users_1"> <?php echo $a->nom; ?></label></span><br>

										<?php  
										#pour le niveau deux
										while ($b=$n2_0->fetch(PDO::FETCH_OBJ)) {
											$code_n2 = $b->identifiant;
											$n3_0 = $r->select("SELECT * FROM users WHERE parrain='$code_n2'AND identifiant != 'vide'");
											?>
											<div id="div_n2">
												<span id="span_2"><label id="l_users_1"><?php echo $b->nom; ?></label></span><br>

												<?php  
												#pour le niveau trois
												while ($c=$n3_0->fetch(PDO::FETCH_OBJ)) {
													$code_n3 = $c->identifiant;
													$n4_0=$r->select("SELECT * FROM users WHERE parrain='$code_n3'AND identifiant != 'vide'");
													?>
													<div id="div_n3">
														<span id="span_3"><label id="l_users_1"><?php echo $c->nom; ?></label></span><br>


														<?php  
														#pour le niveau quatre
														while ($d=$n4_0->fetch(PDO::FETCH_OBJ)) {
															?>
															<div id="div_n4">
																<span id="span_4"><label id="l_users_1"><?php echo $d->nom; ?></label></span>
															</div>
															<?php
														}

														?>
													</div>
													<?php
												}

												?>

											</div>
											<?php
										}

										?>
									</center>
								</div>
								<?php
							}


							?>
										
						</div>
					</fieldset></center>
				</div>
			</div>
</div>

<div id="div_mon_r" class="container">
			<u><b> MON EQUIPE</b></u><br>
		</div>
		<div class="container" style="overflow-y: scroll; height: 500px;overflow-x: scroll;">
			<table id="table_membre">
				<tr style="">
					<th class="th_membre">
						Date d'inscription
					</th>
					<th class="th_membre">
						ID parrain
					</th>
					<th class="th_membre">
						ID
					</th>
					<th class="th_membre">
						Nom et Prénom
					</th>
					<th class="th_membre">
						Téléphone
					</th>
				</tr>
				<?php  
				while ($e=$all_m->fetch(PDO::FETCH_OBJ)) {
					?>
					<tr id="tr_membre">
						<td id='td_membre' style="border-top-left-radius: 25px;border-bottom-left-radius: 25px;">
							<?php echo $e->dat; ?>
						</td>
						<td id='td_membre'>
							<?php echo $e->parrain; ?>
						</td>
						<td id='td_membre'>
							<?php echo $e->identifiant; ?>
						</td>
						<td id='td_membre' style="text-align: center;"><a href="#" style="" id="a_mmbre">
							<?php echo ucwords($e->nom)." ".ucwords($e->prenom); ?>
						</a></td>
						<td id='td_membre' style="border-top-right-radius: 25px;border-bottom-right-radius: 25px;">
							<?php echo $e->phone; ?>
						</td>
					</tr>
					<?php
				}

				?>
			</table>
			<?php  
			// echo $all_m->rowCount();
			?>
		</div>
<style>
    
/*pour lorganigramme*/
#div_organigramme{
	background-color: #ECEFF1;
	border: 1px solid #CFD8DC;
}
#div_org{
	display: inline-block;
	border: none; 
	/*width: 1000px; */
	overflow: hidden; white-space: nowrap; vertical-align: top;
}
#div_n1{
	border: 2px dotted #CFD8DC; width: 1250px; vertical-align: top;
	text-align: center;
	display: inline-block;
}
#div_n2{
	/*border: 2px dashed #B0BEC5; */
	border: 2px dashed #B0BEC5;
	vertical-align: top; width: 400px;
	display: inline-block;
}
#div_n3{
	border: 3px double #90A4AE; width: 125px; vertical-align: top;
	display: inline-block;
}
#div_n4{
	width: 33px; vertical-align: top;
	display: inline-block;
}
#span_1, #span_2, #span_3,#span_4{
	display: inline-block;
	height: 100px;
}
#span_1{
	width: 25px;
	border: 2px solid #EF9A9A;
	display: inline-block;
	margin-bottom: 1%;
}
#span_2{
	border: 2px solid #FFCC80;
	display: inline-block;
	width: 24px;
	margin-bottom: 1%;
}
#span_3{
		border: 2px solid #FFF59D;
		width: 100%;
		display: inline-block;
		width: 24px;
	margin-bottom: 1%;
}
	#span_4{
		border: 2px solid #A5D6A7;
		width: 100%;
		display: inline-block;
		width: 24px;
	margin-bottom: 1%;
	}
#l_users_1{

	writing-mode: vertical-lr;
	/*writing-mode: vertical-rl;*/
	text-align: center;
}
#div_mon_r{
	/* border: 1px solid #629024; */
	/* box-shadow: 0px 0px 2px #629024; */
	color: #629024;
	font-size: 16px;
	text-align: center;
	padding: 1% 0%;
	margin-top: 2%;
}
#legend_org{
	background-color: #629024;
	text-align: center;
	font-size: 20px;
	font-weight: bolder;
	color: #fff;
	width: 100%;
}
#table_membre{
	width: 100%;
	border: 1px solid #CFD8DC;
	border-radius: 10px;
}
#tr_membre{
	/* border: 1px solid #90A4AE; */
	box-shadow: 0px -5px 0px #90A4AE;
	/* border-radius: 5px; */
}
.th_membre{
	padding: 2% 0%;
}
#td_membre{
	padding: 1%;
	margin-bottom: 2%;
}
#a_mmbre{
	background: #fff;padding: 1%;width: 100%;display: inline-block;
	/* border-radius: 25px; */
	text-align: center;
	border: 1px solid #629024;
	color: #629024;
	font-weight: bold;
	
}
#input_txt{
	margin-bottom: 1%;
	width: 75%;
	font-weight: bold;
	border-radius: 10px;
	background-color: #E0E0E0;
	padding: 2%;
	height: 100px;
	resize: none;
	font-size: 16px;
	color: #607D8B;
	border: none;
	box-shadow: 0px 0px 2px #ECEFF1;
}
#div_msg{
	/*border: 1px solid black;*/
}
</style>