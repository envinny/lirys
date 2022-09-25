<?php

class chop_commission
{
    

    private $_com;

    public function __construct($cat){
        $this->calcul($cat);
        $this->_com = $cat;
    }

    public function calcul(){

        $x = ($this->_com * 5) / 100;
        return $x;
    }

    public function p1(){
        $smm = $this->calcul();
        $nw_smm = ($smm * 32) / 100;
        return $nw_smm;
    }

    public function p2(){
        $smm = $this->calcul();
        $nw_smm = ($smm * 16) / 100;
        return $nw_smm;
    }

    public function p3(){
        $smm = $this->calcul();
        $nw_smm = ($smm * 8) / 100;
        return $nw_smm;
    }

    public function p4(){
        $smm = $this->calcul();
        $nw_smm = ($smm * 8) / 100;
        return $nw_smm;
    }

    public function pp(){
        $smm = $this->calcul();
        $nw_smm = ($smm * 14) / 100;
        return $nw_smm;
    }

    public function l(){
        $smm = $this->calcul();
        $nw_smm = ($smm * 12) / 100;
        return $nw_smm;
    }

    public function os(){
        $smm = $this->calcul();
        $nw_smm = ($smm * 10) / 100;
        return $nw_smm;
    }
    
}


?>
