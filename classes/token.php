<?php
class Token {

    private $randomString = "";

    public function getString() {
        return $this->randomString;
    }

    public function  __construct($seed/*string*/, $length/*int*/) {
        $str = "";
        $seedLen = strlen($seed);
        
        for($i = 0; $i < $length; $i++) {
            $randIndex = mt_rand(0, $seedLen);
            $str .= $seed[$randIndex];
        }

        $this->randomString = md5($str);
    }

    public function  __toString() {
        return $this->randomString;
    }
}
