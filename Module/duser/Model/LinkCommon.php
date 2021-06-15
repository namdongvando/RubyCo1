<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Module\duser\Model;

class LinkCommon {

    public function __construct() {

    }

    public static function LinkAddUser() {
        return "/duser/index/create";
    }

    public static function LinkEdit($User) {
        return "/duser/index/update/" . $User;
    }

}
