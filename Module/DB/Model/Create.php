<?php

namespace Module\DB\Model;

class Create extends \Model\Database {

    function __construct() {
        parent::__construct();
    }

    function CreateTable($NameTable, $data) {
        $sql = "DROP TABLE `{$NameTable}`";
        $this->Query($sql);
        $this->Luu();
        $sql = "CREATE TABLE `{$NameTable}` (`Id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,`Name` varchar(200) NOT NULL,";
        $dem = 1;
        $a = count($data);
        foreach ($data as $key => $value) {
            if ($dem < $a)
                $sql .= sprintf("`%s` %s ,", $key, $value);
            else
                $sql .= sprintf("`%s` %s ", $key, $value);
            $dem++;
        }
        $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8";
        $this->Query($sql);
        return $this->Luu();
    }

}
