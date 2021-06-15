<?php

namespace Module\cart\Controller;

class index extends \Controller_index {

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

    function addproduct() {
        $id = $this->param[0];
        $p = $this->Product->ProductsByID($id, FALSE);
        $p["Summary"] = "";
        $p["Content"] = "";
        $p["Number"] = 1;
        if (!$this->Cart->CheckCart($id)) {
            $this->Cart->addProduct2Cart($p);
        } else {
            $this->Cart->plusNumberProduct($id);
        }
        $this->Cart->_header("/cart/");
    }

    function removeproduct() {
        $id = $this->param[0];
        $this->Cart->removeProduct2Cart($id);
        $this->Cart->_header("/cart/");
    }

    function plusNumberProduct() {
        $id = $this->param[0];
        $this->Cart->plusNumberProduct($id);
        $this->Cart->_header("/cart/");
    }

    function minuNumberProduct() {
        $id = $this->param[0];
        $this->Cart->minuNumberProduct($id);
        $this->Cart->_header("/cart/");
    }

    function clearCart() {
        $this->Cart->clearCart();
    }

}

?>