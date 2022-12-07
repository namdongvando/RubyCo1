<?php

class Controller_mcategory extends Controller_backend
{

    public $Category;

    function __construct()
    {
        $this->Category = new Model\Category();
        parent::__construct();
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        Model\Breadcrumb::setMenuAcrive(__CLASS__);
    }

    function index()
    {
        $this->Bread[] = [
            "title" => "Danh Mục Sản Phẩn",
            "link" => "/mpage/"
        ];
        $Bread = new \Model\Breadcrumb();
        $Bread->setBreadcrumb($this->Bread);
        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "");
    }

    function detail()
    {

        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "");
    }

    function editorderby()
    {

        if (isset($_POST["saveOrderBy"])) {
            foreach ($_POST["orderBy"] as $id => $value) {
                $Cat = $this->Category->Category4Id($id, FALSE);
                $Cat["Serial"] = $value + 1;
                $this->Category->EditCategory($Cat);
            }
        }
        $this->Category->_header("/mcategory/index");
    }

    function edit()
    {
        if (isset($_POST["SuaDanhMuc"])) {
            $Cat = $this->Category->Category4Id($_POST["catID"], FALSE);
            $_cat = new \Model\Category($Cat);
            $Cat["catName"] = $this->Category->Bokytusql($_POST["catName"]);
            $Cat["Note"] = $this->Category->Bokytusql($_POST["Note"]);
            $Cat["Lang"] = "vi";
            $Cat["parentCatID"] = intval($_POST["parentCatID"]);
            $Cat["Serial"] = $_POST["Serial"];
            $Cat["banner"] = $_POST["banner"];
            $Cat["Public"] = isset($_POST["Public"]) ? 1 : 0;
            $kt = $this->Category->EditCategory($Cat);
            if ($kt > 0) {
                $Cat["Link"] = $_cat->linkCurentCategory();
                $this->Category->EditCategory($Cat);
                //                $this->Category->_header("/mcategory/detail/" . $_POST["catID"]);
                lib\Common::ToUrl($_SERVER["HTTP_REFERER"]);
            } else {
                $M_error = new \Model\Error([]);
                $M_error->setError($this->Category->getError($kt), 'danger');
            }
        }

        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "");
    }

    function copy()
    {

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        if (isset($_POST["SuaDanhMuc"])) {
            $Cat["catName"] = $this->Category->Bokytusql($_POST["catName"]);
            $Cat["Note"] = $this->Category->Bokytusql($_POST["Note"]);
            $Cat["parentCatID"] = intval($_POST["parentCatID"]);
            $Cat["Path"] = $this->Category->bodautv($Cat["catName"]);
            $Cat["Link"] = "";
            $Cat["Lang"] = "vi";
            $Cat["banner"] = "";
            $Cat["Serial"] = intval($_POST["Serial"]);
            $Cat["Public"] = isset($_POST["Public"]) ? 1 : 0;
            $Cat = $this->Category->AddCategory($Cat);
            if ($Cat) {
                $_cat = new \Model\Category($Cat);
                $Cat["Link"] = $_cat->linkCurentCategory();
                $this->Category->EditCategory($Cat);
            } else {
                $M_error = new \Model\Error([]);
                $M_error->setError($this->Category->getError($kt), 'danger');
            }
        }
        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "");
    }

    function add()
    {

        if (isset($_POST["ThemDanhMuc"])) {
            $Cat["catName"] = $this->Category->Bokytusql($_POST["catName"]);
            $Cat["Note"] = $this->Category->Bokytusql($_POST["Note"]);
            $Cat["parentCatID"] = intval($_POST["parentCatID"]);
            $Cat["Path"] = $this->Category->bodautv($Cat["catName"]);
            $Cat["Link"] = "";
            $Cat["Lang"] = "vi";
            $Cat["banner"] = "";
            $Cat["Serial"] = intval($_POST["Serial"]);
            $Cat["Public"] = isset($_POST["Public"]) ? 1 : 0;
            $Cat = $this->Category->AddCategory($Cat);
            if ($Cat) {
                $_cat = new \Model\Category($Cat);
                $Cat["Link"] = $_cat->linkCurentCategory();
                $this->Category->EditCategory($Cat);
                $this->Category->_header("/mcategory/detail/" . $Cat["catID"]);
            } else {
                $M_error = new \Model\Error();
                $M_error->setError($this->Category->getError($kt), 'danger');
            }
        }
        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "");
    }

    function delete()
    {
        if (isset($_POST["xoadanhmuc"])) {
            $this->Category->DeleteCategory($_POST["catID"]);
            $this->Category->_header("/mcategory/index");
        }
    }

    function deleteid()
    {
        $id = $this->getParam()[0];
        $this->Category->DeleteCategory($id);
        $this->Category->_header("/mcategory/index");
    }

    function categorys()
    {

        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "");
    }

    function getCategoryByID()
    {
        $a = $this->Category->Category4Id($this->param[0], FALSE);
        echo $this->Category->_encode($a);
    }

    function getCategorys()
    {
        $a = $this->Category->getCategorys();
        echo $this->Category->_encode($a);
    }

    function import()
    {

        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "");
    }

    function catchil()
    {
        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "");
    }
}
