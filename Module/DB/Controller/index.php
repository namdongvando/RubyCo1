<?php

// quản lý user quản trị

namespace Module\DB\Controller;

class index extends \Controller_backend {

    public $infor;
    public $Admin;
    public $Breadcrumb;

    function __construct() {
        parent::__construct();
        $this->Breadcrumb = new \Model\Breadcrumb();
        $this->Admin = new \Model\Admin();
        $this->Bread[] = [
            "title" => "Thông Tin Database",
            "link" => "/DB/index/index/"
        ];
        $this->infor = new \Module\minfor\Model\infor();
        ob_start();
    }

    function index() {

        $this->Breadcrumb->setBreadcrumb($this->Bread);
        $this->ViewThemeModule();
    }

    function hospital() {
        $data = [
            "Image" => "text NOT NULL",
            "Website" => "varchar(200) NOT NULL",
            "Phone" => "varchar(200) NOT NULL",
            "Price" => "DOUBLE NOT NULL",
            "UnitType" => "varchar(200) NOT NULL",
            "Address" => "varchar(200) NOT NULL",
            "Email" => "varchar(200) NOT NULL",
            "isActive" => "int(11) NOT NULL"
        ];
        $this->Admin->CreateTable(table_prefix . "hospital", $data);
    }

    function schedulercustomer() {
        $data = [
            "CustomerID" => "int(10) NOT NULL",
            "Customer" => "text NOT NULL",
            "Detail" => "text NOT NULL",
            "Doctor" => "text NOT NULL",
            "HasHealthInsurance" => "int(10) NOT NULL",
            "Hospital" => "text NOT NULL",
            "Price" => "DOUBLE NOT NULL",
            "Room" => "text NOT NULL",
            "Service" => "text NOT NULL",
            "StatusCode" => "int(10) NOT NULL",
            "StatusLabel" => "varchar(200) NOT NULL",
            "Type" => "int(10) NOT NULL",
        ];
        $this->Admin->CreateTable(table_prefix . "schedulercustomer", $data);
    }

    function add() {

        if (isset($_POST["btnSave"]) || isset($_POST["btnSaveClose"])) {
            unset($_POST["btnSave"]);
            unset($_POST["btnSaveClose"]);
            $UserName = $_POST;
            $UserName["Random"] = $this->Admin->RandomString(10);
            $this->Admin->AddUsername($UserName);
        }



        $this->Bread[] = [
            "link" => "#",
            "title" => "Thêm Tài Khoản",
        ];

        $this->Breadcrumb->setBreadcrumb($this->Bread);
        $this->ViewThemeModule();
    }

    function __destruct() {
        $str = ob_get_clean();
        $filename = __DIR__ . "/../Lang/vi.ini";
        $a = parse_ini_file($filename);
        $a["AddLink"] = "/duser/index/add/";
        $a["ViewLink"] = "#";
        foreach ($a as $k => $value) {
            $str = str_replace("__" . $k . "___", $value, $str);
        }
        echo $str;
    }

}

?>