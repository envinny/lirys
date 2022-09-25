<?php 

//on iinsert l'autochargeur des classes
require_once 'inc/bootstrap.php';
//on inclue la class de connexion
$bdd3 = new connexion_a_la_bdd();
//on crée la variable de connexion
$bdd2 = $bdd3->cnx("localhost", "lirys", "root", "");
#encodage
$bdd2->exec('SET NAMES utf8');
#timer
$timer = mktime(0,0,0,date("m") ,date("d") ,date("Y") );      
//on crée l'objet charger des requêtees
$r = new requete($bdd2);
#objet pour remplacer les lettres d'un champs
$remplace = new remplace();
#l'objet pour les dates
$dt = new dat();
//les variables pour la date
$d = $dt->dt();
#le valideur
$v = new validateur($bdd2);
#pour les valeurs aléatoir
$alea = new aleatoire();

?>