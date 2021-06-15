<?php


namespace Model;


class CheckInput extends \Model\Database {
    
    //put your code here
    function __construct() {
        parent::__construct();
    }
    
    function CheckTextInput($text) {
        return parent::Bokytusql($text);
        
    }
    
}
