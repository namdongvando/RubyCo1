<?php

namespace Module\cart\Controller;

class mcart extends \Controller_backend {

    function __construct() {
        parent::__construct();
    }

    function index() {
        
        $this->ViewThemeModule();
    }

}

?>