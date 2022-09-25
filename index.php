<?php 
#overture de la session
session_start();
#inclusion des class
require_once 'extends_class/extends.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>LirYs</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		

		<link rel="stylesheet" href="style/Semantic-UI-master/dist/semantic.css">
		<link rel="stylesheet" href="style/fontawesome-free-6.1.1-web/css/all.css">
		<link rel="stylesheet" href="style/bootstrap-5.1.3/dist/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="style/style.css">
		<link rel="icon" type="image/icon" href="images\icn.png">
		<script src="script/jquery-3.3.1.min.js"></script>
	</head>
	<body class="homepage is-preload">
	<!-- <div id="back"></div> -->
	<?php require_once "f/partie/popup.php"; ?>
	
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header">

					<!-- Inner -->
						<div class="inner">
							<header>
								<h1><a href="index.html" id="logo">LirYs</a></h1>
								<hr />
								<p>Pour Un Futur Orienté Solution Là Où Tous Le Monde Gagne</p>
							</header>
							<footer>
							</footer>
						</div>

					<!-- Nav -->
					<style>
						
					</style>
						<nav id="nav">
							<ul>
								<li><a href="index.html">Accueil</a></li>
								<li><a href="#">A propos</a></li>
								<li><a href="#">Nos contacter</a></li>
								<li><a href="#">Confidentialité</a></li>
								<?php
								if (isset($_SESSION['u'])) {
								?><li><a href="/lirys/u">Mon Compte</a></li><?php	
								} else {
									?>
								
								<li><a href="/lirys/f/cnx">Connexion</a></li>
								<li><a href="/lirys/f/ins">Inscription</a></li>	
									<?php
								}
								
								
								
								?>
								
							</ul>
						</nav>

				</div>

			<!-- Banner -->
				<section id="banner">
					<header>
						<h2>Faites nous confiance <strong>pour la suite</strong>.</h2>
						<p>
							Plusieurs opportunité vous attend, gagnez en effectuant des activitées sur LirYs
						</p>
					</header>
				</section>

			<!-- Carousel -->
				<section class="carousel">
					<div class="reel"><center>

						<article class="rounded-3" style="box-shadow: 0px 0px 2px #212121;cursor:pointer;" id="btn_epn">
							<a class="image featured"><img src="images/epargne.png" alt="" /></a>
							<header>
								<h3><a>Epargne</a></h3>
							</header>
						</article>

						<article class="rounded-3" style="box-shadow: 0px 0px 2px #212121;cursor:pointer;" id="btn_rso">
							<a class="image featured"><img src="images/reseu.png" alt="" /></a>
							<header>
								<h3><a>Affiliation</a></h3>
							</header>
						</article>

						<article class="rounded-3" style="box-shadow: 0px 0px 2px #212121;cursor:pointer;" id="btn_rst">
							<a class="image featured"><img src="images/ristourne.png" alt="" /></a>
							<header>
								<h3><a>Likélémba </a></h3>
								<!-- (Tontine) -->
							</header>
						</article>

						<article class="rounded-3" style="box-shadow: 0px 0px 2px #212121;cursor:pointer;" id="btn_cdl">
							<a class="image featured"><img src="images/loyer.png" alt="" /></a>
							<header>
								<h3><a>Carnet de loyer</a></h3>
							</header>
						</article>

						</center></div>
				</section>

			<!-- Main -->
				<div class="wrapper style2">

					<article id="main" class="container special">
						<div class="container-fluid row">
							<div class="container col-md-6">
								<a href="#" class="image featured"><img src="images/3_.jpg" alt="" /></a>
							</div>
							<div class="container col-md-6">
								<header>
								<h2><a href="#">Quand un gagne c'est tous le monde qui gagne</a></h2>
								<p>
									LirYs vous offre une multitude possibilité afin d'accroitre vos chance de toujour gagner plus.
								</p>
								</header>
								<p>
									Choisissez le type de compte que vous voulez ouvrir. <br>
									Le type Simple épargne (SP)  vous permet d'effectuer des épargnes et gagner des commissions à chaque inscription, les frais d'inscriptions s'élévant à 1 250 FCFA.
									Le type LirYs 1 (L1), en plus des épargnes et gains en commissions, se type de compte vous donne la possibilité de faire des ristourne allant de 1 000 FCFA à 20 000 FCFA, les frais d'inscriptions s'élévant à 2 000 FCFA.
									Le type LirYs 2 (L2), est comme le précédent à la différence se type de compte vous donne la possibilité de faire des ristourne allant de 21 000 FCFA à 40 000 FCFA, les frais d'inscriptions s'élévant à 4 000 FCFA.
									Le L3 suie le même rithme, ristourne allant de 41 000 FCFA à 60 000 FCFA, les frais d'inscriptions s'élévant à 6 000 FCFA.
									L4, ristourne allant de 61 000 FCFA à 80 000 FCFA, les frais d'inscriptions s'élévant à 8 000 FCFA.
									L5, ristourne allant de 81 000 FCFA à 100 000 FCFA, les frais d'inscriptions s'élévant à 100 000 FCFA.
								</p>
								<footer>
									<p><center></center>Notez que pour chaque type de compte des opportunité sont disponibles</center></p>
									<a href="/lirys/f/ins" class="ui green button" id="span_ins">Commencer</a>
								</footer>
								
							</div>
						</div>
						
					</article>

				</div>

			<!-- Features -->
				<div class="wrapper style1">

					<section id="features" class="container special">
						<header>
							<h2>Nos partenaires</h2>
							<p>Ceux qui nous accompagnes dans la création d'un Futur Orienté Solution Là Où Tous Le Monde Gagne</p>
						</header>
						<div class="row">
							<article class="col-4 col-12-mobile special">
								<div class="container-fluid row">
									<div class="container col-6">
										<a href="#" class=""><img src="images/LogoFevilcoCercle-800x800.png" alt=""  style="" class="img-responsive"/></a>
									</div>
									<div class="container col-6">
										<header class="mt-3">
										<h3><a href="#">FEVILCO Sarl</a></h3>
										</header>
										<p>
											Qui nous apporte les opportunités qui font le bonheur des utilisateurs de LirYs
										</p>		
									</div>
								</div>
								
								
							</article>
							<article class="col-4 col-12-mobile special">
								<div class="container-fluid row">
									<div class="container col-6">
									<a href="#" class=""><img src="images/5_.jpg" alt="" style="width: 100%;"/></a>
									</div>
									<div class="container col-6">
											<header class="mt-3">
											<h3><a href="#">L'Assossiation des Etudiants de ISTP</a></h3>
										</header>
										<p>
											Qui se charge de la communication de nos activitées auprès du grand public.
										</p>		
									</div>
								</div>
								
								
							</article>
							<article class="col-4 col-12-mobile special">
								<div class="container-fluid row">
									<div class="container col-6">

										<a href="#" class=""><img src="images/deux-cercles-lun-dans-lautre.png" alt=""  style="width: 100%;"/></a>
									</div>
									<div class="container col-6">

										<header class="mt-3">
											<h3><a href="#">Charisma Chop</a></h3>
										</header>
										<p>
											Notre partenaire commercial, qui offre des acticles de bonne qualité à des prix abordable.
										</p>
									</div>
								</div>
							</article>
						</div>
					</section>

				</div>
				<div class="container-fluid row p-5">
					<div class="container col-md-6 col-sm-12">
						<div class="container"><h4>S'incrire à notre newsleter</h4></div>
						<div class="container">
							<form action="" method="post">
								<input type="email" name="" id="" class="form-control"><br>
								<button class="ui blue button">S'enregistrer</button>
							</form>
						</div>
					</div>
					<div class="container col-md-6 col-sm-12">
						<div class="container"><h4>Nous contacter</h4></div>
						<div class="container">
							<form action="" method="post">
								<input type="text" name="" id="" class="form-control" placeholder="Nom et prénom"><br>
								<input type="text" name="" id="" class="form-control" placeholder="Nom et prénom"><br>
								<input type="email" name="" id="" class="form-control" placeholder="email"><br>
								<textarea name="" id="" cols="30" rows="10" class="form-control" style="resize:none;" placeholder="Votre message"></textarea><br>
								<button class="ui blue button">Envoyer</button>
							</form>
						</div>
					</div>	
				</div>
			<!-- Footer -->
				<div id="footer">
					<div class="container">
						<div class="container-fluid row">
							<div class="contianer col-6">
								<!-- Contact -->
									<section class="contact">
										<header>
											<h3>Vous envoulez plus ?</h3>
										</header>
										<p>Suivez nous également sur les réseaux </p>
										<ul class="icons">
											<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
											<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
											<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
											<li><a href="#" class="icon brands fa-pinterest"><span class="label">Pinterest</span></a></li>
											<li><a href="#" class="icon brands fa-dribbble"><span class="label">Dribbble</span></a></li>
											<li><a href="#" class="icon brands fa-linkedin-in"><span class="label">Linkedin</span></a></li>
										</ul>
									</section>

								<!-- Copyright -->
									<div class="copyright">
										<ul class="menu">
											<li>&copy; ProstyCom. Tous droit réservé.</li>
										</ul>
									</div>
							</div>
							<div class="container col-6">
								<h3>Contact</h3>
								<i class="fa-solid fa-phone"></i> +242 06 810 91 91 <br>
								<i class="envelope icon"></i> contact@lirys.com <br>
								<i class="map icon"></i> 35 rue Madinguou, Mounguali - Brazzaville <br>
							</div>
						</div>
					</div>
				</div>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script type="text/javascript" src="script/jquery-3.3.1.min.js"></script>
			<script type="text/javascript" src="script/function.js"></script>

	</body>
</html>