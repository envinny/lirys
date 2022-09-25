<?php
session_start();
require_once "class/momo/all_class_momo.php"


?>
<html>
	<head>
		<title>LirYs</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		
		<link rel="stylesheet" href="style/Semantic-UI-master/dist/semantic.css">
		<link rel="icon" type="image/icon" href="images\icn.png">
	</head>
    <body>
        <form method="post" class="m-5 p-5">
            <input type="submit" name="tst" class="ui button" value="Tester">
            <input type="submit" name="apiuser" class="ui button" value="Apiuser">
            <input type="submit" name="apikey" class="ui button" value="Apikey">
            <input type="submit" name="token" class="ui button" value="Token Collection">
            <input type="submit" name="tokendst" class="ui button" value="Token Distribution">
            <input type="submit" name="paye" class="ui button" value="Payer">
            <input type="submit" name="dist" class="ui button" value="Distribution">
        </form>
        <div class="container m-5 p-5">
            <?php
            if (isset($_POST['apiuser'])) {
                $uuid = $mmUi->genere();
                $apius = $mmUs->user($uuid);
                if ($apius == "1") {
                    setcookie("apiuser", $uuid);
                    echo $apius;
                } else {
                    echo "Erreur";
                }
                
            }
            
            if (isset($_POST['apikey'])) {
                if (isset($_COOKIE['apiuser'])) {
                    $uuid = $_COOKIE['apiuser'];
                    $apiky = $mmKY->key($uuid);
                    setcookie("apikey", $apiky);
                } else {
                    echo "Apiuser non défini";
                }
            }

            if (isset($_POST['token'])) {
                if (isset($_COOKIE['apiuser']) AND isset($_COOKIE['apikey'])) {
                    $u = $_COOKIE['apiuser'];
                    $k = $_COOKIE['apikey'];
                    $tkn = $mmTk->token($u, $k);
                    setcookie('token_collection', $tkn);
                } else {
                    echo "L'apiuser et l'apikey ne sont pas défini";
                }
                
            }

            if (isset($_POST['tokendst'])) {
                if (isset($_COOKIE['apiuser']) AND isset($_COOKIE['apikey'])) {
                    $u = $_COOKIE['apiuser'];
                    $k = $_COOKIE['apikey'];
                    $tkn = $mmTkDst->token($u, $k);
                    echo $tkn;
                    setcookie('token_distribution', $tkn);
                } else {
                    echo "L'apiuser et l'apikey ne sont pas défini";
                }
                
            }

            if (isset($_POST['paye'])) {
                if (isset($_COOKIE['token_collection'])) {
                    $t = $_COOKIE['token_collection'];
                    $u = $_COOKIE['apiuser'];
                    // echo "Token = ".$t."</br>APIUSER = ".$u."</br>";
                    $p = $clct->paye($t, $u, "1000", "242064069142", "mon teste", "a bien marché");
                    echo $p;
                }else{
                    echo "Le token n'est pas défini";
                }
            }

            if (isset($_POST['dist'])) {
                if (isset($_COOKIE['token_distribution'])) {
                    $t = $_COOKIE['token_distribution'];
                    $u = $_COOKIE['apiuser'];
                    echo $u."<br>";
                    echo $t."<br>"; 
                    // echo "Token = ".$t."</br>APIUSER = ".$u."</br>";
                    $p = $dist->paye($t, $u, "1000", "242064069142", "mon teste", "a bien marché");
                    echo $p;
                }else{
                    echo "Le token n'est pas défini";
                }
            }

            if (isset($_POST['tst'])) {
                $uuid = $mmUi->genere();
                echo "UUID = ".$uuid." </br></br>";

                echo "APIUSER = ";
                $apius = $mmUs->user($uuid);
                $u = (string)$apius;
                echo " </br></br>".$u." </br></br>";

                echo "APIUKEY = ";
                $apiky = $mmKY->key($uuid);
                $k = (string)$apiky;
                echo " </br></br>".$k." </br></br>";

                echo "TOKEN = ";
                $tkn = $mmTk->token($uuid, $k);
                echo $tkn." </br></br>";
            }
            
            ?>
        </div>
    </body>
    
</html>