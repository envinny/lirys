<?php

class bdd{
    
    private $pdo;
    
    public function __construct($utisateur, $mdp, $bddname, $host = 'localhost'){
        
        $this->pdo = new PDO("mysql:dbname=$bddname;host=$host", $utisateur, $mdp);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }
    
    public function requete($requete, $parametre = false){
        
        if($parametre){
        
            $req = $this->pdo->prepare($requete);
            
            $req->execute($parametre);    
        }else{
            
            $req = $this->pdo->query($requete);

        }
        
        
        return $req;
    }
    
    public function dernierId(){
        
        return $this->pdo->dernierId();
        
    }
    
}