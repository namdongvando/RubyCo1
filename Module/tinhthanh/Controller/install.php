<?php

namespace Module\tinhthanh\Controller;

class install extends \Controller_backend {

    public $Product;
    public $Cart;

    function __construct() {
        parent::__construct();
        $this->Product = new \Model\Products();
        $this->Cart = new \Module\cart\Model\Cart();
    }

    function index() {
        $this->ViewThemeModule("", "", "cart");
    }

    function db() {
        $Create = new \Module\DB\Model\Create();
        $data = [
            "Code" => "varchar(10) NOT NULL",
            "Parent" => "varchar(10) NOT NULL",
            "Lang" => "varchar(5) NOT NULL",
            "Stt" => "int(11) NOT NULL",
        ];
        $Create->CreateTable(table_prefix . "location", $data);
    }

}

?>