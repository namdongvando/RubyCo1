<?php

namespace Module\cart\Model;

class Cart extends \Model\Database {

    function __construct() {
        
    }

    function Products() {
        return $_SESSION[GioHang];
    }

    function plusNumberProduct($id) {
        $_SESSION[GioHang][$id]["Number"] ++;
    }

    function minuNumberProduct($id) {
        if ($_SESSION[GioHang][$id]["Number"] > 1)
            return $_SESSION[GioHang][$id]["Number"] --;
        return $_SESSION[GioHang][$id]["Number"] = 1;
    }

    function addProduct2Cart($Product) {
        if (!isset($_SESSION[$Product["ID"]])) {
            $_SESSION[GioHang][$Product["ID"]] = $Product;
        } else {
            $_SESSION[GioHang][$Product["ID"]]["Number"] ++;
        }
    }

    function removeProduct2Cart($id) {
        unset($_SESSION[GioHang][$id]);
    }

    function countProduct2Cart() {
        return count($_SESSION[GioHang]);
    }

    function clearCart() {
        unset($_SESSION[GioHang]);
    }

    function TotalPrice() {
        if (!$this->Products())
            return 0;
        $tong = 0;
        foreach ($this->Products() as $p) {
            $tong += ($p["Number"] * $p["Price"]);
        }
        return $tong;
    }
    function TotalPriceVND() {
        $tong = $this->TotalPrice();
        return \lib\Common::MoneyFomat($tong);
    }

    function CheckCart($id) {
        return isset($_SESSION[GioHang][$id]);
    }

}
