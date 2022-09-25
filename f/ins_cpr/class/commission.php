<?php
#la classe en charge des commissions
class commission{

    private $_com;

    public function __construct($cat){
        $this->p1($cat);
        $this->p2($cat);
        $this->p3($cat);
        $this->p4($cat);
        $this->pp($cat);
        $this->l($cat);
        $this->os($cat);
    }

    public function somme($cat)
    {
        if($cat == "SP"){
            $com = 1250;
        }elseif ($cat == "L1") {
            $com = 2000;
        }elseif ($cat == "L2") {
            $com = 4000;
        }elseif ($cat == "L3") {
            $com = 6000;
        }elseif ($cat == "L4") {
            $com = 8000;
        }elseif ($cat == "L5") {
            $com = 10000;
        }
        $this->_com = $com;
        return $this->_com;
    }

    public function p1($cat){
        if($cat == "SP"){
            $com = 400;
        }elseif ($cat == "L1") {
            $com = 600;
        }elseif ($cat == "L2") {
            $com = 1120;
        }elseif ($cat == "L3") {
            $com = 1560;
        }elseif ($cat == "L4") {
            $com = 1920;
        }elseif ($cat == "L5") {
            $com = 2200;
        }
        $this->_com = $com;
        return $this->_com;
    }

    public function p2($cat){
        if($cat == "SP"){
            $com = 200;
        }elseif ($cat == "L1") {
            $com = 300;
        }elseif ($cat == "L2") {
            $com = 560;
        }elseif ($cat == "L3") {
            $com = 780;
        }elseif ($cat == "L4") {
            $com = 960;
        }elseif ($cat == "L5") {
            $com = 1100;
        }

        $this->_com = $com;
        return $this->_com;
    }

    public function p3($cat){
        if($cat == "SP"){
            $com = 100;
        }elseif ($cat == "L1") {
            $com = 150;
        }elseif ($cat == "L2") {
            $com = 280;
        }elseif ($cat == "L3") {
            $com = 390;
        }elseif ($cat == "L4") {
            $com = 480;
        }elseif ($cat == "L5") {
            $com = 550;
        }

        $this->_com = $com;
        return $this->_com;
    }

    public function p4($cat){
        if($cat == "SP"){
            $com = 100;
        }elseif ($cat == "L1") {
            $com = 150;
        }elseif ($cat == "L2") {
            $com = 280;
        }elseif ($cat == "L3") {
            $com = 390;
        }elseif ($cat == "L4") {
            $com = 480;
        }elseif ($cat == "L5") {
            $com = 550;
        }

        $this->_com = $com;
        return $this->_com;
    }

    public function pp($cat){
        if($cat == "SP"){
            $com = 175;
        }elseif ($cat == "L1") {
            $com = 320;
        }elseif ($cat == "L2") {
            $com = 720;
        }elseif ($cat == "L3") {
            $com = 1200;
        }elseif ($cat == "L4") {
            $com = 1760;
        }elseif ($cat == "L5") {
            $com = 2400;
        }

        $this->_com = $com;
        return $this->_com;
    }

    public function l($cat){
        if($cat == "SP"){
            $com = 150;
        }elseif ($cat == "L1") {
            $com = 280;
        }elseif ($cat == "L2") {
            $com = 640;
        }elseif ($cat == "L3") {
            $com = 1080;
        }elseif ($cat == "L4") {
            $com = 1600;
        }elseif ($cat == "L5") {
            $com = 2200;
        }

        $this->_com = $com;
        return $this->_com;
    }

    public function os($cat){
        if($cat == "SP"){
            $com = 125;
        }elseif ($cat == "L1") {
            $com = 200;
        }elseif ($cat == "L2") {
            $com = 400;
        }elseif ($cat == "L3") {
            $com = 600;
        }elseif ($cat == "L4") {
            $com = 800;
        }elseif ($cat == "L5") {
            $com = 1000;
        }

        $this->_com = $com;
        return $this->_com;
    }




}

?>