<?php

class Model_SQLSever {

    function __construct() {
        $serverName = "serverName\sqlexpress"; //serverName\instanceName
        $connectionInfo = array("Database" => "BkApp001", "UID" => "sa", "PWD" => ".");
        
        $conn = sqlsrv_connect($serverName, $connectionInfo);
        if ($conn) {
            echo "Connection established.<br />";
        } else {
            echo "Connection could not be established.<br />";
            die(print_r(sqlsrv_errors(), true));
        }
    }

}

?>