$(document).ready(function(){
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
});