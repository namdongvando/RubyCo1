<?php
namespace Module\cart\Controller;

class taodonhang extends \Controller_index {

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
        $this->Bread[] = [
            "title" => "Đặt Hàng",
            "link" => "cart/index/taodonhang/"
        ];
        $this->Product = new \Model\Products();
        $this->Cart = new \Module\cart\Model\Cart();
    }
    function index() {
        $this->Breadcrumb->setBreadcrumb($this->Bread);
        $this->ViewThemeModule("","","cart");
    }
    
    
}

?>