<?php

namespace Module\cart\Model;

/**
 * Description of Order
 *
 * @author MSI
 */
class Order extends \Model\Database {

    //put your code here

    public $Id;
    public $Name;
    public $TotalPrice;
    public $CodeOrder;
    public $Email;
    public $Phone;
    public $Status;
    public $Note;
    public $Address;

    function __construct($order = null) {
        if ($order) {
            $this->Id = $order["Id"];
            $this->Name = $order["Name"];
            $this->TotalPrice = $order["TotalPrice"];
            $this->CodeOrder = $order["CodeOrder"];
            $this->Email = $order["Email"];
            $this->Phone = $order["Phone"];
            $this->Status = $order["Status"];
            $this->Note = $order["Note"];
            $this->Address = $order["Address"];
        }
        parent::__construct();
    }

    function NgayDat() {
        $nam = substr($this->CodeOrder, 3, 4);
        $thang = substr($this->CodeOrder, 7, 2);
        $ngay = substr($this->CodeOrder, 9, 2);
        $time = $nam . "-" . $thang . "-" . $ngay;
        return $time;
    }

    function Status() {
        $a = $this->listStatus();
        return $a[$this->Status];
    }

    function createOrder($Order) {
        $this->insert(table_prefix . "order", $Order);
    }

    function updateOrder($Order) {
        return $this->update(table_prefix . "order", $Order, "`CodeOrder` = '{$Order["CodeOrder"]}'");
    }

    function createOrderDetail($OrderDetail) {
        return $this->insert(table_prefix . "orderdetail", $OrderDetail);
    }

    function orders() {
        return $this->select(table_prefix . "order", [], '1');
    }

    function ordersPt($page = 1, $number = 20, &$sun) {
        $sun = 10;
        $page = intval($page);
        $page = max($page, 1);
        $page = ($page - 1) * $number;

        $d = $this->select(table_prefix . "order", [], " 1   ORDER BY `Id` DESC");
        $sun = count($d);
        return $this->select(table_prefix . "order", [], "1  ORDER BY `Id` DESC limit {$page},{$number}");
    }

    function ordersByKey($key = "") {
        return $this->select(table_prefix . "order", ["Id", 'Name', "TotalPrice", "CodeOrder", "Email", "Phone", "Status"], " `CodeOrder` like '%{$key}%' || `Email` like '%{$key}%' || `Phone` like '%{$key}%' || `Email` like '%{$key}%' ");
    }

    function ordersStatusPt($page = 1, $number = 20, $status = 1, &$sun) {
        $sun = 0;
        $page = intval($page);
        $page = max($page, 1);
        $page = ($page - 1) * $number;
        $d = $this->select(table_prefix . "order", ["Id"], " `Status` = '{$status}'   ORDER BY `Id` DESC");
        if ($d)
            $sun = count($d);
        return $this->select(table_prefix . "order", [], " `Status` = '{$status}'  ORDER BY `Id` DESC limit {$page},{$number}");
    }

    function ordersPt1() {
        return $this->select(table_prefix . "order", [], '1');
    }

    function orderbyid($id) {
        return $this->select(table_prefix . "order", [], "`CodeOrder` = '{$id}'");
    }

    function orderDetailbyid($id) {
        return $this->select(table_prefix . "orderdetail", [], "`CodeOrder` = '{$id}'");
    }

    function listStatus() {
        $DSStatus = [
            "Hủy"
            , "Thất bại"
            , "Thành Công"
            , "Đang xử lý"
            , "Mới Đặt"
        ];
        return $DSStatus;
    }

    function getStatus($id) {
        $DSStatus = $this->listStatus();
        return $DSStatus[$id];
    }

}
