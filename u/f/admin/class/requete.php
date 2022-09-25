<?PHP

//class chargé à faire les requêtes
class requete{
	
    // variable de connexion
    private $_BD;
    
    // le constructeur
    public function __construct($BD){
		
		$this->setDb($BD);
    
    }
    
    // fonction insert
    public function insert($requete, $parametre){
    
        //requêtes pour insérer
        $r = $this->_BD->prepare($requete);
        $r->execute($parametre);
        return $r;
    }
    
    // fonction select
    public function select($requete){
    
        //la requête pour sélectionné
        $r=$this->_BD->prepare($requete);
        $r->execute();
        return $r;
    
    }
        
    // fonction update
    public function update($requete, $parametre){
    
        //la requête pour modifier
        $r=$this->_BD->prepare($requete);
        $r->execute($parametre);
        return $r;
    
    }
        
    // function pour effacer
    public function del($requete){
    
        //la requête pour effacer
        $r=$this->_BD->prepare($requete);
        $r->execute();
        return true;
    
    }

       
    public function del_2($table, $colonne, $valeur){
    
        //la requête pour effacer
        $r=$this->_BD->prepare("delete from $table where $colonne = '$valeur'");
        $r->execute();
        return true;
    
    }

    public function s_a_s($table)
    {
        $r=$this->_BD->prepare("select * from $table");
        $r->execute();
        return $r; 
    }

    public function s_a_s_a_w($table, $colonne, $valeur)
    {
        $r=$this->_BD->prepare("select * from $table where $colonne = '$valeur'");
        $r->execute();
        return $r; 
    }

    public function verifie($table, $colonne_1, $colonne_2, $valeur_1, $valeur_2)
    {
        $r=$this->_BD->prepare("select * from $table where $colonne_1 = '$valeur_1' and $colonne_2 = '$valeur_2'");
        $r->execute();
        return $r;    
    }

    public function verifie_order($table, $colonne_1, $colonne_2, $valeur_1, $valeur_2, $order, $limit)
    {
        $r=$this->_BD->prepare("SELECT * FROM $table WHERE $colonne_1 = '$valeur_1' AND $colonne_2 = '$valeur_2' ORDER BY $order  LIMIT $limit");
        $r->execute();
        return $r;
    }

    public function verifie_limit($table, $colonne_1, $colonne_2, $valeur_1, $valeur_2, $limit)
    {
        $r=$this->_BD->prepare("SELECT * FROM $table WHERE $colonne_1 = '$valeur_1' AND $colonne_2 = '$valeur_2' LIMIT '$limit'");
        $r->execute();
        return $r;    
    }

    public function s_une_coln($table, $donne, $colonne, $valeur)
    {
        $r=$this->_BD->prepare("SELECT DISTINCT $donne FROM $table WHERE $colonne = '$valeur'");
        $r->execute();
        return $r;    
    }

    public function s_a_s_a_l($table, $limit)
    {
        $r=$this->_BD->prepare("select * from $table limit $limit");
        $r->execute();
        return $r; 
    }

    public function s_a_s_a_l_e_o_d($table, $order, $limit)
    {
        $r=$this->_BD->prepare("select * from $table order by $order desc limit $limit");
        $r->execute();
        return $r; 
    }

    public function s_a_s_a_o_d($table, $order)
    {
        $r=$this->_BD->prepare("select * from $table order by $order desc");
        $r->execute();
        return $r; 
    }

    public function s_a_s_a_w_o_d($table, $colonne, $valeur, $order)
    {
        $r=$this->_BD->prepare("select * from $table where $colonne = $valeur order by $order desc");
        $r->execute();
        return $r; 
    }

    public function s_a_s_a_w_o_d_l($table, $colonne, $valeur, $order, $limit)
    {
        $r=$this->_BD->prepare("select * from $table where $colonne = $valeur order by $order desc limit $limit");
        $r->execute();
        return $r; 
    }
	
	public function setDb($BD){
		
		$this->_BD = $BD;
		
	}
    

}

?>