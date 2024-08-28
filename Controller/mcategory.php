<?php

use Datatable\Response;
use Model\CategoryForm;

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
        $indexPage = $_REQUEST["indexPage"] ?? 1;
        $pageNumber = $_REQUEST["pageNumber"] ?? 10;
        $Name = $_REQUEST["Name"] ?? '';
        $params["Name"] = $Name;
        $params["indexPage"] = $indexPage;
        $params["pageNumber"] = $pageNumber;
        $ModelCategorys = new Model\Category();
        $Tong = 0;
        $data = $ModelCategorys->GetItems($params, $indexPage, $pageNumber, $Tong);

        $respon = new Response();
        $respon->rows = $data;
        $respon->items = $data;
        $respon->params = $params;
        $respon->mess = "";
        $respon->status = Response::OK;
        $respon->indexPage = $indexPage;
        $respon->number = $pageNumber;
        $respon->columns = $ModelCategorys->ColumnsTable();
        $respon->totalrows = $Tong;
        $respon->totalPage = ceil($Tong / $pageNumber);
        $this->ViewTheme(["DataTable" => $respon], Model_ViewTheme::get_viewthene(), "mproduct");
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
        if (isset($_POST[CategoryForm::FormNanme])) {
            $dataPost = $_POST[CategoryForm::FormNanme];
            $Cat = $this->Category->Category4Id($dataPost["catID"], FALSE);
            $_cat = new \Model\Category($Cat);
            $Cat["catName"] = $this->Category->Bokytusql($dataPost["catName"]);
            $Cat["Note"] = $this->Category->Bokytusql($dataPost["Note"]);
            $Cat["Lang"] = "vi";
            $Cat["parentCatID"] = intval($dataPost["parentCatID"]);
            $Cat["Serial"] = $dataPost["Serial"];
            $Cat["banner"] = $dataPost["banner"];
            $Cat["Public"] = intval($dataPost["Public"]);
            $this->Category->EditCategory($Cat);
            $Cat["Link"] = $_cat->linkCurentCategory();
            $this->Category->EditCategory($Cat);
            lib\Common::ToUrl($_SERVER["HTTP_REFERER"]);
        }
        Model\Breadcrumb::AddBreadcrumb([
            "link" => "/mcategory/index/",
            "title" => "Danh sách danh mục"
        ]);
        Model\Breadcrumb::AddBreadcrumb([
            "link" => "/mcategory/edit/",
            "title" => "Sửa"
        ]);
        $this->ViewTheme(["id" => $this->getParam()[0]], Model_ViewTheme::get_viewthene(), "");
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

        if (isset($_POST[CategoryForm::FormNanme])) {
            $dataPost = $_POST[CategoryForm::FormNanme];
            $Cat["catName"] = $this->Category->Bokytusql($dataPost["catName"]);
            $Cat["Note"] = $this->Category->Bokytusql($dataPost["Note"]);
            $Cat["parentCatID"] = intval($dataPost["parentCatID"]);
            $Cat["Path"] = $this->Category->bodautv($Cat["catName"]);
            $Cat["Link"] = "";
            $Cat["Lang"] = "vi";
            $Cat["banner"] = $dataPost["banner"];
            $Cat["Serial"] = intval($dataPost["Serial"]);
            $Cat["Public"] = isset($dataPost["Public"]) ? 1 : 0;
            $Cat = $this->Category->AddCategory($Cat);
            if ($Cat) {
                $_cat = new \Model\Category($Cat);
                $Cat["Link"] = $_cat->linkCurentCategory();
                $this->Category->EditCategory($Cat);
                $this->Category->_header("/mcategory/edit/" . $Cat["catID"]);
            }
        }
        Model\Breadcrumb::AddBreadcrumb([
            "link" => "/mcategory/index/",
            "title" => "Danh sách danh mục"
        ]);
        Model\Breadcrumb::AddBreadcrumb([
            "link" => "/mcategory/add/",
            "title" => "Thêm"
        ]);
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