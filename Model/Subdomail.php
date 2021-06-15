<?php

class Model_Subdomail extends Model_Adapter {

    public static $subdmail;

    function __construct($menu = NULL) {



        parent::__construct();
    }

    static function setSubdoamin($sub) {
        self::$subdmail = $sub;
    }

    static function getSubdoamin() {
        if (self::$subdmail == $_SERVER["HTTP_HOST"]) {
            Model_Tableprefix::setTableprefix("vksos_");
            return "home";
        }
        Model_Tableprefix::setTableprefix(self::$subdmail . "_");
        return self::$subdmail;
    }

}

?>