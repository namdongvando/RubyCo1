<?php

class Controller_index extends Application {

    public $param;
    public $ViewTheme;
    public $Pages;
    public $News;

    function __construct() {
        $this->param = $this->getParam();
        $this->Pages = new \Model\pages();
        $this->News = new \Model\news();
        Model_ViewTheme::set_viewthene("dainamhomes");
    }

    function index() {
        Model_Seo::$Title = "__Title___";
        Model_Seo::$des = "__Des___";
        Model_Seo::$key = "__Keyword___";
        Model_Seo::$Images = "__ImggesTitle___";
        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "");
    }

    function index1() {

        Model_Seo::$Title = "__Title___";
        Model_Seo::$des = "__Des___";
        Model_Seo::$key = "__Keyword___";
        Model_Seo::$Images = "__ImggesTitle___";
        $this->ViewTheme("", Model_ViewTheme::get_viewthene(), "");
    }

    function settheme() {
        ob_start();
        $_SESSION["Theme"] = "kimsanews";
        \lib\Common::ToUrl("/");
        die();
    }

    function sanpham() {

        Model_Seo::$Title = "Sản Phẩm";
        Model_Seo::$des = "__Des___";
        Model_Seo::$key = "__SEO_Keyword___";
        $bre = new Model\Breadcrumb();
        $abre[] = [
            "link" => "#"
            , "title" => "Sản Phẩm"
        ];

        $bre->setBreadcrumb($abre);
        $this->ViewTheme([], Model_ViewTheme::get_viewthene(), "danhmuc");
    }

    function syspage($url) {
        $Category = new Model\Category();
//        var_dump($url);
        $this->ViewTheme($data, Model_ViewTheme::get_viewthene(), "danhmuc");
    }

    function categorypt() {

        var_dump($this->getParam());
        var_dump($_POST["page"]);
        $Category = new Model\Category();
//        lấy danh ra

        $linkDanhMuc = $url[2][0];

        if (!$linkDanhMuc) {
            $linkDanhMuc = $url[1][0];
        }

        $pathCat = $Category->getCategoryFromPath($linkDanhMuc);
        $catCurent = $Category->Category4Path($pathCat);
        $bre = new Model\Breadcrumb();
        $abre = $Category->Breadcrumb($catCurent->catID);
        $bre->setBreadcrumb($abre);
        $Pages = isset($url[2]) ? $url[2] : 1;
        $data["Category"] = $catCurent;

        Model_Seo::$Title = $catCurent->catName;
        Model_Seo::$des = "__Des___";
        Model_Seo::$key = "__SEO_Keyword___";
        $this->ViewTheme($data, Model_ViewTheme::get_viewthene(), "danhmuc");
    }

    function category($url) {

        $Category = new Model\Category();
//        lấy danh ra
//        var_dump($url);

        $linkDanhMuc = $url[1][0];
        $curentpages = isset($url[2][0]) ? intval($url[2][0]) : 1;
        $linkDanhMuc = \Model\CheckInput::ChekInput($linkDanhMuc);
        $pathCat = $Category->getCategoryFromLink($linkDanhMuc);
        if ($pathCat == null) {
            die("Lỗi 404");
        }
        $catCurent = new \Model\Category($pathCat);
        $bre = new Model\Breadcrumb();
        $abre = $Category->Breadcrumb($catCurent->catID);
        $bre->setBreadcrumb($abre);
//        $Pages = isset($url[2]) ? $url[2] : 1;
        $data["Category"] = $catCurent;
        $data["Pages"] = $curentpages;

        Model_Seo::$Title = $catCurent->catName;
        Model_Seo::$des = "__Des___";
        Model_Seo::$key = "__SEO_Keyword___";
        $this->ViewTheme($data, Model_ViewTheme::get_viewthene(), "danhmuc");
    }

    function news($url) {
        $aliasPages = \Model\CheckInput::ChekInput($url[1][0]);
        $aliasNews = \Model\CheckInput::ChekInput($url[2][0]);
        $Page = $this->Pages->PagesByAliasIsShow($aliasPages, FALSE);
        if ($Page == null) {
            header("HTTP/1.0 404 Not Found");
//            throw new Exception();
        }
        $_Page = new \Model\pages($Page);
        $news = $this->News->NewsByAlias($aliasNews, $_Page->idPa);
        if ($news == null) {
            header('HTTP/1.1 404 Not Found');
//            throw new Exception();
        }

        $_News = new \Model\news($news);
        $_Breadcrumb = new \Model\Breadcrumb();
        $a = [
            [
                "title" => $_Page->Name,
                "link" => $_Page->linkPagesCurent()
            ],
            [
                "title" => $_News->Name,
                "link" => $_News->linkNewsCurent()
            ]
        ];
        $_Breadcrumb->setBreadcrumb($a);
        $data["news"] = $news;
        $data["pages"] = $Page;
        Model_Seo::$Title = $_News->Name;
        Model_Seo::$des = $_News->description;
        Model_Seo::$key = $_News->keyword;
        Model_Seo::$Images = $_News->UrlHinh();
        $this->ViewTheme($data, Model_ViewTheme::get_viewthene(), "danhmuc");
    }

    function pages($url) {

        $pages = new \Model\pages();
        $url[1][0] = \Model\CheckInput::ChekInput($url[1][0]);
        $_Pages = $pages->PagesByAliasIsShow($url[1][0], FALSE);
        if ($_Pages == null) {
            header('HTTP/1.1 404 Not Found');
        }
        $Pages = new \Model\pages($_Pages);
        Model_Seo::$Title = $Pages->Title;
        Model_Seo::$des = $Pages->Des;
        Model_Seo::$key = $Pages->Keyword;
        Model_Seo::$Images = $Pages->Urlimages;
        $data["pages"] = $_Pages;
        $this->ViewTheme($data, Model_ViewTheme::get_viewthene(), "pages");
    }

    function product($url) {

        $mp = new Model\Products();
        $p = $mp->ProductsByAlias($url[2][0], FALSE);
        $data["p"] = $p;
//        var_dump($p);
        $p["Views"] = $p["Views"] + 1;
        $mp->EditProducts($p);
        $p = new Model\Products($p);
        $Category = new \Model\Category();
        $bre = new \Model\Breadcrumb();
        $abre = $p->Breadcrumb();
        $bre->setBreadcrumb($abre);
        Model_Seo::$Title = $p->nameProduct;
        Model_Seo::$des = $p->Summary;
        Model_Seo::$key = $p->Summary;
        $this->ViewTheme($data, Model_ViewTheme::get_viewthene(), "product");
    }

    function chitietsanpham() {
        $mp = new Model\Products();
        $p = $mp->ProductsByAlias($_GET["alias"], FALSE);
//        var_dump($p);
        $data["p"] = $p;
//        var_dump($p);
        $p["Views"] = $p["Views"] + 1;
        $mp->EditProducts($p);
        $p = new Model\Products($p);
        $Category = new \Model\Category();
        $bre = new \Model\Breadcrumb();
        $abre = $p->Breadcrumb();
        $bre->setBreadcrumb($abre);
        Model_Seo::$Title = $p->nameProduct;
        Model_Seo::$des = $p->Summary;
        Model_Seo::$key = $p->Summary;
        $this->ViewTheme($data, Model_ViewTheme::get_viewthene(), "product");
    }

    function pagesdetail($url) {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $pages = new \Model\pages();
        $_Pages = $pages->PagesByAliasIsShow($url[1][0], FALSE);
        if ($_Pages == null) {
            header("HTTP/1.0 404 Not Found");
        }
        $Pages = new \Model\pages($_Pages);
        Model_Seo::$Title = $Pages->Title;
        Model_Seo::$des = $Pages->Des;
        Model_Seo::$key = $Pages->Keyword;
        $data["pages"] = $_Pages;

        $bre = new Model\Breadcrumb();
        $abre = $pages->Breadcrumb($Pages->idPa);
        $bre->setBreadcrumb($abre);
        $this->ViewTheme($data, Model_ViewTheme::get_viewthene(), "pages");
    }

    function syspagedetail($Url) {
        $data["Page"] = $this->Pages->TimPages4TieuDeKD($Url[1][0]);
        $p = new Model_Pages($data["Page"]);
        Model_Seo::$Title = $p->Title;
        Model_Seo::$des = $p->Des;
        Model_Seo::$key = $p->Keyword;
        $this->ViewTheme($data, Model_ViewTheme::get_viewthene(), "danhmuc");
    }

    function seach() {

        Model_Seo::$Title = "__Title___";
        Model_Seo::$des = "__Des___";
        Model_Seo::$key = "__SEO_Keyword___";
        $data = $_REQUEST["seach"];
        $this->ViewTheme($data, Model_ViewTheme::get_viewthene(), "danhmuc");
    }

    function lienhe() {
        Model_Seo::$Title = "Liên Hệ";
        Model_Seo::$des = "__Des___";
        Model_Seo::$key = "__Keyword___";
        $this->ViewTheme(null, Model_ViewTheme::get_viewthene(), "pages");
    }

    function thuvien() {
        Model_Seo::$Title = "Thư Viện Hình Ảnh";
        Model_Seo::$des = "__Des___";
        Model_Seo::$key = "__Keyword___";
        $this->ViewTheme(null, Model_ViewTheme::get_viewthene(), "pages");
    }

    function Code() {
        $a = "
 [MauBietThuDep]
 [FormLienHe]
 [NguoiSangTao]
 [TaiSaoChonChungToi]
 [KhachHangNoiVeChungToi]
 [TuVanHotLine]
 [XayDungTronGoi]
 [ThongTinCanBiet]
 [HomeSlide]
 [GioiThieuNgan]";
    }

    function getRemoteIP() {
        $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
        return $ip;
    }

    /* If your visitor comes from proxy server you have use another function
      to get a real IP address: */

    function getIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    function savemail() {
        if (isset($_POST["Email"])) {
            try {
                $email = $_POST["Email"];
                $email = trim($email);
                $email = addslashes($email);
                $email = htmlspecialchars($email);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new Exception("Invalid email format");
                }
                $content = [];
                $filename = "data/contacEmail.txt";
                if (file_exists($filename)) {
                    $content = file_get_contents($filename);
                }
                $io = new \lib\io();
                if (!empty($content)) {
                    $content = json_decode($content);
                } else {
                    $content = [];
                }
                $content[md5($email)] = $email;
                $io->writeFile($filename, json_encode($content));
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        }
        lib\Common::ToUrl("/");
    }

    function loi404() {
        echo "404";
    }

}
?>

