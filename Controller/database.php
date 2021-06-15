<?php
class Controller_database extends Application {

    function __construct() {
        
    }

    function index() {
        $page = new \Model\pages();
        $page->capnhatAllPages();
    }

} ?>