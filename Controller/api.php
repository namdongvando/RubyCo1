<?php

// api này không cần dang nhap
class Controller_api extends Controller_index {

    public $param;
    public $Menu;
    static private $version = "111";

    function __construct() {
        parent::__construct();
        $this->Menu = new \Model\Menu();
        $this->param = $this->getParam();
    }

    function version() {
        $a = ["Version" => session_id()];
        $a = ["Version" => time()];
        $lib = new \lib\APIs();
        $lib->ArrayToApi($a);
    }

    function baivietmoinhat() {
        $news = new Model\news();
        $DanhSachTinMoiNhat = $news->DanhSachTinMoiNhat();
        $data = [];
        foreach ($DanhSachTinMoiNhat as $k => $value) {
            $_news = new Model\news($value);

            $data[] = $_news->ToArrayJson();
        }
        $Api = new lib\APIs();
        $Api->ArrayToApi($data);
    }

    function VanBanPhapLuat() {

        $TaiSao = \theme\ThemeConfig::getThemConfigByKey(\theme\ThemeConfig::VanBanPhapLuat);

        $Pa = new \Model\pages();
        $PaAr = $Pa->PagesById($TaiSao, FALSE);
        $_pa = new \Model\pages($PaAr);
        $news = $_pa->NewsByPages($TaiSao, FALSE);
        $data["Pages"] = $_pa->ToArrayJson();
        $data["News"] = [];
        if ($news)
            foreach ($news as $news) {
                $_news = new \Model\news($news);
                $data["News"][] = $_news->ToArrayJson();
            }

        $Api = new lib\APIs();
        $Api->ArrayToApi($data);
    }

    function TaiSaoChonChungToi() {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $TaiSao = \theme\ThemeConfig::getThemConfigByKey(\theme\ThemeConfig::TaiSaoChonChungToi);

        $Pa = new \Model\pages();
        $PaAr = $Pa->PagesById($TaiSao, FALSE);
        $_pa = new \Model\pages($PaAr);
        $news = $_pa->NewsByPages($TaiSao, FALSE);
        $data["Pages"] = $_pa->ToArrayJson();
        $data["News"] = [];
        if ($news)
            foreach ($news as $news) {
                $_news = new \Model\news($news);
                $data["News"][] = $_news->ToArrayJson();
            }

        $Api = new lib\APIs();
        $Api->ArrayToApi($data);
    }

    function baivietnoibat() {
        $news = new Model\news();
        $DanhSachTinMoiNhat = $news->DanhSachTinNoiBat(10);
        $data = [];
        foreach ($DanhSachTinMoiNhat as $k => $value) {
            $_news = new Model\news($value);
            $data[] = $_news->ToArrayJson();
        }
        $Api = new lib\APIs();
        $Api->ArrayToApi($data);
    }

    function index() {
        $cat = new Model\Category();
        $a = $cat->Categorys4IDParent(0);
        $cat->_encode($a);
    }

    function getMainMenu() {
        $cat = new Model\Category();
        $a = $cat->Categorys4IDParent(0);
        if ($a)
            foreach ($a as $k => $cata) {
                $a[$k]->DSDanhMucCon = $cat->Categorys4IDParent($cata->catID);
                if ($a[$k]->DSDanhMucCon)
                    foreach ($a[$k]->DSDanhMucCon as $k1 => $cata1) {
                        $a[$k]->DSDanhMucCon[$k1]->DSDanhMucCon = $cat->Categorys4IDParent($cata1->catID);
                    }
            }
        echo $cat->_encode($a);
    }

