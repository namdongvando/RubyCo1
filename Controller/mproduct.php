<?php

class Controller_mproduct extends Controller_backend {

    public $Product;

    function __construct() {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $this->Product = new \Model\Products();
        parent::__construct();
    }

    function index() {

        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "mproduct");
    }

    function GetProductPT() {
        $pageIndex = $this->getParam()[0];
        $pageNumber = $this->getParam()[1];
        $ModelProducts = new Model\Products();
        $Tong = 0;
        $data = $ModelProducts->ProductsAllPT($pageIndex, $pageNumber, $Tong);
        $data = $ModelProducts->ListToArrayAPi($data);
        echo lib\APIs::dataResful($data, $pageIndex, $pageNumber, $Tong);
    }

    function ThemNhanSanPhan() {
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

    function productnoprice() {

        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "mproduct");
    }

    function editproduct() {

        if (isset($_POST["LuuSanPham"])) {
            $Product = $_POST["Product"];
            $editP = $this->Product->ProductsByID($Product['ID'], FALSE);
            $editP['nameProduct'] = $Product["nameProduct"];
            $editP['Alias'] = $this->Product->bodautv($Product["nameProduct"]);
            $editP['catID'] = $Product["catID"];
            $editP['Price'] = $Product["Price"];
            $editP['Summary'] = $Product["Summary"];
            $editP['Content'] = $Product["Content"];
            $editP['UrlHinh'] = $Product['UrlHinh'];
            $editP['Note'] = json_encode($Product["Note"]);
            $editP['isShow'] = intval($Product["isShow"]);

            $this->Product->EditProducts($editP);
//            $this->Product->_header("/mproduct/detailproduct/" . $editP["ID"]);
        }

        $data["p"] = $this->Product->ProductsByID($this->param[0], FALSE);
        $this->ViewTheme($data, Model_ViewTheme::get_viewthene(), "mproduct");
    }

    function copyproduct() {
        if (isset($_POST["LuuSanPham"])) {
            $_POST['ID'] = $this->Product->bodautv($_POST['nameProduct']);
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
                $img = explode("/images/sanpham/", $_POST["UrlHinh"]);
                $editP['UrlHinh'] = end($img);
                $editP['DateCreate'] = date("Y-m-d H:i:s", time());
                $editP['Number'] = 1;
                $editP['Note'] = $_POST["Note"];
                $editP['BuyTimes'] = 0;
                $editP['isShow'] = isset($_POST["isShow"]) ? 1 : 0;
                $editP['lang'] = "vi";
                if (isset($_FILES["fileImages"])) {
                    if ($_FILES["fileImages"]["error"][0] == 0) {
                        $img = $this->Product->upload_multi_image($_FILES["fileImages"], "public/img/images/sanpham/" . $editP["ID"] . "/", $editP["ID"] . "-");
                        $img = "/" . $img;
                    }
                }
                $this->Product->AddProducts($editP);
            }
            $this->Product->_header("/mproduct/detailproduct/" . $editP["ID"]);
        }
        $data["p"] = $this->Product->ProductsByID($this->param[0], FALSE);
        $this->ViewTheme($data, Model_ViewTheme::get_viewthene(), "mproduct");
    }

    function createformeditproduct() {
        $lib = new lib\form();
        if ($lib->createFormByClassToFile("\Model\Products", "theme\\backend\\mproduct\\editproduct_form.phtml")) {
            $this->Product->_header("/mproduct/editproduct");
        } else {
            echo "khong theo tao";
        }
    }

    function detailproduct() {
        $data["p"] = $this->Product->ProductsByID($this->param[0], FALSE);
        $this->ViewTheme($data, Model_ViewTheme::get_viewthene(), "mproduct");
    }

    function addproduct() {
        if (isset($_POST["ThemSanPham"])) {
            try {
                $SanPham = $_POST["Product"];
                $id = time();
                $addP = $this->Product->ProductsByID($id, FALSE);
                if ($addP) {
                    throw new Exception("Đã Có Sản Phẩm Này");
                }
                $addP['ID'] = $id;
                $addP['nameProduct'] = $SanPham["nameProduct"];
                $addP['Alias'] = $this->Product->bodautv($SanPham["nameProduct"]);
                $addP['Username'] = $_SESSION[QuanTri]["Username"];
                $addP['catID'] = $SanPham["catID"];
                $addP['Price'] = $SanPham["Price"];
                $addP['oldPrice'] = 0;
                $addP['Views'] = 0;
                $addP['Summary'] = $SanPham["Summary"];
                $addP['Content'] = $SanPham["Content"];
                if (isset($SanPham['UrlHinh']))
                    $addP['UrlHinh'] = $SanPham['UrlHinh'];
                $addP['DateCreate'] = date("Y-m-d H:i:s", time());
                $addP['Number'] = 1;
                $addP['Serial'] = 1;
                $addP['Note'] = $SanPham["Note"];
                $addP['BuyTimes'] = 0;
                $addP['isShow'] = intval($addP['isShow']);
                $addP['lang'] = $addP['lang'];

                $this->Product->AddProducts($addP);
                $this->Product->_header("/mproduct/editproduct/" . $addP["ID"]);
            } catch (Throwable $exc) {
                $exc->getMessage();
            }
        }
        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "mproduct");
    }

    function deleteproduct() {
        $data["p"] = $this->Product->DeleteProductsByID($this->param[0]);

        $this->Product->_header($_SERVER["HTTP_REFERER"]);
    }

    function getProductsBycatID() {
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

    function getListCategory() {
        $a = new \Model\Category();
        $b = $a->AllCategorys(FALSE);
        echo $a->_encode($b);
    }

    function xoahinhsanpham() {
        $a = file_get_contents('php://input');
        $b = $this->Product->_decode($a);
        $c = substr($b->path, 1);
        unlink($c);
    }

    function savePriceProduct() {
        $Pr = new Model\Products();
        $P = $Pr->ProductsByID($_POST["ID"], false);
        if ($P) {
            $P["Price"] = $_POST["Price"];
            $Pr->EditProducts($P);
        }
    }

    function seachajax() {

        $name = $_POST["Name"];
        $product = new Model\Products();
        $a = $product->ProductsByName($name);
        foreach ($a as $key => $value) {
            $a[$key] = $this->ProducttoJSON($value);
        }
        echo json_encode($a, JSON_UNESCAPED_UNICODE);
    }

    function seach() {
        $this->ViewTheme([], Model_ViewTheme::get_viewthene(), "mproduct");
    }

    function productnopriceAjax() {
        $product = new Model\Products();
        $a = $product->ProductsNoPrice();
        foreach ($a as $key => $value) {
            $a[$key] = $this->ProducttoJSON($value);
        }
        echo json_encode($a, JSON_UNESCAPED_UNICODE);
    }

    private function ProducttoJSON($p) {
        $v = new Model\Products($p);
        unset($p["Content"]);
        unset($p["Summary"]);
        $p["Image"] = $v->UrlHinh();
        $p["Category"] = $v->DanhMuc();
        return $p;
    }

}

?>