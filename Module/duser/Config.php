<?php

namespace Module\duser;

class Config {

    function __construct() {
        
    }

    function links($param) {
        $a = [
            [
                "link" => "/duser/index/index",
                "title" => "Quản Lý User",
            ]
        ];

        return $a;
    }

}
