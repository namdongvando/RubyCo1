<?php

namespace Model;

class Authorities extends \Model\Database {

    function __construct() {
        parent::__construct();
    }

    function getAuthDeleteCategoryMaster($username) {
        return FALSE;
    }
    function getAuthDeleteCategory($username) {
        return TRUE;
    }

    function getAuthController($Controller) {
        return TRUE;
    }

    function getAuthControllerAction($Controller, $Action) {
        return TRUE;
    }

}
