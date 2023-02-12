<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

/**
 * Description of Response
 *
 * @author MSI
 */
class Response {

    //put your code here

    public function __construct($items) {
        
    }

    public static function ToJson($items) {
        return json_encode($items, JSON_UNESCAPED_UNICODE);
    }

}
