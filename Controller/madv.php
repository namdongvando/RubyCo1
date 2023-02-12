<?php

class Controller_madv extends Controller_backend {

    public $Adv;

    function __construct() {
        $this->Adv = new \Model\adv();
        parent::__construct();

        Model\Breadcrumb::setMenuAcrive(__CLASS__);
    }

    function index() {

//        $this->Adv->getGroupsAdv(FALSE);
        $_bre = new Model\Breadcrumb();
        $_bre->setBreadcrumb($this->Bread);
        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "");
    }

    function doitac() {

//        $this->Adv->getGroupsAdv(FALSE);
        $_bre = new Model\Breadcrumb();
        $_bre->setBreadcrumb($this->Bread);
        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "");
    }

    function khachhang() {

//        $this->Adv->getGroupsAdv(FALSE);
        $_bre = new Model\Breadcrumb();
        $_bre->setBreadcrumb($this->Bread);
        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "");
    }

    function homeslide() {
        $this->Bread[] = [
            "title" => "Quản lý Banner Động",
            "link" => "/madv/homeslide"
        ];
//        $this->Adv->getGroupsAdv(FALSE);
        $_bre = new Model\Breadcrumb();
        $_bre->setBreadcrumb($this->Bread);
        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "");
    }

    function addadv() {
        if (isset($_POST["AddAdv"])) {
//            $Adv["Attribute"] = $this->Adv->_encode($_POST["Attribute"]);
//            $Adv["DataAttribute"] = $this->Adv->_encode($_POST["DataAttribute"]);
            $_group = $this->Adv->getGroupAdvByID($this->Adv->CheckTextInput($_POST["Group"]), FALSE);
            $Adv["Name"] = $this->Adv->CheckTextInput($_POST["Name"]);
            $Adv["Content"] = $this->Adv->CheckTextInput($_POST["Content"]);
            $Adv["Attribute"] = $this->Adv->_encode($_POST["Attribute"]);
            $Adv["DataAttribute"] = $this->Adv->_encode($_POST["DataAttribute"]);
            $Adv["Link"] = $this->Adv->CheckTextInput($_POST["Link"]);
            $Adv["Urlimages"] = "";
            $Adv["isShow"] = 1;
            $Adv["Group"] = $_POST["Group"];
            $Adv["ID"] = $this->Adv->AddAdv($Adv);
            $img = "";
            if (isset($_FILES["UrlImage"])) {
                if ($_FILES["UrlImage"]["error"] == 0) {

                    $img = $this->Adv->upload_image1($_FILES["UrlImage"], "public/img/images/quangcao/" . $_POST["Group"] . "/", $_POST["Group"] . "-" . $Adv["ID"], true);
                    $img = explode("public/img/", BASE_URL . $img);
                    $img = "/public/img/" . $img[1];
                }
            }
            $Adv["Urlimages"] = $img;
            $this->Adv->EditAdv($Adv);
        }
        $this->Adv->_header($_SERVER["HTTP_REFERER"]);
    }

    function editorderby() {
        if (isset($_POST["saveOrderBy"])) {
            foreach ($_POST["orderBy"] as $idAdv => $ord) {
                $Adv = $this->Adv->AdvsById($idAdv, FALSE);
                $Adv["isShow"] = $ord + 1;
                $this->Adv->EditAdv($Adv);
            }
        }
        $this->Adv->_header($_SERVER["HTTP_REFERER"]);
    }

    function editadv() {
        if (isset($_POST["EditAdv"])) {
//            $Adv["Attribute"] = $this->Adv->_encode($_POST["Attribute"]);
//            $Adv["DataAttribute"] = $this->Adv->_encode($_POST["DataAttribute"]);

            $ID = $this->Adv->CheckTextInput($_POST["ID"]);
            $Adv = $this->Adv->AdvsById($ID, FALSE);
            $Adv["Name"] = $this->Adv->CheckTextInput($_POST["Name"]);
            $Adv["Content"] = $this->Adv->CheckTextInput($_POST["Content"]);
            $Adv["Attribute"] = isset($_POST["Attribute"]) ? $this->Adv->_encode($_POST["Attribute"]) : '{}';
            $Adv["DataAttribute"] = isset($_POST["DataAttribute"]) ? $this->Adv->_encode($_POST["DataAttribute"]) : '[]';
            $Adv["Link"] = $this->Adv->CheckTextInput($_POST["Link"]);
            $stt = intval($_POST["isShow"]);
            $Adv["isShow"] = max($stt, 0);
            $img = $Adv["Urlimages"];
            if (isset($_FILES["UrlImage"])) {
                if ($_FILES["UrlImage"]["error"] == 0) {
                    $urlimg = "public/img/images/adv/" . $Adv["Group"] . "/";
                    $imgHinh = substr($img, 1);
                    if (is_file($imgHinh)) {
                        unlink($imgHinh);
                    }
                    $img = $this->Adv->upload_image1($_FILES["UrlImage"], $urlimg, "adv-" . $Adv["ID"], true);
                    $img = explode("public/img/", BASE_URL . $img);
                    $img = "/public/img/" . $img[1];
                    $Adv["Urlimages"] = $img;
                }
            }

            $this->Adv->EditAdv($Adv);
        }
        $this->Adv->_header($_SERVER["HTTP_REFERER"]);
    }

    function addgroupadv() {
        if (isset($_POST["AddGroup"])) {
            $Adv["Name"] = $_POST["Name"];
            $Adv["Group"] = $this->Adv->bodautv($_POST["Group"]);
            $Adv["Link"] = "";
            $Adv["Content"] = "";
            $Adv["UrlImages"] = "";
            $Adv["Attribute"] = "{}";
            $Adv["DataAttribute"] = "[]";
            $Adv["isShow"] = 0;
            $this->Adv->AddAdv($Adv);
            $this->Adv->_header("/madv/index/");
        }
    }

    function delete() {
        $a = $this->Adv->DeleteAdv($this->param[0]);
        $this->Adv->_header($_SERVER["HTTP_REFERER"]);
    }

    function getAdvs() {
        $a = $this->Adv->Advs(FALSE);
        echo $this->Adv->_encode($a);
    }

    function getAdvsByGroups() {
        $groups = $this->getParam()[0];
        $a = $this->Adv->AdvsByGroup($groups, FALSE);
        echo $this->Adv->_encode($a);
    }

    function getGroupAdvs() {
        $a = $this->Adv->getGroupsAdv(FALSE);
        echo $this->Adv->_encode($a);
    }

    function getAdvsByID() {
        $a = $this->Adv->AdvsById($this->param[0], FALSE);
        echo $this->Adv->_encode($a);
    }

    function saveVideo() {
        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers:x-requested-with,content-type');
        header("Content-type: application/x-www-form-urlencoded");
        print_r($_POST["Link"]);
        $content['Link'] = $_POST["Link"];
        $content['IsShow'] = $_POST["IsShow"];
        $io = new lib\io();
        $io->writeFile("data/video.js", json_encode($content));
    }

    function video() {

        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "");
    }

    function getVideo() {
        $io = new lib\io();
        $NoiDung = $io->readFile("data/video.js");
        echo $NoiDung;
    }

    function homeslideput() {
        $this->Bread[] = [
            "title" => "Quản lý Banner Động",
            "link" => "/madv/homeslide"
        ];
        $this->Bread[] = [
            "title" => "Sửa quảng cáo",
            "link" => "/madv/"
        ];
        $id = $this->getParam()[0];
        $adv = new \Model\adv($id);
//        var_dump($adv);
        $_bre = new Model\Breadcrumb();
        $_bre->setBreadcrumb($this->Bread);
        $this->ViewTheme(["adv" => $adv], Model_ViewTheme::get_viewthene(), "page");
    }

}
