$(document).ready(function(){
	// $("#div_ins").fadeOut();
	$("#back").fadeOut();
	//inscription page 1
	// $(".div_ins").fadeOut();
	//inscription normal
	$(".div_ins_normal").fadeOut();
	//inscription demande code
	$(".div_ins_dc").fadeOut();
	//inscription creer réseau
	$(".div_ins_cpr").fadeOut();
	//pour créer son propre réseau
	$(".div_ins_normal_cpr").fadeOut();
	//pour info inscription
	// $(".div_ins_info").fadeOut();
	// $(".div_dc_info").fadeOut();
	// $(".div_cpr_info").fadeOut();
	//connexion
	$(".div_cnx").fadeOut();

	$("#span_cnx").click(function(){
		// alert("oui");
		$(".div_cnx").slideDown();
		$("#back").slideDown();
	});

	$("#span_ins , #btn_0, #btn_1, #btn_2, #btn_3, #btn_4, #btn_5, #btn_art").click(function(){
		// alert("oui");
		$(".div_ins").slideDown();
		$("#back").slideDown();
	});
	//inscription demande de code
	$("#l_dc").click(function(){
		$(".div_ins").slideUp();
		$(".div_ins_dc").slideDown();
	});
	//se connecter depuis demande de code
	$("#ins_dc_cnx").click(function(){
		$(".div_ins_dc").slideUp();
		$(".div_cnx").slideDown();
	});
	//incription créer son propre réseau
	$("#l_ins_cpr").click(function(){
		$(".div_ins").slideUp();
		$(".div_ins_cpr").slideDown();
	});
	// demande code au niveau de créer son propre réseau
	$("#l_ins_cpr_dc").click(function(){
		$(".div_ins_cpr").slideUp();
		$(".div_ins_dc").slideDown();

	});
	//aderé résau
	$("#l_ins_cpr_nrmal").click(function(){
		$(".div_ins_cpr").slideUp();
		$(".div_ins").slideDown();

	});
	//crer resaeu
	$("#l_ins_cpr_cnx").click(function(){
		$(".div_ins_cpr").slideUp();
		$(".div_cnx").slideDown();

	});
	//se connecter depuis ins
	$("#l_ins_cnx").click(function(){
		$(".div_ins").slideUp();
		$(".div_cnx").slideDown();

	});
	//ins depuis cnx
	$("#l_cnx_ins").click(function(){
		$(".div_cnx").slideUp();
		$(".div_ins").slideDown();

	});
	// il ferme toute les fenetre
	$("#back").click(function(){
		$(".div_ins").slideUp();
		$(".div_ins_normal").slideUp();
		$(".div_ins_dc").slideUp();
		$(".div_ins_cpr").slideUp();
		$(".div_ins_normal_cpr").slideUp();
		$(".div_cnx").slideUp();
		$("#back").slideUp();
		$('.l_ins_err').slideUp();
		$(".div_ins_info").slideUp();
		$(".div_dc_info").slideUp();
		$(".div_cpr_info").slideUp();

	});
	// la partie ajax
	$(".form_ins").submit(function(){
		var parrain_ins = $('.parrain_ins').val();
		var cp_ins = $('.code_ins').val();
		// alert(parrain_ins+code_ins);

		$.post('ins.php', {parrain_ins:parrain_ins,cp_ins:cp_ins}, function(donne){
			$('.l_ins_err').html(donne).slideDown();
			// alert("oui");
		});
		return false;
	});
	//pour créer son propre compte
	$(".form_ins_cpr").submit(function(){
		var cp_cpr = $('.ins_cpr_cp').val();
		
		$.post('ins.php', {cp_cpr:cp_cpr}, function(donne){
			// alert("oui");
			$('.l_ins_err').html(donne).slideDown();
		});
		return false;

	});
	//se conneter
	$(".form_cnx").submit(function(){
		var id_cnx = $('.id_cnx').val();
		var mdp_cnx = $('.mdp_cnx').val();
		// alert(parrain_ins+code_ins);

		$.post('ins.php', {id_cnx:id_cnx,mdp_cnx:mdp_cnx}, function(donne){
			$('.l_ins_err').html(donne).slideDown();
			// alert("oui");
		});
		return false;
	});
	//pour linscription normal
	$(".form_ins_normal").submit(function(){
		var nom_ins = $('.nom_ins').val();
		var prenom_ins = $('.prenom_ins').val();
		var phone_ins = $('.phone_ins').val();
		var email_ins = $('.email_ins').val();
		var pseudo_ins = $('.pseudo_ins').val();
		var ville_ins = $('.ville_ins').val();
		var adresse_ins = $('.adresse_ins').val();
		var mdp_1_ins = $('.mdp_1_ins').val();
		var mdp_2_ins = $('.mdp_2_ins').val();
		var hidden_ins = $('.hidden_ins').val();
		$.post("ins.php", {
			nom_ins:nom_ins,
			prenom_ins:prenom_ins,
			phone_ins:phone_ins,
			email_ins:email_ins,
			pseudo_ins:pseudo_ins,
			ville_ins:ville_ins,
			adresse_ins:adresse_ins,
			mdp_1_ins:mdp_1_ins,
			mdp_2_ins:mdp_2_ins,
			hidden_ins:hidden_ins
		}, function(donne){

			
			$('.l_ins_err').html(donne).slideDown();
		});
		return false;
	});
	//pour commander n code
	$(".form_ins_dc").submit(function(){
		var nom_dc = $('.nom_dc').val();
		var prenom_dc = $('.prenom_dc').val();
		var phone_dc = $('.phone_dc').val();
		var email_dc = $('.email_dc').val();
		var pseudo_dc = $('.pseudo_dc').val();
		var ville_dc = $('.ville_dc').val();
		var adresse_dc = $('.adresse_dc').val();
		var mdp_1_dc = $('.mdp_1_dc').val();
		var mdp_2_dc = $('.mdp_2_dc').val();
		var hidden_dc = $('.hidden_dc').val();
		$.post("ins.php", {
			nom_dc:nom_dc,
			prenom_dc:prenom_dc,
			phone_dc:phone_dc,
			email_dc:email_dc,
			pseudo_dc:pseudo_dc,
			ville_dc:ville_dc,
			adresse_dc:adresse_dc,
			mdp_1_dc:mdp_1_dc,
			mdp_2_dc:mdp_2_dc,
			hidden_dc:hidden_dc
		}, function(donne){

			
			$('.l_ins_err').html(donne).slideDown();
		});
		return false;
	});
	//pour linscription normal
	$(".form_ins_normal_cpr").submit(function(){
		var nom_cpr = $('.nom_cpr').val();
		var prenom_cpr = $('.prenom_cpr').val();
		var phone_cpr = $('.phone_cpr').val();
		var email_cpr = $('.email_cpr').val();
		var pseudo_cpr = $('.pseudo_cpr').val();
		var ville_cpr = $('.ville_cpr').val();
		var adresse_cpr = $('.adresse_cpr').val();
		var mdp_1_cpr = $('.mdp_1_cpr').val();
		var mdp_2_cpr = $('.mdp_2_cpr').val();
		var hidden_cpr = $('.hidden_cpr').val();
		$.post("ins.php", {
			nom_cpr:nom_cpr,
			prenom_cpr:prenom_cpr,
			phone_cpr:phone_cpr,
			email_cpr:email_cpr,
			pseudo_cpr:pseudo_cpr,
			ville_cpr:ville_cpr,
			adresse_cpr:adresse_cpr,
			mdp_1_cpr:mdp_1_cpr,
			mdp_2_cpr:mdp_2_cpr,
			hidden_cpr:hidden_cpr
		}, function(donne){
			$('.l_ins_err').html(donne).slideDown();
		});
		return false;
	});

	// pour les avis
	$("#formAvis").submit(function(){

		var txtAvis = $('#txtAvis').val();
		var cpAvis = $('#cpAvis').val();
		var lsAvis = 'lsAvis';
		$.post("ins.php", {
			txtAvis:txtAvis,
			cpAvis:cpAvis,
			lsAvis:lsAvis
		}, function(donne){
			$('.l_ins_err').html(donne).slideDown();
		});
		return false;
	});

	// pour les avis
	$("#frmCtct").submit(function(){

		var chpCtct = $('#chpCtct').val();
		var nsCtct = 'nsCtct';
		$.post("ins.php", {
			chpCtct:chpCtct,
			nsCtct:nsCtct
		}, function(donne){
			$('.l_ins_err').html(donne).slideDown();
		});
		return false;
	});
});