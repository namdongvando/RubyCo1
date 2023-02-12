<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

/**
 * Description of Request
 *
 * @author MSI
 */
class Request {

    //put your code here

    public function __construct() {
        
    }

    public static function Post($name, $value) {
        
        if (isset($_POST[$name])) {
            return $_POST[$name];
        }
        return $value;
    }

    public static function Get($name, $value) {
        if (isset($_GET[$name])) {
            return $_GET[$name];
        }
        return $value;
    }

}