    function getMenus() {
        $Menu = [];
        $a = $this->Menu->MenuByGroupThemeParent("home", "TopMainMenu", 0, FALSE);
        $lib = new \lib\APIs();
        foreach ($a as $key => $value) {
            $a[$key]["Id"] = $value["IDMenu"];
            $b = $this->Menu->MenuByGroupThemeParent("home", "TopMainMenu", $a[$key]["Id"], FALSE);
            foreach ($b as $kb => $vb) {
                $b[$kb]["Id"] = $vb["IDMenu"];
                $c = $this->Menu->MenuByGroupThemeParent("home", "TopMainMenu", $b[$kb]["Id"], FALSE);
                $b[$kb]["submenu"] = $c;
            }
            $a[$key]["submenu"] = $b;
        }


        $Menu["TopMainMenu"] = $a;

        $a = $this->Menu->MenuByGroupThemeParent("home", "FooterMenu", 0, FALSE);
        $lib = new \lib\APIs();
        foreach ($a as $key => $value) {
            $a[$key]["Id"] = $value["IDMenu"];
        }
        $Menu["FooterMenu"] = $a;
        $a = $this->Menu->MenuByGroupThemeParent("home", "FooterMenuCongTy", 0, FALSE);
        $lib = new \lib\APIs();
        foreach ($a as $key => $value) {
            $a[$key]["Id"] = $value["IDMenu"];
        }
        $Menu["FooterMenuCongTy"] = $a;

        $a = $this->Menu->MenuByGroupThemeParent("home", "FooterMenuHoTro", 0, FALSE);
        $lib = new \lib\APIs();
        foreach ($a as $key => $value) {
            $a[$key]["Id"] = $value["IDMenu"];
        }
        $Menu["FooterMenuHoTro"] = $a;

        $a = $this->Menu->MenuByGroupThemeParent("home", "FooterMenuDichVu", 0, FALSE);
        $lib = new \lib\APIs();
        foreach ($a as $key => $value) {
            $a[$key]["Id"] = $value["IDMenu"];
        }
        $Menu["FooterMenuDichVu"] = $a;

        $cat = new Model\Category();
        $a = $cat->Categorys4IDParent(0);
        if ($a) {
            foreach ($a as $k => $cata) {
                $a[$k]->DSDanhMucCon = $cat->Categorys4IDParent($cata->catID);
                if ($a[$k]->DSDanhMucCon)
                    foreach ($a[$k]->DSDanhMucCon as $k1 => $cata1) {
                        $a[$k]->DSDanhMucCon[$k1]->DSDanhMucCon = $cat->Categorys4IDParent($cata1->catID);
                    }
            }
        }
        $Menu["LeftMenu"] = $a;
//        $this->TopMainMenu = $this->Menu->_encode($this->TopMainMenu["body"]);
//        $this->FooterMenu = $this->Menu->_encode($this->FooterMenu["body"]);
//        $this->FooterMenuCongTy = $this->Menu->_encode($this->FooterMenuCongTy["body"]);
//        $this->FooterMenuHoTro = $this->Menu->_encode($this->FooterMenuHoTro["body"]);
//        $this->FooterMenuDichVu = $this->Menu->_encode($this->FooterMenuDichVu["body"]);
        $lib->ArrayToApi($Menu);
    }

    function getMenuTopMainMenu() {
        $Menu = [];
        $a = $this->Menu->MenuByGroupThemeParent("home", "TopMainMenu", 0, FALSE);

        if ($a) {
            foreach ($a as $key => $value) {
                $a[$key]["Id"] = $value["IDMenu"];
                unset($a[$key]["IDMenu"]);
                $b = $this->Menu->MenuByGroupThemeParent("home", "TopMainMenu", $a[$key]["Id"], FALSE);
                if ($b)
                    foreach ($b as $kb => $vb) {
                        $b[$kb]["Id"] = $vb["IDMenu"];
                        $c = $this->Menu->MenuByGroupThemeParent("home", "TopMainMenu", $b[$kb]["Id"], FALSE);
                        $b[$kb]["submenu"] = $c;
                    }
                $a[$key]["submenu"] = $b;
            }
        }
        $lib = new \lib\APIs();
        $Menu = $a;
        $lib->ArrayToApi($Menu);
    }

