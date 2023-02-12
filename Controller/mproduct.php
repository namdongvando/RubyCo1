<?php

use Datatable\Response;
use lib\input;
use Model\Products;
use Model\ProductsForm;

class Controller_mproduct extends Controller_backend
{

    public $Product;

    function __construct()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $this->Product = new \Model\Products();
        parent::__construct();
        $path = "/public/img/";
        Model\pathCkFinder::set($path);
    }
    function index()
    {
        $indexPage = $_REQUEST["indexPage"] ?? 1;
        $pageNumber = $_REQUEST["pageNumber"] ?? 10;
        $Name = $_REQUEST["Name"] ?? '';
        $params["Name"] = $Name;
        $params["indexPage"] = $indexPage;
        $params["pageNumber"] = $pageNumber;
        $ModelProducts = new Model\Products();
        $Tong = 0;
        $data = $ModelProducts->ProductsAllPT($indexPage, $pageNumber, $Tong);
        $respon = new Response();
        $respon->rows = $data;
        $respon->items = $data;
        $respon->params = $params;
        $respon->mess = "";
        $respon->status = Response::OK;
        $respon->indexPage = $indexPage;
        $respon->number = $pageNumber;
        $respon->columns = $ModelProducts->ColumnsTable();
        $respon->totalrows = $Tong;
        $respon->totalPage = ceil($Tong / $pageNumber);

        $this->ViewTheme(["DataTable" => $respon], Model_ViewTheme::get_viewthene(), "mproduct");
    }

    function GetProductPT()
    {
        $pageIndex = $this->getParam()[0];
        $pageNumber = $this->getParam()[1];
        $ModelProducts = new Model\Products();
        $Tong = 0;
        $data = $ModelProducts->ProductsAllPT($pageIndex, $pageNumber, $Tong);
        $data = $ModelProducts->ListToArrayAPi($data);
        echo lib\APIs::dataResful($data, $pageIndex, $pageNumber, $Tong);
    }

    function ThemNhanSanPhan()
    {
        if (isset($_POST["ThemSanPham"])) {
            $_POST['ID'] = $this->Product->bodautv($_POST['ID']);
            $io = new \lib\io();
            $io->writeFile("data/product/" . md5($_POST['ID']), json_encode($_POST));
            $editP = $this->Product->ProductsByID(intval($_POST['ID']), FALSE);

            if (!$editP) {
                $editP['ID'] = $_POST["ID"];
                $editP['nameProduct'] = $_POST["nameProduct"];
                $editP['Alias'] = $this->Product->bodautv($_POST["nameProduct"]);
                $editP['Username'] = $_SESSION[QuanTri]["Username"];
                $editP['catID'] = $_POST["catID"];
                $editP['Price'] = $_POST["Price"];
                $editP['oldPrice'] = $_POST["oldPrice"];
                $editP['Summary'] = $_POST["Summary"];
                $editP['Content'] = $_POST["Content"];
                $images = new \lib\images\images();
                try {
                    $imagesUrl = $images->getImagesFromUrl($_POST["UrlHinh"]);
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                }
                $img = explode("/images/sanpham/", $imagesUrl);
                $editP['UrlHinh'] = end($img);
                $editP['DateCreate'] = date("Y-m-d H:i:s", time());
                $editP['Number'] = 1;
                $editP['Note'] = "";
                $editP['BuyTimes'] = 0;
                $editP['Views'] = 0;
                $editP['Serial'] = time();
                $editP['isShow'] = isset($_POST["isShow"]) ? 1 : 0;
                $editP['lang'] = "vi";

                $this->Product->AddProducts($editP);
            }
        }
        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "mproduct");
    }

    function productnoprice()
    {

        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "mproduct");
    }

    function editproduct()
    {

        if (isset($_POST["LuuSanPham"])) {
            $SanPham = $_POST[ProductsForm::formName];
            $editP = new Products($SanPham['Id']);
            foreach ((array)$editP as $key => $value) {
                $editP->$key = input::InputText($SanPham[$key] ?? "");
            }
            $editP->OldPrice = floatval($SanPham["OldPrice"] ?? 0);
            $editP->Alias = $this->Product->bodautv($SanPham["Name"]);
            $editP->Price = floatval($SanPham["Price"] ?? 0);
            $editP->Number = floatval($SanPham["Number"] ?? 0);
            $editP->BuyTimes = floatval($SanPham["BuyTimes"] ?? 0);
            $editP->Views = floatval($SanPham["Views"] ?? 0);
            $editP->Serial = floatval($SanPham["Serial"] ?? 0);
            $editP->DateCreate = date("Y-m-d", time());
            $products = new Products();
            $products->EditProducts((array)$editP);
        }

        $data["p"] = $this->Product->ProductsByID($this->param[0], FALSE);
        $this->ViewTheme($data, Model_ViewTheme::get_viewthene(), "mproduct");
    }

    function copyproduct()
    {
        if (isset($_POST["LuuSanPham"])) {
            try {
                $SanPham = $_POST[ProductsForm::formName];
                $id = time();
                $modelProducts = new Products();
                foreach ((array)$modelProducts as $key => $value) {
                    $modelProducts->$key = input::InputText($SanPham[$key] ?? "");
                }
                $modelProducts->Id = $id;
                $modelProducts->OldPrice = floatval($SanPham["OldPrice"] ?? 0);
                $modelProducts->Price = floatval($SanPham["Price"] ?? 0);
                $modelProducts->Alias = $this->Product->bodautv($SanPham["Name"]);
                $modelProducts->Number = floatval($SanPham["Number"] ?? 0);
                $modelProducts->BuyTimes = floatval($SanPham["BuyTimes"] ?? 0);
                $modelProducts->Views = floatval($SanPham["Views"] ?? 0);
                $modelProducts->Serial = floatval($SanPham["Serial"] ?? 0);
                $modelProducts->DateCreate = date("Y-m-d", time());
                $products = new Products();
                $products->AddProducts((array)$modelProducts);
                $products->_header("/mproduct/editproduct/" . $modelProducts->Id);
            } catch (Exception $exc) {
                echo $exc->getMessage();
            }
        }
        $data["p"] = $this->Product->ProductsByID($this->param[0], FALSE);
        $this->ViewTheme($data, Model_ViewTheme::get_viewthene(), "mproduct");
    }

    function createformeditproduct()
    {
        $lib = new lib\form();
        if ($lib->createFormByClassToFile("\Model\Products", "theme\\backend\\mproduct\\editproduct_form.phtml")) {
            $this->Product->_header("/mproduct/editproduct");
        } else {
            echo "khong theo tao";
        }
    }

    function detailproduct()
    {
        $data["p"] = $this->Product->ProductsByID($this->param[0], FALSE);
        $this->ViewTheme($data, Model_ViewTheme::get_viewthene(), "mproduct");
    }

    function addproduct()
    {
        if (isset($_POST["ThemSanPham"])) {
            try {
                $SanPham = $_POST[ProductsForm::formName];
                $id = time();
                $modelProducts = new Products();
                foreach ((array)$modelProducts as $key => $value) {
                    $modelProducts->$key = input::InputText($SanPham[$key] ?? "");
                }
                $modelProducts->Id = $id;
                $modelProducts->OldPrice = floatval($SanPham["OldPrice"] ?? 0);
                $modelProducts->Alias = $this->Product->bodautv($SanPham["Name"]);
                $modelProducts->Price = floatval($SanPham["Price"] ?? 0);
                $modelProducts->Number = floatval($SanPham["Number"] ?? 0);
                $modelProducts->BuyTimes = floatval($SanPham["BuyTimes"] ?? 0);
                $modelProducts->Views = floatval($SanPham["Views"] ?? 0);
                $modelProducts->Serial = floatval($SanPham["Serial"] ?? 0);
                $modelProducts->DateCreate = date("Y-m-d", time());
                $products = new Products();
                $products->AddProducts((array)$modelProducts);
                $products->_header("/mproduct/editproduct/" . $modelProducts->Id);
            } catch (Exception $exc) {
                echo $exc->getMessage();
            }
        }

        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "mproduct");
    }

    function deleteproduct()
    {
        $data["p"] = $this->Product->DeleteProductsByID($this->param[0]);

        $this->Product->_header($_SERVER["HTTP_REFERER"]);
    }

    function getProductsBycatID()
    {
        //        mproduct/getProductsBycatID/CatID/Page/
        $this->param[1] = isset($this->param[1]) ? intval($this->param[1]) : 1;
        $a = new \Model\Category();
        $p = new \Model\Products();
        $listCatID = [];
        $a->AllCategoryByParentID([$this->param[0]], $listCatID);
        $b = $p->ProductsByCatID($this->param[0], $this->param[1], 50, $sum);
        if (count($b) > 0) {
            echo $a->_encode($b);
        } else {
            echo "[]";
        }
    }

    function getListCategory()
    {
        $a = new \Model\Category();
        $b = $a->AllCategorys(FALSE);
        echo $a->_encode($b);
    }

    function xoahinhsanpham()
    {
        $a = file_get_contents('php://input');
        $b = $this->Product->_decode($a);
        $c = substr($b->path, 1);
        unlink($c);
    }

    function savePriceProduct()
    {
        $Pr = new Model\Products();
        $P = $Pr->ProductsByID($_POST["ID"], false);
        if ($P) {
            $P["Price"] = $_POST["Price"];
            $Pr->EditProducts($P);
        }
    }

    function seachajax()
    {

        $name = $_POST["Name"];
        $product = new Model\Products();
        $a = $product->ProductsByName($name);
        foreach ($a as $key => $value) {
            $a[$key] = $this->ProducttoJSON($value);
        }
        echo json_encode($a, JSON_UNESCAPED_UNICODE);
    }

    function seach()
    {
        $this->ViewTheme([], Model_ViewTheme::get_viewthene(), "mproduct");
    }

    function productnopriceAjax()
    {
        $product = new Model\Products();
        $a = $product->ProductsNoPrice();
        foreach ($a as $key => $value) {
            $a[$key] = $this->ProducttoJSON($value);
        }
        echo json_encode($a, JSON_UNESCAPED_UNICODE);
    }

    private function ProducttoJSON($p)
    {
        $v = new Model\Products($p);
        unset($p["Content"]);
        unset($p["Summary"]);
        $p["Image"] = $v->UrlHinh();
        $p["Category"] = $v->DanhMuc();
        return $p;
    }
}
