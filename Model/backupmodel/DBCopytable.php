<?php

class Model_DBCopytable extends Model_Adapter {

    function __construct() {

        parent::__construct();
    }

    function copytablewithprefix($prefix, $oldprefix) {
        $sql = "CREATE TABLE `{$prefix}tin` LIKE `{$oldprefix}tin`";
        $this->Query($sql);
        $this->Luu();
        $sql = "INSERT INTO `{$prefix}tin` SELECT * FROM `{$oldprefix}tin`";
        $this->Query($sql);
        $this->Luu();
    }

}
