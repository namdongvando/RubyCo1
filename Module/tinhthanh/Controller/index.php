<?php

namespace Module\tinhthanh\Controller;

class index extends \Controller_backend {

    public $TinhThanh;
    public $Breadcrumb;

    function __construct() {
        $this->TinhThanh = new \Module\tinhthanh\model\location();
        parent::__construct();
    }

    function index() {
        if (isset($_POST["Luu"])) {
            foreach ($_POST["Name"] as $k => $value) {
                $Data["Name"] = $this->TinhThanh->Bokytusql($value);
                $Data["Code"] = $this->TinhThanh->Bokytusql($_POST["Value"][$k]);
                $Data["Parent"] = $this->TinhThanh->Bokytusql($_POST["Parent"][$k]);
                $Data["Lang"] = "vi";
                $Data["Stt"] = 0;
            }
        }

        $data["Locations"] = $this->TinhThanh->getLocation();
        $this->ViewThemeModule($data);
    }
    function savelocation() {
        $a = $this->TinhThanh->_decode($_POST["data"]);
        if ($a) {
            foreach ($a as $value) {
                $Data = $this->TinhThanh->getLocationById($value->Value);
                $Data["Name"] = $value->Name;
                $Data["Code"] = $value->Value;
                $Data["Parent"] = $value->Parent;
                $Data["Lang"] = "vi";
                $Data["Stt"] = 0;
                $this->TinhThanh->createLocation($Data);
            }
        }
        echo "ok";
        
    }

}

?>