    function getProductByID() {
        $Produc = new Model\Products();
        $_p = $Produc->ProductsByID($this->param[0], FALSE);
        $_p["Content"] = "";
        $_p["Summary"] = "";
        print_r($Produc->_encode($_p));
    }

    function getAdvByGroup() {
        $cat = new \Model\adv();
        $a = $cat->AdvsByGroup($this->param[0], FALSE);
        echo $cat->_encode($a);
    }

    function getPages() {
        $Pa = new \Model\pages();
        $Apis = new \lib\APIs();
        $a = $Pa->PagesByType(1, FALSE);
        $Apis->ArrayToApi($a);
    }

    function getMainMenuThong($param) {

    }

    function getPagesLink() {
        $M_Pages = new \Model\pages();
        $lib = new lib\APIs();
        $a = $M_Pages->PagesMin(FALSE);
        $columPages = get_class($M_Pages);
        foreach ($a as $k => $pages) {
            $_pages = new Model\pages($pages);
            $a[$k]["link"] = $_pages->linkPagesCurent();
        }
        $lib->ArrayToApi($a);
    }

    function getDanhMucLink() {
        $M_Pages = new Model\Category();
        $lib = new lib\APIs();
        $a = $M_Pages->AllCategorys(FALSE);
        $columPages = get_class($M_Pages);
        foreach ($a as $k => $pages) {
            $_pages = new Model\Category($pages);
            $a[$k]["Name"] = $_pages->catName;
            $a[$k]["link"] = $_pages->linkCurentCategory();
        }
        $lib->ArrayToApi($a);
    }

    function getProductsHot() {
        $Produc = new Model\Products();
        $Ps = $Produc->ProductsHotNew(12, FALSE);
        foreach ($Ps as $key => $_ps) {
            $_ps = new Model\Products($_ps);
            $Ps[$key]["UrlHinh"] = $_ps->UrlHinh();
            $Ps[$key]["Price"] = $_ps->Price();
            $Ps[$key]["Summary"] = "";
            $Ps[$key]["Content"] = "";
            $Ps[$key]["Link"] = $_ps->linkProduct();
        }
        $lib = new lib\APIs();
        $lib->ArrayToApi($Ps);
    }

    function getProductsHotView() {
        $Produc = new Model\Products();
        $Ps = $Produc->ProductsHotView(12, FALSE);
        foreach ($Ps as $key => $_ps) {
            $_ps = new Model\Products($_ps);
            $Ps[$key]["UrlHinh"] = $_ps->UrlHinh();
            $Ps[$key]["Price"] = $_ps->Price();
            $Ps[$key]["Summary"] = "";
            $Ps[$key]["Content"] = "";
            $Ps[$key]["Link"] = $_ps->linkProduct();
        }
        $lib = new lib\APIs();
        $lib->ArrayToApi($Ps);
    }

    function gettintuchot() {
        $News = new Model\news();
        $Ps = $News->NewsHot();
        foreach ($Ps as $k => $new) {
            $news = new Model\news($new);
            $Ps[$k]["Content"] = "";
            $Ps[$k]["Image"] = $news->Thumnail();
            $Ps[$k]["Summary"] = "";
            $Ps[$k]["link"] = $news->linkNewsCurent();
        }
        $lib = new lib\APIs();
        $lib->ArrayToApi($Ps);
    }

    function updateHomeSlide() {
        $a = new \Model\adv();
        $libImg = new \lib\imageComp();
        $DS = $a->AdvsByGroup("homeslide", FALSE);
        foreach ($DS as $k => $value) {
            $img = "/" . $libImg->layHinh($value["Urlimages"], 785, 480);
            $Attribute = $a->_decode($value["Attribute"]);
            $DS[$k]["Image"] = $img;
            $DS[$k]["Attribute"] = $Attribute;
        }
        $io = new \lib\io();
        $lib = new \lib\APIs();

        $fileName = "cache/homeslide.json";
        $content = $lib->ArrayToString($DS);
        $io->writeFile($fileName, $content);
        $this->homeslide();
    }

