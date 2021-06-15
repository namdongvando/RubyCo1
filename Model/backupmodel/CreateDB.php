<?php

class Model_CreateDB extends Model_Adapter {

    function __construct() {
        parent::__construct();
    }

    function SqlCreateTable($array = array()) {
        $sql = "CREATE TABLE `{$array["TableName"]}` (";
        $i = 0;
        foreach ($array["Columns"] as $k => $v) {
            if ($i == 0) {
                $sql.=" `{$k}` {$v} ";
            } else {
                $sql.=", `{$k}` {$v} ";
            }
            $i++;
        }
        $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
        return $sql;
    }

}

?>