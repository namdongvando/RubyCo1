<?php

namespace Module\cart\Model;

/**
 * Description of Order
 *
 * @author MSI
 */
class Order1 extends \Model\Database {

    //put your code here

    function __construct() {

    }

    function createOrder($Order) {
        $this->insert(table_prefix . "order", $Order);
    }

    function createOrderDetail($OrderDetail) {
        $this->insert(table_prefix . "orderdetail", $OrderDetail);
    }

}
