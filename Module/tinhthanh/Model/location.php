<?php

namespace Module\tinhthanh\model;

class location extends \Model\Database {

    //put your code here
    private $TableName;

    function __construct() {
        parent::__construct();
        $this->TableName = table_prefix . "location";
    }

    function getLocationByParentId() {
        
    }

    function getLocationById($id) {
         $a = $this->select($this->TableName, [], " `Code` = '{$id}'");
         return $a[0];
    }

    function getLocation() {
        return $this->select($this->TableName, [], " 1");
    }

    function createLocation($data) {
        return $this->insert($this->TableName, $data);
    }

}
