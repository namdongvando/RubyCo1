<?php

class Controller_apibackend extends Application {

    public $param;

    function __construct() {
        set_time_limit(0);
        $this->param = $this->getParam();
        $a = new Model_Adapter();
        if (!isset($_SESSION[QuanTri])) {
            Common\HeaderStatus::SetByCode(403);
        }
        if (http_response_code() != 200) {
            return;
        }
    }

    function angularjsui() {

        $this->AView("", Model_ViewTheme::get_viewthene(), "");
    }

    function getHoiDap() {
        $newId = $this->getParam()[0];
        if ($newId) {
            $_news = new \Model\news($newId);
        }
        $hoiDaps = $_news->HoiDaps();
        $Tong = count($hoiDaps);
        echo \lib\APIs::dataResful($hoiDaps, 1, 100, $Tong);
    }

}

?>