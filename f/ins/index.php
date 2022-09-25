<?php

#overture de la session
session_start();
#inclusion des class
require_once 'extends_class/extends.php';

?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - LirYs</title>
    

	<link rel="stylesheet" href="../../style/Semantic-UI-master/dist/semantic.css">
	<link rel="stylesheet" href="../../style/fontawesome-free-6.1.1-web/css/all.css">
	<link rel="stylesheet" href="../../style/bootstrap-5.1.3/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<link rel="icon" type="image/icon" href="images\icn.ico">
	
    <script type="text/javascript" src="script/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="script/function.js"></script>
</head>
<body>
    <div class="container">
        <?php
        include "partie/ins.php";
        include "partie/ins_nrmal.php";
        include "partie/ins_nrmal_info.php";
        
        ?>    
    </div>
    <!-- la function charger de recharger la page en cas d'échèque de paiement -->
    <script>
        $("#btn_reload").click(function(){
            document.location.reload();
        });
    </script>
    
</body>
</html>