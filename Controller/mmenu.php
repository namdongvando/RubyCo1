<?php

class Controller_mmenu extends Controller_backend {

    public $mmenu;

    function __construct() {
        $this->mmenu = new \Model\Menu();
        parent::__construct();
    }

    function index() {

        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "menu");
    }

    function getMenus() {
        $a = $this->mmenu->AllMenus(FALSE);
        echo $this->mmenu->_encode($a);
    }

    function getMenuByGroup() {
        $a = $this->mmenu->MenusByGroup($this->param[0]);
        echo $this->mmenu->_encode($a);
    }

}

?>