$(document).ready(function(){
    // tous ce qui sera caché au lancement
    $("#epn_dpo, #epn_act, #epn_rfs, #epn_acp, #chp_att, #chp_rfs, #chp_act, #chp_art, #evn_evn, #evn_att, #evn_rfs, #evn_act").fadeOut();

    // la partie epargne
    //action sur chaque bouton
    $("#epn_btn_att").click(function(){
        $("#epn_act, #epn_rfs, #epn_acp").slideUp();
        $("#epn_dpo").fadeIn();

    })
    $("#epn_btn_act").click(function(){
        $("#epn_dpo, #epn_rfs, #epn_acp").slideUp();
        $("#epn_act").fadeIn();

    })
    $("#epn_btn_rfs").click(function(){
        $("#epn_act, #epn_dpo, #epn_acp").slideUp();
        $("#epn_rfs").fadeIn();

    })
    $("#epn_btn_acp").click(function(){
        $("#epn_act, #epn_rfs, #epn_dpo").slideUp();
        $("#epn_acp").fadeIn();

    })
    //pour le chop
    $("#chp_btn_art").click(function(){
        $("#chp_att, #chp_rfs, #chp_act").slideUp();
        $("#chp_art").fadeIn();

    })
    $("#chp_btn_att").click(function(){
        $("#chp_art, #chp_rfs, #chp_act").slideUp();
        $("#chp_att").fadeIn();

    })
    $("#chp_btn_rfs").click(function(){
        $("#chp_att, #chp_art, #chp_act").slideUp();
        $("#chp_rfs").fadeIn();

    })
    $("#chp_btn_act").click(function(){
        $("#chp_att, #chp_rfs, #chp_art").slideUp();
        $("#chp_act").fadeIn();

    })
    //pour les événements
    $("#evn_btn_evn").click(function(){
        $("#evn_att, #evn_rfs, #evn_act").slideUp();
        $("#evn_evn").fadeIn();

    })
    $("#evn_btn_att").click(function(){
        $("#evn_evn, #evn_rfs, #evn_act").slideUp();
        $("#evn_att").fadeIn();

    })
    $("#evn_btn_rfs").click(function(){
        $("#evn_att, #evn_evn, #evn_act").slideUp();
        $("#evn_rfs").fadeIn();

    })
    $("#evn_btn_act").click(function(){
        $("#evn_att, #evn_rfs, # evn_evn").slideUp();
        $("#evn_act").fadeIn();

    })
});