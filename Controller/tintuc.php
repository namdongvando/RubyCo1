<?php

class Controller_tintuc extends Controller_index {

    //put your code here
    function __construct() {
        parent::__construct();
    }

    function index() {

        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "danhmuc");
    }

}