    function homeslide() {
        $io = new \lib\io();
        $fileName = "cache/homeslide.json";
        if (file_exists($fileName)) {
            echo $io->readFile($fileName);
            flush();
        }
    }

    function danhmucnoibat() {
        $io = new \lib\io();
        $fileName = "cache/danhmucnoibat.json";
        if (file_exists($fileName)) {
            echo $io->readFile($fileName);
            flush();
        }
        $libImg = new \lib\imageComp();
        $lib = new \lib\APIs();
        $a = new \Model\adv();
        $DS = $a->AdvsByGroup("danh-muc-noi-bat", FALSE);
        foreach ($DS as $k => $value) {
            $img = "/" . $libImg->layHinh($value["Urlimages"], 180, 180);
            $Attribute = $a->_decode($value["Attribute"]);
            $DS[$k]["Image"] = $img;
            $DS[$k]["Attribute"] = $Attribute;
        }
        $content = $lib->ArrayToString($DS);
        $io->writeFile($fileName, $content);
    }

    function homeconfig() {
        $lib = new \lib\io();
        $a = $lib->readFile(ROOT_DIR . "/theme/config/homeconfig.json");
        echo $a;
    }

    function linkLienKet() {
        $menu = new Model\Menu();
        $a = $menu->MenusByGroup("LinkLienKet", FALSE);
        $data["Menus"] = $a;
        $data["v"] = sha1(json_encode($a));
        $api = new lib\APIs();
        $api->ArrayToApi($data);
    }

    function listProductsSale() {
        $pro = new Model\Products();
        $ps = $pro->ProductsSale(15);
        foreach ($ps as $key => $value) {
            $ps[$key] = $this->ProductToApi($value);
        }
        $api = new lib\APIs();
        $api->ArrayToApi($ps);
        exit();
    }

    private function ProductToApi($value) {
        $va = new Model\Products($value);
        $value["UrlHinh"] = $va->UrlHinh();
        $value["PriceVnd"] = $va->Price();
        $value["Link"] = $va->linkProduct();
        $value["Price"] = intval($va->Price);
        $value["oldPrice"] = intval($va->oldPrice);
        $value["oldPriceVnd"] = $va->oldPrice();
        unset($value["Content"]);
        unset($value["Summary"]);
        return $value;
    }

    function listNewsProducts() {
        $pro = new Model\Products();
        $ps = $pro->ProductsHotNew(15);
        foreach ($ps as $key => $value) {
            $ps[$key] = $this->ProductToApi($value);
        }
        $api = new lib\APIs();
        $api->ArrayToApi($ps);
        exit();
    }

    function productCatHome() {
        $pro = new Model\Products();
        $CatId = $this->getParam()[0];
        $sum = 0;
        $ps = $pro->ProductsByCatID($CatId, 1, 8, $sum);
        foreach ($ps as $key => $value) {
            $ps[$key] = $this->ProductToApi($value);
        }
        $api = new lib\APIs();
        $api->ArrayToApi($ps);
        exit();
    }

    function AdvByProduct() {
        $adv = new \Model\adv();
        $product = $adv->AdvsByGroup("product");
        $api = new lib\APIs();
        return $api->ArrayToApi($product);
    }

    function danhmucsanpham() {
        $Cat = new Model\Category();
        $Cats = $Cat->getCategorys(FALSE);
        $b = [];
        foreach ($Cats as $k => $value) {
            $value = new Model\Category($value);
            $b[$k]["Id"] = $value->catID;
            $b[$k]["Link"] = $value->linkCurentCategory();
            $b[$k]["Name"] = $value->catName;
            $b[$k]["Image"] = $value->banner;
        }
        $api = new lib\APIs();
        $api->ArrayToApi($b);
    }

    function GetFunctions() {
        $themeName = Model_ViewTheme::get_viewthene();
        $funsName = "theme\\{$themeName}\\functionLayout";
        $b = $funsName::functionsName();
        $api = new lib\APIs();
        $api->ArrayToApi($b);
    }

}

?>
