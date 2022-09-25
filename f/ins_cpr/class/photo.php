<?php
//nom de la class
class photo{
	//la variable qui enregistre les erreurs
    private $erreur;
	//la function image qui fait tous le travail sur l'image
    public function verifie_image($img_tmp, $img_name){
		//on récupère l'extension de l'image
        $img_plo=explode(".",$img_name);
        $img_ext=end($img_plo);
        //on vérifie si l'extension est bien parmi les trois qui sont dans le tableau
        if(in_array(strtolower($img_ext), array('jpg', 'jpeg', 'png'))===true){
            //on réduit le nom de la photo jusqu'à garder que l'extension dans $extensionUpload
            $extensionUpload = strtolower(substr(strrchr($img_name, '.'), 1));
			//on récupère la taille de l'image
            $image_size = getimagesize($img_tmp);
            //si le mime de l'image est soit "png", "jpg", "jpeg" alors on continu au cas contraire l'image entré n'est pas une vraie image
            if($image_size["mime"] == "image/jpeg"){
                return array($img_tmp, $extensionUpload);
            }elseif($image_size["mime"] == "image/png"){
                return array($img_tmp, $extensionUpload);
            }else{
                return false;
                $erreur = "Veuillez entré une image valide";
            }
        }else{
            $erreur = "Votre image doit être en format jpg, jpeg, png.";
        }        
        if(isset($erreur)){ 
            echo "<script> alert(\"".$erreur."\");</script>"; 
            return false;
        }
    }
    #le fonction pour déplacer l'image
    public function deplace_image($img_tmp, $extensionUpload, $desctination_miniature)
    {
        //la qualite de l'image
        $qualite=50;
        if ($extensionUpload=="jpg" || $extensionUpload=="jpeg") {
            
            /***on rassemble tous les information pour faire une image finale grace à la function imagecopyresampled, on lui donne en paramêtre
            *$nouvelle_image_miniature, qui contient les nouvelles dimensions
            *$nouvelle_image, qui contient la copie de l'image que l'on va redimensionné
            *0, 0, 0, 0 les coordonnées de l'image
            *$miniature_width, la nouvelle largeur
            *$miniature_height, la nouvelle hauteur
            *souvenez-vous que l'on avait enregistrer la taille de l'image dans $image_size
            *$image_size['0'], la largeur
            *$image_size['1'], la hauteur
            *et c'est bon**/
            //on récupère la taille de l'image
            $image_size = getimagesize($img_tmp);
            $nouvelle_image = imagecreatefromjpeg($img_tmp);
            #on divise les longueur de chaque coté des images par deux
            //nouvelle largeur
            $miniature_width= $image_size[0] / 2;
            //nouvelle hauteur
            $miniature_height= $image_size[1] / 2;
            $nouvelle_image_miniature = imagecreatetruecolor($miniature_width, $miniature_height);
            $image_miniature_final = imagecopyresampled($nouvelle_image_miniature, $nouvelle_image, 0, 0, 0, 0, $miniature_width, $miniature_height, $image_size[0], $image_size[1]);
            imagejpeg($nouvelle_image_miniature, $desctination_miniature, $qualite);

        } elseif($extensionUpload=="png") {
            
            //on récupère la taille de l'image
            $image_size = getimagesize($img_tmp);
            $nouvelle_image = imagecreatefrompng($img_tmp);
            #on divise les longueur de chaque coté des images par deux
            //nouvelle largeur
            $miniature_width= $image_size[0] / 2;
            //nouvelle hauteur
            $miniature_height= $image_size[1] / 2;
            $nouvelle_image_miniature = imagecreatetruecolor($miniature_width, $miniature_height);
            $image_miniature_final = imagecopyresampled($nouvelle_image_miniature, $nouvelle_image, 0, 0, 0, 0, $miniature_width, $miniature_height, $image_size[0], $image_size[1]);
            imagepng($nouvelle_image_miniature, $desctination_miniature, $qualite);

        }        
        if(isset($erreur)){ 
            echo "<script> alert(\"".$erreur."\");</script>"; 
            return false;
        }
    }
    #le fonction pour déplacer l'image
    public function deplace_image_min($img_tmp, $extensionUpload, $desctination_miniature)
    {
        //la qualite de l'image
        $qualite=100;
        if ($extensionUpload=="jpg" || $extensionUpload=="jpeg") {
            
            /***on rassemble tous les information pour faire une image finale grace à la function imagecopyresampled, on lui donne en paramêtre
            *$nouvelle_image_miniature, qui contient les nouvelles dimensions
            *$nouvelle_image, qui contient la copie de l'image que l'on va redimensionné
            *0, 0, 0, 0 les coordonnées de l'image
            *$miniature_width, la nouvelle largeur
            *$miniature_height, la nouvelle hauteur
            *souvenez-vous que l'on avait enregistrer la taille de l'image dans $image_size
            *$image_size['0'], la largeur
            *$image_size['1'], la hauteur
            *et c'est bon**/
            //on récupère la taille de l'image
            $image_size = getimagesize($img_tmp);
            $nouvelle_image = imagecreatefromjpeg($img_tmp);
            #on divise les longueur de chaque coté des images par deux
            //nouvelle largeur
            $miniature_width= $image_size[0] / 5;
            //nouvelle hauteur
            $miniature_height= $image_size[1] / 5;
            $nouvelle_image_miniature = imagecreatetruecolor($miniature_width, $miniature_height);
            $image_miniature_final = imagecopyresampled($nouvelle_image_miniature, $nouvelle_image, 0, 0, 0, 0, $miniature_width, $miniature_height, $image_size[0], $image_size[1]);
            imagejpeg($nouvelle_image_miniature, $desctination_miniature, $qualite);

        } elseif($extensionUpload=="png") {
            
            //on récupère la taille de l'image
            $image_size = getimagesize($img_tmp);
            $nouvelle_image = imagecreatefrompng($img_tmp);
            #on divise les longueur de chaque coté des images par deux
            //nouvelle largeur
            $miniature_width= $image_size[0] / 2;
            //nouvelle hauteur
            $miniature_height= $image_size[1] / 2;
            $nouvelle_image_miniature = imagecreatetruecolor($miniature_width, $miniature_height);
            $image_miniature_final = imagecopyresampled($nouvelle_image_miniature, $nouvelle_image, 0, 0, 0, 0, $miniature_width, $miniature_height, $image_size[0], $image_size[1]);
            imagepng($nouvelle_image_miniature, $desctination_miniature, $qualite);

        }        
        if(isset($erreur)){ 
            echo "<script> alert(\"".$erreur."\");</script>"; 
            return false;
        }
    }
}

?>