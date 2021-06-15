<?php

namespace Module\pages\Controller;

class index extends \Controller_backend {

    public $page;

    function __construct() {
        $this->page = new \Module\pages\Model\pages();
        parent::__construct();
    }

    function index() {
        $_Pages = $this->page->PagesById($this->param[0]);
        $Bread = new \Model\Breadcrumb();
        $Bread->setBreadcrumb($this->Bread);
        $this->ViewThemeModule("", "", "page");
    }

    function editpage() {
        if (isset($_POST["SuaPage"]) || isset($_POST["SuaPageBack"])) {
            $edit = $this->page->PagesById($_POST["Pages"]["idPa"], FALSE);
            if($edit) {
                $edit = $_POST['Pages'];
                $edit["Alias"] = $this->page->bodautv($edit["Name"]);
                $img = $edit["Urlimages"];
                $urlimg = "public/img/images/pages/" . date("Y") . "/" . date("m") . "/";
                if (isset($_FILES["Fileimages"])) {
                    $imgHinh = substr($img, 1);
                    if (is_file($imgHinh)) {
                        unlink($imgHinh);
                    }
                    if ($_FILES["Fileimages"]["error"] == 0) {
                        $img = $this->page->upload_image1($_FILES["Fileimages"], $urlimg, "pages-" . $edit["Alias"], true);
                        $img = explode("public/img/", BASE_URL . $img);
                        $img = "/public/img/" . $img[1];
                    }
                }
                
                $edit["Urlimages"] = $img;
                $edit["Note"] = $_POST["Note"] == "" ? "{}" : $_POST["Note"];
                $this->page->editPages($edit);
                if (isset($_POST["SuaPage"])) {
                    $this->page->_header('/pages/index/editpage/' . $edit["idPa"]);
                } else {
                    $this->page->_header('/pages/index/');
                }
            }
        }
        $data["p"] = $this->page->PagesById($this->param[0], FALSE);
        $M_Pages = new \Model\pages($data["p"]);
        $Bread = new \Model\Breadcrumb();
        $this->Bread[] = [
            "title" => $M_Pages->Name,
            "link" => "/pages/index/"
        ];
        $Bread->setBreadcrumb($this->Bread);
        $this->ViewThemeModule($data, "", "page");
    }

    function addpage() {
        if (isset($_POST["AddPage"])) {

            $edit = get_class_vars("\Module\pages\Model\pages");
            $edit = $_POST["Pages"];

            $img = "";
            $edit["Alias"] = $this->page->bodautv($edit["Name"]);
            $urlimg = "public/img/images/pages/" . date("Y") . "/" . date("m") . "/";
            if (isset($_FILES["Fileimages"])) {
                if ($_FILES["Fileimages"]["error"] == 0) {
                    $img = $this->page->upload_image1($_FILES["Fileimages"], $urlimg, "pages-" . $edit["Alias"], true);
                    $img = explode("public/img/", BASE_URL . $img);
                    $img = "/public/img/" . $img[1];
                }
            }
            $edit["Urlimages"] = $img;
            $edit["Note"] = $edit["Note"] == "" ? "{}" : $edit["Note"];
            $edit["idPa"] = $this->page->addPages($edit);
            $this->page->_header('/pages/index/editpage/' . $edit["idPa"]);
        }

        $data["p"] = $this->page->PagesById($this->param[0], FALSE);
        $Bread = new \Model\Breadcrumb();
        $this->Bread[] = [
            "title" => "Thêm Trang Mới",
            "link" => "/"
        ];
        $Bread->setBreadcrumb($this->Bread);
        $this->ViewThemeModule("", "", "page");
    }

    function getPages() {
        $a = $this->page->Pages(FALSE);
        echo $this->page->_encode($a);
    }

    function deletepage() {
        $this->page->DeletePages($this->param[0]);
        $this->page->_header("/pages/");
    }

}

?>