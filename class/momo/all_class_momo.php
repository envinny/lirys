<?php
#õn inclue toute les class
require_once "momo_resquest.php";
require_once "momo_uuid.php";
require_once "momo_apiuser.php";
require_once "momo_apikey.php";
require_once "momo_token_collection.php";
require_once "momo_token_distribution.php";
require_once "momo_collection.php";
require_once "momo_distribution.php";

$mmUi = new momo_uuid();
$mmKY = new momo_apikey();
$mmUs = new momo_apiuser();
$mmTk = new momo_token_collection();
$mmTkDst = new momo_token_distribution();
$clct = new momo_collection();
$dist = new momo_distribution();



?>