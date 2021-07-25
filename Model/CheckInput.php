<?php

namespace Model;

class CheckInput extends \Model\Database {

    function __construct() {
        parent::__construct();
    }

    function CheckTextInput($text) {
        return parent::Bokytusql($text);
    }

    public static function ChekInput($params) {
        $params = trim($params);
        $params = addslashes($params);
        $params = htmlspecialchars($params);
        return $params;
    }

}
