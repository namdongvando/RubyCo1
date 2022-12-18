<?php

use Module\duser\Model\Duser;

class Controller_mpage extends Controller_backend
{

    public $page;

    function __construct()
    {
        $this->page = new \Model\pages();
        $a = new lib\form();
        $a->createFormByClassToFile("\Model\pages", "page");
        parent::__construct();
        ob_start();
        Model\Breadcrumb::setMenuAcrive(__CLASS__);
        $this->Bread[] = [
            "title" => "Danh Mục Bài Viết",
            "link" => "/mpage/"
        ];
        \Model\Breadcrumb::setMenuAcrive("QuanLyBaiViet");
        $path = "/public/img/";
        Model\pathCkFinder::set($path);
    }

    function index()
    {
        if (isset($_POST["Save"])) {
            $pages = new Model\pages();
            foreach ($_POST["GroupId"] as $id => $value) {
                $_p = $pages->PagesById($id, FALSE);
                $_p["idGroup"] = $value;
                $pages->editPages($_p);
            }
        }
        $Bread = new \Model\Breadcrumb();
        $Bread->setBreadcrumb($this->Bread);
        $news = new \Model\news();
        $Tong = 0;
        $indexPages = isset($this->getParam()[0]) ? $this->getParam()[0] : 1;
        $indexPage = max($indexPages, 1);
        $Number = 10;
        $Name = '';
        $newsdata = $news->DanhSachTinPT($indexPage, $Number, $Name, $Tong);
       
        $this->ViewTheme(["NewsData" => $newsdata], Model_ViewTheme::get_viewthene(), "page");
    }

    function deletepage()
    {
        try {
            if (Duser::CheckQuyen([Duser::CodeSuperAdmin, Duser::$CodeAdmin]) == FALSE) {
                throw new Exception("Bạn không có quyển xóa");
            }
            $id = $this->param[0];
            $pageService = new Model\Pages\PagesService();
            $p = $pageService->GetById($id);
            $p["isShow"] = -1;
            $pageService->Put($p);
            //        $this->page->DeletePages($id);
            $this->page->_header("/mpage/index/");
        } catch (Exception $exc) {
            new Model\Error(["danger", $exc->getMessage()]);
        }
        $this->page->_header("/mpage/index/");
    }

    function editpage()
    {
        if (isset($_POST["pages"])) {
            $pages = $_POST["pages"];
            $edit = $this->page->PagesById($pages["idPa"], FALSE);
            foreach ($pages as $k => $value) {
                $edit[$k] = $value;
            }
            $this->page->editPages($edit);
        }


        $data["p"] = $this->page->PagesById($this->param[0], FALSE);
        $M_Pages = new \Model\pages($data["p"]);
        $Bread = new \Model\Breadcrumb();
        $this->Bread[] = [
            "title" => $M_Pages->Name,
            "link" => "/mpage/"
        ];
        $Bread->setBreadcrumb($this->Bread);
        $this->ViewTheme($data, Model_ViewTheme::get_viewthene(), "page");
    }

    function addpage()
    {
        if (isset($_POST["AddPage"])) {
            $edit = $this->page->Pages(FALSE);
            $edit = $edit[0];
            $img = "";
            $urlimg = "public/img/images/pages/" . date("Y") . "/" . date("m") . "/";
            if (isset($_FILES["Fileimages"])) {
                if ($_FILES["Fileimages"]["error"] == 0) {
                    $img = $this->page->upload_image1($_FILES["Fileimages"], $urlimg, "pages-" . $_POST["idPa"], true);
                    $img = explode("public/img/", BASE_URL . $img);
                    $img = "/public/img/" . $img[1];
                }
            }
            foreach ($edit as $k => $value) {
                $edit[$k] = isset($_POST[$k]) ? $this->page->BoHieuUngSQL($_POST[$k]) : null;
            }
            $edit["Urlimages"] = $img;
            $edit["Alias"] = $this->page->bodautv($edit["Name"]);
            $index = 1;
            while ($this->page->PagesByAlias($edit["Alias"], FALSE)) {
                $edit["Alias"] = $edit["Alias"] . '-' . $index;
                $index++;
            }
            $edit["Note"] = $_POST["Note"] == "" ? "{}" : $_POST["Note"];
            $edit["OrderBy"] = intval($edit["OrderBy"]);
            $edit["isShow"] = intval($edit["isShow"]);
            $edit["idGroup"] = intval($edit["idGroup"]);
            $edit["Type"] = intval($edit["Type"]);

            //            unset($edit["idPa"]);

            $this->page->addPages($edit);
            $this->page->_header('/mpage/editpage/' . $edit["idPa"]);
        }

        $data["p"] = $this->page->PagesById($this->param[0], FALSE);
        $Bread = new \Model\Breadcrumb();
        $this->Bread[] = [
            "title" => "Thêm Trang Mới",
            "link" => "/"
        ];
        $Bread->setBreadcrumb($this->Bread);
        $this->ViewTheme($data, Model_ViewTheme::get_viewthene(), "page");
    }

    function detail()
    {

        $data["p"] = $this->page->PagesById($this->param[0], FALSE);
        $Bread = new \Model\Breadcrumb();
        $this->Bread[] = [
            "title" => "Chi Tiết T",
            "link" => "/"
        ];
        $Bread->setBreadcrumb($this->Bread);
        $this->ViewTheme($data, Model_ViewTheme::get_viewthene(), "page");
    }

    function getPages()
    {
        $a = $this->page->Pages(FALSE);
        $dataJSon = [];

        foreach ($a as $key => $value) {

            $_Pages = new \Model\pages($value);
            $dataJSon[] = $_Pages->ToArrayJson();
        }
        echo $this->page->_encode($dataJSon);
    }

    function getPagesOptions()
    {
        $parent = $this->getParam()[0];

        $parent = intval($parent);

        if ($parent >= 0) {
            $a = $this->page->PagesByGroup($parent, FALSE);
        } else {
            $a = $this->page->Pages(FALSE);
        }
        $dataJSon = [];
        $dataJSon[] = [
            "idPa" => "0", "Name" => "Là Cấp Cha", "Alias" => "", "isShow" => "0", "Type" => "0", "OrderBy" => "", "TypeName" => ""
        ];
        foreach ($a as $key => $value) {
            $_Pages = new \Module\pages\Model\pages($value);
            $dataJSon[] = $_Pages->ToArrayJson();
        }
        echo $this->page->_encode($dataJSon);
    }

    function importdata()
    {
    }

    function __destruct()
    {
        $str = ob_get_clean();
        $params = parse_ini_file(__DIR__ . '/../public/language/editpages.ini', true);
        $DSOption = $params;
        if ($DSOption)
            foreach ($DSOption as $k => $value) {
                $str = str_replace($k, $value, $str);
            }
        echo $str;
    }
}
