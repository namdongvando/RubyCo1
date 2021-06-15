<?php

namespace Module\cart\Controller;

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
            "TotalPrice" => "DOUBLE NOT NULL",
            "CodeOrder" => "varchar(20) NOT NULL",
            "Email" => "varchar(50) NOT NULL",
            "Phone" => "varchar(15) NOT NULL",
            "Status" => "int(10) NOT NULL",
            "Note" => "text NOT NULL",
            "Address" => "text NOT NULL",
        ];
        $Create->CreateTable(table_prefix . "order", $data);
        $data = [
            "IdProduct" => "varchar(50) NOT NULL",
            "CodeOrder" => "varchar(20) NOT NULL",
            "Price" => "DOUBLE NOT NULL",
            "Number" => "int(11) NOT NULL",
        ];
        $Create->CreateTable(table_prefix . "orderdetail", $data);
    }

}

?>