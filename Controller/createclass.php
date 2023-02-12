<?php
class Controller_createclass extends Application {

    function __construct() {
    }

    function index() {
        
        $a = new \lib\database2class();
        $a->MapingClass();
          
    }

} ?>