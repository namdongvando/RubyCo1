<?php

namespace db;

abstract class ioTable extends \Model\Database {

    function __construct() {

        parent::__construct();
    }

    function index() {
        
    }

//    abstract function edit($data);
//
//    abstract function remove($id);
//
//    abstract function add($data);

    function delete() {
        $tableName = $this->param[0];
        $id = $this->param[1];
        $database = new \Model\Database();
        return $database->delete($tableName, "`ID` = '{$id}'");
    }

    function update() {
        $tableName = $this->param[0];
        $database = new \Model\Database();
        $classtable = get_class($database);
        foreach ($classtable as $k => $value) {
            $classtable[$k] = $_POST[$k];
        }
        return $database->update($tableName, $classtable);
    }

    function insert() {
        $tableName = $this->param[0];
        $database = new \Model\Database();
        $classtable = get_class($database);
        foreach ($classtable as $k => $value) {
            $classtable[$k] = $_POST[$k];
        }
        return $database->insert($tableName, $classtable);
    }

}
