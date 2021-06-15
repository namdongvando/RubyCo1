<?php
class Model_Member extends Model_Adapter {

    function __construct() {
        parent::__construct();
    }
    
    function getMemberByUsername($u,$p) {
        $sql = "SELECT * FROM `".table_prefix."member` WHERE `Username` = '{$u}' and Password = '{$p}'";
        $this->Query($sql);
        return $this->fetchRow();
    }

}

?>