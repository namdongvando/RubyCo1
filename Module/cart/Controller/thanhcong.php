<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Module\cart\Controller;

/**
 * Description of thanhcong
 *
 * @author MSI
 */
class thanhcong extends \Controller_index {

    public $Product;
    public $Cart;
    public $Breadcrumb;

    function __construct() {
        parent::__construct();
        $this->Breadcrumb = new \Model\Breadcrumb();
        $this->Bread[] = [
            "title" => "Giỏ hàng",
            "link" => "/cart/"
        ];
        $this->Product = new \Model\Products();
        $this->Cart = new \Module\cart\Model\Cart();
    }

    function index() {
        $this->Breadcrumb->setBreadcrumb($this->Bread);
        $this->ViewThemeModule("", "", "cart");
    }

}
