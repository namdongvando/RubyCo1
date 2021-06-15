<?php

namespace Module\cart\Controller;

class vieworder extends \Controller_backend {

    public $Product;
    public $Cart;
    public $Param;
    public $Order;
    public $Breadcrumb;

    function __construct() {

        parent::__construct();
        $this->Breadcrumb = new \Model\Breadcrumb();
        $this->Param = $this->getParam();
        $this->Order = new \Module\cart\Model\Order();
        $this->Bread[] = [
            "title" => "Đơn hàng",
            "link" => ""
        ];
        $this->Product = new \Model\Products();
        $this->Cart = new \Module\cart\Model\Cart();
    }

    function index() {
        $this->Breadcrumb->setBreadcrumb($this->Bread);
        $this->ViewThemeModule("", "", "");
    }

    function googleform() {
        $this->Breadcrumb->setBreadcrumb($this->Bread);
        $this->ViewThemeModule("", "", "");
    }

    function dsorderstatus() {
        $this->param[0] = intval($this->param[0]);
        $this->param[0] = max(1, $this->param[0]);
        $this->param[1] = intval($this->param[1]);
        $this->param[1] = max(0, $this->param[1]);
        $a = $this->Order->ordersStatusPt($this->param[0], 15, $this->param[1], $sum);
        if ($a) {
            echo $this->Order->_encode($a);
            return;
        }
        echo "[]";
    }

    function dsorder() {
        $sum = 0;
        $this->param[0] = intval($this->param[0]);
        $this->param[0] = max(1, $this->param[0]);
        $a = $this->Order->ordersPt($this->param[0], 15, $sum);
        echo $this->Order->_encode($a);
    }

    function dsorderifame() {
        $this->ViewThemeModule("", "", "ifame");
    }

    function orderdetail() {
        if (isset($_POST["delete"])) {
            if ($_POST["huy"] == "HUY") {
                $_Order = $this->Order->orderbyid($_POST["CodeOrder"]);
                $_Order = $_Order[0];
                $_Order["Status"] = $_POST["Status"];
                $_Order["Note"] = "[" . $_SESSION[QuanTri]["Username"] . "] Hủy đơn hàng :" . date("Y-m-d H:i:s") . " <br>" . $_POST["note"] . "<br>_______<br>" . $_Order["Note"];
                $this->Order->updateOrder($_Order);
                $this->Order->_header("/cart/vieworder/dsorderifame");
            }
            $error = new \Model\Error();
            $error->setError("Bạn hãy nhập 'HUY' để hủy đơn hàng.", "danger");
        }
        if (isset($_POST["save"])) {
            $_Order = $this->Order->orderbyid($_POST["CodeOrder"]);
            $_Order = $_Order[0];
            $_Order["Status"] = $_POST["Status"];
            $stus = $this->Order->getStatus($_Order["Status"]);
            $_Order["Note"] = "[" . $_SESSION[QuanTri]["Username"] . "] $stus :" . date("Y-m-d H:i:s") . " <br>" . $_POST["note"] . "<br>_______<hr><br>" . $_Order["Note"];
            $this->Order->updateOrder($_Order);
            $this->Order->_header("/cart/vieworder/dsorderifame");
            $error = new \Model\Error();
            $error->setError("Bạn hãy nhập 'HUY' để hủy đơn hàng.", "danger");
        }
        $this->ViewThemeModule("", "", "ifame");
    }

    function viewordersearch($param) {
        $a = $this->Order->ordersByKey($this->param[0]);
        echo $this->Order->_encode($a);
    }

    function orderbystatus() {
        $this->ViewThemeModule("", "", "ifame");
    }

}

?>