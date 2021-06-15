<?php

class Model_Tableprefix {

    public static $Tableprefix;

    function __construct($menu = NULL) {
        
    }

    static function setTableprefix($sub) {
        self::$Tableprefix = $sub;
    }

    static function getTableprefix() {
        return self::$Tableprefix;
    }

}

?>